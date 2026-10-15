@extends('layouts.admin.app')

@section('content')

<div class="space-y-6 md:space-y-8">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-[#172033]">
            Welcome Back, {{ auth()->user()->name }} 👋
        </h1>

        <p class="mt-2 text-sm md:text-base text-gray-500">
            Here's what's happening with your store today.
        </p>
    </div>


    {{-- STATISTIC CARD --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">


        <div class="rounded-3xl border border-gray-100 bg-white p-5 md:p-7 shadow-sm">

            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-pink-50 text-xl font-bold text-pink-600">
                P
            </div>

            <p class="mt-5 text-sm text-gray-400">
                Total Products
            </p>

            <h2 class="mt-2 text-3xl font-bold text-[#172033] md:text-4xl">
                {{ $totalProducts }}
            </h2>

            <p class="mt-3 text-xs text-gray-400">
                Available products
            </p>

        </div>



        <div class="rounded-3xl border border-gray-100 bg-white p-5 md:p-7 shadow-sm">

            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-xl font-bold text-blue-600">
                O
            </div>

            <p class="mt-5 text-sm text-gray-400">
                Total Orders
            </p>

            <h2 class="mt-2 text-3xl font-bold text-[#172033] md:text-4xl">
                {{ $totalOrders }}
            </h2>

            <p class="mt-3 text-xs text-gray-400">
                Customer transactions
            </p>

        </div>



        <div class="rounded-3xl bg-[#172033] p-5 md:p-7 text-white shadow-sm">

            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-xl font-bold">
                Rp
            </div>

            <p class="mt-5 text-sm text-gray-300">
                Revenue
            </p>

            <h2 class="mt-2 text-2xl font-bold md:text-3xl">
                Rp {{ number_format($revenue,0,',','.') }}
            </h2>

            <p class="mt-3 text-xs text-pink-300">
                Total sales
            </p>

        </div>


    </div>




    {{-- LOWER SECTION --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


        {{-- RECENT ORDERS --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm md:p-7 lg:col-span-2">


            <div class="mb-6 flex items-center justify-between">

                <h2 class="text-lg font-bold text-[#172033] md:text-xl">
                    Recent Orders
                </h2>


                <a href="/admin/orders"
                   class="text-sm text-pink-600 hover:text-pink-700">
                    View All
                </a>

            </div>



            <div class="space-y-5">


            @foreach($recentOrders as $order)


                <div class="flex flex-col gap-3 border-b border-gray-100 pb-5 sm:flex-row sm:items-center sm:justify-between">


                    <div class="min-w-0">

                        <p class="truncate font-semibold text-[#172033]">
                            #{{ $order->order_number }}
                        </p>


                        <p class="mt-1 text-sm text-gray-500">
                            {{ $order->name }}
                        </p>


                        <p class="text-xs text-gray-400">
                            {{ $order->created_at->format('d M Y') }}
                        </p>


                        <p class="mt-2 text-sm font-medium text-pink-600">
                            Rp {{ number_format($order->subtotal,0,',','.') }}
                        </p>

                    </div>




                    <span class="w-fit rounded-full px-4 py-2 text-xs font-semibold

                    @if($order->order_status=='processing')
                        bg-yellow-100 text-yellow-700

                    @elseif($order->order_status=='shipped')
                        bg-blue-100 text-blue-700

                    @elseif($order->order_status=='completed')
                        bg-green-100 text-green-700

                    @else
                        bg-red-100 text-red-700
                    @endif">

                        {{ ucfirst($order->order_status) }}

                    </span>


                </div>


            @endforeach


            </div>


        </div>






        {{-- TOP PRODUCTS --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm md:p-7">


            <h2 class="mb-6 text-lg font-bold text-[#172033] md:text-xl">
                Top Products
            </h2>



            <div class="space-y-5">


            @foreach($topProducts as $index=>$item)


                <div class="flex items-center justify-between gap-3">


                    <div class="flex min-w-0 items-center gap-3">


                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-pink-50 text-sm font-bold text-pink-600">

                            {{ $index+1 }}

                        </div>


                        <div class="min-w-0">

                            <p class="truncate font-medium text-[#172033]">

                                {{ $item->product->name }}

                            </p>


                            <p class="text-xs text-gray-400">

                                {{ $item->total_sold }} sold

                            </p>


                        </div>


                    </div>


                </div>


            @endforeach


            </div>


        </div>


    </div>


</div>

@endsection