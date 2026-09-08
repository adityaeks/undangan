<!-- DESIGN SELECTION & VARIANT MODAL (COMPACT LUXURY REDESIGN) -->
<template x-teleport="body">
<div 
    x-show="orderModalOpen" 
    x-cloak 
    style="display: none;"
    class="fixed inset-0 z-[100] overflow-y-auto bg-charcoal-950/80 backdrop-blur-md flex items-center justify-center p-4 sm:p-6"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <!-- STATIC BACKDROP -->
    <div class="fixed inset-0 pointer-events-none"></div>

    <!-- MODAL CONTAINER -->
    <div 
        class="relative w-full max-w-lg sm:max-w-xl bg-white rounded-3xl shadow-2xl border border-sand-200/90 overflow-hidden my-auto flex flex-col"
        @click.stop
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-3"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-3"
    >
        <!-- TOP ACCENT LINE -->
        <div class="h-1 w-full bg-gradient-to-r from-brand-500 via-amber-400 to-brand-600 shrink-0"></div>

        <!-- HEADER -->
        <div class="px-5 py-4 sm:px-6 sm:py-4.5 border-b border-sand-200/70 bg-gradient-to-b from-sand-50/80 to-white flex items-center justify-between gap-3 shrink-0">
            <div class="flex items-center gap-3.5 min-w-0">
                <!-- THUMBNAIL -->
                <div class="w-12 h-12 rounded-2xl overflow-hidden bg-sand-200 border border-sand-200 shadow-xs shrink-0">
                    <img 
                        :src="selectedTheme ? selectedTheme.thumbnail : ''" 
                        :alt="selectedTheme ? selectedTheme.name : 'Theme'" 
                        class="w-full h-full object-cover"
                    >
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <span 
                            class="px-2 py-0.5 rounded-md text-[9px] font-extrabold uppercase tracking-wider"
                            :class="selectedTheme ? selectedTheme.tag_badge_class : 'bg-brand-500 text-white'"
                            x-text="selectedTheme ? selectedTheme.tag : 'Desain'"
                        ></span>
                        <span class="text-[10px] text-sand-500 truncate" x-text="selectedTheme ? selectedTheme.category_label : ''"></span>
                    </div>
                    <h3 class="font-serif text-base sm:text-lg font-bold text-charcoal-950 truncate mt-0.5" x-text="selectedTheme ? selectedTheme.name : 'Pilih Varian Undangan'"></h3>
                </div>
            </div>

            <!-- CLOSE BUTTON -->
            <button 
                type="button" 
                @click="closeOrderModal()" 
                class="w-8 h-8 rounded-full bg-sand-100 hover:bg-sand-200 text-charcoal-500 hover:text-charcoal-900 flex items-center justify-center transition shrink-0 cursor-pointer"
                title="Tutup"
            >
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- MODAL BODY -->
        <div class="p-5 sm:p-6 space-y-4 sm:space-y-5">

            <!-- 1. PILIH MASA AKTIF -->
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label class="text-[11px] font-bold uppercase tracking-wider text-charcoal-900 flex items-center gap-1.5">
                        <i data-lucide="clock" class="w-3.5 h-3.5 text-brand-600"></i>
                        <span>1. Masa Aktif Website Undangan</span>
                    </label>
                    <span class="text-[10px] text-sand-500 font-medium">Pilih salah satu</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    <!-- OPTION: 45 HARI -->
                    <div 
                        @click="selectedDuration = '45_days'"
                        class="relative p-3.5 rounded-2xl border transition-all cursor-pointer flex items-center justify-between gap-2.5 select-none"
                        :class="selectedDuration === '45_days' 
                            ? 'border-brand-600 bg-brand-50/60 ring-1 ring-brand-600/40 shadow-xs' 
                            : 'border-sand-200 bg-white hover:border-sand-300 hover:bg-sand-50/40'"
                    >
                        <div class="space-y-0.5 min-w-0">
                            <div class="flex items-center gap-1.5">
                                <span class="font-bold text-xs sm:text-sm text-charcoal-950">45 Hari</span>
                                <span class="px-1.5 py-0.2 rounded text-[9px] font-extrabold bg-brand-100 text-brand-800">Standar</span>
                            </div>
                            <p class="text-[10px] text-sand-500 truncate">Hingga hari H acara</p>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <span class="font-serif text-sm sm:text-base font-bold text-charcoal-950" x-text="selectedTheme ? selectedTheme.price_45_days : 'Rp 49.000'"></span>
                            <div 
                                class="w-4 h-4 rounded-full border flex items-center justify-center transition"
                                :class="selectedDuration === '45_days' ? 'border-brand-600 bg-brand-600 text-white' : 'border-sand-300 bg-white'"
                            >
                                <template x-if="selectedDuration === '45_days'">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- OPTION: LIFETIME -->
                    <div 
                        @click="selectedDuration = 'lifetime'"
                        class="relative p-3.5 rounded-2xl border transition-all cursor-pointer flex items-center justify-between gap-2.5 select-none"
                        :class="selectedDuration === 'lifetime' 
                            ? 'border-amber-600 bg-amber-50/60 ring-1 ring-amber-600/40 shadow-xs' 
                            : 'border-sand-200 bg-white hover:border-sand-300 hover:bg-sand-50/40'"
                    >
                        <div class="space-y-0.5 min-w-0">
                            <div class="flex items-center gap-1.5">
                                <span class="font-bold text-xs sm:text-sm text-charcoal-950">Lifetime</span>
                                <span class="px-1.5 py-0.2 rounded text-[9px] font-extrabold bg-amber-100 text-amber-900 flex items-center gap-0.5">
                                    <i data-lucide="sparkles" class="w-2.5 h-2.5"></i>
                                    <span>Abadi</span>
                                </span>
                            </div>
                            <p class="text-[10px] text-amber-800/80 truncate">Aktif selamanya</p>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <span class="font-serif text-sm sm:text-base font-bold text-amber-700" x-text="selectedTheme ? selectedTheme.price_lifetime : 'Rp 99.000'"></span>
                            <div 
                                class="w-4 h-4 rounded-full border flex items-center justify-center transition"
                                :class="selectedDuration === 'lifetime' ? 'border-amber-600 bg-amber-600 text-white' : 'border-sand-300 bg-white'"
                            >
                                <template x-if="selectedDuration === 'lifetime'">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. OPSI PENGISIAN DATA -->
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label class="text-[11px] font-bold uppercase tracking-wider text-charcoal-900 flex items-center gap-1.5">
                        <i data-lucide="edit-3" class="w-3.5 h-3.5 text-brand-600"></i>
                        <span>2. Metode Pengisian Data Undangan</span>
                    </label>
                    <span class="text-[10px] text-sand-500 font-medium">Pilih kemudahan Anda</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    <!-- OPTION: ISI SENDIRI -->
                    <div 
                        @click="selectedServiceType = 'self_service'"
                        class="relative p-3.5 rounded-2xl border transition-all cursor-pointer flex items-center justify-between gap-2.5 select-none"
                        :class="selectedServiceType === 'self_service' 
                            ? 'border-charcoal-950 bg-sand-50/80 ring-1 ring-charcoal-950/30 shadow-xs' 
                            : 'border-sand-200 bg-white hover:border-sand-300 hover:bg-sand-50/40'"
                    >
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0" :class="selectedServiceType === 'self_service' ? 'bg-charcoal-950 text-white' : 'bg-sand-100 text-sand-600'">
                                <i data-lucide="user" class="w-3.5 h-3.5"></i>
                            </div>
                            <div class="min-w-0 space-y-0.5">
                                <div class="font-bold text-xs sm:text-sm text-charcoal-950 truncate">Isi Sendiri</div>
                                <p class="text-[10px] text-sand-500 truncate">Input via dashboard</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-emerald-100 text-emerald-800">Gratis</span>
                            <div 
                                class="w-4 h-4 rounded-full border flex items-center justify-center transition"
                                :class="selectedServiceType === 'self_service' ? 'border-charcoal-950 bg-charcoal-950 text-white' : 'border-sand-300 bg-white'"
                            >
                                <template x-if="selectedServiceType === 'self_service'">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- OPTION: DIISIKAN TIM -->
                    <div 
                        @click="selectedServiceType = 'assisted'"
                        class="relative p-3.5 rounded-2xl border transition-all cursor-pointer flex items-center justify-between gap-2.5 select-none"
                        :class="selectedServiceType === 'assisted' 
                            ? 'border-blue-700 bg-blue-50/60 ring-1 ring-blue-700/30 shadow-xs' 
                            : 'border-sand-200 bg-white hover:border-sand-300 hover:bg-sand-50/40'"
                    >
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0" :class="selectedServiceType === 'assisted' ? 'bg-blue-600 text-white' : 'bg-sand-100 text-sand-600'">
                                <i data-lucide="headphones" class="w-3.5 h-3.5"></i>
                            </div>
                            <div class="min-w-0 space-y-0.5">
                                <div class="font-bold text-xs sm:text-sm text-charcoal-950 truncate">Dibantu Tim</div>
                                <p class="text-[10px] text-sand-500 truncate">Kirim data via WA</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-blue-100 text-blue-900" x-text="selectedTheme ? '+' + selectedTheme.assisted_fee : '+Rp 25.000'"></span>
                            <div 
                                class="w-4 h-4 rounded-full border flex items-center justify-center transition"
                                :class="selectedServiceType === 'assisted' ? 'border-blue-700 bg-blue-700 text-white' : 'border-sand-300 bg-white'"
                            >
                                <template x-if="selectedServiceType === 'assisted'">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- FOOTER: TOTAL BAYAR & CHECKOUT (CLEAN INTEGRATED ROW) -->
        <div class="px-5 py-4 sm:px-6 bg-sand-50/90 border-t border-sand-200/80 flex items-center justify-between gap-3 shrink-0">
            <div class="space-y-0.5">
                <div class="flex items-center gap-1.5">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Total Biaya:</span>
                    <span class="text-[10px] text-sand-600 font-medium" x-text="'(' + (selectedDuration === 'lifetime' ? 'Lifetime' : '45 Hari') + ' • ' + (selectedServiceType === 'assisted' ? 'Diisikan Tim' : 'Mandiri') + ')'"></span>
                </div>
                <div class="font-serif text-xl sm:text-2xl font-bold text-charcoal-950" x-text="formatCurrency(getTotalPrice())"></div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <button 
                    type="button" 
                    @click="closeOrderModal()" 
                    class="px-3.5 py-2.5 rounded-xl border border-sand-300 hover:bg-sand-200/70 text-charcoal-600 font-bold text-xs transition cursor-pointer"
                >
                    Batal
                </button>

                <a 
                    :href="getCheckoutUrl()" 
                    class="px-5 py-2.5 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white font-bold text-xs shadow-sm hover:shadow-md transition flex items-center gap-1.5 cursor-pointer"
                >
                    <span>Lanjut ke Checkout</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>

    </div>
</div>
</template>
