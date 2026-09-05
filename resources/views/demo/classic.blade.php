<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $data['title'] ?? ('The Wedding of ' . ($data['groom']['nickname'] ?? 'Raka') . ' & ' . ($data['bride']['nickname'] ?? 'Arinda')) }}</title>

    <!-- Meta SEO & Social Sharing Preview (OpenGraph) -->
    <meta name="description" content="Official Wedding Website of {{ $data['groom']['name'] ?? 'Raka Pratama' }} &amp; {{ $data['bride']['name'] ?? 'Arinda Putri Larasati' }}.">
    <meta property="og:title" content="{{ ($data['groom']['nickname'] ?? 'Raka') . ' & ' . ($data['bride']['nickname'] ?? 'Arinda') }} — The Wedding">
    <meta property="og:description" content="{{ $data['events']['akad']['date'] ?? 'Sabtu, 24 Oktober 2026' }} - {{ $data['events']['akad']['venue'] ?? 'Jakarta' }}">
    <meta property="og:image" content="{{ !empty($data['cover_image']) ? $data['cover_image'] : ($activeStyle['cover_bg'] ?? 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=1200&auto=format&fit=crop&q=85') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Great+Vibes&display=swap" rel="stylesheet">

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
                        script: ['"Great Vibes"', 'cursive'],
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
        .font-script { font-family: 'Great Vibes', cursive; }
        .font-editorial { font-family: 'Cormorant Garamond', serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }

        @keyframes pulse-soft {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.9; }
        }
        .animate-pulse-soft {
            animation: pulse-soft 2.5s ease-in-out infinite;
        }

        @keyframes bar-dance {
            0%, 100% { height: 4px; }
            50% { height: 16px; }
        }
        .bar-1 { animation: bar-dance 0.9s ease-in-out infinite; }
        .bar-2 { animation: bar-dance 1.2s ease-in-out infinite 0.2s; }
        .bar-3 { animation: bar-dance 0.7s ease-in-out infinite 0.4s; }
        .bar-4 { animation: bar-dance 1.1s ease-in-out infinite 0.1s; }

        /* Hide scrollbars */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body 
    :style="{ backgroundColor: currentStyle.bg_main, color: currentStyle.text_primary }"
    class="font-sans antialiased overflow-x-hidden min-h-screen transition-colors duration-500"
    x-data="weddingInvitationApp()"
    x-init="initApp()"
>
    <!-- AUDIO ELEMENT -->
    <audio id="bgMusic" loop preload="auto">
        <source src="{{ $data['background_music'] ?? '/audio/wedding-song.mp3' }}" type="audio/mp3">
    </audio>

    <!-- TOAST NOTIFICATION -->
    <div 
        x-show="toast.show" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="fixed top-6 left-1/2 -translate-x-1/2 z-50 px-5 py-3 rounded-full bg-stone-950/95 backdrop-blur-md text-white shadow-2xl border border-white/20 flex items-center gap-3 text-xs sm:text-sm font-medium"
        style="display: none;"
    >
        <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
            <i data-lucide="check" class="w-3.5 h-3.5"></i>
        </span>
        <span x-text="toast.message"></span>
    </div>

    <!-- MAIN INVITATION WRAPPER (AUTHENTIC IMMERSIVE VIEWPORT) -->
    <div class="max-w-md mx-auto min-h-screen shadow-2xl relative transition-all duration-500">

        <!-- ========================================== -->
        <!-- 1. FULLSCREEN COVER / ENVELOPE OPENER -->
        <!-- ========================================== -->
        <div 
            x-show="!isOpened"
            x-transition:leave="transition ease-in-out duration-700 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-full scale-95 pointer-events-none"
            class="fixed inset-0 max-w-md mx-auto z-50 flex flex-col justify-between p-8 text-center text-white bg-cover bg-center overflow-hidden"
            style="background-image: url('{{ !empty($data['cover_image']) ? $data['cover_image'] : ($activeStyle['cover_bg'] ?? 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=1200&auto=format&fit=crop&q=85') }}');"
        >
            <!-- DARK GRADIENT OVERLAY -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/45 to-black/90 z-0"></div>

            <!-- TOP HEADER BADGE -->
            <div class="relative z-10 pt-8 space-y-2">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-[11px] font-semibold tracking-widest uppercase text-amber-200">
                    The Wedding Invitation
                </div>
                <p class="text-xs font-light text-white/80 tracking-widest uppercase">Walimatul 'Ursy • The Wedding</p>
            </div>

            <!-- COUPLE NAMES ON COVER -->
            <div class="relative z-10 space-y-3 my-auto">
                <h1 
                    :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'"
                    class="text-4xl sm:text-5xl font-bold tracking-tight text-white leading-tight"
                >
                    <span data-preview="groom-nickname">{{ $data['groom']['nickname'] }}</span> <span class="font-script text-5xl sm:text-6xl text-amber-300 font-normal">&amp;</span> <span data-preview="bride-nickname">{{ $data['bride']['nickname'] }}</span>
                </h1>
                <div class="w-20 h-0.5 bg-gradient-to-r from-transparent via-amber-300 to-transparent mx-auto"></div>
                <p class="text-sm font-medium text-amber-100/90 tracking-wide" data-preview="event-date">
                    {{ $data['events']['akad']['date'] }}
                </p>
            </div>

            <!-- GUEST RECIPIENT BOX & OPEN BUTTON -->
            <div class="relative z-10 pb-8 space-y-4">
                <div class="p-4 rounded-2xl bg-black/50 backdrop-blur-md border border-white/20 text-center space-y-1.5 max-w-xs mx-auto">
                    <span class="text-[10px] uppercase font-medium tracking-[0.2em] text-white/70">Kepada Yth. Bapak/Ibu/Saudara(i):</span>
                    <h4 class="font-serif text-lg font-bold text-amber-200" data-preview="guest-name">{{ $guestName }}</h4>
                    <p class="text-[10px] text-white/70 italic">*Mohon maaf bila ada kesalahan penulisan nama/gelar</p>
                </div>

                <!-- OPEN INVITATION BUTTON -->
                <button 
                    @click="openInvitation()"
                    class="w-full max-w-xs mx-auto py-3.5 px-6 rounded-full bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-stone-950 font-bold text-sm shadow-2xl hover:shadow-amber-500/40 hover:scale-[1.02] active:scale-[0.98] transition flex items-center justify-center gap-2 animate-pulse-soft"
                >
                    <i data-lucide="mail-open" class="w-4 h-4 text-stone-950"></i>
                    <span>Buka Undangan</span>
                </button>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 2. FLOATING MUSIC & STYLE CONTROLLER -->
        <!-- ========================================== -->
        <div 
            x-show="isOpened" 
            x-transition
            class="fixed bottom-20 right-4 sm:right-[calc(50%-200px)] z-40 flex flex-col gap-2.5"
        >
            <!-- MUSIC TOGGLE -->
            <button 
                @click="toggleMusic()" 
                type="button"
                class="w-11 h-11 rounded-full bg-stone-950/90 backdrop-blur-md text-amber-300 shadow-2xl border border-amber-500/40 flex items-center justify-center hover:scale-110 active:scale-95 transition"
                :title="currentStyle.audio_title"
            >
                <div x-show="isPlaying" class="flex items-end gap-0.5 h-3.5">
                    <span class="w-1 bg-amber-400 rounded-full bar-1"></span>
                    <span class="w-1 bg-amber-400 rounded-full bar-2"></span>
                    <span class="w-1 bg-amber-400 rounded-full bar-3"></span>
                    <span class="w-1 bg-amber-400 rounded-full bar-4"></span>
                </div>
                <div x-show="!isPlaying" class="flex items-center justify-center text-stone-400">
                    <i data-lucide="volume-x" class="w-4 h-4"></i>
                </div>
            </button>
        </div>

        <!-- ========================================== -->
        <!-- 3. INVITATION MAIN CONTENT BODY -->
        <!-- ========================================== -->
        <div x-show="isOpened" class="space-y-16 pb-28">
            
            <!-- SECTION: HERO COVER -->
            <section id="sec-cover" class="relative min-h-[520px] flex flex-col justify-between p-6 sm:p-8 text-center text-white bg-cover bg-center rounded-b-[44px] shadow-xl overflow-hidden" style="background-image: url('{{ !empty($data['cover_image']) ? $data['cover_image'] : ($activeStyle['cover_bg'] ?? 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=1200&auto=format&fit=crop&q=85') }}');">
                <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-black/85"></div>
                
                <div class="relative z-10 pt-6">
                    <span class="text-[11px] uppercase tracking-[0.3em] font-semibold text-amber-300">The Wedding Of</span>
                </div>

                <div class="relative z-10 space-y-2 my-auto">
                    <h2 
                        :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'"
                        class="text-4xl sm:text-5xl font-bold tracking-tight"
                        data-preview="couple-nickname"
                    >
                        {{ $data['groom']['nickname'] }} &amp; {{ $data['bride']['nickname'] }}
                    </h2>
                    <p class="text-sm font-light text-amber-100 tracking-wider" data-preview="event-date">
                        {{ $data['events']['akad']['date'] }}
                    </p>
                </div>

                <div class="relative z-10 pb-4">
                    <div class="inline-flex items-center gap-1.5 text-xs text-white/80 animate-bounce">
                        <span>Gulir ke bawah</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </div>
                </div>
            </section>

            @if(!empty($data['quote_text']))
            <!-- SECTION: KUTIPAN / AYAT SUCI -->
            <section class="text-center px-6 space-y-4 max-w-sm mx-auto">
                <div 
                    :style="{ color: currentStyle.accent }"
                    class="w-10 h-10 rounded-full border border-current flex items-center justify-center mx-auto opacity-80"
                >
                    <i data-lucide="heart" class="w-5 h-5 fill-current"></i>
                </div>
                
                <p 
                    :style="{ color: currentStyle.text_secondary }"
                    class="font-editorial text-base sm:text-lg italic leading-relaxed"
                >
                    "{{ $data['quote_text'] }}"
                </p>
                @if(!empty($data['quote_source']))
                <span 
                    :style="{ color: currentStyle.accent }"
                    class="text-xs font-bold tracking-wider uppercase"
                >
                    {{ Str::startsWith($data['quote_source'], '(') ? $data['quote_source'] : "({$data['quote_source']})" }}
                </span>
                @endif
            </section>
            @endif

            <!-- SECTION: KEDUA MEMPELAI (BRIDE & GROOM) -->
            <section id="sec-mempelai" class="px-6 space-y-8">
                <div class="text-center space-y-1">
                    <span 
                        :style="{ color: currentStyle.accent }"
                        class="text-[11px] font-bold uppercase tracking-[0.2em]"
                    >
                        Kedua Mempelai
                    </span>
                    <h3 
                        :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'"
                        class="text-2xl sm:text-3xl font-bold"
                    >
                        Pasangan Pengantin
                    </h3>
                    <p :style="{ color: currentStyle.text_secondary }" class="text-xs">Dengan memohon rahmat dan ridho Allah SWT, kami mengundang Anda dalam pernikahan kami:</p>
                </div>

                <!-- GROOM CARD -->
                <div 
                    :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }"
                    :class="currentStyle.card_radius"
                    class="p-6 border shadow-md text-center space-y-4 max-w-sm mx-auto transition-all duration-300"
                >
                    <div class="relative w-32 h-32 mx-auto rounded-full overflow-hidden ring-4 ring-amber-400/30 shadow-inner">
                        <img src="{{ $data['groom']['photo'] }}" alt="{{ $data['groom']['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-1">
                        <h4 
                            :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'"
                            data-preview="groom-name"
                            class="text-xl font-bold"
                        >
                            {{ $data['groom']['name'] }}
                        </h4>
                        <p :style="{ color: currentStyle.text_secondary }" class="text-xs leading-relaxed">
                            @if(!empty($data['groom']['child_order']))
                                {{ $data['groom']['child_order'] }} dari<br>
                            @endif
                            @if(!empty($data['groom']['father']))
                                <strong>{{ $data['groom']['father'] }}</strong>
                            @endif
                            @if(!empty($data['groom']['father']) && !empty($data['groom']['mother']))
                                &amp;
                            @endif
                            @if(!empty($data['groom']['mother']))
                                <strong>{{ $data['groom']['mother'] }}</strong>
                            @endif
                        </p>
                    </div>
                    @if(!empty($data['groom']['instagram']))
                    <a 
                        href="https://instagram.com/{{ ltrim($data['groom']['instagram'], '@') }}" 
                        target="_blank" 
                        :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }"
                        class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-semibold hover:opacity-80 transition"
                    >
                        <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                        <span>{{ '@' . ltrim($data['groom']['instagram'], '@') }}</span>
                    </a>
                    @endif
                </div>

                <!-- AMPERSAND DIVIDER -->
                <div class="text-center">
                    <span :style="{ color: currentStyle.accent }" class="font-script text-5xl">&</span>
                </div>

                <!-- BRIDE CARD -->
                <div 
                    :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }"
                    :class="currentStyle.card_radius"
                    class="p-6 border shadow-md text-center space-y-4 max-w-sm mx-auto transition-all duration-300"
                >
                    <div class="relative w-32 h-32 mx-auto rounded-full overflow-hidden ring-4 ring-amber-400/30 shadow-inner">
                        <img src="{{ $data['bride']['photo'] }}" alt="{{ $data['bride']['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-1">
                        <h4 
                            :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'"
                            data-preview="bride-name"
                            class="text-xl font-bold"
                        >
                            {{ $data['bride']['name'] }}
                        </h4>
                        <p :style="{ color: currentStyle.text_secondary }" class="text-xs leading-relaxed">
                            @if(!empty($data['bride']['child_order']))
                                {{ $data['bride']['child_order'] }} dari<br>
                            @endif
                            @if(!empty($data['bride']['father']))
                                <strong>{{ $data['bride']['father'] }}</strong>
                            @endif
                            @if(!empty($data['bride']['father']) && !empty($data['bride']['mother']))
                                &amp;
                            @endif
                            @if(!empty($data['bride']['mother']))
                                <strong>{{ $data['bride']['mother'] }}</strong>
                            @endif
                        </p>
                    </div>
                    @if(!empty($data['bride']['instagram']))
                    <a 
                        href="https://instagram.com/{{ ltrim($data['bride']['instagram'], '@') }}" 
                        target="_blank" 
                        :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }"
                        class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-semibold hover:opacity-80 transition"
                    >
                        <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                        <span>{{ '@' . ltrim($data['bride']['instagram'], '@') }}</span>
                    </a>
                    @endif
                </div>
            </section>

            <!-- SECTION: RANGKAIAN ACARA & COUNTDOWN TIMER -->
            <section id="sec-acara" class="px-6 space-y-8">
                <div class="text-center space-y-1">
                    <span :style="{ color: currentStyle.accent }" class="text-[11px] font-bold uppercase tracking-[0.2em]">Save The Date</span>
                    <h3 :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'" class="text-2xl sm:text-3xl font-bold">Rangkaian Acara</h3>
                    <p :style="{ color: currentStyle.text_secondary }" class="text-xs">Waktu dan lokasi prosesi pernikahan kami</p>
                </div>

                <!-- LIVE COUNTDOWN TIMER CARD -->
                <div 
                    :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }"
                    :class="currentStyle.card_radius"
                    class="p-6 border shadow-md max-w-sm mx-auto text-center space-y-4 transition-all duration-300"
                >
                    <span :style="{ color: currentStyle.accent }" class="text-xs font-bold uppercase tracking-wider">Menuju Hari Bahagia</span>
                    <div class="grid grid-cols-4 gap-2">
                        <div :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }" class="p-2.5 rounded-2xl">
                            <div class="font-serif text-xl sm:text-2xl font-bold" x-text="countdown.days">00</div>
                            <div class="text-[9px] uppercase font-semibold">Hari</div>
                        </div>
                        <div :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }" class="p-2.5 rounded-2xl">
                            <div class="font-serif text-xl sm:text-2xl font-bold" x-text="countdown.hours">00</div>
                            <div class="text-[9px] uppercase font-semibold">Jam</div>
                        </div>
                        <div :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }" class="p-2.5 rounded-2xl">
                            <div class="font-serif text-xl sm:text-2xl font-bold" x-text="countdown.minutes">00</div>
                            <div class="text-[9px] uppercase font-semibold">Menit</div>
                        </div>
                        <div :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }" class="p-2.5 rounded-2xl">
                            <div class="font-serif text-xl sm:text-2xl font-bold" x-text="countdown.seconds">00</div>
                            <div class="text-[9px] uppercase font-semibold">Detik</div>
                        </div>
                    </div>
                    
                    <!-- GOOGLE CALENDAR BUTTON -->
                    <a 
                        href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode('Pernikahan ' . ($data['groom']['nickname'] ?? 'Raka') . ' & ' . ($data['bride']['nickname'] ?? 'Arinda')) }}&details={{ urlencode('Pernikahan ' . ($data['groom']['name'] ?? '') . ' & ' . ($data['bride']['name'] ?? '')) }}&location={{ urlencode(($data['events']['akad']['venue'] ?? '') . ', ' . ($data['events']['akad']['address'] ?? '')) }}" 
                        target="_blank"
                        :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }"
                        class="inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-2xl hover:opacity-90 font-semibold text-xs transition"
                    >
                        <i data-lucide="calendar-plus" class="w-4 h-4"></i>
                        <span>Simpan ke Google Calendar</span>
                    </a>
                </div>

                <!-- AKAD NIKAH CARD -->
                <div 
                    :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }"
                    :class="currentStyle.card_radius"
                    class="p-6 border shadow-md max-w-sm mx-auto text-center space-y-4 transition-all duration-300"
                >
                    <div :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }" class="w-10 h-10 rounded-2xl flex items-center justify-center mx-auto">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'" class="text-xl font-bold">{{ $data['events']['akad']['title'] }}</h4>
                        <p :style="{ color: currentStyle.accent }" class="text-xs font-semibold" data-preview="event-date">{{ $data['events']['akad']['date'] }}</p>
                        <p class="text-xs font-bold">{{ $data['events']['akad']['time'] }}</p>
                    </div>
                    <div :style="{ borderColor: currentStyle.border_color, color: currentStyle.text_secondary }" class="pt-2 border-t text-xs space-y-1">
                        <p :style="{ color: currentStyle.text_primary }" class="font-bold" data-preview="venue-name">{{ $data['events']['akad']['venue'] }}</p>
                        <p>{{ $data['events']['akad']['address'] }}</p>
                    </div>
                    <a 
                        href="{{ $data['events']['akad']['maps_link'] }}" 
                        target="_blank" 
                        :style="{ backgroundColor: currentStyle.btn_bg, color: currentStyle.btn_text }"
                        class="inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-2xl font-semibold text-xs shadow transition"
                    >
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        <span>Buka Google Maps</span>
                    </a>
                </div>

                <!-- RESEPSI PERNIKAHAN CARD -->
                <div 
                    :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }"
                    :class="currentStyle.card_radius"
                    class="p-6 border shadow-md max-w-sm mx-auto text-center space-y-4 transition-all duration-300"
                >
                    <div :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }" class="w-10 h-10 rounded-2xl flex items-center justify-center mx-auto">
                        <i data-lucide="glass-water" class="w-5 h-5"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'" class="text-xl font-bold">{{ $data['events']['resepsi']['title'] }}</h4>
                        <p :style="{ color: currentStyle.accent }" class="text-xs font-semibold" data-preview="event-date">{{ $data['events']['resepsi']['date'] }}</p>
                        <p class="text-xs font-bold">{{ $data['events']['resepsi']['time'] }}</p>
                    </div>
                    <div :style="{ borderColor: currentStyle.border_color, color: currentStyle.text_secondary }" class="pt-2 border-t text-xs space-y-1">
                        <p :style="{ color: currentStyle.text_primary }" class="font-bold" data-preview="venue-name">{{ $data['events']['resepsi']['venue'] }}</p>
                        <p>{{ $data['events']['resepsi']['address'] }}</p>
                    </div>
                    <a 
                        href="{{ $data['events']['resepsi']['maps_link'] }}" 
                        target="_blank" 
                        :style="{ backgroundColor: currentStyle.btn_bg, color: currentStyle.btn_text }"
                        class="inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-2xl font-semibold text-xs shadow transition"
                    >
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        <span>Buka Google Maps</span>
                    </a>
                </div>
            </section>

            <!-- SECTION: LOVE STORY TIMELINE -->
            @if (!empty($data['stories']) && count($data['stories']) > 0)
            <section id="sec-cerita" class="px-6 space-y-6">
                <div class="text-center space-y-1">
                    <span :style="{ color: currentStyle.accent }" class="text-[11px] font-bold uppercase tracking-[0.2em]">Our Journey</span>
                    <h3 :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'" class="text-2xl sm:text-3xl font-bold">Kisah Cinta Kami</h3>
                    <p :style="{ color: currentStyle.text_secondary }" class="text-xs">Sepenggal perjalanan indah yang membawa kami ke hari ini</p>
                </div>

                <div class="max-w-sm mx-auto space-y-4 relative before:absolute before:inset-0 before:left-4 before:w-0.5 before:bg-amber-400/40" data-preview-container="stories">
                    @foreach ($data['stories'] as $index => $story)
                        <div class="relative flex items-start gap-4 pl-8">
                            <div :style="{ backgroundColor: currentStyle.accent }" class="absolute left-2.5 top-1.5 w-3.5 h-3.5 rounded-full ring-4 ring-white shadow"></div>
                            <div 
                                :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }"
                                :class="currentStyle.card_radius"
                                class="p-4 border shadow-sm space-y-1 w-full text-left"
                            >
                                @if(!empty($story['image_url']))
                                    <div class="rounded-xl overflow-hidden aspect-[16/10] mb-2">
                                        <img src="{{ $story['image_url'] }}" alt="{{ $story['title'] }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <span data-preview="story-year-{{ $index + 1 }}" :style="{ color: currentStyle.accent }" class="text-[10px] font-bold uppercase tracking-wider">{{ $story['year'] }}</span>
                                <h5 data-preview="story-title-{{ $index + 1 }}" :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'" class="text-sm font-bold">{{ $story['title'] }}</h5>
                                <p data-preview="story-desc-{{ $index + 1 }}" :style="{ color: currentStyle.text_secondary }" class="text-xs leading-relaxed">{{ $story['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- SECTION: GALERI PREWEDDING -->
            @if(!empty($data['galleries']))
            <section id="sec-galeri" class="px-6 space-y-6">
                <div class="text-center space-y-1">
                    <span :style="{ color: currentStyle.accent }" class="text-[11px] font-bold uppercase tracking-[0.2em]">Memories</span>
                    <h3 :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'" class="text-2xl sm:text-3xl font-bold">Galeri Foto Bahagia</h3>
                    <p :style="{ color: currentStyle.text_secondary }" class="text-xs">Potret kebersamaan dan momen indah kami</p>
                </div>

                <!-- PHOTO GRID WITH LIGHTBOX -->
                <div class="grid grid-cols-2 gap-3 max-w-sm mx-auto">
                    @foreach ($data['galleries'] as $index => $photo)
                        <div 
                            @click="openLightbox('{{ $photo }}')" 
                            class="rounded-2xl overflow-hidden shadow cursor-pointer group relative aspect-square bg-stone-200"
                        >
                            <img src="{{ $photo }}" alt="Gallery {{ $index + 1 }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <i data-lucide="zoom-in" class="w-5 h-5 text-white"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            @if(!empty($data['bank_accounts']) || !empty($data['gift_address']))
            <section id="sec-amplop" class="px-6 space-y-6">
                <div class="text-center space-y-1">
                    <span :style="{ color: currentStyle.accent }" class="text-[11px] font-bold uppercase tracking-[0.2em]">Wedding Gift</span>
                    <h3 :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'" class="text-2xl sm:text-3xl font-bold">Amplop Digital & Kado</h3>
                    <p :style="{ color: currentStyle.text_secondary }" class="text-xs">Doa restu Anda adalah hadiah terindah. Namun jika ingin memberikan tanda kasih secara digital, Anda dapat menggunakan fasilitas di bawah ini:</p>
                </div>

                <div class="max-w-sm mx-auto space-y-4">
                    @foreach ($data['bank_accounts'] as $acc)
                        <div class="p-5 rounded-3xl bg-gradient-to-br {{ $acc['color'] }} text-white shadow-xl space-y-3 relative overflow-hidden">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider">{{ $acc['bank'] }}</span>
                                <i data-lucide="credit-card" class="w-5 h-5 opacity-70"></i>
                            </div>
                            <div class="space-y-0.5">
                                <div class="font-mono text-lg font-bold tracking-wider">{{ $acc['account_number'] }}</div>
                                <div class="text-xs opacity-90">a.n. {{ $acc['account_name'] }}</div>
                            </div>
                            <button 
                                type="button"
                                @click="copyToClipboard('{{ str_replace(' ', '', $acc['account_number']) }}', 'Nomor Rekening {{ $acc['bank'] }}')"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/20 hover:bg-white/30 backdrop-blur-md text-xs font-semibold transition"
                            >
                                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                <span>Salin No. Rekening</span>
                            </button>
                        </div>
                    @endforeach

                    @if(!empty($data['gift_address']))
                        <div :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }" :class="currentStyle.card_radius" class="p-5 border shadow-md space-y-2 text-left">
                            <div class="flex items-center justify-between">
                                <span :style="{ color: currentStyle.accent }" class="text-[10px] font-bold uppercase tracking-[0.2em]">Kirim Kado Fisik</span>
                                <i data-lucide="package" class="w-4 h-4" :style="{ color: currentStyle.accent }"></i>
                            </div>
                            <p :style="{ color: currentStyle.text_secondary }" class="text-xs leading-relaxed">
                                {{ $data['gift_address'] }}
                            </p>
                            <button 
                                type="button" 
                                @click="copyToClipboard('{{ $data['gift_address'] }}', 'Alamat Pengiriman Kado')"
                                :style="{ color: currentStyle.accent }"
                                class="inline-flex items-center gap-1.5 text-xs font-bold hover:underline pt-1"
                            >
                                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                <span>Salin Alamat Lengkap</span>
                            </button>
                        </div>
                    @endif
                </div>
            </section>
            @endif

            <!-- SECTION: BUKU TAMU & RSVP FORM -->
            <section id="sec-ucapan" class="px-6 space-y-6">
                <div class="text-center space-y-1">
                    <span :style="{ color: currentStyle.accent }" class="text-[11px] font-bold uppercase tracking-[0.2em]">RSVP & Guestbook</span>
                    <h3 :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'" class="text-2xl sm:text-3xl font-bold">Ucapan & Doa Restu</h3>
                    <p :style="{ color: currentStyle.text_secondary }" class="text-xs">Kirimkan konfirmasi kehadiran dan doa terbaik Anda</p>
                </div>

                <!-- RSVP FORM CARD -->
                <div 
                    :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }"
                    :class="currentStyle.card_radius"
                    class="p-6 border shadow-md max-w-sm mx-auto space-y-4 text-left transition-all duration-300"
                >
                    <form @submit.prevent="submitWish()" class="space-y-3.5 text-xs">
                        <div>
                            <label class="font-bold block mb-1">Nama Lengkap</label>
                            <input 
                                type="text" 
                                x-model="wishForm.name" 
                                required
                                :style="{ borderColor: currentStyle.border_color }"
                                :class="currentStyle.is_dark ? 'bg-black/40 text-white' : 'bg-sand-50/70 text-stone-900'"
                                class="w-full px-3.5 py-2.5 rounded-xl border focus:outline-none focus:ring-2 focus:ring-amber-500"
                            >
                        </div>

                        <div>
                            <label class="font-bold block mb-1">Konfirmasi Kehadiran</label>
                            <select 
                                x-model="wishForm.attendance"
                                :style="{ borderColor: currentStyle.border_color }"
                                :class="currentStyle.is_dark ? 'bg-stone-900 text-white' : 'bg-sand-50/70 text-stone-900'"
                                class="w-full px-3.5 py-2.5 rounded-xl border focus:outline-none focus:ring-2 focus:ring-amber-500"
                            >
                                <option value="Hadir (1 Orang)">Hadir (1 Orang)</option>
                                <option value="Hadir (2 Orang)">Hadir (2 Orang)</option>
                                <option value="Masih Ragu">Masih Ragu</option>
                                <option value="Tidak Hadir">Mohon Maaf, Tidak Bisa Hadir</option>
                            </select>
                        </div>

                        <div>
                            <label class="font-bold block mb-1">Pesan & Doa Restu</label>
                            <textarea 
                                x-model="wishForm.message" 
                                rows="3" 
                                required
                                placeholder="Tuliskan ucapan selamat & doa restu Anda..." 
                                :style="{ borderColor: currentStyle.border_color }"
                                :class="currentStyle.is_dark ? 'bg-black/40 text-white' : 'bg-sand-50/70 text-stone-900'"
                                class="w-full px-3.5 py-2.5 rounded-xl border focus:outline-none focus:ring-2 focus:ring-amber-500"
                            ></textarea>
                        </div>

                        <button 
                            type="submit" 
                            :style="{ backgroundColor: currentStyle.btn_bg, color: currentStyle.btn_text }"
                            class="w-full py-3 rounded-2xl font-bold text-xs shadow-md transition flex items-center justify-center gap-2 hover:opacity-90"
                        >
                            <i data-lucide="send" class="w-4 h-4"></i>
                            <span>Kirim Ucapan & Konfirmasi</span>
                        </button>
                    </form>
                </div>

                <!-- WISHES LIST FEED -->
                <div class="max-w-sm mx-auto space-y-3 text-left">
                    <template x-for="(w, idx) in wishes" :key="idx">
                        <div 
                            :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }"
                            class="p-4 rounded-2xl border shadow-sm space-y-1.5"
                        >
                            <div class="flex items-center justify-between gap-2">
                                <span :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'" class="font-bold text-xs" x-text="w.name"></span>
                                <span 
                                    :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }"
                                    class="px-2 py-0.5 rounded-full text-[9px] font-semibold" 
                                    x-text="w.attendance"
                                ></span>
                            </div>
                            <p :style="{ color: currentStyle.text_secondary }" class="text-xs leading-relaxed italic" x-text="w.message"></p>
                            <span class="text-[10px] opacity-60 block text-right" x-text="w.time"></span>
                        </div>
                    </template>
                </div>
            </section>

            <!-- FOOTER SIGNATURE -->
            <footer :style="{ borderColor: currentStyle.border_color, color: currentStyle.text_secondary }" class="text-center pt-8 border-t space-y-3 max-w-sm mx-auto text-xs">
                <p>Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.</p>
                <div :class="currentStyle.font_heading === 'Playfair Display' ? 'font-serif' : 'font-sans'" :style="{ color: currentStyle.text_primary }" class="text-lg font-bold">
                    {{ $data['groom']['nickname'] }} & {{ $data['bride']['nickname'] }}
                </div>
                <div class="pt-4 text-[10px] opacity-60">
                    Platform Undangan Digital oleh <a href="{{ route('home') }}" class="underline font-bold">KlikMomen.id</a>
                </div>
            </footer>

        </div>

        <!-- ========================================== -->
        <!-- 4. FLOATING BOTTOM NAVIGATION BAR -->
        <!-- ========================================== -->
        <nav 
            x-show="isOpened" 
            x-transition
            class="fixed bottom-4 inset-x-4 max-w-sm mx-auto z-40 bg-stone-950/90 backdrop-blur-md rounded-full border border-white/20 shadow-2xl p-1.5 flex items-center justify-around text-stone-400 text-[10px]"
        >
            <a href="#sec-cover" class="p-2 hover:text-amber-300 flex flex-col items-center gap-0.5">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Cover</span>
            </a>
            <a href="#sec-mempelai" class="p-2 hover:text-amber-300 flex flex-col items-center gap-0.5">
                <i data-lucide="heart" class="w-4 h-4"></i>
                <span>Mempelai</span>
            </a>
            <a href="#sec-acara" class="p-2 hover:text-amber-300 flex flex-col items-center gap-0.5">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                <span>Acara</span>
            </a>
            <a href="#sec-galeri" class="p-2 hover:text-amber-300 flex flex-col items-center gap-0.5">
                <i data-lucide="image" class="w-4 h-4"></i>
                <span>Galeri</span>
            </a>
            <a href="#sec-amplop" class="p-2 hover:text-amber-300 flex flex-col items-center gap-0.5">
                <i data-lucide="gift" class="w-4 h-4"></i>
                <span>Amplop</span>
            </a>
            <a href="#sec-ucapan" class="p-2 hover:text-amber-300 flex flex-col items-center gap-0.5">
                <i data-lucide="message-square" class="w-4 h-4"></i>
                <span>RSVP</span>
            </a>
        </nav>



        <!-- LIGHTBOX MODAL -->
        <div 
            x-show="lightbox.open" 
            x-transition 
            @click="lightbox.open = false" 
            class="fixed inset-0 z-50 bg-black/95 backdrop-blur-md flex items-center justify-center p-4"
            style="display: none;"
        >
            <img :src="lightbox.imgUrl" class="max-h-[85vh] max-w-full rounded-2xl shadow-2xl object-contain">
        </div>

    </div>

    <!-- ALPINE SCRIPT -->
    <script>
        function weddingInvitationApp() {
            return {
                isOpened: false,
                isPlaying: false,
                customizerOpen: false,
                audioEl: null,
                toast: { show: false, message: '' },
                lightbox: { open: false, imgUrl: '' },
                presets: @json($presets),
                currentStyle: @json($activeStyle),
                wishForm: { name: '{{ $guestName }}', attendance: 'Hadir (2 Orang)', message: '' },
                wishes: @json($data['sample_wishes']),
                countdown: { days: '00', hours: '00', minutes: '00', seconds: '00' },
                
                initApp() {
                    this.audioEl = document.getElementById('bgMusic');
                    this.startCountdown();
                    this.$nextTick(() => {
                        if (window.lucide) {
                            window.lucide.createIcons();
                        }
                    });
                },

                switchPreset(key) {
                    if (this.presets[key]) {
                        this.currentStyle = this.presets[key];
                        this.showToast('Gaya diubah: ' + this.currentStyle.name);
                        this.$nextTick(() => {
                            if (window.lucide) {
                                window.lucide.createIcons();
                            }
                        });
                    }
                },

                openInvitation() {
                    this.isOpened = true;
                    if (this.audioEl) {
                        this.audioEl.play().then(() => {
                            this.isPlaying = true;
                        }).catch(() => {
                            this.isPlaying = false;
                        });
                    }
                    this.$nextTick(() => {
                        if (window.lucide) {
                            window.lucide.createIcons();
                        }
                    });
                },

                toggleMusic() {
                    if (!this.audioEl) return;
                    if (this.isPlaying) {
                        this.audioEl.pause();
                        this.isPlaying = false;
                    } else {
                        this.audioEl.play();
                        this.isPlaying = true;
                    }
                },

                copyToClipboard(text, label) {
                    navigator.clipboard.writeText(text);
                    this.showToast(label + ' berhasil disalin ke clipboard!');
                },

                showToast(msg) {
                    this.toast.message = msg;
                    this.toast.show = true;
                    setTimeout(() => {
                        this.toast.show = false;
                    }, 3500);
                },

                openLightbox(url) {
                    this.lightbox.imgUrl = url;
                    this.lightbox.open = true;
                },

                async submitWish() {
                    if (!this.wishForm.message.trim()) return;
                    this.wishForm.loading = true;
                    try {
                        const res = await fetch('{{ url('/u/' . ($invitation->slug ?? '')) }}/wishes', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            body: JSON.stringify({ guest_name: this.wishForm.name, attendance: this.wishForm.attendance, message: this.wishForm.message })
                        });
                        const json = await res.json();
                        if (json.success) {
                            this.wishes.unshift({ name: json.wish.name, attendance: json.wish.attendance, message: json.wish.message, time: json.wish.time });
                            this.wishForm.message = '';
                            this.showToast('Terima kasih! Doa restu Anda telah terkirim.');
                        }
                    } finally {
                        this.wishForm.loading = false;
                    }
                },

                startCountdown() {
                    const target = new Date('{{ $data["countdown_target"] }}').getTime();
                    setInterval(() => {
                        const now = new Date().getTime();
                        const diff = target - now;
                        if (diff > 0) {
                            this.countdown.days = String(Math.floor(diff / (1000 * 60 * 60 * 24))).padStart(2, '0');
                            this.countdown.hours = String(Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                            this.countdown.minutes = String(Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                            this.countdown.seconds = String(Math.floor((diff % (1000 * 60)) / 1000)).padStart(2, '0');
                        }
                    }, 1000);
                }
            }
        }
    </script>
    @include('demo.partials.preview-sync')
</body>
</html>
