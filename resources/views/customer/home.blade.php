@extends('layouts.customer.app')

@section('title', 'BeautyStore - Glow Naturally, Feel Beautiful')

@section('content')

<div class="min-h-screen bg-[#fff9f7]">

    <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 sm:py-10 lg:py-12">

        {{-- HERO --}}
        <section class="mb-12 overflow-hidden rounded-2xl bg-[#f8e9e6] sm:mb-16 sm:rounded-3xl lg:mb-20">
            <div class="grid grid-cols-1 items-center md:grid-cols-2">

                {{-- Hero Content --}}
                <div class="px-6 py-8 sm:px-10 sm:py-12 lg:px-14 lg:py-16">

                    <p class="text-[10px] font-medium uppercase tracking-[0.18em] text-[#b57b7f] sm:text-xs sm:tracking-widest">
                        Premium Beauty Collection
                    </p>

                    <h1 class="mt-4 max-w-xl text-3xl font-bold leading-tight tracking-tight text-slate-900 sm:mt-5 sm:text-4xl lg:text-5xl xl:text-6xl">
                        Glow Naturally,<br class="hidden sm:block">
                        Feel Beautiful.
                    </h1>

                    <p class="mt-4 max-w-lg text-sm leading-relaxed text-gray-600 sm:mt-5 sm:text-base lg:text-lg">
                        Discover skincare and fashion essentials carefully selected to enhance your everyday confidence.
                    </p>

                    <a href="#products"
                       class="mt-6 inline-flex items-center justify-center rounded-full bg-[#b76e79] px-6 py-3 text-sm font-medium text-white transition duration-300 hover:bg-[#a45d68] sm:mt-8 sm:px-8">
                        Shop Collection
                    </a>

                </div>

                {{-- Hero Image --}}
                <div class="relative h-64 overflow-hidden sm:h-80 md:h-full md:min-h-[380px] lg:min-h-[460px]">
                    <img
                        src="{{ asset('storage/banner/hero-beauty.jpg') }}"
                        alt="Premium Beauty Collection"
                        class="h-full w-full object-cover object-center"
                        fetchpriority="high"
                    >
                </div>

            </div>
        </section>


        {{-- CATEGORY --}}
        <section id="category" class="mb-14 scroll-mt-20 sm:mb-16 lg:mb-20">

            <div class="mb-6 text-center sm:mb-10">
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    Explore Collection
                </h2>

                <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-gray-500 sm:text-base">
                    Find your favorite beauty and fashion products
                </p>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6">

                @foreach($categories as $category)

                    <a href="{{ route('shop', ['category' => $category->slug]) }}"
                       class="group flex min-h-[145px] flex-col items-center justify-center rounded-2xl bg-white px-3 py-6 text-center shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:min-h-[165px] sm:rounded-3xl sm:p-7">

                        <div class="mb-3 text-3xl transition duration-300 group-hover:scale-110 sm:mb-4 sm:text-4xl">
                            ✨
                        </div>

                        <h3 class="text-sm font-semibold text-slate-900 sm:text-base">
                            {{ $category->name }}
                        </h3>

                        <p class="mt-2 text-xs text-gray-500 transition group-hover:text-pink-500 sm:text-sm">
                            Explore Collection →
                        </p>

                    </a>

                @endforeach

            </div>

        </section>


        {{-- PRODUCTS --}}
        <section id="products" class="scroll-mt-20">

            <div class="mb-6 sm:mb-8 lg:mb-10">
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    Latest Products
                </h2>

                <p class="mt-2 text-sm text-gray-500 sm:text-base">
                    Our newest beauty selections
                </p>
            </div>

            @if($products->count() > 0)

                <div class="grid grid-cols-2 gap-3 sm:gap-5 lg:grid-cols-4 lg:gap-6">

                    @foreach($products as $product)

                        <article class="flex min-w-0 flex-col overflow-hidden rounded-2xl bg-white shadow-sm transition duration-300 hover:shadow-lg sm:rounded-3xl">

                            {{-- Product Image --}}
                            <a href="{{ route('customer.products.show', $product->slug) }}"
                               class="relative block aspect-square overflow-hidden bg-gray-100 sm:aspect-[4/5]">

                                <img
                                    src="{{ asset('storage/'.$product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="h-full w-full object-cover transition duration-500 hover:scale-105"
                                    loading="lazy"
                                >

                                @if($product->discount_price)
                                    <span class="absolute left-2 top-2 rounded-full bg-[#b76e79] px-2 py-1 text-[9px] font-medium text-white sm:left-3 sm:top-3 sm:px-3 sm:text-xs">
                                        SALE
                                    </span>
                                @endif

                            </a>

                            {{-- Product Information --}}
                            <div class="flex flex-1 flex-col p-3 sm:p-4 lg:p-5">

                                <p class="truncate text-[10px] text-gray-400 sm:text-xs">
                                    {{ $product->category->name ?? 'Beauty & Fashion' }}
                                </p>

                                <h3 class="mt-1 line-clamp-2 min-h-9 text-sm font-semibold leading-snug text-slate-900 sm:mt-2 sm:min-h-12 sm:text-base">
                                    {{ $product->name }}
                                </h3>

                                <div class="mt-2">

                                    @if($product->discount_price)

                                        <p class="text-[10px] text-gray-400 line-through sm:text-xs">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </p>

                                        <p class="text-sm font-bold text-[#b76e79] sm:text-lg">
                                            Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                                        </p>

                                    @else

                                        <p class="text-sm font-bold text-[#b76e79] sm:text-lg">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </p>

                                    @endif

                                </div>

                                <a href="{{ route('customer.products.show', $product->slug) }}"
                                   class="mt-auto inline-flex min-h-9 items-center justify-center rounded-lg border border-pink-300 px-2 py-2 text-center text-[11px] font-medium text-pink-600 transition hover:bg-pink-600 hover:text-white sm:mt-3 sm:min-h-10 sm:rounded-xl sm:text-sm">
                                    View Product
                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="rounded-2xl bg-white px-5 py-12 text-center shadow-sm sm:rounded-3xl">
                    <div class="text-4xl">🛍️</div>

                    <h3 class="mt-4 text-lg font-semibold text-slate-900">
                        Products Coming Soon
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Our latest collections will appear here.
                    </p>
                </div>

            @endif

        </section>


        {{-- BEAUTY PROMISE --}}
        <section class="mt-14 sm:mt-16 lg:mt-20">

            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 sm:gap-5 lg:gap-6">

                <div class="rounded-2xl bg-white px-5 py-6 text-center sm:rounded-3xl sm:p-7">
                    <h3 class="text-sm font-bold text-slate-900 sm:text-base">
                        🌸 Premium Quality
                    </h3>

                    <p class="mt-2 text-xs leading-relaxed text-gray-500 sm:text-sm">
                        Selected products for your beauty routine
                    </p>
                </div>

                <div class="rounded-2xl bg-white px-5 py-6 text-center sm:rounded-3xl sm:p-7">
                    <h3 class="text-sm font-bold text-slate-900 sm:text-base">
                        🌿 Everyday Care
                    </h3>

                    <p class="mt-2 text-xs leading-relaxed text-gray-500 sm:text-sm">
                        Products designed for daily confidence
                    </p>
                </div>

                <div class="rounded-2xl bg-white px-5 py-6 text-center sm:rounded-3xl sm:p-7">
                    <h3 class="text-sm font-bold text-slate-900 sm:text-base">
                        🚚 Fast Delivery
                    </h3>

                    <p class="mt-2 text-xs leading-relaxed text-gray-500 sm:text-sm">
                        Safe and reliable shipping
                    </p>
                </div>

            </div>

        </section>

    </div>

</div>

@endsection