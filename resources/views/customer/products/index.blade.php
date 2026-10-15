@extends('layouts.customer.app')

@section('content')

<div class="min-h-[calc(100vh-80px)] flex flex-col bg-gray-50">

    <main class="flex-1 w-full max-w-7xl mx-auto px-6 py-12 flex flex-col">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-slate-900 mb-2">
                Shop Beauty Collection
            </h1>

            <p class="text-gray-500">
                Discover our premium skincare and fashion products
            </p>
        </div>

        {{-- FILTER --}}
        <form
            id="shopFilterForm"
            method="GET"
            action="{{ route('shop') }}"
            class="bg-white p-5 md:p-6 rounded-2xl shadow-sm mb-10 flex flex-col md:flex-row gap-4"
        >
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search product..."
                class="border border-gray-300 rounded-xl px-4 py-3 flex-1 min-w-0 focus:outline-none focus:ring-2 focus:ring-pink-200 focus:border-pink-400"
            >

            <select
                name="category"
                id="categoryFilter"
                class="border border-gray-300 rounded-xl px-4 py-3 bg-white md:w-48 focus:outline-none focus:ring-2 focus:ring-pink-200"
            >
                <option value="">All Categories</option>

                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ (string) request('category') === (string) $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select
                name="sort"
                id="sortFilter"
                class="border border-gray-300 rounded-xl px-4 py-3 bg-white md:w-44 focus:outline-none focus:ring-2 focus:ring-pink-200"
            >
                <option value="">Sort By</option>

                <option
                    value="price_low"
                    {{ request('sort') === 'price_low' ? 'selected' : '' }}
                >
                    Price Lowest
                </option>

                <option
                    value="price_high"
                    {{ request('sort') === 'price_high' ? 'selected' : '' }}
                >
                    Price Highest
                </option>
            </select>

            <button
                type="submit"
                class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-8 py-3 rounded-xl transition"
            >
                Filter
            </button>
        </form>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('shopFilterForm');
            const category = document.getElementById('categoryFilter');
            const sort = document.getElementById('sortFilter');

            if (!form || !category || !sort) {
                return;
            }

            category.addEventListener('change', function () {
                form.requestSubmit();
            });

            sort.addEventListener('change', function () {
                form.requestSubmit();
            });
        });
        </script>

        {{-- PRODUCT LIST --}}
        @if($products->count() > 0)

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                @foreach($products as $product)

                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition">

                        <div class="relative">
                            <img
                                src="{{ asset('storage/'.$product->image) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-72 object-cover"
                            >

                            @if($product->discount_price)
                                <span class="absolute top-4 left-4 bg-pink-500 text-white px-3 py-1 rounded-full text-xs">
                                    SALE
                                </span>
                            @endif
                        </div>

                        <div class="p-5">

                            <p class="text-xs text-gray-400">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </p>

                            <h3 class="font-semibold text-lg mt-1 text-slate-900">
                                {{ $product->name }}
                            </h3>

                            @if($product->discount_price)
                                <p class="text-gray-400 line-through text-sm mt-2">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                <p class="text-pink-600 font-bold text-xl">
                                    Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                                </p>
                            @else
                                <p class="text-pink-600 font-bold text-xl mt-2">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            @endif

                            <a
                                href="{{ route('customer.products.show', $product->slug) }}"
                                class="block text-center mt-5 border border-pink-400 text-pink-500 py-2 rounded-xl hover:bg-pink-500 hover:text-white transition"
                            >
                                View Product
                            </a>

                        </div>
                    </div>

                @endforeach

            </div>

            {{-- PAGINATION --}}
            <div class="mt-10">
                {{ $products->links() }}
            </div>

        @else

            {{-- EMPTY STATE --}}
            <div class="flex-1 min-h-[280px] flex items-center justify-center">
                <div class="text-center max-w-md mx-auto py-12 px-6 bg-white rounded-3xl border border-gray-100 shadow-sm">

                    <div class="w-16 h-16 mx-auto rounded-full bg-pink-50 flex items-center justify-center text-3xl mb-5">
                        🔍
                    </div>

                    <h2 class="text-xl font-bold text-slate-900">
                        Produk tidak ditemukan
                    </h2>

                    <p class="text-gray-500 text-sm mt-3 leading-relaxed">
                        Belum ada produk yang sesuai dengan kategori atau pencarian ini.
                        Coba pilih kategori lain atau tampilkan semua produk.
                    </p>

                    <a
                        href="{{ route('shop') }}"
                        class="inline-flex items-center justify-center mt-6 bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-3 rounded-xl transition"
                    >
                        Lihat Semua Produk
                    </a>

                </div>
            </div>

        @endif

    </main>

</div>

@endsection