<div class="bg-white rounded-3xl border border-sand-300/80 p-6 sm:p-10 shadow-sm space-y-8 font-sans text-charcoal-900">
    
    <!-- TOP HEADER: COMPANY & INVOICE TITLE -->
    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-6 pb-6 border-b border-sand-200/80">
        <div class="space-y-2.5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-charcoal-900 text-brand-200 flex items-center justify-center font-serif text-2xl font-bold shadow-sm border border-brand-400/40">
                    K
                </div>
                <div>
                    <span class="font-serif text-2xl font-bold text-charcoal-950 flex items-center gap-0.5">
                        KlikMomen<span class="text-brand-500">.</span>
                    </span>
                    <span class="block text-[10px] tracking-[0.25em] uppercase text-sand-500 font-semibold">
                        Digital Invitation Studio
                    </span>
                </div>
            </div>
            <p class="text-xs text-sand-500 leading-relaxed max-w-sm">
                Platform Pembuatan Undangan Pernikahan Digital &amp; Manajemen Tamu Online.<br>
                Website: <span class="text-charcoal-800 font-medium">{{ config('app.url', 'www.klikmomen.com') }}</span><br>
                Bantuan WhatsApp: <span class="text-charcoal-800 font-medium">{{ \App\Models\Setting::get('support_whatsapp_number', '0812-3456-7890') }}</span>
            </p>
        </div>

        <div class="text-left sm:text-right space-y-1.5">
            <h2 class="font-serif text-3xl sm:text-4xl font-extrabold text-charcoal-950 tracking-wider">
                INVOICE
            </h2>
            <div class="text-xs font-mono text-sand-500">
                Nomor: <strong class="text-charcoal-900 font-bold">#INV-{{ $order->order_code }}</strong>
            </div>
            <div class="pt-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider border border-emerald-200 shadow-sm">
                    <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-600"></i>
                    <span>PAID / LUNAS</span>
                </span>
            </div>
        </div>
    </div>

    <!-- INVOICE METADATA (BILLED TO & PAYMENT DETAILS) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
        <!-- Billed To -->
        <div class="p-4 sm:p-5 rounded-2xl bg-sand-50/80 border border-sand-200/80 space-y-1.5">
            <span class="text-[10px] font-bold text-sand-500 uppercase tracking-wider block">
                Ditagihkan Kepada (Billed To):
            </span>
            <h3 class="font-bold text-sm sm:text-base text-charcoal-950">{{ $order->user->name }}</h3>
            <p class="text-xs text-sand-600 font-mono">{{ $order->user->email }}</p>
            <!-- <div class="pt-1">
                <span class="inline-block text-[10px] px-2.5 py-0.5 rounded-full bg-sand-200/80 text-charcoal-800 font-bold uppercase tracking-wider">
                    Akun: {{ ucfirst($order->user->role ?? 'Member') }}
                </span>
            </div> -->
        </div>

        <!-- Payment & Issue Details -->
        <div class="p-4 sm:p-5 rounded-2xl bg-sand-50/80 border border-sand-200/80 space-y-2 text-xs">
            <span class="text-[10px] font-bold text-sand-500 uppercase tracking-wider block">
                Informasi Pembayaran:
            </span>
            <div class="flex items-center justify-between text-sand-600">
                <span>Tanggal Terbit:</span>
                <strong class="text-charcoal-900">{{ $order->created_at->isoFormat('D MMMM Y') }}</strong>
            </div>
            <div class="flex items-center justify-between text-sand-600">
                <span>Tanggal Pembayaran:</span>
                <strong class="text-emerald-700">{{ $order->paid_at ? $order->paid_at->isoFormat('D MMMM Y, HH:mm') : 'Hari ini' }}</strong>
            </div>
            <!-- <div class="flex items-center justify-between text-sand-600">
                <span>Metode Pembayaran:</span>
                <strong class="text-charcoal-900 uppercase font-mono">{{ $order->payment_method ?? 'Midtrans' }}</strong>
            </div> -->
        </div>
    </div>

    <!-- INVOICE ITEMS TABLE -->
    <div class="overflow-x-auto rounded-2xl border border-sand-200/90 shadow-sm">
        <table class="w-full text-left text-xs border-collapse">
            <thead>
                <tr class="border-b border-sand-200 bg-sand-100/70 text-charcoal-950 font-bold uppercase tracking-wider text-[11px]">
                    <th class="py-3 px-4 w-12 text-center">No</th>
                    <th class="py-3 px-4">Deskripsi Item / Layanan</th>
                    <th class="py-3 px-4 w-28 text-center">Tipe</th>
                    <th class="py-3 px-4 w-16 text-center">Qty</th>
                    <th class="py-3 px-4 w-32 text-right">Harga Satuan</th>
                    <th class="py-3 px-4 w-36 text-right">Jumlah</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sand-200/70 bg-white">
                @foreach($order->items as $index => $item)
                    <tr class="hover:bg-sand-50/50 transition">
                        <td class="py-3.5 px-4 text-center font-mono text-sand-500 font-semibold">{{ $index + 1 }}</td>
                        <td class="py-3.5 px-4 space-y-0.5">
                            @php
                                $cleanItemName = preg_replace('/\s*\((?:lifetime|\d+\s*hari).*$/i', '', (string) $item->item_name);
                            @endphp
                            <span class="font-bold text-charcoal-950 text-sm block">{{ $cleanItemName }}</span>
                            @if($item->item_type === 'theme')
                                <span class="text-[11px] text-sand-500 flex items-center gap-1">
                                    <i data-lucide="clock" class="w-3 h-3 text-sand-400"></i>
                                    <span>Masa Lisensi: {{ $order->metadata['duration_label'] ?? (($order->metadata['duration'] ?? '') === 'lifetime' ? 'Lifetime (Selamanya)' : '45 Hari') }}</span>
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $item->item_type === 'theme' ? 'bg-amber-100 text-amber-900 border border-amber-200' : 'bg-blue-100 text-blue-900 border border-blue-200' }}">
                                {{ $item->item_type }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center font-semibold text-charcoal-800">{{ $item->quantity }}</td>
                        <td class="py-3.5 px-4 text-right font-medium text-sand-700 font-mono">{{ format_rupiah($item->price) }}</td>
                        <td class="py-3.5 px-4 text-right font-bold text-charcoal-950 font-mono">{{ format_rupiah($item->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- INVOICE TOTALS & NOTES -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-6 pt-2">
        <div class="space-y-2 max-w-sm">
            <!-- @if(($order->metadata['service_type'] ?? '') === 'assisted')
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-sand-100/80 text-charcoal-800 text-xs border border-sand-200">
                    <i data-lucide="headphones" class="w-3.5 h-3.5 text-blue-600"></i>
                    <span>Layanan Diisikan Oleh Tim Kami (Terima Beres)</span>
                </div>
            @endif -->

            <p class="text-[11px] text-sand-400 leading-relaxed">
                Bukti pembayaran resmi diterbitkan secara digital oleh <strong>KlikMomen</strong>.
            </p>
        </div>

        <!-- Price Breakdown -->
        <div class="w-full sm:w-80 space-y-2.5 text-xs bg-sand-50/70 p-4 rounded-2xl border border-sand-200/80">
            <div class="flex items-center justify-between text-sand-600">
                <span>Subtotal:</span>
                <span class="font-semibold text-charcoal-900 font-mono">{{ format_rupiah($order->amount) }}</span>
            </div>

            @if($order->discount > 0 || $order->coupon)
                <div class="flex items-center justify-between text-emerald-700">
                    <span class="flex items-center gap-1">
                        <i data-lucide="tag" class="w-3.5 h-3.5"></i>
                        <span>Diskon Kupon ({{ $order->coupon?->code ?? 'PROMO' }}):</span>
                    </span>
                    <span class="font-bold font-mono">-{{ format_rupiah($order->discount) }}</span>
                </div>
            @endif

            @if((float) ($order->tax_amount ?? 0) > 0)
                <div class="flex items-center justify-between text-sand-600">
                    <span>PPN (11%):</span>
                    <span class="font-semibold text-charcoal-900 font-mono">+{{ format_rupiah($order->tax_amount) }}</span>
                </div>
            @endif

            <div class="pt-2.5 border-t border-sand-300/80 flex items-baseline justify-between text-charcoal-950 font-bold">
                <span class="text-sm">Total Dibayar:</span>
                <span class="text-2xl font-serif font-extrabold text-emerald-700 font-mono">{{ format_rupiah($order->total_amount ?? $order->amount) }}</span>
            </div>
        </div>
    </div>

</div>
