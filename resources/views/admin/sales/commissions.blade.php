
@extends('layouts.admin.app')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-pink-500">
                BeautyStore / Sales / Komisi
            </p>

            <h1 class="mt-2 text-3xl font-bold text-slate-900">
                Pembayaran Komisi Sales
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Pantau komisi simulasi kredit dan catat pembayaran kepada Sales.
            </p>
        </div>

        <a href="{{ route('admin.sales.index') }}"
           class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
            Kembali ke Manajemen Sales
        </a>
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

        <div class="rounded-2xl border border-amber-100 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                Total Komisi Pending
            </p>

            <p class="mt-3 text-3xl font-bold text-amber-600">
                Rp {{ number_format((float) $totalPending, 0, ',', '.') }}
            </p>

            <p class="mt-2 text-xs text-slate-400">
                Menunggu pembayaran oleh admin
            </p>
        </div>

        <div class="rounded-2xl border border-emerald-100 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                Total Komisi Dibayarkan
            </p>

            <p class="mt-3 text-3xl font-bold text-emerald-600">
                Rp {{ number_format((float) $totalPaid, 0, ',', '.') }}
            </p>

            <p class="mt-2 text-xs text-slate-400">
                Komisi yang sudah dicatat lunas
            </p>
        </div>

    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-900">
                Riwayat Komisi
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Hanya pesanan simulasi kredit yang memiliki komisi Sales.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">

                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Pesanan</th>
                        <th class="px-6 py-4">Sales</th>
                        <th class="px-6 py-4">Subtotal</th>
                        <th class="px-6 py-4">Komisi</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/70">

                            <td class="px-6 py-5">
                                <p class="font-semibold text-slate-900">
                                    {{ $order->order_number }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $order->name }}
                                </p>
                            </td>

                            <td class="px-6 py-5">
                                <p class="font-medium text-slate-800">
                                    {{ $order->sales?->name ?? 'Sales tidak ditemukan' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $order->sales?->email ?? '-' }}
                                </p>
                            </td>

                            <td class="whitespace-nowrap px-6 py-5">
                                Rp {{ number_format((float) $order->subtotal, 0, ',', '.') }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-5 font-bold text-pink-600">
                                Rp {{ number_format((float) $order->sales_commission, 0, ',', '.') }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-5 text-slate-500">
                                {{ $order->created_at?->format('d M Y') ?? '-' }}
                            </td>

                            <td class="px-6 py-5">
                                @if($order->commission_status === 'paid')
                                    <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        Sudah Dibayar
                                    </span>
                                @elseif($order->commission_status === 'pending')
                                    <span class="inline-flex rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                        {{ ucfirst($order->commission_status) }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-5 text-right">
                                @if($order->commission_status === 'pending')
                                    <form
                                        action="{{ route('sales.commissions.paid', $order) }}"
                                        method="POST"
                                        onsubmit="return confirm('Pastikan pembayaran komisi untuk pesanan ini benar-benar sudah dilakukan. Tandai sebagai sudah dibayar?')"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="whitespace-nowrap rounded-lg bg-emerald-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700"
                                        >
                                            Tandai Dibayar
                                        </button>
                                    </form>
                                @elseif($order->commission_status === 'paid')
                                    <span class="text-xs font-medium text-emerald-600">
                                        Selesai
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400">—</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <p class="font-semibold text-slate-700">
                                    Belum ada data komisi
                                </p>

                                <p class="mt-2 text-sm text-slate-500">
                                    Komisi akan muncul setelah pesanan simulasi kredit terhubung dengan akun Sales.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-100 bg-slate-50 px-6 py-4 text-xs text-slate-500">
            Status “Sudah Dibayar” merupakan catatan administrasi dan harus sesuai dengan pembayaran yang telah diverifikasi.
        </div>

    </div>
</div>
@endsection
