@extends('layouts.admin.app')

@section('content')

<div class="space-y-8">


    <div class="flex items-start justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-slate-900">
                Payment Detail
            </h1>

            <p class="mt-2 text-gray-500">
                Review and update payment status.
            </p>

        </div>


        <a href="/admin/payments"
           class="text-sm font-medium text-pink-600">

            ← Back

        </a>

    </div>





    <div class="grid gap-6 lg:grid-cols-3">


        {{-- PAYMENT INFORMATION --}}
        <div class="rounded-2xl border bg-white p-6 shadow-sm lg:col-span-2">


            <div class="flex items-start justify-between gap-4">


                <div>

                    <p class="text-sm text-gray-400">
                        Order Number
                    </p>

                    <h2 class="mt-1 text-xl font-bold">
                        #{{ $order->order_number }}
                    </h2>

                </div>



                <span class="rounded-full px-4 py-2 text-xs

                @if($order->payment_status=='paid')
                    bg-green-100 text-green-700
                @elseif($order->payment_status=='failed')
                    bg-red-100 text-red-700
                @else
                    bg-yellow-100 text-yellow-700
                @endif">

                    {{ ucfirst($order->payment_status) }}

                </span>


            </div>



            <hr class="my-6">



            <div class="space-y-5 text-sm">


                <div>

                    <p class="text-gray-400">
                        Customer
                    </p>

                    <p class="font-semibold">
                        {{ $order->name }}
                    </p>

                </div>



                <div>

                    <p class="text-gray-400">
                        Payment Method
                    </p>

                    <p class="font-semibold">
                        {{ $order->payment_method }}
                    </p>

                </div>



                <div>

                    <p class="text-gray-400">
                        Total Payment
                    </p>

                    <p class="text-xl font-bold text-pink-600">

                        Rp {{ number_format($order->subtotal,0,',','.') }}

                    </p>

                </div>


            </div>


        </div>






        {{-- UPDATE STATUS --}}
        <div class="rounded-2xl border bg-white p-6 shadow-sm">


            <h2 class="mb-5 font-bold text-lg">
                Update Payment
            </h2>


            <form method="POST"
                  action="{{ route('admin.payments.update',$order->id) }}">

                @csrf
                @method('PUT')


                <label class="text-sm text-gray-500">
                    Payment Status
                </label>


                <select name="payment_status"
                        class="mt-2 w-full rounded-xl border px-4 py-3">


                    <option value="pending"
                    {{ $order->payment_status=='pending'?'selected':'' }}>
                        Pending
                    </option>


                    <option value="paid"
                    {{ $order->payment_status=='paid'?'selected':'' }}>
                        Paid
                    </option>


                    <option value="failed"
                    {{ $order->payment_status=='failed'?'selected':'' }}>
                        Failed
                    </option>


                </select>



                <button
                    class="mt-5 w-full rounded-xl bg-pink-500 py-3 font-semibold text-white hover:bg-pink-600">

                    Update Status

                </button>


            </form>


        </div>


    </div>


</div>

@endsection