<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        /*
         * Simpan referral terbaru jika pengunjung membuka
         * tautan Sales yang valid.
         *
         * Contoh:
         * http://127.0.0.1:8000/?ref=KODEREFERRAL
         */
        if ($request->filled('ref')) {
            $referralCode = strtoupper(
                trim((string) $request->query('ref'))
            );

            $sales = User::whereRaw(
                'UPPER(referral_code) = ?',
                [$referralCode]
            )
                ->whereHas('role', function ($query) {
                    $query->whereRaw(
                        'LOWER(name) = ?',
                        ['sales']
                    );
                })
                ->first();

            /*
             * Referral session hanya diperbarui jika kode valid.
             * Kode yang tidak valid tidak menghapus referral
             * valid yang sudah tersimpan.
             */
            if ($sales) {
                session([
                    'sales_referral_id' => $sales->id,
                ]);
            }
        }

        $products = Product::where('status', 'active')
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::all();

        return view(
            'customer.home',
            compact('products', 'categories')
        );
    }
}