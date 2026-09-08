<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $data['title'] ?? ('The Wedding of ' . ($data['groom']['nickname'] ?? 'Raka') . ' & ' . ($data['bride']['nickname'] ?? 'Arinda')) }}</title>

    <!-- Meta SEO & Social Sharing Preview (OpenGraph) -->
    <meta name="description" content="Official Wedding Website of {{ $data['groom']['name'] ?? 'Raka Pratama' }} &amp; {{ $data['bride']['name'] ?? 'Arinda Putri Larasati' }}.">
    <meta property="og:title" content="{{ ($data['groom']['nickname'] ?? 'Raka') . ' & ' . ($data['bride']['nickname'] ?? 'Arinda') }} — Editorial Wedding Issue">
    <meta property="og:description" content="{{ $data['events']['akad']['date'] ?? 'Sabtu, 24 Oktober 2026' }} - {{ $data['events']['akad']['venue'] ?? 'Jakarta' }}">
    <meta property="og:image" content="{{ !empty($data['cover_image']) ? $data['cover_image'] : ($activeStyle['cover_bg'] ?? 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=1200&auto=format&fit=crop&q=85') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;800;900&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Alex+Brush&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Cormorant Garamond"', 'serif'],
                        display: ['"Cinzel"', 'serif'],
                        script: ['"Alex Brush"', 'cursive'],
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
        .font-script { font-family: 'Alex Brush', cursive; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        .font-display { font-family: 'Cinzel', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }

        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.08); opacity: 0.4; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .animate-pulse-ring {
            animation: pulse-ring 3s ease-in-out infinite;
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .animate-float-slow {
            animation: float-slow 4s ease-in-out infinite;
        }

        @keyframes music-disc {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-music-disc {
            animation: music-disc 10s linear infinite;
        }

        /* Micro Equalizer Bars */
        @keyframes eq-bar {
            0%, 100% { height: 3px; }
            50% { height: 14px; }
        }
        .eq-1 { animation: eq-bar 0.8s ease-in-out infinite; }
        .eq-2 { animation: eq-bar 1.2s ease-in-out infinite 0.2s; }
        .eq-3 { animation: eq-bar 0.6s ease-in-out infinite 0.4s; }

        /* Hide scrollbars */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body 
    :style="{ backgroundColor: currentStyle.bg_main, color: currentStyle.text_primary }"
    class="font-sans antialiased overflow-x-hidden min-h-screen transition-colors duration-500"
    x-data="editorialInvitationApp()"
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
        <span class="w-6 h-6 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center">
            <i data-lucide="check" class="w-3.5 h-3.5"></i>
        </span>
        <span x-text="toast.message"></span>
    </div>

    <!-- MAIN EDITORIAL INVITATION WRAPPER -->
    <div class="max-w-lg mx-auto min-h-screen shadow-2xl relative transition-all duration-500">

        <!-- ============================================================== -->
        <!-- 1. VOGUE EDITORIAL COVER SCREEN (MAGAZINE ISSUE OPENER) -->
        <!-- ============================================================== -->
        <div 
            x-show="!isOpened"
            x-transition:leave="transition ease-in-out duration-800 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-full scale-95 pointer-events-none"
            class="fixed inset-0 max-w-lg mx-auto z-50 flex flex-col justify-between p-8 text-white bg-cover bg-center overflow-hidden"
            style="background-image: url('{{ !empty($data['cover_image']) ? $data['cover_image'] : ($activeStyle['cover_bg'] ?? 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=1200&auto=format&fit=crop&q=85') }}');"
        >
            <!-- CINEMATIC DARK VIGNETTE OVERLAY -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-black/95 z-0"></div>

            <!-- TOP MAGAZINE HEADER BAR -->
            <div class="relative z-10 flex items-center justify-between border-b border-white/20 pb-4">
                <div class="space-y-0.5 text-left">
                    <span class="font-display text-[10px] tracking-[0.35em] uppercase text-amber-200 block font-semibold">Special Edition</span>
                    <span class="text-[9px] tracking-widest uppercase text-white/60">Vol. XXVI • {{ $data['events']['akad']['date'] ?? 'Autumn 2026' }}</span>
                </div>
                <div class="text-right space-y-0.5">
                    <span class="font-display text-[10px] tracking-[0.25em] uppercase text-white/90 font-bold block">{{ $data['events']['akad']['venue'] ?? 'Jakarta, ID' }}</span>
                    <span class="text-[9px] text-amber-200/80 font-mono">{{ $data['events']['akad']['date'] ?? '24.10.2026' }}</span>
                </div>
            </div>

            <!-- CENTER: HIGH-FASHION EDITORIAL TYPOGRAPHY -->
            <div class="relative z-10 my-auto text-center space-y-4">
                <div class="inline-block px-4 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[10px] tracking-[0.3em] uppercase text-amber-300 font-semibold">
                    The Wedding Issue
                </div>

                <!-- OVERLAPPING INITIALS & NAMES -->
                <div class="relative py-4">
                    <span class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 font-display text-8xl sm:text-9xl text-white/10 font-bold tracking-tighter select-none pointer-events-none">
                        {{ mb_substr($data['groom']['nickname'] ?? 'R', 0, 1) . '&' . mb_substr($data['bride']['nickname'] ?? 'A', 0, 1) }}
                    </span>
                    <h1 class="font-serif text-5xl sm:text-6xl font-light tracking-wide text-white leading-none">
                        <span data-preview="groom-nickname">{{ $data['groom']['nickname'] ?? 'Raka' }}</span> <span class="font-script text-5xl sm:text-6xl text-amber-300 block my-1 font-normal">&amp;</span> <span data-preview="bride-nickname">{{ $data['bride']['nickname'] ?? 'Arinda' }}</span>
                    </h1>
                </div>

                <div class="flex items-center justify-center gap-3 text-xs tracking-[0.2em] uppercase text-white/80 font-light">
                    <span>Holy Matrimony</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                    <span>Grand Reception</span>
                </div>
            </div>

            <!-- BOTTOM: RECIPIENT CARD & GOLD WAX SEAL OPEN BUTTON -->
            <div class="relative z-10 space-y-6 pt-4 text-center">
                <div class="p-4 rounded-2xl bg-black/60 backdrop-blur-xl border border-white/20 text-center space-y-1 max-w-xs mx-auto shadow-2xl">
                    <span class="text-[9px] uppercase font-bold tracking-[0.25em] text-white/60">Cordially Invited:</span>
                    <h4 class="font-serif text-lg sm:text-xl font-bold text-amber-200 tracking-wide" data-preview="guest-name">{{ $guestName }}</h4>
                    <p class="text-[9px] text-white/50 italic">*Exclusive Guest Pass &amp; Wedding Narrative</p>
                </div>

                <!-- GOLD WAX SEAL OPEN BUTTON -->
                <button 
                    @click="openInvitation()"
                    type="button"
                    class="group relative inline-flex items-center gap-3 px-8 py-4 rounded-full bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 text-stone-950 font-bold text-xs uppercase tracking-[0.2em] shadow-2xl hover:shadow-amber-500/50 hover:scale-105 active:scale-95 transition-all duration-300 animate-pulse-ring"
                >
                    <span class="w-7 h-7 rounded-full bg-stone-950 text-amber-400 flex items-center justify-center shadow-inner">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                    </span>
                    <span>Open Invitation</span>
                </button>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- 2. FLOATING DYNAMIC ISLAND AUDIO & QUICK CONTROLLER -->
        <!-- ============================================================== -->
        <div 
            x-show="isOpened" 
            x-transition
            class="fixed top-5 inset-x-4 max-w-lg mx-auto z-40 flex items-center justify-between pointer-events-none"
        >
            <!-- AUDIO CONTROLLER CAPSULE -->
            <button 
                @click="toggleMusic()" 
                type="button"
                class="pointer-events-auto px-3.5 py-2 rounded-full bg-stone-950/85 backdrop-blur-xl border border-white/20 text-white shadow-2xl flex items-center gap-2.5 hover:scale-105 transition"
                :title="currentStyle.audio_title"
            >
                <div class="w-6 h-6 rounded-full bg-amber-500/20 text-amber-300 flex items-center justify-center animate-music-disc" :class="!isPlaying && 'paused'">
                    <i data-lucide="disc" class="w-4 h-4"></i>
                </div>
                <div class="hidden sm:flex flex-col text-left">
                    <span class="text-[9px] text-white/50 uppercase font-bold tracking-wider leading-none">Soundtrack</span>
                    <span class="text-[10px] text-amber-200 font-medium truncate max-w-[130px]" x-text="currentStyle.audio_title"></span>
                </div>
                <!-- Equalizer Animation -->
                <div x-show="isPlaying" class="flex items-end gap-0.5 h-3">
                    <span class="w-0.5 bg-amber-400 rounded-full eq-1"></span>
                    <span class="w-0.5 bg-amber-400 rounded-full eq-2"></span>
                    <span class="w-0.5 bg-amber-400 rounded-full eq-3"></span>
                </div>
                <div x-show="!isPlaying" class="text-stone-400">
                    <i data-lucide="volume-x" class="w-3 h-3"></i>
                </div>
            </button>
        </div>

        <!-- ============================================================== -->
        <!-- 3. INVITATION MAIN EDITORIAL CONTENT -->
        <!-- ============================================================== -->
        <div x-show="isOpened" class="space-y-20 pb-32 pt-20 px-5 sm:px-8">
            
            <!-- SECTION 1: EDITORIAL COVER HEADLINE -->
            <section id="sec-cover" class="relative text-center space-y-6 pt-6">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] tracking-[0.25em] uppercase font-bold border" :style="{ borderColor: currentStyle.border_color, color: currentStyle.accent }">
                        <span>Chapter 01 • The Unification</span>
                    </div>
                    <h2 class="font-serif text-5xl sm:text-6xl font-light tracking-tight leading-none" data-preview="couple-nickname">
                        {{ ($data['groom']['nickname'] ?? 'Raka') . ' & ' . ($data['bride']['nickname'] ?? 'Arinda') }}
                    </h2>
                    <p class="text-xs uppercase tracking-[0.3em] font-medium" :style="{ color: currentStyle.text_secondary }">
                        Together In Holy Matrimony
                    </p>
                </div>

                <!-- EDITORIAL PHOTO PORTRAIT FRAME -->
                <div class="relative rounded-[32px] overflow-hidden shadow-2xl aspect-[4/5] bg-stone-900 border" :style="{ borderColor: currentStyle.border_color }">
                    <img src="{{ !empty($data['cover_image']) ? $data['cover_image'] : ($activeStyle['cover_bg'] ?? 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=1200&auto=format&fit=crop&q=85') }}" alt="Wedding Portrait" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-6 text-left text-white">
                        <span class="text-[10px] uppercase font-bold tracking-[0.25em] text-amber-300">{{ $data['events']['akad']['venue'] ?? 'Jakarta, Indonesia' }}</span>
                        <h3 class="font-serif text-2xl font-bold" data-preview="event-date">{{ $data['events']['akad']['date'] ?? 'Sabtu, 24 Oktober 2026' }}</h3>
                    </div>
                </div>

                @if(!empty($data['quote_text']))
                <!-- QUOTE CARD WITH EDITORIAL BORDER -->
                <div class="p-6 rounded-3xl border text-center space-y-3" :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }">
                    <i data-lucide="quote" class="w-5 h-5 mx-auto" :style="{ color: currentStyle.accent }"></i>
                    <p class="font-serif text-base sm:text-lg italic leading-relaxed" :style="{ color: currentStyle.text_secondary }">
                        "{{ $data['quote_text'] }}"
                    </p>
                    @if(!empty($data['quote_source']))
                    <span class="text-[10px] font-bold tracking-[0.2em] uppercase block" :style="{ color: currentStyle.accent }">
                        {{ $data['quote_source'] }}
                    </span>
                    @endif
                </div>
                @endif
            </section>

            <!-- SECTION 2: ASYMMETRICAL EDITORIAL COUPLE SHOWCASE -->
            <section id="sec-mempelai" class="space-y-12">
                <div class="text-center space-y-1">
                    <span class="text-[10px] font-bold uppercase tracking-[0.3em]" :style="{ color: currentStyle.accent }">The Protagonists</span>
                    <h3 class="font-serif text-3xl sm:text-4xl font-bold">Kedua Mempelai</h3>
                    <p class="text-xs" :style="{ color: currentStyle.text_secondary }">Dengan penuh kerendahan hati dan rasa syukur ke hadirat Tuhan Yang Maha Esa:</p>
                </div>

                <!-- GROOM: ASYMMETRIC FULL PORTRAIT + GLASS META -->
                <div class="relative rounded-[32px] overflow-hidden border shadow-xl group" :style="{ borderColor: currentStyle.border_color }">
                    <div class="aspect-[3/4] w-full bg-stone-900 overflow-hidden">
                        <img src="{{ $data['groom']['photo'] }}" alt="{{ $data['groom']['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <!-- OVERLAPPING BOTTOM GLASS PANEL -->
                    <div class="p-6 space-y-3" :style="{ backgroundColor: currentStyle.bg_card }">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-[0.25em]" :style="{ color: currentStyle.accent }">01 / The Groom</span>
                            @if(!empty($data['groom']['instagram']))
                            <a href="https://instagram.com/{{ ltrim($data['groom']['instagram'], '@') }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] font-semibold hover:opacity-80 transition" :style="{ color: currentStyle.accent }">
                                <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                                <span>{{ '@' . ltrim($data['groom']['instagram'], '@') }}</span>
                            </a>
                            @endif
                        </div>
                        <h4 class="font-serif text-2xl font-bold" data-preview="groom-name">{{ $data['groom']['name'] }}</h4>
                        <p class="text-xs leading-relaxed" :style="{ color: currentStyle.text_secondary }">
                            @if(!empty($data['groom']['child_order']))
                                {{ $data['groom']['child_order'] }} dari<br>
                            @endif
                            @if(!empty($data['groom']['father']))
                                <strong class="font-semibold" :style="{ color: currentStyle.text_primary }">{{ $data['groom']['father'] }}</strong>
                            @endif
                            @if(!empty($data['groom']['father']) && !empty($data['groom']['mother']))
                                &amp;
                            @endif
                            @if(!empty($data['groom']['mother']))
                                <strong class="font-semibold" :style="{ color: currentStyle.text_primary }">{{ $data['groom']['mother'] }}</strong>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- EDITORIAL AMPERSAND SEPARATOR -->
                <div class="flex items-center justify-center gap-4 py-2">
                    <div class="h-px flex-1" :style="{ backgroundColor: currentStyle.border_color }"></div>
                    <span class="font-script text-6xl" :style="{ color: currentStyle.accent }">&amp;</span>
                    <div class="h-px flex-1" :style="{ backgroundColor: currentStyle.border_color }"></div>
                </div>

                <!-- BRIDE: ASYMMETRIC FULL PORTRAIT + GLASS META -->
                <div class="relative rounded-[32px] overflow-hidden border shadow-xl group" :style="{ borderColor: currentStyle.border_color }">
                    <div class="aspect-[3/4] w-full bg-stone-900 overflow-hidden">
                        <img src="{{ $data['bride']['photo'] }}" alt="{{ $data['bride']['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <!-- OVERLAPPING BOTTOM GLASS PANEL -->
                    <div class="p-6 space-y-3" :style="{ backgroundColor: currentStyle.bg_card }">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-[0.25em]" :style="{ color: currentStyle.accent }">02 / The Bride</span>
                            @if(!empty($data['bride']['instagram']))
                            <a href="https://instagram.com/{{ ltrim($data['bride']['instagram'], '@') }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] font-semibold hover:opacity-80 transition" :style="{ color: currentStyle.accent }">
                                <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                                <span>{{ '@' . ltrim($data['bride']['instagram'], '@') }}</span>
                            </a>
                            @endif
                        </div>
                        <h4 class="font-serif text-2xl font-bold" data-preview="bride-name">{{ $data['bride']['name'] }}</h4>
                        <p class="text-xs leading-relaxed" :style="{ color: currentStyle.text_secondary }">
                            @if(!empty($data['bride']['child_order']))
                                {{ $data['bride']['child_order'] }} dari<br>
                            @endif
                            @if(!empty($data['bride']['father']))
                                <strong class="font-semibold" :style="{ color: currentStyle.text_primary }">{{ $data['bride']['father'] }}</strong>
                            @endif
                            @if(!empty($data['bride']['father']) && !empty($data['bride']['mother']))
                                &amp;
                            @endif
                            @if(!empty($data['bride']['mother']))
                                <strong class="font-semibold" :style="{ color: currentStyle.text_primary }">{{ $data['bride']['mother'] }}</strong>
                            @endif
                        </p>
                    </div>
                </div>
            </section>

            <!-- SECTION 3: BENTO GRID WEDDING EVENTS & ITINERARY -->
            <section id="sec-acara" class="space-y-8">
                <div class="text-center space-y-1">
                    <span class="text-[10px] font-bold uppercase tracking-[0.3em]" :style="{ color: currentStyle.accent }">Schedule &amp; Details</span>
                    <h3 class="font-serif text-3xl sm:text-4xl font-bold">Rangkaian Acara</h3>
                    <p class="text-xs" :style="{ color: currentStyle.text_secondary }">Agenda prosesi sakral &amp; perayaan kebahagiaan</p>
                </div>

                <!-- BENTO GRID CONTAINER -->
                <div class="space-y-4">
                    
                    <!-- BENTO 1: COUNTDOWN TIMER CARD -->
                    <div class="p-6 rounded-3xl border shadow-lg space-y-4 text-center" :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em]" :style="{ color: currentStyle.accent }">Save The Date</span>
                            <span class="text-[10px] font-mono" :style="{ color: currentStyle.text_secondary }">24.10.2026</span>
                        </div>
                        <div class="grid grid-cols-4 gap-2">
                            <div class="p-3 rounded-2xl" :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }">
                                <div class="font-serif text-2xl sm:text-3xl font-bold" x-text="countdown.days">00</div>
                                <div class="text-[8px] uppercase tracking-wider font-bold">Hari</div>
                            </div>
                            <div class="p-3 rounded-2xl" :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }">
                                <div class="font-serif text-2xl sm:text-3xl font-bold" x-text="countdown.hours">00</div>
                                <div class="text-[8px] uppercase tracking-wider font-bold">Jam</div>
                            </div>
                            <div class="p-3 rounded-2xl" :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }">
                                <div class="font-serif text-2xl sm:text-3xl font-bold" x-text="countdown.minutes">00</div>
                                <div class="text-[8px] uppercase tracking-wider font-bold">Menit</div>
                            </div>
                            <div class="p-3 rounded-2xl" :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }">
                                <div class="font-serif text-2xl sm:text-3xl font-bold" x-text="countdown.seconds">00</div>
                                <div class="text-[8px] uppercase tracking-wider font-bold">Detik</div>
                            </div>
                        </div>
                        <a 
                            href="{{ $data['google_calendar_url'] ?? '#' }}" 
                            target="_blank"
                            class="inline-flex items-center justify-center gap-2 w-full py-3 rounded-2xl text-xs font-bold transition shadow-sm"
                            :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }"
                        >
                            <i data-lucide="calendar-plus" class="w-4 h-4"></i>
                            <span>Add to Google Calendar</span>
                        </a>
                    </div>

                    <!-- BENTO 2: AKAD NIKAH -->
                    <div class="p-6 rounded-3xl border shadow-lg space-y-4" :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider" :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }">
                                Prosesi 01
                            </span>
                            <span class="text-xs font-mono font-bold" :style="{ color: currentStyle.accent }">{{ $data['events']['akad']['time'] }}</span>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-serif text-2xl font-bold">{{ $data['events']['akad']['title'] }}</h4>
                            <p class="text-xs font-medium" :style="{ color: currentStyle.text_secondary }" data-preview="event-date">{{ $data['events']['akad']['date'] }}</p>
                        </div>
                        <div class="pt-3 border-t text-xs space-y-1" :style="{ borderColor: currentStyle.border_color }">
                            <p class="font-bold" data-preview="venue-name">{{ $data['events']['akad']['venue'] }}</p>
                            <p :style="{ color: currentStyle.text_secondary }">{{ $data['events']['akad']['address'] }}</p>
                        </div>
                        <a 
                            href="{{ $data['events']['akad']['maps_link'] }}" 
                            target="_blank" 
                            class="inline-flex items-center justify-center gap-2 w-full py-3 rounded-2xl text-xs font-bold shadow-md transition"
                            :style="{ backgroundColor: currentStyle.btn_bg, color: currentStyle.btn_text }"
                        >
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                            <span>Buka Lokasi di Google Maps</span>
                        </a>
                    </div>

                    <!-- BENTO 3: RESEPSI & AFTER PARTY -->
                    <div class="p-6 rounded-3xl border shadow-lg space-y-4" :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider" :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }">
                                Prosesi 02
                            </span>
                            <span class="text-xs font-mono font-bold" :style="{ color: currentStyle.accent }">{{ $data['events']['resepsi']['time'] }}</span>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-serif text-2xl font-bold">{{ $data['events']['resepsi']['title'] }}</h4>
                            <p class="text-xs font-medium" :style="{ color: currentStyle.text_secondary }" data-preview="event-date">{{ $data['events']['resepsi']['date'] }}</p>
                        </div>
                        <div class="pt-3 border-t text-xs space-y-1" :style="{ borderColor: currentStyle.border_color }">
                            <p class="font-bold" data-preview="venue-name">{{ $data['events']['resepsi']['venue'] }}</p>
                            <p :style="{ color: currentStyle.text_secondary }">{{ $data['events']['resepsi']['address'] }}</p>
                        </div>
                        <a 
                            href="{{ $data['events']['resepsi']['maps_link'] }}" 
                            target="_blank" 
                            class="inline-flex items-center justify-center gap-2 w-full py-3 rounded-2xl text-xs font-bold shadow-md transition"
                            :style="{ backgroundColor: currentStyle.btn_bg, color: currentStyle.btn_text }"
                        >
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                            <span>Buka Lokasi di Google Maps</span>
                        </a>
                    </div>

                    <!-- BENTO 4: DRESS CODE & GUEST PROTOCOL -->
                    <div class="p-5 rounded-3xl border space-y-3 text-center" :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }">
                        <span class="text-[10px] font-bold uppercase tracking-[0.25em]" :style="{ color: currentStyle.accent }">Dress Code Guide</span>
                        <p class="text-xs font-medium" :style="{ color: currentStyle.text_secondary }">Formal Attire / Earthy &amp; Pastel Elegance</p>
                        <div class="flex items-center justify-center gap-2 pt-1">
                            <span class="w-5 h-5 rounded-full bg-[#E5DCCB] border border-white/40 shadow-sm" title="Champagne Cream"></span>
                            <span class="w-5 h-5 rounded-full bg-[#8A9A86] border border-white/40 shadow-sm" title="Sage Green"></span>
                            <span class="w-5 h-5 rounded-full bg-[#C48B9F] border border-white/40 shadow-sm" title="Dusty Rose"></span>
                            <span class="w-5 h-5 rounded-full bg-[#1E293B] border border-white/40 shadow-sm" title="Midnight Navy"></span>
                        </div>
                    </div>

                </div>
            </section>

            <!-- SECTION 4: HORIZONTAL EDITORIAL LOVE STORY -->
            @if (!empty($data['stories']) && count($data['stories']) > 0)
            <section id="sec-cerita" class="space-y-6">
                <div class="text-center space-y-1">
                    <span class="text-[10px] font-bold uppercase tracking-[0.3em]" :style="{ color: currentStyle.accent }">Timeline Of Love</span>
                    <h3 class="font-serif text-3xl sm:text-4xl font-bold">Kisah Perjalanan Kami</h3>
                    <p class="text-xs" :style="{ color: currentStyle.text_secondary }">Lembaran demi lembaran cerita yang menyatukan hati</p>
                </div>

                <!-- HORIZONTAL SCROLL DECK -->
                <div class="flex items-stretch gap-4 overflow-x-auto no-scrollbar pb-4 pt-2 -mx-4 px-4 snap-x" data-preview-container="stories">
                    @foreach ($data['stories'] as $index => $story)
                        <div 
                            class="min-w-[280px] sm:min-w-[320px] p-6 rounded-3xl border shadow-md space-y-3 snap-center flex flex-col justify-between"
                            :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }"
                        >
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span data-preview="story-year-{{ $index + 1 }}" class="text-[10px] font-bold uppercase tracking-[0.2em]" :style="{ color: currentStyle.accent }">
                                        {{ $story['year'] }}
                                    </span>
                                    <span data-preview="story-badge-{{ $index + 1 }}" class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold" :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }">
                                        0{{ $index + 1 }}
                                    </span>
                                </div>
                                @if(!empty($story['image_url']))
                                <div class="rounded-2xl overflow-hidden aspect-[16/10] mb-2 border" :style="{ borderColor: currentStyle.border_color }">
                                    <img src="{{ $story['image_url'] }}" alt="{{ $story['title'] }}" class="w-full h-full object-cover">
                                </div>
                                @endif
                                <h4 data-preview="story-title-{{ $index + 1 }}" class="font-serif text-xl font-bold">{{ $story['title'] }}</h4>
                                <p data-preview="story-desc-{{ $index + 1 }}" class="text-xs leading-relaxed" :style="{ color: currentStyle.text_secondary }">
                                    {{ $story['desc'] }}
                                </p>
                            </div>
                            <div class="pt-3 border-t text-[10px] font-mono opacity-50" :style="{ borderColor: currentStyle.border_color }">
                                #{{ Str::slug(($data['groom']['nickname'] ?? 'Groom') . ' ' . ($data['bride']['nickname'] ?? 'Bride'), '') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- SECTION 5: MASONRY PREWEDDING GALLERY -->
            @if(!empty($data['galleries']))
            <section id="sec-galeri" class="space-y-6">
                <div class="text-center space-y-1">
                    <span class="text-[10px] font-bold uppercase tracking-[0.3em]" :style="{ color: currentStyle.accent }">Captured Moments</span>
                    <h3 class="font-serif text-3xl sm:text-4xl font-bold">Galeri Foto Bahagia</h3>
                    <p class="text-xs" :style="{ color: currentStyle.text_secondary }">Klik foto untuk melihat dalam resolusi penuh</p>
                </div>

                <!-- MASONRY EDITORIAL COLLAGE -->
                <div class="grid grid-cols-2 gap-3">
                    @foreach ($data['galleries'] as $index => $photo)
                        <div 
                            @click="openLightbox('{{ $photo }}')" 
                            class="rounded-3xl overflow-hidden shadow-lg cursor-pointer group relative bg-stone-900 {{ $index === 0 || $index === 3 ? 'aspect-[3/4]' : 'aspect-square' }}"
                        >
                            <img src="{{ $photo }}" alt="Gallery {{ $index + 1 }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white">
                                <i data-lucide="maximize-2" class="w-5 h-5"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            @if(!empty($data['bank_accounts']) || !empty($data['gift_address']))
            <section id="sec-amplop" class="space-y-6">
                <div class="text-center space-y-1">
                    <span class="text-[10px] font-bold uppercase tracking-[0.3em]" :style="{ color: currentStyle.accent }">Wedding Registry</span>
                    <h3 class="font-serif text-3xl sm:text-4xl font-bold">Amplop Digital &amp; Kado</h3>
                    <p class="text-xs" :style="{ color: currentStyle.text_secondary }">Doa restu Anda adalah hadiah terindah. Namun jika ingin memberikan tanda kasih secara digital:</p>
                </div>

                <div class="space-y-4">
                    @foreach ($data['bank_accounts'] as $acc)
                        <div class="p-6 rounded-3xl bg-gradient-to-br {{ $acc['color'] }} text-white shadow-xl space-y-4 relative overflow-hidden">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider font-mono">{{ $acc['bank'] }}</span>
                                <i data-lucide="credit-card" class="w-5 h-5 opacity-75"></i>
                            </div>
                            <div class="space-y-0.5">
                                <div class="font-mono text-xl font-bold tracking-widest">{{ $acc['account_number'] }}</div>
                                <div class="text-xs opacity-90">a.n. {{ $acc['account_name'] }}</div>
                            </div>
                            <button 
                                type="button"
                                @click="copyToClipboard('{{ str_replace(' ', '', $acc['account_number']) }}', 'Nomor Rekening {{ $acc['bank'] }}')"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/20 hover:bg-white/30 backdrop-blur-md text-xs font-bold transition shadow-sm"
                            >
                                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                <span>Salin Nomor Rekening</span>
                            </button>
                        </div>
                    @endforeach

                    @if(!empty($data['gift_address']))
                    <!-- KADO FISIK ADDRESS CARD -->
                    <div class="p-5 rounded-3xl border space-y-2 text-left" :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em]" :style="{ color: currentStyle.accent }">Kirim Kado Fisik</span>
                            <i data-lucide="package" class="w-4 h-4" :style="{ color: currentStyle.accent }"></i>
                        </div>
                        <p class="text-xs leading-relaxed" :style="{ color: currentStyle.text_secondary }">
                            {{ $data['gift_address'] }}
                        </p>
                        <button 
                            type="button" 
                            @click="copyToClipboard('{{ $data['gift_address'] }}', 'Alamat Pengiriman Kado')"
                            class="inline-flex items-center gap-1.5 text-xs font-bold hover:underline pt-1"
                            :style="{ color: currentStyle.accent }"
                        >
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                            <span>Salin Alamat Lengkap</span>
                        </button>
                    </div>
                    @endif
                </div>
            </section>
            @endif

            <!-- SECTION 7: RSVP & LIVE GUESTBOOK FEED -->
            <section id="sec-ucapan" class="space-y-6">
                <div class="text-center space-y-1">
                    <span class="text-[10px] font-bold uppercase tracking-[0.3em]" :style="{ color: currentStyle.accent }">Guestbook &amp; RSVP</span>
                    <h3 class="font-serif text-3xl sm:text-4xl font-bold">Ucapan &amp; Doa Restu</h3>
                    <p class="text-xs" :style="{ color: currentStyle.text_secondary }">Konfirmasi kehadiran dan sampaikan doa terbaik Anda</p>
                </div>

                <!-- RSVP FORM CARD -->
                <div class="p-6 rounded-3xl border shadow-lg space-y-4 text-left" :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }">
                    <form @submit.prevent="submitWish()" class="space-y-4 text-xs">
                        <div>
                            <label class="font-bold block mb-1.5">Nama Lengkap</label>
                            <input 
                                type="text" 
                                x-model="wishForm.name" 
                                required
                                :style="{ borderColor: currentStyle.border_color }"
                                :class="currentStyle.is_dark ? 'bg-black/50 text-white' : 'bg-sand-50/70 text-stone-900'"
                                class="w-full px-4 py-3 rounded-2xl border focus:outline-none focus:ring-2 focus:ring-amber-500"
                            >
                        </div>

                        <div>
                            <label class="font-bold block mb-1.5">Konfirmasi Kehadiran</label>
                            <select 
                                x-model="wishForm.attendance"
                                :style="{ borderColor: currentStyle.border_color }"
                                :class="currentStyle.is_dark ? 'bg-stone-900 text-white' : 'bg-sand-50/70 text-stone-900'"
                                class="w-full px-4 py-3 rounded-2xl border focus:outline-none focus:ring-2 focus:ring-amber-500"
                            >
                                <option value="Hadir (1 Orang)">Hadir (1 Orang)</option>
                                <option value="Hadir (2 Orang)">Hadir (2 Orang)</option>
                                <option value="Masih Ragu">Masih Ragu</option>
                                <option value="Tidak Hadir">Mohon Maaf, Tidak Bisa Hadir</option>
                            </select>
                        </div>

                        <div>
                            <label class="font-bold block mb-1.5">Pesan &amp; Doa Restu</label>
                            <textarea 
                                x-model="wishForm.message" 
                                rows="3" 
                                required
                                placeholder="Tuliskan ucapan selamat &amp; doa restu Anda..." 
                                :style="{ borderColor: currentStyle.border_color }"
                                :class="currentStyle.is_dark ? 'bg-black/50 text-white' : 'bg-sand-50/70 text-stone-900'"
                                class="w-full px-4 py-3 rounded-2xl border focus:outline-none focus:ring-2 focus:ring-amber-500"
                            ></textarea>
                        </div>

                        <button 
                            type="submit" 
                            :style="{ backgroundColor: currentStyle.btn_bg, color: currentStyle.btn_text }"
                            class="w-full py-3.5 rounded-2xl font-bold text-xs shadow-lg transition flex items-center justify-center gap-2 hover:opacity-95"
                        >
                            <i data-lucide="send" class="w-4 h-4"></i>
                            <span>Kirim Konfirmasi &amp; Doa</span>
                        </button>
                    </form>
                </div>

                <!-- LIVE WISHES FEED STREAM -->
                <div class="space-y-3 text-left">
                    <template x-for="(w, idx) in wishes" :key="idx">
                        <div 
                            :style="{ backgroundColor: currentStyle.bg_card, borderColor: currentStyle.border_color }"
                            class="p-5 rounded-3xl border shadow-sm space-y-2"
                        >
                            <div class="flex items-center justify-between gap-2">
                                <span class="font-serif font-bold text-sm" x-text="w.name"></span>
                                <span 
                                    :style="{ backgroundColor: currentStyle.tag_bg, color: currentStyle.tag_text }"
                                    class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold" 
                                    x-text="w.attendance"
                                ></span>
                            </div>
                            <p :style="{ color: currentStyle.text_secondary }" class="text-xs leading-relaxed italic" x-text="w.message"></p>
                            <span class="text-[9px] opacity-60 block text-right" x-text="w.time"></span>
                        </div>
                    </template>
                </div>
            </section>

            <!-- FOOTER SIGNATURE -->
            <footer :style="{ borderColor: currentStyle.border_color, color: currentStyle.text_secondary }" class="text-center pt-10 border-t space-y-4 text-xs">
                <span class="font-script text-4xl block" :style="{ color: currentStyle.accent }">Thank You</span>
                <p>Merupakan kehormatan dan kebahagiaan bagi kami atas kehadiran dan doa restu Bapak/Ibu/Saudara/i.</p>
                <div class="font-serif text-2xl font-bold" :style="{ color: currentStyle.text_primary }">
                    {{ $data['groom']['nickname'] }} &amp; {{ $data['bride']['nickname'] }}
                </div>
                <div class="pt-4 text-[10px] opacity-50 font-mono">
                    Powered by <a href="{{ route('home') }}" class="underline font-bold">KlikMomen.id</a> • Editorial Series
                </div>
            </footer>

        </div>

        <!-- ============================================================== -->
        <!-- 4. FLOATING EDITORIAL BOTTOM DOCK NAVIGATION -->
        <!-- ============================================================== -->
        <nav 
            x-show="isOpened" 
            x-transition
            class="fixed bottom-4 inset-x-4 max-w-sm mx-auto z-40 bg-stone-950/90 backdrop-blur-xl rounded-full border border-white/20 shadow-2xl p-1.5 flex items-center justify-around text-stone-400 text-[10px]"
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
            <a href="#sec-cerita" class="p-2 hover:text-amber-300 flex flex-col items-center gap-0.5">
                <i data-lucide="bookmark" class="w-4 h-4"></i>
                <span>Cerita</span>
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
        function editorialInvitationApp() {
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
                    const update = () => {
                        const now = new Date().getTime();
                        const diff = target - now;
                        if (diff > 0) {
                            this.countdown.days = String(Math.floor(diff / (1000 * 60 * 60 * 24))).padStart(2, '0');
                            this.countdown.hours = String(Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                            this.countdown.minutes = String(Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                            this.countdown.seconds = String(Math.floor((diff % (1000 * 60)) / 1000)).padStart(2, '0');
                        } else {
                            this.countdown.days = '00';
                            this.countdown.hours = '00';
                            this.countdown.minutes = '00';
                            this.countdown.seconds = '00';
                        }
                    };
                    update();
                    setInterval(update, 1000);
                }
            }
        }
    </script>
    @include('demo.partials.preview-sync')
</body>
</html>
