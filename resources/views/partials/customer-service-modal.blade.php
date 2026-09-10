<!-- ============================================== -->
<!-- FLOATING ACTIONS CONTAINER (SCROLL TO TOP + CS) -->
<!-- ============================================== -->
<div 
    class="fixed bottom-6 right-6 z-40 flex flex-col items-center gap-2.5"
    x-data="{ 
        showScrollTop: false,
        checkScroll() {
            this.showScrollTop = window.scrollY > 280;
        },
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }"
    x-init="checkScroll()"
    @scroll.window.passive="checkScroll()"
>
    <!-- SCROLL TO TOP BUTTON (DI ATAS BUTTON CS) -->
    <button 
        type="button" 
        x-show="showScrollTop" 
        x-cloak
        @click="scrollToTop()"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2 scale-90"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 translate-y-2 scale-90"
        class="w-11 h-11 rounded-full bg-white/95 hover:bg-white text-charcoal-800 hover:text-brand-600 border border-sand-300/90 shadow-lg hover:shadow-xl hover:scale-110 active:scale-95 transition-all duration-200 flex items-center justify-center backdrop-blur-md cursor-pointer group"
        aria-label="Kembali ke atas"
        title="Kembali ke atas"
    >
        <i data-lucide="arrow-up" class="w-4 h-4 group-hover:-translate-y-0.5 transition-transform duration-200"></i>
    </button>

    <!-- FLOATING CIRCULAR CS BUTTON -->
    <button 
        type="button" 
        @click="openCsModal()"
        class="relative w-14 h-14 rounded-full bg-gradient-to-br from-charcoal-950 via-charcoal-900 to-charcoal-950 text-brand-300 hover:text-white border border-brand-400/40 shadow-2xl shadow-charcoal-950/40 hover:border-brand-400 hover:scale-110 active:scale-95 transition-all duration-300 flex items-center justify-center cursor-pointer group"
        aria-label="Customer Service & FAQ"
        title="Customer Service & FAQ"
    >
        <i data-lucide="headset" class="w-6 h-6 group-hover:scale-110 transition-transform"></i>
        
        <!-- Pulsing Online Status Dot -->
        <span class="absolute top-0.5 right-0.5 flex h-3.5 w-3.5">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-500 border-2 border-charcoal-950"></span>
        </span>
    </button>
</div>

<!-- ============================================== -->
<!-- COMPACT CUSTOMER SERVICE & FAQ POPUP -->
<!-- ============================================== -->
<template x-teleport="body">
    <div 
        x-show="csModalOpen" 
        x-cloak 
        style="display: none;"
        class="fixed inset-0 z-[100] bg-charcoal-950/40 backdrop-blur-xs flex items-center justify-center sm:justify-end p-3 sm:p-6 sm:pr-8 pointer-events-auto"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @keydown.escape.window="closeCsModal()"
    >
        <!-- BACKDROP OVERLAY (TRANSPARENT BLUR) -->
        <div class="fixed inset-0" @click="closeCsModal()"></div>

        <!-- COMPACT WIDGET CARD (VERTICALLY CENTERED - NEVER CLIPPED) -->
        <div 
            class="relative w-full max-w-[340px] sm:max-w-[360px] bg-white rounded-3xl shadow-2xl border border-sand-200 overflow-hidden z-10 flex flex-col max-h-[calc(100dvh-2.5rem)]"
            @click.stop
        >
            <!-- TOP ACCENT LINE -->
            <div class="h-1 w-full bg-gradient-to-r from-brand-600 via-brand-400 to-brand-700 shrink-0"></div>

            <!-- COMPACT HEADER (ALWAYS VISIBLE AT TOP) -->
            <div class="px-4 py-2.5 bg-sand-50/90 border-b border-sand-200/80 flex items-center justify-between gap-2.5 shrink-0">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-charcoal-950 text-brand-300 flex items-center justify-center shrink-0">
                        <i data-lucide="headset" class="w-3.5 h-3.5 text-brand-400"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <h4 class="font-serif text-xs font-bold text-charcoal-950">Customer Service</h4>
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        </div>
                        <p class="text-[9px] text-sand-500 leading-none">KlikMomen Support</p>
                    </div>
                </div>

                <!-- CLOSE BUTTON -->
                <button 
                    type="button" 
                    @click="closeCsModal()"
                    class="w-6 h-6 rounded-full bg-sand-200/60 hover:bg-sand-200 text-charcoal-700 flex items-center justify-center transition cursor-pointer shrink-0"
                    aria-label="Tutup"
                >
                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                </button>
            </div>

            <!-- BODY CONTENT (SCROLLABLE CONTAINER) -->
            <div 
                class="p-3.5 overflow-y-auto min-h-0 space-y-2.5 flex-1 overscroll-contain"
                style="scrollbar-width: thin;"
            >

                <!-- DIRECT WHATSAPP BUTTON (COMPACT) -->
                <a 
                    href="https://wa.me/6281234567890?text=Halo%20Admin%20KlikMomen,%20saya%20ingin%20tanya%20seputar%20pembuatan%20undangan%20digital."
                    target="_blank"
                    class="flex items-center justify-between p-2.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white shadow-md hover:shadow-emerald-600/20 active:scale-[0.98] transition group"
                >
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5 text-white"></i>
                        </div>
                        <div class="text-left">
                            <span class="text-[11px] font-bold block leading-tight">Chat CS via WhatsApp</span>
                            <span class="text-[9px] text-emerald-100">Respon cepat setiap hari</span>
                        </div>
                    </div>
                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 opacity-80 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
                </a>

                <!-- SECTION TITLE -->
                <div class="flex items-center justify-between pt-1 border-t border-sand-100">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Pertanyaan Umum (FAQ)</span>
                    <span class="text-[9px] text-sand-400">5 info penting</span>
                </div>

                <!-- 5 COMPACT ACCORDIONS -->
                <div class="space-y-1.5 text-xs" x-data="{ active: null }">

                    <!-- FAQ 1 -->
                    <div class="rounded-xl border border-sand-200/90 bg-sand-50/40 overflow-hidden">
                        <button 
                            type="button" 
                            @click="active = (active === 1 ? null : 1)"
                            class="w-full p-2.5 text-left font-semibold text-charcoal-900 flex items-center justify-between gap-2 cursor-pointer hover:text-brand-700 transition"
                        >
                            <span class="text-[11px]">Berapa lama proses pembuatannya?</span>
                            <i data-lucide="chevron-down" class="w-3 h-3 shrink-0 text-sand-400 transition-transform duration-200" :class="active === 1 ? 'rotate-180 text-brand-600' : ''"></i>
                        </button>
                        <div x-show="active === 1" x-cloak class="px-2.5 pb-2.5 text-[10.5px] text-sand-700 leading-relaxed border-t border-sand-200/50 pt-1.5 font-normal">
                            Undangan langsung aktif dalam 5-10 menit jika Anda mengisi data mandiri. Jika memilih layanan dibantu admin, selesai maksimal dalam 1x24 jam.
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="rounded-xl border border-sand-200/90 bg-sand-50/40 overflow-hidden">
                        <button 
                            type="button" 
                            @click="active = (active === 2 ? null : 2)"
                            class="w-full p-2.5 text-left font-semibold text-charcoal-900 flex items-center justify-between gap-2 cursor-pointer hover:text-brand-700 transition"
                        >
                            <span class="text-[11px]">Apakah data bisa diedit setelah disebar?</span>
                            <i data-lucide="chevron-down" class="w-3 h-3 shrink-0 text-sand-400 transition-transform duration-200" :class="active === 2 ? 'rotate-180 text-brand-600' : ''"></i>
                        </button>
                        <div x-show="active === 2" x-cloak class="px-2.5 pb-2.5 text-[10.5px] text-sand-700 leading-relaxed border-t border-sand-200/50 pt-1.5 font-normal">
                            Bisa! Anda memiliki akses dashboard penuh untuk merevisi jadwal, lokasi Google Maps, foto galeri, hingga musik kapan saja tanpa mengubah link undangan.
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="rounded-xl border border-sand-200/90 bg-sand-50/40 overflow-hidden">
                        <button 
                            type="button" 
                            @click="active = (active === 3 ? null : 3)"
                            class="w-full p-2.5 text-left font-semibold text-charcoal-900 flex items-center justify-between gap-2 cursor-pointer hover:text-brand-700 transition"
                        >
                            <span class="text-[11px]">Berapa lama masa aktif undangan?</span>
                            <i data-lucide="chevron-down" class="w-3 h-3 shrink-0 text-sand-400 transition-transform duration-200" :class="active === 3 ? 'rotate-180 text-brand-600' : ''"></i>
                        </button>
                        <div x-show="active === 3" x-cloak class="px-2.5 pb-2.5 text-[10.5px] text-sand-700 leading-relaxed border-t border-sand-200/50 pt-1.5 font-normal">
                            Tersedia Paket Standar (45 Hari) yang cukup sampai acara selesai, serta Paket Lifetime (Aktif Selamanya) untuk kenang-kenangan digital abadi Anda.
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="rounded-xl border border-sand-200/90 bg-sand-50/40 overflow-hidden">
                        <button 
                            type="button" 
                            @click="active = (active === 4 ? null : 4)"
                            class="w-full p-2.5 text-left font-semibold text-charcoal-900 flex items-center justify-between gap-2 cursor-pointer hover:text-brand-700 transition"
                        >
                            <span class="text-[11px]">Apakah ada potongan untuk amplop digital?</span>
                            <i data-lucide="chevron-down" class="w-3 h-3 shrink-0 text-sand-400 transition-transform duration-200" :class="active === 4 ? 'rotate-180 text-brand-600' : ''"></i>
                        </button>
                        <div x-show="active === 4" x-cloak class="px-2.5 pb-2.5 text-[10.5px] text-sand-700 leading-relaxed border-t border-sand-200/50 pt-1.5 font-normal">
                            0% potongan (bebas biaya). Dana dari tamu ditransfer langsung ke nomor rekening bank atau scan QRIS pribadi milik Anda.
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="rounded-xl border border-sand-200/90 bg-sand-50/40 overflow-hidden">
                        <button 
                            type="button" 
                            @click="active = (active === 5 ? null : 5)"
                            class="w-full p-2.5 text-left font-semibold text-charcoal-900 flex items-center justify-between gap-2 cursor-pointer hover:text-brand-700 transition"
                        >
                            <span class="text-[11px]">Bagaimana cara kirim ke banyak tamu?</span>
                            <i data-lucide="chevron-down" class="w-3 h-3 shrink-0 text-sand-400 transition-transform duration-200" :class="active === 5 ? 'rotate-180 text-brand-600' : ''"></i>
                        </button>
                        <div x-show="active === 5" x-cloak class="px-2.5 pb-2.5 text-[10.5px] text-sand-700 leading-relaxed border-t border-sand-200/50 pt-1.5 font-normal">
                            Tersedia fitur ganti nama tamu otomatis &amp; direct WhatsApp share. Anda cukup masukkan nama tamu dan klik kirim untuk menyapa secara personal.
                        </div>
                    </div>

                </div>

            </div>

            <!-- COMPACT FOOTER (ALWAYS VISIBLE AT BOTTOM) -->
            <div class="px-3 py-2 bg-sand-50/90 border-t border-sand-200/70 text-center text-[10px] text-sand-500 shrink-0">
                Punya kendala lain? <a href="https://wa.me/6281234567890" target="_blank" class="text-brand-700 font-bold hover:underline">Hubungi WhatsApp Kami</a>
            </div>

        </div>
    </div>
</template>
