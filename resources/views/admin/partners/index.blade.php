<x-app-layout>
    <div class="space-y-8" x-data="{ toast: { show: false, message: '' }, showToast(msg) { this.toast.message = msg; this.toast.show = true; setTimeout(() => this.toast.show = false, 3000); } }">
        
        <!-- TOAST NOTIFICATION -->
        <div 
            x-show="toast.show" 
            x-transition 
            class="fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl bg-charcoal-950 text-white text-xs font-bold shadow-2xl flex items-center gap-2 border border-brand-500/40"
            style="display: none;"
        >
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
            <span x-text="toast.message"></span>
        </div>

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">
                    <span>Program Reseller & WO</span>
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                    Kemitraan Wedding Organizer (WO)
                </h1>
                <p class="text-xs text-sand-600">
                    Kelola kuota paket kemitraan reseller, status white-label branding, dan domain kustom untuk klien Anda.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ url('/#partner') }}" target="_blank" class="px-5 py-3 rounded-2xl bg-charcoal-950 hover:bg-brand-600 text-white font-bold text-xs transition flex items-center gap-2 shadow">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    <span>Lihat Halaman Kemitraan</span>
                </a>
            </div>
        </div>

        <!-- WHITE-LABEL ADVANTAGE HERO CARD -->
        <div class="p-8 sm:p-10 rounded-3xl bg-gradient-to-r from-charcoal-950 via-charcoal-900 to-brand-950 text-white shadow-xl border border-charcoal-800 space-y-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2 max-w-xl">
                    <span class="text-[11px] font-bold text-amber-300 uppercase tracking-widest">Fitur Eksklusif Partner</span>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold">100% White-Label & Subdomain Sendiri</h2>
                    <p class="text-xs sm:text-sm text-sand-300 leading-relaxed">
                        Undangan klien sepenuhnya menggunakan nama, logo, dan nomor WhatsApp Wedding Organizer Anda tanpa watermark atau embel-embel pihak ketiga.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-3 text-center">
                    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15">
                        <span class="font-serif text-xl font-bold text-amber-200">100%</span>
                        <span class="text-[10px] text-sand-300 block uppercase">Margin Profit</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15">
                        <span class="font-serif text-xl font-bold text-amber-200">24/7</span>
                        <span class="text-[10px] text-sand-300 block uppercase">Support VIP</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PARTNER TIERS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- TIER 1 -->
            <div class="p-8 rounded-3xl glass-panel border border-sand-200 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Freelance & Desainer</span>
                    <h3 class="font-serif text-2xl font-bold text-charcoal-950">Starter Partner</h3>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">
                        Rp 299.000
                        <span class="text-xs font-sans text-sand-500">/ 10 Undangan</span>
                    </div>
                    <ul class="space-y-2.5 pt-4 border-t border-sand-200 text-xs text-sand-700">
                        <li class="flex items-center gap-2">✓ <strong>10 Kuota Undangan</strong></li>
                        <li class="flex items-center gap-2">✓ Akses Seluruh Katalog Tema</li>
                        <li class="flex items-center gap-2">✓ Dashboard Kelola Klien</li>
                        <li class="flex items-center gap-2">✓ Bebas Tentukan Harga Jual</li>
                    </ul>
                </div>
                <button type="button" @click="showToast('Permintaan top-up paket Starter telah diajukan!')" class="w-full py-3 rounded-2xl bg-sand-200 hover:bg-charcoal-950 hover:text-white font-bold text-xs transition">
                    Top-Up Kuota Starter
                </button>
            </div>

            <!-- TIER 2 (FEATURED) -->
            <div class="p-8 rounded-3xl bg-charcoal-950 text-white flex flex-col justify-between space-y-6 shadow-2xl relative ring-2 ring-brand-500">
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-3.5 py-0.5 rounded-full bg-gradient-to-r from-brand-600 to-brand-400 text-white text-[10px] font-bold uppercase tracking-wider shadow">
                    🌟 Paling Populer (Best for WO)
                </div>
                <div class="space-y-4 pt-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-brand-400">Wedding Organizer & Studio</span>
                    <h3 class="font-serif text-2xl font-bold text-white">Pro WO & Studio</h3>
                    <div class="font-serif text-3xl font-bold text-white">
                        Rp 599.000
                        <span class="text-xs font-sans text-sand-400">/ 30 Undangan</span>
                    </div>
                    <ul class="space-y-2.5 pt-4 border-t border-brand-900/60 text-xs text-sand-300">
                        <li class="flex items-center gap-2">✓ <strong>30 Kuota Undangan Aktif</strong></li>
                        <li class="flex items-center gap-2">✓ <strong>100% White-Label (Brand Anda)</strong></li>
                        <li class="flex items-center gap-2">✓ Custom Domain / Subdomain Klien</li>
                        <li class="flex items-center gap-2">✓ WhatsApp Blaster & Broadcast Helper</li>
                        <li class="flex items-center gap-2">✓ QR Code Check-in Tamu Resepsi</li>
                    </ul>
                </div>
                <button type="button" @click="showToast('Permintaan aktivasi paket Pro WO telah diajukan!')" class="w-full py-3.5 rounded-2xl bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-500 hover:to-brand-600 text-white font-bold text-xs shadow-lg transition">
                    Aktivasi Paket Pro WO
                </button>
            </div>

            <!-- TIER 3 -->
            <div class="p-8 rounded-3xl glass-panel border border-sand-200 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Skala Besar</span>
                    <h3 class="font-serif text-2xl font-bold text-charcoal-950">Enterprise Partner</h3>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">
                        Rp 1.499.000
                        <span class="text-xs font-sans text-sand-500">/ 100 Undangan</span>
                    </div>
                    <ul class="space-y-2.5 pt-4 border-t border-sand-200 text-xs text-sand-700">
                        <li class="flex items-center gap-2">✓ <strong>100+ Kuota Undangan</strong></li>
                        <li class="flex items-center gap-2">✓ Akses REST API & Webhook</li>
                        <li class="flex items-center gap-2">✓ Custom Template Eksklusif Brand</li>
                        <li class="flex items-center gap-2">✓ Dedicated Server & Kontrak SLA</li>
                    </ul>
                </div>
                <button type="button" @click="showToast('Tim representatif kami akan menghubungi Anda!')" class="w-full py-3 rounded-2xl bg-sand-200 hover:bg-charcoal-950 hover:text-white font-bold text-xs transition">
                    Konsultasi Enterprise
                </button>
            </div>

        </div>

    </div>
</x-app-layout>
