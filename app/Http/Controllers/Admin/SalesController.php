<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class SalesController extends Controller
{
    /**
     * Menampilkan daftar Sales dan ringkasan komisi.
     */
    public function index()
    {
        $salesRole = Role::where('name', 'sales')
            ->orderByDesc('id')
            ->first();

        abort_unless(
            $salesRole,
            500,
            'Role Sales belum tersedia di database.'
        );

        $sales = User::where('role_id', $salesRole->id)
            ->withCount([
                'salesOrders',
                'referredCustomers',
            ])
            ->withSum([
                'salesOrders as commission_total' => function ($query) {
                    $query->where('credit_simulation', 1)
                        ->where('sales_commission', '>', 0);
                },
            ], 'sales_commission')
            ->withSum([
                'salesOrders as commission_pending' => function ($query) {
                    $query->where('credit_simulation', 1)
                        ->where('sales_commission', '>', 0)
                        ->where('commission_status', 'pending');
                },
            ], 'sales_commission')
            ->withSum([
                'salesOrders as commission_paid' => function ($query) {
                    $query->where('credit_simulation', 1)
                        ->where('sales_commission', '>', 0)
                        ->where('commission_status', 'paid');
                },
            ], 'sales_commission')
            ->latest()
            ->get();

        $creditOrders = Order::with(['user', 'sales'])
            ->where('credit_simulation', 1)
            ->whereNotNull('sales_id')
            ->where('sales_commission', '>', 0)
            ->latest()
            ->get();

        $totalSales = $sales->count();

        $totalReferralCustomers = $sales->sum(
            'referred_customers_count'
        );

        $totalReferralOrders = Order::whereNotNull('sales_id')
            ->count();

        $commissionQuery = Order::where('credit_simulation', 1)
            ->whereNotNull('sales_id')
            ->where('sales_commission', '>', 0);

        $totalCommission = (clone $commissionQuery)
            ->sum('sales_commission');

        $pendingCommission = (clone $commissionQuery)
            ->where('commission_status', 'pending')
            ->sum('sales_commission');

        $paidCommission = (clone $commissionQuery)
            ->where('commission_status', 'paid')
            ->sum('sales_commission');

        return view('admin.sales.index', compact(
            'sales',
            'creditOrders',
            'totalSales',
            'totalReferralCustomers',
            'totalReferralOrders',
            'totalCommission',
            'pendingCommission',
            'paidCommission'
        ));
        
    }

    /**
     * Menampilkan formulir pembuatan akun Sales.
     */
    public function create()
    {
        return view('admin.sales.create');
    }

    /**
     * Membuat akun Sales baru melalui Admin.
     */
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);

        $salesRole = Role::whereRaw('LOWER(name) = ?', ['sales'])
            ->orderByDesc('id')
            ->first();

        if (!$salesRole) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Role Sales tidak ditemukan di database.',
                ]);
        }

        do {
            $referralCode = Str::upper(Str::random(10));
        } while (
            User::where('referral_code', $referralCode)->exists()
        );

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role_id = $salesRole->id;
        $user->referral_code = $referralCode;
        $user->save();

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Akun Sales berhasil dibuat.');
    }


    /**
     * Menampilkan riwayat komisi Sales.
     * Status komisi mengikuti konfirmasi pembayaran simulasi kredit.
     */
    public function commissions()
    {
        $orders = Order::with(['user', 'sales'])
            ->where('credit_simulation', 1)
            ->whereNotNull('sales_id')
            ->where('sales_commission', '>', 0)
            ->latest()
            ->get();

        $commissionQuery = Order::where('credit_simulation', 1)
            ->whereNotNull('sales_id')
            ->where('sales_commission', '>', 0);

        $totalPending = (clone $commissionQuery)
            ->where('commission_status', 'pending')
            ->sum('sales_commission');

        $totalPaid = (clone $commissionQuery)
            ->where('commission_status', 'paid')
            ->sum('sales_commission');

        return view('admin.sales.commissions', compact(
            'orders',
            'totalPending',
            'totalPaid'
        ));
    }

    
    /**
     * Menghapus akun Sales dengan pemeriksaan riwayat.
     */
    public function destroy(User $user)
    {
        $salesRole = Role::whereRaw('LOWER(name) = ?', ['sales'])
            ->orderByDesc('id')
            ->first();

        abort_unless(
            $salesRole && (int) $user->role_id === (int) $salesRole->id,
            404,
            'Akun Sales tidak ditemukan.'
        );

        $hasOrders = Order::where('sales_id', $user->id)->exists();

        $hasCustomers = User::where('referred_by', $user->id)->exists();

        if ($hasOrders || $hasCustomers) {
            return redirect()
                ->route('admin.sales.index')
                ->with(
                    'error',
                    'Akun tidak dapat dihapus karena memiliki riwayat pesanan atau pelanggan referral.'
                );
        }

        $user->delete();

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Akun Sales berhasil dihapus.');
    }

}
