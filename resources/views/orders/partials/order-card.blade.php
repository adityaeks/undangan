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

<!-- BANTUAN DIISIKAN TIM BANNER -->
@if(($order->metadata['service_type'] ?? '') === 'assisted')
    <div class="py-3 px-4 rounded-2xl bg-sand-50 border border-sand-200 text-charcoal-800 text-xs flex items-center gap-2.5">
        <i data-lucide="headphones" class="w-4 h-4 text-brand-600 shrink-0"></i>
        <span class="font-semibold">Layanan Diisikan Oleh Tim Kami</span>
        <span class="text-sand-400">•</span>
        <span class="text-sand-500">Kirim materi data pernikahan via WhatsApp setelah pembayaran</span>
    </div>
@endif

<!-- ORDER ITEMS BREAKDOWN -->
<div class="rounded-3xl glass-panel bg-white/95 border border-sand-200/80 p-6 sm:p-8 space-y-6 shadow-sm">
    <div class="flex items-center justify-between border-b border-sand-200/60 pb-3">
        <h2 class="font-serif text-lg font-bold text-charcoal-950">Rincian Item</h2>
        <span class="text-xs text-sand-500 font-medium">{{ $order->items->count() }} Item Pesanan</span>
    </div>

    <div class="divide-y divide-sand-200/60">
        @foreach($order->items as $item)
            <div class="py-4 flex items-center justify-between gap-4">
                <div class="space-y-1">
                    @php
                        $cleanItemName = preg_replace('/\s*\((?:lifetime|\d+\s*hari).*$/i', '', (string) $item->item_name);
                    @endphp
                    <h3 class="text-sm font-bold text-charcoal-950">{{ $cleanItemName }}</h3>
                    <div class="flex items-center gap-2 text-xs text-sand-500">
                        <span class="px-2 py-0.5 rounded-md bg-sand-100 text-charcoal-800 text-[10px] font-bold uppercase">{{ ucfirst($item->item_type) }}</span>
                        <span>Jml: {{ $item->quantity }}</span>
                        @if($item->item_type === 'theme' && (isset($order->metadata['duration_label']) || isset($order->metadata['duration'])))
                            <span>• Masa Lisensi: {{ $order->metadata['duration_label'] ?? (($order->metadata['duration'] ?? '') === 'lifetime' ? 'Lifetime (Selamanya)' : '45 Hari') }}</span>
                        @endif
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-sm sm:text-base font-bold text-charcoal-950 font-serif">{{ format_rupiah($item->subtotal) }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="border-t border-sand-200/80 pt-4 space-y-3">
        <div class="flex items-center justify-between text-sm text-sand-600">
            <span>Subtotal:</span>
            <span class="font-medium text-charcoal-900">{{ format_rupiah($order->amount) }}</span>
        </div>

        @if($order->discount > 0 || $order->coupon)
            <div class="flex items-center justify-between text-sm text-emerald-700 bg-emerald-50 px-3.5 py-2.5 rounded-xl border border-emerald-200/70">
                <div class="flex items-center gap-2">
                    <i data-lucide="tag" class="w-4 h-4 text-emerald-600"></i>
                    <span>Diskon Kupon (<strong>{{ $order->coupon?->code ?? 'PROMO' }}</strong>):</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-bold">-{{ format_rupiah($order->discount) }}</span>
                    @if(! $order->isPaid())
                        <form action="{{ route('orders.coupon.remove', ['order' => $order, 'from' => request('from')]) }}" method="POST" class="inline">
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

        @php
            $displayTax = (float) ($order->tax_amount ?? 0);
            if ($displayTax <= 0 && ! $order->isPaid()) {
                $taxable = max(0, (float) $order->amount - (float) ($order->discount ?? 0));
                $displayTax = round($taxable * 0.11);
            }
        @endphp

        @if($displayTax > 0)
            <div class="flex items-center justify-between text-sm text-sand-600">
                <span>PPN (11%):</span>
                <span class="font-semibold text-charcoal-900 font-mono">+{{ format_rupiah($displayTax) }}</span>
            </div>
        @endif

        <div class="flex items-center justify-between text-base font-bold text-charcoal-950 pt-3 border-t border-sand-200/60">
            <div>
                <span class="block">Total Tagihan:</span>
                <span class="text-[10px] text-sand-500 font-normal">Harga final sudah termasuk PPN 11% & layanan</span>
            </div>
            <span class="text-2xl sm:text-3xl text-amber-700 font-serif font-extrabold">{{ format_rupiah($order->total_amount ?? $order->amount) }}</span>
        </div>
    </div>

    @if(! $order->isPaid() && ! $order->isExpired() && ! $order->coupon)
        <div class="border-t border-sand-200/80 pt-4">
            <form action="{{ route('orders.coupon.apply', ['order' => $order, 'from' => request('from')]) }}" method="POST" class="flex flex-col sm:flex-row gap-2.5">
                @csrf
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="ticket" class="w-4 h-4"></i>
                    </div>
                    <input type="text" name="code" value="{{ old('code') }}" placeholder="Punya kupon promo? (Cth: MOMENINDAH)" required
                        class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-sand-300 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 uppercase tracking-wider font-semibold placeholder:font-normal placeholder:tracking-normal placeholder:normal-case">
                </div>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white font-bold text-xs tracking-wider uppercase transition shadow-sm flex items-center justify-center gap-1.5">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>Terapkan Kupon</span>
                </button>
            </form>
            @error('code')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
    @endif
</div>

<!-- PAYMENT ACTIONS -->
@if($order->isPaid())
    <div class="rounded-3xl p-6 sm:p-8 bg-emerald-50 border border-emerald-200 text-center space-y-4 shadow-sm">
        <div class="w-14 h-14 rounded-full bg-emerald-500 text-white flex items-center justify-center mx-auto text-2xl shadow-lg">
            <i data-lucide="check" class="w-8 h-8"></i>
        </div>
        <div class="space-y-1">
            <h3 class="font-serif text-xl sm:text-2xl font-bold text-emerald-950">Transaksi Berhasil &amp; Akses Aktif!</h3>
            <p class="text-xs text-emerald-800 max-w-md mx-auto">
                Terima kasih! Pembayaran Anda sebesar <strong>{{ format_rupiah($order->total_amount ?? $order->amount) }}</strong> telah diverifikasi pada {{ $order->paid_at ? $order->paid_at->isoFormat('D MMMM Y, HH:mm') : 'hari ini' }}.
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
            <a href="{{ $targetUrl }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-lg transition hover:scale-105">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>{{ $btnLabel }}</span>
            </a>
        </div>
    </div>
@elseif($order->isExpired())
    @php
        $themeItem = $order->items->firstWhere('item_type', 'theme');
        $packageItem = $order->items->firstWhere('item_type', 'package');
        if ($themeItem) {
            $reorderUrl = route('checkout.theme', [
                'theme' => $themeItem->item_id,
                'duration' => $order->metadata['duration'] ?? '45_days',
                'service_type' => $order->metadata['service_type'] ?? 'self_service',
            ]);
        } elseif ($packageItem) {
            $reorderUrl = route('checkout.package', ['package' => $packageItem->item_id]);
        } else {
            $reorderUrl = route('themes.catalog');
        }
    @endphp

    <div class="rounded-3xl p-6 sm:p-8 bg-rose-50/90 border border-rose-200 text-center space-y-4 shadow-sm">
        <div class="w-14 h-14 rounded-full bg-rose-100 text-rose-600 border border-rose-300 flex items-center justify-center mx-auto text-2xl shadow-sm">
            <i data-lucide="clock" class="w-7 h-7"></i>
        </div>
        <div class="space-y-1.5 max-w-md mx-auto">
            <h3 class="font-serif text-xl font-bold text-rose-950">Waktu Pembayaran Telah Kedaluwarsa</h3>
            <p class="text-xs text-rose-800 leading-relaxed">
                Batas waktu pembayaran 24 jam untuk transaksi ini telah berakhir. Token pembayaran sudah tidak aktif. Silakan lakukan pemesanan ulang untuk melanjutkan.
            </p>
        </div>

        <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ $reorderUrl }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-amber-600 to-brand-700 hover:from-amber-700 hover:to-brand-800 text-white text-xs font-bold shadow-lg hover:shadow-amber-500/25 transition">
                <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                <span>Pesan Ulang / Bayar Lagi</span>
            </a>
            <a href="{{ route('themes.catalog') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-sand-200 hover:bg-sand-300 text-charcoal-900 text-xs font-bold transition">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                <span>Lihat Katalog Tema</span>
            </a>
        </div>
    </div>
@else
    <!-- PENDING: COUNTDOWN & PAYMENT ACTIONS -->
    <div class="space-y-4 pt-1">
        @if($order->expires_at)
            <!-- COUNTDOWN TIMER CARD -->
            <div 
                x-data="{
                    deadline: {{ $order->expires_at->getTimestamp() * 1000 }},
                    timeLeft: '--:--:--',
                    updateCountdown() {
                        const now = new Date().getTime();
                        const distance = this.deadline - now;
                        if (distance <= 0) {
                            this.timeLeft = '00:00:00';
                            window.location.reload();
                            return;
                        }
                        const hours = Math.floor(distance / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        this.timeLeft = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                    },
                    init() {
                        this.updateCountdown();
                        setInterval(() => this.updateCountdown(), 1000);
                    }
                }"
                class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-charcoal-900 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-sm"
            >
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-500/20 text-amber-800 flex items-center justify-center shrink-0">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold block text-charcoal-950">Batas Waktu Pembayaran (24 Jam)</span>
                        <span class="text-[11px] text-sand-600">Selesaikan pembayaran sebelum <strong class="text-charcoal-900">{{ $order->expires_at->isoFormat('D MMMM Y, HH:mm') }} WIB</strong></span>
                    </div>
                </div>
                <div class="flex items-center gap-2 self-start sm:self-auto shrink-0">
                    <span class="text-[11px] font-semibold text-sand-500">Sisa Waktu:</span>
                    <span class="px-3.5 py-1.5 rounded-xl bg-white border border-amber-300/80 font-mono font-bold text-amber-900 text-xs shadow-sm tracking-wider" x-text="timeLeft">
                        --:--:--
                    </span>
                </div>
            </div>
        @endif

        @if(! empty($snapToken))
            <button 
                id="pay-button" 
                type="button" 
                class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 hover:from-amber-600 hover:to-amber-800 text-white font-bold text-base shadow-xl hover:shadow-amber-500/30 active:scale-[0.99] transition-all flex items-center justify-center gap-2.5 cursor-pointer"
            >
                <i data-lucide="lock" class="w-5 h-5"></i>
                <span>Bayar Sekarang</span>
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </button>
        @elseif(! $isMidtransConfigured)
            <div class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-900 text-xs space-y-1">
                <div class="flex items-center gap-2 font-bold text-amber-800">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                    <span>Konfigurasi Midtrans Diperlukan</span>
                </div>
                <p class="text-sand-600 text-[11px]">
                    Kunci API Midtrans belum diisi di file .env.
                </p>
            </div>
        @endif

        @if(app()->environment('local', 'testing'))
            <div class="flex justify-end pt-1">
                <form action="{{ route('orders.simulate', ['order' => $order, 'from' => request('from')]) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-[11px] text-sand-400 hover:text-sand-600 transition flex items-center gap-1 cursor-pointer">
                        <i data-lucide="check" class="w-3 h-3 text-emerald-500"></i>
                        <span>Simulasi Bayar Lunas (Dev)</span>
                    </button>
                </form>
            </div>
        @endif
    </div>
@endif

<!-- Midtrans Snap Popup Script -->
@if(! $order->isPaid() && ! $order->isExpired() && ! empty($snapToken) && ! empty($snapJsUrl) && ! empty($midtransClientKey))
    <script src="{{ $snapJsUrl }}" data-client-key="{{ $midtransClientKey }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const payButton = document.getElementById('pay-button');
            if (payButton) {
                payButton.addEventListener('click', function () {
                    if (typeof window.snap === 'undefined') {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Memuat Pembayaran',
                                text: 'Modul pembayaran Midtrans sedang dimuat. Mohon tunggu beberapa detik atau muat ulang halaman.',
                                confirmButtonColor: '#8A7245'
                            });
                        } else {
                            alert('Modul pembayaran Midtrans sedang dimuat. Mohon tunggu beberapa detik atau muat ulang halaman.');
                        }
                        return;
                    }

                    window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function (result) {
                            window.location.href = "{{ route('orders.success', ['order' => $order, 'from' => request('from')]) }}";
                        },
                        onPending: function (result) {
                            window.location.reload();
                        },
                        onError: function (result) {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Pembayaran Gagal',
                                    text: 'Pembayaran tidak berhasil diselesaikan. Silakan coba kembali.',
                                    confirmButtonColor: '#8A7245'
                                });
                            } else {
                                alert('Pembayaran tidak berhasil diselesaikan. Silakan coba kembali.');
                            }
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
