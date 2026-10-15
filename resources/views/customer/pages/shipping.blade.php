@extends('layouts.customer.app')

@section('content')

{{-- HERO --}}
<section class="bg-[#fff8f7] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 py-20 md:py-24">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-xs tracking-[5px] text-pink-500 font-semibold">
                SHIPPING INFORMATION
            </p>

            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mt-5 leading-tight">
                Fast & Reliable Delivery
            </h1>

            <p class="text-gray-500 mt-5 leading-relaxed">
                We make sure your favorite beauty and fashion products arrive
                safely and conveniently. Follow the steps below to understand
                how your order is processed and delivered.
            </p>
        </div>
    </div>
</section>

{{-- DELIVERY PROCESS --}}
<section class="bg-white">
    <div class="max-w-7xl mx-auto px-6 py-16 md:py-20">

        <div class="text-center mb-12">
            <p class="text-xs tracking-[4px] text-pink-500 font-semibold">
                FROM ORDER TO DOORSTEP
            </p>

            <h2 class="text-3xl font-bold text-slate-900 mt-4">
                How Your Order Arrives
            </h2>

            <p class="text-gray-500 mt-3">
                Four simple steps from checkout to delivery.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- STEP 1 --}}
            <div class="group bg-white border border-gray-200 rounded-3xl p-7 hover:shadow-lg hover:border-pink-200 transition duration-300">
                <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-lg">
                    01
                </div>

                <h3 class="font-bold text-lg text-slate-900 mt-6">
                    Order Confirmed
                </h3>

                <p class="text-sm text-gray-500 mt-3 leading-relaxed">
                    Your order is received and recorded by the BeautyStore system.
                </p>
            </div>

            {{-- STEP 2 --}}
            <div class="group bg-white border border-gray-200 rounded-3xl p-7 hover:shadow-lg hover:border-pink-200 transition duration-300">
                <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-lg">
                    02
                </div>

                <h3 class="font-bold text-lg text-slate-900 mt-6">
                    Product Preparation
                </h3>

                <p class="text-sm text-gray-500 mt-3 leading-relaxed">
                    Products are checked and prepared for packaging before shipment.
                </p>
            </div>

            {{-- STEP 3 --}}
            <div class="group bg-white border border-gray-200 rounded-3xl p-7 hover:shadow-lg hover:border-pink-200 transition duration-300">
                <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-lg">
                    03
                </div>

                <h3 class="font-bold text-lg text-slate-900 mt-6">
                    Shipment
                </h3>

                <p class="text-sm text-gray-500 mt-3 leading-relaxed">
                    Your package is handed over for delivery to the address provided.
                </p>
            </div>

            {{-- STEP 4 --}}
            <div class="group bg-white border border-gray-200 rounded-3xl p-7 hover:shadow-lg hover:border-pink-200 transition duration-300">
                <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-lg">
                    04
                </div>

                <h3 class="font-bold text-lg text-slate-900 mt-6">
                    Delivered
                </h3>

                <p class="text-sm text-gray-500 mt-3 leading-relaxed">
                    Receive your package and check the products you ordered.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- SHIPPING BENEFITS --}}
<section class="bg-[#fff8f7]">
    <div class="max-w-7xl mx-auto px-6 py-16">

        <div class="text-center mb-10">
            <p class="text-xs tracking-[4px] text-pink-500 font-semibold">
                THE BEAUTYSTORE EXPERIENCE
            </p>

            <h2 class="text-3xl font-bold text-slate-900 mt-4">
                Care at Every Step
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-white border border-white rounded-3xl p-8 hover:shadow-md transition">
                <div class="w-14 h-14 rounded-2xl bg-pink-50 flex items-center justify-center text-3xl">
                    📦
                </div>

                <h3 class="font-bold text-xl text-slate-900 mt-5">
                    Careful Packaging
                </h3>

                <p class="text-gray-500 mt-3 text-sm leading-relaxed">
                    Products are prepared and packed carefully to help protect
                    them during handling and delivery.
                </p>
            </div>

            <div class="bg-white border border-white rounded-3xl p-8 hover:shadow-md transition">
                <div class="w-14 h-14 rounded-2xl bg-pink-50 flex items-center justify-center text-3xl">
                    🚚
                </div>

                <h3 class="font-bold text-xl text-slate-900 mt-5">
                    Delivery Process
                </h3>

                <p class="text-gray-500 mt-3 text-sm leading-relaxed">
                    Your order is prepared for delivery to the shipping address
                    entered during checkout.
                </p>
            </div>

            <div class="bg-white border border-white rounded-3xl p-8 hover:shadow-md transition">
                <div class="w-14 h-14 rounded-2xl bg-pink-50 flex items-center justify-center text-3xl">
                    🔎
                </div>

                <h3 class="font-bold text-xl text-slate-900 mt-5">
                    Order Information
                </h3>

                <p class="text-gray-500 mt-3 text-sm leading-relaxed">
                    Review your order details and payment status through your
                    BeautyStore account.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- SHIPPING INFORMATION --}}
<section class="bg-white">
    <div class="max-w-5xl mx-auto px-6 py-14">

        <div class="bg-slate-900 rounded-3xl p-8 md:p-10 text-white shadow-xl">

            <p class="text-xs tracking-[4px] text-pink-300 font-semibold">
                BEFORE YOUR ORDER ARRIVES
            </p>

            <h2 class="text-2xl md:text-3xl font-bold mt-4">
                Shipping Information
            </h2>

            <p class="text-gray-300 mt-3 leading-relaxed max-w-2xl">
                Please make sure your order details are correct so your
                package can be processed properly.
            </p>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-9">

                <div>
                    <p class="text-gray-400 text-sm">
                        Estimated Processing
                    </p>

                    <p class="mt-2 font-semibold">
                        1–2 Business Days
                    </p>
                </div>

                <div>
                    <p class="text-gray-400 text-sm">
                        Delivery Area
                    </p>

                    <p class="mt-2 font-semibold">
                        Indonesia
                    </p>
                </div>

                <div>
                    <p class="text-gray-400 text-sm">
                        Payment Options
                    </p>

                    <p class="mt-2 font-semibold">
                        COD & Credit Simulation
                    </p>
                </div>

            </div>

            <div class="border-t border-white/10 mt-8 pt-6">
                <h3 class="font-semibold">
                    A few things to remember
                </h3>

                <ul class="mt-4 space-y-3 text-sm text-gray-300 leading-relaxed">
                    <li class="flex gap-3">
                        <span class="text-pink-300">✓</span>
                        Check your name, phone number, and delivery address before checkout.
                    </li>

                    <li class="flex gap-3">
                        <span class="text-pink-300">✓</span>
                        For COD orders, prepare the payment amount when the package arrives.
                    </li>

                    <li class="flex gap-3">
                        <span class="text-pink-300">✓</span>
                        Credit Simulation is a demonstration feature, not an actual financing service.
                    </li>

                    <li class="flex gap-3">
                        <span class="text-pink-300">✓</span>
                        Payment status is managed through the BeautyStore system.
                    </li>
                </ul>
            </div>

            <div class="mt-8">
                <a href="{{ route('shop') }}"
                   class="inline-flex items-center justify-center rounded-xl bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-3.5 transition">
                    Browse Products
                    <span class="ml-2">→</span>
                </a>
            </div>

        </div>
    </div>
</section>

@endsection