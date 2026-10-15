<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;


class CustomerController extends Controller
{

    public function index()
    {

        $customers = User::whereHas('orders')
            ->withCount('orders')
            ->withSum('orders','subtotal')
            ->latest()
            ->get();


        return view(
            'admin.customers.index',
            compact('customers')
        );

    }





    public function show(User $customer)
    {


        $customer->load([
            'orders.items.product'
        ]);



        return view(
            'admin.customers.show',
            compact('customer')
        );


    }



}