@extends('layouts.admin.app')

@section('content')

<div class="space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-slate-900">
            Customers
        </h1>

        <p class="mt-2 text-gray-500">
            Manage registered customers.
        </p>
    </div>



    {{-- DESKTOP TABLE --}}
    <div class="hidden overflow-hidden rounded-2xl border bg-white shadow-sm md:block">

        <table class="w-full">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-4 text-left">
                        Customer
                    </th>

                    <th class="px-6 py-4 text-left">
                        Email
                    </th>

                    <th class="px-6 py-4 text-left">
                        Orders
                    </th>

                    <th class="px-6 py-4 text-left">
                        Total Spent
                    </th>

                    <th class="px-6 py-4 text-center">
                        Action
                    </th>

                </tr>

            </thead>


            <tbody>

            @foreach($customers as $customer)

                <tr class="border-t hover:bg-gray-50">


                    <td class="px-6 py-5">

                        <p class="font-semibold text-slate-900">
                            {{ $customer->name }}
                        </p>

                        <p class="text-sm text-gray-400">
                            Joined {{ $customer->created_at->format('M Y') }}
                        </p>

                    </td>



                    <td class="px-6 py-5">
                        {{ $customer->email }}
                    </td>



                    <td class="px-6 py-5">
                        {{ $customer->orders_count }} Order(s)
                    </td>



                    <td class="px-6 py-5 font-semibold text-pink-600">

                        Rp {{ number_format($customer->orders_sum_subtotal ?? 0,0,',','.') }}

                    </td>



                    <td class="px-6 py-5 text-center">

                        <a href="{{ route('admin.customers.show',$customer->id) }}"
                           class="rounded-xl bg-pink-500 px-5 py-2 text-sm text-white hover:bg-pink-600">

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


    @foreach($customers as $customer)


        <div class="rounded-3xl border bg-white p-5 shadow-sm">


            <div class="flex items-center gap-4">


                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-pink-100 font-bold text-pink-600">

                    {{ strtoupper(substr($customer->name,0,1)) }}

                </div>



                <div>

                    <h3 class="font-bold text-slate-900">
                        {{ $customer->name }}
                    </h3>

                    <p class="text-sm text-gray-400 break-all">
                        {{ $customer->email }}
                    </p>

                </div>


            </div>




            <div class="mt-5 space-y-3 text-sm">


                <div class="flex justify-between">

                    <span class="text-gray-400">
                        Orders
                    </span>

                    <span class="font-medium">
                        {{ $customer->orders_count }}
                    </span>

                </div>



                <div class="flex justify-between">

                    <span class="text-gray-400">
                        Total Spent
                    </span>

                    <span class="font-bold text-pink-600">

                        Rp {{ number_format($customer->orders_sum_subtotal ?? 0,0,',','.') }}

                    </span>

                </div>


            </div>



            <a href="{{ route('admin.customers.show',$customer->id) }}"
               class="mt-5 block rounded-xl bg-pink-500 py-3 text-center font-medium text-white">

                View Detail

            </a>


        </div>


    @endforeach


    </div>


</div>

@endsection