@extends('layouts.admin.app')

@section('content')

<div class="max-w-xl mx-auto">



<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">


<div>

<h1 class="text-3xl font-bold text-[#172033]">

Edit Category

</h1>


<p class="text-gray-500 mt-2">

Update category information

</p>


</div>




<a href="{{ route('categories.index') }}"
class="px-5 py-3 border rounded-xl text-center">

Back

</a>



</div>







<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-5 sm:p-8">



<form action="{{ route('categories.update',$category->id) }}"
method="POST"
enctype="multipart/form-data">


@csrf

@method('PUT')







<div class="mb-6">


<label class="block mb-2 font-semibold text-gray-700">

Category Name

</label>


<input
type="text"
name="name"
value="{{ old('name',$category->name) }}"
class="w-full border rounded-xl px-4 py-3 focus:ring-pink-500 focus:border-pink-500"
>


</div>







@if($category->image)


<div class="mb-6">


<label class="block mb-2 font-semibold text-gray-700">

Current Image

</label>



<img
src="{{ asset('storage/'.$category->image) }}"
class="w-32 h-32 rounded-2xl object-cover border"
>


</div>


@endif








<div class="mb-6">


<label class="block mb-2 font-semibold text-gray-700">

Change Image

</label>



<input
type="file"
name="image"
accept="image/*"
class="w-full border rounded-xl px-4 py-3 bg-white"
>



<p class="text-sm text-gray-400 mt-2">

Leave empty if you don't want to change image.

</p>



</div>







<button
type="submit"
class="w-full sm:w-auto bg-[#172033] text-white px-8 py-3 rounded-xl font-medium hover:bg-slate-800 transition">


Update Category


</button>



</form>



</div>



</div>


@endsection