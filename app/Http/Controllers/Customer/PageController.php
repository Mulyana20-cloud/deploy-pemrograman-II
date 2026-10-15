<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;


class PageController extends Controller
{


    public function categories()
    {
        return view('customer.pages.categories');
    }



    public function about()
    {
        return view('customer.pages.about');
    }



    public function contact()
    {
        return view('customer.pages.contact');
    }



    public function shipping()
    {
        return view('customer.pages.shipping');
    }



    public function payment()
    {
        return view('customer.pages.payment');
    }


}