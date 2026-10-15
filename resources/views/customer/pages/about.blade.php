@extends('layouts.customer.app')


@section('content')


<!-- HERO SECTION -->
<section class="bg-[#fff8f7]">

<div class="max-w-7xl mx-auto px-6 py-20">

<div class="grid lg:grid-cols-2 gap-14 items-center">


<!-- LEFT -->

<div>


<p class="text-xs tracking-[5px] text-pink-500 mb-6">
ABOUT BEAUTYSTORE
</p>


<h1 class="text-5xl lg:text-6xl font-bold leading-tight text-slate-900">

Elevate Your Beauty,
<br>

Embrace Your Style.

</h1>



<p class="mt-6 text-gray-500 leading-relaxed max-w-lg">

BeautyStore hadir sebagai destinasi modern untuk kebutuhan skincare,
fashion, dan accessories pilihan dengan koleksi berkualitas yang
membantu setiap pelanggan tampil lebih percaya diri.

</p>




<div class="flex gap-4 mt-8">


<a href="{{ route('shop') }}"
class="
bg-slate-900
text-white
px-7
py-3
rounded-xl
font-medium
hover:bg-slate-700
transition
">

Shop Collection

</a>



<a href="{{ route('categories') }}"
class="
border
border-gray-300
px-7
py-3
rounded-xl
font-medium
hover:bg-white
transition
">

Explore Categories

</a>


</div>




<!-- STAT -->

<div class="flex gap-12 mt-10">


<div>

<h3 class="text-3xl font-bold text-slate-900">
500+
</h3>

<p class="text-sm text-gray-400">
Products
</p>

</div>




<div>

<h3 class="text-3xl font-bold text-slate-900">
1000+
</h3>

<p class="text-sm text-gray-400">
Customers
</p>

</div>




<div>

<h3 class="text-3xl font-bold text-slate-900">
24/7
</h3>

<p class="text-sm text-gray-400">
Support
</p>

</div>


</div>


</div>






<!-- RIGHT IMAGE -->


<div class="relative">


<img
src="https://images.unsplash.com/photo-1596462502278-27bfdc403348"
class="
rounded-[32px]
shadow-2xl
w-full
h-[430px]
object-cover
"
/>




<!-- FLOAT CARD TOP -->


<div
class="
absolute
top-8
right-5
bg-white
rounded-2xl
shadow-xl
px-5
py-4
">

<p class="text-xs text-gray-400">
Collection
</p>

<h4 class="font-bold">
2026 Beauty
</h4>

</div>





<!-- FLOAT CARD BOTTOM -->


<div
class="
absolute
bottom-8
left-5
bg-white
rounded-2xl
shadow-xl
px-6
py-5
">


<p class="text-xs text-gray-400">
Premium Beauty
</p>


<h4 class="font-bold text-lg">
Quality Collection
</h4>


<p class="text-xs text-green-500 mt-2">
● Trusted products
</p>


</div>


</div>


</div>


</div>


</section>







<!-- STORY SECTION -->


<section class="bg-white">


<div class="max-w-7xl mx-auto px-6 py-20">


<div class="grid lg:grid-cols-2 gap-14 items-center">



<div>


<img
src="https://images.unsplash.com/photo-1556228720-195a672e8a03"
class="
rounded-[32px]
shadow-lg
w-full
h-[360px]
object-cover
"
/>


</div>





<div>


<p class="text-xs tracking-[4px] text-pink-500">
OUR STORY
</p>


<h2 class="text-4xl font-bold text-slate-900 mt-4">

More Than Just A Beauty Store

</h2>



<p class="mt-6 text-gray-500 leading-relaxed">

Kami percaya bahwa setiap orang memiliki gaya dan kebutuhan
masing-masing. BeautyStore hadir untuk membantu pelanggan
menemukan produk yang sesuai dengan karakter dan kebutuhan mereka.

</p>



<p class="mt-5 text-gray-500 leading-relaxed">

Dengan mengutamakan kualitas produk, pelayanan terbaik,
dan pengalaman belanja yang nyaman, kami ingin menjadi
partner terpercaya dalam perjalanan beauty setiap pelanggan.

</p>



<div class="grid grid-cols-3 gap-5 mt-8">


<div>

<p class="text-2xl font-bold text-slate-900">
01
</p>

<p class="text-sm text-gray-500">
Quality
</p>

</div>



<div>

<p class="text-2xl font-bold text-slate-900">
02
</p>

<p class="text-sm text-gray-500">
Style
</p>

</div>



<div>

<p class="text-2xl font-bold text-slate-900">
03
</p>

<p class="text-sm text-gray-500">
Trust
</p>

</div>


</div>


</div>


</div>


</div>


</section>







<!-- WHY CHOOSE -->


<section class="bg-[#fff8f7]">


<div class="max-w-7xl mx-auto px-6 py-20">


<div class="text-center mb-12">


<h2 class="text-4xl font-bold text-slate-900">

Why Choose BeautyStore?

</h2>


<p class="text-gray-500 mt-3">

Everything you need for beauty and lifestyle.

</p>


</div>




<div class="grid md:grid-cols-3 gap-8">



<div class="bg-white rounded-3xl p-8 shadow-sm">


<div class="text-pink-500 text-3xl mb-5">
✓
</div>


<h3 class="font-bold text-xl">
Quality Products
</h3>


<p class="text-gray-500 mt-3 text-sm leading-relaxed">

Produk pilihan dengan kualitas terbaik untuk kebutuhan
skincare, fashion, dan lifestyle.

</p>


</div>





<div class="bg-white rounded-3xl p-8 shadow-sm">


<div class="text-pink-500 text-3xl mb-5">
✦
</div>


<h3 class="font-bold text-xl">
Premium Collection
</h3>


<p class="text-gray-500 mt-3 text-sm leading-relaxed">

Koleksi modern mengikuti tren dan kebutuhan pelanggan.

</p>


</div>





<div class="bg-white rounded-3xl p-8 shadow-sm">


<div class="text-pink-500 text-3xl mb-5">
⚡
</div>


<h3 class="font-bold text-xl">
Fast Service
</h3>


<p class="text-gray-500 mt-3 text-sm leading-relaxed">

Pelayanan cepat untuk pengalaman belanja yang nyaman.

</p>


</div>


</div>


</div>


</section>







<!-- CTA -->


<section class="bg-slate-900">


<div class="max-w-7xl mx-auto px-6 py-16 text-center">


<h2 class="text-4xl font-bold text-white">

Discover Your Beauty Collection

</h2>



<p class="text-gray-300 mt-4">

Find products that match your style and personality.

</p>




<a href="{{ route('shop') }}"
class="
inline-block
mt-8
bg-pink-500
text-white
px-8
py-3
rounded-xl
font-medium
hover:bg-pink-600
transition
">

Start Shopping

</a>


</div>


</section>



@endsection