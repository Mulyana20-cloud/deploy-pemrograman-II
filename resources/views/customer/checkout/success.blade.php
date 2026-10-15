@extends('layouts.customer.app')


@section('content')


<div class="min-h-screen bg-[#fff9f7]">

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-10 sm:py-16">


<div class="
bg-white
rounded-3xl
shadow-sm
p-6
sm:p-10
text-center
">


<div class="text-5xl sm:text-6xl mb-6">
🌸
</div>



<h1 class="
text-2xl
sm:text-3xl
font-bold
text-slate-900
">

Thank You For Your Order

</h1>




<p class="
text-gray-500
mt-3
text-sm
sm:text-base
">

Your order has been successfully created.

</p>






{{-- ORDER INFORMATION --}}

<div class="
mt-8
bg-[#fff9f7]
rounded-2xl
p-5
sm:p-6
text-left
space-y-5
">



<div>

<p class="text-xs text-gray-400 uppercase tracking-wide">
Order Number
</p>


<p class="
mt-2
font-bold
text-slate-900
break-all
">

{{ $order->order_number }}

</p>

</div>





<div>

<p class="text-xs text-gray-400 uppercase tracking-wide">
Total Payment
</p>


<p class="
mt-2
font-bold
text-pink-600
text-xl
">

Rp {{ number_format($order->subtotal,0,',','.') }}

</p>

</div>






<div>

<p class="text-xs text-gray-400 uppercase tracking-wide">
Payment Method
</p>


<p class="mt-2 font-semibold text-slate-900">


@if($order->payment_method == 'COD')

Cash On Delivery (COD)

@else

Credit Simulation

@endif


</p>

</div>





@if($order->credit_simulation)


<div class="
border-t
pt-5
space-y-4
">


<p class="
font-semibold
text-slate-900
">

Credit Simulation

</p>




<div class="flex justify-between text-sm">

<span class="text-gray-500">
Installment Period
</span>


<strong>

{{ $order->installment_months }} Months

</strong>

</div>





<div class="flex justify-between text-sm">

<span class="text-gray-500">
Monthly Installment
</span>


<strong class="text-pink-600">

Rp {{ number_format($order->installment_amount,0,',','.') }}

</strong>

</div>



</div>


@endif





<div class="
border-t
pt-5
grid
grid-cols-1
sm:grid-cols-2
gap-4
">



<div>

<p class="text-xs text-gray-400 uppercase">
Order Status
</p>


<p class="mt-2 font-semibold text-slate-900">

{{ ucfirst($order->order_status) }}

</p>


</div>




<div>

<p class="text-xs text-gray-400 uppercase">
Payment Status
</p>


<p class="mt-2 font-semibold text-slate-900">

{{ ucfirst($order->payment_status) }}

</p>


</div>



</div>





</div>








<a
href="{{ url('/shop') }}"
class="
inline-flex
items-center
justify-center
w-full
sm:w-auto
mt-8
bg-pink-600
hover:bg-pink-700
text-white
px-8
py-3
rounded-xl
font-semibold
transition
">


Continue Shopping


</a>





</div>


</div>


</div>


@endsection