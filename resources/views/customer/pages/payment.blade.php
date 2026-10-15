@extends('layouts.customer.app')

@section('content')

{{-- HERO --}}
<section class="bg-[#fff8f7] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 py-20 md:py-24">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-xs tracking-[5px] text-pink-500 font-semibold">
                PAYMENT INFORMATION
            </p>

            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mt-5 leading-tight">
                Flexible & Secure Payment
            </h1>

            <p class="text-gray-500 mt-5 leading-relaxed">
                Choose the payment method that suits your shopping needs.
                BeautyStore provides Cash On Delivery and a credit installment
                simulation to help you plan your purchase.
            </p>

            <div class="flex flex-wrap justify-center gap-3 mt-8">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-pink-100 text-sm text-slate-700">
                    <span class="text-pink-500">✓</span>
                    Cash On Delivery
                </span>

                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-pink-100 text-sm text-slate-700">
                    <span class="text-pink-500">✓</span>
                    Credit Simulation
                </span>
            </div>
        </div>
    </div>
</section>

{{-- PAYMENT METHODS --}}
<section class="bg-white">
    <div class="max-w-7xl mx-auto px-6 py-16 md:py-20">

        <div class="text-center mb-12">
            <p class="text-xs tracking-[4px] text-pink-500 font-semibold">
                CHOOSE YOUR PAYMENT
            </p>

            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-4">
                Payment Methods
            </h2>

            <p class="text-gray-500 mt-4 max-w-2xl mx-auto leading-relaxed">
                Select the payment option that works best for you when
                completing your order.
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 items-stretch">

            {{-- COD CARD --}}
            <div class="rounded-[28px] border border-gray-200 bg-white p-7 md:p-9 shadow-sm hover:shadow-lg transition duration-300 flex flex-col">

                <div class="flex items-start justify-between gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-pink-50 flex items-center justify-center text-3xl">
                        💳
                    </div>

                    <span class="px-3 py-1.5 rounded-full bg-green-50 text-green-700 text-xs font-semibold">
                        Available
                    </span>
                </div>

                <h3 class="text-2xl md:text-3xl font-bold text-slate-900 mt-7">
                    Cash On Delivery
                </h3>

                <p class="text-gray-500 mt-4 leading-relaxed">
                    Pay for your order directly to the courier when your
                    package arrives. No online payment is required during
                    checkout.
                </p>

                <div class="mt-8 space-y-5">

                    <div class="flex gap-4">
                        <div class="w-10 h-10 shrink-0 rounded-full bg-pink-50 text-pink-600 flex items-center justify-center font-bold">
                            1
                        </div>

                        <div>
                            <h4 class="font-semibold text-slate-900">
                                Place Your Order
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                Choose your products and complete checkout.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-10 h-10 shrink-0 rounded-full bg-pink-50 text-pink-600 flex items-center justify-center font-bold">
                            2
                        </div>

                        <div>
                            <h4 class="font-semibold text-slate-900">
                                Receive Your Package
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                Wait for your order to arrive at your address.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-10 h-10 shrink-0 rounded-full bg-pink-50 text-pink-600 flex items-center justify-center font-bold">
                            3
                        </div>

                        <div>
                            <h4 class="font-semibold text-slate-900">
                                Pay Upon Delivery
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                Complete payment to the courier upon receiving
                                your order.
                            </p>
                        </div>
                    </div>

                </div>

                <div class="mt-auto pt-8">
                    <a href="{{ route('shop') }}"
                       class="inline-flex items-center justify-center w-full rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold px-6 py-3.5 transition">
                        Explore Products
                        <span class="ml-2">→</span>
                    </a>
                </div>
            </div>

            {{-- CREDIT SIMULATION CARD --}}
            <div class="rounded-[28px] border border-pink-200 bg-gradient-to-br from-[#fff8fb] via-white to-[#fff1f6] p-7 md:p-9 shadow-sm hover:shadow-lg transition duration-300 flex flex-col relative overflow-hidden">

                <div class="absolute -top-16 -right-16 w-48 h-48 rounded-full bg-pink-100/60 blur-2xl pointer-events-none"></div>

                <div class="relative">
                    <div class="flex items-start justify-between gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-pink-100 flex items-center justify-center text-3xl">
                            📅
                        </div>

                        <span class="px-3 py-1.5 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold">
                            Simulation Only
                        </span>
                    </div>

                    <h3 class="text-2xl md:text-3xl font-bold text-slate-900 mt-7">
                        Credit Simulation
                    </h3>

                    <p class="text-gray-600 mt-4 leading-relaxed">
                        Estimate your monthly installments before placing an
                        order. Choose a simulated installment period of
                        3, 6, or 12 months.
                    </p>

                    <div class="mt-7 rounded-2xl bg-white/90 border border-pink-100 p-5">
                        <p class="text-sm text-gray-500">
                            Simulation interest rate
                        </p>

                        <p class="text-3xl font-bold text-pink-600 mt-1">
                            1% <span class="text-base font-medium text-gray-500">per month</span>
                        </p>

                        <div class="border-t border-gray-100 mt-5 pt-4 space-y-3">
                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-gray-500">Available periods</span>
                                <span class="font-semibold text-slate-900">3, 6, 12 months</span>
                            </div>

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-gray-500">Calculation method</span>
                                <span class="font-semibold text-slate-900">Flat simulation</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-bold text-slate-900">
                            How It Works
                        </h4>

                        <div class="mt-4 space-y-4">

                            <div class="flex gap-3">
                                <span class="text-pink-500 text-lg">✓</span>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Select Credit Simulation during checkout.
                                </p>
                            </div>

                            <div class="flex gap-3">
                                <span class="text-pink-500 text-lg">✓</span>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Choose an installment period of 3, 6,
                                    or 12 months.
                                </p>
                            </div>

                            <div class="flex gap-3">
                                <span class="text-pink-500 text-lg">✓</span>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Review the estimated monthly installment
                                    and total simulated payment.
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="mt-6 rounded-xl bg-amber-50 border border-amber-200 p-4">
                        <p class="text-sm font-semibold text-amber-800">
                            Please note
                        </p>

                        <p class="text-sm text-amber-700 mt-1 leading-relaxed">
                            This feature is for demonstration and calculation
                            purposes only. It does not provide an actual loan,
                            financing approval, or real installment payment.
                        </p>
                    </div>
                </div>

                <div class="mt-auto pt-8 relative">
                    <a href="{{ route('shop') }}"
                       class="inline-flex items-center justify-center w-full rounded-xl bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-3.5 transition shadow-lg shadow-pink-100">
                        Start Shopping
                        <span class="ml-2">→</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- SIMULATION EXAMPLE --}}
<section class="bg-[#fff8f7]">
    <div class="max-w-5xl mx-auto px-6 py-16">

        <div class="text-center">
            <p class="text-xs tracking-[4px] text-pink-500 font-semibold">
                EXAMPLE CALCULATION
            </p>

            <h2 class="text-3xl font-bold text-slate-900 mt-4">
                Understand Your Installments
            </h2>

            <p class="text-gray-500 mt-4 max-w-2xl mx-auto leading-relaxed">
                Here is an example using a product subtotal of
                Rp 300.000 and the current simulation rate of 1% per month.
            </p>
        </div>

        <div class="grid sm:grid-cols-3 gap-5 mt-10">

            {{-- 3 MONTHS --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-6 text-center shadow-sm">
                <p class="text-sm text-gray-500">
                    3 Months
                </p>

                <p class="text-2xl font-bold text-slate-900 mt-3">
                    Rp 103.000
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    Estimated monthly installment
                </p>

                <div class="border-t border-gray-100 mt-5 pt-4">
                    <p class="text-xs text-gray-400">
                        Total simulated payment
                    </p>

                    <p class="font-bold text-pink-600 mt-1">
                        Rp 309.000
                    </p>
                </div>
            </div>

            {{-- 6 MONTHS --}}
            <div class="bg-white border border-pink-200 rounded-2xl p-6 text-center shadow-sm relative">
                <span class="inline-block px-3 py-1 rounded-full bg-pink-50 text-pink-600 text-xs font-semibold mb-3">
                    6-Month Option
                </span>

                <p class="text-sm text-gray-500">
                    6 Months
                </p>

                <p class="text-2xl font-bold text-slate-900 mt-3">
                    Rp 53.000
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    Estimated monthly installment
                </p>

                <div class="border-t border-gray-100 mt-5 pt-4">
                    <p class="text-xs text-gray-400">
                        Total simulated payment
                    </p>

                    <p class="font-bold text-pink-600 mt-1">
                        Rp 318.000
                    </p>
                </div>
            </div>

            {{-- 12 MONTHS --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-6 text-center shadow-sm">
                <p class="text-sm text-gray-500">
                    12 Months
                </p>

                <p class="text-2xl font-bold text-slate-900 mt-3">
                    Rp 33.000
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    Estimated monthly installment
                </p>

                <div class="border-t border-gray-100 mt-5 pt-4">
                    <p class="text-xs text-gray-400">
                        Total simulated payment
                    </p>

                    <p class="font-bold text-pink-600 mt-1">
                        Rp 336.000
                    </p>
                </div>
            </div>

        </div>

        <p class="text-xs text-gray-500 text-center mt-6 leading-relaxed">
            Example only. Figures are calculated using a flat simulated rate
            of 1% per month, with no additional fees included.
            Actual checkout totals depend on the order subtotal and selected period.
        </p>

    </div>
</section>

{{-- IMPORTANT INFORMATION --}}
<section class="bg-white">
    <div class="max-w-5xl mx-auto px-6 py-14">

        <div class="rounded-3xl p-7 md:p-9 border border-gray-200 bg-white shadow-sm">

            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-pink-50 flex items-center justify-center text-xl shrink-0">
                    ℹ️
                </div>

                <div>
                    <h3 class="text-xl font-bold text-slate-900">
                        Important Information
                    </h3>

                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                        Please review the following details before completing
                        your BeautyStore order.
                    </p>
                </div>
            </div>

            <ul class="mt-6 space-y-3 text-sm text-gray-600 leading-relaxed">
                <li class="flex gap-3">
                    <span class="text-pink-500 font-bold">•</span>
                    Ensure your delivery address and contact information are correct.
                </li>

                <li class="flex gap-3">
                    <span class="text-pink-500 font-bold">•</span>
                    For COD orders, prepare the payment amount when your package arrives.
                </li>

                <li class="flex gap-3">
                    <span class="text-pink-500 font-bold">•</span>
                    Credit Simulation is a demonstration feature and does not create an actual financing agreement.
                </li>

                <li class="flex gap-3">
                    <span class="text-pink-500 font-bold">•</span>
                    Credit Simulation orders remain subject to the payment confirmation process in the system.
                </li>
            </ul>

        </div>

    </div>
</section>

@endsection