<x-member-layout>
    <div class="space-y-4">
        
        <!-- PAGE HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="space-y-0.5">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-amber-500/10 text-amber-800 text-[10px] font-bold uppercase tracking-wider border border-amber-500/20">
                    <i data-lucide="receipt" class="w-3 h-3 text-amber-600"></i>
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
                <i data-lucide="shopping-bag" class="w-3.5 h-3.5 text-amber-400"></i>
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
                    <div class="font-serif text-lg font-bold text-amber-600">Rp {{ number_format($totalSpent, 0, ',', '.') }}</div>
                </div>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="wallet" class="w-4 h-4"></i>
                </div>
            </div>
        </div>

        <!-- ORDERS TABLE -->
        <div class="rounded-2xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-sand-50/80 border-b border-sand-200/80 text-sand-600 font-bold uppercase tracking-wider text-[10px]">
                        <tr>
                            <th class="p-3 pl-5">Kode Pesanan</th>
                            <th class="p-3">Item / Layanan</th>
                            <th class="p-3">Total Biaya</th>
                            <th class="p-3">Status Pembayaran</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3 text-right pr-5">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sand-200/60 font-medium text-charcoal-900">
                        @forelse($orders as $order)
                            <tr class="hover:bg-amber-50/30 transition">
                                <td class="p-3 pl-5">
                                    <a href="{{ route('orders.show', $order) }}" class="font-mono font-bold text-amber-700 hover:underline block">
                                        {{ $order->order_code }}
                                    </a>
                                    @if($order->coupon)
                                        <div class="inline-flex items-center gap-1 px-2 py-0.5 mt-1 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold">
                                            <i data-lucide="ticket" class="w-3 h-3 text-emerald-600"></i>
                                            <span>{{ $order->coupon->code }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-3">
                                    @if($order->items->isNotEmpty())
                                        @foreach($order->items as $item)
                                            <div class="font-bold text-charcoal-950">{{ $item->item_name ?: 'Tema Undangan' }}</div>
                                        @endforeach
                                    @else
                                        <div class="font-bold text-charcoal-950">Pembelian Undangan</div>
                                    @endif
                                </td>
                                <td class="p-3">
                                    @if($order->discount > 0 || $order->coupon)
                                        <div class="font-bold text-charcoal-950">
                                            Rp {{ number_format($order->total_amount ?: ($order->amount - $order->discount), 0, ',', '.') }}
                                        </div>
                                        <div class="flex items-center gap-1.5 text-[10px] text-sand-500 mt-0.5">
                                            <span class="line-through text-sand-400">Rp {{ number_format($order->amount, 0, ',', '.') }}</span>
                                            <span class="text-emerald-700 font-semibold bg-emerald-50 px-1.5 py-0.2 rounded border border-emerald-200/60">-Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                                        </div>
                                    @else
                                        <div class="font-bold text-charcoal-950">
                                            Rp {{ number_format($order->amount, 0, ',', '.') }}
                                        </div>
                                    @endif
                                </td>
                                <td class="p-3">
                                    @if($order->payment_status === 'paid')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold border border-emerald-200">
                                            <i data-lucide="check" class="w-3 h-3"></i>
                                            <span>Lunas</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold border border-amber-200">
                                            <i data-lucide="clock" class="w-3 h-3"></i>
                                            <span>Menunggu Pembayaran</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3 text-sand-600">
                                    {{ $order->created_at ? $order->created_at->isoFormat('D MMM Y, HH:mm') : '-' }}
                                </td>
                                <td class="p-3 pr-5 text-right">
                                    <a 
                                        href="{{ route('orders.show', $order) }}" 
                                        class="px-3 py-1.5 rounded-xl {{ $order->payment_status === 'paid' ? 'bg-sand-100 hover:bg-sand-200 text-charcoal-900' : 'bg-emerald-600 hover:bg-emerald-700 text-white' }} text-xs font-bold transition inline-flex items-center gap-1 shadow-sm"
                                    >
                                        <span>{{ $order->payment_status === 'paid' ? 'Lihat Invoice' : 'Bayar Sekarang' }}</span>
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
