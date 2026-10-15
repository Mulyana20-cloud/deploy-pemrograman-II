@extends('layouts.customer.app')


@section('content')


<div class="bg-[#fff8f6] min-h-screen py-20">


<div class="max-w-7xl mx-auto px-6">





<!-- HEADER -->

<div class="text-center mb-16">


<p class="
text-sm
uppercase
tracking-[0.3em]
text-pink-500
mb-4
">

Beauty Collection

</p>



<h1 class="
text-4xl
md:text-5xl
font-bold
text-[#172033]
">

Explore Categories

</h1>



<p class="
text-gray-500
mt-4
max-w-xl
mx-auto
">

Discover our curated beauty and fashion collections.

</p>



</div>









<!-- CATEGORY GRID -->


<div class="
grid
sm:grid-cols-2
lg:grid-cols-3
gap-8
">





@forelse($categories as $category)





<a href="{{ url('/shop?category='.$category->id) }}"

class="
group
bg-white
rounded-3xl
overflow-hidden
border
border-gray-100
shadow-sm
hover:shadow-xl
hover:-translate-y-2
transition
duration-300
">







<!-- IMAGE -->


<div class="
relative
h-64
overflow-hidden
bg-gradient-to-br
from-pink-50
to-gray-100
">



@if($category->image)


<img

src="{{ asset('storage/'.$category->image) }}"

alt="{{ $category->name }}"

class="
w-full
h-full
object-cover
group-hover:scale-110
transition
duration-500
"


>


@else


<div class="
w-full
h-full
flex
items-center
justify-center
">


<div class="
w-24
h-24
rounded-full
bg-pink-100
flex
items-center
justify-center
text-4xl
">

✨

</div>


</div>



@endif





<!-- OVERLAY -->


<div class="
absolute
inset-0
bg-gradient-to-t
from-black/20
to-transparent
opacity-0
group-hover:opacity-100
transition
">

</div>



</div>









<!-- CONTENT -->


<div class="p-7">



<div class="
flex
justify-between
items-start
mb-4
">



<h2 class="
text-xl
font-bold
text-[#172033]
">

{{ $category->name }}

</h2>



<span class="
text-xs
bg-pink-50
text-pink-600
px-3
py-1
rounded-full
">

{{ $category->products_count }} Products

</span>



</div>





<p class="
text-gray-400
text-sm
mb-5
">

Explore our {{ strtolower($category->name) }} collection

</p>







<span class="
text-pink-600
font-semibold
text-sm
group-hover:text-pink-700
transition
">

View Collection →

</span>





</div>





</a>






@empty




<div class="
col-span-3
text-center
py-20
text-gray-400
">


No categories available.



</div>





@endforelse







</div>





</div>



</div>



@endsection