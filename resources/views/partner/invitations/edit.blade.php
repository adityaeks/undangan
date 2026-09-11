<x-partner-layout>
    <div 
        class="space-y-4 max-w-5xl mx-auto" 
        x-data="{ 
            currentStep: 1, 
            errorMessage: '',
            selectedTheme: '{{ old('theme_id', $invitation->theme_id) }}',
            themeStoryImageMap: @js($themes->mapWithKeys(fn($t) => [(string)$t->id => (bool)$t->has_story_images])),
            themeSupportsStoryImages() {
                return !!this.themeStoryImageMap[String(this.selectedTheme)];
            },
            selectedMusic: '{{ old('music_preset', $invitation->background_music ?? '/audio/payung-teduh-akad.mp3') }}',
            isPlayingAudio: false,
            audioPlayer: null,
            coverPreview: '{{ $invitation->cover_image ?? '' }}',
            groomPreview: '{{ $groom?->photo_url ?? '' }}',
            bridePreview: '{{ $bride?->photo_url ?? '' }}',
            galleryPreviews: [],
            stories: @js(old('stories', $invitation->stories->isNotEmpty() ? $invitation->stories->map(fn($s) => [
                'title' => $s->title,
                'date' => $s->date,
                'story' => $s->story,
                'existing_image' => $s->image_url,
            ])->toArray() : [
                ['title' => '', 'date' => '', 'story' => '', 'existing_image' => null],
                ['title' => '', 'date' => '', 'story' => '', 'existing_image' => null],
                ['title' => '', 'date' => '', 'story' => '', 'existing_image' => null],
            ])).map(s => ({
                title: s.title || '',
                date: s.date || '',
                story: s.story || '',
                existing_image: s.existing_image || null,
                imagePreview: s.existing_image || null
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
                    this.errorMessage = 'Silakan pilih template tema desain terlebih dahulu.';
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
                    this.stories.push({ title: '', date: '', story: '', existing_image: null, imagePreview: null });
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                }
            },
            removeStory(index) {
                if (this.stories.length > 1) {
                    this.stories.splice(index, 1);
                } else {
                    this.stories[0] = { title: '', date: '', story: '', existing_image: null, imagePreview: null };
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
                    <span>Portal Partner &amp; WO • Edit Undangan Klien</span>
                </div>
                <h1 class="font-serif text-xl sm:text-2xl font-bold text-charcoal-950">
                    Edit Undangan Klien: {{ $invitation->title }}
                </h1>
                <p class="text-xs text-sand-600">
                    Perbarui rincian pernikahan, foto cover, galeri prewedding, jadwal acara, dan amplop digital.
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-1.5 shadow-sm">
                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                    <span>Lihat Website</span>
                </a>
                <a href="{{ route('partner.invitations.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-sand-200 hover:bg-sand-300 text-charcoal-900 text-xs font-bold transition">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        @if($errors->any())
            <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
                <div class="flex items-center gap-2 font-bold text-rose-900">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600"></i>
                    <span>Terdapat beberapa data yang belum lengkap:</span>
                </div>
                <ul class="list-disc list-inside space-y-0.5 text-[11px] text-rose-700 pl-4">
                    @foreach($errors->all() as $error)
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
                <span class="text-[11px] truncate">Klien &amp; Tema</span>
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

        <!-- ERROR MESSAGE BANNER -->
        <div x-show="errorMessage" x-cloak x-transition class="p-3.5 rounded-2xl bg-rose-50 border border-rose-300 text-rose-800 text-xs flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2 font-medium">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 flex-shrink-0"></i>
                <span x-text="errorMessage"></span>
            </div>
            <button type="button" @click="errorMessage = ''" class="text-rose-500 hover:text-rose-700">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- FORM WRAPPER -->
        <form method="POST" action="{{ route('partner.invitations.update', $invitation) }}" enctype="multipart/form-data" @submit="submitForm($event)" novalidate class="space-y-4">
            @csrf
            @method('PUT')

            <!-- HIDDEN INPUT FOR THEME ID -->
            <input type="hidden" name="theme_id" :value="selectedTheme">

            <!-- MAIN CONTAINER -->
            <div class="p-5 sm:p-6 rounded-2xl glass-panel border border-sand-200 space-y-5">
                
                <!-- ========================================== -->
                <!-- STEP 1: PILIH KLIEN, TEMA & INFO UTAMA -->
                <!-- ========================================== -->
                <div x-show="currentStep === 1" data-step="1" class="space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-sand-200">
                        <div>
                            <h3 class="font-serif text-base font-bold text-charcoal-950">Langkah 1: Klien, Tema Desain &amp; Judul Undangan</h3>
                            <p class="text-[11px] text-sand-600">Pilih klien pemesan dan sesuaikan tema desain super admin yang ingin digunakan.</p>
                        </div>
                        @if($themes->isNotEmpty())
                            <span class="text-[11px] font-bold text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                {{ $themes->count() }} Template Siap Pakai
                            </span>
                        @endif
                    </div>

                    <!-- PILIH KLIEN & JUDUL -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div class="sm:col-span-2">
                            <div class="flex items-center justify-between mb-1">
                                <label class="font-bold text-charcoal-900">Pilih Klien WO (Opsional)</label>
                                <a href="{{ route('partner.clients.index') }}" target="_blank" class="text-[11px] text-brand-700 hover:text-brand-800 font-semibold flex items-center gap-1">
                                    <i data-lucide="user-plus" class="w-3 h-3"></i>
                                    <span>Kelola / Tambah Klien</span>
                                </a>
                            </div>
                            <select name="client_id" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                                <option value="">-- Tanpa Klien Khusus (Dikelola Mandiri) --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $invitation->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }} {{ $client->phone ? "({$client->phone})" : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="font-bold text-charcoal-900 block mb-1">Judul Undangan <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="title" 
                                value="{{ old('title', $invitation->title) }}" 
                                required
                                placeholder="Contoh: The Wedding of Ryan &amp; Vanya"
                                class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                            >
                        </div>

                        <div>
                            <label class="font-bold text-charcoal-900 block mb-1">Tanggal Acara Utama</label>
                            <input 
                                type="date" 
                                name="event_date" 
                                value="{{ old('event_date', $invitation->event_date?->format('Y-m-d')) }}" 
                                class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                            >
                        </div>

                        <div class="sm:col-span-2">
                            <label class="font-bold text-charcoal-900 block mb-1">Kustom Link Slug (Opsional)</label>
                            <div class="flex items-center">
                                <span class="px-3 py-2 rounded-l-xl bg-sand-200 text-sand-600 font-mono text-[11px] border border-r-0 border-sand-200">/invitation/</span>
                                <input 
                                    type="text" 
                                    name="slug" 
                                    value="{{ old('slug', $invitation->slug) }}" 
                                    placeholder="ryan-vanya"
                                    class="w-full px-3 py-2 rounded-r-xl border border-sand-200 bg-white text-xs focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- PILIH TEMPLATE TEMA -->
                    <div class="pt-4 border-t border-sand-200 space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="font-bold text-charcoal-900 text-xs block">Pilih Template Tema Super Admin <span class="text-rose-500">*</span></label>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($themes as $theme)
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
                                        <div class="absolute bottom-2 right-2">
                                            <a 
                                                href="{{ route('demo.show', ['slug' => $theme->slug]) }}" 
                                                target="_blank" 
                                                @click.stop 
                                                class="px-2 py-0.5 rounded-full bg-charcoal-950/80 hover:bg-charcoal-950 text-white text-[9px] font-bold flex items-center gap-1 backdrop-blur-md transition shadow"
                                            >
                                                <i data-lucide="eye" class="w-2.5 h-2.5"></i>
                                                <span>Demo</span>
                                            </a>
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
                    </div>

                    <div class="flex justify-end pt-3 border-t border-sand-200">
                        <button type="button" @click="goToStep(2)" class="px-5 py-2.5 rounded-xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-1.5 cursor-pointer">
                            <span>Lanjut ke Data Mempelai</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- STEP 2: DATA KEDUA MEMPELAI -->
                <!-- ========================================== -->
                <div x-show="currentStep === 2" data-step="2" class="space-y-4" style="display: none;">
                    <div class="pb-2 border-b border-sand-200">
                        <h3 class="font-serif text-base font-bold text-charcoal-950">Langkah 2: Data Kedua Mempelai</h3>
                        <p class="text-[11px] text-sand-600">Isi rincian lengkap mengenai calon pengantin pria dan wanita.</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        
                        <!-- 1. MEMPELAI PRIA -->
                        <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-3 text-xs">
                            <div class="flex items-center gap-2 pb-2 border-b border-sand-200">
                                <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-[10px]">♂</span>
                                <h4 class="font-serif text-sm font-bold text-charcoal-950">Mempelai Pria (Groom)</h4>
                            </div>

                            <!-- UPLOAD FOTO PRIA -->
                            <div class="flex items-center gap-3">
                                <div class="w-16 h-16 rounded-xl bg-sand-200 border border-sand-300 overflow-hidden relative flex-shrink-0 flex items-center justify-center">
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

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Lengkap &amp; Gelar <span class="text-rose-500">*</span></label>
                                <input type="text" name="groom_name" value="{{ old('groom_name', $groom?->full_name) }}" required placeholder="Contoh: Ryan Pratama, S.Kom" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div class="grid grid-cols-2 gap-2.5">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Panggilan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="groom_nickname" value="{{ old('groom_nickname', $groom?->nickname) }}" required placeholder="Contoh: Ryan" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Urutan Anak</label>
                                    <input type="text" name="groom_child_order" value="{{ old('groom_child_order', $groom?->child_number) }}" placeholder="Contoh: Putra pertama" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ayah</label>
                                <input type="text" name="groom_father" value="{{ old('groom_father', $groom?->father_name) }}" placeholder="Nama Lengkap Ayah" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ibu</label>
                                <input type="text" name="groom_mother" value="{{ old('groom_mother', $groom?->mother_name) }}" placeholder="Nama Lengkap Ibu" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Akun Instagram (Opsional)</label>
                                <div class="flex items-center">
                                    <span class="px-2.5 py-2 rounded-l-xl bg-sand-200 text-sand-600 font-mono text-[11px] border border-r-0 border-sand-200">@</span>
                                    <input type="text" name="groom_instagram" value="{{ old('groom_instagram', $groom?->instagram) }}" placeholder="username_ig" class="w-full px-3 py-2 rounded-r-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>
                        </div>

                        <!-- 2. MEMPELAI WANITA -->
                        <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-3 text-xs">
                            <div class="flex items-center gap-2 pb-2 border-b border-sand-200">
                                <span class="w-6 h-6 rounded-full bg-rose-100 text-rose-700 font-bold flex items-center justify-center text-[10px]">♀</span>
                                <h4 class="font-serif text-sm font-bold text-charcoal-950">Mempelai Wanita (Bride)</h4>
                            </div>

                            <!-- UPLOAD FOTO WANITA -->
                            <div class="flex items-center gap-3">
                                <div class="w-16 h-16 rounded-xl bg-sand-200 border border-sand-300 overflow-hidden relative flex-shrink-0 flex items-center justify-center">
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

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Lengkap &amp; Gelar <span class="text-rose-500">*</span></label>
                                <input type="text" name="bride_name" value="{{ old('bride_name', $bride?->full_name) }}" required placeholder="Contoh: Vanya Maharani, S.Ked" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div class="grid grid-cols-2 gap-2.5">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Panggilan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="bride_nickname" value="{{ old('bride_nickname', $bride?->nickname) }}" required placeholder="Contoh: Vanya" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Urutan Anak</label>
                                    <input type="text" name="bride_child_order" value="{{ old('bride_child_order', $bride?->child_number) }}" placeholder="Contoh: Putri kedua" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ayah</label>
                                <input type="text" name="bride_father" value="{{ old('bride_father', $bride?->father_name) }}" placeholder="Nama Lengkap Ayah" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ibu</label>
                                <input type="text" name="bride_mother" value="{{ old('bride_mother', $bride?->mother_name) }}" placeholder="Nama Lengkap Ibu" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Akun Instagram (Opsional)</label>
                                <div class="flex items-center">
                                    <span class="px-2.5 py-2 rounded-l-xl bg-sand-200 text-sand-600 font-mono text-[11px] border border-r-0 border-sand-200">@</span>
                                    <input type="text" name="bride_instagram" value="{{ old('bride_instagram', $bride?->instagram) }}" placeholder="username_ig" class="w-full px-3 py-2 rounded-r-xl border border-sand-200 bg-white text-xs">
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
                        <p class="text-[11px] text-sand-600">Atur tanggal, waktu, dan lokasi prosesi pernikahan klien.</p>
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
                                    <input type="date" name="akad_date" value="{{ old('akad_date', $akad?->date?->format('Y-m-d')) }}" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Waktu Acara <span class="text-rose-500">*</span></label>
                                    <input type="text" name="akad_time" value="{{ old('akad_time', $akad?->start_time) }}" placeholder="Contoh: 08.00 - 10.00 WIB" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Tempat / Gedung <span class="text-rose-500">*</span></label>
                                    <input type="text" name="akad_venue" value="{{ old('akad_venue', $akad?->venue_name) }}" placeholder="Nama Masjid / Gedung / Rumah" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Alamat Lengkap <span class="text-rose-500">*</span></label>
                                    <input type="text" name="akad_address" value="{{ old('akad_address', $akad?->address) }}" placeholder="Alamat lengkap lokasi prosesi akad" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Link Google Maps (Opsional)</label>
                                    <input type="url" name="akad_maps_link" value="{{ old('akad_maps_link', $akad?->maps_url) }}" placeholder="https://maps.app.goo.gl/..." class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
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
                                    <input type="date" name="resepsi_date" value="{{ old('resepsi_date', $resepsi?->date?->format('Y-m-d')) }}" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Waktu Acara <span class="text-rose-500">*</span></label>
                                    <input type="text" name="resepsi_time" value="{{ old('resepsi_time', $resepsi?->start_time) }}" placeholder="Contoh: 11.00 - 14.00 WIB" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Tempat / Gedung <span class="text-rose-500">*</span></label>
                                    <input type="text" name="resepsi_venue" value="{{ old('resepsi_venue', $resepsi?->venue_name) }}" placeholder="Nama Ballroom / Hotel / Tempat" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Alamat Lengkap <span class="text-rose-500">*</span></label>
                                    <input type="text" name="resepsi_address" value="{{ old('resepsi_address', $resepsi?->address) }}" placeholder="Alamat lengkap lokasi acara resepsi" required class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Link Google Maps (Opsional)</label>
                                    <input type="url" name="resepsi_maps_link" value="{{ old('resepsi_maps_link', $resepsi?->maps_url) }}" placeholder="https://maps.app.goo.gl/..." class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
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
                            <p class="text-[11px] text-sand-600">Bagikan momen-momen manis perjalanan cinta klien dari awal bertemu hingga ke pelaminan (opsional).</p>
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
                <!-- STEP 5: GALERI FOTO COVER & MUSIK -->
                <!-- ========================================== -->
                <div x-show="currentStep === 5" data-step="5" class="space-y-4" style="display: none;">
                    <div class="pb-2 border-b border-sand-200">
                        <h3 class="font-serif text-base font-bold text-charcoal-950">Langkah 5: Galeri Foto Prewedding &amp; Musik Latar</h3>
                        <p class="text-[11px] text-sand-600">Unggah foto cover utama, album galeri prewedding, dan tentukan lagu pengiring undangan klien.</p>
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
                                    <label class="font-bold text-charcoal-900 block mb-1">Unggah Berkas Foto Cover Baru (Opsional)</label>
                                    <input 
                                        type="file" 
                                        name="cover_image_file" 
                                        accept="image/*"
                                        @change="previewFile($event, 'coverPreview')"
                                        class="w-full text-xs text-sand-600 file:mr-2.5 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-charcoal-950 file:text-white hover:file:bg-brand-600 cursor-pointer"
                                    >
                                </div>
                                <span class="text-[9px] text-sand-500 block">Rekomendasi rasio potret atau lanskap resolusi tinggi (JPG, PNG, WEBP, maks 5MB). Foto ini akan digunakan sebagai foto sampul utama undangan.</span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. GALERI PREWEDDING EXISTING & TAMBAH FOTO -->
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

                        <!-- EXISTING GALLERIES -->
                        @if($invitation->media->where('media_type', 'photo')->isNotEmpty())
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1.5">Foto Galeri yang Tersimpan Saat Ini:</label>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                    @foreach($invitation->media->where('media_type', 'photo') as $photo)
                                        <div class="aspect-square rounded-xl bg-sand-200 overflow-hidden border border-sand-300 relative group">
                                            <img src="{{ $photo->url }}" class="w-full h-full object-cover">
                                            <label class="absolute bottom-1 right-1 px-1.5 py-0.5 rounded bg-rose-600 text-white text-[9px] font-bold flex items-center gap-1 cursor-pointer">
                                                <input type="checkbox" name="delete_media_ids[]" value="{{ $photo->id }}" class="rounded text-rose-600 focus:ring-0 w-3 h-3">
                                                <span>Hapus</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="space-y-2 pt-2 border-t border-sand-200">
                            <label class="font-bold text-charcoal-900 block">Tambah Foto Prewedding Baru (Opsional)</label>
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

                        <!-- LIVE MULTI-PREVIEWS UNTUK FOTO BARU -->
                        <div x-show="galleryPreviews.length > 0" class="pt-2">
                            <span class="text-[9px] font-bold uppercase tracking-wider text-sand-500 block mb-1.5">Foto Baru Yang Dipilih:</span>
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
                <!-- STEP 6: AMPLOP DIGITAL & RILIS -->
                <!-- ========================================== -->
                <div x-show="currentStep === 6" data-step="6" class="space-y-4" style="display: none;">
                    <div class="pb-2 border-b border-sand-200">
                        <h3 class="font-serif text-base font-bold text-charcoal-950">Langkah 6: Amplop Digital, Kutipan &amp; Publikasi</h3>
                        <p class="text-[11px] text-sand-600">Atur rekening transfer amplop, alamat kado fisik, kutipan ayat, dan status undangan klien.</p>
                    </div>

                    <!-- REKENING BANK -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <!-- BANK 1 -->
                        <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-2.5 text-xs">
                            <h4 class="font-serif text-xs font-bold text-charcoal-950">Rekening Bank 1 (Utama)</h4>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Bank</label>
                                <input type="text" name="bank_1_name" value="{{ old('bank_1_name', $bank1?->bank_name) }}" placeholder="BCA / Mandiri / BRI / BSI" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nomor Rekening</label>
                                <input type="text" name="bank_1_number" value="{{ old('bank_1_number', $bank1?->account_number) }}" placeholder="Nomor rekening" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Atas Nama Rekening</label>
                                <input type="text" name="bank_1_holder" value="{{ old('bank_1_holder', $bank1?->account_name) }}" placeholder="Nama pemilik rekening" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                        </div>

                        <!-- BANK 2 -->
                        <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-2.5 text-xs">
                            <h4 class="font-serif text-xs font-bold text-charcoal-950">Rekening Bank 2 (Opsional)</h4>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Bank</label>
                                <input type="text" name="bank_2_name" value="{{ old('bank_2_name', $bank2?->bank_name) }}" placeholder="BCA / Mandiri / BRI / BSI" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nomor Rekening</label>
                                <input type="text" name="bank_2_number" value="{{ old('bank_2_number', $bank2?->account_number) }}" placeholder="Nomor rekening" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Atas Nama Rekening</label>
                                <input type="text" name="bank_2_holder" value="{{ old('bank_2_holder', $bank2?->account_name) }}" placeholder="Nama pemilik rekening" class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs">
                            </div>
                        </div>

                    </div>

                    <!-- ALAMAT KADO FISIK -->
                    <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-2 text-xs">
                        <label class="font-bold text-charcoal-900 block">Alamat Pengiriman Kado Fisik (Opsional)</label>
                        <textarea 
                            name="gift_address" 
                            rows="2" 
                            placeholder="Alamat lengkap penerima kado fisik (misal: Jl. Mawar No. 12, RT 01/RW 02, Kel. Sukamaju, Kec. Cilodong, Depok - 16413)" 
                            class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs"
                        >{{ old('gift_address', $giftAddress) }}</textarea>
                    </div>

                    <!-- KUTIPAN AYAT / DOA / KATA MUTIARA (QUOTES) -->
                    <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-3 text-xs" x-data="{
                        quoteText: @js(old('quote_text', $invitation->quote_text ?? 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.')),
                        quoteSource: @js(old('quote_source', $invitation->quote_source ?? 'QS. Ar-Rum: 21')),
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

                        <!-- QUICK PRESET PILLS -->
                        <div class="flex flex-wrap gap-1.5">
                            <template x-for="(p, idx) in presets" :key="idx">
                                <button 
                                    type="button" 
                                    @click="setPreset(p)"
                                    class="px-2.5 py-1 rounded-lg border text-[11px] font-medium transition cursor-pointer"
                                    :class="quoteSource === p.source ? 'bg-brand-500 text-white border-brand-500 shadow-sm' : 'bg-white text-sand-700 border-sand-300 hover:bg-sand-50'"
                                    x-text="p.label"
                                >
                                </button>
                            </template>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-2.5">
                            <div class="sm:col-span-3">
                                <label class="font-bold text-charcoal-900 block mb-1">Isi Kutipan / Terjemahan Ayat</label>
                                <textarea 
                                    name="quote_text" 
                                    x-model="quoteText"
                                    rows="2" 
                                    placeholder="Tulis kutipan ayat, doa, atau kata mutiara..."
                                    class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs font-normal"
                                ></textarea>
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Sumber Kutipan</label>
                                <input 
                                    type="text" 
                                    name="quote_source" 
                                    x-model="quoteSource"
                                    placeholder="QS. Ar-Rum: 21" 
                                    class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs font-normal"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- TEMPLATE PESAN WHATSAPP -->
                    <div class="p-4 rounded-xl bg-sand-50/80 border border-sand-200 space-y-2 text-xs">
                        <label class="font-bold text-charcoal-900 block">Template Pesan WhatsApp (Opsional)</label>
                        <textarea 
                            name="whatsapp_template" 
                            rows="3" 
                            placeholder="Halo {nama_tamu}, kami mengundang Anda untuk hadir di pernikahan kami: {link_undangan}" 
                            class="w-full px-3 py-2 rounded-xl border border-sand-200 bg-white text-xs font-mono text-[11px]"
                        >{{ old('whatsapp_template', $invitation->setting?->metadata['whatsapp_template'] ?? '') }}</textarea>
                        <p class="text-[9px] text-sand-500">Gunakan tag <code>{nama_tamu}</code> dan <code>{link_undangan}</code> untuk personalisasi pesan otomatis ke buku tamu.</p>
                    </div>

                    <!-- SUBMIT BUTTONS -->
                    <div class="flex items-center justify-between pt-4 border-t border-sand-200">
                        <button type="button" @click="goToStep(5)" class="px-4 py-2 rounded-xl bg-sand-200 text-charcoal-900 font-bold text-xs hover:bg-sand-300 transition cursor-pointer">
                            Kembali
                        </button>
                        <button 
                            type="submit" 
                            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-500 hover:to-brand-600 text-white font-bold text-xs shadow-md transition flex items-center gap-2 cursor-pointer"
                        >
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Simpan Perubahan Undangan</span>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</x-partner-layout>
