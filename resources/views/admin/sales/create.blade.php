@extends('layouts.admin.app')

@section('content')

<div class="w-full max-w-3xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div>

        <a href="{{ route('admin.sales.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-pink-600 transition mb-4">
            ← Kembali ke Manajemen Sales
        </a>


        <h1 class="text-3xl font-bold tracking-tight text-slate-900">
            Tambah Akun Sales
        </h1>


        <p class="mt-2 text-gray-500">
            Buat akun baru untuk anggota tim Sales BeautyStore.
        </p>

    </div>



    {{-- CARD --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sm:p-8">


        {{-- INFO --}}
        <div class="rounded-xl bg-pink-50 border border-pink-100 p-4 mb-6">

            <p class="font-semibold text-pink-700">
                Role Sales ditetapkan otomatis
            </p>

            <p class="text-sm text-pink-600 mt-1">
                Akun ini akan langsung memiliki akses sebagai Sales.
            </p>

        </div>



        {{-- ERROR --}}
        @if($errors->any())

            <div class="rounded-xl bg-red-50 border border-red-200 p-4 mb-6">

                <p class="font-semibold text-red-700 mb-2">
                    Terdapat kesalahan:
                </p>


                <ul class="list-disc pl-5 text-sm text-red-600 space-y-1">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif




        <form action="{{ route('admin.sales.store') }}"
              method="POST"
              class="space-y-5">

            @csrf



            {{-- NAME --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Lengkap
                </label>


                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 focus:border-pink-500 focus:ring-2 focus:ring-pink-100"
                    placeholder="Nama Sales"
                >

            </div>



            {{-- EMAIL --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Email Login
                </label>


                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 focus:border-pink-500 focus:ring-2 focus:ring-pink-100"
                    placeholder="sales@example.com"
                >

            </div>




            {{-- PASSWORD --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Password
                </label>


                <input
                    type="password"
                    name="password"
                    required
                    minlength="8"
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 focus:border-pink-500 focus:ring-2 focus:ring-pink-100"
                    placeholder="Minimal 8 karakter"
                >

            </div>




            {{-- CONFIRM PASSWORD --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Konfirmasi Password
                </label>


                <input
                    type="password"
                    name="password_confirmation"
                    required
                    minlength="8"
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 focus:border-pink-500 focus:ring-2 focus:ring-pink-100"
                    placeholder="Ulangi password"
                >

            </div>




            {{-- BUTTON --}}
            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-5 border-t">


                <a href="{{ route('admin.sales.index') }}"
                   class="px-5 py-3 rounded-xl border text-gray-600 text-center hover:bg-gray-50">
                    Batal
                </a>



                <button
                    type="submit"
                    class="px-5 py-3 rounded-xl bg-pink-500 text-white font-semibold hover:bg-pink-600">
                    Simpan Sales
                </button>


            </div>



        </form>


    </div>


</div>


@endsection