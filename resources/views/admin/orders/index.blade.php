<x-app-layout>
    <div class="space-y-3 sm:space-y-3.5">
        
        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">Riwayat Transaksi &amp; Pembayaran</h1>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">Billing</span>
                </div>
                <p class="text-xs text-sand-600">
                    Catatan seluruh pembayaran pembelian template personal dan aktivasi paket kemitraan Wedding Organizer.
                </p>
            </div>

            <div class="flex items-center gap-1.5 text-xs font-bold text-emerald-800 bg-emerald-100 px-3 py-1.5 rounded-xl self-start sm:self-auto">
                <i data-lucide="wallet" class="w-3.5 h-3.5 text-emerald-700"></i>
                <span>Omset: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- STATS PILLS -->
        <div class="grid grid-cols-3 gap-2.5">
            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block">Total Transaksi</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-charcoal-950">{{ $orders->total() }} <span class="text-xs font-sans text-sand-400 font-normal hidden sm:inline">Order</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-sand-100 text-charcoal-900 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="receipt" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block">Berhasil Terbayar</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-emerald-600">{{ $totalPaid }} <span class="text-xs font-sans text-emerald-500 font-normal hidden sm:inline">Lunas</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700 block">Menunggu Bayar</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-amber-600">{{ $totalPending }} <span class="text-xs font-sans text-amber-500 font-normal hidden sm:inline">Pending</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                </div>
            </div>
        </div>

        <!-- SEARCH & FILTER BAR -->
        <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-2.5">
            <form method="GET" action="{{ route('orders.index') }}" class="flex-1 w-full flex flex-col sm:flex-row items-center gap-2">
                <div class="relative w-full sm:max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari kode transaksi (ORD-xxxx)..." 
                        class="w-full pl-9 pr-3 py-1.5 rounded-xl border border-sand-200 bg-white text-xs text-charcoal-950 placeholder:text-sand-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                    >
                </div>

                <select 
                    name="status" 
                    onchange="this.form.submit()" 
                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-sand-200 bg-sand-50/70 text-xs text-charcoal-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500"
                >
                    <option value="all">Semua Status Pembayaran</option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas / Paid</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal / Expired</option>
                </select>

                <button type="submit" class="px-4 py-2.5 rounded-xl bg-charcoal-950 text-white text-xs font-bold hover:bg-brand-600 transition">
                    Filter
                </button>
            </form>
        </div>

        <!-- ORDERS TABLE -->
        <div class="rounded-3xl overflow-hidden glass-panel border border-sand-200 shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-charcoal-900">
                    <thead class="bg-sand-200/70 uppercase text-[10px] tracking-wider text-sand-700 font-bold border-b border-sand-300">
                        <tr>
                            <th class="py-4 px-6">Kode Order</th>
                            <th class="py-4 px-6">Pelanggan / User</th>
                            <th class="py-4 px-6">Paket / Layanan</th>
                            <th class="py-4 px-6">Nominal</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6">Metode & Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sand-200/60">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-sand-50/80 transition">
                                <td class="py-4 px-6">
                                    <a href="{{ route('orders.show', $order) }}" class="font-mono font-bold text-brand-600 hover:underline block">
                                        {{ $order->order_code }}
                                    </a>
                                    @if($order->coupon)
                                        <div class="inline-flex items-center gap-1 px-2 py-0.5 mt-1 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold">
                                            <i data-lucide="ticket" class="w-3 h-3 text-emerald-600"></i>
                                            <span>{{ $order->coupon->code }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-charcoal-950">{{ $order->user->name ?? 'Customer' }}</div>
                                    <span class="text-[11px] text-sand-500">{{ $order->user->email ?? '-' }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-2.5 py-1 rounded-full bg-sand-200 text-charcoal-900 text-[10px] font-bold">
                                        {{ ucfirst(str_replace('_', ' ', $order->package_type)) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
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
                                <td class="py-4 px-6 text-center">
                                    @if ($order->payment_status === 'paid')
                                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">Lunas</span>
                                    @elseif ($order->payment_status === 'pending')
                                        <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold">Pending</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-800 text-[10px] font-bold">Gagal</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-sand-600">
                                    <div class="font-semibold text-charcoal-900">{{ strtoupper($order->payment_method ?? 'Transfer Bank') }}</div>
                                    <span class="text-[11px] text-sand-400">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-sand-500">
                                    Belum ada catatan transaksi pembayaran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="p-4 border-t border-sand-200">
                {{ $orders->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
