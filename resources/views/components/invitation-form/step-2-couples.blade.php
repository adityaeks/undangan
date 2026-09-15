<!-- STEP 2: MEMPELAI -->
<div x-show="currentStep === 2" x-transition data-step="2" class="space-y-6">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- MEMPELAI PRIA (GROOM) -->
        <div class="p-5 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-4">
            <div class="flex items-center gap-2 pb-2 border-b border-sand-200">
                <span class="w-7 h-7 rounded-xl bg-charcoal-900 text-brand-200 flex items-center justify-center font-bold text-xs">♂</span>
                <h4 class="font-serif text-sm font-bold text-charcoal-950">Mempelai Pria (Groom)</h4>
            </div>

            <!-- FOTO MEMPELAI PRIA (MULTI-PHOTO GRID) -->
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold uppercase tracking-wider text-charcoal-900">
                        Foto Mempelai Pria
                    </label>
                    <span class="text-[11px] font-bold text-sand-500 bg-sand-100 px-2 py-0.5 rounded-full border border-sand-200" x-text="groomPhotoItems.length + '/5 Foto'"></span>
                </div>

                <!-- HIDDEN FILE INPUT FOR FORM SUBMISSION -->
                <input 
                    type="file" 
                    name="groom_photo_files[]" 
                    multiple 
                    accept="image/*" 
                    x-ref="groomFilesInput" 
                    class="hidden"
                >

                <!-- HIDDEN INPUTS FOR EXISTING PHOTOS -->
                <template x-for="item in groomPhotoItems" :key="item.id">
                    <template x-if="item.is_existing">
                        <input type="hidden" name="existing_groom_photo_urls[]" :value="item.url">
                    </template>
                </template>

                <!-- HIDDEN PICKER INPUT -->
                <input 
                    type="file" 
                    multiple 
                    accept="image/*" 
                    x-ref="groomAddInput" 
                    class="hidden" 
                    @change="addGroomFiles($event.target.files); $event.target.value = '';"
                >

                <!-- GRID DISPLAY (3:4 PORTRAIT) -->
                <div class="grid grid-cols-3 sm:grid-cols-4 gap-2.5">
                    
                    <!-- PRIMARY PHOTO (UTAMA) -->
                    <template x-if="groomPhotoItems.length > 0">
                        <div class="relative aspect-[3/4] rounded-xl overflow-hidden bg-sand-100 border-2 border-brand-400 shadow-sm group">
                            <img :src="groomPhotoItems[0].url" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            
                            <div class="absolute top-1 left-1 px-1.5 py-0.5 rounded-md bg-black/60 backdrop-blur-xs text-white text-[9px] font-bold flex items-center gap-1">
                                <i data-lucide="sparkles" class="w-2.5 h-2.5 text-amber-300"></i>
                                <span>Utama</span>
                            </div>

                            <button 
                                type="button" 
                                @click="removeGroomPhotoItem(0)"
                                title="Hapus foto ini"
                                class="absolute top-1 right-1 w-6 h-6 rounded-md bg-rose-500 hover:bg-rose-600 text-white flex items-center justify-center shadow-xs opacity-90 group-hover:opacity-100 transition cursor-pointer"
                            >
                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                            </button>
                        </div>
                    </template>

                    <!-- ADDITIONAL PHOTOS -->
                    <template x-for="(item, index) in groomPhotoItems.slice(1)" :key="item.id">
                        <div class="relative aspect-[3/4] rounded-xl overflow-hidden bg-sand-100 border border-sand-200 shadow-2xs group">
                            <img :src="item.url" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            
                            <div class="absolute top-1 left-1 px-1.5 py-0.5 rounded-md bg-black/60 backdrop-blur-xs text-white text-[9px] font-bold">
                                <span x-text="'Foto ' + (index + 2)"></span>
                            </div>

                            <button 
                                type="button" 
                                @click="removeGroomPhotoItem(index + 1)"
                                title="Hapus foto ini"
                                class="absolute top-1 right-1 w-6 h-6 rounded-md bg-rose-500 hover:bg-rose-600 text-white flex items-center justify-center shadow-xs opacity-90 group-hover:opacity-100 transition cursor-pointer"
                            >
                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                            </button>
                        </div>
                    </template>

                    <!-- ADD PHOTO DASHED CARD -->
                    <template x-if="groomPhotoItems.length < 5">
                        <div 
                            @click="$refs.groomAddInput.click()"
                            class="aspect-[3/4] rounded-xl border-2 border-dashed border-sand-300 hover:border-brand-500 hover:bg-brand-50/20 bg-sand-50/30 transition-all flex flex-col items-center justify-center p-2 text-center cursor-pointer group shadow-2xs"
                        >
                            <div class="w-8 h-8 rounded-full bg-white group-hover:bg-brand-500 text-sand-700 group-hover:text-white flex items-center justify-center shadow-xs border border-sand-200 group-hover:border-brand-500 transition mb-1.5">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                            </div>
                            <span class="text-[11px] font-bold text-charcoal-900 group-hover:text-brand-700">+ Foto</span>
                            <span class="text-[9px] text-sand-400">Pria</span>
                        </div>
                    </template>

                </div>
                <p class="text-[10px] text-sand-400">💡 Bisa unggah hingga 5 foto (1 per 1 atau sekaligus). Foto pertama otomatis jadi foto profil utama.</p>
            </div>

            <!-- DETAIL PRIA -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">
                        Nama Lengkap Pria <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="groom_name" 
                        value="{{ old('groom_name', $groom?->full_name) }}" 
                        placeholder="dr. Romeo Montague, Sp.A" 
                        required
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">
                        Nama Panggilan <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="groom_nickname" 
                        value="{{ old('groom_nickname', $groom?->nickname) }}" 
                        placeholder="Romeo" 
                        required
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-charcoal-900">
                    Urutan Anak
                </label>
                <input 
                    type="text" 
                    name="groom_child_order" 
                    value="{{ old('groom_child_order', $groom?->child_number ?? 'Putra Pertama dari') }}" 
                    placeholder="Putra Pertama dari / Putra ke-2 dari" 
                    class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                >
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">Nama Ayah</label>
                    <input 
                        type="text" 
                        name="groom_father" 
                        value="{{ old('groom_father', $groom?->father_name) }}" 
                        placeholder="Bpk. Montague" 
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">Nama Ibu</label>
                    <input 
                        type="text" 
                        name="groom_mother" 
                        value="{{ old('groom_mother', $groom?->mother_name) }}" 
                        placeholder="Ibu Montague" 
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-charcoal-900">Instagram Pria</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sand-400 text-xs">@</span>
                    <input 
                        type="text" 
                        name="groom_instagram" 
                        value="{{ old('groom_instagram', $groom?->instagram) }}" 
                        placeholder="username" 
                        class="w-full pl-7 pr-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>
            </div>
        </div>

        <!-- MEMPELAI WANITA (BRIDE) -->
        <div class="p-5 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-4">
            <div class="flex items-center gap-2 pb-2 border-b border-sand-200">
                <span class="w-7 h-7 rounded-xl bg-brand-600 text-white flex items-center justify-center font-bold text-xs">♀</span>
                <h4 class="font-serif text-sm font-bold text-charcoal-950">Mempelai Wanita (Bride)</h4>
            </div>

            <!-- FOTO MEMPELAI WANITA (MULTI-PHOTO GRID) -->
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold uppercase tracking-wider text-charcoal-900">
                        Foto Mempelai Wanita
                    </label>
                    <span class="text-[11px] font-bold text-sand-500 bg-sand-100 px-2 py-0.5 rounded-full border border-sand-200" x-text="bridePhotoItems.length + '/5 Foto'"></span>
                </div>

                <!-- HIDDEN FILE INPUT FOR FORM SUBMISSION -->
                <input 
                    type="file" 
                    name="bride_photo_files[]" 
                    multiple 
                    accept="image/*" 
                    x-ref="brideFilesInput" 
                    class="hidden"
                >

                <!-- HIDDEN INPUTS FOR EXISTING PHOTOS -->
                <template x-for="item in bridePhotoItems" :key="item.id">
                    <template x-if="item.is_existing">
                        <input type="hidden" name="existing_bride_photo_urls[]" :value="item.url">
                    </template>
                </template>

                <!-- HIDDEN PICKER INPUT -->
                <input 
                    type="file" 
                    multiple 
                    accept="image/*" 
                    x-ref="brideAddInput" 
                    class="hidden" 
                    @change="addBrideFiles($event.target.files); $event.target.value = '';"
                >

                <!-- GRID DISPLAY (3:4 PORTRAIT) -->
                <div class="grid grid-cols-3 sm:grid-cols-4 gap-2.5">
                    
                    <!-- PRIMARY PHOTO (UTAMA) -->
                    <template x-if="bridePhotoItems.length > 0">
                        <div class="relative aspect-[3/4] rounded-xl overflow-hidden bg-sand-100 border-2 border-brand-400 shadow-sm group">
                            <img :src="bridePhotoItems[0].url" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            
                            <div class="absolute top-1 left-1 px-1.5 py-0.5 rounded-md bg-black/60 backdrop-blur-xs text-white text-[9px] font-bold flex items-center gap-1">
                                <i data-lucide="sparkles" class="w-2.5 h-2.5 text-amber-300"></i>
                                <span>Utama</span>
                            </div>

                            <button 
                                type="button" 
                                @click="removeBridePhotoItem(0)"
                                title="Hapus foto ini"
                                class="absolute top-1 right-1 w-6 h-6 rounded-md bg-rose-500 hover:bg-rose-600 text-white flex items-center justify-center shadow-xs opacity-90 group-hover:opacity-100 transition cursor-pointer"
                            >
                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                            </button>
                        </div>
                    </template>

                    <!-- ADDITIONAL PHOTOS -->
                    <template x-for="(item, index) in bridePhotoItems.slice(1)" :key="item.id">
                        <div class="relative aspect-[3/4] rounded-xl overflow-hidden bg-sand-100 border border-sand-200 shadow-2xs group">
                            <img :src="item.url" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            
                            <div class="absolute top-1 left-1 px-1.5 py-0.5 rounded-md bg-black/60 backdrop-blur-xs text-white text-[9px] font-bold">
                                <span x-text="'Foto ' + (index + 2)"></span>
                            </div>

                            <button 
                                type="button" 
                                @click="removeBridePhotoItem(index + 1)"
                                title="Hapus foto ini"
                                class="absolute top-1 right-1 w-6 h-6 rounded-md bg-rose-500 hover:bg-rose-600 text-white flex items-center justify-center shadow-xs opacity-90 group-hover:opacity-100 transition cursor-pointer"
                            >
                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                            </button>
                        </div>
                    </template>

                    <!-- ADD PHOTO DASHED CARD -->
                    <template x-if="bridePhotoItems.length < 5">
                        <div 
                            @click="$refs.brideAddInput.click()"
                            class="aspect-[3/4] rounded-xl border-2 border-dashed border-sand-300 hover:border-brand-500 hover:bg-brand-50/20 bg-sand-50/30 transition-all flex flex-col items-center justify-center p-2 text-center cursor-pointer group shadow-2xs"
                        >
                            <div class="w-8 h-8 rounded-full bg-white group-hover:bg-brand-500 text-sand-700 group-hover:text-white flex items-center justify-center shadow-xs border border-sand-200 group-hover:border-brand-500 transition mb-1.5">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                            </div>
                            <span class="text-[11px] font-bold text-charcoal-900 group-hover:text-brand-700">+ Foto</span>
                            <span class="text-[9px] text-sand-400">Wanita</span>
                        </div>
                    </template>

                </div>
                <p class="text-[10px] text-sand-400">💡 Bisa unggah hingga 5 foto (1 per 1 atau sekaligus). Foto pertama otomatis jadi foto profil utama.</p>
            </div>

            <!-- DETAIL WANITA -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">
                        Nama Lengkap Wanita <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="bride_name" 
                        value="{{ old('bride_name', $bride?->full_name) }}" 
                        placeholder="Juliet Capulet, S.Ked" 
                        required
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">
                        Nama Panggilan <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="bride_nickname" 
                        value="{{ old('bride_nickname', $bride?->nickname) }}" 
                        placeholder="Juliet" 
                        required
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-charcoal-900">
                    Urutan Anak
                </label>
                <input 
                    type="text" 
                    name="bride_child_order" 
                    value="{{ old('bride_child_order', $bride?->child_number ?? 'Putri Kedua dari') }}" 
                    placeholder="Putri Kedua dari / Putri Bungsu dari" 
                    class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                >
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">Nama Ayah</label>
                    <input 
                        type="text" 
                        name="bride_father" 
                        value="{{ old('bride_father', $bride?->father_name) }}" 
                        placeholder="Bpk. Capulet" 
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">Nama Ibu</label>
                    <input 
                        type="text" 
                        name="bride_mother" 
                        value="{{ old('bride_mother', $bride?->mother_name) }}" 
                        placeholder="Ibu Capulet" 
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-charcoal-900">Akun Instagram (Opsional)</label>
                <div class="flex items-center">
                    <span class="px-3 py-2 bg-sand-200 border border-r-0 border-sand-300 rounded-l-xl text-xs text-sand-600 font-semibold">@</span>
                    <input 
                        type="text" 
                        name="bride_instagram" 
                        value="{{ old('bride_instagram', $bride?->instagram) }}" 
                        placeholder="username_tanpa_at" 
                        class="w-full px-3 py-2 rounded-r-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>
            </div>
        </div>

    </div>
</div>
