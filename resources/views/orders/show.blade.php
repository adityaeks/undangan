<x-member-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('member.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-sand-600 hover:text-charcoal-900 transition mb-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali ke Dashboard
                </a>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">Detail Pembelian & Tagihan</h1>
                <p class="text-xs text-sand-500">Kode Transaksi: <strong class="text-charcoal-900">{{ $order->order_code }}</strong></p>
            </div>
            <div>
                @if($order->isPaid())
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                        Lunas
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-800 text-xs font-bold uppercase tracking-wider">
                        <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
                        Menunggu Pembayaran
                    </span>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-2">
                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 flex-shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 flex-shrink-0"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Order Items Breakdown -->
        <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 sm:p-8 space-y-6 shadow-sm">
            <h2 class="font-serif text-lg font-bold text-charcoal-950 border-b border-sand-200/60 pb-3">Rincian Item</h2>

            <div class="divide-y divide-sand-200/60">
                @foreach($order->items as $item)
                    <div class="py-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-charcoal-950">{{ $item->item_name }}</h3>
                            <span class="text-xs text-sand-500">Tipe: {{ ucfirst($item->item_type) }} • Jml: {{ $item->quantity }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-charcoal-950">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="border-t border-sand-200/80 pt-4 space-y-3">
                <div class="flex items-center justify-between text-sm text-sand-600">
                    <span>Subtotal:</span>
                    <span class="font-medium text-charcoal-900">Rp {{ number_format($order->amount, 0, ',', '.') }}</span>
                </div>

                @if($order->discount > 0 || $order->coupon)
                    <div class="flex items-center justify-between text-sm text-emerald-700 bg-emerald-50 px-3.5 py-2.5 rounded-xl border border-emerald-200/70">
                        <div class="flex items-center gap-2">
                            <i data-lucide="tag" class="w-4 h-4 text-emerald-600"></i>
                            <span>Diskon Kupon (<strong>{{ $order->coupon?->code ?? 'PROMO' }}</strong>):</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">-Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                            @if(! $order->isPaid())
                                <form action="{{ route('orders.coupon.remove', $order) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Kupon" class="text-xs text-rose-500 hover:text-rose-700 underline font-semibold ml-1">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="flex items-center justify-between text-base font-bold text-charcoal-950 pt-2 border-t border-sand-200/60">
                    <span>Total Tagihan:</span>
                    <span class="text-xl text-amber-600 font-serif">Rp {{ number_format($order->total_amount !== null ? $order->total_amount : $order->amount, 0, ',', '.') }}</span>
                </div>
            </div>

            @if(! $order->isPaid() && ! $order->coupon)
                <div class="border-t border-sand-200/80 pt-4">
                    <form action="{{ route('orders.coupon.apply', $order) }}" method="POST" class="flex flex-col sm:flex-row gap-2.5">
                        @csrf
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-sand-400">
                                <i data-lucide="ticket" class="w-4 h-4"></i>
                            </div>
                            <input type="text" name="code" value="{{ old('code') }}" placeholder="Punya kupon promo? (Cth: MOMENINDAH)" required
                                class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-sand-300 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 uppercase tracking-wider font-semibold placeholder:font-normal placeholder:tracking-normal placeholder:normal-case">
                        </div>
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-charcoal-900 hover:bg-charcoal-800 text-amber-200 font-bold text-xs tracking-wider uppercase transition shadow-sm flex items-center justify-center gap-1.5">
                            <i data-lucide="check" class="w-4 h-4"></i>
                            <span>Terapkan</span>
                        </button>
                    </form>
                    @error('code')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif
        </div>

        <!-- Payment Actions -->
        @if(! $order->isPaid())
            <div class="rounded-3xl bg-gradient-to-r from-charcoal-950 via-charcoal-900 to-amber-950 p-6 sm:p-8 text-white shadow-xl border border-charcoal-800 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-white">Instruksi Pembayaran</h3>
                        <p class="text-xs text-sand-300">Selesaikan pembayaran untuk langsung membuka akses template secara instan.</p>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-white/10 border border-white/15 text-xs text-sand-200 space-y-1">
                    <p>• Transfer melalui Bank / QRIS otomatis terverifikasi.</p>
                    <p>• Setelah pembayaran berhasil, template undangan otomatis aktif pada akun Anda.</p>
                </div>

                <div class="pt-2 flex flex-wrap gap-3">
                    <form action="{{ route('orders.simulate', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-3 rounded-2xl bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 hover:from-amber-600 hover:to-amber-800 text-white font-bold text-xs shadow-lg transition flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4"></i>
                            <span>Konfirmasi & Simulasi Pembayaran Lunas</span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="rounded-3xl p-6 bg-emerald-50 border border-emerald-200 text-center space-y-3">
                <div class="w-12 h-12 rounded-full bg-emerald-500 text-white flex items-center justify-center mx-auto text-xl shadow-md">
                    <i data-lucide="check" class="w-6 h-6"></i>
                </div>
                <h3 class="font-serif text-lg font-bold text-emerald-950">Transaksi Berhasil & Telah Aktif!</h3>
                <p class="text-xs text-emerald-800 max-w-md mx-auto">
                    Terima kasih! Pembelian Anda telah diverifikasi pada {{ $order->paid_at ? $order->paid_at->isoFormat('D MMMM Y, HH:mm') : 'hari ini' }}. Template kini siap digunakan untuk membuat undangan.
                </p>
                @php
                    $themeItem = $order->items->firstWhere('item_type', 'theme');
                    $themeParam = $themeItem ? ['theme_id' => $themeItem->item_id] : [];
                    $createRoute = Auth::user()?->isSuperAdmin() ? 'invitations.create' : 'member.invitations.create';
                @endphp
                <div class="pt-2">
                    <a href="{{ route($createRoute, $themeParam) }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md transition">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>Gunakan Template & Buat Undangan</span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-member-layout>
