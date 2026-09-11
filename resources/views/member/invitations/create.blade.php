<x-member-layout>
    <div 
        class="space-y-4 max-w-5xl mx-auto" 
        x-data="{ 
            currentStep: {{ $errors->hasAny(['groom_*', 'bride_*']) ? 2 : ($errors->hasAny(['akad_*', 'resepsi_*']) ? 3 : 1) }}, 
            errorMessage: '',
            @php
                $initialThemeId = $themes->firstWhere('id', old('theme_id', request('theme_id')))?->id ?? $themes->first()?->id ?? '';
            @endphp
            selectedTheme: '{{ $initialThemeId }}',
            themeStoryImageMap: @js($themes->mapWithKeys(fn($t) => [(string)$t->id => (bool)$t->has_story_images])),
            themeSupportsStoryImages() {
                return !!this.themeStoryImageMap[String(this.selectedTheme)];
            },
            selectedMusic: '{{ old('music_preset', '/audio/payung-teduh-akad.mp3') }}',
            isPlayingAudio: false,
            audioPlayer: null,
            coverPreview: null,
            groomPreview: null,
            bridePreview: null,
            galleryPreviews: [],
            stories: @js(old('stories', [
                ['title' => '', 'date' => '', 'story' => ''],
                ['title' => '', 'date' => '', 'story' => ''],
                ['title' => '', 'date' => '', 'story' => ''],
            ])).map(s => ({
                title: s.title || '',
                date: s.date || '',
                story: s.story || '',
                imagePreview: null
            })),
            
            init() {
                this.audioPlayer = new Audio(this.selectedMusic);
            },
            validateStep(step) {
                this.errorMessage = '';
                const form = this.$el.querySelector('form');
                if (!form) return true;

                if (step === 1 && !this.selectedTheme) {
                    this.errorMessage = 'Silakan pilih tema desain terlebih dahulu.';
                    return false;
                }

                const stepContainer = form.querySelector(`[data-step='${step}']`);
                if (!stepContainer) return true;

                const fields = stepContainer.querySelectorAll('input[required], select[required], textarea[required]');
                for (const field of fields) {
                    if (!field.checkValidity()) {
                        field.classList.add('border-rose-500', 'ring-2', 'ring-rose-200');
                        this.currentStep = step;
                        this.$nextTick(() => {
                            field.focus();
                            if (field.reportValidity) {
                                field.reportValidity();
                            }
                        });
                        const labelEl = field.closest('div')?.querySelector('label');
                        const label = labelEl ? labelEl.innerText.replace('*', '').trim() : (field.placeholder || field.name);
                        this.errorMessage = `Mohon lengkapi kolom wajib: '${label}'.`;
                        return false;
                    } else {
                        field.classList.remove('border-rose-500', 'ring-2', 'ring-rose-200');
                    }
                }

                return true;
            },
            goToStep(targetStep) {
                this.errorMessage = '';
                if (targetStep > this.currentStep) {
                    for (let s = this.currentStep; s < targetStep; s++) {
                        if (!this.validateStep(s)) {
                            this.currentStep = s;
                            return false;
                        }
                    }
                }
                this.currentStep = targetStep;
                window.scrollTo({ top: 120, behavior: 'smooth' });
                return true;
            },
            submitForm(e) {
                for (let s = 1; s <= 6; s++) {
                    if (!this.validateStep(s)) {
                        e.preventDefault();
                        this.currentStep = s;
                        return false;
                    }
                }
            },
            toggleAudioTest() {
                if (!this.audioPlayer) {
                    this.audioPlayer = new Audio(this.selectedMusic);
                }
                if (this.isPlayingAudio) {
                    this.audioPlayer.pause();
                    this.isPlayingAudio = false;
                } else {
                    this.audioPlayer.src = this.selectedMusic;
                    this.audioPlayer.play().then(() => {
                        this.isPlayingAudio = true;
                    }).catch(() => {
                        this.isPlayingAudio = false;
                    });
                }
            },
            changeMusicPreset(url) {
                this.selectedMusic = url;
                if (this.isPlayingAudio && this.audioPlayer) {
                    this.audioPlayer.src = url;
                    this.audioPlayer.play();
                }
            },
            previewFile(event, target) {
                const file = event.target.files[0];
                if (file) {
                    this[target] = URL.createObjectURL(file);
                }
            },
            previewMultipleGalleries(event) {
                const files = event.target.files;
                this.galleryPreviews = [];
                for (let i = 0; i < files.length; i++) {
                    this.galleryPreviews.push(URL.createObjectURL(files[i]));
                }
            },
            addStory() {
                if (this.stories.length < 8) {
                    this.stories.push({ title: '', date: '', story: '', imagePreview: null });
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                }
            },
            removeStory(index) {
                if (this.stories.length > 1) {
                    this.stories.splice(index, 1);
                } else {
                    this.stories[0] = { title: '', date: '', story: '', imagePreview: null };
                }
            },
            previewStoryFile(event, index) {
                const file = event.target.files[0];
                if (file) {
                    this.stories[index].imagePreview = URL.createObjectURL(file);
                }
            }
        }"
    >
        
        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-sand-200">
            <div>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-brand-500/10 text-brand-800 text-[10px] font-bold uppercase tracking-wider border border-brand-500/20 mb-1">
                    <i data-lucide="sparkles" class="w-3 h-3 text-brand-600"></i>
                    <span>Portal Pengantin • Buat Undangan</span>
                </div>
                <h1 class="font-serif text-xl sm:text-2xl font-bold text-charcoal-950">
                    Form Pembuatan Undangan Baru
                </h1>
                <p class="text-xs text-sand-600">
                    Lengkapi rincian data pernikahan di bawah untuk menerbitkan website undangan digital Anda.
                </p>
            </div>

            <a href="{{ route('member.invitations.index') }}" class="self-start sm:self-auto inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-sand-200 hover:bg-sand-300 text-charcoal-900 text-xs font-bold transition">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali</span>
            </a>
        </div>

        <!-- ALERT JIKA BELUM MEMILIKI TEMA AKTIF / SEMUA TEMA SUDAH TERPAKAI -->
        @if ($themes->isEmpty())
            <div class="p-5 rounded-2xl bg-brand-50 border border-brand-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3.5 text-left">
                    <div class="w-10 h-10 rounded-xl bg-brand-100 border border-brand-300 flex items-center justify-center text-brand-700 flex-shrink-0">
                        <i data-lucide="palette" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="font-serif text-sm font-bold text-charcoal-950">
                            @if(!empty($usedThemeIds))
                                Kuota Tema Anda Sudah Digunakan
                            @else
                                Anda Belum Memiliki Tema Aktif
                            @endif
                        </h3>
                        <p class="text-[11px] text-sand-600">
                            @if(!empty($usedThemeIds))
                                Setiap pembelian tema hanya dapat digunakan untuk 1 website undangan. Silakan pilih &amp; aktifkan tema baru di katalog kami untuk membuat undangan tambahan.
                            @else
                                Silakan pilih dan aktifkan salah satu tema dari katalog kami terlebih dahulu sebelum membuat undangan digital.
                            @endif
                        </p>
                    </div>
                </div>
                <a href="{{ route('themes.catalog') }}" class="flex-shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-charcoal-950 text-brand-300 text-xs font-bold hover:bg-charcoal-900 transition shadow">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                    <span>Pilih Tema Baru di Katalog</span>
                </a>
            </div>
        @endif

        <!-- ERROR VALIDATION ALERT -->
        @if ($errors->any())
            <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
                <div class="flex items-center gap-2 font-bold text-rose-900">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600"></i>
                    <span>Terdapat beberapa data yang belum lengkap:</span>
                </div>
                <ul class="list-disc list-inside space-y-0.5 text-[11px] text-rose-700 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 6-STEP WIZARD NAVIGATION BAR -->
        <div class="p-1.5 rounded-2xl glass-panel border border-sand-200 grid grid-cols-3 sm:grid-cols-6 gap-1 text-center text-xs font-semibold">
            <button 
                type="button" 
                @click="goToStep(1)" 
                :class="currentStep === 1 ? 'bg-charcoal-950 text-white shadow-sm' : 'text-sand-600 hover:bg-sand-100'"
                class="py-2 px-1 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer"
            >
                <span class="w-4 h-4 rounded-full bg-brand-500 text-white text-[9px] font-bold flex items-center justify-center">1</span>
                <span class="text-[11px] truncate">Tema</span>
            </button>

            <button 
                type="button" 
                @click="goToStep(2)" 
                :class="currentStep === 2 ? 'bg-charcoal-950 text-white shadow-sm' : 'text-sand-600 hover:bg-sand-100'"
                class="py-2 px-1 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer"
            >
                <span class="w-4 h-4 rounded-full bg-brand-500 text-white text-[9px] font-bold flex items-center justify-center">2</span>
                <span class="text-[11px] truncate">Mempelai</span>
            </button>

            <button 
                type="button" 
                @click="goToStep(3)" 
                :class="currentStep === 3 ? 'bg-charcoal-950 text-white shadow-sm' : 'text-sand-600 hover:bg-sand-100'"
                class="py-2 px-1 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer"
            >
                <span class="w-4 h-4 rounded-full bg-brand-500 text-white text-[9px] font-bold flex items-center justify-center">3</span>
                <span class="text-[11px] truncate">Acara</span>
            </button>

            <button 
                type="button" 
                @click="goToStep(4)" 
                :class="currentStep === 4 ? 'bg-charcoal-950 text-white shadow-sm' : 'text-sand-600 hover:bg-sand-100'"
                class="py-2 px-1 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer"
            >
                <span class="w-4 h-4 rounded-full bg-brand-500 text-white text-[9px] font-bold flex items-center justify-center">4</span>
                <span class="text-[11px] truncate">Kisah Perjalanan</span>
            </button>

            <button 
                type="button" 
                @click="goToStep(5)" 
                :class="currentStep === 5 ? 'bg-charcoal-950 text-white shadow-sm' : 'text-sand-600 hover:bg-sand-100'"
                class="py-2 px-1 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer"
            >
                <span class="w-4 h-4 rounded-full bg-brand-500 text-white text-[9px] font-bold flex items-center justify-center">5</span>
                <span class="text-[11px] truncate">Galeri &amp; Musik</span>
            </button>

            <button 
                type="button" 
                @click="goToStep(6)" 
                :class="currentStep === 6 ? 'bg-charcoal-950 text-white shadow-sm' : 'text-sand-600 hover:bg-sand-100'"
                class="py-2 px-1 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer"
            >
                <span class="w-4 h-4 rounded-full bg-brand-500 text-white text-[9px] font-bold flex items-center justify-center">6</span>
                <span class="text-[11px] truncate">Amplop &amp; Rilis</span>
            </button>
        </div>

        <!-- ERROR MESSAGE BANNER FOR STEP VALIDATION -->
        <div x-show="errorMessage" x-cloak x-transition class="p-3.5 rounded-2xl bg-rose-50 border border-rose-300 text-rose-800 text-xs flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2 font-medium">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 flex-shrink-0"></i>
                <span x-text="errorMessage"></span>
            </div>
            <button type="button" @click="errorMessage = ''" class="text-rose-500 hover:text-rose-700">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- FORM WRAPPER WITH MULTIPART SUPPORT -->
        <form method="POST" action="{{ route('member.invitations.store') }}" enctype="multipart/form-data" @submit="submitForm($event)" novalidate class="space-y-4">
            @csrf

            <!-- HIDDEN INPUT FOR THEME ID -->
            <input type="hidden" name="theme_id" :value="selectedTheme">

            <!-- MAIN CONTAINER -->
            <div class="p-5 sm:p-6 rounded-2xl glass-panel border border-sand-200 space-y-5">
                
                <!-- ========================================== -->
                <!-- STEP 1: PILIH TEMA DESAIN -->
                <!-- ========================================== -->
                <div x-show="currentStep === 1" data-step="1" class="space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-sand-200">
                        <div>
                            <h3 class="font-serif text-base font-bold text-charcoal-950">Langkah 1: Pilih Tema Desain &amp; Judul Undangan</h3>
                            <p class="text-[11px] text-sand-600">Pilih tema aktif yang telah Anda miliki untuk digunakan pada undangan digital ini.</p>
                        </div>
                        @if ($themes->isNotEmpty())
                            <span class="text-[11px] font-bold text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                {{ $themes->count() }} Tema Siap Pakai
                            </span>
                        @endif
                    </div>

                    @if ($themes->isEmpty())
                        <div class="p-8 rounded-2xl bg-sand-50/80 border border-dashed border-sand-300 text-center space-y-3">
                            <div class="w-12 h-12 mx-auto rounded-full bg-sand-200 flex items-center justify-center text-sand-500">
                                <i data-lucide="layers" class="w-6 h-6"></i>
                            </div>
                            <div class="space-y-1">
                                <p class="font-bold text-xs text-charcoal-900">
                                    @if(!empty($usedThemeIds))
                                        Semua Tema Anda Sudah Digunakan (1 Tema = 1 Undangan)
                                    @else
                                        Belum Ada Tema yang Dapat Dipilih
                                    @endif
                                </p>
                                <p class="text-[11px] text-sand-600 max-w-md mx-auto">
                                    @if(!empty($usedThemeIds))
                                        Setiap lisensi tema hanya berlaku untuk 1 undangan. Untuk membuat undangan berikutnya, silakan beli tema baru di katalog.
                                    @else
                                        Anda memerlukan minimal satu tema aktif untuk menerbitkan undangan. Silakan beli tema terlebih dahulu di katalog.
                                    @endif
                                </p>
                            </div>
                            <a href="{{ route('themes.catalog') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-charcoal-950 text-white text-xs font-bold hover:bg-brand-600 transition">
                                <i data-lucide="shopping-bag" class="w-3.5 h-3.5"></i>
                                <span>Beli Tema Baru di Katalog</span>
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($themes as $theme)
                                <div 
                                    @click="selectedTheme = '{{ $theme->id }}'"
                                    :class="selectedTheme == '{{ $theme->id }}' ? 'ring-2 ring-brand-500 shadow-md border-brand-500 bg-brand-500/5' : 'border-sand-200 opacity-90 hover:opacity-100 bg-white'"
                                    class="group rounded-2xl overflow-hidden glass-panel border cursor-pointer transition-all duration-200 flex flex-col justify-between"
                                >
                                    <div class="relative aspect-[16/10] overflow-hidden bg-sand-200">
                                        <img src="{{ $theme->thumbnail }}" alt="{{ $theme->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        <div class="absolute top-2.5 left-2.5">
                                            <span class="px-2 py-0.5 rounded-full bg-charcoal-950/80 backdrop-blur-md text-brand-200 text-[9px] font-bold uppercase">
                                                {{ $theme->category }}
                                            </span>
                                        </div>
                                        <div class="absolute top-2.5 right-2.5" x-show="selectedTheme == '{{ $theme->id }}'">
                                            <div class="w-5 h-5 rounded-full bg-brand-500 text-white flex items-center justify-center shadow">
                                                <i data-lucide="check" class="w-3 h-3"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3.5 space-y-1">
                                        <div class="flex items-center justify-between gap-2">
                                            <h4 class="font-serif text-xs font-bold text-charcoal-950 truncate">{{ $theme->name }}</h4>
                                            <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200 flex items-center gap-1 flex-shrink-0">
                                                <i data-lucide="check-circle" class="w-2.5 h-2.5 text-emerald-600"></i>
                                                <span>Siap Pakai</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- TITLE & SLUG -->
                    <div class="pt-4 border-t border-sand-200 grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div>
                            <label class="font-bold text-charcoal-900 block mb-1">Judul Undangan <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="title" 
                                value="{{ old('title', '') }}" 
                                required
                                placeholder="Contoh: Pernikahan Dimas &amp; Anisa"
                                class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-xs"
                            >
                        </div>
                        <div>
                            <label class="font-bold text-charcoal-900 block mb-1">Kustom Link Slug (Opsional)</label>
                            <div class="flex items-center">
                                <span class="px-3 py-2 rounded-l-xl bg-sand-200 text-sand-600 font-mono text-[11px] border border-r-0 border-sand-200">/u/</span>
                                <input 
                                    type="text" 
                                    name="slug" 
                                    value="{{ old('slug', '') }}" 
                                    placeholder="dimas-anisa (otomatis jika kosong)"
                                    class="w-full px-3 py-2 rounded-r-xl border border-sand-200 bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-xs"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- KUTIPAN AYAT / DOA / KATA MUTIARA (QUOTES) -->
                    <div class="pt-4 border-t border-sand-200 space-y-3 text-xs" x-data="{
                        quoteText: @js(old('quote_text', 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.')),
                        quoteSource: @js(old('quote_source', 'QS. Ar-Rum: 21')),
                        presets: [
                            {
                                label: '🕌 QS. Ar-Rum: 21 (Islami)',
                                text: 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
                                source: 'QS. Ar-Rum: 21'
                            },
                            {
                                label: '⛪ 1 Korintus 13:4-7 (Kristiani)',
                                text: 'Kasih itu sabar; kasih itu murah hati; ia tidak cemburu. Ia tidak memegahkan diri dan tidak sombong. Kasih menutupi segala sesuatu, percaya segala sesuatu, mengharapkan segala sesuatu, sabar menanggung segala sesuatu.',
                                source: '1 Korintus 13:4-7'
                            },
                            {
                                label: '🌿 Kahlil Gibran (Puitis)',
                                text: 'Cinta tidak memiliki ataupun dimiliki, karena cinta telah cukup bagi cinta. Berdirilah bersama, tetapi jangan terlalu dekat, karena tiang-tiang kuil berdiri terpisah.',
                                source: 'Kahlil Gibran'
                            },
                            {
                                label: '✨ Janji Suci (Universal)',
                                text: 'Dua jiwa namun satu pikiran, dua hati namun satu detak. Melangkah bersama mengarungi samudra kehidupan dalam ikatan suci pernikahan.',
                                source: 'Janji Suci'
                            }
                        ],
                        setPreset(p) {
                            this.quoteText = p.text;
                            this.quoteSource = p.source;
                        }
                    }">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5">
                            <div>
                                <label class="font-bold text-charcoal-900 block">Kutipan Ayat / Doa / Kata Mutiara (Quotes)</label>
                                <p class="text-[11px] text-sand-500">Tampil di bagian pembuka undangan sebagai ungkapan doa atau rasa syukur.</p>
                            </div>
                            <span class="text-[9px] text-brand-800 bg-brand-50 px-2.5 py-0.5 rounded-full border border-brand-200/80 font-semibold self-start sm:self-auto">
                                Pilihan Cepat di Bawah
                            </span>
                        </div>

                        <!-- QUICK PRESET CHIPS -->
                        <div class="flex flex-wrap gap-1.5">
                            <template x-for="(preset, idx) in presets" :key="idx">
                                <button 
                                    type="button" 
                                    @click="setPreset(preset)"
                                    class="px-2.5 py-1 rounded-lg bg-sand-100 hover:bg-brand-100 text-charcoal-800 hover:text-brand-900 text-[10px] font-medium border border-sand-200 transition flex items-center gap-1 cursor-pointer"
                                >
                                    <span x-text="preset.label"></span>
                                </button>
                            </template>
                        </div>

                        <!-- INPUT TEXTAREA & SOURCE -->
                        <div class="space-y-2 pt-1">
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Isi Kutipan / Quotes</label>
                                <textarea 
                                    x-model="quoteText"
                                    name="quote_text" 
                                    rows="3" 
                                    placeholder="Tuliskan kutipan ayat suci, doa, atau kata mutiara pernikahan Anda..."
                                    class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-xs leading-relaxed"
                                ></textarea>
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Sumber Kutipan / Nama Kitab / Tokoh (Opsional)</label>
                                <input 
                                    x-model="quoteSource"
                                    type="text" 
                                    name="quote_source" 
                                    placeholder="Contoh: QS. Ar-Rum: 21 / 1 Korintus 13:4 / Kahlil Gibran"
                                    class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-xs"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-3">
                        <button 
                            type="button" 
                            @click="goToStep(2)" 
                            @if ($themes->isEmpty()) disabled class="opacity-50 cursor-not-allowed px-5 py-2.5 rounded-xl bg-sand-300 text-charcoal-700 font-bold text-xs" @else class="px-5 py-2.5 rounded-xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-1.5 cursor-pointer" @endif
                        >
                            <span>Lanjut ke Data Mempelai</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- STEP 2: DATA MEMPELAI -->
                <!-- ========================================== -->
                <div x-show="currentStep === 2" data-step="2" class="space-y-4" style="display: none;">
                    <div class="pb-2 border-b border-sand-200">
                        <h3 class="font-serif text-base font-bold text-charcoal-950">Langkah 2: Informasi &amp; Foto Kedua Mempelai</h3>
                        <p class="text-[11px] text-sand-600">Lengkapi data pribadi serta unggah foto profil mempelai pria dan wanita.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- DATA MEMPELAI PRIA -->
                        <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-3 text-xs">
                            <div class="flex items-center justify-between pb-2 border-b border-sand-200">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-brand-600 text-white flex items-center justify-center font-bold text-[9px]">1</span>
                                    <h4 class="font-serif text-sm font-bold text-charcoal-950">Mempelai Pria (Groom)</h4>
                                </div>
                            </div>

                            <!-- FOTO MEMPELAI PRIA -->
                            <div class="p-3 rounded-xl bg-white border border-sand-200 space-y-1.5">
                                <label class="font-bold text-charcoal-900 block text-[11px]">Foto Profil Pria (Opsional)</label>
                                <div class="flex items-center gap-3">
                                    <div class="w-14 h-14 rounded-xl bg-sand-100 overflow-hidden border border-sand-200 flex-shrink-0 flex items-center justify-center">
                                        <template x-if="groomPreview">
                                            <img :src="groomPreview" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!groomPreview">
                                            <div class="w-full h-full flex flex-col items-center justify-center bg-sand-100 text-sand-400">
                                                <i data-lucide="user" class="w-6 h-6"></i>
                                                <span class="text-[8px] text-sand-500 font-medium mt-0.5">Pria</span>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="flex-1 space-y-1">
                                        <input 
                                            type="file" 
                                            name="groom_photo_file" 
                                            accept="image/*"
                                            @change="previewFile($event, 'groomPreview')"
                                            class="w-full text-xs text-sand-600 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-sand-200 file:text-charcoal-950 hover:file:bg-sand-300"
                                        >
                                        <span class="text-[9px] text-sand-500 block">Format: JPG, PNG, WEBP (Maks. 5MB)</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Lengkap &amp; Gelar <span class="text-rose-500">*</span></label>
                                <input type="text" name="groom_name" value="{{ old('groom_name', '') }}" required placeholder="Contoh: Dimas Arya Pratama, S.T." class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div class="grid grid-cols-2 gap-2.5">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Panggilan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="groom_nickname" value="{{ old('groom_nickname', '') }}" required placeholder="Contoh: Dimas" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Urutan Anak</label>
                                    <input type="text" name="groom_child_order" value="{{ old('groom_child_order', '') }}" placeholder="Contoh: Putra pertama" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ayah</label>
                                <input type="text" name="groom_father" value="{{ old('groom_father', '') }}" placeholder="Nama Lengkap Ayah" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ibu</label>
                                <input type="text" name="groom_mother" value="{{ old('groom_mother', '') }}" placeholder="Nama Lengkap Ibu" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Akun Instagram (Opsional)</label>
                                <div class="flex items-center">
                                    <span class="px-2.5 py-2 rounded-l-xl bg-sand-200 text-sand-600 font-mono text-[11px] border border-r-0 border-sand-200">@</span>
                                    <input type="text" name="groom_instagram" value="{{ old('groom_instagram', '') }}" placeholder="username_ig" class="w-full px-3 py-2 rounded-r-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>
                        </div>

                        <!-- DATA MEMPELAI WANITA -->
                        <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-3 text-xs">
                            <div class="flex items-center justify-between pb-2 border-b border-sand-200">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-rose-500 text-white flex items-center justify-center font-bold text-[9px]">2</span>
                                    <h4 class="font-serif text-sm font-bold text-charcoal-950">Mempelai Wanita (Bride)</h4>
                                </div>
                            </div>

                            <!-- FOTO MEMPELAI WANITA -->
                            <div class="p-3 rounded-xl bg-white border border-sand-200 space-y-1.5">
                                <label class="font-bold text-charcoal-900 block text-[11px]">Foto Profil Wanita (Opsional)</label>
                                <div class="flex items-center gap-3">
                                    <div class="w-14 h-14 rounded-xl bg-sand-100 overflow-hidden border border-sand-200 flex-shrink-0 flex items-center justify-center">
                                        <template x-if="bridePreview">
                                            <img :src="bridePreview" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!bridePreview">
                                            <div class="w-full h-full flex flex-col items-center justify-center bg-sand-100 text-sand-400">
                                                <i data-lucide="user" class="w-6 h-6"></i>
                                                <span class="text-[8px] text-sand-500 font-medium mt-0.5">Wanita</span>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="flex-1 space-y-1">
                                        <input 
                                            type="file" 
                                            name="bride_photo_file" 
                                            accept="image/*"
                                            @change="previewFile($event, 'bridePreview')"
                                            class="w-full text-xs text-sand-600 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-sand-200 file:text-charcoal-950 hover:file:bg-sand-300"
                                        >
                                        <span class="text-[9px] text-sand-500 block">Format: JPG, PNG, WEBP (Maks. 5MB)</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Lengkap &amp; Gelar <span class="text-rose-500">*</span></label>
                                <input type="text" name="bride_name" value="{{ old('bride_name', '') }}" required placeholder="Contoh: Anisa Putri Maharani, S.Ked" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div class="grid grid-cols-2 gap-2.5">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Panggilan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="bride_nickname" value="{{ old('bride_nickname', '') }}" required placeholder="Contoh: Anisa" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Urutan Anak</label>
                                    <input type="text" name="bride_child_order" value="{{ old('bride_child_order', '') }}" placeholder="Contoh: Putri kedua" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ayah</label>
                                <input type="text" name="bride_father" value="{{ old('bride_father', '') }}" placeholder="Nama Lengkap Ayah" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ibu</label>
                                <input type="text" name="bride_mother" value="{{ old('bride_mother', '') }}" placeholder="Nama Lengkap Ibu" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Akun Instagram (Opsional)</label>
                                <div class="flex items-center">
                                    <span class="px-2.5 py-2 rounded-l-xl bg-sand-200 text-sand-600 font-mono text-[11px] border border-r-0 border-sand-200">@</span>
                                    <input type="text" name="bride_instagram" value="{{ old('bride_instagram', '') }}" placeholder="username_ig" class="w-full px-3 py-2 rounded-r-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-sand-200">
                        <button type="button" @click="goToStep(1)" class="px-4 py-2 rounded-xl bg-sand-200 text-charcoal-900 font-bold text-xs hover:bg-sand-300 transition cursor-pointer">
                            Kembali
                        </button>
                        <button type="button" @click="goToStep(3)" class="px-5 py-2.5 rounded-xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-1.5 cursor-pointer">
                            <span>Lanjut ke Jadwal Acara</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- STEP 3: JADWAL & LOKASI ACARA -->
                <!-- ========================================== -->
                <div x-show="currentStep === 3" data-step="3" class="space-y-4" style="display: none;">
                    <div class="pb-2 border-b border-sand-200">
                        <h3 class="font-serif text-base font-bold text-charcoal-950">Langkah 3: Rangkaian Jadwal Acara</h3>
                        <p class="text-[11px] text-sand-600">Atur tanggal, waktu, dan lokasi prosesi pernikahan Anda.</p>
                    </div>

                    <div class="space-y-4">
                        
                        <!-- 1. AKAD NIKAH -->
                        <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-3">
                            <h4 class="font-serif text-sm font-bold text-charcoal-950 flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full bg-brand-600 text-white text-[9px] flex items-center justify-center font-bold">1</span>
                                <span>Akad Nikah / Pemberkatan</span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Tanggal <span class="text-rose-500">*</span></label>
                                    <input type="date" name="akad_date" value="{{ old('akad_date', '') }}" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Waktu Acara <span class="text-rose-500">*</span></label>
                                    <input type="text" name="akad_time" value="{{ old('akad_time', '') }}" placeholder="Contoh: 08.00 - 10.00 WIB" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Tempat / Gedung <span class="text-rose-500">*</span></label>
                                    <input type="text" name="akad_venue" value="{{ old('akad_venue', '') }}" placeholder="Nama Masjid / Gedung / Rumah" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Alamat Lengkap <span class="text-rose-500">*</span></label>
                                    <input type="text" name="akad_address" value="{{ old('akad_address', '') }}" placeholder="Alamat lengkap lokasi prosesi akad" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Link Google Maps (Opsional)</label>
                                    <input type="url" name="akad_maps_link" value="{{ old('akad_maps_link', '') }}" placeholder="https://maps.app.goo.gl/..." class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>
                        </div>

                        <!-- 2. RESEPSI PERNIKAHAN -->
                        <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-3">
                            <h4 class="font-serif text-sm font-bold text-charcoal-950 flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full bg-brand-600 text-white text-[9px] flex items-center justify-center font-bold">2</span>
                                <span>Resepsi Pernikahan / Syukuran</span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Tanggal <span class="text-rose-500">*</span></label>
                                    <input type="date" name="resepsi_date" value="{{ old('resepsi_date', '') }}" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Waktu Acara <span class="text-rose-500">*</span></label>
                                    <input type="text" name="resepsi_time" value="{{ old('resepsi_time', '') }}" placeholder="Contoh: 11.00 - 14.00 WIB" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Tempat / Gedung <span class="text-rose-500">*</span></label>
                                    <input type="text" name="resepsi_venue" value="{{ old('resepsi_venue', '') }}" placeholder="Nama Ballroom / Hotel / Tempat" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Alamat Lengkap <span class="text-rose-500">*</span></label>
                                    <input type="text" name="resepsi_address" value="{{ old('resepsi_address', '') }}" placeholder="Alamat lengkap lokasi acara resepsi" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Link Google Maps (Opsional)</label>
                                    <input type="url" name="resepsi_maps_link" value="{{ old('resepsi_maps_link', '') }}" placeholder="https://maps.app.goo.gl/..." class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-sand-200">
                        <button type="button" @click="goToStep(2)" class="px-4 py-2 rounded-xl bg-sand-200 text-charcoal-900 font-bold text-xs hover:bg-sand-300 transition cursor-pointer">
                            Kembali
                        </button>
                        <button type="button" @click="goToStep(4)" class="px-5 py-2.5 rounded-xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-1.5 cursor-pointer">
                            <span>Lanjut ke Kisah Perjalanan</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- STEP 4: KISAH PERJALANAN (LOVE STORY) -->
                <!-- ========================================== -->
                <div x-show="currentStep === 4" data-step="4" class="space-y-4" style="display: none;">
                    <div class="pb-2 border-b border-sand-200 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <h3 class="font-serif text-base font-bold text-charcoal-950">Langkah 4: Kisah Perjalanan (Love Story)</h3>
                            <p class="text-[11px] text-sand-600">Bagikan momen-momen manis perjalanan cinta Anda dari awal bertemu hingga ke pelaminan (opsional).</p>
                        </div>
                        <button 
                            type="button" 
                            @click="addStory()"
                            x-show="stories.length < 8"
                            class="self-start sm:self-auto inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold text-xs transition shadow-sm cursor-pointer"
                        >
                            <i data-lucide="plus-circle" class="w-3.5 h-3.5"></i>
                            <span>Tambah Babak Kisah</span>
                        </button>
                    </div>

                    <div class="space-y-3.5">
                        <template x-for="(story, index) in stories" :key="index">
                            <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-3 transition hover:border-sand-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-full bg-brand-600 text-white text-[9px] flex items-center justify-center font-bold" x-text="index + 1"></span>
                                        <h4 class="font-serif text-xs sm:text-sm font-bold text-charcoal-950" x-text="story.title ? story.title : ('Babak Kisah ' + (index + 1))"></h4>
                                    </div>
                                    <button 
                                        type="button" 
                                        @click="removeStory(index)"
                                        class="text-rose-500 hover:text-rose-700 p-1 rounded-lg hover:bg-rose-50 text-[11px] flex items-center gap-1 font-semibold transition cursor-pointer"
                                        title="Hapus babak ini"
                                    >
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        <span class="hidden sm:inline">Hapus</span>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 gap-3 text-xs" :class="themeSupportsStoryImages() ? 'sm:grid-cols-12' : 'sm:grid-cols-1'">
                                    <!-- FOTO KENANGAN BABAK (HANYA UNTUK TEMA YANG MEMILIKI GAMBAR LOVE STORY) -->
                                    <div x-show="themeSupportsStoryImages()" class="sm:col-span-3 flex flex-col items-center gap-2">
                                        <div class="w-full aspect-[4/3] rounded-xl bg-sand-200 overflow-hidden border border-sand-300 relative flex items-center justify-center">
                                            <template x-if="story.imagePreview">
                                                <img :src="story.imagePreview" class="w-full h-full object-cover">
                                            </template>
                                            <template x-if="!story.imagePreview">
                                                <div class="w-full h-full flex flex-col items-center justify-center text-sand-400 p-2 text-center bg-sand-100">
                                                    <i data-lucide="image" class="w-5 h-5"></i>
                                                    <span class="text-[8px] text-sand-500 mt-0.5">Foto Momen</span>
                                                </div>
                                            </template>
                                        </div>
                                        <input 
                                            type="file" 
                                            :name="`stories[${index}][image_file]`" 
                                            accept="image/*"
                                            @change="previewStoryFile($event, index)"
                                            class="w-full text-[10px] text-sand-600 file:mr-1 file:py-0.5 file:px-2 file:rounded-md file:border-0 file:text-[9px] file:font-bold file:bg-sand-200 file:text-charcoal-950 hover:file:bg-sand-300 cursor-pointer"
                                        >
                                    </div>

                                    <!-- FORM ISIAN BABAK KISAH -->
                                    <div :class="themeSupportsStoryImages() ? 'sm:col-span-9' : 'w-full'" class="space-y-2.5">
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                                            <div class="sm:col-span-2">
                                                <label class="font-bold text-charcoal-900 block mb-1">Judul Momen / Babak</label>
                                                <input 
                                                    type="text" 
                                                    :name="`stories[${index}][title]`" 
                                                    x-model="story.title"
                                                    placeholder="Contoh: Awal Berjumpa / Pertama Kencan / Lamaran" 
                                                    class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs font-medium"
                                                >
                                            </div>
                                            <div>
                                                <label class="font-bold text-charcoal-900 block mb-1">Tahun / Waktu</label>
                                                <input 
                                                    type="text" 
                                                    :name="`stories[${index}][date]`" 
                                                    x-model="story.date"
                                                    placeholder="Contoh: 2021 atau 14 Feb 2022" 
                                                    class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs font-medium"
                                                >
                                            </div>
                                        </div>

                                        <div>
                                            <label class="font-bold text-charcoal-900 block mb-1">Cerita Singkat Momen Ini</label>
                                            <textarea 
                                                :name="`stories[${index}][story]`" 
                                                x-model="story.story"
                                                rows="2" 
                                                placeholder="Tuliskan cerita singkat tentang apa yang terjadi di fase perjalanan cinta ini..."
                                                class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs font-normal"
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-sand-200">
                        <button type="button" @click="goToStep(3)" class="px-4 py-2 rounded-xl bg-sand-200 text-charcoal-900 font-bold text-xs hover:bg-sand-300 transition cursor-pointer">
                            Kembali
                        </button>
                        <button type="button" @click="goToStep(5)" class="px-5 py-2.5 rounded-xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-1.5 cursor-pointer">
                            <span>Lanjut ke Galeri &amp; Musik</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- STEP 5: GALERI FOTO & MUSIK -->
                <!-- ========================================== -->
                <div x-show="currentStep === 5" data-step="5" class="space-y-4" style="display: none;">
                    <div class="pb-2 border-b border-sand-200">
                        <h3 class="font-serif text-base font-bold text-charcoal-950">Langkah 5: Galeri Foto Prewedding &amp; Musik Latar</h3>
                        <p class="text-[11px] text-sand-600">Unggah foto cover utama, album galeri prewedding, dan tentukan lagu pengiring undangan.</p>
                    </div>

                    <!-- 1. FOTO COVER UTAMA -->
                    <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-3 text-xs">
                        <h4 class="font-serif text-sm font-bold text-charcoal-950 flex items-center gap-2">
                            <i data-lucide="image" class="w-4 h-4 text-brand-600"></i>
                            <span>Foto Cover / Sampul Utama</span>
                        </h4>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                            <!-- PREVIEW COVER -->
                            <div class="sm:col-span-4 aspect-[4/3] rounded-xl bg-sand-200 overflow-hidden border border-sand-300 relative group">
                                <template x-if="coverPreview">
                                    <img :src="coverPreview" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!coverPreview">
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-sand-100 text-sand-400 p-3 text-center">
                                        <i data-lucide="image" class="w-7 h-7"></i>
                                        <span class="text-[9px] text-sand-500 font-medium mt-1">Belum ada foto cover</span>
                                    </div>
                                </template>
                                <div class="absolute bottom-1.5 left-1.5 px-2 py-0.5 rounded-md bg-charcoal-950/70 backdrop-blur-md text-white text-[8px] font-bold">
                                    Cover Preview
                                </div>
                            </div>

                            <div class="sm:col-span-8 space-y-1.5">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Unggah Berkas Foto Cover</label>
                                    <input 
                                        type="file" 
                                        name="cover_image_file" 
                                        accept="image/*"
                                        @change="previewFile($event, 'coverPreview')"
                                        class="w-full text-xs text-sand-600 file:mr-2.5 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-charcoal-950 file:text-white hover:file:bg-brand-600 cursor-pointer"
                                    >
                                </div>
                                <span class="text-[9px] text-sand-500 block">Rekomendasi rasio potret atau lanskap resolusi tinggi (JPG, PNG, WEBP, maks 5MB).</span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. UNGGAH BANYAK FOTO GALERI -->
                    <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-3 text-xs">
                        <div class="flex items-center justify-between">
                            <h4 class="font-serif text-sm font-bold text-charcoal-950 flex items-center gap-2">
                                <i data-lucide="images" class="w-4 h-4 text-brand-600"></i>
                                <span>Galeri Album Prewedding (Multi-Upload)</span>
                            </h4>
                            <span class="text-[9px] text-brand-700 font-bold bg-brand-50 px-2 py-0.5 rounded-full border border-brand-200">
                                Bisa Pilih Banyak Sekaligus
                            </span>
                        </div>

                        <div class="space-y-2">
                            <label class="font-bold text-charcoal-900 block">Pilih Foto-Foto Prewedding (Opsional)</label>
                            <input 
                                type="file" 
                                name="gallery_files[]" 
                                multiple
                                accept="image/*"
                                @change="previewMultipleGalleries($event)"
                                class="w-full text-xs text-sand-600 file:mr-2.5 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-charcoal-950 file:text-white hover:file:bg-brand-600 cursor-pointer"
                            >
                            <p class="text-[9px] text-sand-500">Anda dapat memilih 4 - 10 foto prewedding terbaik untuk ditampilkan di album galeri.</p>
                        </div>

                        <!-- LIVE MULTI-PREVIEWS -->
                        <div x-show="galleryPreviews.length > 0" class="pt-2">
                            <span class="text-[9px] font-bold uppercase tracking-wider text-sand-500 block mb-1.5">Foto Yang Dipilih:</span>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                <template x-for="(img, idx) in galleryPreviews" :key="idx">
                                    <div class="aspect-square rounded-xl bg-sand-200 overflow-hidden border border-sand-300 shadow-sm relative">
                                        <img :src="img" class="w-full h-full object-cover">
                                        <span class="absolute top-1 left-1 px-1.5 py-0.5 rounded bg-charcoal-950/75 text-white text-[8px] font-bold" x-text="idx + 1"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- 3. MUSIK LATAR -->
                    <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-3 text-xs">
                        <div class="flex items-center justify-between">
                            <h4 class="font-serif text-sm font-bold text-charcoal-950 flex items-center gap-2">
                                <i data-lucide="music" class="w-4 h-4 text-brand-600"></i>
                                <span>Pilihan Musik Latar (Background Music)</span>
                            </h4>

                            <!-- LIVE TEST BUTTON -->
                            <button 
                                type="button" 
                                @click="toggleAudioTest()"
                                :class="isPlayingAudio ? 'bg-brand-500 text-white shadow-sm' : 'bg-charcoal-950 text-white'"
                                class="px-3 py-1 rounded-full font-bold text-[10px] transition flex items-center gap-1.5 cursor-pointer"
                            >
                                <i :data-lucide="isPlayingAudio ? 'pause' : 'play'" class="w-3 h-3 fill-current"></i>
                                <span x-text="isPlayingAudio ? 'Jeda Audio' : 'Tes Lagu'"></span>
                            </button>
                        </div>

                        <!-- PRESET SELECTION -->
                        <div class="space-y-1.5">
                            <label class="font-bold text-charcoal-900 block">Pilihan Musik Instrumen Romantis Siap Pakai:</label>
                            <select 
                                name="music_preset" 
                                x-model="selectedMusic"
                                @change="changeMusicPreset($event.target.value)"
                                class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white font-medium focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-xs"
                            >
                                @foreach ($musicPresets as $music)
                                    <option value="{{ $music['file'] }}">{{ $music['title'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- OR UPLOAD CUSTOM MP3 -->
                        <div class="pt-2 border-t border-sand-200 space-y-1.5">
                            <label class="font-bold text-charcoal-900 block">Atau Unggah Berkas Musik Sendiri (Opsional):</label>
                            <input 
                                type="file" 
                                name="music_file" 
                                accept="audio/mp3,audio/wav,audio/m4a,audio/*"
                                class="w-full text-xs text-sand-600 file:mr-2.5 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-sand-200 file:text-charcoal-950 hover:file:bg-sand-300 cursor-pointer"
                            >
                            <span class="text-[9px] text-sand-500 block">Mendukung format .mp3, .wav, .m4a (Maks. 10MB). Musik akan otomatis berputar saat tamu membuka undangan.</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-sand-200">
                        <button type="button" @click="goToStep(4)" class="px-4 py-2 rounded-xl bg-sand-200 text-charcoal-900 font-bold text-xs hover:bg-sand-300 transition">
                            Kembali
                        </button>
                        <button type="button" @click="goToStep(6)" class="px-5 py-2.5 rounded-xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-1.5 cursor-pointer">
                            <span>Lanjut ke Amplop &amp; Rilis</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- STEP 6: AMPLOP & PUBLISH -->
                <!-- ========================================== -->
                <div x-show="currentStep === 6" data-step="6" class="space-y-4" style="display: none;">
                    <div class="pb-2 border-b border-sand-200">
                        <h3 class="font-serif text-base font-bold text-charcoal-950">Langkah 6: Rekening Amplop &amp; Rilis</h3>
                        <p class="text-[11px] text-sand-600">Nomor rekening transfer untuk kado pernikahan digital para tamu.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <!-- BANK 1 -->
                        <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-2.5 text-xs">
                            <h4 class="font-serif text-xs font-bold text-charcoal-950">Rekening Bank 1 (Utama)</h4>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Bank</label>
                                <input type="text" name="bank_1_name" value="{{ old('bank_1_name', '') }}" placeholder="BCA / Mandiri / BRI / BSI" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nomor Rekening</label>
                                <input type="text" name="bank_1_number" value="{{ old('bank_1_number', '') }}" placeholder="Nomor rekening" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Atas Nama Rekening</label>
                                <input type="text" name="bank_1_holder" value="{{ old('bank_1_holder', '') }}" placeholder="Nama pemilik rekening" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                        </div>

                        <!-- BANK 2 -->
                        <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-2.5 text-xs">
                            <h4 class="font-serif text-xs font-bold text-charcoal-950">Rekening Bank 2 (Opsional)</h4>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Bank</label>
                                <input type="text" name="bank_2_name" value="{{ old('bank_2_name', '') }}" placeholder="Bank Mandiri / BNI / E-Wallet" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nomor Rekening</label>
                                <input type="text" name="bank_2_number" value="{{ old('bank_2_number', '') }}" placeholder="Nomor rekening" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Atas Nama Rekening</label>
                                <input type="text" name="bank_2_holder" value="{{ old('bank_2_holder', '') }}" placeholder="Nama pemilik rekening" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                        </div>
                    </div>

                    <!-- KADO FISIK / ALAMAT PENGIRIMAN -->
                    <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-2 text-xs">
                        <div class="flex items-center justify-between">
                            <h4 class="font-serif text-xs font-bold text-charcoal-950 flex items-center gap-1.5">
                                <i data-lucide="package" class="w-3.5 h-3.5 text-brand-600"></i>
                                <span>Alamat Pengiriman Kado Fisik (Opsional)</span>
                            </h4>
                            <span class="text-[9px] text-sand-500">Untuk tamu yang ingin mengirim kado/parcel</span>
                        </div>
                        <textarea 
                            name="gift_address" 
                            rows="2" 
                            placeholder="Contoh: Jl. Senopati Raya No. 45, Kebayoran Baru, Jakarta Selatan 12190 (Penerima: Dimas & Anisa - 0812-3456-7890)" 
                            class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs placeholder-sand-400"
                        >{{ old('gift_address', '') }}</textarea>
                    </div>

                    <!-- TEMPLATE PESAN WHATSAPP -->
                    <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-2.5 text-xs">
                        <div class="flex items-center justify-between">
                            <h4 class="font-serif text-xs font-bold text-charcoal-950 flex items-center gap-1.5">
                                <i data-lucide="message-circle" class="w-3.5 h-3.5 text-emerald-600"></i>
                                <span>Template Ucapan WhatsApp (Kirim Undangan)</span>
                            </h4>
                            <span class="text-[9px] text-emerald-700 font-bold bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">Opsional</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-1.5 text-[10px] text-sand-600">
                            <span class="font-bold text-charcoal-800">Variabel:</span>
                            <code class="px-1.5 py-0.5 rounded bg-white text-charcoal-900 font-mono border border-sand-200">[nama]</code>
                            <span>= Nama Tamu,</span>
                            <code class="px-1.5 py-0.5 rounded bg-white text-charcoal-900 font-mono border border-sand-200">[link]</code>
                            <span>= Link Undangan</span>
                        </div>
                        <textarea 
                            name="whatsapp_template" 
                            rows="6" 
                            placeholder="{{ \App\Models\Invitation::defaultWhatsappTemplate() }}"
                            class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs font-mono placeholder-sand-400"
                        >{{ old('whatsapp_template', \App\Models\Invitation::defaultWhatsappTemplate()) }}</textarea>
                        <p class="text-[9px] text-sand-500">Dapat diedit kapan saja melalui menu Buku Tamu setelah rilis.</p>
                    </div>

                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-900 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i data-lucide="sparkles" class="w-5 h-5 text-emerald-600 flex-shrink-0"></i>
                            <div>
                                <p class="font-bold text-xs">Undangan Siap Disimpan &amp; Diterbitkan</p>
                                <p class="text-[11px] text-emerald-700">Seluruh data, foto galeri prewedding, dan musik latar akan tersimpan di sistem dan siap dibagikan kepada para tamu.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-sand-200">
                        <button type="button" @click="goToStep(5)" class="px-4 py-2 rounded-xl bg-sand-200 text-charcoal-900 font-bold text-xs hover:bg-sand-300 transition">
                            Kembali
                        </button>
                        <button 
                            type="submit" 
                            @if ($themes->isEmpty()) disabled class="opacity-50 cursor-not-allowed px-6 py-2.5 rounded-xl bg-sand-300 text-charcoal-700 font-bold text-xs" @else class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs shadow-md hover:shadow-brand-500/30 hover:scale-102 transition flex items-center gap-2 cursor-pointer" @endif
                        >
                            <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            <span>Simpan &amp; Rilis Undangan</span>
                        </button>
                    </div>
                </div>

            </div>

        </form>

    </div>
</x-member-layout>
