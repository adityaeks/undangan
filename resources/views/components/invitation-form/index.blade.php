@props([
    'role' => 'member',
    'action' => '',
    'method' => 'POST',
    'invitation' => null,
    'themes' => collect(),
    'clients' => collect(),
    'musicPresets' => [],
    'usedThemeIds' => [],
    'backUrl' => null,
    'title' => null,
    'subtitle' => null,
])

@php
    $isEdit = $invitation !== null;
    $backUrl = $backUrl ?? ($role === 'partner' ? route('partner.invitations.index') : route('member.invitations.index'));
    $title = $title ?? ($isEdit ? 'Edit Data Undangan: ' . $invitation->title : 'Form Pembuatan Undangan Baru');
    $subtitle = $subtitle ?? ($isEdit ? 'Perbarui rincian informasi dan konten website undangan digital.' : 'Lengkapi rincian data pernikahan di bawah untuk menerbitkan website undangan digital Anda.');
    $musicPresets = !empty($musicPresets) ? $musicPresets : config('themes.music_presets', []);

    // Extract helper relations for edit mode
    $groom = $invitation?->couples?->firstWhere('role', 'groom');
    $bride = $invitation?->couples?->firstWhere('role', 'bride');
    $akad = $invitation?->events?->firstWhere('title', 'Akad Nikah') ?? $invitation?->events?->first();
    $resepsi = $invitation?->events?->firstWhere('title', 'Resepsi Pernikahan') ?? $invitation?->events?->skip(1)?->first();
    $bank1 = $invitation?->gifts?->where('gift_type', 'bank_transfer')?->first();
    $bank2 = $invitation?->gifts?->where('gift_type', 'bank_transfer')?->skip(1)?->first();
    $giftAddress = $invitation?->gifts?->where('gift_type', 'physical_gift')?->first()?->recipient_address;

    // Default music preset URL
    $defaultMusic = '';
    if (!empty($musicPresets)) {
        $firstPreset = reset($musicPresets);
        if (is_array($firstPreset)) {
            $defaultMusic = $firstPreset['file'] ?? '';
        } elseif (is_string($firstPreset)) {
            $defaultMusic = $firstPreset;
        }
    }

    // Initial stories collection for Alpine (default 1 moment)
    $initialStories = old('stories', $invitation && $invitation->stories->isNotEmpty() 
        ? $invitation->stories->map(fn($s) => [
            'title' => $s->title,
            'date' => $s->date,
            'story' => $s->story,
            'existing_image' => $s->image_url,
        ])->toArray() 
        : [
            ['title' => '', 'date' => '', 'story' => '', 'existing_image' => null],
        ]);

    $existingGalleries = $invitation 
        ? $invitation->media()->where('media_type', 'photo')->pluck('url')->toArray() 
        : [];

    $existingCovers = $invitation 
        ? ($invitation->media->where('media_type', 'cover')->pluck('url')->filter()->values()->toArray() ?: ($invitation->cover_image ? [$invitation->cover_image] : []))
        : [];

    $existingGroomPhotos = $invitation
        ? ($invitation->media->whereIn('media_type', ['groom', 'groom_photo'])->pluck('url')->filter()->values()->toArray() ?: ($groom?->photo_url ? [$groom->photo_url] : []))
        : [];

    $existingBridePhotos = $invitation
        ? ($invitation->media->whereIn('media_type', ['bride', 'bride_photo'])->pluck('url')->filter()->values()->toArray() ?: ($bride?->photo_url ? [$bride->photo_url] : []))
        : [];
@endphp

<div 
    class="space-y-4 max-w-5xl mx-auto" 
    x-data="{ 
        currentStep: 1, 
        errorMessage: '',
        selectedTheme: '{{ old('theme_id', $invitation?->theme_id ?? ($themes->first()?->id ?? '')) }}',
        themeStoryImageMap: @js($themes->mapWithKeys(fn($t) => [(string)$t->id => (bool)$t->has_story_images])),
        themeSupportsStoryImages() {
            return !!this.themeStoryImageMap[String(this.selectedTheme)];
        },
        selectedMusic: '{{ old('music_preset', $invitation?->background_music ?? $defaultMusic) }}',
        isPlayingAudio: false,
        audioPlayer: null,
        currentAudioSrc: '',
        audioError: '',
        coverItems: @js($existingCovers).map(url => ({
            id: 'cover_' + Math.random().toString(36).substr(2, 9),
            url: url,
            file: null,
            is_existing: true
        })),
        groomPhotoItems: @js($existingGroomPhotos).map(url => ({
            id: 'groom_' + Math.random().toString(36).substr(2, 9),
            url: url,
            file: null,
            is_existing: true
        })),
        bridePhotoItems: @js($existingBridePhotos).map(url => ({
            id: 'bride_' + Math.random().toString(36).substr(2, 9),
            url: url,
            file: null,
            is_existing: true
        })),
        galleryItems: @js($existingGalleries).map(url => ({
            id: 'exist_' + Math.random().toString(36).substr(2, 9),
            url: url,
            file: null,
            is_existing: true
        })),
        stories: @js($initialStories).map(s => ({
            title: s.title || '',
            date: s.date || '',
            story: s.story || '',
            existing_image: s.existing_image || null,
            imagePreview: s.existing_image || null
        })),
        
        async addCoverFiles(files) {
            if (!files || files.length === 0) return;
            const remainingSlots = 5 - this.coverItems.length;
            if (remainingSlots <= 0) {
                this.errorMessage = 'Maksimal foto sampul adalah 5 foto.';
                return;
            }
            const filesToAdd = Array.from(files).slice(0, remainingSlots);
            for (const f of filesToAdd) {
                const webpFile = await this.convertToWebP(f);
                this.coverItems.push({
                    id: 'cover_' + Math.random().toString(36).substr(2, 9),
                    url: URL.createObjectURL(webpFile),
                    file: webpFile,
                    is_existing: false
                });
            }
            this.$nextTick(() => {
                this.syncCoverInput();
                if (window.lucide) window.lucide.createIcons();
            });
        },
        removeCoverItem(index) {
            this.coverItems.splice(index, 1);
            this.$nextTick(() => {
                this.syncCoverInput();
                if (window.lucide) window.lucide.createIcons();
            });
        },
        syncCoverInput() {
            try {
                const dt = new DataTransfer();
                this.coverItems.forEach(item => {
                    if (item.file) {
                        dt.items.add(item.file);
                    }
                });
                if (this.$refs.coverFilesInput) {
                    this.$refs.coverFilesInput.files = dt.files;
                }
            } catch (e) {
                console.warn('Cover DataTransfer sync:', e);
            }
        },

        async addGroomFiles(files) {
            if (!files || files.length === 0) return;
            const remainingSlots = 5 - this.groomPhotoItems.length;
            if (remainingSlots <= 0) {
                this.errorMessage = 'Maksimal foto mempelai pria adalah 5 foto.';
                return;
            }
            const filesToAdd = Array.from(files).slice(0, remainingSlots);
            for (const f of filesToAdd) {
                const webpFile = await this.convertToWebP(f);
                this.groomPhotoItems.push({
                    id: 'groom_' + Math.random().toString(36).substr(2, 9),
                    url: URL.createObjectURL(webpFile),
                    file: webpFile,
                    is_existing: false
                });
            }
            this.$nextTick(() => {
                this.syncGroomInput();
                if (window.lucide) window.lucide.createIcons();
            });
        },
        removeGroomPhotoItem(index) {
            this.groomPhotoItems.splice(index, 1);
            this.$nextTick(() => {
                this.syncGroomInput();
                if (window.lucide) window.lucide.createIcons();
            });
        },
        syncGroomInput() {
            try {
                const dt = new DataTransfer();
                this.groomPhotoItems.forEach(item => {
                    if (item.file) {
                        dt.items.add(item.file);
                    }
                });
                if (this.$refs.groomFilesInput) {
                    this.$refs.groomFilesInput.files = dt.files;
                }
            } catch (e) {
                console.warn('Groom DataTransfer sync:', e);
            }
        },

        async addBrideFiles(files) {
            if (!files || files.length === 0) return;
            const remainingSlots = 5 - this.bridePhotoItems.length;
            if (remainingSlots <= 0) {
                this.errorMessage = 'Maksimal foto mempelai wanita adalah 5 foto.';
                return;
            }
            const filesToAdd = Array.from(files).slice(0, remainingSlots);
            for (const f of filesToAdd) {
                const webpFile = await this.convertToWebP(f);
                this.bridePhotoItems.push({
                    id: 'bride_' + Math.random().toString(36).substr(2, 9),
                    url: URL.createObjectURL(webpFile),
                    file: webpFile,
                    is_existing: false
                });
            }
            this.$nextTick(() => {
                this.syncBrideInput();
                if (window.lucide) window.lucide.createIcons();
            });
        },
        removeBridePhotoItem(index) {
            this.bridePhotoItems.splice(index, 1);
            this.$nextTick(() => {
                this.syncBrideInput();
                if (window.lucide) window.lucide.createIcons();
            });
        },
        syncBrideInput() {
            try {
                const dt = new DataTransfer();
                this.bridePhotoItems.forEach(item => {
                    if (item.file) {
                        dt.items.add(item.file);
                    }
                });
                if (this.$refs.brideFilesInput) {
                    this.$refs.brideFilesInput.files = dt.files;
                }
            } catch (e) {
                console.warn('Bride DataTransfer sync:', e);
            }
        },
        
        async addGalleryFiles(files) {
            if (!files || files.length === 0) return;
            const remainingSlots = 10 - this.galleryItems.length;
            if (remainingSlots <= 0) {
                this.errorMessage = 'Maksimal galeri foto adalah 10 foto.';
                return;
            }
            const filesToAdd = Array.from(files).slice(0, remainingSlots);
            for (const f of filesToAdd) {
                const webpFile = await this.convertToWebP(f);
                this.galleryItems.push({
                    id: 'file_' + Math.random().toString(36).substr(2, 9),
                    url: URL.createObjectURL(webpFile),
                    file: webpFile,
                    is_existing: false
                });
            }
            this.$nextTick(() => {
                this.syncGalleryInput();
                if (window.lucide) window.lucide.createIcons();
            });
        },
        removeGalleryItem(index) {
            this.galleryItems.splice(index, 1);
            this.$nextTick(() => {
                this.syncGalleryInput();
                if (window.lucide) window.lucide.createIcons();
            });
        },
        syncGalleryInput() {
            try {
                const dt = new DataTransfer();
                this.galleryItems.forEach(item => {
                    if (item.file) {
                        dt.items.add(item.file);
                    }
                });
                if (this.$refs.galleryFilesInput) {
                    this.$refs.galleryFilesInput.files = dt.files;
                }
            } catch (e) {
                console.warn('DataTransfer sync:', e);
            }
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
        toggleAudioTest(sourceUrl = null) {
            this.audioError = '';
            const urlToPlay = sourceUrl !== null ? sourceUrl : this.selectedMusic;
            
            if (!urlToPlay || !String(urlToPlay).trim()) {
                this.audioError = 'Pilih lagu latar dari daftar preset atau unggah file audio MP3/WAV terlebih dahulu.';
                return;
            }

            const trimmedUrl = String(urlToPlay).trim();

            if (!this.audioPlayer) {
                this.audioPlayer = new Audio();
                this.audioPlayer.addEventListener('ended', () => {
                    this.isPlayingAudio = false;
                });
                this.audioPlayer.addEventListener('error', () => {
                    this.isPlayingAudio = false;
                    this.audioError = 'Gagal memutar audio yang dipilih. Pastikan format file .mp3 atau .wav valid.';
                });
            }

            if (this.isPlayingAudio && this.currentAudioSrc === trimmedUrl) {
                this.audioPlayer.pause();
                this.isPlayingAudio = false;
                return;
            }

            try {
                this.audioPlayer.pause();
                this.currentAudioSrc = trimmedUrl;
                this.selectedMusic = trimmedUrl;
                this.audioPlayer.src = trimmedUrl;
                this.audioPlayer.load();

                const playPromise = this.audioPlayer.play();
                if (playPromise !== undefined) {
                    playPromise.then(() => {
                        this.isPlayingAudio = true;
                        this.audioError = '';
                    }).catch((err) => {
                        this.isPlayingAudio = false;
                        if (err.name === 'NotAllowedError') {
                            this.audioError = 'Pemutaran audio diblokir oleh browser. Klik tombol Putar kembali.';
                        } else {
                            this.audioError = 'Gagal memutar audio. Pastikan file audio valid.';
                        }
                    });
                }
            } catch (err) {
                this.isPlayingAudio = false;
                this.audioError = 'Gagal memuat audio: ' + (err.message || 'Error file');
            }
        },
        changeMusicPreset(url) {
            this.audioError = '';
            this.selectedMusic = url;
            if (url) {
                this.toggleAudioTest(url);
            } else {
                if (this.audioPlayer) {
                    this.audioPlayer.pause();
                }
                this.isPlayingAudio = false;
                this.currentAudioSrc = '';
            }
        },
        async convertToWebP(file, quality = 0.82, maxWidth = 1920) {
            if (!file || !file.type.startsWith('image/') || file.type === 'image/webp') {
                return file;
            }
            return new Promise((resolve) => {
                const img = new Image();
                img.src = URL.createObjectURL(file);
                img.onload = () => {
                    let w = img.width;
                    let h = img.height;
                    if (w > maxWidth) {
                        h = Math.round((h * maxWidth) / w);
                        w = maxWidth;
                    }
                    const canvas = document.createElement('canvas');
                    canvas.width = w;
                    canvas.height = h;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, w, h);
                    canvas.toBlob((blob) => {
                        if (!blob) {
                            resolve(file);
                            return;
                        }
                        const newName = file.name.replace(/\.[^/.]+$/, '') + '.webp';
                        const convertedFile = new File([blob], newName, { type: 'image/webp' });
                        resolve(convertedFile);
                    }, 'image/webp', quality);
                };
                img.onerror = () => resolve(file);
            });
        }
    }"
>
    <!-- PAGE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-sand-200">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-brand-500/10 text-brand-800 text-[10px] font-bold uppercase tracking-wider border border-brand-500/20 mb-1">
                <i data-lucide="sparkles" class="w-3 h-3 text-brand-600"></i>
                <span>{{ $role === 'partner' ? 'Portal Mitra • Kelola Undangan' : 'Portal Pengantin' }}</span>
            </div>
            <h1 class="font-serif text-xl sm:text-2xl font-bold text-charcoal-950">{{ $title }}</h1>
            <p class="text-xs text-sand-500">{{ $subtitle }}</p>
        </div>

        <a 
            href="{{ $backUrl }}" 
            class="px-3.5 py-1.5 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 text-xs font-bold transition flex items-center gap-1.5 self-start sm:self-auto border border-sand-200"
        >
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- ERROR VALIDATION BANNER -->
    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1 shadow-sm">
            <div class="flex items-center gap-2 font-bold">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600"></i>
                <span>Terdapat kesalahan pengisian data:</span>
            </div>
            <ul class="list-disc list-inside pl-1 space-y-0.5 text-[11px] text-rose-700">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- CLIENT-SIDE ALPINE ERROR TOAST/ALERT -->
    <div 
        x-show="errorMessage" 
        x-transition 
        class="p-3 rounded-xl bg-amber-50 border border-amber-300 text-amber-900 text-xs flex items-center gap-2 shadow-sm"
        style="display: none;"
    >
        <i data-lucide="alert-triangle" class="w-4 h-4 text-amber-600 shrink-0"></i>
        <span x-text="errorMessage" class="font-semibold"></span>
    </div>

    <!-- MAIN UNIFIED FORM CARD -->
    <form 
        action="{{ $action }}" 
        method="POST" 
        enctype="multipart/form-data" 
        @submit="submitForm($event)"
        class="glass-panel rounded-3xl border border-sand-200/80 shadow-sm overflow-hidden"
    >
        @csrf
        @if(strtoupper($method) === 'PUT' || strtoupper($method) === 'PATCH')
            @method($method)
        @endif

        <!-- CARD TOP TITLE HEADER (ABOVE STEP TABS) -->
        <div class="px-4 py-2.5 sm:px-6 sm:py-3 bg-white border-b border-sand-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <!-- STEP 1 HEADER -->
                <div x-show="currentStep === 1">
                    <h3 class="font-serif text-base sm:text-lg font-bold text-charcoal-950">Langkah 1: Pilih Tema Desain & Judul Undangan</h3>
                    <p class="text-[11px] text-sand-500">Pilih tema desain digital untuk website undangan ini.</p>
                </div>
                <!-- STEP 2 HEADER -->
                <div x-show="currentStep === 2" style="display: none;">
                    <h3 class="font-serif text-base sm:text-lg font-bold text-charcoal-950">Langkah 2: Data Mempelai Pria & Wanita</h3>
                    <p class="text-[11px] text-sand-500">Lengkapi identitas kedua calon mempelai beserta data orang tua.</p>
                </div>
                <!-- STEP 3 HEADER -->
                <div x-show="currentStep === 3" style="display: none;">
                    <h3 class="font-serif text-base sm:text-lg font-bold text-charcoal-950">Langkah 3: Rangkaian Acara Pernikahan</h3>
                    <p class="text-[11px] text-sand-500">Waktu, tanggal, serta lokasi untuk prosesi Akad / Pemberkatan dan Resepsi.</p>
                </div>
                <!-- STEP 4 HEADER -->
                <div x-show="currentStep === 4" style="display: none;">
                    <h3 class="font-serif text-base sm:text-lg font-bold text-charcoal-950">Langkah 4: Kisah Perjalanan (Love Story)</h3>
                    <p class="text-[11px] text-sand-500">Bagikan momen-momen berharga dalam perjalanan cinta Anda berdua (Opsional).</p>
                </div>
                <!-- STEP 5 HEADER -->
                <div x-show="currentStep === 5" style="display: none;">
                    <h3 class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">Langkah 5: Galeri Foto, Video & Musik Latar</h3>
                    <p class="text-[11px] text-sand-500">Unggah foto sampul, galeri kenangan, link video dan lagu pengiring website.</p>
                </div>
                <!-- STEP 6 HEADER -->
                <div x-show="currentStep === 6" style="display: none;">
                    <h3 class="font-serif text-base sm:text-lg font-bold text-charcoal-950">Langkah 6: Amplop Digital & Status Publikasi</h3>
                    <p class="text-[11px] text-sand-500">Atur rekening tanda kasih untuk tamu jarak jauh serta status rilis undangan.</p>
                </div>
            </div>

            <!-- DYNAMIC BADGES / ACTION ON TOP RIGHT -->
            <div class="flex items-center gap-2 self-start sm:self-auto">
                <div x-show="currentStep === 1">
                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-bold border border-emerald-200">
                        {{ $themes->count() }} Tema Siap Pakai
                    </span>
                </div>
                <div x-show="currentStep === 2 || currentStep === 3" style="display: none;">
                    <span class="px-2.5 py-0.5 rounded-full bg-brand-50 text-brand-700 text-[11px] font-bold border border-brand-200">
                        Wajib Diisi
                    </span>
                </div>
                <div x-show="currentStep === 4" style="display: none;">
                    <span class="px-2.5 py-0.5 rounded-full bg-sand-100 text-charcoal-800 text-[11px] font-bold border border-sand-200">
                        Kisah Cinta
                    </span>
                </div>
                <div x-show="currentStep === 5" style="display: none;">
                    <span class="px-2.5 py-0.5 rounded-full bg-sand-100 text-charcoal-800 text-[11px] font-bold border border-sand-200">
                        Media & Audio
                    </span>
                </div>
                <div x-show="currentStep === 6" style="display: none;">
                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-bold border border-emerald-200">
                        Langkah Terakhir
                    </span>
                </div>
            </div>
        </div>

        <!-- INTEGRATED STEP NAVIGATION TAB HEADER (SLEEK MINIMAL STEPPER, NO BOX/PILL CONTAINER) -->
        <div class="px-4 py-3 sm:px-6 sm:py-3.5 bg-sand-50/80 border-b border-sand-200/80 overflow-hidden">
            <div class="flex items-center justify-between w-full">
                @php
                    $steps = [
                        1 => ['title' => 'Tema', 'short' => 'Tema'],
                        2 => ['title' => 'Mempelai', 'short' => 'Mempelai'],
                        3 => ['title' => 'Acara', 'short' => 'Acara'],
                        4 => ['title' => 'Kisah Perjalanan', 'short' => 'Kisah'],
                        5 => ['title' => 'Galeri & Musik', 'short' => 'Galeri'],
                        6 => ['title' => 'Amplop & Rilis', 'short' => 'Amplop'],
                    ];
                @endphp

                @foreach($steps as $sNum => $sInfo)
                    <button 
                        type="button" 
                        @click="goToStep({{ $sNum }})"
                        class="flex items-center justify-center gap-1.5 sm:gap-2 group transition-all shrink-0 select-none py-1 focus:outline-none"
                    >
                        <span 
                            :class="currentStep === {{ $sNum }} ? 'bg-charcoal-950 text-white ring-4 ring-charcoal-900/10 shadow-sm' : (currentStep > {{ $sNum }} ? 'bg-brand-600 text-white' : 'bg-sand-200 text-sand-600 group-hover:bg-sand-300')"
                            class="w-5 h-5 sm:w-6 sm:h-6 min-w-[20px] sm:min-w-[24px] rounded-full flex items-center justify-center text-[10px] sm:text-[11px] font-bold transition-all shrink-0"
                        >
                            <template x-if="currentStep > {{ $sNum }}">
                                <span>✓</span>
                            </template>
                            <template x-if="currentStep <= {{ $sNum }}">
                                <span>{{ $sNum }}</span>
                            </template>
                        </span>
                        <span 
                            :class="currentStep === {{ $sNum }} ? 'text-charcoal-950 font-bold' : (currentStep > {{ $sNum }} ? 'text-charcoal-800 font-semibold' : 'text-sand-400 font-medium group-hover:text-charcoal-700')"
                            class="text-xs transition-colors"
                        >
                            <span class="truncate hidden lg:inline">{{ $sInfo['title'] }}</span>
                            <span class="truncate lg:hidden">{{ $sInfo['short'] }}</span>
                        </span>
                    </button>

                    @if($sNum < 6)
                        <div 
                            :class="currentStep > {{ $sNum }} ? 'bg-brand-500' : 'bg-sand-300/80'"
                            class="flex-1 h-0.5 min-w-[6px] max-w-[48px] mx-1 sm:mx-2 transition-colors shrink"
                        ></div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- FORM STEP CONTENTS (COMPACT PADDING NO SPACE-Y BUG) -->
        <div class="p-4 sm:p-5">
            <!-- STEP 1: TEMA -->
            @include('components.invitation-form.step-1-theme', [
                'role' => $role,
                'themes' => $themes,
                'clients' => $clients,
                'invitation' => $invitation,
                'usedThemeIds' => $usedThemeIds,
            ])

            <!-- STEP 2: MEMPELAI -->
            @include('components.invitation-form.step-2-couples', [
                'groom' => $groom,
                'bride' => $bride,
                'invitation' => $invitation,
            ])

            <!-- STEP 3: ACARA -->
            @include('components.invitation-form.step-3-events', [
                'akad' => $akad,
                'resepsi' => $resepsi,
                'invitation' => $invitation,
            ])

            <!-- STEP 4: KISAH PERJALANAN -->
            @include('components.invitation-form.step-4-stories', [
                'invitation' => $invitation,
            ])

            <!-- STEP 5: MEDIA & MUSIK -->
            @include('components.invitation-form.step-5-media', [
                'invitation' => $invitation,
                'musicPresets' => $musicPresets,
            ])

            <!-- STEP 6: AMPLOP & RILIS -->
            @include('components.invitation-form.step-6-gifts', [
                'bank1' => $bank1,
                'bank2' => $bank2,
                'giftAddress' => $giftAddress,
                'invitation' => $invitation,
            ])

            <!-- BOTTOM WIZARD CONTROLLER BUTTONS -->
            <div class="mt-6 pt-4 border-t border-sand-200 flex items-center justify-between gap-3">
                <button 
                    type="button" 
                    x-show="currentStep > 1" 
                    @click="goToStep(currentStep - 1)"
                    class="px-5 py-2.5 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 text-xs font-bold transition flex items-center gap-1.5"
                >
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    <span>Sebelumnya</span>
                </button>
                <div x-show="currentStep === 1"></div>

                <div>
                    <!-- NEXT STEP BUTTON (STEPS 1-5) -->
                    <button 
                        type="button" 
                        x-show="currentStep < 6" 
                        @click="goToStep(currentStep + 1)"
                        class="px-6 py-2.5 rounded-xl bg-charcoal-950 hover:bg-charcoal-800 text-white text-xs font-bold shadow-md hover:shadow transition flex items-center gap-1.5"
                    >
                        <span>Selanjutnya</span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-brand-400"></i>
                    </button>

                    <!-- SUBMIT BUTTON (STEP 6) -->
                    <button 
                        type="submit" 
                        x-show="currentStep === 6"
                        class="px-7 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white text-xs font-bold shadow-lg shadow-brand-500/20 hover:scale-105 transition flex items-center gap-2"
                    >
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        <span>{{ $isEdit ? 'Simpan Perubahan Undangan' : 'Terbitkan Undangan Sekarang' }}</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
