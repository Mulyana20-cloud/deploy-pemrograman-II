
@extends('layouts.customer.app')

@section('content')
<div class="min-h-screen bg-[#fffaf9] py-10 md:py-14">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <p class="mb-2 text-xs font-semibold uppercase tracking-[0.25em] text-pink-500">
                BeautyStore
            </p>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Checkout
            </h1>
            <p class="mt-2 text-sm text-slate-500">
                Lengkapi informasi pengiriman dan pilih metode pembayaran.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="mb-2 font-semibold">Periksa kembali data berikut:</p>
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 items-start gap-8 lg:grid-cols-3">

                {{-- INFORMASI PENGIRIMAN --}}
                <div class="space-y-6 lg:col-span-2">

                    <section class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm md:p-8">
                        <div class="mb-6">
                            <h2 class="text-xl font-bold text-slate-900">
                                Informasi Pengiriman
                            </h2>
                            <p class="mt-1 text-sm text-slate-500">
                                Pastikan informasi penerima sudah benar.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            <div>
                                <label for="name" class="text-sm font-medium text-slate-700">
                                    Nama Penerima
                                </label>
                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    maxlength="255"
                                    required
                                    autocomplete="name"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-50"
                                >
                            </div>

                            <div>
                                <label for="email" class="text-sm font-medium text-slate-700">
                                    Email
                                </label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    maxlength="255"
                                    required
                                    autocomplete="email"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-50"
                                >
                            </div>

                            <div class="md:col-span-2">
                                <label for="phone" class="text-sm font-medium text-slate-700">
                                    Nomor Telepon
                                </label>
                                <input
                                    id="phone"
                                    type="tel"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    maxlength="30"
                                    required
                                    autocomplete="tel"
                                    placeholder="Contoh: 081234567890"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-50"
                                >
                            </div>

                            <div class="md:col-span-2">
                                <label for="address" class="text-sm font-medium text-slate-700">
                                    Alamat Lengkap
                                </label>
                                <textarea
                                    id="address"
                                    name="address"
                                    rows="4"
                                    required
                                    autocomplete="street-address"
                                    placeholder="Nama jalan, nomor rumah, kecamatan, kota, dan kode pos"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-50"
                                >{{ old('address') }}</textarea>
                            </div>

                        </div>
                    </section>

                    {{-- METODE PEMBAYARAN --}}
                    <section class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm md:p-8">
                        <h2 class="text-xl font-bold text-slate-900">
                            Metode Pembayaran
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Pilih pembayaran yang ingin disimulasikan.
                        </p>

                        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">

                            <label class="cursor-pointer">
                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="COD"
                                    class="peer sr-only"
                                    @checked(old('payment_method', 'COD') === 'COD')
                                >

                                <div class="h-full rounded-2xl border-2 border-slate-200 p-5 transition peer-checked:border-pink-500 peer-checked:bg-pink-50/50">
                                    <div class="flex items-start gap-3">
                                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-xl">
                                            <icon name="banknote" size="xl" />
                                        </span>
                                        <div>
                                            <p class="font-semibold text-slate-900">
                                                Cash On Delivery
                                            </p>
                                            <p class="mt-1 text-sm leading-5 text-slate-500">
                                                Bayar saat pesanan diterima sesuai prosedur toko.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="CREDIT_SIMULATION"
                                    class="peer sr-only"
                                    @checked(old('payment_method') === 'CREDIT_SIMULATION')
                                >

                                <div class="h-full rounded-2xl border-2 border-slate-200 p-5 transition peer-checked:border-pink-500 peer-checked:bg-pink-50/50">
                                    <div class="flex items-start gap-3">
                                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-pink-100 text-xl">
                                            <icon name="calendar-clock" size="xl" />
                                        </span>
                                        <div>
                                            <p class="font-semibold text-slate-900">
                                                Simulasi Kredit
                                            </p>
                                            <p class="mt-1 text-sm leading-5 text-slate-500">
                                                Lihat estimasi cicilan berdasarkan tenor pilihan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                        </div>

                        {{-- PANEL SIMULASI --}}
                        <div
                            id="credit-panel"
                            class="mt-5 hidden rounded-2xl border border-pink-100 bg-pink-50/60 p-5 md:p-6"
                        >
                            <div class="flex items-start gap-3">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-pink-600 shadow-sm">
                                    <icon name="calculator" size="xl" />
                                </span>
                                <div>
                                    <h3 class="font-bold text-slate-900">
                                        Estimasi Cicilan
                                    </h3>
                                    <p class="mt-1 text-sm text-slate-600">
                                        Pilih tenor untuk melihat perkiraan pembayaran bulanan.
                                    </p>
                                </div>
                            </div>

                            <div class="mt-5">
                                <label for="installment_months" class="text-sm font-medium text-slate-700">
                                    Tenor Simulasi
                                </label>
                                <select
                                    id="installment_months"
                                    name="installment_months"
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-pink-400 focus:ring-4 focus:ring-pink-50"
                                    disabled
                                >
                                    <option value="3" @selected((int) old('installment_months', 3) === 3)>
                                        3 bulan
                                    </option>
                                    <option value="6" @selected((int) old('installment_months') === 6)>
                                        6 bulan
                                    </option>
                                    <option value="12" @selected((int) old('installment_months') === 12)>
                                        12 bulan
                                    </option>
                                </select>
                            </div>

                            <div class="mt-5 rounded-2xl bg-white p-5">
                                <p class="text-sm text-slate-500">
                                    Estimasi cicilan per bulan
                                </p>
                                <p id="monthly-estimate" class="mt-2 text-2xl font-bold text-pink-600">
                                    Rp 0
                                </p>

                                <div class="mt-4 space-y-2 border-t border-slate-100 pt-4 text-sm">
                                    <div class="flex justify-between gap-4">
                                        <span class="text-slate-500">Subtotal belanja</span>
                                        <span id="credit-subtotal" class="font-medium text-slate-800">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between gap-4">
                                        <span class="text-slate-500">Bunga simulasi</span>
                                        <span id="credit-interest" class="font-medium text-slate-800">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between gap-4">
                                        <span class="text-slate-500">Total simulasi</span>
                                        <span id="credit-total" class="font-bold text-slate-900">Rp 0</span>
                                    </div>
                                </div>
                            </div>

                            <p class="mt-4 text-xs leading-5 text-slate-500">
                                Simulasi menggunakan asumsi bunga flat 1% per bulan. Nilai ini hanya ilustrasi, bukan persetujuan kredit, penawaran pinjaman, atau layanan pembiayaan sungguhan.
                            </p>
                        </div>
                    </section>
                </div>

                {{-- RINGKASAN PESANAN --}}
                <aside class="lg:sticky lg:top-8">
                    <section class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm md:p-8">
                        <h2 class="text-xl font-bold text-slate-900">
                            Ringkasan Pesanan
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            {{ $cart->items->count() }} jenis produk dalam keranjang
                        </p>

                        <div class="mt-6 space-y-5">
                            @foreach($cart->items as $item)
                                <div class="flex items-start justify-between gap-4">
                                    <div class="min-w-0">
                                        <p class="font-medium text-slate-800">
                                            {{ $item->product->name }}
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Qty: {{ $item->quantity }}
                                        </p>
                                    </div>

                                    <p class="shrink-0 text-sm font-semibold text-slate-900">
                                        Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 space-y-3 border-t border-slate-100 pt-5">
                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-500">Subtotal</span>
                                <span class="font-semibold text-slate-900">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </span>
                            </div>

                            <div id="summary-credit-row" class="hidden flex justify-between gap-4 text-sm">
                                <span class="text-slate-500">Estimasi total kredit</span>
                                <span id="summary-credit-total" class="font-semibold text-pink-600">
                                    Rp 0
                                </span>
                            </div>
                        </div>

                        <button
                            id="submit-order"
                            type="submit"
                            class="mt-7 w-full rounded-xl bg-pink-600 px-5 py-3.5 font-semibold text-white shadow-sm transition hover:bg-pink-700 focus:outline-none focus:ring-4 focus:ring-pink-200"
                        >
                            Buat Pesanan
                        </button>

                        <div class="mt-4 flex items-start gap-2 text-xs leading-5 text-slate-500">
                            <icon name="shield-check" size="lg" />
                            <p>Periksa kembali alamat dan pilihan pembayaran sebelum membuat pesanan.</p>
                        </div>
                    </section>
                </aside>

            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const subtotal = {{ (float) $subtotal }};
    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
    const creditPanel = document.getElementById('credit-panel');
    const monthsSelect = document.getElementById('installment_months');
    const monthlyEstimate = document.getElementById('monthly-estimate');
    const creditSubtotal = document.getElementById('credit-subtotal');
    const creditInterest = document.getElementById('credit-interest');
    const creditTotal = document.getElementById('credit-total');
    const summaryCreditRow = document.getElementById('summary-credit-row');
    const summaryCreditTotal = document.getElementById('summary-credit-total');
    const submitButton = document.getElementById('submit-order');

    const rupiah = (amount) => 'Rp ' + Math.round(amount).toLocaleString('id-ID');

    function updatePaymentDisplay() {
        const selected = document.querySelector('input[name="payment_method"]:checked');
        const isCredit = selected && selected.value === 'CREDIT_SIMULATION';

        creditPanel.classList.toggle('hidden', !isCredit);
        monthsSelect.disabled = !isCredit;
        monthsSelect.required = isCredit;
        summaryCreditRow.classList.toggle('hidden', !isCredit);

        if (isCredit) {
            updateInstallment();
            submitButton.textContent = 'Buat Pesanan Simulasi Kredit';
        } else {
            submitButton.textContent = 'Buat Pesanan COD';
        }
    }

    function updateInstallment() {
        const months = Number(monthsSelect.value || 3);
        const interest = subtotal * 0.01 * months;
        const total = subtotal + interest;
        const monthly = total / months;

        monthlyEstimate.textContent = rupiah(monthly);
        creditSubtotal.textContent = rupiah(subtotal);
        creditInterest.textContent = rupiah(interest);
        creditTotal.textContent = rupiah(total);
        summaryCreditTotal.textContent = rupiah(total);
    }

    paymentRadios.forEach(function (radio) {
        radio.addEventListener('change', updatePaymentDisplay);
    });

    monthsSelect.addEventListener('change', updateInstallment);

    updatePaymentDisplay();
});
</script>
@endsection