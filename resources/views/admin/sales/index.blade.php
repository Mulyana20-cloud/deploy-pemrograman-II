@extends('layouts.admin.app')

@section('content')

<div class="w-full space-y-7">


    {{-- HEADER --}}
    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <div class="mb-3 flex items-center gap-2 text-xs font-bold uppercase tracking-[0.18em] text-pink-600">
                <span class="h-2 w-2 rounded-full bg-pink-500"></span>
                BeautyStore / Users / Sales
            </div>


            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Sales Management
            </h1>


            <p class="mt-2 text-sm text-slate-500">
                Kelola tim penjualan dan pantau aktivitas referral BeautyStore.
            </p>

        </div>



        <a href="{{ route('admin.sales.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-pink-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-pink-600">

            <span class="text-xl">
                +
            </span>

            Tambah Sales

        </a>


    </div>





    {{-- ALERT --}}
    @if(session('success'))

        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
            ✓ {{ session('success') }}
        </div>

    @endif



    @if(session('error'))

        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            {{ session('error') }}
        </div>

    @endif





    {{-- STATISTIC --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">


        <div class="rounded-2xl border bg-white p-6 shadow-sm">

            <p class="text-sm text-slate-500">
                Total Sales
            </p>


            <h2 class="mt-3 text-4xl font-bold text-slate-900">
                {{ $sales->count() }}
            </h2>


            <p class="mt-2 text-xs text-slate-400">
                Akun Sales terdaftar
            </p>

        </div>




        <div class="rounded-2xl border bg-white p-6 shadow-sm">

            <p class="text-sm text-slate-500">
                Pelanggan Referral
            </p>


            <h2 class="mt-3 text-4xl font-bold text-slate-900">
                {{ $sales->sum('referred_customers_count') }}
            </h2>


            <p class="mt-2 text-xs text-slate-400">
                Pelanggan terhubung
            </p>

        </div>




        <div class="rounded-2xl border bg-white p-6 shadow-sm">

            <p class="text-sm text-slate-500">
                Pesanan Terhubung
            </p>


            <h2 class="mt-3 text-4xl font-bold text-slate-900">
                {{ $sales->sum('sales_orders_count') }}
            </h2>


            <p class="mt-2 text-xs text-slate-400">
                Pesanan dari Sales
            </p>

        </div>


    </div>






    {{-- CONTENT CARD --}}
    <div class="overflow-hidden rounded-2xl border bg-white shadow-sm">



        {{-- HEADER TABLE --}}
        <div class="flex flex-col gap-5 border-b p-6 lg:flex-row lg:items-center lg:justify-between">


            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    Daftar Sales
                </h2>


                <p class="mt-1 text-sm text-slate-500">
                    Informasi akun, referral, dan aktivitas Sales.
                </p>


            </div>




            <div class="w-full lg:max-w-sm">


                <input
                    id="salesSearch"
                    type="search"
                    placeholder="Cari nama, email, referral..."
                    class="w-full rounded-xl border bg-slate-50 px-4 py-3 text-sm outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-100"
                >


            </div>



        </div>






        {{-- MOBILE CARD --}}
        <div class="block space-y-4 p-4 lg:hidden">


            @forelse($sales as $sale)


                <div
                    class="sales-mobile-card rounded-2xl border p-5"
                    data-search="{{ strtolower($sale->name.' '.$sale->email.' '.$sale->referral_code) }}"
                >


                    <div class="flex items-center gap-4">


                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-50 font-bold text-pink-600">

                            {{ strtoupper(substr($sale->name,0,1)) }}

                        </div>



                        <div class="min-w-0">

                            <h3 class="font-bold text-slate-900">
                                {{ $sale->name }}
                            </h3>


                            <p class="truncate text-sm text-slate-500">
                                {{ $sale->email }}
                            </p>


                        </div>


                    </div>





                    <div class="mt-5 space-y-3 text-sm">


                        <div class="flex justify-between">

                            <span class="text-slate-400">
                                Referral
                            </span>


                            <span class="font-semibold text-pink-600">

                                {{ $sale->referral_code ?? '-' }}

                            </span>

                        </div>




                        <div class="flex justify-between">

                            <span class="text-slate-400">
                                Customer
                            </span>


                            <span class="font-semibold">

                                {{ $sale->referred_customers_count }}

                            </span>


                        </div>





                        <div class="flex justify-between">

                            <span class="text-slate-400">
                                Orders
                            </span>


                            <span class="font-semibold">

                                {{ $sale->sales_orders_count }}

                            </span>


                        </div>


                    </div>





                    <div class="mt-5 flex gap-2">


                        @if($sale->referral_code)

                            <a href="{{ url('/?ref='.$sale->referral_code) }}"
                               target="_blank"
                               class="flex-1 rounded-xl border px-4 py-2 text-center text-sm font-semibold text-slate-600">

                                Open

                            </a>

                        @endif




                        <form
                            action="{{ route('admin.sales.destroy',$sale->id) }}"
                            method="POST"
                            class="flex-1"
                            onsubmit="return confirm('Hapus akun Sales ini?')"
                        >

                            @csrf
                            @method('DELETE')


                            <button
                                class="w-full rounded-xl bg-red-50 px-4 py-2 text-sm font-semibold text-red-600"
                            >

                                Delete

                            </button>


                        </form>


                    </div>



                </div>


            @empty


                <div class="py-10 text-center text-sm text-slate-400">

                    Belum ada akun Sales

                </div>


            @endforelse



        </div>

            {{-- DESKTOP TABLE --}}
        <div class="hidden overflow-x-auto lg:block">

            <table class="w-full min-w-[900px] text-left">


                <thead class="bg-slate-50">

                    <tr class="border-b">

                        <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">
                            Sales
                        </th>


                        <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">
                            Referral
                        </th>


                        <th class="px-6 py-4 text-center text-xs font-bold uppercase text-slate-500">
                            Customer
                        </th>


                        <th class="px-6 py-4 text-center text-xs font-bold uppercase text-slate-500">
                            Orders
                        </th>


                        <th class="px-6 py-4 text-center text-xs font-bold uppercase text-slate-500">
                            Role
                        </th>


                        <th class="px-6 py-4 text-right text-xs font-bold uppercase text-slate-500">
                            Action
                        </th>


                    </tr>

                </thead>





                <tbody class="divide-y">


                    @forelse($sales as $sale)


                        <tr
                            class="sales-row hover:bg-pink-50/30"
                            data-search="{{ strtolower($sale->name.' '.$sale->email.' '.$sale->referral_code) }}"
                        >


                            {{-- SALES --}}
                            <td class="px-6 py-5">


                                <div class="flex items-center gap-3">


                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-pink-50 font-bold text-pink-600">

                                        {{ strtoupper(substr($sale->name,0,1)) }}

                                    </div>



                                    <div>

                                        <p class="font-semibold text-slate-900">

                                            {{ $sale->name }}

                                        </p>


                                        <p class="text-sm text-slate-500">

                                            {{ $sale->email }}

                                        </p>


                                    </div>


                                </div>


                            </td>






                            {{-- REFERRAL --}}
                            <td class="px-6 py-5">


                                @if($sale->referral_code)


                                    <div class="space-y-2">


                                        <span class="inline-block rounded-lg bg-pink-50 px-3 py-1 text-xs font-bold text-pink-600">

                                            {{ $sale->referral_code }}

                                        </span>



                                        <div class="flex gap-3">


                                            <button
                                                type="button"
                                                class="copy-referral text-xs font-semibold text-slate-500 hover:text-pink-600"
                                                data-copy="{{ url('/?ref='.$sale->referral_code) }}"
                                            >

                                                Copy

                                            </button>



                                            <a
                                                href="{{ url('/?ref='.$sale->referral_code) }}"
                                                target="_blank"
                                                class="text-xs font-semibold text-slate-500 hover:text-pink-600"
                                            >

                                                Open

                                            </a>


                                        </div>


                                    </div>


                                @else


                                    <span class="text-xs text-slate-400">
                                        Belum tersedia
                                    </span>


                                @endif


                            </td>






                            {{-- CUSTOMER --}}
                            <td class="px-6 py-5 text-center">

                                <span class="rounded-xl bg-slate-100 px-3 py-2 text-sm font-bold">

                                    {{ $sale->referred_customers_count }}

                                </span>

                            </td>






                            {{-- ORDERS --}}
                            <td class="px-6 py-5 text-center">

                                <span class="rounded-xl bg-slate-100 px-3 py-2 text-sm font-bold">

                                    {{ $sale->sales_orders_count }}

                                </span>

                            </td>






                            {{-- ROLE --}}
                            <td class="px-6 py-5 text-center">


                                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-600">

                                    Sales

                                </span>


                            </td>







                            {{-- ACTION --}}
                            <td class="px-6 py-5 text-right">


                                <form
                                    action="{{ route('admin.sales.destroy',$sale->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus akun Sales ini?')"
                                >

                                    @csrf
                                    @method('DELETE')


                                    <button
                                        class="rounded-xl bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-100"
                                    >

                                        Delete

                                    </button>


                                </form>


                            </td>



                        </tr>



                    @empty


                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">


                                <p class="font-semibold text-slate-700">

                                    Belum ada akun Sales

                                </p>


                                <p class="mt-2 text-sm text-slate-500">

                                    Tambahkan Sales pertama untuk mulai menggunakan referral.

                                </p>


                            </td>


                        </tr>


                    @endforelse



                    <tr id="salesNoResults" class="hidden">

                        <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500">

                            Tidak ada Sales yang cocok.

                        </td>

                    </tr>



                </tbody>


            </table>


        </div>






        {{-- FOOTER --}}
        <div class="border-t bg-slate-50 px-6 py-4">


            <p class="text-xs text-slate-500">

                Menampilkan

                <span id="salesVisibleCount" class="font-bold text-slate-700">

                    {{ $sales->count() }}

                </span>

                akun Sales

            </p>


        </div>



    </div>



</div>






{{-- SCRIPT --}}
<script>

document.addEventListener('DOMContentLoaded', function () {


    const search = document.getElementById('salesSearch');

    const rows = document.querySelectorAll('.sales-row');

    const cards = document.querySelectorAll('.sales-mobile-card');

    const counter = document.getElementById('salesVisibleCount');



    function filterSales(value) {


        let count = 0;

        value = value.toLowerCase();



        [...rows, ...cards].forEach(function(item){


            const text = item.dataset.search || '';

            const match = text.includes(value);



            item.classList.toggle(
                'hidden',
                !match
            );



            if(match){

                count++;

            }


        });



        if(counter){

            counter.textContent = count;

        }


    }





    if(search){

        search.addEventListener(
            'input',
            function(){

                filterSales(this.value);

            }
        );

    }






    document.querySelectorAll('.copy-referral')
    .forEach(function(button){


        button.addEventListener(
            'click',
            function(){


                navigator.clipboard.writeText(
                    this.dataset.copy
                );


                this.textContent = 'Copied';



                setTimeout(()=>{

                    this.textContent = 'Copy';

                },1500);


            }
        );


    });



});


</script>


@endsection