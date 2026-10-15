@extends('layouts.admin.app')

@section('content')

<div>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-bold">
                Products
            </h1>

            <p class="text-gray-500">
                Manage your product inventory
            </p>
        </div>


        <a href="{{ route('products.create') }}"
           class="bg-slate-900 text-white px-6 py-3 rounded-xl text-center">

            + Add Product

        </a>

    </div>




    <div class="bg-white rounded-2xl shadow-sm p-4 md:p-6">



        <form method="GET"
              action="{{ route('products.index') }}"
              class="flex flex-col md:flex-row gap-4 mb-6">


            <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search product..."
            class="border rounded-xl px-4 py-3 flex-1 focus:ring-2 focus:ring-slate-800">


            <select
            name="category"
            class="border rounded-xl px-4 py-3 md:w-52">


                <option value="">
                    All Categories
                </option>


                @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    @if(request('category') == $category->id)
                        selected
                    @endif>

                    {{ $category->name }}

                </option>

                @endforeach


            </select>



            <button
            class="bg-slate-900 text-white px-5 py-3 rounded-xl">

                Filter

            </button>


        </form>






        {{-- DESKTOP TABLE --}}

        <div class="hidden md:block overflow-x-auto">


            <table class="w-full">


                <thead>

                <tr class="border-b text-left">

                    <th class="py-4">
                        Product
                    </th>

                    <th>
                        Category
                    </th>

                    <th>
                        Price
                    </th>

                    <th>
                        Stock
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Action
                    </th>

                </tr>

                </thead>




                <tbody>


                @forelse($products as $product)


                <tr class="border-b">


                    <td class="py-4">


                        <div class="flex items-center gap-4">


                            @if($product->image)

                            <img src="{{ asset('storage/'.$product->image) }}"
                                 class="w-12 h-12 rounded-lg object-contain bg-gray-100">

                            @else

                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">

                                ?

                            </div>

                            @endif



                            <div>

                                <p class="font-semibold">
                                    {{ $product->name }}
                                </p>


                                <p class="text-xs text-gray-500">
                                    SKU: {{ $product->sku }}
                                </p>

                            </div>


                        </div>


                    </td>



                    <td>
                        {{ $product->category->name ?? '-' }}
                    </td>



                    <td>
                        Rp {{ number_format($product->price,0,',','.') }}
                    </td>



                    <td>
                        {{ $product->stock }}
                    </td>



                    <td>


                        @if($product->status == 'active')

                        <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">

                            Active

                        </span>


                        @else


                        <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">

                            Inactive

                        </span>


                        @endif


                    </td>




                    <td>


                        <div class="flex gap-2">


                            <a href="{{ route('products.edit',$product->id) }}"
                               class="px-3 py-2 border rounded-lg text-sm">

                                Edit

                            </a>




                            <form action="{{ route('products.destroy',$product->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')


                                <button class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm">

                                    Delete

                                </button>


                            </form>


                        </div>


                    </td>


                </tr>



                @empty


                <tr>

                    <td colspan="6"
                        class="text-center py-10">

                        No products available

                    </td>


                </tr>


                @endforelse


                </tbody>


            </table>


        </div>







        {{-- MOBILE CARD --}}

        <div class="md:hidden space-y-4">


        @forelse($products as $product)


            <div class="border rounded-2xl p-4">


                <div class="flex gap-4">


                    @if($product->image)

                    <img src="{{ asset('storage/'.$product->image) }}"
                         class="w-16 h-16 rounded-xl object-cover">

                    @endif



                    <div class="flex-1">


                        <h3 class="font-semibold">
                            {{ $product->name }}
                        </h3>


                        <p class="text-xs text-gray-500">
                            SKU: {{ $product->sku }}
                        </p>


                        <p class="font-bold text-pink-600 mt-2">

                            Rp {{ number_format($product->price,0,',','.') }}

                        </p>


                    </div>


                </div>




                <div class="flex justify-between items-center mt-4 text-sm">


                    <div>

                        <p>
                            Stock: {{ $product->stock }}
                        </p>


                        <p class="text-gray-500">
                            {{ $product->category->name ?? '-' }}
                        </p>

                    </div>



                    <div class="flex gap-2">


                        <a href="{{ route('products.edit',$product->id) }}"
                           class="px-3 py-2 border rounded-lg">

                            Edit

                        </a>


                        <form action="{{ route('products.destroy',$product->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')


                            <button class="px-3 py-2 bg-red-500 text-white rounded-lg">

                                Delete

                            </button>


                        </form>


                    </div>


                </div>


            </div>



        @empty


            <div class="text-center py-10">

                No products available

            </div>


        @endforelse


        </div>


    </div>


</div>


@endsection