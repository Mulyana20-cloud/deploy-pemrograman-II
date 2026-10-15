<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            strtolower((string) $user->role?->name) === 'sales',
            403,
            'Halaman ini hanya dapat diakses oleh Sales.'
        );

        // Pastikan Sales memiliki kode referral.
        if (!$user->referral_code) {
            do {
                $code = Str::upper(Str::random(10));
            } while (
                DB::table('users')
                    ->where('referral_code', $code)
                    ->exists()
            );

            $user->referral_code = $code;
            $user->save();
        }

        $referralLink = url('/?ref=' . $user->referral_code);

        // Semua pesanan yang terhubung ke Sales ini.
        $salesQuery = Order::where('sales_id', $user->id);

        $totalOrders = (clone $salesQuery)->count();

        // Pesanan simulasi kredit milik Sales ini.
        $creditQuery = (clone $salesQuery)
            ->where('payment_method', 'CREDIT_SIMULATION');

        $creditOrders = (clone $creditQuery)->count();

        // Total komisi dari pesanan simulasi kredit.
        $totalCommission = (clone $creditQuery)
            ->sum('sales_commission');

        // Komisi yang masih berstatus pending.
        $pendingCommission = (clone $creditQuery)
            ->where('commission_status', 'pending')
            ->sum('sales_commission');

        // Komisi yang sudah ditandai selesai.
        $paidCommission = (clone $creditQuery)
            ->where('commission_status', 'paid')
            ->sum('sales_commission');

        $salesOrders = (clone $salesQuery)
            ->latest()
            ->take(10)
            ->get();

        return view('sales.dashboard', compact(
            'user',
            'referralLink',
            'totalOrders',
            'creditOrders',
            'totalCommission',
            'pendingCommission',
            'paidCommission',
            'salesOrders'
        ));
    }
}