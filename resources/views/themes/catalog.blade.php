<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Template Tema Undangan Digital - {{ config('app.name', 'KlikMomen') }}</title>

    <!-- Meta SEO -->
    <meta name="description" content="Jelajahi kumpulan template undangan pernikahan digital minimalis, editorial modern, botanical rustic, dan adat nusantara. Desain responsif, fitur RSVP realtime, amplop digital tanpa potongan.">
    <meta name="keywords" content="template undangan digital, katalog tema undangan, wedding invitation template, undangan online aesthetic, tema editorial modern, botanical rustic, adat nusantara">

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
        [x-cloak] { display: none !important; }
        .font-editorial { font-family: 'Cormorant Garamond', serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }

        .glass-panel {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(233, 223, 201, 0.6);
        }

        .glass-dark {
            background: rgba(24, 23, 21, 0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .gold-text-gradient {
            background: linear-gradient(135deg, #8A7245 0%, #C2AA7D 50%, #6C5834 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .gold-gradient-bg {
            background: linear-gradient(135deg, #C2AA7D 0%, #E9DFC9 50%, #A68D5C 100%);
        }
    </style>
</head>

<body 
    class="bg-sand-50 text-charcoal-900 font-sans antialiased selection:bg-brand-200 selection:text-charcoal-950 overflow-x-hidden min-h-screen flex flex-col justify-between"
    x-data="{
        mobileMenuOpen: false,
        searchQuery: '',
        selectedCategory: '{{ $currentCategory ?? 'all' }}',
        viewMode: 'grid',
        previewModalOpen: false,
        activePreviewTheme: null,
        previewDevice: 'mobile',
        activeFaq: null,
        themes: {{ Js::from($themes) }},

        orderModalOpen: false,
        selectedTheme: null,
        selectedDuration: '45_days',
        selectedServiceType: 'self_service',

        openPreview(theme) {
            this.activePreviewTheme = theme;
            this.previewDevice = 'mobile';
            this.previewModalOpen = true;
            document.body.style.overflow = 'hidden';
        },

        closePreview() {
            this.previewModalOpen = false;
            this.activePreviewTheme = null;
            document.body.style.overflow = 'auto';
        },

        openOrderModal(theme) {
            if (!theme) return;
            this.selectedTheme = theme;
            this.selectedDuration = '45_days';
            this.selectedServiceType = 'self_service';
            this.orderModalOpen = true;
            document.body.style.overflow = 'hidden';
            this.$nextTick(() => {
                if (window.lucide) {
                    lucide.createIcons();
                }
            });
        },

        closeOrderModal() {
            this.orderModalOpen = false;
            this.selectedTheme = null;
            document.body.style.overflow = 'auto';
        },

        getDurationPrice() {
            if (!this.selectedTheme) return 49000;
            return this.selectedDuration === 'lifetime' 
                ? (this.selectedTheme.raw_price_lifetime || 99000)
                : (this.selectedTheme.raw_price_45_days || 49000);
        },

        getAssistedPrice() {
            if (!this.selectedTheme || this.selectedServiceType !== 'assisted') return 0;
            return this.selectedTheme.raw_assisted_fee || 25000;
        },

        getTotalPrice() {
            return this.getDurationPrice() + this.getAssistedPrice();
        },

        formatCurrency(amount) {
            return 'Rp ' + Number(amount || 0).toLocaleString('id-ID');
        },

        getCheckoutUrl() {
            if (!this.selectedTheme) return '#';
            const baseUrl = this.selectedTheme.checkout_url;
            const sep = baseUrl.includes('?') ? '&' : '?';
            return `${baseUrl}${sep}duration=${this.selectedDuration}&service_type=${this.selectedServiceType}`;
        },

        matchesFilter(theme) {
            const matchCat = (this.selectedCategory === 'all' || theme.category === this.selectedCategory);
            const query = this.searchQuery.trim().toLowerCase();
            if (!query) return matchCat;

            const matchQuery = theme.name.toLowerCase().includes(query) ||
                theme.description.toLowerCase().includes(query) ||
                theme.category_label.toLowerCase().includes(query) ||
                theme.typography.toLowerCase().includes(query) ||
                theme.best_for.toLowerCase().includes(query);

            return matchCat && matchQuery;
        }
    }"
>

    <!-- TOP PROMO TICKER & MAIN NAVBAR -->
    @include('layouts.navbar')

    <!-- CATALOG HERO SECTION -->
    <section class="relative pt-12 pb-14 overflow-hidden border-b border-sand-200/80 bg-gradient-to-b from-brand-50/70 via-sand-50 to-sand-50">
        <!-- Ambient Decorative Blurs -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[360px] bg-gradient-to-tr from-brand-200/40 via-sand-200/40 to-brand-100/60 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            
            <!-- BADGE -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/95 border border-brand-300/80 shadow-sm text-xs font-semibold tracking-wide text-brand-700">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-brand-600"></i>
                <span>Koleksi Template Undangan Digital Eksklusif • Edisi 2026</span>
            </div>

            <!-- MAIN TITLE -->
            <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold text-charcoal-950 tracking-tight max-w-4xl mx-auto leading-[1.15]">
                Pilihan Arsitektur Tema Undangan <span class="gold-text-gradient italic">Elegan &amp; Stylist</span>
            </h1>

            <!-- SUBTITLE -->
            <p class="text-sm sm:text-base text-charcoal-900/70 max-w-2xl mx-auto leading-relaxed">
                Setiap template dirancang secara proporsional dengan tipografi editorial, responsif di seluruh layar ponsel, dilengkapi pemutar musik romantis, dan sistem RSVP interaktif.
            </p>

            <!-- SEARCH & CONTROLS TOOLBAR -->
            <div class="max-w-3xl mx-auto pt-4 space-y-4">
                
                <!-- LIVE SEARCH BAR -->
                <div class="relative flex items-center">
                    <div class="absolute left-4 pointer-events-none text-sand-500">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </div>
                    <input 
                        type="text" 
                        x-model="searchQuery" 
                        placeholder="Cari tema berdasarkan nama, nuansa (modern, sage, adat, editorial, batik)..." 
                        class="w-full pl-12 pr-10 py-3.5 rounded-2xl bg-white border border-sand-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 text-sm shadow-sm transition outline-none"
                    >
                    <button 
                        x-show="searchQuery.length > 0" 
                        @click="searchQuery = ''" 
                        class="absolute right-3.5 p-1 rounded-full text-sand-400 hover:text-charcoal-900"
                        title="Hapus pencarian"
                    >
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- CATEGORY PILLS & VIEW MODE SWITCHER -->
                <div class="flex flex-wrap items-center justify-between gap-3 pt-1">
                    
                    <!-- CATEGORIES -->
                    <div class="flex flex-wrap items-center gap-1.5 text-xs font-semibold bg-sand-200/70 p-1.5 rounded-2xl">
                        <button 
                            @click="selectedCategory = 'all'" 
                            :class="selectedCategory === 'all' ? 'bg-charcoal-950 text-white shadow-sm' : 'text-charcoal-900 hover:text-brand-700'"
                            class="px-4 py-2 rounded-xl transition-all duration-200 flex items-center gap-1.5">
                            <span>Semua Koleksi</span>
                            <span class="text-[10px] opacity-75">({{ count($themes) }})</span>
                        </button>
                        <button 
                            @click="selectedCategory = 'modern'" 
                            :class="selectedCategory === 'modern' ? 'bg-charcoal-950 text-white shadow-sm' : 'text-charcoal-900 hover:text-brand-700'"
                            class="px-4 py-2 rounded-xl transition-all duration-200 flex items-center gap-1.5">
                            <span>Editorial Modern</span>
                        </button>
                        <button 
                            @click="selectedCategory = 'botanical'" 
                            :class="selectedCategory === 'botanical' ? 'bg-charcoal-950 text-white shadow-sm' : 'text-charcoal-900 hover:text-brand-700'"
                            class="px-4 py-2 rounded-xl transition-all duration-200 flex items-center gap-1.5">
                            <span>Botanical Sage</span>
                        </button>
                        <button 
                            @click="selectedCategory = 'classic'" 
                            :class="selectedCategory === 'classic' ? 'bg-charcoal-950 text-white shadow-sm' : 'text-charcoal-900 hover:text-brand-700'"
                            class="px-4 py-2 rounded-xl transition-all duration-200 flex items-center gap-1.5">
                            <span>Nusantara Adat</span>
                        </button>
                        <button 
                            @click="selectedCategory = 'minimalist'" 
                            :class="selectedCategory === 'minimalist' ? 'bg-charcoal-950 text-white shadow-sm' : 'text-charcoal-900 hover:text-brand-700'"
                            class="px-4 py-2 rounded-xl transition-all duration-200 flex items-center gap-1.5">
                            <span>Warm Minimalist</span>
                        </button>
                        <button 
                            @click="selectedCategory = 'romantic'" 
                            :class="selectedCategory === 'romantic' ? 'bg-charcoal-950 text-white shadow-sm' : 'text-charcoal-900 hover:text-brand-700'"
                            class="px-4 py-2 rounded-xl transition-all duration-200 flex items-center gap-1.5">
                            <span>Rose Romance</span>
                        </button>
                        <button 
                            @click="selectedCategory = 'motion'" 
                            :class="selectedCategory === 'motion' ? 'bg-charcoal-950 text-white shadow-sm' : 'text-charcoal-900 hover:text-brand-700'"
                            class="px-4 py-2 rounded-xl transition-all duration-200 flex items-center gap-1.5">
                            <span>3D Motion</span>
                        </button>
                    </div>

                    <!-- VIEW MODE (GRID VS LIST) -->
                    <div class="hidden sm:flex items-center gap-1 bg-white p-1 rounded-xl border border-sand-300 text-xs">
                        <button 
                            @click="viewMode = 'grid'" 
                            :class="viewMode === 'grid' ? 'bg-sand-200 text-charcoal-950 font-bold' : 'text-sand-500 hover:text-charcoal-900'"
                            class="p-2 rounded-lg transition" 
                            title="Tampilan Grid">
                            <i data-lucide="layout-grid" class="w-4 h-4"></i>
                        </button>
                        <button 
                            @click="viewMode = 'list'" 
                            :class="viewMode === 'list' ? 'bg-sand-200 text-charcoal-950 font-bold' : 'text-sand-500 hover:text-charcoal-900'"
                            class="p-2 rounded-lg transition" 
                            title="Tampilan List">
                            <i data-lucide="rows" class="w-4 h-4"></i>
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- TEMPLATES LISTING SECTION -->
    <main class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex-1">
        
        <!-- TEMPLATES CONTAINER -->
        <div>
            
            <!-- GRID VIEW -->
            <div 
                x-show="viewMode === 'grid'" 
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
            >
                @foreach ($themes as $theme)
                    <div 
                        x-show="matchesFilter(themes.find(t => t.id === '{{ $theme['id'] }}'))" 
                        x-transition 
                        class="group rounded-3xl overflow-hidden glass-panel border border-sand-200 hover:border-brand-400 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col bg-white"
                    >
                        <!-- CARD TOP IMAGE WITH ACTION OVERLAY -->
                        <div class="relative aspect-[16/11] overflow-hidden bg-sand-200">
                            <img 
                                src="{{ $theme['thumbnail'] }}" 
                                alt="{{ $theme['name'] }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950/80 via-charcoal-950/20 to-transparent"></div>

                            <!-- BADGES -->
                            <div class="absolute top-4 left-4 right-4 flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full text-[10px] uppercase tracking-wider shadow {{ $theme['tag_badge_class'] }}">
                                    {{ $theme['tag'] }}
                                </span>
                                <span class="px-2.5 py-1 rounded-full bg-white/90 backdrop-blur-md text-emerald-800 text-[10px] font-bold shadow">
                                    {{ $theme['price'] }}
                                </span>
                            </div>

                            <!-- HOVER QUICK ACTIONS -->
                            <div class="absolute inset-0 bg-charcoal-950/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-2.5 p-4">
                                
                                <a 
                                    href="{{ $theme['demo_url'] }}" 
                                    target="_blank" 
                                    class="w-44 py-2.5 rounded-full bg-brand-500 text-white font-bold text-xs shadow-lg hover:bg-brand-600 hover:scale-105 active:scale-95 transition flex items-center justify-center gap-2"
                                >
                                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                    <span>Buka Demo</span>
                                </a>
                            </div>

                            <!-- COLOR PALETTE DOTS OVERLAY AT BOTTOM OF THUMBNAIL -->
                            <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between">
                                <div class="flex items-center gap-1.5 bg-charcoal-950/80 backdrop-blur-md px-2.5 py-1 rounded-full border border-white/10">
                                    <span class="text-[9px] text-sand-300 font-bold uppercase tracking-wider">Palet:</span>
                                    <div class="flex items-center -space-x-1">
                                        @foreach ($theme['colors'] as $color)
                                            <span 
                                                style="background-color: {{ $color['hex'] }};" 
                                                title="{{ $color['name'] }} ({{ $color['hex'] }})" 
                                                class="w-3.5 h-3.5 rounded-full border border-charcoal-950 shadow-sm cursor-help"
                                            ></span>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- <div class="flex items-center gap-1 text-amber-400 text-xs font-bold bg-charcoal-950/80 backdrop-blur-md px-2.5 py-1 rounded-full border border-white/10">
                                    <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                                    <span>{{ $theme['rating'] }}</span>
                                </div> -->
                            </div>
                        </div>

                        <!-- CARD BODY -->
                        <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                            
                            <!-- CONTENT -->
                            <div class="space-y-2.5">
                                <div class="flex items-center justify-between text-xs text-sand-500 font-medium">
                                    <!-- <span class="text-brand-700 font-bold uppercase tracking-wider text-[11px]">{{ $theme['number'] }}</span> -->
                                    <span>Kategori: <strong>{{ $theme['category_label'] }}</strong></span>
                                </div>

                                <h2 class="font-serif text-xl font-bold text-charcoal-950 group-hover:text-brand-600 transition-colors">
                                    {{ $theme['name'] }}
                                </h2>

                                <p class="text-xs text-charcoal-900/70 leading-relaxed">
                                    {{ $theme['description'] }}
                                </p>

                                <!-- TYPOGRAPHY & BEST FOR -->
                                <!-- <div class="pt-2 space-y-1.5 border-t border-sand-200/80 text-[11px]">
                                    <div class="flex items-center gap-1.5 text-charcoal-900/80">
                                        <i data-lucide="type" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                                        <span>Tipografi: <strong>{{ $theme['typography'] }}</strong></span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-charcoal-900/80">
                                        <i data-lucide="heart" class="w-3.5 h-3.5 text-rose-500 shrink-0"></i>
                                        <span class="truncate">Ideal: {{ $theme['best_for'] }}</span>
                                    </div>
                                </div> -->

                                <!-- HIGHLIGHT CHIPS -->
                                <!-- <div class="pt-2 flex flex-wrap gap-1.5">
                                    @foreach ($theme['features'] as $feat)
                                        <span class="px-2 py-0.5 rounded-md bg-sand-100 border border-sand-200 text-[10px] text-charcoal-900/80 font-medium">
                                            ✓ {{ $feat }}
                                        </span>
                                    @endforeach
                                </div> -->
                            </div>

                            <!-- CARD FOOTER & ACTIONS -->
                            <div class="pt-4 border-t border-sand-200 flex items-center justify-between gap-3">
                                <!-- <button 
                                    @click="openPreview(themes.find(t => t.id === '{{ $theme['id'] }}'))" 
                                    class="text-xs font-semibold text-charcoal-900 hover:text-brand-600 flex items-center gap-1 py-1"
                                >
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    <span>Preview</span>
                                </button> -->

                                <div class="flex items-center gap-2">
                                    <!-- <a 
                                        href="{{ $theme['demo_url'] }}" 
                                        target="_blank" 
                                        class="px-3.5 py-2 rounded-xl bg-sand-200/80 hover:bg-sand-300 text-charcoal-950 text-xs font-bold transition flex items-center gap-1"
                                        title="Buka Live Demo di Tab Baru"
                                    >
                                        <span>Demo</span>
                                        <i data-lucide="external-link" class="w-3 h-3"></i>
                                    </a> -->

                                    <a 
                                        href="{{ $theme['checkout_url'] }}" 
                                        @click.prevent="openOrderModal(themes.find(t => t.id === '{{ $theme['id'] }}'))"
                                        class="px-4 py-2 rounded-xl bg-charcoal-950 text-brand-100 hover:bg-brand-600 hover:text-white text-xs font-bold transition flex items-center gap-1.5 shadow-sm cursor-pointer"
                                    >
                                        <span>Pilih Desain</span>
                                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- LIST VIEW -->
            <div 
                x-show="viewMode === 'list'" 
                class="space-y-6"
            >
                @foreach ($themes as $theme)
                    <div 
                        x-show="matchesFilter(themes.find(t => t.id === '{{ $theme['id'] }}'))" 
                        x-transition 
                        class="group rounded-3xl overflow-hidden glass-panel border border-sand-200 hover:border-brand-400 hover:shadow-xl transition-all duration-300 grid grid-cols-1 md:grid-cols-12 bg-white"
                    >
                        <!-- THUMBNAIL (LEFT) -->
                        <div class="relative md:col-span-4 aspect-[16/10] md:aspect-auto overflow-hidden bg-sand-200">
                            <img 
                                src="{{ $theme['thumbnail'] }}" 
                                alt="{{ $theme['name'] }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950/70 via-transparent to-transparent"></div>
                            <div class="absolute top-3 left-3">
                                <span class="px-3 py-1 rounded-full text-[10px] uppercase tracking-wider shadow {{ $theme['tag_badge_class'] }}">
                                    {{ $theme['tag'] }}
                                </span>
                            </div>
                        </div>

                        <!-- BODY (RIGHT) -->
                        <div class="p-6 md:col-span-8 flex flex-col justify-between space-y-4">
                            <div>
                                <div class="flex items-center justify-between text-xs text-sand-500 font-medium pb-1">
                                    <span class="text-brand-700 font-bold uppercase tracking-wider text-[11px]">{{ $theme['number'] }} • {{ $theme['category_label'] }}</span>
                                    <!-- <span class="text-amber-600 font-bold">★ {{ $theme['rating'] }} ({{ $theme['reviews_count'] }} ulasan)</span> -->
                                </div>

                                <h2 class="font-serif text-2xl font-bold text-charcoal-950 group-hover:text-brand-600 transition-colors">
                                    {{ $theme['name'] }}
                                </h2>

                                <p class="text-xs sm:text-sm text-charcoal-900/70 mt-1 leading-relaxed">
                                    {{ $theme['description'] }}
                                </p>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-4 pt-3 border-t border-sand-200 text-xs text-charcoal-900/80">
                                    <div>Tipografi: <strong>{{ $theme['typography'] }}</strong></div>
                                    <div>Cocok Untuk: <strong>{{ $theme['best_for'] }}</strong></div>
                                </div>

                                <div class="flex flex-wrap items-center gap-2 mt-3">
                                    @foreach ($theme['features'] as $feat)
                                        <span class="px-2.5 py-1 rounded-lg bg-sand-100 text-[11px] font-medium text-charcoal-900">
                                            ✓ {{ $feat }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="pt-4 border-t border-sand-200 flex flex-wrap items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-[10px] uppercase font-bold text-sand-400">Palet:</span>
                                        <div class="flex items-center -space-x-1">
                                            @foreach ($theme['colors'] as $color)
                                                <span style="background-color: {{ $color['hex'] }};" title="{{ $color['name'] }}" class="w-4 h-4 rounded-full border border-white shadow-sm"></span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <span class="text-sm font-bold text-charcoal-950">{{ $theme['price'] }} <span class="text-xs font-normal text-sand-500">/ lifetime</span></span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <!-- <button 
                                        @click="openPreview(themes.find(t => t.id === '{{ $theme['id'] }}'))" 
                                        class="px-4 py-2 rounded-xl bg-sand-200 hover:bg-sand-300 text-charcoal-950 text-xs font-bold transition flex items-center gap-1.5"
                                    >
                                        <i data-lucide="smartphone" class="w-3.5 h-3.5"></i>
                                        <span>Quick Mobile Preview</span>
                                    </button> -->

                                    <a 
                                        href="{{ $theme['demo_url'] }}" 
                                        target="_blank" 
                                        class="px-4 py-2 rounded-xl bg-charcoal-950 text-white hover:bg-brand-600 text-xs font-bold transition flex items-center gap-1.5"
                                    >
                                        <span>Live Demo</span>
                                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                    </a>

                                    <a 
                                        href="{{ $theme['checkout_url'] }}" 
                                        @click.prevent="openOrderModal(themes.find(t => t.id === '{{ $theme['id'] }}'))"
                                        class="px-4 py-2 rounded-xl bg-brand-500 text-white hover:bg-brand-600 text-xs font-bold transition flex items-center gap-1.5 shadow-sm cursor-pointer"
                                    >
                                        <span>Pilih Tema</span>
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- EMPTY STATE WHEN SEARCH FINDS NOTHING -->
            <div 
                x-show="themes.filter(t => matchesFilter(t)).length === 0" 
                class="py-16 text-center space-y-4 max-w-md mx-auto"
            >
                <div class="w-16 h-16 rounded-full bg-sand-200 text-sand-500 flex items-center justify-center mx-auto">
                    <i data-lucide="search-x" class="w-8 h-8"></i>
                </div>
                <h3 class="font-serif text-xl font-bold text-charcoal-950">Tema tidak ditemukan</h3>
                <p class="text-xs text-sand-500">
                    Tidak ada tema yang cocok dengan kata kunci "<span class="font-bold text-charcoal-900" x-text="searchQuery"></span>". Silakan coba kata kunci lain atau reset filter kategori.
                </p>
                <button 
                    @click="searchQuery = ''; selectedCategory = 'all'" 
                    class="px-5 py-2.5 rounded-full bg-charcoal-950 text-brand-100 text-xs font-bold hover:bg-brand-600 transition"
                >
                    Reset Filter Pencarian
                </button>
            </div>

        </div>

    </main>

    <!-- FEATURES INCLUDED IN ALL THEMES -->
    <section id="fitur" class="py-20 bg-sand-100/70 border-t border-sand-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-600">Standard Fitur Terbaik</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal-950">
                    Semua Tema Sudah Dilengkapi Fitur Premium Lengkap
                </h2>
                <p class="text-xs sm:text-sm text-charcoal-900/70">
                    Apapun tema yang Anda pilih, Anda mendapatkan fasilitas studio undangan digital terlengkap tanpa biaya tersembunyi.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                
                <div class="p-5 rounded-2xl glass-panel border border-sand-200/80 space-y-2.5">
                    <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="user-plus" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-serif text-base font-bold text-charcoal-950">Unlimited Nama Tamu</h4>
                    <p class="text-[11px] text-charcoal-900/70">Kustomisasi nama penerima tanpa batas dengan generator WhatsApp 1-klik praktis.</p>
                </div>

                <div class="p-5 rounded-2xl glass-panel border border-sand-200/80 space-y-2.5">
                    <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="wallet-cards" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-serif text-base font-bold text-charcoal-950">Amplop & Kado 0% Fee</h4>
                    <p class="text-[11px] text-charcoal-900/70">QRIS & transfer BCA, Mandiri, BRI langsung masuk rekening pribadi Anda.</p>
                </div>

                <div class="p-5 rounded-2xl glass-panel border border-sand-200/80 space-y-2.5">
                    <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="music" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-serif text-base font-bold text-charcoal-950">Musik Latar Romantis</h4>
                    <p class="text-[11px] text-charcoal-900/70">Audio player eksklusif otomatis berputar saat undangan dibuka dengan kontrol mute.</p>
                </div>

                <div class="p-5 rounded-2xl glass-panel border border-sand-200/80 space-y-2.5">
                    <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-serif text-base font-bold text-charcoal-950">RSVP & Doa Real-time</h4>
                    <p class="text-[11px] text-charcoal-900/70">Konfirmasi kehadiran instan dan buku tamu digital yang terupdate langsung.</p>
                </div>

                <div class="p-5 rounded-2xl glass-panel border border-sand-200/80 space-y-2.5">
                    <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-serif text-base font-bold text-charcoal-950">Navigasi Google Maps</h4>
                    <p class="text-[11px] text-charcoal-900/70">Petunjuk rute 1-klik memudahkan tamu sampai tepat waktu ke lokasi acara.</p>
                </div>

                <div class="p-5 rounded-2xl glass-panel border border-sand-200/80 space-y-2.5">
                    <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="images" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-serif text-base font-bold text-charcoal-950">Galeri Foto & Video</h4>
                    <p class="text-[11px] text-charcoal-900/70">Tampilkan momen prewedding dengan lightbox galeri estetik dan resolusi tajam.</p>
                </div>

                <div class="p-5 rounded-2xl glass-panel border border-sand-200/80 space-y-2.5">
                    <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="calendar" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-serif text-base font-bold text-charcoal-950">Simpan Kalender & Timer</h4>
                    <p class="text-[11px] text-charcoal-900/70">Pengingat Google Calendar, iCal, dan countdown timer hitung mundur acara.</p>
                </div>

                <div class="p-5 rounded-2xl glass-panel border border-sand-200/80 space-y-2.5">
                    <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="qr-code" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-serif text-base font-bold text-charcoal-950">QR Code Check-in Resepsi</h4>
                    <p class="text-[11px] text-charcoal-900/70">Sistem registrasi tamu berbasis scan QR Code tanpa antrean di meja resepsionis.</p>
                </div>

            </div>

        </div>
    </section>

    <!-- FAQ SECTION -->
    <section id="faq" class="py-20 bg-sand-50 border-t border-sand-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <div class="text-center space-y-3">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-600">Pertanyaan Populer</span>
                <h2 class="font-serif text-3xl font-bold text-charcoal-950">
                    Tanya Jawab Seputar Template Tema
                </h2>
            </div>

            <div class="space-y-4">
                
                <!-- FAQ 1 -->
                <div class="rounded-2xl glass-panel border border-sand-200 overflow-hidden">
                    <button 
                        @click="activeFaq = (activeFaq === 1 ? null : 1)" 
                        class="w-full p-5 text-left font-serif font-bold text-sm sm:text-base text-charcoal-950 flex items-center justify-between gap-4 hover:text-brand-600 transition"
                    >
                        <span>Apakah saya bisa mencoba tema sebelum membayar?</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200" :class="activeFaq === 1 ? 'rotate-180 text-brand-600' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-charcoal-900/70 leading-relaxed border-t border-sand-100 pt-3">
                        Tentu saja! Anda dapat mencoba live demo interaktif dari setiap tema secara langsung melalui tombol "Quick Preview" atau "Live Demo" dengan data simulasi nyata tanpa perlu mendaftar terlebih dahulu.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="rounded-2xl glass-panel border border-sand-200 overflow-hidden">
                    <button 
                        @click="activeFaq = (activeFaq === 2 ? null : 2)" 
                        class="w-full p-5 text-left font-serif font-bold text-sm sm:text-base text-charcoal-950 flex items-center justify-between gap-4 hover:text-brand-600 transition"
                    >
                        <span>Apakah musik dan foto pada tema dapat diganti sesuai keinginan?</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200" :class="activeFaq === 2 ? 'rotate-180 text-brand-600' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-charcoal-900/70 leading-relaxed border-t border-sand-100 pt-3">
                        Sangat bisa! Di dashboard pembuatan undangan, Anda bebas mengunggah foto prewedding, memilih daftar lagu pernikahan romantis dari katalog kami, atau menggunakan file MP3 pilihan Anda sendiri.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="rounded-2xl glass-panel border border-sand-200 overflow-hidden">
                    <button 
                        @click="activeFaq = (activeFaq === 3 ? null : 3)" 
                        class="w-full p-5 text-left font-serif font-bold text-sm sm:text-base text-charcoal-950 flex items-center justify-between gap-4 hover:text-brand-600 transition"
                    >
                        <span>Apakah tema bisa digunakan untuk acara selain pernikahan?</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200" :class="activeFaq === 3 ? 'rotate-180 text-brand-600' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-charcoal-900/70 leading-relaxed border-t border-sand-100 pt-3">
                        Bisa! Desain kami sangat fleksibel untuk acara tunangan (engagement), resepsi khitanan, ulang tahun (sweet seventeen), maupun syukuran keluarga dengan kolom acara yang dapat disesuaikan.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="rounded-2xl glass-panel border border-sand-200 overflow-hidden">
                    <button 
                        @click="activeFaq = (activeFaq === 4 ? null : 4)" 
                        class="w-full p-5 text-left font-serif font-bold text-sm sm:text-base text-charcoal-950 flex items-center justify-between gap-4 hover:text-brand-600 transition"
                    >
                        <span>Berapa lama masa aktif undangan setelah dibuat?</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200" :class="activeFaq === 4 ? 'rotate-180 text-brand-600' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-charcoal-900/70 leading-relaxed border-t border-sand-100 pt-3">
                        Semua paket kami bergaransi aktif seumur hidup (*lifetime*). Undangan digital Anda tetap dapat dibuka bertahun-tahun kemudian sebagai kenang-kenangan arsip cinta yang abadi.
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- BOTTOM CTA BANNER -->
    <section class="py-16 bg-charcoal-950 text-white border-t border-brand-900/40 relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6 relative z-10">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-brand-400">Mulai Cerita Bahagiamu</span>
            <h2 class="font-serif text-3xl sm:text-5xl font-bold tracking-tight">
                Siap Membagikan Undangan Pernikahan yang Tak Terlupakan?
            </h2>
            <p class="text-xs sm:text-sm text-sand-300 max-w-xl mx-auto">
                Buat undangan digital impianmu sekarang hanya dalam 5 menit. Praktis, hemat biaya, dan siap dibagikan ke seluruh keluarga &amp; sahabat.
            </p>
            <div class="pt-2 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-4 rounded-full bg-gradient-to-r from-brand-500 to-brand-600 text-white font-bold text-xs sm:text-sm hover:shadow-xl hover:shadow-brand-500/30 hover:scale-105 active:scale-95 transition flex items-center gap-2">
                    <span>Buat Undangan Sekarang (Rp 49.000)</span>
                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                </a>
                <a href="{{ route('demo.index') }}" class="px-6 py-4 rounded-full bg-white/10 hover:bg-white/20 text-brand-100 text-xs sm:text-sm font-semibold border border-white/20 transition">
                    Coba Live Demo Lengkap
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-charcoal-900 text-sand-400 text-xs py-10 border-t border-sand-200/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-7 h-7 rounded-full bg-charcoal-950 text-brand-300 flex items-center justify-center font-serif font-bold text-sm border border-brand-400/40">
                    K
                </div>
                <span>&copy; {{ date('Y') }} KlikMomen Studio. All rights reserved.</span>
            </div>
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="hover:text-brand-300 transition">Beranda</a>
                <a href="{{ route('themes.catalog') }}" class="hover:text-brand-300 transition">Koleksi Tema</a>
                <a href="{{ route('demo.index') }}" class="hover:text-brand-300 transition">Demo Hub</a>
                <a href="{{ route('login') }}" class="hover:text-brand-300 transition">Masuk Akun</a>
            </div>
        </div>
    </footer>

    <!-- INTERACTIVE SMARTPHONE QUICK PREVIEW MODAL (ALPINE.JS) -->
    <template x-teleport="body">
    <div 
        x-show="previewModalOpen" 
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-6 bg-charcoal-950/80 backdrop-blur-md"
        style="display: none;"
    >
        <!-- MODAL CONTAINER -->
        <div 
            class="relative w-full max-w-4xl max-h-[92vh] flex flex-col rounded-3xl bg-charcoal-900 text-white border border-white/15 shadow-2xl overflow-hidden"
        >
            <!-- MODAL HEADER -->
            <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between gap-4 bg-charcoal-950/80">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-brand-500/20 text-brand-300 flex items-center justify-center shrink-0">
                        <i data-lucide="smartphone" class="w-4 h-4"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] uppercase font-bold text-sand-400" x-text="activePreviewTheme ? activePreviewTheme.number : ''"></span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-brand-500/30 text-brand-200 font-semibold" x-text="activePreviewTheme ? activePreviewTheme.category_label : ''"></span>
                        </div>
                        <h3 class="font-serif text-lg font-bold text-white truncate" x-text="activePreviewTheme ? activePreviewTheme.name : ''"></h3>
                    </div>
                </div>

                <!-- CONTROLS & CLOSE -->
                <div class="flex items-center gap-3">
                    <!-- DEVICE SELECTOR -->
                    <div class="hidden sm:flex items-center gap-1 bg-charcoal-800 p-1 rounded-xl border border-white/10 text-xs">
                        <button 
                            @click="previewDevice = 'mobile'" 
                            :class="previewDevice === 'mobile' ? 'bg-brand-500 text-white font-bold' : 'text-sand-400 hover:text-white'"
                            class="px-3 py-1 rounded-lg transition flex items-center gap-1">
                            <i data-lucide="smartphone" class="w-3.5 h-3.5"></i>
                            <span>Mobile</span>
                        </button>
                        <button 
                            @click="previewDevice = 'desktop'" 
                            :class="previewDevice === 'desktop' ? 'bg-brand-500 text-white font-bold' : 'text-sand-400 hover:text-white'"
                            class="px-3 py-1 rounded-lg transition flex items-center gap-1">
                            <i data-lucide="monitor" class="w-3.5 h-3.5"></i>
                            <span>Layar Lebar</span>
                        </button>
                    </div>

                    <!-- OPEN IN NEW TAB BUTTON -->
                    <a 
                        :href="activePreviewTheme ? activePreviewTheme.demo_url : '#'" 
                        target="_blank" 
                        class="p-2 rounded-xl bg-charcoal-800 hover:bg-charcoal-700 text-sand-300 hover:text-white transition"
                        title="Buka di Tab Penuh"
                    >
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                    </a>

                    <!-- CLOSE BUTTON -->
                    <button 
                        @click="closePreview()" 
                        class="p-2 rounded-xl bg-charcoal-800 hover:bg-rose-500/30 hover:text-rose-300 text-sand-400 transition"
                        title="Tutup Preview (Esc)"
                    >
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <!-- MODAL PREVIEW BODY -->
            <div class="flex-1 overflow-y-auto p-4 sm:p-6 bg-charcoal-950 flex flex-col items-center justify-center min-h-[460px]">
                
                <!-- MOBILE SMARTPHONE FRAME -->
                <div 
                    x-show="previewDevice === 'mobile'" 
                    class="relative w-[340px] sm:w-[380px] h-[640px] rounded-[48px] p-3 bg-charcoal-950 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.8)] ring-2 ring-white/20 flex flex-col"
                >
                    <!-- Dynamic Island Speaker -->
                    <div class="absolute top-5 left-1/2 -translate-x-1/2 w-28 h-5 bg-black rounded-full z-40 flex items-center justify-center gap-2 pointer-events-none">
                        <div class="w-2.5 h-2.5 rounded-full bg-[#1a1a1a]"></div>
                        <div class="w-10 h-1 bg-[#1f1f1f] rounded-full"></div>
                    </div>

                    <!-- IFRAME SCREEN -->
                    <div class="relative w-full h-full rounded-[38px] overflow-hidden bg-sand-100 border border-charcoal-900/20">
                        <template x-if="activePreviewTheme">
                            <iframe 
                                :src="activePreviewTheme.demo_url" 
                                class="w-full h-full border-0" 
                                title="Interactive Invitation Preview"
                            ></iframe>
                        </template>
                    </div>
                </div>

                <!-- DESKTOP / WIDE VIEW -->
                <div 
                    x-show="previewDevice === 'desktop'" 
                    class="w-full h-[640px] rounded-2xl overflow-hidden border border-white/10 bg-sand-100 shadow-xl"
                >
                    <template x-if="activePreviewTheme">
                        <iframe 
                            :src="activePreviewTheme.demo_url" 
                            class="w-full h-full border-0" 
                            title="Interactive Invitation Preview Wide"
                        ></iframe>
                    </template>
                </div>

            </div>

            <!-- MODAL FOOTER -->
            <div class="px-6 py-4 bg-charcoal-950/90 border-t border-white/10 flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-2 text-xs text-sand-400">
                    <i data-lucide="info" class="w-4 h-4 text-brand-400 shrink-0"></i>
                    <span>Preview interaktif menampilkan data simulasi lengkap beserta musik dan efek visual.</span>
                </div>

                <div class="flex items-center gap-3">
                    <a 
                        :href="activePreviewTheme ? activePreviewTheme.demo_url : '#'" 
                        target="_blank" 
                        class="px-4 py-2 rounded-xl bg-charcoal-800 hover:bg-charcoal-700 text-white font-bold text-xs transition flex items-center gap-1.5"
                    >
                        <span>Buka Layar Penuh</span>
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                    </a>

                    <button 
                        type="button"
                        @click="closePreview(); openOrderModal(activePreviewTheme)" 
                        class="px-5 py-2 rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 text-white font-bold text-xs hover:scale-105 transition flex items-center gap-1.5 shadow-md cursor-pointer"
                    >
                        <span>Pilih Desain &amp; Checkout</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </template>

    <!-- DESIGN SELECTION VARIANT MODAL -->
    @include('themes.partials.design-selection-modal')

    <!-- INITIALIZE ICONS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>

</body>
</html>
