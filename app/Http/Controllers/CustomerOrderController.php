<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CustomerOrderController extends Controller
{


    public function index()
    {

        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();


        return view(
            'customer.orders.index',
            compact('orders')
        );

    }



    public function show(Order $order)
    {

        if($order->user_id != auth()->id()){

            abort(403);

        }


        $order->load('items.product');


        return view(
            'customer.orders.show',
            compact('order')
        );

    }


}