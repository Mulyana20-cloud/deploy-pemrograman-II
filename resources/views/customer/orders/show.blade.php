@extends('layouts.customer.app')


@section('content')


<div class="min-h-screen bg-gray-50">

<div class="max-w-6xl mx-auto px-5 md:px-6 py-10 md:py-16">


{{-- HEADER --}}

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">


<div>

<h1 class="text-2xl md:text-3xl font-bold text-slate-900">
Order Detail
</h1>


<p class="text-gray-500 mt-2 text-sm md:text-base">
Order #{{ $order->order_number }}
</p>


</div>




<a href="{{ route('customer.orders.index') }}"
class="
inline-flex
items-center
text-pink-600
font-semibold
text-sm
hover:text-pink-700
">


← Back to Orders


</a>



</div>







<div class="grid lg:grid-cols-3 gap-6">






{{-- LEFT CONTENT --}}


<div class="lg:col-span-2 space-y-6">





{{-- ORDER INFO --}}

<div class="
bg-white
rounded-3xl
p-6
md:p-8
shadow-sm
">


<div class="flex flex-col sm:flex-row sm:justify-between gap-4">



<div>


<p class="text-xs uppercase tracking-wide text-gray-400">
Order Number
</p>


<h2 class="font-bold text-lg md:text-xl mt-1 break-all">

#{{ $order->order_number }}

</h2>



<p class="text-sm text-gray-500 mt-2">

{{ $order->created_at->format('d M Y, H:i') }}

</p>


</div>





<span class="
inline-flex
w-fit
items-center
px-4
py-2
rounded-full
text-xs
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









{{-- PRODUCTS --}}


<div class="
bg-white
rounded-3xl
p-6
md:p-8
shadow-sm
">


<h2 class="font-bold text-xl mb-6">

Products

</h2>




<div class="space-y-5">


@foreach($order->items as $item)



<div class="
flex
justify-between
gap-4
border-b
pb-5
">


<div>


<h3 class="
font-semibold
text-slate-900
">

{{ $item->product->name }}

</h3>



<p class="text-sm text-gray-500 mt-1">

Quantity : {{ $item->quantity }}

</p>



</div>





<div class="
text-right
font-semibold
text-slate-900
whitespace-nowrap
">


Rp {{ number_format(
$item->price*$item->quantity,
0,
',',
'.'
) }}



</div>




</div>



@endforeach



</div>








<div class="
flex
justify-between
items-center
mt-8
text-lg
font-bold
">


<span>

Total

</span>



<span class="text-pink-600">

Rp {{ number_format(
$order->subtotal,
0,
',',
'.'
) }}

</span>



</div>



</div>





</div>








{{-- RIGHT CONTENT --}}


<div class="space-y-6">





{{-- SHIPPING --}}


<div class="
bg-white
rounded-3xl
p-6
shadow-sm
">


<h2 class="font-bold text-lg mb-5">

Shipping Information

</h2>



<div class="space-y-2 text-sm">


<p class="text-gray-700">

{{ $order->name }}

</p>



<p class="text-gray-700">

{{ $order->phone }}

</p>



<p class="text-gray-500 leading-relaxed pt-2">

{{ $order->address }}

</p>


</div>


</div>








{{-- PAYMENT --}}


<div class="
bg-white
rounded-3xl
p-6
shadow-sm
">


<h2 class="font-bold text-lg mb-5">

Payment

</h2>




<p class="text-gray-700">

{{ $order->payment_method }}

</p>



<div class="mt-4">


<p class="text-sm text-gray-500">

Payment Status

</p>


<span class="
inline-block
mt-2
px-4
py-2
rounded-full
bg-yellow-100
text-yellow-700
text-sm
font-semibold
">

{{ ucfirst($order->payment_status) }}

</span>



</div>



</div>






</div>



</div>





</div>

</div>



@endsection