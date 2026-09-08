<x-app-layout>
    <div 
        class="space-y-6"
        x-data="{
            priceModalOpen: false,
            modalTheme: {
                id: null,
                name: '',
                price: '',
                price_lifetime: '',
                is_premium: false,
                update_url: ''
            },
            openPriceModal(data) {
                this.modalTheme = {
                    id: data.id,
                    name: data.name,
                    price: data.price ? (window.formatRupiah ? window.formatRupiah(data.price) : data.price) : '',
                    price_lifetime: data.price_lifetime ? (window.formatRupiah ? window.formatRupiah(data.price_lifetime) : data.price_lifetime) : '',
                    is_premium: data.is_premium,
                    update_url: data.update_url
                };
                this.priceModalOpen = true;
            },
            closePriceModal() {
                this.priceModalOpen = false;
            },
            formatInput(e, field) {
                let clean = e.target.value.replace(/[^0-9]/g, '');
                let formatted = clean ? 'Rp ' + parseInt(clean, 10).toLocaleString('id-ID') : '';
                this.modalTheme[field] = formatted;
                e.target.value = formatted;
            }
        }"
    >
        
        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">Katalog Tema & Kustomisasi Gaya</h1>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">Super Admin</span>
                </div>
                <p class="text-xs text-sand-600 mt-1">
                    Kelola template undangan pernikahan dan atur tema mana saja yang tersedia langsung untuk digunakan oleh Partner & WO.
                </p>
            </div>

            <!-- STATS SUMMARY -->
            <div class="flex flex-wrap items-center gap-2.5">
                <div class="flex items-center gap-2 text-xs font-bold text-charcoal-950 bg-sand-200/80 px-3.5 py-2 rounded-2xl shadow-sm">
                    <i data-lucide="palette" class="w-4 h-4 text-brand-700"></i>
                    <span>{{ $totalThemes }} Total Tema</span>
                </div>
                <div class="flex items-center gap-2 text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-3.5 py-2 rounded-2xl shadow-sm">
                    <i data-lucide="briefcase" class="w-4 h-4 text-emerald-600"></i>
                    <span>{{ $totalPartner }} Tersedia untuk Partner</span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2 shadow-sm">
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold flex flex-col gap-1 shadow-sm">
                <div class="flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600"></i>
                    <span>Terdapat kesalahan pada input pengaturan harga:</span>
                </div>
                <ul class="list-disc list-inside font-normal ml-6">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- PENGATURAN VARIAN & BIAYA LAYANAN (GLOBAL PRICING SETTINGS) -->
        <div class="rounded-3xl glass-panel border border-brand-200/80 bg-white/95 p-6 shadow-sm space-y-4" x-data="{ openConfig: false }">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-brand-100 text-brand-800 flex items-center justify-center border border-brand-200 shrink-0">
                        <i data-lucide="sliders-horizontal" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="font-serif text-base sm:text-lg font-bold text-charcoal-950">Pengaturan Varian Paket & Layanan</h2>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">Pop-up Desain</span>
                        </div>
                        <p class="text-xs text-sand-600">
                            Atur standar harga paket durasi (45 Hari & Lifetime) serta biaya tambahan bila pemesan memilih opsi dibantu input data oleh tim.
                        </p>
                    </div>
                </div>

                <button 
                    type="button" 
                    @click="openConfig = !openConfig"
                    class="self-start sm:self-auto px-3.5 py-2 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 text-xs font-bold transition flex items-center gap-1.5"
                >
                    <i data-lucide="settings-2" class="w-4 h-4"></i>
                    <span x-text="openConfig ? 'Tutup Formulir' : 'Buka Pengaturan Harga'">Buka Pengaturan Harga</span>
                </button>
            </div>

            <!-- CURRENT ACTIVE BADGES -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2 border-t border-sand-200/70">
                <div class="p-3 rounded-2xl bg-sand-50 border border-sand-200 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block">Paket 45 Hari</span>
                        <div class="font-serif text-sm sm:text-base font-bold text-charcoal-950">{{ format_rupiah($globalPrice45) }}</div>
                    </div>
                    <span class="px-2 py-1 rounded-lg bg-sand-200/80 text-charcoal-800 text-[10px] font-bold">Standar</span>
                </div>

                <div class="p-3 rounded-2xl bg-amber-50/70 border border-amber-200/80 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-800 block">Paket Lifetime</span>
                        <div class="font-serif text-sm sm:text-base font-bold text-amber-700">{{ format_rupiah($globalPriceLifetime) }}</div>
                    </div>
                    <span class="px-2 py-1 rounded-lg bg-amber-200/80 text-amber-900 text-[10px] font-bold">Selamanya</span>
                </div>

                <div class="p-3 rounded-2xl bg-blue-50/70 border border-blue-200/80 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-blue-800 block">Fee Jasa Diisikan Tim</span>
                        <div class="font-serif text-sm sm:text-base font-bold text-blue-700">+{{ format_rupiah($globalAssistedFee) }}</div>
                    </div>
                    <span class="px-2 py-1 rounded-lg bg-blue-200/80 text-blue-900 text-[10px] font-bold">Biaya Tambahan</span>
                </div>
            </div>

            <!-- COLLAPSIBLE FORM -->
            <div x-show="openConfig" x-transition class="pt-4 border-t border-sand-200">
                <form action="{{ route('admin.themes.pricing-settings') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-charcoal-900">
                                Harga Paket 45 Hari (Rp)
                            </label>
                            <input 
                                type="text" 
                                inputmode="numeric"
                                name="price_45_days" 
                                value="{{ format_rupiah(old('price_45_days', $globalPrice45)) }}" 
                                oninput="maskRupiah(this)"
                                required
                                class="w-full px-3.5 py-2 rounded-xl border border-sand-300 text-xs font-bold focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                            >
                            <span class="text-[10px] text-sand-500 block">Default tema aktif selama 45 hari (saat ini: {{ format_rupiah($globalPrice45) }}).</span>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-charcoal-900">
                                Harga Paket Lifetime (Rp)
                            </label>
                            <input 
                                type="text" 
                                inputmode="numeric"
                                name="price_lifetime" 
                                value="{{ format_rupiah(old('price_lifetime', $globalPriceLifetime)) }}" 
                                oninput="maskRupiah(this)"
                                required
                                class="w-full px-3.5 py-2 rounded-xl border border-sand-300 text-xs font-bold focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                            >
                            <span class="text-[10px] text-sand-500 block">Harga tema dengan masa aktif selamanya (saat ini: {{ format_rupiah($globalPriceLifetime) }}).</span>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-charcoal-900">
                                Fee Jasa Diisikan Tim (Rp)
                            </label>
                            <input 
                                type="text" 
                                inputmode="numeric"
                                name="assisted_fee" 
                                value="{{ format_rupiah(old('assisted_fee', $globalAssistedFee)) }}" 
                                oninput="maskRupiah(this)"
                                required
                                class="w-full px-3.5 py-2 rounded-xl border border-sand-300 text-xs font-bold focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                            >
                            <span class="text-[10px] text-sand-500 block">Biaya ekstra bila data diinputkan oleh tim (saat ini: {{ format_rupiah($globalAssistedFee) }}).</span>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-charcoal-900">
                                WhatsApp Bantuan Admin
                            </label>
                            <input 
                                type="text" 
                                name="whatsapp_number" 
                                value="{{ old('whatsapp_number', $whatsappNumber) }}" 
                                placeholder="6281234567890" 
                                class="w-full px-3.5 py-2 rounded-xl border border-sand-300 text-xs font-semibold focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                            >
                            <span class="text-[10px] text-sand-500 block">Nomor WA untuk pengiriman data undangan.</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button 
                            type="button" 
                            @click="openConfig = false" 
                            class="px-4 py-2 rounded-xl border border-sand-300 text-sand-600 hover:bg-sand-100 text-xs font-bold transition"
                        >
                            Batal
                        </button>
                        <button 
                            type="submit" 
                            class="px-5 py-2 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-sm"
                        >
                            <i data-lucide="check" class="w-4 h-4"></i>
                            <span>Simpan Pengaturan Varian</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- THEMES GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($themes as $theme)
                @php
                    $meta = $theme->metadata ?? [];
                    $demoUrl = route('demo.show', ['slug' => $theme->slug]);
                @endphp

                <div class="group rounded-2xl bg-white border border-sand-200/90 hover:border-brand-300 hover:shadow-md transition-all duration-300 flex flex-col overflow-hidden">
                    
                    <!-- THUMBNAIL WRAPPER -->
                    <div class="relative aspect-[16/10] overflow-hidden bg-charcoal-950">
                        <img 
                            src="{{ $theme->thumbnail }}" 
                            alt="{{ $theme->name }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950/50 via-transparent to-transparent pointer-events-none"></div>

                        <!-- TOP BADGES -->
                        <div class="absolute top-2.5 inset-x-2.5 flex items-center justify-between pointer-events-none">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold shadow-sm backdrop-blur-md {{ $theme->is_active ? 'bg-emerald-600/95 text-white' : 'bg-rose-600/95 text-white' }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                <span>{{ $theme->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                            </span>
                            @if($theme->is_for_partner)
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold shadow-sm bg-amber-400 text-charcoal-950">
                                    <i data-lucide="briefcase" class="w-3 h-3"></i>
                                    <span>Partner</span>
                                </span>
                            @endif
                        </div>

                        <!-- PREVIEW BUTTON BOTTOM RIGHT -->
                        <div class="absolute bottom-2.5 right-2.5">
                            <a 
                                href="{{ $demoUrl }}" 
                                target="_blank" 
                                class="px-2.5 py-1 rounded-lg bg-white/95 hover:bg-white text-charcoal-950 font-bold text-[11px] shadow-sm hover:scale-105 transition flex items-center gap-1"
                            >
                                <i data-lucide="external-link" class="w-3 h-3 text-brand-600"></i>
                                <span>Preview</span>
                            </a>
                        </div>
                    </div>

                    <!-- BODY -->
                    <div class="p-4 flex-1 flex flex-col justify-between space-y-3">
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between text-[11px]">
                                <span class="font-bold tracking-wider text-brand-700 uppercase text-[10px]">{{ ucfirst($theme->category) }}</span>
                                <span class="text-sand-500 font-medium text-[10px]">
                                    {{ $theme->invitations_count ?? 0 }} Undangan
                                </span>
                            </div>

                            <h3 class="font-serif text-base font-bold text-charcoal-950 group-hover:text-brand-600 transition-colors truncate" title="{{ $theme->name }}">
                                {{ $theme->name }}
                            </h3>

                            <!-- COMPACT PRICING ROW -->
                            <div class="grid grid-cols-2 gap-2 p-2 rounded-xl bg-sand-50 border border-sand-200/70 text-center">
                                <div>
                                    <span class="text-[9px] font-bold text-sand-500 uppercase tracking-wider block">45 Hari</span>
                                    <span class="font-serif font-bold text-xs sm:text-sm text-charcoal-950">
                                        {{ format_rupiah($theme->getPrice45Days()) }}
                                    </span>
                                </div>
                                <div class="border-l border-sand-200 pl-2">
                                    <span class="text-[9px] font-bold text-amber-700 uppercase tracking-wider block">Lifetime</span>
                                    <span class="font-serif font-bold text-xs sm:text-sm text-amber-900">
                                        {{ format_rupiah($theme->getLifetimePrice()) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- ACTIONS BAR -->
                        <div class="pt-2 border-t border-sand-100 flex items-center gap-2">
                            <!-- ATUR HARGA BUTTON -->
                            <button 
                                type="button" 
                                @click="openPriceModal({
                                    id: {{ $theme->id }},
                                    name: '{{ addslashes($theme->name) }}',
                                    price: '{{ format_rupiah($theme->price) }}',
                                    price_lifetime: '{{ !empty($meta['price_lifetime']) ? format_rupiah($meta['price_lifetime']) : '' }}',
                                    is_premium: {{ $theme->is_premium ? 'true' : 'false' }},
                                    update_url: '{{ route('admin.themes.update-price', $theme) }}'
                                })"
                                class="flex-1 py-1.5 px-3 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white text-xs font-semibold transition flex items-center justify-center gap-1.5 shadow-sm"
                                title="Atur harga 45 Hari dan Lifetime tema ini"
                            >
                                <i data-lucide="tag" class="w-3.5 h-3.5"></i>
                                <span>Atur Harga</span>
                            </button>

                            <!-- TOGGLE FOR PARTNER -->
                            <form action="{{ route('admin.themes.toggle-partner', $theme) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button 
                                    type="submit" 
                                    class="py-1.5 px-2.5 rounded-xl border text-xs font-semibold transition flex items-center justify-center gap-1 {{ $theme->is_for_partner ? 'bg-amber-100 border-amber-300 text-amber-900 hover:bg-amber-200' : 'bg-sand-50 border-sand-200 text-sand-500 hover:text-charcoal-900 hover:bg-sand-100' }}"
                                    title="{{ $theme->is_for_partner ? 'Akses Khusus Partner: Aktif (Klik untuk buka ke publik)' : 'Akses Khusus Partner: Nonaktif (Klik untuk jadikan khusus Partner)' }}"
                                >
                                    <i data-lucide="briefcase" class="w-3.5 h-3.5"></i>
                                    <span class="text-[11px]">{{ $theme->is_for_partner ? 'Partner' : 'Publik' }}</span>
                                </button>
                            </form>

                            <!-- TOGGLE STATUS TEMA -->
                            <form action="{{ route('admin.themes.toggle', $theme) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button 
                                    type="submit" 
                                    class="p-1.5 px-2 rounded-xl border text-xs font-semibold transition flex items-center justify-center {{ $theme->is_active ? 'bg-rose-50 border-rose-200 text-rose-700 hover:bg-rose-100' : 'bg-emerald-50 border-emerald-200 text-emerald-700 hover:bg-emerald-100' }}"
                                    title="{{ $theme->is_active ? 'Tema Aktif (Klik untuk nonaktifkan)' : 'Tema Nonaktif (Klik untuk aktifkan)' }}"
                                >
                                    <i data-lucide="power" class="w-3.5 h-3.5"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-sand-400">
                    Tidak ada data tema ditemukan.
                </div>
            @endforelse
        </div>

        <!-- MODAL ATUR HARGA TEMA (GLOBAL MODAL DIALOG) -->
        <template x-teleport="body">
            <div 
                x-show="priceModalOpen" 
                x-cloak 
                style="display: none;"
                class="fixed inset-0 z-[100] overflow-y-auto bg-charcoal-950/75 backdrop-blur-md flex items-center justify-center p-4"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div class="fixed inset-0 pointer-events-none"></div>

                <div 
                    class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl border border-sand-200 overflow-hidden my-auto p-6 space-y-4"
                    @click.stop
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                >
                    <div class="flex items-center justify-between border-b border-sand-200 pb-3">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center border border-brand-200">
                                <i data-lucide="tag" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <h3 class="font-serif text-base font-bold text-charcoal-950">Atur Harga Tema</h3>
                                <p class="text-[11px] text-sand-500 truncate max-w-[240px]" x-text="modalTheme.name"></p>
                            </div>
                        </div>
                        <button type="button" @click="closePriceModal()" class="w-7 h-7 rounded-full bg-sand-100 hover:bg-sand-200 text-charcoal-600 flex items-center justify-center transition">
                            <i data-lucide="x" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>

                    <form :action="modalTheme.update_url" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-charcoal-900">Harga 45 Hari (Rp)</label>
                            <input 
                                type="text" 
                                inputmode="numeric"
                                name="price" 
                                x-model="modalTheme.price" 
                                @input="formatInput($event, 'price')"
                                required 
                                placeholder="Rp 0"
                                class="w-full px-3.5 py-2 rounded-xl border border-sand-300 text-xs font-bold focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                            >
                            <span class="text-[10px] text-sand-500 block">Harga standar tema durasi aktif 45 hari (default global: {{ format_rupiah($globalPrice45) }}).</span>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-charcoal-900">
                                Harga Lifetime (Rp) <span class="text-sand-500 font-normal">(Opsional)</span>
                            </label>
                            <input 
                                type="text" 
                                inputmode="numeric"
                                name="price_lifetime" 
                                x-model="modalTheme.price_lifetime" 
                                @input="formatInput($event, 'price_lifetime')"
                                placeholder="Kosongkan jika pakai default sistem" 
                                class="w-full px-3.5 py-2 rounded-xl border border-sand-300 text-xs font-bold placeholder:font-normal focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                            >
                            <span class="text-[10px] text-sand-500 block">Biarkan kosong untuk otomatis memakai harga global ({{ format_rupiah($globalPriceLifetime) }}).</span>
                        </div>

                        <div class="flex items-center gap-2 pt-1">
                            <input 
                                type="checkbox" 
                                name="is_premium" 
                                id="modal_is_premium" 
                                value="1" 
                                :checked="modalTheme.is_premium" 
                                class="rounded border-sand-300 text-brand-600 focus:ring-brand-500"
                            >
                            <label for="modal_is_premium" class="text-xs font-semibold text-charcoal-800">
                                Tema Berbayar (Premium)
                            </label>
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-3 border-t border-sand-200">
                            <button 
                                type="button" 
                                @click="closePriceModal()" 
                                class="px-4 py-2 rounded-xl border border-sand-300 text-sand-600 hover:bg-sand-100 text-xs font-bold transition"
                            >
                                Batal
                            </button>
                            <button 
                                type="submit" 
                                class="px-5 py-2 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-sm"
                            >
                                <i data-lucide="check" class="w-4 h-4"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

    </div>
</x-app-layout>
