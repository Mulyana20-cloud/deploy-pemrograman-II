<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index(Request $request)
    {

        $query = Product::with('category');



        // SEARCH PRODUCT

        if($request->search)
        {

            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );

        }





        // FILTER CATEGORY

        if($request->category)
        {

            $query->where(
                'category_id',
                $request->category
            );

        }





        $products = $query->get();



        $categories = Category::all();




        return view(
            'admin.products.index',
            compact(
                'products',
                'categories'
            )
        );

    }



    public function create()
    {

        $categories = Category::all();


        return view(
            'admin.products.create',
            compact('categories')
        );

    }



    public function store(Request $request)
    {

        $request->validate([

            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'status' => 'required',

            'image' => 'nullable|image|max:51200',

        ]);


        $image = null;


        if ($request->hasFile('image')) {

            $image = $request->file('image')
                ->store('products', 'public');

        }


        Product::create([

            'category_id' => $request->category_id,

            'sku' => 'SKU-' . strtoupper(Str::random(8)),

            'name' => $request->name,

            'slug' => Str::slug($request->name),

            'description' => $request->description,

            'price' => $request->price,

            'discount_price' => $request->discount_price,

            'stock' => $request->stock,

            'image' => $image,

            'status' => $request->status,

        ]);


        return redirect()
            ->route('products.index')
            ->with('success','Product created successfully');

    }



    public function show(Product $product)
    {
        //
    }



    public function edit(Product $product)
    {

        $categories = Category::all();


        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories'
            )
        );

    }



    public function update(Request $request, Product $product)
{

    $request->validate([

        'category_id' => 'required',
        'name' => 'required',
        'price' => 'required',
        'stock' => 'required',
        'status' => 'required',

        'image' => 'nullable|image|max:51200',

    ]);



    $data = [

        'category_id' => $request->category_id,

        'name' => $request->name,

        'slug' => Str::slug($request->name),

        'description' => $request->description,

        'price' => $request->price,

        'discount_price' => $request->discount_price,

        'stock' => $request->stock,

        'status' => $request->status,

    ];



    if($request->hasFile('image'))
    {

        $data['image'] = $request
            ->file('image')
            ->store('products','public');

    }



    $product->update($data);



    return redirect()
        ->route('products.index')
        ->with(
            'success',
            'Product updated successfully'
        );

}



    public function destroy(Product $product)
    {


        $product->delete();



        return redirect()

        ->route('products.index')

        ->with(
            'success',
            'Product deleted successfully'
        );


    }

}