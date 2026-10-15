@extends('layouts.admin.app')

@section('content')

<div class="space-y-8">


    {{-- HEADER --}}
    <div>

        <h1 class="text-3xl font-bold text-[#172033]">
            Orders
        </h1>

        <p class="mt-2 text-gray-500">
            Manage customer orders and update order status.
        </p>

    </div>





    {{-- DESKTOP TABLE --}}
    <div class="hidden overflow-hidden rounded-2xl border bg-white shadow-sm md:block">

        <table class="w-full">

            <thead class="border-b bg-gray-50">

                <tr>

                    <th class="px-6 py-4 text-left text-sm text-gray-500">
                        Order
                    </th>

                    <th class="px-6 py-4 text-left text-sm text-gray-500">
                        Customer
                    </th>

                    <th class="px-6 py-4 text-left text-sm text-gray-500">
                        Total
                    </th>

                    <th class="px-6 py-4 text-left text-sm text-gray-500">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center text-sm text-gray-500">
                        Action
                    </th>

                </tr>

            </thead>


            <tbody>

            @foreach($orders as $order)

                <tr class="border-b hover:bg-gray-50">


                    <td class="px-6 py-5">

                        <p class="font-semibold">
                            #{{ $order->order_number }}
                        </p>

                        <p class="mt-1 text-sm text-gray-400">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </p>

                    </td>



                    <td class="px-6 py-5">

                        <p class="font-medium">
                            {{ $order->name }}
                        </p>

                        <p class="text-sm text-gray-400">
                            {{ $order->email }}
                        </p>

                    </td>



                    <td class="px-6 py-5 font-semibold text-pink-600">

                        Rp {{ number_format($order->subtotal,0,',','.') }}

                    </td>



                    <td class="px-6 py-5">

                        <span class="rounded-full px-4 py-2 text-xs font-semibold

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

                    </td>



                    <td class="px-6 py-5 text-center">

                        <a href="{{ route('orders.show',$order->id) }}"
                           class="rounded-xl bg-pink-600 px-5 py-2 text-sm text-white hover:bg-pink-700">

                            Detail

                        </a>

                    </td>


                </tr>


            @endforeach


            </tbody>


        </table>


    </div>







    {{-- MOBILE CARD --}}
    <div class="space-y-5 md:hidden">


    @foreach($orders as $order)


        <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm">


            <div class="flex items-start justify-between gap-4">


                <div class="min-w-0">


                    <p class="break-all font-bold text-[#172033]">

                        #{{ $order->order_number }}

                    </p>


                    <p class="mt-2 text-sm text-gray-400">

                        {{ $order->created_at->format('d M Y, H:i') }}

                    </p>


                </div>



                <span class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold

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





            <div class="mt-5 space-y-3 text-sm">


                <div class="flex justify-between">

                    <span class="text-gray-400">
                        Customer
                    </span>

                    <span class="font-medium">
                        {{ $order->name }}
                    </span>

                </div>




                <div class="flex justify-between">

                    <span class="text-gray-400">
                        Total
                    </span>

                    <span class="font-bold text-pink-600">

                        Rp {{ number_format($order->subtotal,0,',','.') }}

                    </span>

                </div>


            </div>





            <a href="{{ route('orders.show',$order->id) }}"
               class="mt-5 block rounded-xl bg-pink-600 py-3 text-center font-medium text-white hover:bg-pink-700">

                View Detail

            </a>



        </div>


    @endforeach


    </div>



</div>


@endsection