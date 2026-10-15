@extends('layouts.admin.app')

@section('content')

<div class="space-y-8">


<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">

    <div>
        <h1 class="text-3xl font-bold text-[#172033]">
            Categories
        </h1>

        <p class="text-gray-500 mt-2">
            Manage product categories
        </p>
    </div>


    <a href="{{ route('categories.create') }}"
       class="bg-[#172033] text-white px-6 py-3 rounded-xl text-center">

        + Add Category

    </a>


</div>





@if(session('success'))

<div class="bg-green-50 text-green-700 px-5 py-3 rounded-xl">

    {{ session('success') }}

</div>

@endif



@if(session('error'))

<div class="bg-red-50 text-red-700 px-5 py-3 rounded-xl">

    {{ session('error') }}

</div>

@endif






{{-- DESKTOP TABLE --}}

<div class="hidden md:block bg-white rounded-3xl border shadow-sm overflow-hidden">


<table class="w-full">


<thead class="bg-gray-50 border-b">

<tr>

<th class="px-6 py-5 text-left text-sm text-gray-500">
    Image
</th>

<th class="px-6 py-5 text-left text-sm text-gray-500">
    Category
</th>

<th class="px-6 py-5 text-left text-sm text-gray-500">
    Slug
</th>

<th class="px-6 py-5 text-center text-sm text-gray-500">
    Action
</th>

</tr>

</thead>



<tbody>


@forelse($categories as $category)


<tr class="border-b hover:bg-gray-50">


<td class="px-6 py-5">


@if($category->image)

<img src="{{ asset('storage/'.$category->image) }}"
     class="w-16 h-16 rounded-2xl object-cover">

@else

<div class="w-16 h-16 rounded-2xl bg-pink-50 flex items-center justify-center text-2xl">
    ✨
</div>

@endif


</td>





<td class="px-6 py-5">

<p class="font-semibold text-[#172033]">
    {{ $category->name }}
</p>

<p class="text-sm text-gray-400">
    Category
</p>

</td>





<td class="px-6 py-5">

<span class="bg-gray-100 px-3 py-1 rounded-lg text-sm text-gray-500">

{{ $category->slug }}

</span>

</td>





<td class="px-6 py-5">


<div class="flex justify-center gap-3">


<a href="{{ route('categories.edit',$category->id) }}"
class="px-4 py-2 border rounded-xl text-sm">

Edit

</a>



<form action="{{ route('categories.destroy',$category->id) }}"
method="POST">

@csrf
@method('DELETE')


<button onclick="return confirm('Delete this category?')"
class="px-4 py-2 rounded-xl bg-red-500 text-white text-sm">

Delete

</button>


</form>


</div>


</td>


</tr>



@empty


<tr>

<td colspan="4"
class="text-center py-10 text-gray-400">

No categories found.

</td>

</tr>


@endforelse


</tbody>


</table>


</div>







{{-- MOBILE CARD --}}

<div class="md:hidden space-y-4">


@forelse($categories as $category)


<div class="bg-white border rounded-3xl p-5">


<div class="flex gap-4">


@if($category->image)

<img src="{{ asset('storage/'.$category->image) }}"
class="w-20 h-20 rounded-2xl object-cover">

@else

<div class="w-20 h-20 rounded-2xl bg-pink-50 flex items-center justify-center text-3xl">

✨

</div>

@endif



<div>

<h3 class="font-bold text-lg">

{{ $category->name }}

</h3>


<p class="text-sm text-gray-400 mt-1">

{{ $category->slug }}

</p>


</div>


</div>





<div class="flex gap-3 mt-5">


<a href="{{ route('categories.edit',$category->id) }}"
class="flex-1 text-center px-4 py-2 border rounded-xl">

Edit

</a>



<form class="flex-1"
action="{{ route('categories.destroy',$category->id) }}"
method="POST">

@csrf
@method('DELETE')


<button onclick="return confirm('Delete this category?')"
class="w-full px-4 py-2 rounded-xl bg-red-500 text-white">

Delete

</button>


</form>


</div>


</div>



@empty


<div class="text-center py-10 text-gray-400">

No categories found.

</div>


@endforelse


</div>



</div>

@endsection