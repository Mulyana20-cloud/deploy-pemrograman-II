@extends('layouts.customer.app')

@section('title', $product->name . ' - BeautyStore')

@section('content')

<div class="min-h-screen bg-[#fff9f7]">
    <main class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 sm:py-10 lg:py-12">

        {{-- BREADCRUMB --}}
        <nav aria-label="Breadcrumb" class="mb-6 overflow-hidden sm:mb-8">
            <div class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-gray-500 sm:text-sm">
                <a href="{{ url('/') }}" class="shrink-0 transition hover:text-pink-600">
                    Home
                </a>

                <span>/</span>

                <a href="{{ route('shop', ['category' => $product->category_id]) }}"
                   class="shrink-0 transition hover:text-pink-600">
                    {{ $product->category->name ?? 'Products' }}
                </a>

                <span>/</span>

                <span class="min-w-0 break-words font-medium text-slate-700">
                    {{ $product->name }}
                </span>
            </div>
        </nav>


        {{-- PRODUCT DETAIL --}}
        <section class="grid grid-cols-1 items-start gap-6 md:grid-cols-2 md:gap-10 lg:gap-14">

            {{-- PRODUCT IMAGE --}}
            <div class="min-w-0">
                <div class="overflow-hidden rounded-2xl border border-pink-50 bg-[#faf3f1] shadow-sm sm:rounded-3xl">

                    <div class="aspect-square w-full">
                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            alt="{{ $product->name }}"
                            class="h-full w-full object-contain p-3 sm:p-5"
                            fetchpriority="high"
                        >
                    </div>

                </div>

                <p class="mt-3 text-center text-xs text-gray-400">
                    BeautyStore — Beauty & Fashion Collection
                </p>
            </div>


            {{-- PRODUCT INFORMATION --}}
            <div class="min-w-0 md:pt-2">

                <p class="text-xs font-semibold uppercase tracking-widest text-[#b76e79] sm:text-sm">
                    {{ $product->category->name ?? 'Beauty & Fashion' }}
                </p>

                <h1 class="mt-2 break-words text-2xl font-bold leading-tight tracking-tight text-slate-900 sm:text-3xl lg:text-4xl">
                    {{ $product->name }}
                </h1>


                {{-- PRICE --}}
                <div class="mt-5 rounded-2xl border border-pink-100 bg-white p-4 sm:mt-6 sm:p-5">

                    @if($product->discount_price)
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold text-pink-600">
                                SPECIAL PRICE
                            </span>

                            <span class="text-xs text-gray-400 line-through">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>

                        <p class="mt-2 break-words text-2xl font-bold text-[#b76e79] sm:text-3xl">
                            Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                        </p>
                    @else
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                            Product Price
                        </p>

                        <p class="mt-2 break-words text-2xl font-bold text-[#b76e79] sm:text-3xl">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    @endif

                </div>


                {{-- DESCRIPTION --}}
                <div class="mt-5 border-b border-pink-100 pb-5 sm:mt-6 sm:pb-6">

                    <h2 class="text-base font-semibold text-slate-900 sm:text-lg">
                        Product Description
                    </h2>

                    <div class="mt-3 break-words text-sm leading-7 text-gray-600 sm:text-base">
                        @if(filled($product->description))
                            {!! nl2br(e($product->description)) !!}
                        @else
                            <p>Product details will be available soon.</p>
                        @endif
                    </div>

                </div>


                {{-- STOCK AND SKU --}}
                <div class="mt-5 flex flex-wrap items-center gap-2 sm:mt-6">

                    @if($product->stock > 0)
                        <span class="inline-flex items-center gap-2 rounded-full bg-green-50 px-3 py-2 text-xs font-medium text-green-700 sm:text-sm">
                            <span class="h-2 w-2 rounded-full bg-green-500"></span>
                            In Stock: {{ $product->stock }}
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-2 text-xs font-medium text-red-700 sm:text-sm">
                            <span class="h-2 w-2 rounded-full bg-red-500"></span>
                            Out of Stock
                        </span>
                    @endif

                    @if(filled($product->sku))
                        <span class="max-w-full break-all rounded-full bg-gray-100 px-3 py-2 text-xs text-gray-600 sm:text-sm">
                            SKU: {{ $product->sku }}
                        </span>
                    @endif

                </div>


                {{-- ADD TO CART --}}
                <div class="mt-6 sm:mt-8">

                    @if($product->stock > 0)

                        @auth

                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf

                                {{-- QUANTITY --}}
                                <label for="quantity" class="mb-3 block text-sm font-semibold text-slate-900">
                                    Quantity
                                </label>

                                <div class="mb-5 flex items-center gap-3">

                                    <button
                                        type="button"
                                        id="decreaseQtyButton"
                                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white text-xl font-medium text-slate-700 transition hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40"
                                        aria-label="Decrease quantity"
                                    >
                                        −
                                    </button>

                                    <input
                                        type="number"
                                        name="quantity"
                                        id="quantity"
                                        value="1"
                                        min="1"
                                        max="{{ $product->stock }}"
                                        step="1"
                                        required
                                        inputmode="numeric"
                                        class="h-11 w-20 rounded-xl border border-gray-200 bg-white text-center text-base font-semibold text-slate-900 outline-none focus:border-pink-400 focus:ring-2 focus:ring-pink-100"
                                    >

                                    <button
                                        type="button"
                                        id="increaseQtyButton"
                                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white text-xl font-medium text-slate-700 transition hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40"
                                        aria-label="Increase quantity"
                                    >
                                        +
                                    </button>

                                    <span class="min-w-0 text-xs text-gray-500">
                                        Maximum {{ $product->stock }}
                                    </span>

                                </div>

                                @error('quantity')
                                    <p class="mb-3 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <button
                                    type="submit"
                                    class="flex min-h-12 w-full items-center justify-center gap-2 rounded-xl bg-[#b76e79] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#a45d68] focus:outline-none focus:ring-2 focus:ring-pink-300 focus:ring-offset-2 sm:text-base"
                                >
                                    <span aria-hidden="true">🛒</span>
                                    Add To Cart
                                </button>

                            </form>

                        @else

                            <a
                                href="{{ route('login') }}"
                                class="flex min-h-12 w-full items-center justify-center gap-2 rounded-xl bg-[#b76e79] px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-[#a45d68] sm:text-base"
                            >
                                <span aria-hidden="true">🔒</span>
                                Login to Add Cart
                            </a>

                            <p class="mt-3 text-center text-xs leading-relaxed text-gray-500">
                                Please log in to continue shopping.
                            </p>

                        @endauth

                    @else

                        <button
                            type="button"
                            disabled
                            class="flex min-h-12 w-full cursor-not-allowed items-center justify-center rounded-xl bg-gray-200 px-5 py-3 text-sm font-semibold text-gray-500"
                        >
                            Out of Stock
                        </button>

                    @endif

                </div>


                {{-- PRODUCT BENEFITS --}}
                <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">

                    <div class="flex items-center gap-3 rounded-xl border border-pink-50 bg-white p-3">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-pink-50 text-xl">
                            🌸
                        </span>

                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-900">
                                Beauty Collection
                            </p>
                            <p class="mt-1 text-xs text-gray-500">
                                Curated beauty & fashion
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 rounded-xl border border-pink-50 bg-white p-3">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-pink-50 text-xl">
                            🚚
                        </span>

                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-900">
                                Delivery Information
                            </p>
                            <p class="mt-1 text-xs text-gray-500">
                                See shipping options at checkout
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </section>


        {{-- RELATED PRODUCTS --}}
        @if(isset($relatedProducts) && $relatedProducts->count())

            <section class="mt-14 border-t border-pink-100 pt-10 sm:mt-20 sm:pt-12">

                <div class="mb-6 sm:mb-8">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                        You May Also Like
                    </h2>

                    <p class="mt-2 text-sm text-gray-500 sm:text-base">
                        Explore more products from {{ $product->category->name ?? 'our collection' }}.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-3 sm:gap-5 lg:grid-cols-4 lg:gap-6">

                    @foreach($relatedProducts as $item)

                        <article class="flex min-w-0 flex-col overflow-hidden rounded-2xl border border-pink-50 bg-white shadow-sm transition hover:shadow-lg sm:rounded-3xl">

                            <a
                                href="{{ route('customer.products.show', $item->slug) }}"
                                class="block aspect-square overflow-hidden bg-gray-50"
                            >
                                <img
                                    src="{{ asset('storage/'.$item->image) }}"
                                    alt="{{ $item->name }}"
                                    class="h-full w-full object-cover transition duration-500 hover:scale-105"
                                    loading="lazy"
                                >
                            </a>

                            <div class="flex flex-1 flex-col p-3 sm:p-4">

                                <p class="truncate text-[10px] text-gray-400 sm:text-xs">
                                    {{ $item->category->name ?? 'Beauty & Fashion' }}
                                </p>

                                <h3 class="mt-1 line-clamp-2 min-h-9 text-sm font-semibold leading-snug text-slate-900 sm:mt-2 sm:min-h-12 sm:text-base">
                                    {{ $item->name }}
                                </h3>

                                <p class="mt-2 text-sm font-bold text-[#b76e79] sm:text-lg">
                                    Rp {{ number_format($item->discount_price ?? $item->price, 0, ',', '.') }}
                                </p>

                                <a
                                    href="{{ route('customer.products.show', $item->slug) }}"
                                    class="mt-auto inline-flex min-h-9 items-center justify-center rounded-lg border border-pink-300 px-2 py-2 text-center text-[11px] font-medium text-pink-600 transition hover:bg-pink-600 hover:text-white sm:mt-4 sm:min-h-10 sm:rounded-xl sm:text-sm"
                                >
                                    View Product
                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            </section>

        @endif

    </main>
</div>


{{-- QUANTITY CONTROLS --}}
@auth
@if($product->stock > 0)
<script>
document.addEventListener('DOMContentLoaded', function () {
    const quantityInput = document.getElementById('quantity');
    const decreaseButton = document.getElementById('decreaseQtyButton');
    const increaseButton = document.getElementById('increaseQtyButton');

    if (!quantityInput || !decreaseButton || !increaseButton) {
        return;
    }

    const minQuantity = 1;
    const maxQuantity = Number(quantityInput.max) || 1;

    function updateQuantity(value) {
        let quantity = Number.parseInt(value, 10);

        if (!Number.isFinite(quantity)) {
            quantity = minQuantity;
        }

        quantity = Math.max(minQuantity, Math.min(quantity, maxQuantity));
        quantityInput.value = quantity;

        decreaseButton.disabled = quantity <= minQuantity;
        increaseButton.disabled = quantity >= maxQuantity;
    }

    decreaseButton.addEventListener('click', function () {
        updateQuantity(Number.parseInt(quantityInput.value, 10) - 1);
    });

    increaseButton.addEventListener('click', function () {
        updateQuantity(Number.parseInt(quantityInput.value, 10) + 1);
    });

    quantityInput.addEventListener('input', function () {
        if (quantityInput.value !== '') {
            updateQuantity(quantityInput.value);
        }
    });

    quantityInput.addEventListener('blur', function () {
        updateQuantity(quantityInput.value);
    });

    updateQuantity(quantityInput.value);
});
</script>
@endif
@endauth

@endsection