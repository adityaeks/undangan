<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo Studio &amp; Kustomisasi Undangan — KlikMomen</title>

    <!-- Meta SEO -->
    <meta name="description" content="Coba dan kustomisasi langsung tema undangan digital pernikahan impian Anda. Pilih template, masukkan nama mempelai, dan lihat preview instan di layar.">
    <meta name="keywords" content="demo undangan digital, template pernikahan, live preview undangan, kustomisasi undangan online, klikmomen">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                        editorial: ['"Cormorant Garamond"', 'serif'],
                    },
                    colors: {
                        brand: {
                            50: '#FAF8F5',
                            100: '#F4EFE6',
                            200: '#E9DFC9',
                            300: '#D8C7A5',
                            400: '#C2AA7D',
                            500: '#A68D5C',
                            600: '#8A7245',
                            700: '#6C5834',
                            800: '#4D3E24',
                            900: '#2F2616',
                            950: '#1A150C',
                        },
                        sand: {
                            50: '#FCFBF9',
                            100: '#F8F6F1',
                            200: '#EFECE3',
                            300: '#DFDAD0',
                            400: '#B8B1A4',
                            500: '#8E8678',
                        },
                        charcoal: {
                            800: '#22201D',
                            900: '#181715',
                            950: '#11100E',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .font-editorial { font-family: 'Cormorant Garamond', serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Custom scrollbars */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #F8F6F1;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #DFDAD0;
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #B8B1A4;
        }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body 
    class="h-full bg-sand-100 text-charcoal-900 font-sans antialiased overflow-hidden flex flex-col selection:bg-brand-200 selection:text-charcoal-950"
    x-data="studioApp()"
>

    <!-- ========================================================================= -->
    <!-- TOP NAVIGATION BAR -->
    <!-- ========================================================================= -->
    <header class="h-16 bg-white border-b border-sand-200/90 px-4 sm:px-6 flex items-center justify-between z-30 shrink-0 shadow-sm">
        <div class="flex items-center gap-4">
            <!-- BRAND LOGO -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 rounded-lg bg-charcoal-950 flex items-center justify-center text-brand-300 font-serif font-bold text-base shadow-sm group-hover:bg-brand-600 transition">
                    K
                </div>
                <div class="flex flex-col">
                    <span class="font-serif text-lg font-bold tracking-tight text-charcoal-950 flex items-center">
                        KlikMomen<span class="text-brand-500">.</span>
                    </span>
                </div>
            </a>

            <!-- STUDIO BADGE -->
            <div class="hidden sm:inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100/70 border border-brand-200 text-brand-800 text-xs font-semibold">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Demo Studio Interaktif</span>
            </div>
        </div>

        <!-- RIGHT HEADER LINKS & CTA -->
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" class="hidden md:inline-flex items-center gap-1 text-xs font-semibold text-sand-500 hover:text-charcoal-950 transition px-2.5 py-1.5">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                <span>Beranda</span>
            </a>

            <a href="{{ route('themes.catalog') }}" class="hidden md:inline-flex items-center gap-1 text-xs font-semibold text-sand-500 hover:text-charcoal-950 transition px-2.5 py-1.5">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-brand-600"></i>
                <span>Katalog Tema</span>
            </a>

            <!-- CTA BUTTON -->
            <a 
                :href="registerUrl" 
                class="px-5 py-2 rounded-full bg-charcoal-950 hover:bg-brand-600 text-white font-bold text-xs shadow-sm hover:shadow transition flex items-center gap-2"
            >
                <i data-lucide="check" class="w-3.5 h-3.5 text-brand-400"></i>
                <span>Gunakan Desain Ini</span>
            </a>
        </div>
    </header>

    <!-- ========================================================================= -->
    <!-- MAIN WORKSPACE: SPLIT-SCREEN (LEFT: EDITOR / RIGHT: PREVIEW) -->
    <!-- ========================================================================= -->
    <main class="flex-1 flex flex-col lg:flex-row overflow-hidden relative">

        <!-- ===================================================================== -->
        <!-- LEFT PANEL: TEMPLATE PICKER & LIVE CUSTOMIZER FORM -->
        <!-- ===================================================================== -->
        <aside class="w-full lg:w-[480px] xl:w-[520px] bg-white border-r border-sand-200/90 flex flex-col shrink-0 h-[48vh] lg:h-full z-20 shadow-sm">
            
            <!-- PANEL SUBHEADER -->
            <!-- <div class="px-6 py-4 border-b border-sand-200/80 bg-sand-50/70 flex items-center justify-between shrink-0">
                <div class="space-y-0.5">
                    <h2 class="font-serif text-base font-bold text-charcoal-950 flex items-center gap-1.5">
                        <i data-lucide="sliders-horizontal" class="w-4 h-4 text-brand-600"></i>
                        <span>Kustomisasi Undangan</span>
                    </h2>
                    <p class="text-[11px] text-sand-500">
                        Pilih template dan ketik data untuk melihat preview live.
                    </p>
                </div>

                <span class="text-[11px] font-bold text-emerald-700 bg-emerald-100/70 border border-emerald-200/80 px-2.5 py-0.5 rounded-full">
                    Live Sync Aktif
                </span>
            </div> -->

            <!-- SCROLLABLE EDITOR CONTAINER -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-6 space-y-8">

                <!-- 1. TEMPLATE PICKER SECTION -->
                <section class="space-y-3.5">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal-950 flex items-center gap-1.5">
                            <span class="w-5 h-5 rounded-full bg-brand-500 text-white flex items-center justify-center text-[10px] font-bold">1</span>
                            <span>Pilih Template Tema ({{ count($themes) }})</span>
                        </label>
                        <a href="{{ route('themes.catalog') }}" target="_blank" class="text-[11px] font-semibold text-brand-600 hover:underline">
                            Lihat Semua &rarr;
                        </a>
                    </div>

                    <!-- TEMPLATE HORIZONTAL / COMPACT GRID -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <template x-for="t in themes" :key="t.id">
                            <button 
                                type="button"
                                @click="selectTheme(t.id)"
                                :class="selectedThemeId === t.id ? 'border-brand-500 ring-2 ring-brand-500/20 bg-brand-50/40 shadow-sm' : 'border-sand-200 hover:border-sand-400 bg-white'"
                                class="text-left p-3 rounded-2xl border transition-all duration-200 flex gap-3 group relative cursor-pointer"
                            >
                                <!-- THUMBNAIL -->
                                <div class="w-14 h-16 rounded-xl overflow-hidden bg-sand-200 shrink-0 relative">
                                    <img :src="t.thumbnail" :alt="t.name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>

                                <!-- META -->
                                <div class="flex-1 min-w-0 flex flex-col justify-between py-0.5">
                                    <div>
                                        <div class="flex items-center justify-between gap-1">
                                            <span class="text-[10px] font-semibold text-sand-500 truncate" x-text="t.category_label"></span>
                                            <span 
                                                x-show="selectedThemeId === t.id" 
                                                class="w-4 h-4 rounded-full bg-brand-500 text-white flex items-center justify-center shrink-0"
                                            >
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </span>
                                        </div>
                                        <h4 class="font-serif text-xs font-bold text-charcoal-950 truncate" x-text="t.name"></h4>
                                    </div>
                                    <div class="flex items-center justify-between pt-1">
                                        <span class="text-[11px] font-bold text-charcoal-950" x-text="t.price"></span>
                                        <span class="text-[9px] uppercase tracking-wider font-bold px-1.5 py-0.5 rounded bg-sand-200/80 text-charcoal-800" x-text="t.tag"></span>
                                    </div>
                                </div>
                            </button>
                        </template>
                    </div>
                </section>

                <hr class="border-sand-200">

                <!-- 2. LIVE FORM CUSTOMIZER SECTION -->
                <section class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-bold uppercase tracking-wider text-charcoal-950 flex items-center gap-1.5">
                            <span class="w-5 h-5 rounded-full bg-brand-500 text-white flex items-center justify-center text-[10px] font-bold">2</span>
                            <span>Isi Data Undangan</span>
                        </label>

                        <!-- QUICK PRESET BUTTONS -->
                        <div class="flex items-center gap-1.5">
                            <button 
                                type="button"
                                @click="usePresetRakaArinda()" 
                                class="text-[10px] px-2 py-1 rounded bg-sand-200/80 hover:bg-sand-300 text-charcoal-900 font-medium transition cursor-pointer"
                                title="Gunakan contoh data Raka & Arinda"
                            >
                                Contoh 1
                            </button>
                            <button 
                                type="button"
                                @click="usePresetRyanVanya()" 
                                class="text-[10px] px-2 py-1 rounded bg-sand-200/80 hover:bg-sand-300 text-charcoal-900 font-medium transition cursor-pointer"
                                title="Gunakan contoh data Ryan & Vanya"
                            >
                                Contoh 2
                            </button>
                            <button 
                                type="button"
                                @click="clearForm()" 
                                class="text-[10px] px-2 py-1 rounded text-sand-500 hover:text-charcoal-950 transition cursor-pointer"
                                title="Kosongkan data"
                            >
                                Reset
                            </button>
                        </div>
                    </div>

                    <!-- FORM FIELDS -->
                    <div class="space-y-3.5">
                        <!-- COUPLE NICKNAMES (COVER & HEADINGS) -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="space-y-1">
                                <label class="text-[11px] font-semibold text-sand-600">Panggilan Pria</label>
                                <input 
                                    type="text" 
                                    x-model="form.groomNickname" 
                                    @input="sendLiveUpdate()" 
                                    placeholder="Contoh: Raka"
                                    class="w-full px-3 py-2 text-xs rounded-xl border border-sand-300 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-sand-50/50 outline-none transition"
                                >
                            </div>
                            <div class="space-y-1">
                                <label class="text-[11px] font-semibold text-sand-600">Panggilan Wanita</label>
                                <input 
                                    type="text" 
                                    x-model="form.brideNickname" 
                                    @input="sendLiveUpdate()" 
                                    placeholder="Contoh: Arinda"
                                    class="w-full px-3 py-2 text-xs rounded-xl border border-sand-300 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-sand-50/50 outline-none transition"
                                >
                            </div>
                        </div>

                        <!-- GUEST NAME (KEPADA YTH) -->
                        <div class="space-y-1">
                            <label class="text-[11px] font-semibold text-sand-600 flex items-center justify-between">
                                <span>Tamu Penerima (Kepada Yth)</span>
                                <span class="text-[10px] text-sand-400 font-normal">Tampil di amplop &amp; cover</span>
                            </label>
                            <input 
                                type="text" 
                                x-model="form.guestName" 
                                @input="sendLiveUpdate()" 
                                placeholder="Contoh: Reyhan"
                                class="w-full px-3 py-2 text-xs rounded-xl border border-sand-300 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-sand-50/50 outline-none transition"
                            >
                        </div>

                        <!-- EVENT DATE -->
                        <div class="space-y-1">
                            <label class="text-[11px] font-semibold text-sand-600 flex items-center justify-between">
                                <span>Hari &amp; Tanggal Acara</span>
                                <span class="text-[10px] text-brand-700 bg-brand-50 px-2 py-0.5 rounded font-medium">Akad Nikah &amp; Resepsi Pernikahan</span>
                            </label>
                            <input 
                                type="text" 
                                x-model="form.eventDate" 
                                @input="sendLiveUpdate()" 
                                placeholder="Contoh: Sabtu, 24 Oktober 2026"
                                class="w-full px-3 py-2 text-xs rounded-xl border border-sand-300 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-sand-50/50 outline-none transition"
                            >
                        </div>

                        <!-- FULL GROOM & BRIDE NAMES -->
                        <div class="space-y-1">
                            <label class="text-[11px] font-semibold text-sand-600">Nama Lengkap Mempelai Pria</label>
                            <input 
                                type="text" 
                                x-model="form.groomName" 
                                @input="sendLiveUpdate()" 
                                placeholder="Contoh: Raka Pratama, S.T."
                                class="w-full px-3 py-2 text-xs rounded-xl border border-sand-300 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-sand-50/50 outline-none transition"
                            >
                        </div>

                        <div class="space-y-1">
                            <label class="text-[11px] font-semibold text-sand-600">Nama Lengkap Mempelai Wanita</label>
                            <input 
                                type="text" 
                                x-model="form.brideName" 
                                @input="sendLiveUpdate()" 
                                placeholder="Contoh: Arinda Putri Larasati, S.I.Kom"
                                class="w-full px-3 py-2 text-xs rounded-xl border border-sand-300 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-sand-50/50 outline-none transition"
                            >
                        </div>

                        <!-- VENUE LOCATION -->
                        <div class="space-y-1">
                            <label class="text-[11px] font-semibold text-sand-600">Lokasi / Gedung Acara</label>
                            <input 
                                type="text" 
                                x-model="form.venueName" 
                                @input="sendLiveUpdate()" 
                                placeholder="Contoh: Grand Ballroom The Ritz-Carlton, Jakarta"
                                class="w-full px-3 py-2 text-xs rounded-xl border border-sand-300 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-sand-50/50 outline-none transition"
                            >
                        </div>

                        <!-- KISAH PERJALANAN (LOVE STORY TIMELINE) -->
                        <div class="pt-4 border-t border-sand-200/90 space-y-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-xs font-bold text-charcoal-950 flex items-center gap-1.5">
                                        <i data-lucide="book-heart" class="w-3.5 h-3.5 text-brand-600"></i>
                                        <span>Kisah Perjalanan (Love Story)</span>
                                    </h4>
                                    <p class="text-[10px] text-sand-500">Timeline cerita cinta yang tampil di undangan</p>
                                </div>
                                <button 
                                    type="button" 
                                    @click="addStory()" 
                                    x-show="form.stories.length < 6"
                                    class="text-[10px] px-2 py-1 rounded-lg bg-sand-200 hover:bg-brand-50 hover:text-brand-800 text-charcoal-800 font-semibold flex items-center gap-1 transition cursor-pointer"
                                    title="Tambah Momen Cerita Baru"
                                >
                                    <i data-lucide="plus" class="w-3 h-3"></i>
                                    <span>Tambah</span>
                                </button>
                            </div>

                            <!-- STORY MILESTONES CARDS -->
                            <div class="space-y-3">
                                <template x-for="(story, index) in form.stories" :key="index">
                                    <div class="p-3 rounded-2xl bg-white border border-sand-200 shadow-xs space-y-2.5 transition hover:border-brand-400">
                                        <div class="flex items-center justify-between pb-1.5 border-b border-sand-100">
                                            <div class="flex items-center gap-1.5">
                                                <span class="w-4 h-4 rounded-full bg-brand-50 text-brand-700 font-mono text-[10px] font-bold flex items-center justify-center" x-text="index + 1"></span>
                                                <span class="text-[11px] font-bold text-charcoal-900" x-text="'Cerita #' + (index + 1)"></span>
                                            </div>
                                            <button 
                                                type="button" 
                                                @click="removeStory(index)" 
                                                x-show="form.stories.length > 1"
                                                class="text-sand-400 hover:text-rose-600 p-0.5 rounded transition cursor-pointer"
                                                title="Hapus Cerita Ini"
                                            >
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </div>

                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="space-y-1">
                                                <label class="text-[10px] font-medium text-sand-600">Waktu / Tahun</label>
                                                <input 
                                                    type="text" 
                                                    x-model="story.year" 
                                                    @input="sendLiveUpdate()" 
                                                    placeholder="Contoh: Agustus 2020"
                                                    class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-sand-300 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-sand-50/50 outline-none transition"
                                                >
                                            </div>
                                            <div class="space-y-1">
                                                <label class="text-[10px] font-medium text-sand-600">Judul Momen</label>
                                                <input 
                                                    type="text" 
                                                    x-model="story.title" 
                                                    @input="sendLiveUpdate()" 
                                                    placeholder="Contoh: Pertemuan Pertama"
                                                    class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-sand-300 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-sand-50/50 outline-none transition"
                                                >
                                            </div>
                                        </div>

                                        <div class="space-y-1">
                                            <label class="text-[10px] font-medium text-sand-600">Isi Cerita Singkat</label>
                                            <textarea 
                                                x-model="story.desc" 
                                                @input="sendLiveUpdate()" 
                                                rows="2"
                                                placeholder="Tuliskan kisah perjalanan cinta Anda..."
                                                class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-sand-300 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-sand-50/50 outline-none transition resize-none"
                                            ></textarea>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            <!-- PANEL FOOTER: PRICE & STICKY CTA -->
            <div class="p-4 border-t border-sand-200 bg-white space-y-3 shrink-0">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-[10px] uppercase tracking-wider text-sand-500 block font-semibold">Tema Terpilih:</span>
                        <h4 class="font-serif text-sm font-bold text-charcoal-950 truncate max-w-[220px]" x-text="currentTheme.name"></h4>
                    </div>
                    <div class="text-right">
                        <span class="font-serif text-lg font-bold text-charcoal-950" x-text="currentTheme.price"></span>
                        <span class="text-[10px] text-emerald-700 block font-semibold">Aktif Selamanya</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <a 
                        :href="standaloneUrl" 
                        target="_blank" 
                        class="py-2.5 px-3 rounded-xl border border-sand-300 hover:bg-sand-100 text-charcoal-950 text-xs font-semibold flex items-center justify-center gap-1.5 transition text-center"
                    >
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        <span>Buka Layar Penuh</span>
                    </a>

                    <a 
                        :href="registerUrl" 
                        class="py-2.5 px-3 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white text-xs font-bold flex items-center justify-center gap-1.5 transition text-center shadow-md hover:shadow"
                    >
                        <span>Gunakan Tema Ini</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </div>

        </aside>

        <!-- ===================================================================== -->
        <!-- RIGHT PANEL: LIVE RESPONSIVE PREVIEW CANVAS -->
        <!-- ===================================================================== -->
        <section class="flex-1 flex flex-col h-[52vh] lg:h-full bg-sand-200/50 overflow-hidden relative">            <!-- PREVIEW CANVAS TOOLBAR -->
            <div class="h-12 bg-white/95 backdrop-blur-md border-b border-sand-300/70 px-3 sm:px-6 flex items-center justify-between shrink-0 z-10 gap-2">
                <!-- THEME INFO -->
                <div class="flex items-center gap-2 min-w-0">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
                    <span class="font-serif text-xs font-bold text-charcoal-950 truncate" x-text="currentTheme.name"></span>
                    <span class="hidden md:inline-block text-[10px] text-sand-500 font-mono shrink-0" x-text="'(' + currentTheme.tag + ')'"></span>
                </div>

                <!-- CONTROLS: ZOOM TOOLBAR -->
                <div class="flex items-center gap-1.5 sm:gap-2">
                    <!-- ZOOM CONTROLS (- / + / Fit) -->
                    <div class="flex items-center bg-sand-200/80 p-1 rounded-xl gap-0.5">
                        <button 
                            type="button" 
                            @click="zoomOut()" 
                            class="w-7 h-7 rounded-lg hover:bg-white text-charcoal-700 hover:text-charcoal-950 flex items-center justify-center transition cursor-pointer disabled:opacity-30 disabled:pointer-events-none"
                            :disabled="zoomLevel <= 30"
                            title="Perkecil Zoom (-10%)"
                        >
                            <i data-lucide="minus" class="w-3.5 h-3.5"></i>
                        </button>

                        <button 
                            type="button" 
                            @click="fitToScreen()" 
                            class="px-1.5 h-7 rounded-lg hover:bg-white text-charcoal-900 font-mono font-bold text-[11px] flex items-center justify-center transition cursor-pointer min-w-[42px]"
                            title="Klik untuk Fit ke Layar"
                        >
                            <span x-text="zoomLevel + '%'"></span>
                        </button>

                        <button 
                            type="button" 
                            @click="zoomIn()" 
                            class="w-7 h-7 rounded-lg hover:bg-white text-charcoal-700 hover:text-charcoal-950 flex items-center justify-center transition cursor-pointer disabled:opacity-30 disabled:pointer-events-none"
                            :disabled="zoomLevel >= 150"
                            title="Perbesar Zoom (+10%)"
                        >
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                        </button>

                        <button 
                            type="button" 
                            @click="fitToScreen()" 
                            class="hidden sm:flex items-center gap-1 px-2 h-7 rounded-lg hover:bg-white text-charcoal-700 hover:text-charcoal-950 text-xs font-semibold transition cursor-pointer ml-0.5"
                            title="Sesuaikan dengan Seluruh Layar HP"
                        >
                            <i data-lucide="maximize-2" class="w-3 h-3"></i>
                            <span>Fit</span>
                        </button>
                    </div>
                </div>

                <!-- RELOAD & EXPAND -->
                <div class="flex items-center gap-1 shrink-0">
                    <button 
                        type="button" 
                        @click="reloadIframe()" 
                        class="w-8 h-8 rounded-lg hover:bg-sand-200 text-charcoal-800 flex items-center justify-center transition cursor-pointer"
                        title="Segarkan / Muat Ulang Preview"
                    >
                        <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                    </button>

                    <a 
                        :href="standaloneUrl" 
                        target="_blank" 
                        class="w-8 h-8 rounded-lg hover:bg-sand-200 text-charcoal-800 flex items-center justify-center transition"
                        title="Buka Preview di Tab Baru"
                    >
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </div>

            <!-- CANVAS WORKSPACE (CENTERS DEVICE MOCKUP WITH PROPORTIONAL SCALING) -->
            <div 
                x-ref="canvasContainer"
                @resize.window.debounce.150ms="fitToScreen()"
                class="flex-1 overflow-auto no-scrollbar p-3 sm:p-6 relative bg-[#EFECE3]/60 flex items-center justify-center"
            >
                <!-- BACKGROUND AMBIENT GLOW -->
                <div class="absolute w-[500px] h-[500px] rounded-full bg-brand-300/20 blur-3xl pointer-events-none top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>

                <!-- SIZING WRAPPER: Matches scaled visual footprint so the whole device fits without scrollbar or clipping -->
                <div 
                    class="transition-[width,height] duration-200 ease-out relative flex items-center justify-center shrink-0 my-auto"
                    :style="`width: ${Math.round(deviceDims.w * (zoomLevel / 100))}px; height: ${Math.round(deviceDims.h * (zoomLevel / 100))}px;`"
                >
                    <!-- SCALED CONTAINER -->
                    <div 
                        :style="`width: ${deviceDims.w}px; height: ${deviceDims.h}px; transform: scale(${zoomLevel / 100}); transform-origin: top left;`"
                        class="absolute top-0 left-0 transition-transform duration-200 ease-out"
                    >
                        <!-- DEVICE FRAME CONTAINER (FIXED GEOMETRY, NEVER SQUASHED) -->
                        <div 
                            style="width: 100%; height: 100%;"
                            :class="{
                                'rounded-[50px] p-3.5 bg-charcoal-950 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.4)] border-4 border-charcoal-800 ring-1 ring-white/20': device === 'mobile',
                                'rounded-[36px] p-4 bg-charcoal-950 shadow-2xl border-4 border-charcoal-800': device === 'tablet',
                                'rounded-2xl p-2 bg-charcoal-950 shadow-2xl border-2 border-charcoal-800': device === 'desktop'
                            }"
                            class="relative flex flex-col w-full h-full"
                        >
                            <!-- DYNAMIC ISLAND / CAMERA NOTCH (MOBILE ONLY) -->
                            <div 
                                x-show="device === 'mobile'" 
                                class="absolute top-5 left-1/2 -translate-x-1/2 w-28 h-5 bg-charcoal-950 rounded-full z-30 pointer-events-none flex items-center justify-between px-3"
                            >
                                <span class="w-2.5 h-2.5 rounded-full bg-charcoal-900 border border-white/10"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-[#1e2338]"></span>
                            </div>

                            <!-- INNER SCREEN -->
                            <div 
                                :class="{
                                    'rounded-[36px]': device === 'mobile',
                                    'rounded-[24px]': device === 'tablet',
                                    'rounded-xl': device === 'desktop'
                                }"
                                class="w-full h-full overflow-hidden bg-white relative"
                            >
                                <!-- LOADING OVERLAY -->
                                <div 
                                    x-show="iframeLoading" 
                                    x-transition.opacity
                                    class="absolute inset-0 bg-sand-50/90 backdrop-blur-sm z-20 flex flex-col items-center justify-center gap-3"
                                >
                                    <div class="w-8 h-8 rounded-full border-3 border-brand-500 border-t-transparent animate-spin"></div>
                                    <span class="text-xs font-semibold text-charcoal-800">Memuat Tema Undangan...</span>
                                </div>

                                <!-- LIVE PREVIEW IFRAME -->
                                <iframe 
                                    x-ref="previewIframe"
                                    :src="previewSrc" 
                                    @load="onIframeLoad()"
                                    class="w-full h-full border-0 bg-white no-scrollbar"
                                    style="scrollbar-width: none; -ms-overflow-style: none;"
                                    title="Interactive Invitation Preview"
                                ></iframe>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </section>

    <script>
        function studioApp() {
            return {
                themes: @json($themes),
                selectedThemeId: '{{ $selectedThemeSlug }}',
                device: 'mobile', // 'mobile' | 'tablet' | 'desktop'
                iframeLoading: false,

                form: {
                    groomNickname: '{{ $defaultData['groom_nickname'] }}',
                    brideNickname: '{{ $defaultData['bride_nickname'] }}',
                    groomName: '{{ $defaultData['groom_name'] }}',
                    brideName: '{{ $defaultData['bride_name'] }}',
                    guestName: '{{ $defaultData['guest_name'] }}',
                    eventDate: '{{ $defaultData['event_date'] }}',
                    venueName: '{{ $defaultData['venue_name'] }}',
                    stories: @json($defaultData['stories'] ?? [])
                },

                get currentTheme() {
                    return this.themes.find(t => t.id === this.selectedThemeId) || this.themes[0];
                },

                previewSrc: '{{ route('demo.show', ['slug' => $selectedThemeSlug, 'embed' => 1]) }}',

                buildThemeUrl(themeId, bustCache = false) {
                    const params = new URLSearchParams({
                        embed: '1',
                        to: this.form.guestName,
                        groom_nickname: this.form.groomNickname,
                        bride_nickname: this.form.brideNickname,
                        groom_name: this.form.groomName,
                        bride_name: this.form.brideName,
                        date: this.form.eventDate,
                        venue: this.form.venueName
                    });
                    if (bustCache) {
                        params.set('_t', Date.now());
                    }
                    return '/demo/' + themeId + '?' + params.toString();
                },

                get standaloneUrl() {
                    const params = new URLSearchParams({
                        to: this.form.guestName,
                        groom_nickname: this.form.groomNickname,
                        bride_nickname: this.form.brideNickname,
                        groom_name: this.form.groomName,
                        bride_name: this.form.brideName,
                        date: this.form.eventDate,
                        venue: this.form.venueName
                    });
                    return '/demo/' + this.selectedThemeId + '?' + params.toString();
                },

                get registerUrl() {
                    return '{{ route('register') }}' + '?theme=' + encodeURIComponent(this.selectedThemeId);
                },

                init() {
                    window.addEventListener('message', (event) => {
                        if (event.data && event.data.type === 'KLIKMOMEN_DEMO_READY') {
                            this.sendLiveUpdate();
                        }
                    });

                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                        setTimeout(() => this.fitToScreen(), 50);
                        setTimeout(() => this.fitToScreen(), 250);
                    });
                },

                selectTheme(themeId) {
                    if (this.selectedThemeId === themeId) return;
                    this.selectedThemeId = themeId;
                    this.iframeLoading = true;
                    this.previewSrc = this.buildThemeUrl(themeId);
                },

                reloadIframe() {
                    this.iframeLoading = true;
                    this.previewSrc = this.buildThemeUrl(this.selectedThemeId, true);
                },

                onIframeLoad() {
                    this.iframeLoading = false;
                    this.sendLiveUpdate();
                    setTimeout(() => this.sendLiveUpdate(), 60);
                    setTimeout(() => this.sendLiveUpdate(), 200);
                },

                sendLiveUpdate() {
                    if (!this.$refs.previewIframe || !this.$refs.previewIframe.contentWindow) return;
                    try {
                        const payload = JSON.parse(JSON.stringify({
                            groomNickname: this.form.groomNickname,
                            brideNickname: this.form.brideNickname,
                            groomName: this.form.groomName,
                            brideName: this.form.brideName,
                            guestName: this.form.guestName,
                            eventDate: this.form.eventDate,
                            venueName: this.form.venueName,
                            stories: this.form.stories
                        }));
                        this.$refs.previewIframe.contentWindow.postMessage({
                            type: 'KLIKMOMEN_DEMO_UPDATE',
                            payload: payload
                        }, '*');
                    } catch (e) {
                        console.error('Error sending live update:', e);
                    }
                },

                addStory() {
                    if (this.form.stories.length >= 6) return;
                    this.form.stories.push({
                        year: 'Bulan / Tahun',
                        title: 'Judul Momen Bahagia',
                        desc: 'Tuliskan deskripsi cerita singkat perjalanan cinta Anda di sini.'
                    });
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                        this.sendLiveUpdate();
                    });
                },

                removeStory(index) {
                    if (this.form.stories.length <= 1) return;
                    this.form.stories.splice(index, 1);
                    this.$nextTick(() => {
                        this.sendLiveUpdate();
                    });
                },

                usePresetRakaArinda() {
                    this.form.groomNickname = 'Raka';
                    this.form.brideNickname = 'Arinda';
                    this.form.groomName = 'Raka Pratama, S.T.';
                    this.form.brideName = 'Arinda Putri Larasati, S.I.Kom';
                    this.form.guestName = 'Reyhan';
                    this.form.eventDate = 'Sabtu, 24 Oktober 2026';
                    this.form.venueName = 'Grand Ballroom The Ritz-Carlton, Jakarta';
                    this.form.stories = [
                        { year: 'Agustus 2020', title: 'Pertemuan Pertama', desc: 'Takdir mempertemukan kami di sebuah workshop desain dan arsitektur di Bandung. Berawal dari diskusi tugas dan obrolan secangkir kopi hangat.' },
                        { year: 'November 2022', title: 'Menjalin Komitmen', desc: 'Setelah dua tahun saling mengenal kepribadian dan berbagi mimpi, kami memutuskan untuk melangkah bersama dalam ikatan kasih yang tulus.' },
                        { year: 'Desember 2025', title: 'Hari Lamaran Resmi', desc: 'Di hadapan kedua keluarga besar, kami mengikat janji suci untuk melangkah ke jenjang pernikahan yang penuh berkah dan ridho Ilahi.' },
                        { year: 'Oktober 2026', title: 'Menuju Hari Bahagia', desc: 'Dengan penuh rasa syukur, kami siap menyatukan cinta dalam ikatan pernikahan kudus seumur hidup.' }
                    ];
                    this.sendLiveUpdate();
                },

                usePresetRyanVanya() {
                    this.form.groomNickname = 'Ryan';
                    this.form.brideNickname = 'Vanya';
                    this.form.groomName = 'Ryan Pratama, S.Kom.';
                    this.form.brideName = 'Vanya Citra Kirana, S.Ds.';
                    this.form.guestName = 'Dimas & Partner';
                    this.form.eventDate = 'Minggu, 15 November 2026';
                    this.form.venueName = 'Plataran Dharmawangsa, Jakarta Selatan';
                    this.form.stories = [
                        { year: 'November 2021', title: 'Awal Jumpa di Konservatori', desc: 'Takdir mempertemukan kami di sebuah workshop fotografi lanskap. Percakapan santai tentang sudut pandang kamera membuka pintu perkenalan yang hangat.' },
                        { year: 'Desember 2024', title: 'Mengikat Janji di Hadapan Keluarga', desc: 'Setelah bertumbuh bersama melewati berbagai cerita, Ryan melamar Vanya secara resmi dalam suasana hangat penuh doa restu kedua keluarga besar.' },
                        { year: 'Oktober 2026', title: 'Menuju Pelaminan Bahagia', desc: 'Hari yang kami nanti akhirnya tiba. Bersama kehadiran Anda sebagai saksi, kami mengucap janji suci pernikahan seumur hidup.' }
                    ];
                    this.sendLiveUpdate();
                },

                clearForm() {
                    this.form.groomNickname = 'Nama Pria';
                    this.form.brideNickname = 'Nama Wanita';
                    this.form.groomName = 'Nama Lengkap Pria, S.T.';
                    this.form.brideName = 'Nama Lengkap Wanita, S.I.Kom';
                    this.form.guestName = 'Tamu Undangan';
                    this.form.eventDate = 'Sabtu, 20 Desember 2026';
                    this.form.venueName = 'Gedung Pernikahan Impian';
                    this.form.stories = [
                        { year: 'Tahun 2020', title: 'Pertemuan Pertama', desc: 'Tuliskan kisah awal mula Anda dan pasangan pertama kali bertemu atau berkenalan.' },
                        { year: 'Tahun 2023', title: 'Menjalin Hubungan', desc: 'Tuliskan momen manis saat memutuskan untuk berkomitmen melangkah bersama.' },
                        { year: 'Tahun 2026', title: 'Menuju Pernikahan', desc: 'Tuliskan harapan dan doa menuju hari bahagia pernikahan suci Anda.' }
                    ];
                    this.sendLiveUpdate();
                },

                zoomLevel: 60,

                get deviceDims() {
                    if (this.device === 'mobile') return { w: 385, h: 780 };
                    if (this.device === 'tablet') return { w: 640, h: 820 };
                    return { w: 980, h: 820 };
                },

                setDevice(d) {
                    this.device = d;
                    this.$nextTick(() => {
                        this.fitToScreen();
                        if (window.lucide) window.lucide.createIcons();
                    });
                },

                zoomIn() {
                    this.zoomLevel = Math.min(150, this.zoomLevel + 10);
                },

                zoomOut() {
                    this.zoomLevel = Math.max(30, this.zoomLevel - 10);
                },

                resetZoom() {
                    this.zoomLevel = 100;
                },

                fitToScreen() {
                    const container = this.$refs.canvasContainer;
                    if (!container) return;
                    const availH = container.clientHeight - 40;
                    const availW = container.clientWidth - 40;
                    const dims = this.deviceDims;
                    if (availH <= 0 || availW <= 0) return;

                    const scaleH = availH / dims.h;
                    const scaleW = availW / dims.w;
                    const optimal = Math.min(scaleH, scaleW);
                    const pct = Math.round((optimal * 100) / 5) * 5;
                    this.zoomLevel = Math.max(30, Math.min(100, pct));
                }
            };
        }
    </script>
</body>
</html>
