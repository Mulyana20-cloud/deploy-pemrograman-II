<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;


class OrderController extends Controller
{


    public function index()
    {


        $orders = Order::latest()->get();



        return view(
            'admin.orders.index',
            compact('orders')
        );


    }




    public function show(Order $order)
    {


        $order->load(
            'items.product'
        );


        return view(
            'admin.orders.show',
            compact('order')
        );


    }



    public function update(Request $request, Order $order)
    {

        $request->validate([

            'order_status'=>'required'

        ]);



        $order->update([

            'order_status'=>$request->order_status

        ]);



        return back()
            ->with(
                'success',
                'Order status updated'
            );

    }




}