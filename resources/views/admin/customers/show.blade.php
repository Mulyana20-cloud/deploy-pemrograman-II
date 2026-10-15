@extends('layouts.admin.app')

@section('content')

<div class="space-y-8">


    <div class="flex items-center justify-between">

        <h1 class="text-3xl font-bold text-slate-900">
            Customer Detail
        </h1>


        <a href="/admin/customers"
           class="text-sm font-medium text-pink-600">

            ← Back

        </a>

    </div>





    {{-- CUSTOMER INFO --}}
    <div class="rounded-2xl border bg-white p-6 shadow-sm">


        <div class="flex items-center gap-4">


            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-pink-100 text-xl font-bold text-pink-600">

                {{ strtoupper(substr($customer->name,0,1)) }}

            </div>



            <div>

                <h2 class="text-xl font-bold">
                    {{ $customer->name }}
                </h2>

                <p class="text-gray-400">
                    {{ $customer->email }}
                </p>

            </div>


        </div>




        <div class="mt-6 space-y-3">


            <div class="flex justify-between">

                <span class="text-gray-400">
                    Total Order
                </span>

                <span class="font-semibold">

                    {{ $customer->orders_count ?? $customer->orders->count() }}

                </span>

            </div>



            <div class="flex justify-between">

                <span class="text-gray-400">
                    Total Spending
                </span>

                <span class="font-bold text-pink-600">

                    Rp {{ number_format($customer->orders_sum_subtotal ?? 0,0,',','.') }}

                </span>

            </div>


        </div>


    </div>





    {{-- ORDER HISTORY --}}
    <div class="rounded-2xl border bg-white p-6 shadow-sm">


        <h2 class="mb-5 text-xl font-bold">
            Order History
        </h2>



        <div class="space-y-4">


        @foreach($customer->orders as $order)


            <div class="rounded-xl border p-4">


                <div class="flex justify-between gap-4">


                    <div>

                        <p class="font-semibold">
                            #{{ $order->order_number }}
                        </p>

                        <p class="text-sm text-gray-400">
                            {{ $order->created_at->format('d M Y') }}
                        </p>

                    </div>



                    <p class="font-semibold text-pink-600">

                        Rp {{ number_format($order->subtotal,0,',','.') }}

                    </p>


                </div>


            </div>


        @endforeach


        </div>


    </div>



</div>

@endsection