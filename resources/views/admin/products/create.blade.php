@extends('layouts.admin.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">

        <div>

            <h1 class="text-2xl font-bold">
                Add Product
            </h1>

            <p class="text-gray-500">
                Create new skincare and fashion product
            </p>

        </div>


        <a href="{{ route('products.index') }}"
           class="px-5 py-2 border rounded-lg text-center">

            Back

        </a>

    </div>




    <div class="bg-white rounded-xl shadow p-5 md:p-8">


        <form action="{{ route('products.store') }}"
            @if($errors->any())

                <div class="mb-5 bg-red-100 text-red-700 p-4 rounded-xl">

                    <ul class="text-sm space-y-1">

                        @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                        @endforeach

                    </ul>

                </div>

                @endif
              method="POST"
              enctype="multipart/form-data">


            @csrf



            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">



                <div>

                    <label class="block mb-2 font-medium">
                        Product Name
                    </label>


                    <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>

                </div>





                <div>

                    <label class="block mb-2 font-medium">
                        Category
                    </label>


                    <select
                    name="category_id"
                    class="w-full border rounded-lg px-4 py-3"
                    required>


                        <option value="">
                            Select Category
                        </option>


                        @foreach($categories as $category)

                        <option value="{{ $category->id }}">

                            {{ $category->name }}

                        </option>

                        @endforeach


                    </select>


                </div>





                <div>

                    <label class="block mb-2 font-medium">
                        Price
                    </label>


                    <input
                    type="number"
                    name="price"
                    value="{{ old('price') }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>

                </div>





                <div>

                    <label class="block mb-2 font-medium">
                        Discount Price
                    </label>


                    <input
                    type="number"
                    name="discount_price"
                    value="{{ old('discount_price') }}"
                    class="w-full border rounded-lg px-4 py-3">

                </div>





                <div>

                    <label class="block mb-2 font-medium">
                        Stock
                    </label>


                    <input
                    type="number"
                    name="stock"
                    value="{{ old('stock') }}"
                    class="w-full border rounded-lg px-4 py-3"
                    required>

                </div>





                <div>

                    <label class="block mb-2 font-medium">
                        Status
                    </label>


                    <select
                    name="status"
                    class="w-full border rounded-lg px-4 py-3">


                        <option value="active">
                            Active
                        </option>


                        <option value="inactive">
                            Inactive
                        </option>


                    </select>


                </div>


            </div>






            <div class="mt-6">


                <label class="block mb-2 font-medium">
                    Description
                </label>


                <textarea
                name="description"
                rows="5"
                class="w-full border rounded-lg px-4 py-3">{{ old('description') }}</textarea>


            </div>






            <div class="mt-6">


                <label class="block mb-2 font-medium">
                    Product Image
                </label>


                <input
                type="file"
                name="image"
                class="w-full border rounded-lg px-4 py-3">


            </div>





            <button type="submit"
            class="mt-8 w-full sm:w-auto bg-slate-900 text-white px-8 py-3 rounded-lg">

                Save Product

            </button>



        </form>


    </div>


</div>


@endsection