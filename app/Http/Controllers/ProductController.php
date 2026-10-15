<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk dengan pencarian,
     * filter kategori, dan pengurutan.
     */
    public function index(Request $request)
    {
        $query = Product::with('category')
            ->where('status', 'active');

        // SEARCH
        if ($request->filled('search')) {
            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        // FILTER CATEGORY BY ID
        
        if ($request->filled('category')) {
            $categoryValue = $request->category;

            if (is_numeric($categoryValue)) {
                // Kategori dikirim menggunakan ID dari dropdown Shop.
                $query->where('category_id', (int) $categoryValue);
            } else {
                // Kategori dikirim menggunakan slug dari beranda.
                $query->whereHas('category', function ($categoryQuery) use ($categoryValue) {
                    $categoryQuery->where('slug', $categoryValue);
                });
            }
        }


        // SORTING
        if ($request->sort === 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_high') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query
            ->paginate(12)
            ->withQueryString();

        $categories = Category::all();

        return view(
            'customer.products.index',
            compact('products', 'categories')
        );
    }

    /**
     * Menampilkan detail produk.
     */
    public function show($slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $relatedProducts = Product::where(
                'category_id',
                $product->category_id
            )
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->latest()
            ->take(4)
            ->get();

        return view(
            'customer.products.show',
            compact('product', 'relatedProducts')
        );
    }
}