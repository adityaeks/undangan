<x-app-layout>
    <div 
        class="space-y-8 max-w-5xl mx-auto" 
        x-data="{ 
            currentStep: 1, 
            selectedTheme: '{{ old('theme_id', $themes->first()->id ?? 1) }}',
            selectedMusic: '{{ old('music_preset', '/audio/wedding-song.mp3') }}',
            isPlayingAudio: false,
            audioPlayer: null,
            coverPreview: null,
            groomPreview: null,
            bridePreview: null,
            galleryPreviews: [],
            
            init() {
                this.audioPlayer = new Audio(this.selectedMusic);
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
            }
        }"
    >
        
        <!-- HEADER -->
        <div class="flex items-center justify-between">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">
                    <span>Pembuatan Undangan</span>
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                    Form Pembuatan Undangan Baru
                </h1>
                <p class="text-xs text-sand-600">
                    Lengkapi langkah-langkah di bawah untuk merilis website undangan digital eksklusif Anda.
                </p>
            </div>

            <a href="{{ route('invitations.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-2xl bg-sand-200 hover:bg-sand-300 text-charcoal-900 text-xs font-bold transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Kembali</span>
            </a>
        </div>

        <!-- ERROR VALIDATION ALERT -->
        @if ($errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
                <div class="flex items-center gap-2 font-bold text-rose-900">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600"></i>
                    <span>Terdapat beberapa data yang belum lengkap:</span>
                </div>
                <ul class="list-disc list-inside space-y-0.5 text-[11px] text-rose-700 pl-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 5-STEP WIZARD NAVIGATION BAR -->
        <div class="p-3.5 rounded-3xl glass-panel border border-sand-200 grid grid-cols-5 gap-2 text-center text-xs font-bold">
            <button 
                type="button" 
                @click="currentStep = 1"
                :class="currentStep === 1 ? 'bg-charcoal-950 text-white shadow-md' : 'text-sand-600 hover:bg-sand-200'"
                class="py-3 px-2 rounded-2xl transition flex items-center justify-center gap-2"
            >
                <span class="w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center">1</span>
                <span class="hidden sm:inline">Tema &amp; Judul</span>
            </button>

            <button 
                type="button" 
                @click="currentStep = 2"
                :class="currentStep === 2 ? 'bg-charcoal-950 text-white shadow-md' : 'text-sand-600 hover:bg-sand-200'"
                class="py-3 px-2 rounded-2xl transition flex items-center justify-center gap-2"
            >
                <span class="w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center">2</span>
                <span class="hidden sm:inline">Mempelai</span>
            </button>

            <button 
                type="button" 
                @click="currentStep = 3"
                :class="currentStep === 3 ? 'bg-charcoal-950 text-white shadow-md' : 'text-sand-600 hover:bg-sand-200'"
                class="py-3 px-2 rounded-2xl transition flex items-center justify-center gap-2"
            >
                <span class="w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center">3</span>
                <span class="hidden sm:inline">Acara</span>
            </button>

            <button 
                type="button" 
                @click="currentStep = 4"
                :class="currentStep === 4 ? 'bg-charcoal-950 text-white shadow-md' : 'text-sand-600 hover:bg-sand-200'"
                class="py-3 px-2 rounded-2xl transition flex items-center justify-center gap-2"
            >
                <span class="w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center">4</span>
                <span class="hidden sm:inline">Galeri &amp; Musik</span>
            </button>

            <button 
                type="button" 
                @click="currentStep = 5"
                :class="currentStep === 5 ? 'bg-charcoal-950 text-white shadow-md' : 'text-sand-600 hover:bg-sand-200'"
                class="py-3 px-2 rounded-2xl transition flex items-center justify-center gap-2"
            >
                <span class="w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center">5</span>
                <span class="hidden sm:inline">Amplop &amp; Rilis</span>
            </button>
        </div>

        <!-- FORM WRAPPER WITH MULTIPART SUPPORT -->
        <form method="POST" action="{{ route('invitations.store') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- HIDDEN INPUT FOR THEME ID -->
            <input type="hidden" name="theme_id" :value="selectedTheme">

            <!-- MAIN CONTAINER -->
            <div class="p-6 sm:p-10 rounded-3xl glass-panel border border-sand-200 space-y-8">
                
                <!-- ========================================== -->
                <!-- STEP 1: PILIH TEMA DESAIN -->
                <!-- ========================================== -->
                <div x-show="currentStep === 1" class="space-y-6">
                    <div class="space-y-1">
                        <h3 class="font-serif text-xl font-bold text-charcoal-950">Langkah 1: Pilih Tema Desain &amp; Judul Undangan</h3>
                        <p class="text-xs text-sand-600">Pilih salah satu template visual yang sesuai dengan konsep pernikahan Anda.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($themes as $theme)
                            <div 
                                @click="selectedTheme = '{{ $theme->id }}'"
                                :class="selectedTheme == '{{ $theme->id }}' ? 'ring-2 ring-brand-500 shadow-xl border-brand-500' : 'border-sand-200 opacity-80 hover:opacity-100'"
                                class="group rounded-3xl overflow-hidden glass-panel border cursor-pointer transition-all duration-300 flex flex-col justify-between"
                            >
                                <div class="relative aspect-[4/3] overflow-hidden bg-sand-200">
                                    <img src="{{ $theme->thumbnail }}" alt="{{ $theme->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute top-3 left-3">
                                        <span class="px-2.5 py-0.5 rounded-full bg-charcoal-950/80 backdrop-blur-md text-brand-200 text-[10px] font-bold uppercase">
                                            {{ $theme->category }}
                                        </span>
                                    </div>
                                    <div class="absolute top-3 right-3" x-show="selectedTheme == '{{ $theme->id }}'">
                                        <div class="w-6 h-6 rounded-full bg-brand-500 text-white flex items-center justify-center shadow">
                                            <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-5 space-y-1">
                                    <h4 class="font-serif text-base font-bold text-charcoal-950">{{ $theme->name }}</h4>
                                    <span class="text-xs text-emerald-600 font-semibold block">Rp 49.000 (Sekali Bayar)</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- TITLE & SLUG -->
                    <div class="pt-6 border-t border-sand-200 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div>
                            <label class="font-bold text-charcoal-900 block mb-1">Judul Undangan <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="title" 
                                value="{{ old('title', 'Pernikahan Raka & Arinda') }}" 
                                required
                                placeholder="Contoh: Pernikahan Raka & Arinda"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white focus:ring-2 focus:ring-brand-500"
                            >
                        </div>
                        <div>
                            <label class="font-bold text-charcoal-900 block mb-1">Kustom Link Slug (Opsional)</label>
                            <div class="flex items-center">
                                <span class="px-3 py-2.5 rounded-l-xl bg-sand-200 text-sand-600 font-mono text-[11px] border border-r-0 border-sand-200">kalaundangan.id/u/</span>
                                <input 
                                    type="text" 
                                    name="slug" 
                                    value="{{ old('slug', 'raka-arinda') }}" 
                                    placeholder="raka-arinda"
                                    class="w-full px-3.5 py-2.5 rounded-r-xl border border-sand-200 bg-white focus:ring-2 focus:ring-brand-500"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="button" @click="currentStep = 2" class="px-6 py-3 rounded-2xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-2">
                            <span>Lanjut ke Data Mempelai</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- STEP 2: DATA MEMPELAI -->
                <!-- ========================================== -->
                <div x-show="currentStep === 2" class="space-y-6" style="display: none;">
                    <div class="space-y-1">
                        <h3 class="font-serif text-xl font-bold text-charcoal-950">Langkah 2: Informasi &amp; Foto Kedua Mempelai</h3>
                        <p class="text-xs text-sand-600">Lengkapi data pribadi serta unggah foto profil mempelai pria dan wanita.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- DATA MEMPELAI PRIA -->
                        <div class="p-6 rounded-2xl bg-sand-50/80 border border-sand-200 space-y-4 text-xs">
                            <div class="flex items-center justify-between pb-2 border-b border-sand-200">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-full bg-brand-500 text-white flex items-center justify-center font-bold text-[10px]">1</span>
                                    <h4 class="font-serif text-base font-bold text-charcoal-950">Mempelai Pria (Groom)</h4>
                                </div>
                            </div>

                            <!-- FOTO MEMPELAI PRIA -->
                            <div class="p-4 rounded-xl bg-white border border-sand-200 space-y-2">
                                <label class="font-bold text-charcoal-900 block">Foto Profil Pria</label>
                                <div class="flex items-center gap-3">
                                    <div class="w-16 h-16 rounded-2xl bg-sand-100 overflow-hidden border border-sand-200 flex-shrink-0 flex items-center justify-center">
                                        <template x-if="groomPreview">
                                            <img :src="groomPreview" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!groomPreview">
                                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80" class="w-full h-full object-cover">
                                        </template>
                                    </div>
                                    <div class="flex-1 space-y-1">
                                        <input 
                                            type="file" 
                                            name="groom_photo_file" 
                                            accept="image/*"
                                            @change="previewFile($event, 'groomPreview')"
                                            class="w-full text-xs text-sand-600 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-sand-200 file:text-charcoal-950 hover:file:bg-sand-300"
                                        >
                                        <span class="text-[10px] text-sand-500 block">Format: JPG, PNG, WEBP (Maks. 5MB)</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Lengkap &amp; Gelar <span class="text-rose-500">*</span></label>
                                <input type="text" name="groom_name" value="{{ old('groom_name', 'Raka Pratama, S.T.') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Panggilan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="groom_nickname" value="{{ old('groom_nickname', 'Raka') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Urutan Anak</label>
                                    <input type="text" name="groom_child_order" value="{{ old('groom_child_order', 'Putra pertama') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ayah</label>
                                <input type="text" name="groom_father" value="{{ old('groom_father', 'Bpk. Dr. H. Bambang Soediro') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ibu</label>
                                <input type="text" name="groom_mother" value="{{ old('groom_mother', 'Ibu Hj. Ratna Juwita') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Akun Instagram</label>
                                <div class="flex items-center">
                                    <span class="px-3 py-2.5 rounded-l-xl bg-sand-200 text-sand-600 font-mono text-[11px] border border-r-0 border-sand-200">@</span>
                                    <input type="text" name="groom_instagram" value="{{ old('groom_instagram', 'rakapratama') }}" class="w-full px-3.5 py-2.5 rounded-r-xl border border-sand-200 bg-white">
                                </div>
                            </div>
                        </div>

                        <!-- DATA MEMPELAI WANITA -->
                        <div class="p-6 rounded-2xl bg-sand-50/80 border border-sand-200 space-y-4 text-xs">
                            <div class="flex items-center justify-between pb-2 border-b border-sand-200">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-full bg-rose-500 text-white flex items-center justify-center font-bold text-[10px]">2</span>
                                    <h4 class="font-serif text-base font-bold text-charcoal-950">Mempelai Wanita (Bride)</h4>
                                </div>
                            </div>

                            <!-- FOTO MEMPELAI WANITA -->
                            <div class="p-4 rounded-xl bg-white border border-sand-200 space-y-2">
                                <label class="font-bold text-charcoal-900 block">Foto Profil Wanita</label>
                                <div class="flex items-center gap-3">
                                    <div class="w-16 h-16 rounded-2xl bg-sand-100 overflow-hidden border border-sand-200 flex-shrink-0 flex items-center justify-center">
                                        <template x-if="bridePreview">
                                            <img :src="bridePreview" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!bridePreview">
                                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80" class="w-full h-full object-cover">
                                        </template>
                                    </div>
                                    <div class="flex-1 space-y-1">
                                        <input 
                                            type="file" 
                                            name="bride_photo_file" 
                                            accept="image/*"
                                            @change="previewFile($event, 'bridePreview')"
                                            class="w-full text-xs text-sand-600 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-sand-200 file:text-charcoal-950 hover:file:bg-sand-300"
                                        >
                                        <span class="text-[10px] text-sand-500 block">Format: JPG, PNG, WEBP (Maks. 5MB)</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Lengkap &amp; Gelar <span class="text-rose-500">*</span></label>
                                <input type="text" name="bride_name" value="{{ old('bride_name', 'Arinda Putri Larasati, S.I.Kom') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Panggilan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="bride_nickname" value="{{ old('bride_nickname', 'Arinda') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Urutan Anak</label>
                                    <input type="text" name="bride_child_order" value="{{ old('bride_child_order', 'Putri kedua') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ayah</label>
                                <input type="text" name="bride_father" value="{{ old('bride_father', 'Bpk. Ir. H. Hendra Wijaya, M.M.') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Ibu</label>
                                <input type="text" name="bride_mother" value="{{ old('bride_mother', 'Ibu Hj. Dewi Kusuma Wardani') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>

                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Akun Instagram</label>
                                <div class="flex items-center">
                                    <span class="px-3 py-2.5 rounded-l-xl bg-sand-200 text-sand-600 font-mono text-[11px] border border-r-0 border-sand-200">@</span>
                                    <input type="text" name="bride_instagram" value="{{ old('bride_instagram', 'arindaputri.l') }}" class="w-full px-3.5 py-2.5 rounded-r-xl border border-sand-200 bg-white">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-sand-200">
                        <button type="button" @click="currentStep = 1" class="px-5 py-2.5 rounded-2xl bg-sand-200 text-charcoal-900 font-bold text-xs">
                            Kembali
                        </button>
                        <button type="button" @click="currentStep = 3" class="px-6 py-3 rounded-2xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-2">
                            <span>Lanjut ke Jadwal Acara</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- STEP 3: JADWAL & LOKASI ACARA -->
                <!-- ========================================== -->
                <div x-show="currentStep === 3" class="space-y-6" style="display: none;">
                    <div class="space-y-1">
                        <h3 class="font-serif text-xl font-bold text-charcoal-950">Langkah 3: Rangkaian Jadwal Acara</h3>
                        <p class="text-xs text-sand-600">Atur tanggal, waktu, dan lokasi prosesi pernikahan.</p>
                    </div>

                    <div class="space-y-6">
                        
                        <!-- 1. AKAD NIKAH -->
                        <div class="p-6 rounded-2xl bg-sand-50/80 border border-sand-200 space-y-4">
                            <h4 class="font-serif text-base font-bold text-charcoal-950 flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center font-bold">1</span>
                                <span>Akad Nikah / Pemberkatan</span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Tanggal <span class="text-rose-500">*</span></label>
                                    <input type="date" name="akad_date" value="{{ old('akad_date', '2026-10-24') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Waktu Acara <span class="text-rose-500">*</span></label>
                                    <input type="text" name="akad_time" value="{{ old('akad_time', '08.00 - 10.00 WIB') }}" placeholder="Contoh: 08.00 - 10.00 WIB" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Tempat / Gedung <span class="text-rose-500">*</span></label>
                                    <input type="text" name="akad_venue" value="{{ old('akad_venue', 'Masjid Agung Sunda Kelapa') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Alamat Lengkap <span class="text-rose-500">*</span></label>
                                    <input type="text" name="akad_address" value="{{ old('akad_address', 'Jl. Taman Sunda Kelapa No.16, Menteng, Jakarta Pusat 10310') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Link Google Maps (Opsional)</label>
                                    <input type="url" name="akad_maps_link" value="{{ old('akad_maps_link', 'https://maps.google.com/?q=Masjid+Agung+Sunda+Kelapa+Jakarta') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                            </div>
                        </div>

                        <!-- 2. RESEPSI PERNIKAHAN -->
                        <div class="p-6 rounded-2xl bg-sand-50/80 border border-sand-200 space-y-4">
                            <h4 class="font-serif text-base font-bold text-charcoal-950 flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center font-bold">2</span>
                                <span>Resepsi Pernikahan / Syukuran</span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Tanggal <span class="text-rose-500">*</span></label>
                                    <input type="date" name="resepsi_date" value="{{ old('resepsi_date', '2026-10-24') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Waktu Acara <span class="text-rose-500">*</span></label>
                                    <input type="text" name="resepsi_time" value="{{ old('resepsi_time', '11.00 - 14.00 WIB & 18.30 - 21.00 WIB') }}" placeholder="Contoh: 11.00 - 14.00 WIB" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Nama Tempat / Gedung <span class="text-rose-500">*</span></label>
                                    <input type="text" name="resepsi_venue" value="{{ old('resepsi_venue', 'Grand Ballroom The Ritz-Carlton') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Alamat Lengkap <span class="text-rose-500">*</span></label>
                                    <input type="text" name="resepsi_address" value="{{ old('resepsi_address', 'Mega Kuningan Barat No.1, Setiabudi, Jakarta Selatan 12950') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Link Google Maps (Opsional)</label>
                                    <input type="url" name="resepsi_maps_link" value="{{ old('resepsi_maps_link', 'https://maps.google.com/?q=The+Ritz-Carlton+Jakarta+Mega+Kuningan') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-sand-200">
                        <button type="button" @click="currentStep = 2" class="px-5 py-2.5 rounded-2xl bg-sand-200 text-charcoal-900 font-bold text-xs">
                            Kembali
                        </button>
                        <button type="button" @click="currentStep = 4" class="px-6 py-3 rounded-2xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-2">
                            <span>Lanjut ke Galeri &amp; Musik</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- STEP 4: GALERI FOTO & MUSIK (NEW SECTION!) -->
                <!-- ========================================== -->
                <div x-show="currentStep === 4" class="space-y-6" style="display: none;">
                    <div class="space-y-1">
                        <h3 class="font-serif text-xl font-bold text-charcoal-950">Langkah 4: Galeri Foto Prewedding &amp; Musik Latar</h3>
                        <p class="text-xs text-sand-600">Unggah foto cover utama, album galeri prewedding, dan tentukan lagu pengiring undangan.</p>
                    </div>

                    <!-- 1. FOTO COVER UTAMA -->
                    <div class="p-6 rounded-2xl bg-sand-50/80 border border-sand-200 space-y-4 text-xs">
                        <h4 class="font-serif text-base font-bold text-charcoal-950 flex items-center gap-2">
                            <i data-lucide="image" class="w-4 h-4 text-brand-600"></i>
                            <span>Foto Cover / Sampul Utama</span>
                        </h4>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
                            <!-- PREVIEW COVER -->
                            <div class="sm:col-span-4 aspect-[4/3] rounded-2xl bg-sand-200 overflow-hidden border border-sand-300 relative group">
                                <template x-if="coverPreview">
                                    <img :src="coverPreview" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!coverPreview">
                                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&auto=format&fit=crop&q=85" class="w-full h-full object-cover">
                                </template>
                                <div class="absolute bottom-2 left-2 px-2 py-0.5 rounded-md bg-charcoal-950/70 backdrop-blur-md text-white text-[9px] font-bold">
                                    Cover Preview
                                </div>
                            </div>

                            <div class="sm:col-span-8 space-y-2">
                                <div>
                                    <label class="font-bold text-charcoal-900 block mb-1">Unggah Berkas Foto Cover (Komputer / HP)</label>
                                    <input 
                                        type="file" 
                                        name="cover_image_file" 
                                        accept="image/*"
                                        @change="previewFile($event, 'coverPreview')"
                                        class="w-full text-xs text-sand-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-charcoal-950 file:text-white hover:file:bg-brand-600 cursor-pointer"
                                    >
                                </div>
                                <span class="text-[10px] text-sand-500 block">Rekomendasi rasio potret atau lanskap resolusi tinggi (JPG, PNG, WEBP, maks 5MB).</span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. UNGGAH BANYAK FOTO GALERI (MULTI-PHOTO PREWEDDING) -->
                    <div class="p-6 rounded-2xl bg-sand-50/80 border border-sand-200 space-y-4 text-xs">
                        <div class="flex items-center justify-between">
                            <h4 class="font-serif text-base font-bold text-charcoal-950 flex items-center gap-2">
                                <i data-lucide="images" class="w-4 h-4 text-brand-600"></i>
                                <span>Galeri Album Prewedding (Multi-Upload)</span>
                            </h4>
                            <span class="text-[10px] text-brand-600 font-bold bg-brand-50 px-2.5 py-1 rounded-full border border-brand-200">
                                Bisa Pilih Banyak Foto Sekaligus
                            </span>
                        </div>

                        <div class="space-y-3">
                            <label class="font-bold text-charcoal-900 block">Pilih Foto-Foto Prewedding</label>
                            <input 
                                type="file" 
                                name="gallery_files[]" 
                                multiple
                                accept="image/*"
                                @change="previewMultipleGalleries($event)"
                                class="w-full text-xs text-sand-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-charcoal-950 file:text-white hover:file:bg-brand-600 cursor-pointer"
                            >
                            <p class="text-[10px] text-sand-500">Anda dapat memilih 4 - 10 foto prewedding terbaik untuk ditampilkan di album galeri.</p>
                        </div>

                        <!-- LIVE MULTI-PREVIEWS -->
                        <div x-show="galleryPreviews.length > 0" class="pt-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block mb-2">Foto Yang Baru Dipilih:</span>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                <template x-for="(img, idx) in galleryPreviews" :key="idx">
                                    <div class="aspect-square rounded-xl bg-sand-200 overflow-hidden border border-sand-300 shadow-sm relative">
                                        <img :src="img" class="w-full h-full object-cover">
                                        <span class="absolute top-1 left-1 px-1.5 py-0.5 rounded bg-charcoal-950/75 text-white text-[8px] font-bold" x-text="idx + 1"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- 3. MUSIK LATAR & AUDIO CONTROLLER -->
                    <div class="p-6 rounded-2xl bg-sand-50/80 border border-sand-200 space-y-4 text-xs">
                        <div class="flex items-center justify-between">
                            <h4 class="font-serif text-base font-bold text-charcoal-950 flex items-center gap-2">
                                <i data-lucide="music" class="w-4 h-4 text-brand-600"></i>
                                <span>Pilihan Musik Latar (Background Music)</span>
                            </h4>

                            <!-- LIVE TEST BUTTON -->
                            <button 
                                type="button" 
                                @click="toggleAudioTest()"
                                :class="isPlayingAudio ? 'bg-amber-500 text-charcoal-950 shadow-md' : 'bg-charcoal-950 text-white'"
                                class="px-3.5 py-1.5 rounded-full font-bold text-[11px] transition flex items-center gap-1.5"
                            >
                                <i :data-lucide="isPlayingAudio ? 'pause' : 'play'" class="w-3.5 h-3.5 fill-current"></i>
                                <span x-text="isPlayingAudio ? 'Jeda Audio' : 'Tes Putar Lagu'"></span>
                            </button>
                        </div>

                        <!-- PRESET SELECTION -->
                        <div class="space-y-2">
                            <label class="font-bold text-charcoal-900 block">Pilihan Musik Instrumen Siap Pakai:</label>
                            <select 
                                name="music_preset" 
                                x-model="selectedMusic"
                                @change="changeMusicPreset($event.target.value)"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white font-medium focus:ring-2 focus:ring-brand-500"
                            >
                                @foreach ($musicPresets as $music)
                                    <option value="{{ $music['file'] }}">{{ $music['title'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- OR UPLOAD CUSTOM MP3 -->
                        <div class="pt-3 border-t border-sand-200 space-y-2">
                            <label class="font-bold text-charcoal-900 block">Atau Unggah Berkas MP3 Anda Sendiri (Opsional):</label>
                            <input 
                                type="file" 
                                name="music_file" 
                                accept="audio/mp3,audio/wav,audio/m4a,audio/*"
                                class="w-full text-xs text-sand-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-sand-200 file:text-charcoal-950 hover:file:bg-sand-300 cursor-pointer"
                            >
                            <span class="text-[10px] text-sand-500 block">Mendukung format .mp3, .wav, .m4a (Maks. 10MB). Musik akan otomatis berputar lembut saat tamu membuka undangan.</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-sand-200">
                        <button type="button" @click="currentStep = 3" class="px-5 py-2.5 rounded-2xl bg-sand-200 text-charcoal-900 font-bold text-xs">
                            Kembali
                        </button>
                        <button type="button" @click="currentStep = 5" class="px-6 py-3 rounded-2xl bg-charcoal-950 text-white font-bold text-xs hover:bg-brand-600 transition flex items-center gap-2">
                            <span>Lanjut ke Amplop &amp; Rilis</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- STEP 5: AMPLOP & PUBLISH -->
                <!-- ========================================== -->
                <div x-show="currentStep === 5" class="space-y-6" style="display: none;">
                    <div class="space-y-1">
                        <h3 class="font-serif text-xl font-bold text-charcoal-950">Langkah 5: Rekening Amplop &amp; Rilis</h3>
                        <p class="text-xs text-sand-600">Nomor rekening transfer untuk kado pernikahan digital para tamu.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        
                        <!-- BANK 1 -->
                        <div class="p-6 rounded-2xl bg-sand-50/80 border border-sand-200 space-y-3 text-xs">
                            <h4 class="font-serif text-sm font-bold text-charcoal-950">Rekening Bank 1</h4>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Bank</label>
                                <input type="text" name="bank_1_name" value="{{ old('bank_1_name', 'Bank Central Asia (BCA)') }}" placeholder="BCA / Mandiri / BRI" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nomor Rekening</label>
                                <input type="text" name="bank_1_number" value="{{ old('bank_1_number', '8801234567') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Atas Nama Rekening</label>
                                <input type="text" name="bank_1_holder" value="{{ old('bank_1_holder', 'Raka Adiputra') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>
                        </div>

                        <!-- BANK 2 -->
                        <div class="p-6 rounded-2xl bg-sand-50/80 border border-sand-200 space-y-3 text-xs">
                            <h4 class="font-serif text-sm font-bold text-charcoal-950">Rekening Bank 2 (Opsional)</h4>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nama Bank</label>
                                <input type="text" name="bank_2_name" value="{{ old('bank_2_name', 'Bank Mandiri') }}" placeholder="Bank Mandiri / BNI / dll" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Nomor Rekening</label>
                                <input type="text" name="bank_2_number" value="{{ old('bank_2_number', '1370019283741') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Atas Nama Rekening</label>
                                <input type="text" name="bank_2_holder" value="{{ old('bank_2_holder', 'Arinda Putri Larasati') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white">
                            </div>
                        </div>
                    </div>

                    <div class="p-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-900 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i data-lucide="sparkles" class="w-6 h-6 text-emerald-600 flex-shrink-0"></i>
                            <div>
                                <p class="font-bold">Undangan Siap Diterbitkan &amp; Disimpan</p>
                                <p class="text-[11px] text-emerald-700">Seluruh data, foto galeri prewedding, dan musik latar akan tersimpan di sistem dan siap dibagikan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-sand-200">
                        <button type="button" @click="currentStep = 4" class="px-5 py-2.5 rounded-2xl bg-sand-200 text-charcoal-900 font-bold text-xs">
                            Kembali
                        </button>
                        <button 
                            type="submit" 
                            class="px-8 py-3.5 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs shadow-lg hover:shadow-brand-500/30 hover:scale-105 transition flex items-center gap-2 cursor-pointer"
                        >
                            <i data-lucide="check" class="w-4 h-4"></i>
                            <span>Simpan &amp; Rilis Undangan</span>
                        </button>
                    </div>
                </div>

            </div>

        </form>

    </div>
</x-app-layout>
