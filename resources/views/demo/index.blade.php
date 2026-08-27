<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>The Wedding of Raka & Arinda</title>

    <!-- Meta SEO & Social Sharing Preview (OpenGraph) -->
    <meta name="description" content="Tanpa mengurangi rasa hormat, kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk hadir di acara pernikahan kami.">
    <meta property="og:title" content="The Wedding of Raka & Arinda">
    <meta property="og:description" content="Sabtu, 24 Oktober 2026 - Jakarta">
    <meta property="og:image" content="{{ $theme['cover_bg'] }}">

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

        @keyframes music-disc {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-music-disc {
            animation: music-disc 8s linear infinite;
        }

        @keyframes bar-dance {
            0%, 100% { height: 4px; }
            50% { height: 16px; }
        }
        .bar-1 { animation: bar-dance 0.9s ease-in-out infinite; }
        .bar-2 { animation: bar-dance 1.2s ease-in-out infinite 0.2s; }
        .bar-3 { animation: bar-dance 0.7s ease-in-out infinite 0.4s; }
        .bar-4 { animation: bar-dance 1.1s ease-in-out infinite 0.1s; }

        .glass-card {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        /* Hide scrollbars but keep functionality */
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
    class="bg-stone-900 text-stone-900 font-sans antialiased overflow-x-hidden min-h-screen"
    x-data="weddingInvitationApp()"
    x-init="initApp()"
>
    <!-- AUDIO ELEMENT -->
    <audio id="bgMusic" loop preload="auto">
        <source src="{{ $theme['audio_url'] }}" type="audio/mp3">
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
        class="fixed top-6 left-1/2 -translate-x-1/2 z-50 px-5 py-3 rounded-full bg-stone-900/95 backdrop-blur-md text-white shadow-2xl border border-white/20 flex items-center gap-3 text-xs sm:text-sm font-medium"
        style="display: none;"
    >
        <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
            <i data-lucide="check" class="w-3.5 h-3.5"></i>
        </span>
        <span x-text="toast.message"></span>
    </div>

    <!-- MAIN WRAPPER (RESPONSIVE: CENTERED ON DESKTOP, FULL VIEWPORT ON MOBILE) -->
    <div class="max-w-md mx-auto min-h-screen {{ $theme['palette']['bg_main'] }} {{ $theme['palette']['text_primary'] }} shadow-2xl relative">

        <!-- ========================================== -->
        <!-- 1. FULLSCREEN COVER / ENVELOPE OPENER -->
        <!-- ========================================== -->
        <div 
            x-show="!isOpened"
            x-transition:leave="transition ease-in-out duration-700 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-full scale-95 pointer-events-none"
            class="fixed inset-0 max-w-md mx-auto z-50 flex flex-col justify-between p-8 text-center text-white bg-cover bg-center overflow-hidden"
            style="background-image: url('{{ $theme['cover_bg'] }}');"
        >
            <!-- DARK GRADIENT OVERLAY -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/45 to-black/90 z-0"></div>

            <!-- TOP HEADER BADGE -->
            <div class="relative z-10 pt-8 space-y-2">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-[11px] font-semibold tracking-widest uppercase text-amber-200">
                    The Wedding Invitation
                </div>
                <p class="text-xs font-light text-white/80 tracking-widest uppercase">Walimatul 'Ursy</p>
            </div>

            <!-- COUPLE NAMES ON COVER -->
            <div class="relative z-10 space-y-3 my-auto">
                <h1 class="font-serif text-4xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                    {{ $data['groom']['nickname'] }} <span class="font-script text-5xl sm:text-6xl text-amber-300 font-normal">&</span> {{ $data['bride']['nickname'] }}
                </h1>
                <div class="w-20 h-0.5 bg-gradient-to-r from-transparent via-amber-300 to-transparent mx-auto"></div>
                <p class="text-sm font-medium text-amber-100/90 tracking-wide">
                    {{ $data['events']['akad']['date'] }}
                </p>
            </div>

            <!-- GUEST RECIPIENT BOX & OPEN BUTTON -->
            <div class="relative z-10 pb-8 space-y-4">
                <div class="p-4 rounded-2xl bg-black/45 backdrop-blur-md border border-white/20 text-center space-y-1.5 max-w-xs mx-auto">
                    <span class="text-[10px] uppercase font-medium tracking-[0.2em] text-white/70">Kepada Yth. Bapak/Ibu/Saudara(i):</span>
                    <h4 class="font-serif text-lg font-bold text-amber-200">{{ $guestName }}</h4>
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
        <!-- 2. FLOATING MUSIC CONTROLLER BUTTON -->
        <!-- ========================================== -->
        <div 
            x-show="isOpened" 
            x-transition
            class="fixed bottom-20 right-4 sm:right-[calc(50%-200px)] z-40"
        >
            <button 
                @click="toggleMusic()" 
                class="w-12 h-12 rounded-full bg-stone-950/90 backdrop-blur-md text-amber-300 shadow-2xl border border-amber-500/40 flex items-center justify-center hover:scale-110 active:scale-95 transition"
                title="Musik Latar"
            >
                <template x-if="isPlaying">
                    <div class="flex items-end gap-0.5 h-4">
                        <span class="w-1 bg-amber-400 rounded-full bar-1"></span>
                        <span class="w-1 bg-amber-400 rounded-full bar-2"></span>
                        <span class="w-1 bg-amber-400 rounded-full bar-3"></span>
                        <span class="w-1 bg-amber-400 rounded-full bar-4"></span>
                    </div>
                </template>
                <template x-if="!isPlaying">
                    <i data-lucide="volume-x" class="w-5 h-5 text-stone-400"></i>
                </template>
            </button>
        </div>

        <!-- ========================================== -->
        <!-- 3. INVITATION MAIN CONTENT BODY -->
        <!-- ========================================== -->
        <div x-show="isOpened" class="space-y-16 pb-28">
            
            <!-- SECTION: HERO COVER -->
            <section id="sec-cover" class="relative min-h-[520px] flex flex-col justify-between p-6 sm:p-8 text-center text-white bg-cover bg-center rounded-b-[44px] shadow-xl overflow-hidden" style="background-image: url('{{ $theme['cover_bg'] }}');">
                <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-black/85"></div>
                
                <div class="relative z-10 pt-6">
                    <span class="text-[11px] uppercase tracking-[0.3em] font-semibold text-amber-300">The Wedding Of</span>
                </div>

                <div class="relative z-10 space-y-2 my-auto">
                    <h2 class="font-serif text-4xl sm:text-5xl font-bold tracking-tight">
                        {{ $data['groom']['nickname'] }} & {{ $data['bride']['nickname'] }}
                    </h2>
                    <p class="text-sm font-light text-amber-100 tracking-wider">
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

            <!-- SECTION: AYAT SUCI & DOA RESTU -->
            <section class="px-6 text-center space-y-4 max-w-sm mx-auto">
                <div class="w-12 h-12 rounded-full {{ $theme['palette']['icon_bg'] }} flex items-center justify-center mx-auto shadow-sm">
                    <i data-lucide="heart" class="w-5 h-5 fill-current"></i>
                </div>
                
                <h3 class="font-serif text-lg font-bold">Maha Suci Allah SWT</h3>
                <p class="font-editorial text-base sm:text-lg italic leading-relaxed {{ $theme['palette']['text_secondary'] }}">
                    "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
                </p>
                <span class="text-xs font-bold tracking-wider uppercase {{ $theme['palette']['text_accent'] }}">
                    (QS. Ar-Rum: 21)
                </span>
            </section>

            <!-- SECTION: KEDUA MEMPELAI (BRIDE & GROOM) -->
            <section id="sec-mempelai" class="px-6 space-y-8">
                <div class="text-center space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-[0.2em] {{ $theme['palette']['text_accent'] }}">Kedua Mempelai</span>
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold">Pasangan Pengantin</h3>
                    <p class="text-xs {{ $theme['palette']['text_secondary'] }}">Dengan memohon rahmat dan ridho Allah SWT, kami mengundang Anda dalam pernikahan kami:</p>
                </div>

                <!-- GROOM CARD -->
                <div class="p-6 rounded-3xl {{ $theme['palette']['bg_card'] }} border {{ $theme['palette']['border_color'] }} shadow-md text-center space-y-4 max-w-sm mx-auto">
                    <div class="relative w-32 h-32 mx-auto rounded-full overflow-hidden ring-4 ring-amber-400/30 shadow-inner">
                        <img src="{{ $theme['groom_photo'] }}" alt="{{ $data['groom']['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-serif text-xl font-bold">{{ $data['groom']['name'] }}</h4>
                        <p class="text-xs {{ $theme['palette']['text_secondary'] }} leading-relaxed">
                            {{ $data['groom']['child_order'] }} dari pasangan<br>
                            <strong class="font-semibold {{ $theme['palette']['text_primary'] }}">{{ $data['groom']['father'] }}</strong> & <strong class="font-semibold {{ $theme['palette']['text_primary'] }}">{{ $data['groom']['mother'] }}</strong>
                        </p>
                    </div>
                    <a href="https://instagram.com/{{ $data['groom']['instagram'] }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-semibold {{ $theme['palette']['tag_bg'] }} hover:opacity-80 transition">
                        <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                        <span>{{ '@' . $data['groom']['instagram'] }}</span>
                    </a>
                </div>

                <!-- AMPERSAND DIVIDER -->
                <div class="text-center">
                    <span class="font-script text-5xl {{ $theme['palette']['text_accent'] }}">&</span>
                </div>

                <!-- BRIDE CARD -->
                <div class="p-6 rounded-3xl {{ $theme['palette']['bg_card'] }} border {{ $theme['palette']['border_color'] }} shadow-md text-center space-y-4 max-w-sm mx-auto">
                    <div class="relative w-32 h-32 mx-auto rounded-full overflow-hidden ring-4 ring-amber-400/30 shadow-inner">
                        <img src="{{ $theme['bride_photo'] }}" alt="{{ $data['bride']['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-serif text-xl font-bold">{{ $data['bride']['name'] }}</h4>
                        <p class="text-xs {{ $theme['palette']['text_secondary'] }} leading-relaxed">
                            {{ $data['bride']['child_order'] }} dari pasangan<br>
                            <strong class="font-semibold {{ $theme['palette']['text_primary'] }}">{{ $data['bride']['father'] }}</strong> & <strong class="font-semibold {{ $theme['palette']['text_primary'] }}">{{ $data['bride']['mother'] }}</strong>
                        </p>
                    </div>
                    <a href="https://instagram.com/{{ $data['bride']['instagram'] }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-semibold {{ $theme['palette']['tag_bg'] }} hover:opacity-80 transition">
                        <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                        <span>{{ '@' . $data['bride']['instagram'] }}</span>
                    </a>
                </div>
            </section>

            <!-- SECTION: RANGKAIAN ACARA & COUNTDOWN TIMER -->
            <section id="sec-acara" class="px-6 space-y-8">
                <div class="text-center space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-[0.2em] {{ $theme['palette']['text_accent'] }}">Save The Date</span>
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold">Rangkaian Acara</h3>
                    <p class="text-xs {{ $theme['palette']['text_secondary'] }}">Waktu dan lokasi prosesi pernikahan kami</p>
                </div>

                <!-- LIVE COUNTDOWN TIMER CARD -->
                <div class="p-6 rounded-3xl {{ $theme['palette']['bg_card'] }} border {{ $theme['palette']['border_color'] }} shadow-md max-w-sm mx-auto text-center space-y-4">
                    <span class="text-xs font-bold uppercase tracking-wider {{ $theme['palette']['text_accent'] }}">Menuju Hari Bahagia</span>
                    <div class="grid grid-cols-4 gap-2">
                        <div class="p-2.5 rounded-2xl {{ $theme['palette']['tag_bg'] }}">
                            <div class="font-serif text-xl sm:text-2xl font-bold" x-text="countdown.days">00</div>
                            <div class="text-[9px] uppercase font-semibold">Hari</div>
                        </div>
                        <div class="p-2.5 rounded-2xl {{ $theme['palette']['tag_bg'] }}">
                            <div class="font-serif text-xl sm:text-2xl font-bold" x-text="countdown.hours">00</div>
                            <div class="text-[9px] uppercase font-semibold">Jam</div>
                        </div>
                        <div class="p-2.5 rounded-2xl {{ $theme['palette']['tag_bg'] }}">
                            <div class="font-serif text-xl sm:text-2xl font-bold" x-text="countdown.minutes">00</div>
                            <div class="text-[9px] uppercase font-semibold">Menit</div>
                        </div>
                        <div class="p-2.5 rounded-2xl {{ $theme['palette']['tag_bg'] }}">
                            <div class="font-serif text-xl sm:text-2xl font-bold" x-text="countdown.seconds">00</div>
                            <div class="text-[9px] uppercase font-semibold">Detik</div>
                        </div>
                    </div>
                    
                    <!-- GOOGLE CALENDAR BUTTON -->
                    <a 
                        href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Pernikahan+Raka+%26+Arinda&dates=20261024T010000Z/20261024T070000Z&details=Pernikahan+Raka+Pratama+dan+Arinda+Putri&location=Grand+Ballroom+The+Ritz-Carlton+Jakarta" 
                        target="_blank"
                        class="inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-2xl {{ $theme['palette']['tag_bg'] }} hover:opacity-90 font-semibold text-xs transition"
                    >
                        <i data-lucide="calendar-plus" class="w-4 h-4"></i>
                        <span>Simpan ke Google Calendar</span>
                    </a>
                </div>

                <!-- AKAD NIKAH CARD -->
                <div class="p-6 rounded-3xl {{ $theme['palette']['bg_card'] }} border {{ $theme['palette']['border_color'] }} shadow-md max-w-sm mx-auto text-center space-y-4">
                    <div class="w-10 h-10 rounded-2xl {{ $theme['palette']['icon_bg'] }} flex items-center justify-center mx-auto">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-serif text-xl font-bold">{{ $data['events']['akad']['title'] }}</h4>
                        <p class="text-xs font-semibold {{ $theme['palette']['text_accent'] }}">{{ $data['events']['akad']['date'] }}</p>
                        <p class="text-xs font-bold">{{ $data['events']['akad']['time'] }}</p>
                    </div>
                    <div class="pt-2 border-t {{ $theme['palette']['border_color'] }} text-xs {{ $theme['palette']['text_secondary'] }} space-y-1">
                        <p class="font-bold {{ $theme['palette']['text_primary'] }}">{{ $data['events']['akad']['venue'] }}</p>
                        <p>{{ $data['events']['akad']['address'] }}</p>
                    </div>
                    <a href="{{ $data['events']['akad']['maps_link'] }}" target="_blank" class="inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-2xl {{ $theme['palette']['btn_primary'] }} font-semibold text-xs shadow transition">
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        <span>Buka Google Maps</span>
                    </a>
                </div>

                <!-- RESEPSI PERNIKAHAN CARD -->
                <div class="p-6 rounded-3xl {{ $theme['palette']['bg_card'] }} border {{ $theme['palette']['border_color'] }} shadow-md max-w-sm mx-auto text-center space-y-4">
                    <div class="w-10 h-10 rounded-2xl {{ $theme['palette']['icon_bg'] }} flex items-center justify-center mx-auto">
                        <i data-lucide="glass-water" class="w-5 h-5"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-serif text-xl font-bold">{{ $data['events']['resepsi']['title'] }}</h4>
                        <p class="text-xs font-semibold {{ $theme['palette']['text_accent'] }}">{{ $data['events']['resepsi']['date'] }}</p>
                        <p class="text-xs font-bold">{{ $data['events']['resepsi']['time'] }}</p>
                    </div>
                    <div class="pt-2 border-t {{ $theme['palette']['border_color'] }} text-xs {{ $theme['palette']['text_secondary'] }} space-y-1">
                        <p class="font-bold {{ $theme['palette']['text_primary'] }}">{{ $data['events']['resepsi']['venue'] }}</p>
                        <p>{{ $data['events']['resepsi']['address'] }}</p>
                    </div>
                    <a href="{{ $data['events']['resepsi']['maps_link'] }}" target="_blank" class="inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-2xl {{ $theme['palette']['btn_primary'] }} font-semibold text-xs shadow transition">
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        <span>Buka Google Maps</span>
                    </a>
                </div>
            </section>

            <!-- SECTION: LOVE STORY TIMELINE -->
            <section id="sec-cerita" class="px-6 space-y-6">
                <div class="text-center space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-[0.2em] {{ $theme['palette']['text_accent'] }}">Our Journey</span>
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold">Kisah Cinta Kami</h3>
                    <p class="text-xs {{ $theme['palette']['text_secondary'] }}">Sepenggal perjalanan indah yang membawa kami ke hari ini</p>
                </div>

                <div class="max-w-sm mx-auto space-y-4 relative before:absolute before:inset-0 before:left-4 before:w-0.5 before:bg-amber-400/40">
                    @foreach ($data['stories'] as $story)
                        <div class="relative flex items-start gap-4 pl-8">
                            <div class="absolute left-2.5 top-1.5 w-3.5 h-3.5 rounded-full bg-amber-500 ring-4 ring-white shadow"></div>
                            <div class="p-4 rounded-2xl {{ $theme['palette']['bg_card'] }} border {{ $theme['palette']['border_color'] }} shadow-sm space-y-1 w-full text-left">
                                <span class="text-[10px] font-bold uppercase tracking-wider {{ $theme['palette']['text_accent'] }}">{{ $story['year'] }}</span>
                                <h5 class="font-serif text-sm font-bold">{{ $story['title'] }}</h5>
                                <p class="text-xs {{ $theme['palette']['text_secondary'] }} leading-relaxed">{{ $story['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- SECTION: GALERI PREWEDDING -->
            <section id="sec-galeri" class="px-6 space-y-6">
                <div class="text-center space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-[0.2em] {{ $theme['palette']['text_accent'] }}">Memories</span>
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold">Galeri Foto Bahagia</h3>
                    <p class="text-xs {{ $theme['palette']['text_secondary'] }}">Potret kebersamaan dan momen indah kami</p>
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

                <!-- VIDEO PREWEDDING TEASER -->
                <div class="max-w-sm mx-auto p-4 rounded-3xl {{ $theme['palette']['bg_card'] }} border {{ $theme['palette']['border_color'] }} shadow text-center space-y-3">
                    <span class="text-xs font-bold uppercase tracking-wider {{ $theme['palette']['text_accent'] }}">Video Cinematic</span>
                    <div class="relative aspect-video rounded-2xl overflow-hidden bg-black flex items-center justify-center group shadow-inner">
                        <img src="{{ $theme['cover_bg'] }}" alt="Video Thumbnail" class="w-full h-full object-cover opacity-60">
                        <div class="absolute w-12 h-12 rounded-full bg-amber-500 text-stone-950 flex items-center justify-center group-hover:scale-110 transition shadow-lg">
                            <i data-lucide="play" class="w-5 h-5 fill-current ml-0.5"></i>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION: AMPLOP DIGITAL & KADO ONLINE -->
            <section id="sec-amplop" class="px-6 space-y-6">
                <div class="text-center space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-[0.2em] {{ $theme['palette']['text_accent'] }}">Wedding Gift</span>
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold">Amplop Digital & Kado</h3>
                    <p class="text-xs {{ $theme['palette']['text_secondary'] }}">Doa restu Anda adalah hadiah terindah. Namun jika ingin memberikan tanda kasih secara digital, Anda dapat menggunakan fasilitas di bawah ini:</p>
                </div>

                <div class="max-w-sm mx-auto space-y-4">
                    @foreach ($data['bank_accounts'] as $acc)
                        <div class="p-5 rounded-3xl bg-gradient-to-br {{ $acc['color'] }} text-white shadow-xl space-y-3 relative overflow-hidden">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold tracking-wider uppercase">{{ $acc['bank'] }}</span>
                                <i data-lucide="credit-card" class="w-5 h-5 opacity-75"></i>
                            </div>
                            <div class="pt-2">
                                <span class="text-[10px] uppercase text-white/70">Nomor Rekening:</span>
                                <p class="font-mono text-lg font-bold tracking-wider">{{ $acc['account_number'] }}</p>
                                <p class="text-xs text-white/90">a.n. {{ $acc['account_name'] }}</p>
                            </div>
                            <button 
                                @click="copyText('{{ $acc['account_number'] }}', 'Nomor rekening {{ $acc['bank'] }} berhasil disalin!')"
                                class="w-full py-2 rounded-xl bg-white/20 hover:bg-white/30 backdrop-blur-md text-xs font-bold flex items-center justify-center gap-1.5 transition"
                            >
                                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                <span>Salin No. Rekening</span>
                            </button>
                        </div>
                    @endforeach

                    <!-- KIRIM KADO FISIK -->
                    <div class="p-5 rounded-3xl {{ $theme['palette']['bg_card'] }} border {{ $theme['palette']['border_color'] }} shadow text-center space-y-3">
                        <div class="w-10 h-10 rounded-2xl {{ $theme['palette']['icon_bg'] }} flex items-center justify-center mx-auto">
                            <i data-lucide="gift" class="w-5 h-5"></i>
                        </div>
                        <div class="space-y-1">
                            <h5 class="font-serif text-base font-bold">Kirim Kado Fisik</h5>
                            <p class="text-xs {{ $theme['palette']['text_secondary'] }}">{{ $data['gift_address'] }}</p>
                        </div>
                        <button 
                            @click="copyText('{{ $data['gift_address'] }}', 'Alamat pengiriman kado berhasil disalin!')"
                            class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl {{ $theme['palette']['tag_bg'] }} text-xs font-semibold hover:opacity-80 transition"
                        >
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                            <span>Salin Alamat Kado</span>
                        </button>
                    </div>
                </div>
            </section>

            <!-- SECTION: RSVP & UCAPAN DOA (BUKU TAMU INTERAKTIF) -->
            <section id="sec-rsvp" class="px-6 space-y-6">
                <div class="text-center space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-[0.2em] {{ $theme['palette']['text_accent'] }}">Guestbook & RSVP</span>
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold">Ucapan & Doa Restu</h3>
                    <p class="text-xs {{ $theme['palette']['text_secondary'] }}">Konfirmasi kehadiran dan kirimkan doa terbaik Anda untuk kami</p>
                </div>

                <!-- FORM RSVP -->
                <div class="p-6 rounded-3xl {{ $theme['palette']['bg_card'] }} border {{ $theme['palette']['border_color'] }} shadow-md max-w-sm mx-auto space-y-4">
                    
                    <form @submit.prevent="submitWish()" class="space-y-3 text-left text-xs">
                        <div>
                            <label class="block font-bold mb-1 {{ $theme['palette']['text_primary'] }}">Nama Anda:</label>
                            <input 
                                type="text" 
                                x-model="wishForm.name" 
                                required 
                                placeholder="Nama Lengkap / Panggilan" 
                                class="w-full px-3.5 py-2.5 rounded-xl border {{ $theme['palette']['border_color'] }} bg-stone-50 text-stone-900 outline-none focus:ring-2 focus:ring-amber-500"
                            >
                        </div>

                        <div>
                            <label class="block font-bold mb-1 {{ $theme['palette']['text_primary'] }}">Konfirmasi Kehadiran:</label>
                            <select 
                                x-model="wishForm.attendance" 
                                class="w-full px-3.5 py-2.5 rounded-xl border {{ $theme['palette']['border_color'] }} bg-stone-50 text-stone-900 outline-none focus:ring-2 focus:ring-amber-500"
                            >
                                <option value="Hadir (1 Orang)">Hadir (1 Orang)</option>
                                <option value="Hadir (2 Orang)">Hadir (2 Orang)</option>
                                <option value="Tidak Hadir (Kirim Doa)">Tidak Hadir (Kirim Doa)</option>
                                <option value="Masih Ragu / Tentatif">Masih Ragu / Tentatif</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-1 {{ $theme['palette']['text_primary'] }}">Pesan Ucapan & Doa:</label>
                            <textarea 
                                x-model="wishForm.message" 
                                rows="3" 
                                required 
                                placeholder="Tuliskan ucapan dan doa tulus Anda untuk kami..." 
                                class="w-full px-3.5 py-2.5 rounded-xl border {{ $theme['palette']['border_color'] }} bg-stone-50 text-stone-900 outline-none focus:ring-2 focus:ring-amber-500"
                            ></textarea>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full py-3 rounded-2xl {{ $theme['palette']['btn_primary'] }} font-bold text-xs shadow hover:opacity-90 active:scale-98 transition flex items-center justify-center gap-1.5"
                        >
                            <i data-lucide="send" class="w-3.5 h-3.5"></i>
                            <span>Kirim Konfirmasi & Ucapan</span>
                        </button>
                    </form>

                </div>

                <!-- LIVE WISHES LIST -->
                <div class="max-w-sm mx-auto space-y-3">
                    <h5 class="font-serif text-sm font-bold text-left flex items-center gap-1.5">
                        <i data-lucide="messages-square" class="w-4 h-4 text-amber-500"></i>
                        <span>Ucapan Terbaru (<span x-text="wishesList.length"></span>)</span>
                    </h5>

                    <div class="space-y-2.5 max-h-72 overflow-y-auto pr-1">
                        <template x-for="(w, idx) in wishesList" :key="idx">
                            <div class="p-3.5 rounded-2xl {{ $theme['palette']['bg_card'] }} border {{ $theme['palette']['border_color'] }} shadow-sm text-left space-y-1">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-bold text-xs {{ $theme['palette']['text_primary'] }}" x-text="w.name"></span>
                                    <span class="text-[9px] px-2 py-0.5 rounded-full {{ $theme['palette']['tag_bg'] }} font-semibold" x-text="w.attendance"></span>
                                </div>
                                <p class="text-xs {{ $theme['palette']['text_secondary'] }}" x-text="w.message"></p>
                                <div class="text-[9px] text-stone-400 pt-1" x-text="w.time"></div>
                            </div>
                        </template>
                    </div>
                </div>

            </section>

            <!-- SECTION: PENUTUP & TERIMA KASIH -->
            <section class="px-6 text-center space-y-4 max-w-sm mx-auto pt-8 border-t {{ $theme['palette']['border_color'] }}">
                <h4 class="font-serif text-xl font-bold">Terima Kasih</h4>
                <p class="text-xs leading-relaxed {{ $theme['palette']['text_secondary'] }}">
                    Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu kepada kami.
                </p>
                <div class="pt-2 space-y-1">
                    <span class="text-[10px] uppercase tracking-widest font-semibold {{ $theme['palette']['text_accent'] }}">Kami yang berbahagia,</span>
                    <h3 class="font-script text-4xl {{ $theme['palette']['text_accent'] }}">
                        {{ $data['groom']['nickname'] }} & {{ $data['bride']['nickname'] }}
                    </h3>
                    <p class="text-xs {{ $theme['palette']['text_secondary'] }}">Beserta Keluarga Besar Kedua Mempelai</p>
                </div>

                <!-- FOOTER BRANDING WATERMARK -->
                <div class="pt-10 pb-4 text-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-[11px] text-stone-400 hover:text-stone-700 transition">
                        <span>Dibuat dengan</span>
                        <i data-lucide="heart" class="w-3 h-3 text-rose-500 fill-current"></i>
                        <span>oleh <strong>KalaUndangan</strong></span>
                    </a>
                </div>
            </section>

        </div>

        <!-- ========================================== -->
        <!-- 4. FLOATING BOTTOM NAVIGATION BAR (DOCKED) -->
        <!-- ========================================== -->
        <nav 
            x-show="isOpened" 
            x-transition
            class="fixed bottom-3 left-1/2 -translate-x-1/2 z-40 w-[90%] max-w-xs p-1.5 rounded-full glass-card border border-amber-500/30 shadow-2xl flex items-center justify-around text-stone-800"
            style="backdrop-filter: blur(16px);"
        >
            <button @click="scrollTo('sec-cover')" title="Sampul" class="p-2 rounded-full hover:bg-black/10 active:scale-90 transition">
                <i data-lucide="home" class="w-4 h-4"></i>
            </button>
            <button @click="scrollTo('sec-mempelai')" title="Mempelai" class="p-2 rounded-full hover:bg-black/10 active:scale-90 transition">
                <i data-lucide="heart" class="w-4 h-4"></i>
            </button>
            <button @click="scrollTo('sec-acara')" title="Acara" class="p-2 rounded-full hover:bg-black/10 active:scale-90 transition">
                <i data-lucide="calendar" class="w-4 h-4"></i>
            </button>
            <button @click="scrollTo('sec-cerita')" title="Kisah" class="p-2 rounded-full hover:bg-black/10 active:scale-90 transition">
                <i data-lucide="book-heart" class="w-4 h-4"></i>
            </button>
            <button @click="scrollTo('sec-galeri')" title="Galeri" class="p-2 rounded-full hover:bg-black/10 active:scale-90 transition">
                <i data-lucide="image" class="w-4 h-4"></i>
            </button>
            <button @click="scrollTo('sec-amplop')" title="Amplop" class="p-2 rounded-full hover:bg-black/10 active:scale-90 transition">
                <i data-lucide="gift" class="w-4 h-4"></i>
            </button>
            <button @click="scrollTo('sec-rsvp')" title="RSVP" class="p-2 rounded-full hover:bg-black/10 active:scale-90 transition">
                <i data-lucide="message-square" class="w-4 h-4"></i>
            </button>
        </nav>

    </div>

    <!-- LIGHTBOX IMAGE MODAL -->
    <div 
        x-show="lightbox.open" 
        x-transition
        @click="lightbox.open = false" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-md cursor-pointer"
        style="display: none;"
    >
        <div class="relative max-w-xl max-h-[85vh] rounded-2xl overflow-hidden shadow-2xl">
            <img :src="lightbox.imgUrl" alt="Enlarged Photo" class="w-full h-full object-contain">
            <button @click="lightbox.open = false" class="absolute top-4 right-4 p-2 rounded-full bg-black/60 text-white hover:bg-black transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
    </div>

    <!-- ALPINE JS LOGIC SCRIPT -->
    <script>
        function weddingInvitationApp() {
            return {
                isOpened: false,
                isPlaying: false,
                countdownTarget: new Date('{{ $data['countdown_target'] }}').getTime(),
                countdown: { days: '00', hours: '00', minutes: '00', seconds: '00' },
                toast: { show: false, message: '' },
                lightbox: { open: false, imgUrl: '' },
                wishForm: {
                    name: '{{ addslashes($guestName) }}',
                    attendance: 'Hadir (2 Orang)',
                    message: ''
                },
                wishesList: @json($data['sample_wishes']),

                initApp() {
                    this.updateCountdown();
                    setInterval(() => {
                        this.updateCountdown();
                    }, 1000);

                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                },

                openInvitation() {
                    this.isOpened = true;
                    this.playMusic();
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    });
                },

                playMusic() {
                    const audio = document.getElementById('bgMusic');
                    if (audio) {
                        audio.play().then(() => {
                            this.isPlaying = true;
                        }).catch(e => {
                            console.log('Audio autoplay prevented:', e);
                        });
                    }
                },

                toggleMusic() {
                    const audio = document.getElementById('bgMusic');
                    if (audio) {
                        if (this.isPlaying) {
                            audio.pause();
                            this.isPlaying = false;
                        } else {
                            audio.play();
                            this.isPlaying = true;
                        }
                    }
                },

                updateCountdown() {
                    const now = new Date().getTime();
                    const distance = this.countdownTarget - now;

                    if (distance > 0) {
                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        this.countdown.days = String(days).padStart(2, '0');
                        this.countdown.hours = String(hours).padStart(2, '0');
                        this.countdown.minutes = String(minutes).padStart(2, '0');
                        this.countdown.seconds = String(seconds).padStart(2, '0');
                    } else {
                        this.countdown = { days: '00', hours: '00', minutes: '00', seconds: '00' };
                    }
                },

                copyText(text, successMsg) {
                    navigator.clipboard.writeText(text).then(() => {
                        this.showToast(successMsg);
                    }).catch(() => {
                        this.showToast('Gagal menyalin teks');
                    });
                },

                showToast(msg) {
                    this.toast.message = msg;
                    this.toast.show = true;
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                    setTimeout(() => {
                        this.toast.show = false;
                    }, 3000);
                },

                openLightbox(url) {
                    this.lightbox.imgUrl = url;
                    this.lightbox.open = true;
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                },

                submitWish() {
                    if (!this.wishForm.name || !this.wishForm.message) return;

                    const newWish = {
                        name: this.wishForm.name,
                        attendance: this.wishForm.attendance,
                        message: this.wishForm.message,
                        time: 'Baru saja'
                    };

                    this.wishesList.unshift(newWish);
                    this.wishForm.message = '';
                    this.showToast('Doa restu & konfirmasi berhasil dikirim!');

                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                },

                scrollTo(elementId) {
                    const el = document.getElementById(elementId);
                    if (el) {
                        el.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
