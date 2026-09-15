<!-- STEP 5: GALERI, VIDEO & MUSIK -->
<div x-show="currentStep === 5" x-transition data-step="5" class="space-y-6">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        
        <!-- CARD 1: FOTO SAMPUL UTAMA (COVER HERO) -->
        <div class="p-5 rounded-2xl bg-white border border-sand-200 shadow-2xs space-y-4 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-sand-100">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center">
                            <i data-lucide="image" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h4 class="font-serif text-sm font-bold text-charcoal-950">Foto Sampul Utama</h4>
                            <p class="text-[10px] text-sand-500">Foto pembuka (bisa 1 atau banyak foto untuk slider)</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full bg-sand-100 text-charcoal-800 text-[11px] font-bold border border-sand-200" x-text="coverItems.length + '/5 Foto'"></span>
                </div>

                <!-- HIDDEN FILE INPUT FOR FORM SUBMISSION -->
                <input 
                    type="file" 
                    name="cover_image_files[]" 
                    multiple 
                    accept="image/*" 
                    x-ref="coverFilesInput" 
                    class="hidden"
                >

                <!-- HIDDEN INPUTS FOR EXISTING COVERS -->
                <template x-for="item in coverItems" :key="item.id">
                    <template x-if="item.is_existing">
                        <input type="hidden" name="existing_cover_urls[]" :value="item.url">
                    </template>
                </template>

                <!-- COVER PHOTO DISPLAY (UNIFIED 9:16 PORTRAIT GRID - SIDE BY SIDE) -->
                <div>
                    <!-- HIDDEN FILE INPUT FOR CHOOSING COVER IMAGES -->
                    <input 
                        type="file" 
                        multiple 
                        accept="image/*" 
                        x-ref="coverAddInput" 
                        class="hidden" 
                        @change="addCoverFiles($event.target.files); $event.target.value = '';"
                    >

                    <!-- UNIFIED 9:16 COVERS GRID -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3.5">
                        
                        <!-- PRIMARY COVER (SAMPUL 1 / UTAMA) -->
                        <template x-if="coverItems.length > 0">
                            <div class="relative aspect-[9/16] rounded-2xl overflow-hidden bg-sand-100 border-2 border-brand-300 shadow-sm group">
                                <img :src="coverItems[0].url" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                
                                <div class="absolute top-2 left-2 px-2 py-0.5 rounded-lg bg-black/60 backdrop-blur-xs text-white text-[10px] font-bold flex items-center gap-1">
                                    <i data-lucide="sparkles" class="w-3 h-3 text-amber-300"></i>
                                    <span>Utama</span>
                                </div>

                                <button 
                                    type="button" 
                                    @click="removeCoverItem(0)"
                                    title="Hapus foto sampul ini"
                                    class="absolute top-2 right-2 w-7 h-7 rounded-lg bg-rose-500 hover:bg-rose-600 text-white flex items-center justify-center shadow-md opacity-90 group-hover:opacity-100 transition cursor-pointer"
                                >
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </template>

                        <!-- ADDITIONAL COVERS (SAMPUL 2, 3, ...) -->
                        <template x-for="(item, index) in coverItems.slice(1)" :key="item.id">
                            <div class="relative aspect-[9/16] rounded-2xl overflow-hidden bg-sand-100 border border-sand-200 shadow-2xs group">
                                <img :src="item.url" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                
                                <div class="absolute top-2 left-2 px-2 py-0.5 rounded-lg bg-black/60 backdrop-blur-xs text-white text-[10px] font-bold">
                                    <span x-text="'Foto ' + (index + 2)"></span>
                                </div>

                                <button 
                                    type="button" 
                                    @click="removeCoverItem(index + 1)"
                                    title="Hapus foto ini"
                                    class="absolute top-2 right-2 w-7 h-7 rounded-lg bg-rose-500 hover:bg-rose-600 text-white flex items-center justify-center shadow-xs opacity-90 group-hover:opacity-100 transition cursor-pointer"
                                >
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </template>

                        <!-- EMPTY DASHED CARD FOR NEXT COVER (9:16) - PLACED SIDE BY SIDE NEXT TO PHOTOS -->
                        <template x-if="coverItems.length < 5">
                            <div 
                                @click="$refs.coverAddInput.click()"
                                class="aspect-[9/16] rounded-2xl border-2 border-dashed border-sand-300 hover:border-brand-500 hover:bg-brand-50/20 bg-sand-50/30 transition-all flex flex-col items-center justify-center p-3 text-center cursor-pointer group shadow-2xs"
                            >
                                <div class="w-10 h-10 rounded-full bg-white group-hover:bg-brand-500 text-sand-700 group-hover:text-white flex items-center justify-center shadow-xs border border-sand-200 group-hover:border-brand-500 transition mb-2">
                                    <i data-lucide="plus" class="w-5 h-5"></i>
                                </div>
                                <span class="text-xs font-bold text-charcoal-900 group-hover:text-brand-700">Tambah Sampul</span>
                                <span class="text-[10px] text-sand-500 mt-0.5">Rasio 9:16</span>
                                <span class="text-[9px] text-sand-400" x-text="coverItems.length > 0 ? '(Sampul ' + (coverItems.length + 1) + ')' : '(Layar HP)'"></span>
                            </div>
                        </template>

                    </div>
                </div>

                <p class="text-[10px] text-sand-400 pt-1">
                    💡 Disarankan rasio portrait 9:16 (Layar HP / Story). Jika mengunggah lebih dari 1 foto, sampul pembuka dapat berputar bergantian.
                </p>
            </div>
        </div>

        <!-- CARD 2: MUSIK LATAR (BACKGROUND MUSIC) -->
        <div class="p-5 rounded-2xl bg-white border border-sand-200 shadow-2xs space-y-4 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center justify-between gap-3 pb-2 border-b border-sand-100">
                    <div class="flex items-center gap-2 min-w-0">
                        <div class="w-7 h-7 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center shrink-0">
                            <i data-lucide="music" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-serif text-sm font-bold text-charcoal-950 truncate">Musik Latar (Audio)</h4>
                            <p class="text-[10px] text-sand-500 truncate">Lagu pengiring romantis saat dibuka</p>
                        </div>
                    </div>

                    <!-- TEST PLAY BUTTON -->
                    <button 
                        type="button" 
                        @click="toggleAudioTest()"
                        class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-xs cursor-pointer shrink-0 whitespace-nowrap"
                        :class="isPlayingAudio ? 'bg-rose-500 text-white animate-pulse' : 'bg-brand-600 text-white hover:bg-brand-700'"
                    >
                        <i :data-lucide="isPlayingAudio ? 'pause' : 'play'" class="w-3.5 h-3.5 shrink-0"></i>
                        <span x-text="isPlayingAudio ? 'Jeda Musik' : 'Putar Musik'" class="whitespace-nowrap"></span>
                    </button>
                </div>

                <!-- LIVE FEEDBACK & ERROR NOTICES -->
                <template x-if="audioError">
                    <div class="p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-start gap-2 shadow-2xs">
                        <i data-lucide="alert-triangle" class="w-4 h-4 text-rose-600 shrink-0 mt-0.5"></i>
                        <span x-text="audioError" class="leading-relaxed"></span>
                    </div>
                </template>

                <template x-if="isPlayingAudio">
                    <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center justify-between shadow-2xs">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="relative flex h-2.5 w-2.5 shrink-0">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-600"></span>
                            </span>
                            <span class="font-bold truncate text-[11px]">Sedang Memutar Audio Musik Latar...</span>
                        </div>
                        <button type="button" @click="toggleAudioTest()" class="text-rose-600 hover:text-rose-700 font-bold text-[11px] underline ml-2 shrink-0 cursor-pointer">
                            Hentikan
                        </button>
                    </div>
                </template>

                <!-- PRESET MUSIC SELECTOR -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-charcoal-900">Pilih Musik Romantis Favorit</label>
                    <div class="relative">
                        <select 
                            name="music_preset" 
                            @change="changeMusicPreset($event.target.value)"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-sand-300 text-xs font-medium text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-sand-50/50 appearance-none"
                        >
                            <option value="">-- Tanpa Lagu Latar --</option>
                            @foreach($musicPresets as $key => $preset)
                                @php
                                    $pTitle = is_array($preset) ? ($preset['title'] ?? $key) : (is_string($key) && !is_numeric($key) ? $key : $preset);
                                    $pFile = is_array($preset) ? ($preset['file'] ?? '') : $preset;
                                @endphp
                                <option 
                                    value="{{ $pFile }}" 
                                    @selected(old('music_preset', $invitation?->background_music) === $pFile)
                                >
                                    🎵 {{ $pTitle }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-sand-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>

                <!-- CUSTOM AUDIO FILE UPLOAD -->
                <div class="space-y-1.5 pt-2 border-t border-sand-100">
                    <label class="block text-xs font-bold text-charcoal-900">Atau Unggah Lagu Custom (MP3 / WAV)</label>
                    <input 
                        type="file" 
                        name="music_file" 
                        accept="audio/*"
                        @change="
                            const file = $event.target.files[0];
                            if(file) {
                                selectedMusic = URL.createObjectURL(file);
                                toggleAudioTest(selectedMusic);
                            }
                        "
                        class="w-full text-xs text-sand-600 file:mr-2.5 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-charcoal-900 file:text-white hover:file:bg-charcoal-800 cursor-pointer"
                    >
                    <p class="text-[10px] text-sand-400">Format .mp3 / .wav (Maksimal 10MB)</p>
                </div>
            </div>
        </div>

    </div>

    <!-- CARD 3: GALERI FOTO & LIVE STREAMING (FULL WIDTH) -->
    <div class="p-5 rounded-2xl bg-white border border-sand-200 shadow-2xs space-y-5">
        
        <!-- HEADER GALERI -->
        <div class="flex items-center justify-between pb-2 border-b border-sand-100">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center">
                    <i data-lucide="images" class="w-4 h-4"></i>
                </div>
                <div>
                    <h4 class="font-serif text-sm font-bold text-charcoal-950">Album Galeri Kenangan</h4>
                    <p class="text-[10px] text-sand-500">Unggah foto satu per satu atau sekaligus (Otomatis WebP hemat kuota)</p>
                </div>
            </div>
            <span class="px-2.5 py-0.5 rounded-full bg-sand-100 text-charcoal-800 text-[11px] font-bold border border-sand-200" x-text="galleryItems.length + '/10 Foto'"></span>
        </div>

        <!-- HIDDEN FILE INPUT FOR ACTUAL FORM SUBMISSION -->
        <input 
            type="file" 
            name="gallery_files[]" 
            multiple 
            accept="image/*" 
            x-ref="galleryFilesInput" 
            class="hidden"
        >

        <!-- HIDDEN INPUTS FOR EXISTING PHOTOS -->
        <template x-for="item in galleryItems" :key="item.id">
            <template x-if="item.is_existing">
                <input type="hidden" name="existing_gallery_urls[]" :value="item.url">
            </template>
        </template>

        <!-- INTERACTIVE GALLERY GRID (1-by-1 or batch) -->
        <div class="space-y-3">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3.5">
                
                <!-- UPLOADED / EXISTING PHOTO ITEMS -->
                <template x-for="(item, index) in galleryItems" :key="item.id">
                    <div class="relative aspect-square rounded-2xl overflow-hidden bg-sand-100 border border-sand-200 shadow-2xs group">
                        <img :src="item.url" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        
                        <!-- TOP ORDER BADGE -->
                        <div class="absolute top-2 left-2 px-2 py-0.5 rounded-lg bg-black/60 backdrop-blur-xs text-white text-[10px] font-bold">
                            <span x-text="'Foto ' + (index + 1)"></span>
                        </div>

                        <!-- DELETE BUTTON OVERLAY -->
                        <button 
                            type="button" 
                            @click="removeGalleryItem(index)"
                            title="Hapus foto ini"
                            class="absolute top-2 right-2 w-7 h-7 rounded-xl bg-rose-500 hover:bg-rose-600 text-white flex items-center justify-center shadow-sm opacity-90 group-hover:opacity-100 transition cursor-pointer"
                        >
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                </template>

                <!-- EMPTY DASHED CARD TO ADD PHOTO (1-by-1 or batch) -->
                <template x-if="galleryItems.length < 10">
                    <div 
                        @click="$refs.galleryAddInput.click()"
                        class="aspect-square rounded-2xl border-2 border-dashed border-sand-300 hover:border-brand-500 hover:bg-brand-50/20 bg-sand-50/30 transition-all flex flex-col items-center justify-center p-3 text-center cursor-pointer group shadow-2xs"
                    >
                        <input 
                            type="file" 
                            multiple 
                            accept="image/*" 
                            x-ref="galleryAddInput" 
                            class="hidden" 
                            @change="addGalleryFiles($event.target.files); $event.target.value = '';"
                        >
                        <div class="w-10 h-10 rounded-2xl bg-white group-hover:bg-brand-500 text-brand-600 group-hover:text-white flex items-center justify-center shadow-xs border border-sand-200 group-hover:border-brand-500 transition mb-2">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-bold text-charcoal-900 group-hover:text-brand-700">Tambah Foto</span>
                        <span class="text-[10px] text-sand-400">1 per 1 atau banyak</span>
                    </div>
                </template>

            </div>

            <p class="text-[11px] text-sand-500 flex items-center gap-1.5 pt-1">
                <i data-lucide="info" class="w-3.5 h-3.5 text-sand-400 shrink-0"></i>
                <span>Klik tombol <strong>+ Tambah Foto</strong> untuk menambah foto galeri (Maksimal 10 foto, otomatis dikonversi ke WebP).</span>
            </p>
        </div>

        <!-- VIDEO STREAMING LINK -->
        <div class="pt-4 border-t border-sand-100 space-y-1.5">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                    <i data-lucide="video" class="w-3.5 h-3.5"></i>
                </div>
                <label class="block text-xs font-bold text-charcoal-900">
                    Tautan Siaran Langsung / Video YouTube (Opsional)
                </label>
            </div>
            <input 
                type="url" 
                name="streaming_url" 
                value="{{ old('streaming_url', $invitation?->setting?->streaming_url ?? ($invitation?->media->where('media_type', 'video')->first()?->url)) }}" 
                placeholder="https://www.youtube.com/watch?v=... atau https://instagram.com/..." 
                class="w-full px-3.5 py-2.5 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-sand-50/50"
            >
            <p class="text-[10px] text-sand-500">Tautan live streaming bagi tamu dan keluarga yang ingin menyaksikan prosesi akad/resepsi secara virtual.</p>
        </div>

    </div>

</div>
