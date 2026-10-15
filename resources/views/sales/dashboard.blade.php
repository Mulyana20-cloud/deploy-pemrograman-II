@extends('layouts.sales.app')

@section('content')
<div class="min-h-screen bg-[#fff9f7]">

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6">

        {{-- HEADER --}}
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-pink-500">
                    BeautyStore Partner
                </p>

                <h1 class="mt-2 text-3xl font-bold text-slate-900">
                    Sales Dashboard
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Halo, {{ $user->name }}. Pantau referral, pesanan, dan komisi penjualan.
                </p>
            </div>

            <a href="{{ route('shop') }}"
               class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-pink-600">
                Lihat Toko →
            </a>
        </div>

        {{-- STATISTICS --}}
        <div class="mb-8 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-slate-500">
                    Total Pesanan
                </p>
                <p class="mt-4 text-3xl font-bold text-slate-900">
                    {{ $totalOrders }}
                </p>
                <p class="mt-2 text-xs text-slate-400">
                    Pesanan terhubung ke referral
                </p>
            </div>

            <div class="rounded-2xl border border-pink-100 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-slate-500">
                    Pesanan Simulasi Kredit
                </p>
                <p class="mt-4 text-3xl font-bold text-pink-600">
                    {{ $creditOrders }}
                </p>
                <p class="mt-2 text-xs text-slate-400">
                    Transaksi simulasi kredit
                </p>
            </div>

            
            <div class="rounded-2xl border border-violet-100 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-slate-500">
                    Total Komisi Dibayarkan
                </p>

                <p class="mt-4 text-2xl font-bold text-slate-900">
                    Rp {{ number_format((float) $paidCommission, 0, ',', '.') }}
                </p>

                <p class="mt-2 text-xs text-slate-400">
                    Komisi yang sudah diselesaikan pembayarannya
                </p>
            </div>


            <div class="rounded-2xl border border-amber-100 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-slate-500">
                    Komisi Pending
                </p>
                <p class="mt-4 text-2xl font-bold text-amber-600">
                    Rp {{ number_format((float) $pendingCommission, 0, ',', '.') }}
                </p>
                <p class="mt-2 text-xs text-slate-400">
                    Menunggu penyelesaian administrasi
                </p>
            </div>

        </div>

        {{-- REFERRAL LINK --}}
        <section class="mb-8 overflow-hidden rounded-2xl bg-slate-900 p-6 text-white shadow-lg sm:p-8">
            <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-pink-300">
                        Your Personal Referral
                    </p>

                    <h2 class="mt-3 text-2xl font-bold">
                        Bagikan link, jangkau pelanggan
                    </h2>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-300">
                        Bagikan link referral ini kepada calon pelanggan.
                        Pesanan yang terhubung akan tercatat pada dashboard Sales.
                    </p>
                </div>

                <div class="rounded-xl border border-white/10 bg-white/5 px-5 py-4">
                    <p class="text-xs text-slate-400">Kode referral</p>
                    <p class="mt-1 text-2xl font-bold tracking-[0.2em] text-pink-300">
                        {{ $user->referral_code }}
                    </p>
                </div>
            </div>

            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                <input
                    id="salesReferralLink"
                    type="text"
                    readonly
                    value="{{ $referralLink }}"
                    class="min-w-0 flex-1 rounded-xl border border-white/10 bg-white px-4 py-3 text-sm text-slate-800 outline-none"
                >

                <button
                    type="button"
                    onclick="copySalesReferralLink()"
                    class="rounded-xl bg-pink-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-pink-400"
                >
                    Salin Link
                </button>
            </div>

            <p id="copyReferralMessage"
               class="mt-3 hidden text-sm text-emerald-300"
               role="status">
                Link berhasil disalin.
            </p>
        </section>

        {{-- COMMISSION SUMMARY --}}
        <section class="mb-8 rounded-2xl border border-pink-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Ringkasan Komisi
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Komisi simulasi kredit dihitung sebesar 10% dari subtotal pesanan.
                    </p>
                </div>

                <div class="rounded-xl bg-emerald-50 px-5 py-3">
                    <p class="text-xs text-emerald-700">
                        Komisi berstatus selesai
                    </p>
                    <p class="mt-1 text-xl font-bold text-emerald-700">
                        Rp {{ number_format((float) $paidCommission, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <p class="mt-4 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm leading-6 text-amber-900">
                <strong>Catatan:</strong>
                Simulasi kredit ini hanya untuk demonstrasi aplikasi, bukan persetujuan
                kredit atau layanan pembiayaan sungguhan. Komisi berstatus pending
                belum berarti sudah dibayarkan.
            </p>
        </section>

        {{-- ORDER HISTORY --}}
        <section class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">
            <div class="flex flex-col justify-between gap-2 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">
                        Pesanan Referral Terbaru
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Daftar pesanan yang tercatat atas akun Sales ini.
                    </p>
                </div>

                <span class="text-sm text-slate-500">
                    {{ $salesOrders->count() }} pesanan ditampilkan
                </span>
            </div>

            @if($salesOrders->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[950px] text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Nomor Pesanan</th>
                                <th class="px-6 py-4 font-semibold">Pelanggan</th>
                                <th class="px-6 py-4 font-semibold">Pembayaran</th>
                                <th class="px-6 py-4 font-semibold">Subtotal</th>
                                <th class="px-6 py-4 font-semibold">Komisi</th>
                                <th class="px-6 py-4 font-semibold">Status Komisi</th>
                                <th class="px-6 py-4 font-semibold">Tanggal</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @foreach($salesOrders as $order)
                                <tr class="transition hover:bg-pink-50/40">
                                    <td class="whitespace-nowrap px-6 py-4 font-semibold text-slate-900">
                                        {{ $order->order_number }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $order->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($order->payment_method === 'CREDIT_SIMULATION')
                                            <span class="rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold text-pink-700">
                                                Simulasi Kredit
                                            </span>
                                        @else
                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">
                                                {{ strtoupper($order->payment_method ?? '-') }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 font-medium text-slate-900">
                                        Rp {{ number_format((float) $order->subtotal, 0, ',', '.') }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 font-semibold text-pink-600">
                                        Rp {{ number_format((float) $order->sales_commission, 0, ',', '.') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($order->payment_method !== 'CREDIT_SIMULATION')
                                            <span class="text-xs text-slate-400">Tidak berlaku</span>
                                        @elseif($order->commission_status === 'paid')
                                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                Selesai
                                            </span>
                                        @else
                                            <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                                Pending
                                            </span>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-slate-500">
                                        {{ $order->created_at?->format('d M Y') ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-6 py-14 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-pink-50 text-3xl">
                        🛍️
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-slate-900">
                        Belum ada pesanan referral
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        Bagikan link referral kamu. Pesanan yang terhubung ke akun Sales
                        akan ditampilkan di bagian ini.
                    </p>

                    <a href="{{ route('shop') }}"
                       class="mt-5 inline-flex rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-pink-600">
                        Jelajahi Produk
                    </a>
                </div>
            @endif
        </section>

    </div>
</div>

<script>
async function copySalesReferralLink() {
    const input = document.getElementById('salesReferralLink');
    const message = document.getElementById('copyReferralMessage');

    try {
        if (navigator.clipboard && window.isSecureContext) {
            await navigator.clipboard.writeText(input.value);
        } else {
            input.focus();
            input.select();

            const copied = document.execCommand('copy');

            if (!copied) {
                throw new Error('Gagal menyalin link');
            }
        }

        message.textContent = 'Link berhasil disalin.';
        message.classList.remove('hidden');
    } catch (error) {
        input.focus();
        input.select();

        message.textContent = 'Link belum tersalin. Silakan salin secara manual.';
        message.classList.remove('hidden');
    }
}
</script>
@endsection