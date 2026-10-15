@extends('layouts.admin.app')

@section('content')

<div class="space-y-8">


    <div>
        <h1 class="text-3xl font-bold text-slate-900">
            Payments
        </h1>

        <p class="mt-2 text-gray-500">
            Manage customer payment transactions.
        </p>
    </div>




    {{-- DESKTOP TABLE --}}
    <div class="hidden overflow-hidden rounded-2xl border bg-white shadow-sm md:block">

        <table class="w-full">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-4 text-left text-sm text-gray-500">
                        Order
                    </th>

                    <th class="px-6 py-4 text-left text-sm text-gray-500">
                        Customer
                    </th>

                    <th class="px-6 py-4 text-left text-sm text-gray-500">
                        Method
                    </th>

                    <th class="px-6 py-4 text-left text-sm text-gray-500">
                        Amount
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

            @foreach($payments as $payment)

                <tr class="border-t hover:bg-gray-50">


                    <td class="px-6 py-5">

                        <p class="font-semibold">
                            #{{ $payment->order_number }}
                        </p>

                        <p class="text-sm text-gray-400">
                            {{ $payment->created_at->format('d M Y') }}
                        </p>

                    </td>



                    <td class="px-6 py-5">

                        {{ $payment->name }}

                    </td>



                    <td class="px-6 py-5">

                        {{ $payment->payment_method }}

                    </td>



                    <td class="px-6 py-5 font-semibold text-pink-600">

                        Rp {{ number_format($payment->subtotal,0,',','.') }}

                    </td>



                    <td class="px-6 py-5">

                        @if($payment->payment_status == 'paid')

                            <span class="rounded-full bg-green-100 px-4 py-2 text-xs text-green-700">
                                Paid
                            </span>

                        @elseif($payment->payment_status == 'failed')

                            <span class="rounded-full bg-red-100 px-4 py-2 text-xs text-red-700">
                                Failed
                            </span>

                        @else

                            <span class="rounded-full bg-yellow-100 px-4 py-2 text-xs text-yellow-700">
                                Pending
                            </span>

                        @endif

                    </td>



                    <td class="px-6 py-5 text-center">

                        <a href="{{ route('admin.payments.show',$payment->id) }}"
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


    @foreach($payments as $payment)


        <div class="rounded-3xl border bg-white p-5 shadow-sm">


            <div class="flex justify-between gap-4">

                <div>

                    <p class="break-all font-bold text-slate-900">
                        #{{ $payment->order_number }}
                    </p>

                    <p class="mt-2 text-sm text-gray-400">
                        {{ $payment->created_at->format('d M Y') }}
                    </p>

                </div>



                @if($payment->payment_status == 'paid')

                    <span class="h-fit rounded-full bg-green-100 px-3 py-1 text-xs text-green-700">
                        Paid
                    </span>

                @elseif($payment->payment_status == 'failed')

                    <span class="h-fit rounded-full bg-red-100 px-3 py-1 text-xs text-red-700">
                        Failed
                    </span>

                @else

                    <span class="h-fit rounded-full bg-yellow-100 px-3 py-1 text-xs text-yellow-700">
                        Pending
                    </span>

                @endif


            </div>




            <div class="mt-5 space-y-3 text-sm">


                <div class="flex justify-between">

                    <span class="text-gray-400">
                        Customer
                    </span>

                    <span class="font-medium">
                        {{ $payment->name }}
                    </span>

                </div>



                <div class="flex justify-between">

                    <span class="text-gray-400">
                        Method
                    </span>

                    <span>
                        {{ $payment->payment_method }}
                    </span>

                </div>



                <div class="flex justify-between">

                    <span class="text-gray-400">
                        Amount
                    </span>

                    <span class="font-bold text-pink-600">

                        Rp {{ number_format($payment->subtotal,0,',','.') }}

                    </span>

                </div>


            </div>




            <a href="{{ route('admin.payments.show',$payment->id) }}"
               class="mt-5 block rounded-xl bg-pink-500 py-3 text-center font-medium text-white">

                View Detail

            </a>


        </div>


    @endforeach


    </div>



</div>

@endsection