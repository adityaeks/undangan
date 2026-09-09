<x-partner-layout>
    <div 
        class="space-y-6 max-w-5xl mx-auto" 
        x-data="{ 
            currentStep: {{ $errors->hasAny(['groom_*', 'bride_*']) ? 2 : ($errors->hasAny(['akad_*', 'resepsi_*']) ? 3 : 1) }}, 
            errorMessage: '',
            selectedTheme: {{ $themes->first()->id ?? 'null' }},
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
                this.audioPlayer.onerror = () => { this.isPlayingAudio = false; };
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
                for (let s = 1; s <= 5; s++) {
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
                    this.audioPlayer.onerror = () => { this.isPlayingAudio = false; };
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
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-sand-200">
            <div>
                <a href="{{ route('partner.invitations.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-sand-600 hover:text-charcoal-900 transition mb-1">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali ke Daftar Undangan Klien
                </a>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">Buat Undangan Klien Baru</h1>
                <p class="text-xs text-sand-500">Lengkapi data pernikahan klien, foto galeri prewedding, jadwal acara, dan amplop digital.</p>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="px-3 py-1.5 rounded-2xl bg-brand-500/10 border border-brand-500/30 text-brand-900 font-bold text-xs flex items-center gap-1.5">
                    <i data-lucide="sparkles" class="w-4 h-4 text-brand-600"></i>
                    <span>Portal Partner & WO</span>
                </span>
            </div>
        </div>

        @if($errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                <div class="font-bold mb-1">Terjadi kesalahan input:</div>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- STEPPER TABS -->
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 text-xs">
            <button 
                type="button" 
                @click="goToStep(1)"
                :class="currentStep === 1 ? 'bg-brand-600 text-white font-bold shadow-md' : 'bg-sand-100 hover:bg-sand-200 text-charcoal-800 font-medium'"
                class="px-3 py-2.5 rounded-2xl flex items-center justify-center gap-1.5 transition text-center cursor-pointer"
            >
                <span class="w-5 h-5 rounded-full text-[10px] flex items-center justify-center font-bold" :class="currentStep === 1 ? 'bg-white text-brand-700' : 'bg-sand-200 text-charcoal-950'">1</span>
                <span>Klien & Tema</span>
            </button>

            <button 
                type="button" 
                @click="goToStep(2)"
                :class="currentStep === 2 ? 'bg-brand-600 text-white font-bold shadow-md' : 'bg-sand-100 hover:bg-sand-200 text-charcoal-800 font-medium'"
                class="px-3 py-2.5 rounded-2xl flex items-center justify-center gap-1.5 transition text-center cursor-pointer"
            >
                <span class="w-5 h-5 rounded-full text-[10px] flex items-center justify-center font-bold" :class="currentStep === 2 ? 'bg-white text-brand-700' : 'bg-sand-200 text-charcoal-950'">2</span>
                <span>Mempelai</span>
            </button>

            <button 
                type="button" 
                @click="goToStep(3)"
                :class="currentStep === 3 ? 'bg-brand-600 text-white font-bold shadow-md' : 'bg-sand-100 hover:bg-sand-200 text-charcoal-800 font-medium'"
                class="px-3 py-2.5 rounded-2xl flex items-center justify-center gap-1.5 transition text-center cursor-pointer"
            >
                <span class="w-5 h-5 rounded-full text-[10px] flex items-center justify-center font-bold" :class="currentStep === 3 ? 'bg-white text-brand-700' : 'bg-sand-200 text-charcoal-950'">3</span>
                <span>Acara</span>
            </button>

            <button 
                type="button" 
                @click="goToStep(4)"
                :class="currentStep === 4 ? 'bg-brand-600 text-white font-bold shadow-md' : 'bg-sand-100 hover:bg-sand-200 text-charcoal-800 font-medium'"
                class="px-3 py-2.5 rounded-2xl flex items-center justify-center gap-1.5 transition text-center cursor-pointer"
            >
                <span class="w-5 h-5 rounded-full text-[10px] flex items-center justify-center font-bold" :class="currentStep === 4 ? 'bg-white text-brand-700' : 'bg-sand-200 text-charcoal-950'">4</span>
                <span>Galeri & Cerita</span>
            </button>

            <button 
                type="button" 
                @click="goToStep(5)"
                :class="currentStep === 5 ? 'bg-brand-600 text-white font-bold shadow-md' : 'bg-sand-100 hover:bg-sand-200 text-charcoal-800 font-medium'"
                class="col-span-2 sm:col-span-1 px-3 py-2.5 rounded-2xl flex items-center justify-center gap-1.5 transition text-center cursor-pointer"
            >
                <span class="w-5 h-5 rounded-full text-[10px] flex items-center justify-center font-bold" :class="currentStep === 5 ? 'bg-white text-brand-700' : 'bg-sand-200 text-charcoal-950'">5</span>
                <span>Amplop & Kado</span>
            </button>
        </div>

        <!-- ERROR MESSAGE BANNER -->
        <div x-show="errorMessage" x-cloak x-transition class="p-4 rounded-2xl bg-rose-50 border border-rose-300 text-rose-800 text-xs flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2 font-medium">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 flex-shrink-0"></i>
                <span x-text="errorMessage"></span>
            </div>
            <button type="button" @click="errorMessage = ''" class="text-rose-500 hover:text-rose-700">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- FORM WRAPPER -->
        <form action="{{ route('partner.invitations.store') }}" method="POST" enctype="multipart/form-data" @submit="submitForm($event)" novalidate class="space-y-6">
            @csrf

            <!-- ==================================================== -->
            <!-- STEP 1: PILIH KLIEN, TEMPLATE TEMA, & INFO UTAMA -->
            <!-- ==================================================== -->
            <div x-show="currentStep === 1" data-step="1" class="space-y-6">
                <!-- INFO KLIEN & JUDUL -->
                <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 sm:p-8 bg-white/95 shadow-sm space-y-5">
                    <div class="flex items-center gap-3 pb-3 border-b border-sand-200">
                        <div class="w-8 h-8 rounded-xl bg-brand-500 text-white flex items-center justify-center font-bold text-xs shadow">1.1</div>
                        <div>
                            <h2 class="font-serif text-base sm:text-lg font-bold text-charcoal-950">Data Klien & Judul Undangan</h2>
                            <p class="text-[11px] text-sand-500">Pilih klien yang memesan dan atur judul serta URL undangan</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div class="sm:col-span-2">
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="font-bold text-charcoal-950">Pilih Klien WO (Opsional)</label>
                                <a href="{{ route('partner.clients.index') }}" target="_blank" class="text-[11px] text-brand-700 hover:text-brand-800 font-semibold flex items-center gap-1">
                                    <i data-lucide="user-plus" class="w-3 h-3"></i>
                                    <span>Kelola / Tambah Klien</span>
                                </a>
                            </div>
                            <select name="client_id" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs text-charcoal-950 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition">
                                <option value="">-- Tanpa Klien Khusus (Dikelola Mandiri) --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }} {{ $client->phone ? "({$client->phone})" : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block font-bold text-charcoal-950 mb-1.5">Judul Undangan *</label>
                            <input 
                                type="text" 
                                name="title" 
                                value="{{ old('title') }}" 
                                required 
                                placeholder="Contoh: The Wedding of Ryan & Vanya" 
                                class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs text-charcoal-950 placeholder:text-sand-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                            >
                        </div>

                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1.5">Tanggal Acara Utama</label>
                            <input 
                                type="date" 
                                name="event_date" 
                                value="{{ old('event_date') }}" 
                                class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs text-charcoal-950 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                            >
                        </div>

                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1.5">Custom URL Slug (Opsional)</label>
                            <div class="flex items-center">
                                <span class="px-4 py-3 bg-sand-100 border border-r-0 border-sand-300 rounded-l-2xl text-sand-500 text-xs font-medium">
                                    /invitation/
                                </span>
                                <input 
                                    type="text" 
                                    name="slug" 
                                    value="{{ old('slug') }}" 
                                    placeholder="ryan-vanya" 
                                    class="w-full px-4 py-3 rounded-r-2xl border border-sand-300 bg-white text-xs text-charcoal-950 placeholder:text-sand-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PILIH TEMPLATE TEMA SUPER ADMIN -->
                <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 sm:p-8 bg-white/95 shadow-sm space-y-5">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-sand-200">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-brand-500 text-white flex items-center justify-center font-bold text-xs shadow">1.2</div>
                            <div>
                                <h2 class="font-serif text-base sm:text-lg font-bold text-charcoal-950">Pilih Template Tema Super Admin</h2>
                                <p class="text-[11px] text-sand-500">Template yang disediakan oleh Super Admin (bebas digunakan untuk partner)</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-bold">
                            <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
                            <span>{{ $themes->count() }} Template Siap Pakai</span>
                        </span>
                    </div>

                    @if($themes->isEmpty())
                        <div class="text-center py-12 px-4 rounded-2xl border border-dashed border-sand-300 bg-sand-50/50">
                            <i data-lucide="palette" class="w-10 h-10 text-sand-400 mx-auto mb-3"></i>
                            <h4 class="font-serif text-base font-bold text-charcoal-950">Belum Ada Template yang Diaktifkan</h4>
                            <p class="text-xs text-sand-500 max-w-md mx-auto mt-1">
                                Super Admin belum mengaktifkan template untuk role Partner.
                            </p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                            @foreach($themes as $theme)
                                <label 
                                    class="relative rounded-2xl border-2 transition-all cursor-pointer overflow-hidden flex flex-col group"
                                    :class="selectedTheme == {{ $theme->id }} ? 'border-brand-500 ring-4 ring-brand-500/20 shadow-lg' : 'border-sand-200 hover:border-sand-300 bg-white'"
                                >
                                    <input 
                                        type="radio" 
                                        name="theme_id" 
                                        value="{{ $theme->id }}" 
                                        class="sr-only" 
                                        x-model="selectedTheme"
                                        required
                                    >

                                    <!-- THUMBNAIL -->
                                    <div class="relative aspect-[16/10] bg-charcoal-950 overflow-hidden">
                                        <img 
                                            src="{{ $theme->thumbnail }}" 
                                            alt="{{ $theme->name }}" 
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950/70 via-transparent to-transparent"></div>

                                        <!-- SELECTED BADGE -->
                                        <div 
                                            x-show="selectedTheme == {{ $theme->id }}" 
                                            class="absolute top-2.5 right-2.5 px-2.5 py-1 rounded-full bg-brand-500 text-white text-[10px] font-bold flex items-center gap-1 shadow-md"
                                        >
                                            <i data-lucide="check" class="w-3 h-3"></i>
                                            <span>Dipilih</span>
                                        </div>

                                        <!-- PREVIEW BUTTON -->
                                        <div class="absolute bottom-2.5 inset-x-2.5 flex items-center justify-between">
                                            <span class="px-2 py-0.5 rounded-full bg-white/90 backdrop-blur-md text-[10px] font-bold text-charcoal-900">
                                                {{ ucfirst($theme->category) }}
                                            </span>
                                            <a 
                                                href="{{ route('demo.show', ['slug' => $theme->slug]) }}" 
                                                target="_blank" 
                                                @click.stop 
                                                class="px-2.5 py-1 rounded-full bg-charcoal-950/80 hover:bg-charcoal-950 text-white text-[10px] font-bold flex items-center gap-1 backdrop-blur-md transition shadow"
                                            >
                                                <i data-lucide="eye" class="w-3 h-3"></i>
                                                <span>Lihat Demo</span>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- DETAILS -->
                                    <div class="p-4 flex-1 flex flex-col justify-between space-y-2 bg-white">
                                        <h3 class="font-serif text-sm font-bold text-charcoal-950 group-hover:text-brand-700 transition-colors leading-tight">
                                            {{ $theme->name }}
                                        </h3>
                                        <p class="text-[11px] text-sand-500 line-clamp-2">
                                            {{ $theme->metadata['description'] ?? 'Desain tema responsif dan modern.' }}
                                        </p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex justify-end pt-2">
                        <button type="button" @click="goToStep(2)" class="px-6 py-3 rounded-2xl bg-charcoal-950 text-white text-xs font-bold hover:bg-brand-600 transition flex items-center gap-2 cursor-pointer">
                            <span>Lanjut ke Data Mempelai</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- ==================================================== -->
            <!-- STEP 2: DATA MEMPELAI PRIA & WANITA -->
            <!-- ==================================================== -->
            <div x-show="currentStep === 2" data-step="2" class="space-y-6" style="display: none;">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- MEMPELAI PRIA -->
                    <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 bg-white/95 shadow-sm space-y-4 text-xs">
                        <div class="flex items-center gap-2.5 pb-3 border-b border-sand-200">
                            <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-800 flex items-center justify-center font-bold">♂</div>
                            <h3 class="font-serif text-base font-bold text-charcoal-950">Mempelai Pria (Groom)</h3>
                        </div>

                        <!-- FOTO PRIA -->
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-sand-200 border border-sand-300 overflow-hidden shrink-0 flex items-center justify-center">
                                <template x-if="groomPreview">
                                    <img :src="groomPreview" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!groomPreview">
                                    <i data-lucide="user" class="w-6 h-6 text-sand-400"></i>
                                </template>
                            </div>
                            <div class="flex-1 space-y-1">
                                <label class="font-bold text-charcoal-900 block">Foto Mempelai Pria</label>
                                <input type="file" name="groom_photo_file" accept="image/*" @change="previewFile($event, 'groomPreview')" class="text-[11px] text-sand-600 file:mr-2 file:py-1 file:px-2.5 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-sand-200 file:text-charcoal-900 hover:file:bg-sand-300 cursor-pointer">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Nama Lengkap & Gelar *</label>
                            <input type="text" name="groom_name" value="{{ old('groom_name') }}" placeholder="Contoh: Ryan Pratama, S.T." required class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Nama Panggilan</label>
                                <input type="text" name="groom_nickname" value="{{ old('groom_nickname') }}" placeholder="Ryan" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Urutan Anak</label>
                                <input type="text" name="groom_child_order" value="{{ old('groom_child_order') }}" placeholder="Putra pertama dari" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Nama Ayah</label>
                                <input type="text" name="groom_father" value="{{ old('groom_father') }}" placeholder="Bpk. Hendra Pratama" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Nama Ibu</label>
                                <input type="text" name="groom_mother" value="{{ old('groom_mother') }}" placeholder="Ibu Rina Astuti" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Akun Instagram</label>
                            <input type="text" name="groom_instagram" value="{{ old('groom_instagram') }}" placeholder="@ryanpratama" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                    </div>

                    <!-- MEMPELAI WANITA -->
                    <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 bg-white/95 shadow-sm space-y-4 text-xs">
                        <div class="flex items-center gap-2.5 pb-3 border-b border-sand-200">
                            <div class="w-7 h-7 rounded-lg bg-rose-100 text-rose-800 flex items-center justify-center font-bold">♀</div>
                            <h3 class="font-serif text-base font-bold text-charcoal-950">Mempelai Wanita (Bride)</h3>
                        </div>

                        <!-- FOTO WANITA -->
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-sand-200 border border-sand-300 overflow-hidden shrink-0 flex items-center justify-center">
                                <template x-if="bridePreview">
                                    <img :src="bridePreview" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!bridePreview">
                                    <i data-lucide="user" class="w-6 h-6 text-sand-400"></i>
                                </template>
                            </div>
                            <div class="flex-1 space-y-1">
                                <label class="font-bold text-charcoal-900 block">Foto Mempelai Wanita</label>
                                <input type="file" name="bride_photo_file" accept="image/*" @change="previewFile($event, 'bridePreview')" class="text-[11px] text-sand-600 file:mr-2 file:py-1 file:px-2.5 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-sand-200 file:text-charcoal-900 hover:file:bg-sand-300 cursor-pointer">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Nama Lengkap & Gelar *</label>
                            <input type="text" name="bride_name" value="{{ old('bride_name') }}" placeholder="Contoh: Vanya Alodya, S.Farm." required class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Nama Panggilan</label>
                                <input type="text" name="bride_nickname" value="{{ old('bride_nickname') }}" placeholder="Vanya" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Urutan Anak</label>
                                <input type="text" name="bride_child_order" value="{{ old('bride_child_order') }}" placeholder="Putri kedua dari" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Nama Ayah</label>
                                <input type="text" name="bride_father" value="{{ old('bride_father') }}" placeholder="Bpk. Wahyu Nugraha" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Nama Ibu</label>
                                <input type="text" name="bride_mother" value="{{ old('bride_mother') }}" placeholder="Ibu Maya Sari" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Akun Instagram</label>
                            <input type="text" name="bride_instagram" value="{{ old('bride_instagram') }}" placeholder="@vanyaalodya" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <button type="button" @click="goToStep(1)" class="px-5 py-2.5 rounded-2xl bg-sand-200 text-charcoal-900 font-bold text-xs hover:bg-sand-300 transition cursor-pointer">
                        Kembali
                    </button>
                    <button type="button" @click="goToStep(3)" class="px-6 py-3 rounded-2xl bg-charcoal-950 text-white text-xs font-bold hover:bg-brand-600 transition flex items-center gap-2 cursor-pointer">
                        <span>Lanjut ke Rangkaian Acara</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- ==================================================== -->
            <!-- STEP 3: RANGKAIAN ACARA (AKAD & RESEPSI) -->
            <!-- ==================================================== -->
            <div x-show="currentStep === 3" data-step="3" class="space-y-6" style="display: none;">
                <!-- 1. AKAD NIKAH -->
                <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 bg-white/95 shadow-sm space-y-4 text-xs">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-sand-200">
                        <span class="w-7 h-7 rounded-xl bg-brand-600 text-white text-xs flex items-center justify-center font-bold">1</span>
                        <h3 class="font-serif text-base font-bold text-charcoal-950">Akad Nikah / Pemberkatan</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Tanggal Akad</label>
                            <input type="date" name="akad_date" value="{{ old('akad_date') }}" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Waktu Acara</label>
                            <input type="text" name="akad_time" value="{{ old('akad_time') }}" placeholder="08.00 - 10.00 WIB" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Nama Tempat / Gedung</label>
                            <input type="text" name="akad_venue" value="{{ old('akad_venue') }}" placeholder="Masjid Agung Sunda Kelapa" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Alamat Lengkap</label>
                            <input type="text" name="akad_address" value="{{ old('akad_address') }}" placeholder="Jl. Taman Sunda Kelapa No.16, Menteng, Jakarta Pusat" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Link Google Maps (Opsional)</label>
                            <input type="url" name="akad_maps_link" value="{{ old('akad_maps_link') }}" placeholder="https://maps.google.com/..." class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                    </div>
                </div>

                <!-- 2. RESEPSI PERNIKAHAN -->
                <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 bg-white/95 shadow-sm space-y-4 text-xs">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-sand-200">
                        <span class="w-7 h-7 rounded-xl bg-brand-600 text-white text-xs flex items-center justify-center font-bold">2</span>
                        <h3 class="font-serif text-base font-bold text-charcoal-950">Resepsi Pernikahan / Syukuran</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Tanggal Resepsi</label>
                            <input type="date" name="resepsi_date" value="{{ old('resepsi_date') }}" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Waktu Acara</label>
                            <input type="text" name="resepsi_time" value="{{ old('resepsi_time') }}" placeholder="11.00 - 14.00 WIB" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Nama Tempat / Gedung</label>
                            <input type="text" name="resepsi_venue" value="{{ old('resepsi_venue') }}" placeholder="Grand Ballroom The Ritz-Carlton" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Alamat Lengkap</label>
                            <input type="text" name="resepsi_address" value="{{ old('resepsi_address') }}" placeholder="Mega Kuningan Barat No.1, Jakarta Selatan" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Link Google Maps (Opsional)</label>
                            <input type="url" name="resepsi_maps_link" value="{{ old('resepsi_maps_link') }}" placeholder="https://maps.google.com/..." class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <button type="button" @click="goToStep(2)" class="px-5 py-2.5 rounded-2xl bg-sand-200 text-charcoal-900 font-bold text-xs hover:bg-sand-300 transition cursor-pointer">
                        Kembali
                    </button>
                    <button type="button" @click="goToStep(4)" class="px-6 py-3 rounded-2xl bg-charcoal-950 text-white text-xs font-bold hover:bg-brand-600 transition flex items-center gap-2 cursor-pointer">
                        <span>Lanjut ke Galeri & Cerita</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- ==================================================== -->
            <!-- STEP 4: GALERI PREWEDDING, CERITA CINTA, & MUSIK -->
            <!-- ==================================================== -->
            <div x-show="currentStep === 4" data-step="4" class="space-y-6" style="display: none;">
                
                <!-- 1. GALERI MULTI-UPLOAD FOTO PREWEDDING -->
                <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 bg-white/95 shadow-sm space-y-4 text-xs">
                    <div class="flex items-center justify-between pb-3 border-b border-sand-200">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-brand-100 text-brand-900 flex items-center justify-center font-bold">
                                <i data-lucide="images" class="w-4 h-4 text-brand-700"></i>
                            </div>
                            <div>
                                <h3 class="font-serif text-base font-bold text-charcoal-950">Galeri Album Prewedding (Multi-Upload)</h3>
                                <p class="text-[11px] text-sand-500">Unggah foto-foto prewedding klien sekaligus (bisa pilih banyak gambar)</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full bg-brand-50 text-brand-700 font-bold text-[10px] border border-brand-200">
                            Mendukung Multi-Upload
                        </span>
                    </div>

                    <div class="space-y-2">
                        <label class="font-bold text-charcoal-950 block">Pilih Foto-Foto Prewedding Klien (Opsional)</label>
                        <input 
                            type="file" 
                            name="gallery_files[]" 
                            multiple 
                            accept="image/*"
                            @change="previewMultipleGalleries($event)"
                            class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs text-sand-700 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-charcoal-950 file:text-white hover:file:bg-brand-600 cursor-pointer"
                        >
                        <p class="text-[10px] text-sand-500">Mendukung format JPG, PNG, WEBP. Maksimum 5MB per file foto.</p>
                    </div>

                    <!-- PREVIEW GRID -->
                    <div x-show="galleryPreviews.length > 0" class="pt-2">
                        <span class="text-[10px] font-bold text-sand-600 uppercase tracking-wider block mb-2">Foto Yang Dipilih:</span>
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-2.5">
                            <template x-for="(img, idx) in galleryPreviews" :key="idx">
                                <div class="aspect-square rounded-2xl bg-sand-200 overflow-hidden border border-sand-300 shadow-sm relative group">
                                    <img :src="img" class="w-full h-full object-cover">
                                    <span class="absolute top-1 left-1 px-1.5 py-0.5 rounded bg-charcoal-950/80 text-white text-[8px] font-bold" x-text="idx + 1"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- 2. KISAH CINTA / LOVE STORY -->
                <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 bg-white/95 shadow-sm space-y-4 text-xs">
                    <div class="flex items-center justify-between pb-3 border-b border-sand-200">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-rose-100 text-rose-900 flex items-center justify-center font-bold">
                                <i data-lucide="heart" class="w-4 h-4 text-rose-600"></i>
                            </div>
                            <div>
                                <h3 class="font-serif text-base font-bold text-charcoal-950">Kisah Perjalanan Cinta (Love Story)</h3>
                                <p class="text-[11px] text-sand-500">Babak pertemuan, momen komitmen, hingga lamaran (opsional)</p>
                            </div>
                        </div>

                        <button 
                            type="button" 
                            @click="addStory()"
                            x-show="stories.length < 8"
                            class="px-3 py-1.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-charcoal-950 font-bold text-xs transition shadow-sm flex items-center gap-1.5"
                        >
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                            <span>Tambah Babak</span>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <template x-for="(story, index) in stories" :key="index">
                            <div class="p-4 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-xs text-charcoal-900" x-text="`Babak ${index + 1}: ${story.title || 'Momen Spesial'}`"></span>
                                    <button type="button" @click="removeStory(index)" class="text-rose-600 hover:text-rose-800 text-[11px] font-bold flex items-center gap-1">
                                        <i data-lucide="trash-2" class="w-3 h-3"></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div class="sm:col-span-2">
                                        <label class="block font-bold text-charcoal-950 mb-1">Judul Momen</label>
                                        <input type="text" :name="`stories[${index}][title]`" x-model="story.title" placeholder="Awal Bertemu / Lamaran" class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs">
                                    </div>
                                    <div>
                                        <label class="block font-bold text-charcoal-950 mb-1">Waktu / Tanggal</label>
                                        <input type="text" :name="`stories[${index}][date]`" x-model="story.date" placeholder="Agustus 2021" class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs">
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-bold text-charcoal-950 mb-1">Cerita Singkat Momen</label>
                                    <textarea :name="`stories[${index}][story]`" x-model="story.story" rows="2" placeholder="Ceritakan bagaimana momen indah tersebut terjadi..." class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs"></textarea>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- 3. MUSIK LATAR -->
                <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 bg-white/95 shadow-sm space-y-4 text-xs">
                    <div class="flex items-center justify-between pb-3 border-b border-sand-200">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-brand-100 text-brand-900 flex items-center justify-center font-bold">
                                <i data-lucide="music" class="w-4 h-4 text-brand-700"></i>
                            </div>
                            <div>
                                <h3 class="font-serif text-base font-bold text-charcoal-950">Pilihan Musik Latar (Audio)</h3>
                                <p class="text-[11px] text-sand-500">Pilih lagu romantis yang berputar saat undangan dibuka</p>
                            </div>
                        </div>

                        <button 
                            type="button" 
                            @click="toggleAudioTest()"
                            class="px-3.5 py-1.5 rounded-xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-1.5"
                        >
                            <i data-lucide="volume-2" class="w-3.5 h-3.5"></i>
                            <span x-text="isPlayingAudio ? 'Jeda Audio' : 'Tes Putar Musik'"></span>
                        </button>
                    </div>

                    <div class="space-y-3">
                        <label class="block font-bold text-charcoal-950">Pilihan Preset Lagu Pengantin</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            @foreach($musicPresets as $preset)
                                <label 
                                    class="p-3 rounded-2xl border-2 transition cursor-pointer flex items-center justify-between"
                                    :class="selectedMusic === '{{ $preset['file'] }}' ? 'border-brand-500 bg-brand-50/50' : 'border-sand-200 hover:border-sand-300 bg-white'"
                                >
                                    <div class="flex items-center gap-2.5">
                                        <input 
                                            type="radio" 
                                            name="music_preset" 
                                            value="{{ $preset['file'] }}" 
                                            class="sr-only" 
                                            @change="changeMusicPreset('{{ $preset['file'] }}')"
                                        >
                                        <i data-lucide="disc" class="w-4 h-4 text-brand-600"></i>
                                        <span class="font-semibold text-charcoal-900 text-xs">{{ $preset['title'] }}</span>
                                    </div>
                                    <span x-show="selectedMusic === '{{ $preset['file'] }}'" class="text-brand-600 font-bold text-xs">✓</span>
                                </label>
                            @endforeach
                        </div>

                        <div class="pt-2">
                            <label class="block font-bold text-charcoal-950 mb-1">Atau Unggah Lagu Custom Sendiri (.mp3)</label>
                            <input type="file" name="music_file" accept="audio/*" class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs file:mr-2 file:py-1 file:px-2.5 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-sand-200 file:text-charcoal-900 hover:file:bg-sand-300 cursor-pointer">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <button type="button" @click="goToStep(3)" class="px-5 py-2.5 rounded-2xl bg-sand-200 text-charcoal-900 font-bold text-xs hover:bg-sand-300 transition cursor-pointer">
                        Kembali
                    </button>
                    <button type="button" @click="goToStep(5)" class="px-6 py-3 rounded-2xl bg-charcoal-950 text-white text-xs font-bold hover:bg-brand-600 transition flex items-center gap-2 cursor-pointer">
                        <span>Lanjut ke Amplop & Kado</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- ==================================================== -->
            <!-- STEP 5: AMPLOP DIGITAL, KADO FISIK, & KUTIPAN -->
            <!-- ==================================================== -->
            <div x-show="currentStep === 5" data-step="5" class="space-y-6" style="display: none;">
                <!-- 1. REKENING AMPLOP DIGITAL -->
                <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 bg-white/95 shadow-sm space-y-4 text-xs">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-sand-200">
                        <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-900 flex items-center justify-center font-bold">
                            <i data-lucide="credit-card" class="w-4 h-4 text-emerald-700"></i>
                        </div>
                        <div>
                            <h3 class="font-serif text-base font-bold text-charcoal-950">Rekening Amplop Digital (Wedding Gift)</h3>
                            <p class="text-[11px] text-sand-500">Tamu dapat mengirim tanda kasih langsung ke rekening mempelai</p>
                        </div>
                    </div>

                    <!-- BANK 1 -->
                    <div class="p-4 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-3">
                        <span class="font-bold text-xs text-charcoal-900">Rekening Bank 1</span>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Nama Bank</label>
                                <input type="text" name="bank_1_name" value="{{ old('bank_1_name') }}" placeholder="BCA / Mandiri / BRI" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Nomor Rekening</label>
                                <input type="text" name="bank_1_number" value="{{ old('bank_1_number') }}" placeholder="1234567890" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Atas Nama (Holder)</label>
                                <input type="text" name="bank_1_holder" value="{{ old('bank_1_holder') }}" placeholder="Nama Pemilik Rekening" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                        </div>
                    </div>

                    <!-- BANK 2 -->
                    <div class="p-4 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-3">
                        <span class="font-bold text-xs text-charcoal-900">Rekening Bank 2 (Opsional)</span>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Nama Bank</label>
                                <input type="text" name="bank_2_name" value="{{ old('bank_2_name') }}" placeholder="BNI / BSI / Jenius" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Nomor Rekening</label>
                                <input type="text" name="bank_2_number" value="{{ old('bank_2_number') }}" placeholder="9876543210" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                            <div>
                                <label class="block font-bold text-charcoal-950 mb-1">Atas Nama (Holder)</label>
                                <input type="text" name="bank_2_holder" value="{{ old('bank_2_holder') }}" placeholder="Nama Pemilik Rekening" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                            </div>
                        </div>
                    </div>

                    <!-- ALAMAT PENGIRIMAN KADO FISIK -->
                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Alamat Pengiriman Kado Fisik (Opsional)</label>
                        <textarea name="gift_address" rows="2" placeholder="Jl. Kemang Raya No. 12, Mampang Prapatan, Jakarta Selatan (Penerima: Ryan & Vanya - 0812xxxxxxx)" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500"></textarea>
                    </div>
                </div>

                <!-- 2. KUTIPAN / QUOTE AYAT -->
                <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 bg-white/95 shadow-sm space-y-4 text-xs">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-sand-200">
                        <div class="w-7 h-7 rounded-lg bg-purple-100 text-purple-900 flex items-center justify-center font-bold">
                            <i data-lucide="book-open" class="w-4 h-4 text-purple-700"></i>
                        </div>
                        <div>
                            <h3 class="font-serif text-base font-bold text-charcoal-950">Kutipan Ayat / Doa Pernikahan</h3>
                            <p class="text-[11px] text-sand-500">Kutipan suci atau kalimat mutiara yang ditampilkan di undangan</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Isi Kutipan / Doa</label>
                            <textarea name="quote_text" rows="3" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">{{ old('quote_text', 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.') }}</textarea>
                        </div>

                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Sumber Kutipan</label>
                            <input type="text" name="quote_source" value="{{ old('quote_source', 'QS. Ar-Rum: 21') }}" class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                    </div>
                </div>

                <!-- 3. TEMPLATE PESAN WHATSAPP -->
                <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 bg-white/95 shadow-sm space-y-4 text-xs">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-sand-200">
                        <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-900 flex items-center justify-center font-bold">
                            <i data-lucide="message-circle" class="w-4 h-4 text-emerald-700"></i>
                        </div>
                        <div>
                            <h3 class="font-serif text-base font-bold text-charcoal-950">Template Ucapan WhatsApp (Kirim Undangan)</h3>
                            <p class="text-[11px] text-sand-500">Kustomisasi format teks pesan pengantar yang dikirimkan ke tamu undangan via WhatsApp</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-[11px] font-bold text-charcoal-800">Variabel dinamis:</span>
                            <code class="px-2 py-0.5 rounded-lg bg-sand-100 text-charcoal-900 font-mono text-[11px] border border-sand-200">[nama]</code>
                            <span class="text-[11px] text-sand-500">= Nama Tamu,</span>
                            <code class="px-2 py-0.5 rounded-lg bg-sand-100 text-charcoal-900 font-mono text-[11px] border border-sand-200">[link]</code>
                            <span class="text-[11px] text-sand-500">= URL Tautan Undangan Tamu</span>
                        </div>

                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Format Pesan WhatsApp</label>
                            <textarea 
                                name="whatsapp_template" 
                                rows="8" 
                                placeholder="{{ \App\Models\Invitation::defaultWhatsappTemplate() }}"
                                class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs font-mono leading-relaxed focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                            >{{ old('whatsapp_template', \App\Models\Invitation::defaultWhatsappTemplate()) }}</textarea>
                            <p class="text-[11px] text-sand-500 mt-1">Dapat diedit kembali kapan saja melalui Buku Tamu atau Edit Undangan.</p>
                        </div>
                    </div>
                </div>

                <!-- SUBMIT ACTIONS -->
                <div class="flex items-center justify-between pt-2">
                    <button type="button" @click="goToStep(4)" class="px-5 py-2.5 rounded-2xl bg-sand-200 text-charcoal-900 font-bold text-xs hover:bg-sand-300 transition">
                        Kembali
                    </button>
                    <button 
                        type="submit" 
                        class="px-8 py-3.5 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white text-xs font-bold shadow-xl hover:shadow-brand-500/30 hover:scale-[1.02] transition flex items-center gap-2"
                    >
                        <i data-lucide="sparkles" class="w-4 h-4"></i>
                        <span>Simpan & Terbitkan Undangan Klien</span>
                    </button>
                </div>
            </div>

        </form>

    </div>
</x-partner-layout>
