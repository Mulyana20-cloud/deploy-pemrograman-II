@extends('layouts.customer.app')


@section('content')


<div class="min-h-screen bg-[#fff9f7]">

<div class="max-w-6xl mx-auto px-4 sm:px-6 py-10 sm:py-16">


<h1 class="
text-2xl
sm:text-3xl
font-bold
text-[#172033]
mb-8
">

My Orders

</h1>



@if($orders->count())


<div class="space-y-5">


@foreach($orders as $order)


<div class="
bg-white
rounded-3xl
border
border-gray-100
p-5
sm:p-8
shadow-sm
">



<div class="
flex
flex-col
sm:flex-row
sm:justify-between
gap-5
">


<div>


<p class="text-xs text-gray-400 uppercase">
Order Number
</p>


<h2 class="
font-bold
text-base
sm:text-xl
mt-2
break-all
">

#{{ $order->order_number }}

</h2>


<p class="text-sm text-gray-500 mt-2">

{{ $order->created_at->format('d M Y, H:i') }}

</p>


</div>





<div class="
sm:text-right
">


<p class="
text-xl
font-bold
text-pink-600
">

Rp {{ number_format($order->subtotal,0,',','.') }}

</p>



<span class="
inline-flex
mt-3
px-4
py-2
rounded-full
text-sm
font-semibold


@if($order->order_status=='processing')
bg-yellow-100 text-yellow-700

@elseif($order->order_status=='completed')
bg-green-100 text-green-700

@else
bg-gray-100 text-gray-700

@endif

">


{{ ucfirst($order->order_status) }}


</span>


</div>


</div>





<div class="
border-t
my-5
">


</div>





<div class="
flex
flex-col
sm:flex-row
sm:justify-between
sm:items-center
gap-4
">


<div class="text-gray-600 text-sm">


{{ $order->items->count() }} Product(s)


@if($order->credit_simulation)

<span class="text-pink-600">
• Credit Simulation
</span>

@endif


</div>





<a href="{{ route('customer.orders.show',$order->id) }}"
class="
w-full
sm:w-auto
text-center
bg-pink-600
hover:bg-pink-700
text-white
px-6
py-3
rounded-xl
transition
">


View Detail


</a>



</div>




</div>



@endforeach



</div>



@else


<div class="
bg-white
rounded-3xl
p-10
text-center
">


<h2 class="text-xl font-bold">

No Order Found

</h2>


<a href="{{route('shop')}}"
class="
inline-block
mt-5
bg-pink-600
text-white
px-6
py-3
rounded-xl
">

Shopping Now

</a>


</div>


@endif



</div>

</div>


@endsection