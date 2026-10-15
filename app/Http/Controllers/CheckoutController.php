<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()
            ->user()
            ->cart()
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('shop')
                ->with('error', 'Cart masih kosong.');
        }

        $subtotal = 0;

        foreach ($cart->items as $item) {
            if ($item->product) {
                $subtotal +=
                    $item->product->price * $item->quantity;
            }
        }

        return view(
            'customer.checkout.index',
            compact('cart', 'subtotal')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'max:30',
            ],
            'address' => [
                'required',
                'string',
            ],
            'payment_method' => [
                'required',
                Rule::in([
                    'COD',
                    'CREDIT_SIMULATION',
                ]),
            ],
            'installment_months' => [
                'required_if:payment_method,CREDIT_SIMULATION',
                'nullable',
                'integer',
                Rule::in([3, 6, 12]),
            ],
        ]);

        $user = $request->user();

        $cart = $user->cart()
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('shop')
                ->with('error', 'Cart masih kosong.');
        }

        foreach ($cart->items as $item) {
            if (!$item->product) {
                return redirect()
                    ->route('shop')
                    ->with(
                        'error',
                        'Ada produk dalam keranjang yang tidak tersedia.'
                    );
            }
        }

        $subtotal = 0;

        foreach ($cart->items as $item) {
            $subtotal +=
                $item->product->price * $item->quantity;
        }

        /*
         * TENTUKAN SALES PENERIMA PESANAN.
         *
         * Prioritas 1:
         * Referral terbaru dari session.
         *
         * Prioritas 2:
         * Referral pelanggan yang sudah tersimpan di database.
         *
         * Akun Sales tidak boleh memperoleh komisi dari
         * pesanan miliknya sendiri.
         */
        $sales = null;

        $isSalesAccount = strtolower(
            (string) $user->role?->name
        ) === 'sales';

        if (!$isSalesAccount) {
            // Prioritas pertama: referral terbaru yang valid.
            $sessionReferralId = session(
                'sales_referral_id'
            );

            if ($sessionReferralId) {
                $sales = User::whereKey($sessionReferralId)
                    ->whereHas('role', function ($query) {
                        $query->whereRaw(
                            'LOWER(name) = ?',
                            ['sales']
                        );
                    })
                    ->first();
            }

            // Prioritas kedua: referral lama pelanggan.
            if (!$sales && $user->referred_by) {
                $sales = User::whereKey(
                    $user->referred_by
                )
                    ->whereHas('role', function ($query) {
                        $query->whereRaw(
                            'LOWER(name) = ?',
                            ['sales']
                        );
                    })
                    ->first();
            }

            // Cegah referral ke akun sendiri.
            if (
                $sales
                && (int) $sales->id === (int) $user->id
            ) {
                $sales = null;
            }
        }

        $isCredit =
            $validated['payment_method']
            === 'CREDIT_SIMULATION';

        /*
         * Simulasi bunga flat 1% per bulan.
         * Hanya untuk demonstrasi, bukan layanan kredit nyata.
         */
        $months = $isCredit
            ? (int) $validated['installment_months']
            : null;

        $monthlyInstallment = null;

        if ($isCredit && $months) {
            $simulatedTotal = $subtotal
                * (1 + (0.01 * $months));

            $monthlyInstallment = round(
                $simulatedTotal / $months,
                2
            );
        }

        /*
         * Komisi 10% hanya untuk simulasi kredit
         * yang berhasil diatribusikan kepada Sales.
         */
        $commission = (
            $isCredit && $sales
        )
            ? round($subtotal * 0.10, 2)
            : 0;

        $order = DB::transaction(function () use (
            $validated,
            $user,
            $cart,
            $subtotal,
            $sales,
            $isCredit,
            $months,
            $monthlyInstallment,
            $commission
        ) {
            $order = Order::create([
                'user_id' => $user->id,
                'sales_id' => $sales?->id,

                'order_number' => 'BS-'
                    . now()->format('YmdHis')
                    . '-'
                    . strtoupper(
                        substr(bin2hex(random_bytes(3)), 0, 6)
                    ),

                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],

                'payment_method' =>
                    $validated['payment_method'],

                'payment_status' => 'pending',
                'order_status' => 'processing',
                'subtotal' => $subtotal,

                'credit_simulation' => $isCredit,
                'installment_months' => $months,
                'installment_amount' => $monthlyInstallment,

                'sales_commission' => $commission,

                'commission_status' => $commission > 0
                    ? 'pending'
                    : 'not_applicable',
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            /*
             * Perbarui Sales pelanggan setelah pesanan berhasil
             * dibuat. Referral baru dapat menggantikan referral
             * sebelumnya.
             *
             * Atribusi pesanan lama tidak diubah karena setiap
             * pesanan sudah menyimpan sales_id masing-masing.
             */
            if (
                $sales
                && (int) $user->referred_by !== (int) $sales->id
            ) {
                $user->referred_by = $sales->id;
                $user->save();
            }

            $cart->items()->delete();

            return $order;
        });

        /*
         * Referral session digunakan untuk satu proses checkout.
         * Referral permanen pelanggan sudah disimpan di database.
         */
        session()->forget('sales_referral_id');

        return redirect()
            ->route('checkout.success', $order->id);
    }

    public function success(Order $order)
    {
        abort_unless(
            auth()->check()
            && (int) $order->user_id === (int) auth()->id(),
            403
        );

        return view(
            'customer.checkout.success',
            compact('order')
        );
    }
}
