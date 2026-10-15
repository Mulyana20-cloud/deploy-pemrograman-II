@extends('layouts.admin.app')

@section('content')

<div class="max-w-xl mx-auto">


<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">


<div>

<h1 class="text-3xl font-bold text-[#172033]">
    Add Category
</h1>

<p class="text-gray-500 mt-2">
    Create new product category
</p>

</div>



<a href="{{ route('categories.index') }}"
class="px-5 py-3 border rounded-xl text-center">

Back

</a>


</div>





<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-5 sm:p-8">



<form action="{{ route('categories.store') }}"
method="POST"
enctype="multipart/form-data">


@csrf





<div class="mb-6">


<label class="block mb-2 font-semibold text-gray-700">

Category Name

</label>


<input
type="text"
name="name"
value="{{ old('name') }}"
placeholder="Example: Skincare"
class="w-full border rounded-xl px-4 py-3 focus:ring-pink-500 focus:border-pink-500"
>


@error('name')

<p class="text-red-500 text-sm mt-2">

{{ $message }}

</p>

@enderror


</div>







<div class="mb-6">


<label class="block mb-2 font-semibold text-gray-700">

Category Image

</label>



<input
type="file"
name="image"
accept="image/*"
class="w-full border rounded-xl px-4 py-3 bg-white"
>



<p class="text-sm text-gray-400 mt-2">

Max 2MB (JPG, PNG, WEBP)

</p>



@error('image')

<p class="text-red-500 text-sm mt-2">

{{ $message }}

</p>

@enderror



</div>







<button
type="submit"
class="w-full sm:w-auto bg-[#172033] text-white px-8 py-3 rounded-xl font-medium hover:bg-slate-800 transition">


Save Category


</button>



</form>


</div>



</div>


@endsection