<x-member-layout>
    <div class="space-y-4">
        
        <!-- PAGE HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="space-y-0.5">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-brand-500/10 text-brand-800 text-[10px] font-bold uppercase tracking-wider border border-brand-500/20">
                    <i data-lucide="receipt" class="w-3 h-3 text-brand-600"></i>
                    <span>Portal Pengantin • Tagihan</span>
                </div>
                <h1 class="font-serif text-xl sm:text-2xl font-bold text-charcoal-950">
                    Riwayat Transaksi &amp; Pembayaran
                </h1>
                <p class="text-xs text-sand-600">
                    Daftar invoice dan status pembayaran tema serta paket undangan pernikahan Anda.
                </p>
            </div>

            <a 
                href="{{ route('themes.catalog') }}" 
                class="px-4 py-2 rounded-xl bg-charcoal-900 hover:bg-charcoal-800 text-white font-bold text-xs transition flex items-center justify-center gap-2 self-start sm:self-auto shadow-sm"
            >
                <i data-lucide="shopping-bag" class="w-3.5 h-3.5 text-brand-400"></i>
                <span>Beli Tema Baru</span>
            </a>
        </div>

        <!-- COMPACT STATS TILES -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
            <div class="p-3 rounded-2xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block">Total Transaksi</span>
                    <div class="font-serif text-lg font-bold text-charcoal-950">{{ $totalOrders }} <span class="text-xs font-sans text-sand-400 font-normal">Pesanan</span></div>
                </div>
                <div class="w-8 h-8 rounded-xl bg-sand-100 text-charcoal-900 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-3 rounded-2xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block">Transaksi Lunas</span>
                    <div class="font-serif text-lg font-bold text-emerald-600">{{ $totalPaid }} <span class="text-xs font-sans text-emerald-500 font-normal">Lunas</span></div>
                </div>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-3 rounded-2xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block">Total Pengeluaran</span>
                    <div class="font-serif text-lg font-bold text-brand-600">{{ format_rupiah($totalSpent) }}</div>
                </div>
                <div class="w-8 h-8 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="wallet" class="w-4 h-4"></i>
                </div>
            </div>
        </div>

        <!-- ORDERS TABLE -->
        <div class="rounded-2xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-sand-50/90 border-b border-sand-200/80 text-sand-600 font-bold uppercase tracking-wider text-[10px]">
                        <tr>
                            <th class="py-3.5 px-4 pl-6">Kode Pesanan</th>
                            <th class="py-3.5 px-4">Item & Layanan</th>
                            <th class="py-3.5 px-4">Total Biaya</th>
                            <th class="py-3.5 px-4 text-center">Status</th>
                            <th class="py-3.5 px-4">Waktu</th>
                            <th class="py-3.5 px-4 pr-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sand-200/60 font-medium text-charcoal-900">
                        @forelse($orders as $order)
                            @php
                                $themeItem = $order->items->firstWhere('item_type', 'theme');
                                $packageItem = $order->items->firstWhere('item_type', 'package');
                                $serviceItem = $order->items->firstWhere('item_type', 'service');
                                $isPaid = $order->payment_status === 'paid';
                            @endphp
                            <tr class="hover:bg-sand-50/60 transition group">
                                <td class="py-4 px-4 pl-6 align-middle whitespace-nowrap">
                                    <div class="space-y-1">
                                        <a href="{{ route('orders.show', ['order' => $order, 'from' => 'dashboard']) }}" class="inline-flex items-center gap-1 font-mono text-xs font-bold text-charcoal-900 group-hover:text-brand-600 transition">
                                            <span>#{{ $order->order_code }}</span>
                                        </a>
                                        @if($order->coupon)
                                            <div>
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200/70 text-[10px] font-bold">
                                                    <i data-lucide="ticket" class="w-3 h-3 text-emerald-600"></i>
                                                    <span>{{ $order->coupon->code }}</span>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-4 px-4 align-middle">
                                    <div class="space-y-1">
                                        <div class="font-bold text-charcoal-950 text-sm">
                                            {{ $themeItem?->item_name ?? ($packageItem?->item_name ?? ($order->items->first()?->item_name ?? 'Pembelian Undangan')) }}
                                        </div>
                                        <div class="flex flex-wrap items-center gap-2 text-xs">
                                            @if($themeItem)
                                                <span class="inline-flex items-center gap-1 text-[11px] text-sand-500 font-medium">
                                                    <i data-lucide="clock" class="w-3 h-3 text-sand-400"></i>
                                                    <span>Lisensi: {{ $order->metadata['duration_label'] ?? (($order->metadata['duration'] ?? '') === 'lifetime' ? 'Lifetime (Selamanya)' : '45 Hari') }}</span>
                                                </span>
                                            @endif

                                            @if($serviceItem || ($order->metadata['service_type'] ?? '') === 'assisted')
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200/80 text-[10px] font-semibold">
                                                    <i data-lucide="headphones" class="w-3 h-3 text-blue-600"></i>
                                                    <span>Bantu Isi Data Tim</span>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 align-middle whitespace-nowrap">
                                    <div class="font-bold text-charcoal-950 font-mono text-sm">
                                        {{ format_rupiah($order->total_amount ?: ($order->amount - $order->discount + ($order->tax_amount ?? 0))) }}
                                    </div>
                                    @if($order->discount > 0 || $order->coupon)
                                        <div class="flex items-center gap-1.5 text-[10px] text-sand-500 mt-0.5">
                                            <span class="line-through text-sand-400 font-mono">{{ format_rupiah($order->amount) }}</span>
                                            <span class="text-emerald-700 font-semibold bg-emerald-50 px-1.5 py-0.2 rounded border border-emerald-200/70 font-mono">-{{ format_rupiah($order->discount) }}</span>
                                        </div>
                                    @elseif((float)($order->tax_amount ?? 0) > 0)
                                        <div class="text-[10px] text-sand-400 font-medium mt-0.5">
                                            Termasuk PPN 11%
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-4 align-middle text-center whitespace-nowrap">
                                    @if($isPaid)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200/80 shadow-xs">
                                            <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i>
                                            <span>Lunas</span>
                                        </span>
                                    @elseif(in_array($order->payment_status, ['failed', 'expired', 'cancel']))
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-bold border border-rose-200/80">
                                            <i data-lucide="x" class="w-3.5 h-3.5 text-rose-600"></i>
                                            <span>Gagal</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-50 text-amber-800 text-xs font-bold border border-amber-200/80">
                                            <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-600"></i>
                                            <span>Menunggu</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 align-middle whitespace-nowrap text-sand-600">
                                    <div class="text-xs font-medium text-charcoal-800">
                                        {{ $order->created_at ? $order->created_at->isoFormat('D MMM Y') : '-' }}
                                    </div>
                                    <div class="text-[11px] text-sand-400 font-mono mt-0.5">
                                        {{ $order->created_at ? $order->created_at->isoFormat('HH:mm') : '' }} WIB
                                    </div>
                                </td>
                                <td class="py-4 px-4 pr-6 align-middle text-right whitespace-nowrap">
                                    <a 
                                        href="{{ route('orders.show', ['order' => $order, 'from' => 'dashboard']) }}" 
                                        class="px-3.5 py-1.5 rounded-xl {{ $isPaid ? 'bg-sand-100 hover:bg-sand-200 text-charcoal-800 hover:text-charcoal-950 border border-sand-200/80' : 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-xs' }} text-xs font-bold transition inline-flex items-center gap-1.5 shadow-xs hover:scale-[1.02] active:scale-[0.98]"
                                    >
                                        <span>{{ $isPaid ? 'Lihat Invoice' : 'Bayar Sekarang' }}</span>
                                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-sand-500">
                                    <div class="w-10 h-10 rounded-full bg-sand-100 text-sand-400 mx-auto flex items-center justify-center mb-2">
                                        <i data-lucide="receipt" class="w-5 h-5"></i>
                                    </div>
                                    <p class="font-serif font-bold text-charcoal-900 text-sm">Belum Ada Transaksi</p>
                                    <p class="text-xs text-sand-500 mt-0.5">Anda belum memiliki riwayat pembelian tema atau paket berbayar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="p-3 border-t border-sand-200/80">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>

    </div>
</x-member-layout>
