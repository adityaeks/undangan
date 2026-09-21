<!-- STEP 1: TEMA & INFO DASAR -->
<div x-show="currentStep === 1" x-transition data-step="1" class="space-y-6">

    @if($role === 'partner')
        <!-- PILIH KLIEN PARTNER (WO / VENDOR) -->
        <div class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/20 space-y-3">
            <div class="flex items-center gap-2">
                <i data-lucide="user-check" class="w-4 h-4 text-amber-700"></i>
                <h4 class="text-xs font-bold text-amber-900 uppercase tracking-wider">Pilih Klien Pasangan (Opsional)</h4>
            </div>
            <p class="text-xs text-amber-800 leading-relaxed">
                Hubungkan undangan ini dengan data klien pasangan yang telah Anda daftarkan di Buku Klien.
            </p>
            <div>
                <select 
                    name="client_id" 
                    class="w-full px-3.5 py-2.5 rounded-xl border border-amber-300/80 bg-white text-xs font-semibold text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-amber-500/30"
                >
                    <option value="">-- Tanpa Klien / Buat Bebas --</option>
                    @foreach($clients as $client)
                        <option 
                            value="{{ $client->id }}" 
                            @selected((string) old('client_id', $invitation?->client_id) === (string) $client->id)
                        >
                            {{ $client->groom_name }} & {{ $client->bride_name }} ({{ $client->phone ?? 'No HP -' }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <!-- THEME SELECTION / LOCKED THEME INFO -->
    <div class="space-y-3">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-charcoal-900">
                    Tema Desain Undangan <span class="text-rose-500">*</span>
                </label>
                @if(!$invitation)
                    <p class="text-[11px] text-sand-500 mt-0.5">Pilih tema desain yang sesuai dengan konsep pernikahan Anda.</p>
                @endif
            </div>

            @if($invitation)
                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-amber-800 bg-amber-100/70 px-2 py-0.5 rounded-md border border-amber-300">
                    <i data-lucide="lock" class="w-3 h-3 text-amber-700"></i>
                    <span>Terkunci (Permanen)</span>
                </span>
            @elseif(!$themes->isEmpty())
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <div class="relative flex-1 sm:w-64">
                        <i data-lucide="search" class="w-4 h-4 text-sand-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                        <input 
                            type="text" 
                            x-model="themeSearch" 
                            @keydown.enter.prevent
                            placeholder="Cari tema (misal: Standart, 3D)..." 
                            class="w-full pl-9 pr-8 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 bg-white shadow-2xs placeholder:text-sand-400"
                        >
                        <button 
                            type="button" 
                            x-show="themeSearch" 
                            @click="themeSearch = ''" 
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-sand-400 hover:text-charcoal-600 p-0.5 transition"
                            title="Hapus pencarian"
                        >
                            <i data-lucide="x" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                    <button 
                        type="button" 
                        @click="$el.previousElementSibling.querySelector('input').focus()"
                        class="px-3.5 py-2 rounded-xl bg-charcoal-900 hover:bg-black text-white text-xs font-semibold transition flex items-center gap-1.5 shadow-2xs shrink-0"
                    >
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                        <span>Cari</span>
                    </button>
                </div>
            @endif
        </div>
        
        <input type="hidden" name="theme_id" :value="selectedTheme">

        @if($invitation)
            @php
                $currentTheme = $invitation->theme ?? $themes->firstWhere('id', $invitation->theme_id);
            @endphp
            @if($currentTheme)
                <div class="p-4 rounded-2xl bg-sand-50 border border-sand-200/90 shadow-2xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-20 h-16 sm:w-24 sm:h-18 rounded-xl overflow-hidden bg-sand-200 shrink-0 border border-sand-300 shadow-2xs relative">
                            <img 
                                src="{{ $currentTheme->thumbnail }}" 
                                alt="{{ $currentTheme->name }}" 
                                class="w-full h-full object-cover"
                            >
                            <span class="absolute top-1 left-1 px-1.5 py-0.5 rounded bg-charcoal-950/80 text-brand-200 text-[9px] font-bold uppercase tracking-wider">
                                {{ $currentTheme->category }}
                            </span>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <h4 class="font-serif text-sm font-bold text-charcoal-950">
                                    {{ $currentTheme->name }}
                                </h4>
                                <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                    Tema Aktif
                                </span>
                            </div>
                            <p class="text-xs text-sand-600 line-clamp-1">
                                {{ $currentTheme->metadata['description'] ?? 'Desain modern bernuansa '.strtolower($currentTheme->category).' dengan animasi responsif.' }}
                            </p>
                            <p class="text-[11px] text-amber-800 flex items-center gap-1 pt-0.5">
                                <i data-lucide="info" class="w-3.5 h-3.5 text-amber-600 shrink-0"></i>
                                <span>Tema undangan sudah terikat dengan lisensi undangan ini dan tidak dapat diganti.</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full md:w-auto shrink-0 justify-end">
                        <a 
                            href="{{ route('demo.show', ['slug' => $currentTheme->slug]) }}" 
                            target="_blank"
                            class="px-3.5 py-2 rounded-xl bg-white border border-sand-300 hover:bg-sand-100 text-charcoal-800 text-xs font-semibold transition flex items-center gap-1.5 shadow-2xs"
                        >
                            <i data-lucide="external-link" class="w-3.5 h-3.5 text-sand-500"></i>
                            <span>Preview Tema</span>
                        </a>
                    </div>
                </div>
            @endif
        @elseif($themes->isEmpty())
            <div class="p-6 rounded-2xl border-2 border-dashed border-sand-300 text-center space-y-2 bg-sand-50/50">
                <i data-lucide="palette" class="w-8 h-8 text-sand-400 mx-auto"></i>
                <p class="text-xs font-bold text-charcoal-950">Anda Belum Memiliki Tema Aktif</p>
                @if($role === 'member')
                    <div class="space-y-1">
                        <p class="text-xs font-semibold text-amber-800">Kuota Tema Anda Sudah Digunakan</p>
                        <p class="text-xs text-sand-500">Semua Tema Anda Sudah Digunakan (1 Tema = 1 Undangan). Silakan jelajahi katalog tema kami untuk membeli tema baru atau lisensi tambahan.</p>
                    </div>
                    <a href="{{ route('themes.catalog') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white text-xs font-bold shadow hover:scale-105 transition mt-1">
                        <i data-lucide="shopping-bag" class="w-3.5 h-3.5"></i>
                        <span>Jelajahi Katalog Tema</span>
                    </a>
                @else
                    <p class="text-xs text-sand-500">Hubungi Administrator untuk mengaktifkan tema kemitraan Anda.</p>
                @endif
            </div>
        @else
            <div x-show="themeSearch && filteredThemeCount > 0" class="flex items-center justify-between text-xs text-sand-600 px-1">
                <span>Ditemukan <strong class="text-charcoal-900" x-text="filteredThemeCount"></strong> tema untuk "<span class="font-semibold text-charcoal-800" x-text="themeSearch"></span>"</span>
                <button 
                    type="button" 
                    @click="themeSearch = ''" 
                    class="text-brand-600 hover:text-brand-700 font-medium hover:underline text-[11px] flex items-center gap-1"
                >
                    <i data-lucide="rotate-ccw" class="w-3 h-3"></i>
                    <span>Reset</span>
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($themes as $theme)
                    <div 
                        x-show="isThemeVisible('{{ $theme->id }}')"
                        @click="selectedTheme = '{{ $theme->id }}'"
                        :class="selectedTheme == '{{ $theme->id }}' ? 'border-brand-600 ring-2 ring-brand-500/20 shadow-md bg-brand-50/20' : 'border-sand-200 hover:border-sand-300 bg-white'"
                        class="cursor-pointer group rounded-2xl border overflow-hidden transition-all duration-200 flex flex-col justify-between"
                    >
                        <div>
                            <div class="relative aspect-[4/3] bg-sand-200 overflow-hidden">
                                <img 
                                    src="{{ $theme->thumbnail }}" 
                                    alt="{{ $theme->name }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                >
                                <div class="absolute top-2 left-2 flex flex-col gap-1 items-start">
                                    <span class="px-2 py-0.5 rounded-full bg-charcoal-950/80 text-brand-200 text-[10px] font-bold uppercase tracking-wider shadow">
                                        {{ $theme->category }}
                                    </span>
                                    @if($theme->slug === '3d-motion-01')
                                        <span class="px-2 py-0.5 rounded-full bg-emerald-700 text-white text-[9px] font-bold uppercase tracking-wider shadow">
                                            Tanpa Foto
                                        </span>
                                    @endif
                                </div>
                                <div 
                                    x-show="selectedTheme == '{{ $theme->id }}'" 
                                    class="absolute top-2 right-2 w-6 h-6 rounded-full bg-brand-600 text-white flex items-center justify-center shadow"
                                >
                                    <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                </div>
                            </div>
                            <div class="p-3.5 space-y-2">
                                <div class="flex items-center justify-between gap-1">
                                    <h4 class="font-serif text-sm font-bold text-charcoal-950 group-hover:text-brand-700 transition truncate">
                                        {{ $theme->name }}
                                    </h4>
                                    @if(!empty($theme->metadata['colors']))
                                        <div class="flex items-center -space-x-1 shrink-0">
                                            @foreach(array_slice($theme->metadata['colors'], 0, 3) as $c)
                                                <span class="w-3.5 h-3.5 rounded-full border border-white shadow-2xs" style="background-color: {{ $c['hex'] ?? '#ccc' }};" title="{{ $c['name'] ?? '' }}"></span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <p class="text-[11px] text-sand-500 line-clamp-2 leading-snug">
                                    {{ $theme->metadata['description'] ?? 'Desain modern bernuansa '.strtolower($theme->category).' dengan animasi responsif.' }}
                                </p>
                            </div>
                        </div>

                        <div class="p-3 pt-0 flex items-center justify-between gap-2 border-t border-sand-100 mt-1 pt-2.5">
                            <span 
                                :class="selectedTheme == '{{ $theme->id }}' ? 'text-brand-700 font-bold' : 'text-sand-400 font-medium'"
                                class="text-[11px] flex items-center gap-1"
                            >
                                <i data-lucide="check-circle" class="w-3 h-3"></i>
                                <span x-text="selectedTheme == '{{ $theme->id }}' ? 'Tema Terpilih' : 'Pilih Tema'"></span>
                            </span>

                            <a 
                                href="{{ route('demo.show', ['slug' => $theme->slug]) }}" 
                                target="_blank"
                                @click.stop
                                class="px-2.5 py-1 rounded-lg bg-sand-100 hover:bg-sand-200 text-charcoal-800 text-[11px] font-semibold transition flex items-center gap-1"
                            >
                                <span>Preview</span>
                                <i data-lucide="external-link" class="w-3 h-3 text-sand-500"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div 
                x-show="themeSearch && filteredThemeCount === 0" 
                class="p-8 rounded-2xl border-2 border-dashed border-sand-300 text-center space-y-3 bg-sand-50/50"
            >
                <div class="w-12 h-12 rounded-full bg-sand-200/80 flex items-center justify-center mx-auto text-sand-500">
                    <i data-lucide="search-x" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-xs font-bold text-charcoal-950">Tema Tidak Ditemukan</p>
                    <p class="text-xs text-sand-500 max-w-md mx-auto">
                        Tidak ada tema yang cocok dengan pencarian "<span class="font-semibold text-charcoal-800" x-text="themeSearch"></span>".
                    </p>
                </div>
                <button 
                    type="button" 
                    @click="themeSearch = ''" 
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-white border border-sand-300 hover:bg-sand-100 text-charcoal-800 text-xs font-semibold shadow-2xs transition"
                >
                    <i data-lucide="rotate-ccw" class="w-3.5 h-3.5 text-sand-500"></i>
                    <span>Tampilkan Semua Tema</span>
                </button>
            </div>
        @endif
    </div>

    <!-- JUDUL & SLUG INFO -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-sand-200">
        <div class="space-y-1.5">
            <label class="block text-xs font-bold uppercase tracking-wider text-charcoal-900">
                Judul Undangan <span class="text-rose-500">*</span>
            </label>
            <input 
                type="text" 
                name="title" 
                value="{{ old('title', $invitation?->title) }}" 
                placeholder="Contoh: The Wedding of Romeo & Juliet" 
                required 
                class="w-full px-3.5 py-2.5 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500"
            >
            <p class="text-[11px] text-sand-500">Nama utama yang tampil sebagai judul website undangan.</p>
        </div>

        <div class="space-y-1.5">
            <div class="flex items-center justify-between">
                <label class="block text-xs font-bold uppercase tracking-wider text-charcoal-900">
                    Link URL Kustom (Slug)
                </label>
                @if($invitation)
                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-amber-800 bg-amber-100/70 px-2 py-0.5 rounded-md border border-amber-300">
                        <i data-lucide="lock" class="w-3 h-3 text-amber-700"></i>
                        <span>Terkunci (Permanen)</span>
                    </span>
                @endif
            </div>
            <div class="flex items-center">
                <span class="px-3 py-2.5 bg-sand-100 border border-r-0 border-sand-300 rounded-l-xl text-[11px] text-sand-500 font-mono">
                    {{ url('/u') }}/
                </span>
                <input 
                    type="text" 
                    name="slug" 
                    value="{{ old('slug', $invitation?->slug) }}" 
                    placeholder="romeo-juliet" 
                    @if($invitation) readonly @endif
                    class="w-full px-3.5 py-2.5 rounded-r-xl border border-sand-300 text-xs text-charcoal-900 font-mono {{ $invitation ? 'bg-sand-100/90 text-sand-600 cursor-not-allowed select-all' : 'focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500' }}"
                >
            </div>
            @if($invitation)
                <p class="text-[11px] text-amber-800 flex items-center gap-1">
                    <i data-lucide="info" class="w-3.5 h-3.5 text-amber-600 shrink-0"></i>
                    <span>Tautan slug undangan tidak dapat diubah agar link yang sudah disebarkan ke tamu tetap aktif.</span>
                </p>
            @else
                <p class="text-[11px] text-sand-500">Kosongkan jika ingin link digenerate otomatis dari nama panggilan.</p>
            @endif
        </div>
    </div>

    <!-- KUTIPAN / AYAT SUCI -->
    <div class="space-y-3 pt-2 border-t border-sand-200">
        <div class="flex items-center justify-between">
            <label class="block text-xs font-bold uppercase tracking-wider text-charcoal-900">
                Kutipan Ayat / Doa / Kata Mutiara (Quotes)
            </label>
            <span class="text-[11px] text-sand-500">Pilih preset atau tulis kustom</span>
        </div>

        <!-- QUICK PRESET BUTTONS (WITH CULTURAL / ADAT SUPPORT) -->
        <div class="flex flex-wrap gap-2">
            <button 
                type="button" 
                @click="
                    $el.closest('.space-y-6').querySelector('textarea[name=quote_text]').value = 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.';
                    $el.closest('.space-y-6').querySelector('input[name=quote_source]').value = 'QS. Ar-Rum: 21';
                "
                class="px-2.5 py-1 rounded-lg bg-sand-100 hover:bg-sand-200 text-charcoal-800 text-[11px] font-semibold border border-sand-200 transition flex items-center gap-1 cursor-pointer"
            >
                <span>📜</span>
                <span>QS. Ar-Rum: 21 (Islami)</span>
            </button>

            <button 
                type="button" 
                @click="
                    $el.closest('.space-y-6').querySelector('textarea[name=quote_text]').value = 'Nyuwun donga pangestu dhumateng Gusti Kang Akarya Jagad, mugi-mugi tansah pinaringan rahayu, berkah, saha dados kulawarga ingkang sakinah mawaddah warahmah.';
                    $el.closest('.space-y-6').querySelector('input[name=quote_source]').value = 'Donga Penganten Jawa';
                "
                class="px-2.5 py-1 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-900 text-[11px] font-semibold border border-amber-200 transition flex items-center gap-1 cursor-pointer"
            >
                <span>🏛️</span>
                <span>Adat Jawa & Budaya</span>
            </button>

            <button 
                type="button" 
                @click="
                    $el.closest('.space-y-6').querySelector('textarea[name=quote_text]').value = 'Kasih itu sabar; kasih itu murah hati; ia tidak cemburu. Ia tidak memegahkan diri dan tidak sombong. Kasih menutupi segala sesuatu, percaya segala sesuatu, mengharapkan segala sesuatu.';
                    $el.closest('.space-y-6').querySelector('input[name=quote_source]').value = '1 Korintus 13:4-7';
                "
                class="px-2.5 py-1 rounded-lg bg-sand-100 hover:bg-sand-200 text-charcoal-800 text-[11px] font-semibold border border-sand-200 transition flex items-center gap-1 cursor-pointer"
            >
                <span>✝️</span>
                <span>1 Korintus 13:4-7 (Kristiani)</span>
            </button>

            <button 
                type="button" 
                @click="
                    $el.closest('.space-y-6').querySelector('textarea[name=quote_text]').value = 'Cinta bukanlah tentang saling menatap, melainkan menatap bersama ke satu arah yang sama.';
                    $el.closest('.space-y-6').querySelector('input[name=quote_source]').value = 'Kahlil Gibran';
                "
                class="px-2.5 py-1 rounded-lg bg-sand-100 hover:bg-sand-200 text-charcoal-800 text-[11px] font-semibold border border-sand-200 transition flex items-center gap-1 cursor-pointer"
            >
                <span>🕊️</span>
                <span>Kahlil Gibran (Puitis)</span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2 space-y-1.5">
                <textarea 
                    name="quote_text" 
                    rows="3" 
                    placeholder="Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu..."
                    class="w-full px-3.5 py-2.5 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500"
                >{{ old('quote_text', $invitation?->quote_text ?? 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.') }}</textarea>
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-charcoal-900">
                    Sumber Kutipan
                </label>
                <input 
                    type="text" 
                    name="quote_source" 
                    value="{{ old('quote_source', $invitation?->quote_source ?? 'QS. Ar-Rum: 21') }}" 
                    placeholder="QS. Ar-Rum: 21 / 1 Korintus 13:4" 
                    class="w-full px-3.5 py-2.5 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500"
                >
                <p class="text-[11px] text-sand-500">Surat atau nama tokoh kutipan.</p>
            </div>
        </div>
    </div>
</div>
