<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    /**
     * Menampilkan daftar pembayaran.
     */
    public function index()
    {
        $payments = Order::latest()->get();

        return view(
            'admin.payments.index',
            compact('payments')
        );
    }

    /**
     * Menampilkan detail pembayaran.
     */
    public function show(Order $order)
    {
        return view(
            'admin.payments.show',
            compact('order')
        );
    }

    /**
     * Memperbarui status pembayaran.
     * Komisi simulasi kredit mengikuti konfirmasi pembayaran.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status' => [
                'required',
                'string',
                Rule::in([
                    'pending',
                    'paid',
                    'unpaid',
                    'failed',
                    'refunded',
                ]),
            ],
        ]);

        $newStatus = $validated['payment_status'];

        $result = DB::transaction(function () use ($order, $newStatus) {
            $lockedOrder = Order::whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            $isCreditSimulation = (bool) $lockedOrder->credit_simulation;

            $hasSalesCommission = $lockedOrder->sales_id
                && (float) $lockedOrder->sales_commission > 0;

            $lockedOrder->payment_status = $newStatus;

            if ($isCreditSimulation && $hasSalesCommission) {
                if ($newStatus === 'paid') {
                    // Komisi dinyatakan dibayarkan setelah
                    // Admin mengonfirmasi pembayaran simulasi.
                    $lockedOrder->commission_status = 'paid';
                } elseif (
                    $lockedOrder->commission_status !== 'paid'
                ) {
                    // Komisi yang belum dibayarkan tetap pending.
                    $lockedOrder->commission_status = 'pending';
                }
            }

            $lockedOrder->save();

            return [
                'is_credit_simulation' => $isCreditSimulation,
                'has_sales_commission' => (bool) $hasSalesCommission,
                'payment_status' => $newStatus,
            ];
        });

        if (
            $result['is_credit_simulation']
            && $result['has_sales_commission']
            && $newStatus === 'paid'
        ) {
            $message = 'Pembayaran simulasi kredit berhasil dikonfirmasi. Status komisi Sales otomatis menjadi sudah dibayar.';
        } else {
            $message = 'Status pembayaran berhasil diperbarui.';
        }

        return back()->with('success', $message);
    }
}