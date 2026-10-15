@extends('layouts.admin.app')

@section('content')

<div class="space-y-8">


    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-900">
                Order Detail
            </h1>

            <p class="mt-2 text-gray-500">
                Manage customer order information.
            </p>

        </div>


        <a href="{{ route('orders.index') }}"
           class="text-sm font-medium text-pink-600 hover:text-pink-700">

            ← Back to Orders

        </a>

    </div>





    {{-- CUSTOMER + SUMMARY --}}
    <div class="grid gap-6 lg:grid-cols-2">



        {{-- CUSTOMER INFORMATION --}}
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">


            <div class="mb-6 flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-pink-100 text-lg font-bold text-pink-600">

                    {{ strtoupper(substr($order->name,0,1)) }}

                </div>


                <div>

                    <h2 class="text-lg font-bold">
                        Customer Information
                    </h2>

                    <p class="text-sm text-gray-400">
                        Buyer Details
                    </p>

                </div>

            </div>



            <div class="space-y-4 text-sm">


                <div>
                    <p class="text-gray-400">
                        Name
                    </p>

                    <p class="font-semibold">
                        {{ $order->name }}
                    </p>
                </div>



                <div>
                    <p class="text-gray-400">
                        Email
                    </p>

                    <p>
                        {{ $order->email }}
                    </p>
                </div>



                <div>
                    <p class="text-gray-400">
                        Phone
                    </p>

                    <p>
                        {{ $order->phone }}
                    </p>
                </div>



                <div>
                    <p class="text-gray-400">
                        Address
                    </p>

                    <p class="leading-relaxed">
                        {{ $order->address }}
                    </p>
                </div>


            </div>


        </div>







        {{-- ORDER SUMMARY --}}
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">


            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">


                <div>

                    <h2 class="text-lg font-bold">
                        Order Summary
                    </h2>

                    <p class="text-sm text-gray-400">
                        Transaction Information
                    </p>

                </div>


                @include('admin.orders.status-badge', [
                    'status'=>$order->order_status
                ])


            </div>





            <div class="mt-6 space-y-4 text-sm">


                <div class="flex justify-between gap-4">

                    <span class="text-gray-400">
                        Order Number
                    </span>

                    <span class="font-semibold">
                        #{{ $order->order_number }}
                    </span>

                </div>



                <div class="flex justify-between gap-4">

                    <span class="text-gray-400">
                        Payment
                    </span>

                    <span>
                        {{ $order->payment_method }}
                    </span>

                </div>




                <div class="flex justify-between gap-4">

                    <span class="text-gray-400">
                        Date
                    </span>

                    <span>
                        {{ $order->created_at->format('d M Y, H:i') }}
                    </span>

                </div>




                <div class="flex justify-between border-t pt-4">

                    <span class="font-bold">
                        Total
                    </span>


                    <span class="text-xl font-bold text-pink-600">

                        Rp {{ number_format($order->subtotal,0,',','.') }}

                    </span>

                </div>


            </div>






            {{-- UPDATE STATUS --}}

            <form method="POST"
                  action="{{ route('orders.update',$order->id) }}"
                  class="mt-6 flex flex-col gap-3 sm:flex-row">

                @csrf
                @method('PUT')


                <select
                    name="order_status"
                    class="flex-1 rounded-xl border px-4 py-3">

                    <option value="processing"
                    {{ $order->order_status == 'processing' ? 'selected' : '' }}>

                        Processing

                    </option>


                    <option value="shipped"
                    {{ $order->order_status == 'shipped' ? 'selected' : '' }}>

                        Shipped

                    </option>


                    <option value="completed"
                    {{ $order->order_status == 'completed' ? 'selected' : '' }}>

                        Completed

                    </option>


                </select>



                <button
                    type="submit"
                    class="rounded-xl bg-pink-600 px-6 py-3 text-white transition hover:bg-pink-700">

                    Update

                </button>


            </form>


        </div>


    </div>







    {{-- PRODUCTS --}}
    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">


        <h2 class="mb-6 text-xl font-bold">
            Products
        </h2>





        {{-- DESKTOP TABLE --}}
        <div class="hidden overflow-x-auto md:block">

            <table class="w-full">


                <thead>

                    <tr class="border-b text-left text-sm text-gray-400">

                        <th class="pb-4">
                            Product
                        </th>

                        <th>
                            Qty
                        </th>

                        <th>
                            Price
                        </th>

                        <th>
                            Subtotal
                        </th>

                    </tr>

                </thead>



                <tbody>


                @foreach($order->items as $item)


                    <tr class="border-b">


                        <td class="py-5 font-medium">
                            {{ $item->product->name }}
                        </td>


                        <td>
                            {{ $item->quantity }}
                        </td>


                        <td>
                            Rp {{ number_format($item->price,0,',','.') }}
                        </td>


                        <td class="font-semibold">

                            Rp {{ number_format($item->subtotal,0,',','.') }}

                        </td>


                    </tr>


                @endforeach


                </tbody>


            </table>


        </div>







        {{-- MOBILE PRODUCT CARD --}}
        <div class="space-y-4 md:hidden">


        @foreach($order->items as $item)


            <div class="rounded-xl border p-4">


                <h3 class="font-semibold">
                    {{ $item->product->name }}
                </h3>



                <div class="mt-3 space-y-2 text-sm">


                    <div class="flex justify-between">

                        <span class="text-gray-400">
                            Quantity
                        </span>

                        <span>
                            {{ $item->quantity }}
                        </span>

                    </div>



                    <div class="flex justify-between">

                        <span class="text-gray-400">
                            Price
                        </span>

                        <span>
                            Rp {{ number_format($item->price,0,',','.') }}
                        </span>

                    </div>



                    <div class="flex justify-between border-t pt-2">

                        <span class="font-semibold">
                            Subtotal
                        </span>

                        <span class="font-bold text-pink-600">

                            Rp {{ number_format($item->subtotal,0,',','.') }}

                        </span>

                    </div>


                </div>


            </div>


        @endforeach


        </div>



    </div>


</div>


@endsection