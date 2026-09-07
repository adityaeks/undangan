<x-member-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                @php
                    $backUrl = Auth::user()?->isPartner() 
                        ? route('partner.dashboard') 
                        : (Auth::user()?->isSuperAdmin() ? route('admin.dashboard') : route('member.dashboard'));
                @endphp
                <a href="{{ $backUrl }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-sand-600 hover:text-charcoal-900 transition mb-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali ke Dashboard
                </a>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">Detail Pembelian & Tagihan</h1>
                <p class="text-xs text-sand-500">Kode Transaksi: <strong class="text-charcoal-900">{{ $order->order_code }}</strong></p>
            </div>
            <div>
                @if($order->isPaid())
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider shadow-sm">
                        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                        Lunas
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-800 text-xs font-bold uppercase tracking-wider shadow-sm">
                        <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
                        Menunggu Pembayaran
                    </span>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-2 shadow-sm">
                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 flex-shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-center gap-2 shadow-sm">
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
                    <span class="text-2xl text-amber-600 font-serif">Rp {{ number_format($order->total_amount !== null ? $order->total_amount : $order->amount, 0, ',', '.') }}</span>
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
            <div class="rounded-3xl bg-gradient-to-r from-charcoal-950 via-charcoal-900 to-amber-950 p-6 sm:p-8 text-white shadow-xl border border-charcoal-800 space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center border border-amber-500/30">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-base font-bold text-white">Pembayaran Aman via Midtrans</h3>
                                <span class="px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-[10px] font-bold uppercase tracking-wider border border-emerald-500/30">
                                    Official Gateway
                                </span>
                            </div>
                            <p class="text-xs text-sand-300">Pilih metode transfer bank virtual account, QRIS (GoPay/OVO/ShopeePay), atau kartu kredit.</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Channels Badges -->
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10 space-y-3">
                    <span class="text-[11px] font-bold text-sand-400 uppercase tracking-wider block">Metode Pembayaran Yang Didukung:</span>
                    <div class="flex flex-wrap items-center gap-2 text-xs">
                        <span class="px-3 py-1 rounded-xl bg-white/10 text-white font-semibold flex items-center gap-1.5">
                            <i data-lucide="qr-code" class="w-3.5 h-3.5 text-amber-300"></i>
                            <span>QRIS (GoPay, ShopeePay, Dana, OVO)</span>
                        </span>
                        <span class="px-3 py-1 rounded-xl bg-white/10 text-white font-semibold flex items-center gap-1.5">
                            <i data-lucide="landmark" class="w-3.5 h-3.5 text-blue-300"></i>
                            <span>Virtual Account (BCA, Mandiri, BNI, BRI, Permata)</span>
                        </span>
                        <span class="px-3 py-1 rounded-xl bg-white/10 text-white font-semibold flex items-center gap-1.5">
                            <i data-lucide="credit-card" class="w-3.5 h-3.5 text-purple-300"></i>
                            <span>Kartu Kredit / Debit Online</span>
                        </span>
                        <span class="px-3 py-1 rounded-xl bg-white/10 text-white font-semibold flex items-center gap-1.5">
                            <i data-lucide="store" class="w-3.5 h-3.5 text-emerald-300"></i>
                            <span>Alfamart / Indomaret</span>
                        </span>
                    </div>
                </div>

                @if(! empty($snapToken))
                    <!-- Midtrans Snap Action -->
                    <div class="pt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <button 
                            id="pay-button" 
                            type="button" 
                            class="px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 hover:from-amber-600 hover:to-amber-800 text-white font-bold text-sm shadow-xl hover:shadow-amber-500/30 hover:scale-[1.02] transition-all flex items-center justify-center gap-2.5"
                        >
                            <i data-lucide="lock" class="w-4 h-4"></i>
                            <span>Bayar Sekarang via Midtrans</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>

                        <div class="text-[11px] text-sand-400">
                            🔒 Terenkripsi 256-bit SSL &amp; Verifikasi Instan
                        </div>
                    </div>
                @elseif(! $isMidtransConfigured)
                    <!-- Notice when Midtrans credentials are not yet set in .env -->
                    <div class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-200 text-xs space-y-1.5">
                        <div class="flex items-center gap-2 font-bold text-amber-300">
                            <i data-lucide="alert-circle" class="w-4 h-4"></i>
                            <span>Konfigurasi Midtrans Diperlukan</span>
                        </div>
                        <p class="text-sand-300 text-[11px] leading-relaxed">
                            Kunci API Midtrans belum diisi di file <code class="bg-black/40 px-1 py-0.5 rounded text-amber-300">.env</code>. 
                            Silakan masukkan <code class="bg-black/40 px-1 py-0.5 rounded text-amber-300">MIDTRANS_SERVER_KEY</code> dan <code class="bg-black/40 px-1 py-0.5 rounded text-amber-300">MIDTRANS_CLIENT_KEY</code> dari akun Midtrans Anda.
                        </p>
                    </div>
                @endif

                <!-- Dev Simulation Fallback -->
                <div class="pt-4 border-t border-charcoal-800 flex items-center justify-between">
                    <span class="text-[11px] text-sand-500">Mode Pengujian / Simulasi Lokal:</span>
                    <form action="{{ route('orders.simulate', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-sand-300 hover:text-white font-semibold text-xs transition border border-white/15 flex items-center gap-1.5">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-400"></i>
                            <span>Simulasi Bayar Lunas (Dev)</span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="rounded-3xl p-6 sm:p-8 bg-emerald-50 border border-emerald-200 text-center space-y-4 shadow-sm">
                <div class="w-14 h-14 rounded-full bg-emerald-500 text-white flex items-center justify-center mx-auto text-2xl shadow-lg">
                    <i data-lucide="check" class="w-8 h-8"></i>
                </div>
                <div class="space-y-1">
                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-emerald-950">Transaksi Berhasil &amp; Akses Aktif!</h3>
                    <p class="text-xs text-emerald-800 max-w-md mx-auto">
                        Terima kasih! Pembayaran Anda sebesar <strong>Rp {{ number_format($order->total_amount !== null ? $order->total_amount : $order->amount, 0, ',', '.') }}</strong> telah diverifikasi pada {{ $order->paid_at ? $order->paid_at->isoFormat('D MMMM Y, HH:mm') : 'hari ini' }}.
                    </p>
                </div>

                @php
                    $themeItem = $order->items->firstWhere('item_type', 'theme');
                    $packageItem = $order->items->firstWhere('item_type', 'package');

                    if (Auth::user()?->isPartner()) {
                        $targetUrl = route('partner.invitations.create');
                        $btnLabel = 'Mulai Buat Undangan Klien';
                    } elseif (Auth::user()?->isSuperAdmin()) {
                        $targetUrl = route('invitations.create');
                        $btnLabel = 'Buat Undangan Digital';
                    } else {
                        $targetUrl = $themeItem ? route('member.invitations.create', ['theme_id' => $themeItem->item_id]) : route('member.invitations.create');
                        $btnLabel = 'Gunakan Template & Buat Undangan';
                    }
                @endphp

                <div class="pt-2">
                    <a href="{{ $targetUrl }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-lg transition">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>{{ $btnLabel }}</span>
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Midtrans Snap Popup Script -->
    @if(! $order->isPaid() && ! empty($snapToken) && ! empty($snapJsUrl) && ! empty($midtransClientKey))
        <script src="{{ $snapJsUrl }}" data-client-key="{{ $midtransClientKey }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const payButton = document.getElementById('pay-button');
                if (payButton) {
                    payButton.addEventListener('click', function () {
                        if (typeof window.snap === 'undefined') {
                            alert('Modul pembayaran Midtrans sedang dimuat. Mohon tunggu beberapa detik atau muat ulang halaman.');
                            return;
                        }

                        window.snap.pay('{{ $snapToken }}', {
                            onSuccess: function (result) {
                                window.location.reload();
                            },
                            onPending: function (result) {
                                window.location.reload();
                            },
                            onError: function (result) {
                                alert('Pembayaran tidak berhasil diselesaikan. Silakan coba kembali.');
                            },
                            onClose: function () {
                                console.log('Midtrans Snap popup ditutup.');
                            }
                        });
                    });
                }
            });
        </script>
    @endif
</x-member-layout>
