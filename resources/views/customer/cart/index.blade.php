@extends('layouts.customer.app')

@section('title', 'Shopping Cart - BeautyStore')

@section('content')

<div class="min-h-screen bg-[#fff9f7]">
    <main class="mx-auto w-full max-w-6xl px-4 py-6 sm:px-6 sm:py-10 lg:py-12">

        {{-- PAGE HEADER --}}
        <div class="mb-6 sm:mb-8">
            <p class="text-xs font-semibold uppercase tracking-widest text-[#b76e79]">
                Your Selection
            </p>

            <h1 class="mt-2 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-4xl">
                Shopping Cart
            </h1>

            <p class="mt-2 text-sm text-gray-500 sm:text-base">
                Review your products before checkout.
            </p>
        </div>

        @if($cart && $cart->items->count() > 0)

            @php
                $total = 0;
            @endphp

            <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3 lg:gap-8">

                {{-- CART ITEMS --}}
                <section class="min-w-0 lg:col-span-2" aria-label="Cart items">

                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-base font-semibold text-slate-900 sm:text-lg">
                            Your Products
                        </h2>

                        <span class="text-sm text-gray-500">
                            {{ $cart->items->count() }} item(s)
                        </span>
                    </div>

                    <div class="space-y-4">

                        @foreach($cart->items as $item)

                            @php
                                $product = $item->product;
                                $price = $product->discount_price ?? $product->price;
                                $subtotal = $price * $item->quantity;
                                $total += $subtotal;
                            @endphp

                            <article
                                class="cart-item min-w-0 rounded-2xl border border-pink-50 bg-white p-3 shadow-sm sm:rounded-3xl sm:p-5"
                                data-item-id="{{ $item->id }}"
                            >

                                <div class="flex min-w-0 gap-3 sm:gap-5">

                                    {{-- PRODUCT IMAGE --}}
                                    <a
                                        href="{{ route('customer.products.show', $product->slug) }}"
                                        class="h-24 w-24 shrink-0 overflow-hidden rounded-xl bg-[#faf3f1] sm:h-32 sm:w-32 sm:rounded-2xl"
                                    >
                                        <img
                                            src="{{ asset('storage/'.$product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="h-full w-full object-cover"
                                            loading="lazy"
                                        >
                                    </a>

                                    {{-- PRODUCT INFO --}}
                                    <div class="flex min-w-0 flex-1 flex-col">

                                        <p class="text-[10px] font-medium uppercase tracking-wide text-gray-400 sm:text-xs">
                                            {{ $product->category->name ?? 'Beauty & Fashion' }}
                                        </p>

                                        <a
                                            href="{{ route('customer.products.show', $product->slug) }}"
                                            class="mt-1 line-clamp-2 break-words text-sm font-semibold leading-snug text-slate-900 transition hover:text-pink-600 sm:text-base"
                                        >
                                            {{ $product->name }}
                                        </a>

                                        @if($product->discount_price)
                                            <p class="mt-2 text-[10px] text-gray-400 line-through sm:text-xs">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </p>
                                        @endif

                                        <p class="mt-1 text-sm font-bold text-[#b76e79] sm:text-base">
                                            Rp {{ number_format($price, 0, ',', '.') }}
                                        </p>

                                        {{-- REMOVE --}}
                                        <form
                                            action="{{ route('cart.remove', $item->id) }}"
                                            method="POST"
                                            class="mt-auto pt-3"
                                            onsubmit="return confirm('Hapus produk ini dari keranjang?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex min-h-8 items-center text-xs font-medium text-red-500 transition hover:text-red-700 sm:text-sm"
                                            >
                                                <span aria-hidden="true" class="mr-1">🗑</span>
                                                Remove
                                            </button>
                                        </form>

                                    </div>

                                </div>

                                {{-- QUANTITY & SUBTOTAL --}}
                                <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-gray-100 pt-4 sm:mt-5">

                                    <div>
                                        <label
                                            for="quantity-{{ $item->id }}"
                                            class="mb-2 block text-xs font-medium text-gray-500"
                                        >
                                            Quantity
                                        </label>

                                        <div class="flex items-center gap-2">

                                            <button
                                                type="button"
                                                onclick="changeQty(this, -1)"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 text-lg text-slate-700 transition hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40"
                                                aria-label="Decrease quantity"
                                            >
                                                −
                                            </button>

                                            <input
                                                type="number"
                                                id="quantity-{{ $item->id }}"
                                                data-id="{{ $item->id }}"
                                                data-price="{{ $price }}"
                                                data-original-qty="{{ $item->quantity }}"
                                                data-max="{{ max(1, (int) $product->stock) }}"
                                                value="{{ $item->quantity }}"
                                                min="1"
                                                max="{{ max(1, (int) $product->stock) }}"
                                                step="1"
                                                inputmode="numeric"
                                                class="qty-input h-9 w-14 rounded-lg border border-gray-200 text-center text-sm font-semibold text-slate-900 outline-none focus:border-pink-400 focus:ring-2 focus:ring-pink-100"
                                                aria-label="Product quantity"
                                            >

                                            <button
                                                type="button"
                                                onclick="changeQty(this, 1)"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 text-lg text-slate-700 transition hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40"
                                                aria-label="Increase quantity"
                                            >
                                                +
                                            </button>

                                        </div>
                                    </div>

                                    <div class="min-w-0 text-right">
                                        <p class="text-xs text-gray-500">
                                            Subtotal
                                        </p>

                                        <p class="subtotal mt-1 break-words text-base font-bold text-slate-900 sm:text-lg">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </p>
                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>

                    {{-- CONTINUE SHOPPING --}}
                    <a
                        href="{{ route('shop') }}"
                        class="mt-5 inline-flex min-h-11 w-full items-center justify-center rounded-xl border border-pink-200 bg-white px-5 py-3 text-sm font-semibold text-[#b76e79] transition hover:bg-pink-50 sm:w-auto"
                    >
                        <span aria-hidden="true" class="mr-2">←</span>
                        Continue Shopping
                    </a>

                </section>


                {{-- ORDER SUMMARY --}}
                <aside class="min-w-0 lg:sticky lg:top-6">

                    <div class="rounded-2xl border border-pink-50 bg-white p-5 shadow-sm sm:rounded-3xl sm:p-6">

                        <h2 class="text-lg font-bold text-slate-900 sm:text-xl">
                            Order Summary
                        </h2>

                        <div class="mt-5 space-y-3 border-b border-gray-100 pb-5">

                            <div class="flex items-start justify-between gap-3 text-sm">
                                <span class="text-gray-500">
                                    Items
                                </span>

                                <span class="text-right font-medium text-slate-900">
                                    {{ $cart->items->count() }} product(s)
                                </span>
                            </div>

                            <div class="flex items-start justify-between gap-3 text-sm">
                                <span class="text-gray-500">
                                    Shipping
                                </span>

                                <span class="text-right text-gray-600">
                                    Calculated at checkout
                                </span>
                            </div>

                        </div>

                        <div class="flex items-start justify-between gap-3 py-5">
                            <span class="text-sm font-semibold text-slate-900 sm:text-base">
                                Subtotal
                            </span>

                            <span
                                id="grandTotal"
                                class="break-words text-right text-xl font-bold text-[#b76e79] sm:text-2xl"
                            >
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                        <a
                            href="{{ route('checkout') }}"
                            class="flex min-h-12 w-full items-center justify-center rounded-xl bg-[#b76e79] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#a45d68] focus:outline-none focus:ring-2 focus:ring-pink-300 focus:ring-offset-2 sm:text-base"
                        >
                            Proceed to Checkout
                            <span aria-hidden="true" class="ml-2">→</span>
                        </a>

                        <p class="mt-4 text-center text-xs leading-relaxed text-gray-500">
                            Shipping fees and payment details will be shown during checkout.
                        </p>

                    </div>

                    <div class="mt-4 rounded-2xl border border-pink-50 bg-white p-4">
                        <div class="flex items-start gap-3">
                            <span class="text-xl" aria-hidden="true">🔒</span>

                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    Secure Checkout
                                </p>

                                <p class="mt-1 text-xs leading-relaxed text-gray-500">
                                    Review your order details before confirming your purchase.
                                </p>
                            </div>
                        </div>
                    </div>

                </aside>

            </div>

        @else

            {{-- EMPTY CART --}}
            <section class="rounded-2xl border border-pink-50 bg-white px-5 py-14 text-center shadow-sm sm:rounded-3xl sm:px-8 sm:py-20">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-pink-50 text-4xl">
                    🛍️
                </div>

                <h2 class="mt-5 text-xl font-bold text-slate-900 sm:text-2xl">
                    Your Cart Is Empty
                </h2>

                <p class="mx-auto mt-3 max-w-md text-sm leading-relaxed text-gray-500 sm:text-base">
                    You haven't added any products yet. Explore our collection and find something you love.
                </p>

                <a
                    href="{{ route('shop') }}"
                    class="mt-6 inline-flex min-h-11 items-center justify-center rounded-xl bg-[#b76e79] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#a45d68]"
                >
                    Explore Products
                </a>

            </section>

        @endif

    </main>
</div>


{{-- CART QUANTITY CONTROLS --}}
@if($cart && $cart->items->count() > 0)
<script>
const cartUpdateUrl = @json(route('cart.update.ajax'));
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

function formatRupiah(amount) {
    return 'Rp ' + Number(amount).toLocaleString('id-ID');
}

function updateCartTotals() {
    let total = 0;

    document.querySelectorAll('.qty-input').forEach(function (input) {
        const price = Number(input.dataset.price) || 0;
        const quantity = Number(input.value) || 1;
        const subtotal = price * quantity;

        const item = input.closest('.cart-item');
        const subtotalElement = item?.querySelector('.subtotal');

        if (subtotalElement) {
            subtotalElement.textContent = formatRupiah(subtotal);
        }

        total += subtotal;
    });

    const grandTotal = document.getElementById('grandTotal');

    if (grandTotal) {
        grandTotal.textContent = formatRupiah(total);
    }
}

function setQuantityButtons(input) {
    const item = input.closest('.cart-item');
    if (!item) return;

    const quantity = Number(input.value) || 1;
    const min = Number(input.min) || 1;
    const max = Number(input.max) || min;

    const buttons = item.querySelectorAll('button[onclick^="changeQty"]');

    if (buttons[0]) buttons[0].disabled = quantity <= min;
    if (buttons[1]) buttons[1].disabled = quantity >= max;
}

async function saveCartQuantity(input, requestedQuantity) {
    const previousQuantity = Number(input.dataset.originalQty) || 1;
    const min = Number(input.min) || 1;
    const max = Number(input.max) || min;

    const quantity = Math.max(min, Math.min(max, Number(requestedQuantity) || min));

    input.value = quantity;
    input.disabled = true;

    const item = input.closest('.cart-item');
    const buttons = item?.querySelectorAll('button[onclick^="changeQty"]') || [];

    buttons.forEach(function (button) {
        button.disabled = true;
    });

    try {
        const response = await fetch(cartUpdateUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken || ''
            },
            body: JSON.stringify({
                id: input.dataset.id,
                quantity: quantity
            })
        });

        if (!response.ok) {
            throw new Error('Cart update failed with status ' + response.status);
        }

        const data = await response.json();

        if (data.success === false) {
            throw new Error(data.message || 'Unable to update cart.');
        }

        input.dataset.originalQty = quantity;
        input.value = quantity;

        updateCartTotals();

    } catch (error) {
        input.value = previousQuantity;

        alert('Kuantitas belum berhasil diperbarui. Silakan coba lagi.');

        console.error('Cart update error:', error);

    } finally {
        input.disabled = false;
        setQuantityButtons(input);
    }
}

function changeQty(button, change) {
    const item = button.closest('.cart-item');
    const input = item?.querySelector('.qty-input');

    if (!input || input.disabled) return;

    const currentQuantity = Number(input.value) || 1;
    saveCartQuantity(input, currentQuantity + change);
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.qty-input').forEach(function (input) {
        setQuantityButtons(input);

        input.addEventListener('change', function () {
            saveCartQuantity(input, input.value);
        });
    });
});
</script>
@endif

@endsection