<!-- STEP 4: KISAH PERJALANAN (LOVE STORY) -->
<div x-show="currentStep === 4" x-transition data-step="4" class="space-y-6">

    <!-- DYNAMIC THEME STORY BANNER -->
    <!-- <template x-if="themeSupportsStoryImages()">
        <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200/80 text-xs text-emerald-900 flex items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-center gap-2.5">
                <i data-lucide="image" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                <div>
                    <span class="font-bold text-emerald-950" x-text="activeTheme?.name + ':'"></span>
                    <span>Tema ini mendukung <strong>Foto Kenangan</strong> pada setiap kartu babak kisah cinta Anda.</span>
                </div>
            </div>
            <span class="px-2 py-0.5 rounded-md bg-white border border-emerald-300 text-emerald-700 text-[10px] font-bold uppercase tracking-wider shrink-0">Fitur Foto Aktif</span>
        </div>
    </template>

    <template x-if="!themeSupportsStoryImages()">
        <div class="p-3.5 rounded-2xl bg-sand-100/90 border border-sand-200 text-xs text-sand-700 flex items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-center gap-2.5">
                <i data-lucide="book-open" class="w-4 h-4 text-brand-600 shrink-0"></i>
                <div>
                    <span class="font-bold text-charcoal-900" x-text="activeTheme?.name + ':'"></span>
                    <span>Kisah cinta disajikan dalam format timeline narasi teks yang elegan & rapi.</span>
                </div>
            </div>
            <span class="px-2 py-0.5 rounded-md bg-white border border-sand-200 text-sand-600 text-[10px] font-bold uppercase tracking-wider shrink-0">Format Narasi</span>
        </div>
    </template> -->

    <!-- QUICK STORY PRESET BUTTONS -->
    <div class="flex items-center justify-between gap-2 flex-wrap pt-1">
        <span class="text-[11px] font-bold text-sand-600 uppercase tracking-wider">Isi Cepat Template Kisah:</span>
        <div class="flex items-center gap-1.5 flex-wrap">
            <button 
                type="button" 
                @click="
                    stories = [
                        { title: 'Pertemuan Pertama', date: 'Tahun 2021', story: 'Pertama kali kami dipertemukan dalam sebuah acara bersama, obrolan hangat membuka kisah indah kami.', existing_image: null, imagePreview: null },
                        { title: 'Menjalin Kasih', date: 'Tahun 2023', story: 'Setelah saling memahami dan bertumbuh bersama, kami memutuskan untuk mengikat komitmen kasih.', existing_image: null, imagePreview: null },
                        { title: 'Hari Lamaran', date: 'Desember 2025', story: 'Di hadapan keluarga besar tercinta, kami mengikat janji suci untuk melangkah ke jenjang pernikahan.', existing_image: null, imagePreview: null },
                    ];
                "
                class="px-2.5 py-1 rounded-lg bg-sand-100 hover:bg-sand-200 text-charcoal-800 text-[11px] font-semibold border border-sand-200 transition cursor-pointer"
            >
                ✨ Kisah Romantis
            </button>

            <button 
                type="button" 
                @click="
                    stories = [
                        { title: 'Pitepangan (Awal Jumpa)', date: 'Wulan Sura 2021', story: 'Pinanggih wonten ing satunggaling papan, miwiti pitepangan kanthi manah ingkang tulus.', existing_image: null, imagePreview: null },
                        { title: 'Lamaran & Pasang Tarub', date: 'Desember 2025', story: 'Kanthi donga pangestu saking tiyang sepuh kekalih, kaleksanan adicara lamaran resmi.', existing_image: null, imagePreview: null },
                        { title: 'Dhaup Suci (Pernikahan)', date: 'Oktober 2026', story: 'Kanthi ridhonipun Gusti Kang Maha Agung, sumadya hanetepi darmaning agesang ing salebeting bebrajan.', existing_image: null, imagePreview: null },
                    ];
                "
                class="px-2.5 py-1 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-900 text-[11px] font-semibold border border-amber-200 transition cursor-pointer"
            >
                🏛️ Kisah Adat Jawa
            </button>
        </div>
    </div>

    <div class="space-y-4">
        <template x-for="(story, index) in stories" :key="index">
            <div class="p-4 sm:p-5 rounded-2xl bg-sand-50/80 border border-sand-200 space-y-3 relative group">
                <div class="flex items-center justify-between border-b border-sand-200/80 pb-2">
                    <span class="text-xs font-bold text-charcoal-900 flex items-center gap-1.5">
                        <span class="w-5 h-5 rounded-full bg-brand-500 text-white flex items-center justify-center text-[10px]" x-text="index + 1"></span>
                        <span x-text="'Momen #' + (index + 1)"></span>
                    </span>

                    <button 
                        type="button" 
                        @click="stories.splice(index, 1)" 
                        x-show="stories.length > 1"
                        class="text-rose-500 hover:text-rose-700 text-xs font-semibold flex items-center gap-1 transition"
                    >
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                        <span>Hapus</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-charcoal-900">Judul Momen</label>
                        <input 
                            type="text" 
                            :name="'stories[' + index + '][title]'" 
                            x-model="story.title"
                            placeholder="Contoh: Pertama Kali Bertemu / Hari Lamaran" 
                            class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                        >
                    </div>

                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-charcoal-900">Tahun / Waktu</label>
                        <input 
                            type="text" 
                            :name="'stories[' + index + '][date]'" 
                            x-model="story.date"
                            placeholder="Contoh: 14 Februari 2020 / Musim Gugur 2021" 
                            class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                        >
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-[11px] font-bold text-charcoal-900">Cerita / Narasi</label>
                    <textarea 
                        :name="'stories[' + index + '][story]'" 
                        x-model="story.story"
                        rows="2" 
                        placeholder="Ceritakan sedikit kenangan manis pada momen ini..." 
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    ></textarea>
                </div>

                <!-- STORY PHOTO UPLOAD (IF THEME SUPPORTS) -->
                <div x-show="themeSupportsStoryImages()" class="pt-2 border-t border-sand-200/60 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-sand-200 border border-sand-300 overflow-hidden shrink-0 flex items-center justify-center">
                        <template x-if="story.imagePreview || story.existing_image">
                            <img :src="story.imagePreview || story.existing_image" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!story.imagePreview && !story.existing_image">
                            <i data-lucide="image" class="w-5 h-5 text-sand-400"></i>
                        </template>
                    </div>

                    <div class="flex-1">
                        <input 
                            type="file" 
                            :name="'stories[' + index + '][image_file]'" 
                            accept="image/*"
                            @change="
                                const file = $event.target.files[0];
                                if(file) {
                                    convertToWebP(file).then(webp => {
                                        story.imagePreview = URL.createObjectURL(webp);
                                    });
                                }
                            "
                            class="w-full text-xs text-sand-600 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-sand-200 file:text-charcoal-900 hover:file:bg-sand-300 cursor-pointer"
                        >
                        <input type="hidden" :name="'stories[' + index + '][existing_image]'" :value="story.existing_image">
                    </div>
                </div>
            </div>
        </template>

        <!-- CARD KOSONG BORDER PUTUS-PUTUS UNTUK TAMBAH MOMEN -->
        <button 
            type="button" 
            @click="stories.push({ title: '', date: '', story: '', existing_image: null, imagePreview: null })"
            class="w-full py-6 px-4 rounded-2xl border-2 border-dashed border-sand-300 hover:border-brand-500 bg-sand-50/40 hover:bg-brand-500/5 transition-all group flex flex-col items-center justify-center gap-2 text-sand-500 hover:text-brand-800 cursor-pointer"
        >
            <div class="w-10 h-10 rounded-2xl bg-white border border-sand-200 group-hover:border-brand-300 group-hover:bg-brand-500 group-hover:text-white text-charcoal-800 flex items-center justify-center transition-all shadow-xs">
                <i data-lucide="plus" class="w-5 h-5"></i>
            </div>
            <div class="text-center">
                <span class="text-xs font-bold block text-charcoal-900 group-hover:text-brand-900">Tambah Babak Kisah / Momen Baru</span>
                <span class="text-[11px] text-sand-500 group-hover:text-brand-700">Klik di sini untuk menambahkan momen perjalanan cinta berikutnya</span>
            </div>
        </button>
    </div>
</div>
