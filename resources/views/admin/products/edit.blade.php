@extends('layouts.admin.app')

@section('content')

<div class="max-w-5xl mx-auto">


    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">


        <div>

            <h1 class="text-2xl font-bold">
                Edit Product
            </h1>

            <p class="text-gray-500">
                Update product information
            </p>

        </div>



        <a href="{{ route('products.index') }}"
           class="px-5 py-2 border rounded-lg text-center hover:bg-gray-100">

            Back

        </a>


    </div>





    <div class="bg-white rounded-xl shadow p-5 md:p-8">


        <form action="{{ route('products.update',$product->id) }}"
              method="POST"
              enctype="multipart/form-data">


            @csrf
            @method('PUT')



            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">



                {{-- SKU --}}

                <div>

                    <label class="block mb-2 font-medium">
                        SKU
                    </label>


                    <input
                    type="text"
                    value="{{ $product->sku }}"
                    readonly
                    class="w-full border rounded-lg px-4 py-3 bg-gray-100 text-gray-600">

                </div>





                {{-- NAME --}}

                <div>

                    <label class="block mb-2 font-medium">
                        Product Name
                    </label>


                    <input
                    type="text"
                    name="name"
                    value="{{ old('name',$product->name) }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>

                </div>





                {{-- CATEGORY --}}

                <div>

                    <label class="block mb-2 font-medium">
                        Category
                    </label>


                    <select
                    name="category_id"
                    class="w-full border rounded-lg px-4 py-3"
                    required>


                        @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                        {{ old('category_id',$product->category_id) == $category->id ? 'selected':'' }}>

                            {{ $category->name }}

                        </option>

                        @endforeach


                    </select>


                </div>





                {{-- PRICE --}}

                <div>

                    <label class="block mb-2 font-medium">
                        Price
                    </label>


                    <input
                    type="number"
                    name="price"
                    value="{{ old('price',$product->price) }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>

                </div>





                {{-- DISCOUNT --}}

                <div>

                    <label class="block mb-2 font-medium">
                        Discount Price
                    </label>


                    <input
                    type="number"
                    name="discount_price"
                    value="{{ old('discount_price',$product->discount_price) }}"
                    class="w-full border rounded-lg px-4 py-3">

                </div>





                {{-- STOCK --}}

                <div>

                    <label class="block mb-2 font-medium">
                        Stock
                    </label>


                    <input
                    type="number"
                    name="stock"
                    value="{{ old('stock',$product->stock) }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>

                </div>





                {{-- STATUS --}}

                <div>

                    <label class="block mb-2 font-medium">
                        Status
                    </label>


                    <select
                    name="status"
                    class="w-full border rounded-lg px-4 py-3">


                        <option value="active"
                        {{ old('status',$product->status)=='active' ? 'selected':'' }}>

                            Active

                        </option>



                        <option value="inactive"
                        {{ old('status',$product->status)=='inactive' ? 'selected':'' }}>

                            Inactive

                        </option>


                    </select>


                </div>


            </div>







            {{-- DESCRIPTION --}}

            <div class="mt-6">


                <label class="block mb-2 font-medium">
                    Description
                </label>


                <textarea
                name="description"
                rows="5"
                class="w-full border rounded-lg px-4 py-3">{{ old('description',$product->description) }}</textarea>


            </div>







            {{-- IMAGE --}}

            <div class="mt-6">


                <label class="block mb-2 font-medium">
                    Product Image
                </label>


                <input
                type="file"
                name="image"
                class="w-full border rounded-lg px-4 py-3">



                @if($product->image)

                <div class="mt-5">

                    <p class="text-sm text-gray-500 mb-2">
                        Current Image
                    </p>


                    <img
                    src="{{ asset('storage/'.$product->image) }}"
                    class="w-40 h-40 object-cover rounded-xl border">


                </div>

                @endif


            </div>







            <button
            type="submit"
            class="mt-8 w-full sm:w-auto bg-slate-900 text-white px-8 py-3 rounded-lg hover:bg-slate-700">

                Update Product

            </button>



        </form>


    </div>


</div>


@endsection