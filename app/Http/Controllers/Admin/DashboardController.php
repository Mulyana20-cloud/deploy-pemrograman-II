<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{


    public function index()
    {


        // Total Product

        $totalProducts = Product::count();



        // Total Orders

        $totalOrders = Order::count();




        // Total Revenue

        $revenue = Order::sum('subtotal');





        // Recent Orders

        $recentOrders = Order::latest()
            ->take(5)
            ->get();






        // Top Products

        $topProducts = OrderItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_sold')
            )
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product')
            ->take(5)
            ->get();





        return view(
            'admin.dashboard',
            compact(
                'totalProducts',
                'totalOrders',
                'revenue',
                'recentOrders',
                'topProducts'
            )
        );


    }


}