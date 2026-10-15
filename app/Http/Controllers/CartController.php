<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;


class CartController extends Controller
{


    public function index()
    {

        $cart = auth()
            ->user()
            ->cart()
            ->with('items.product')
            ->first();



        if(!$cart){

            $cart = auth()
                ->user()
                ->cart()
                ->create();

        }



        return view(
            'customer.cart.index',
            compact('cart')
        );

    }




    public function add(Request $request, Product $product)
    {

        $request->validate([

            'quantity'=>'required|integer|min:1'

        ]);



        $cart = auth()
            ->user()
            ->cart()
            ->first();



        if(!$cart){

            $cart = auth()
                ->user()
                ->cart()
                ->create();

        }



        $item = $cart
            ->items()
            ->where('product_id',$product->id)
            ->first();



        if($item){

            $item->increment(
                'quantity',
                $request->quantity
            );

        }else{


            $cart->items()->create([

                'product_id'=>$product->id,

                'quantity'=>$request->quantity

            ]);

        }



        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Product added to cart'
            );

    }




    public function remove($id)
    {

        CartItem::findOrFail($id)->delete();


        return redirect()
            ->route('cart.index');

    }




    public function update(Request $request)
    {


        foreach($request->quantity as $id=>$qty){


            CartItem::where('id',$id)
                ->update([

                    'quantity'=>$qty

                ]);

        }


        return redirect()
            ->route('cart.index');


    }





    public function updateAjax(Request $request)
    {


        CartItem::where('id',$request->id)
            ->update([

                'quantity'=>$request->quantity

            ]);



        return response()->json([

            'success'=>true

        ]);


    }


}