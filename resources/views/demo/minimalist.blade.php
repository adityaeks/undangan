<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Pernikahan {{ $data['groom']['nickname'] ?? 'Raka' }} &amp; {{ $data['bride']['nickname'] ?? 'Arinda' }} — KlikMomen</title>

    <!-- Meta SEO & Social Sharing Preview -->
    <meta name="description" content="Undangan Pernikahan {{ $data['groom']['name'] ?? 'Raka' }} &amp; {{ $data['bride']['name'] ?? 'Arinda' }}. {{ $data['events']['akad']['date'] ?? 'Sabtu, 24 Oktober 2026' }}.">
    <meta property="og:title" content="The Wedding of {{ $data['groom']['nickname'] ?? 'Raka' }} &amp; {{ $data['bride']['nickname'] ?? 'Arinda' }}">
    <meta property="og:description" content="{{ $data['events']['akad']['date'] ?? 'Sabtu, 24 Oktober 2026' }} — {{ $data['events']['akad']['venue'] ?? 'Jakarta' }}">
    <meta property="og:image" content="{{ !empty($data['cover_image']) ? $data['cover_image'] : ($activeStyle['cover_bg'] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&auto=format&fit=crop&q=85') }}">

    <!-- Google Fonts: Cormorant Garamond, Playfair Display, Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
                        linen: {
                            50: '#FBF9F5',
                            100: '#F5F0E8',
                            200: '#EBE3D5',
                            300: '#DDD2BF',
                            400: '#C5B59E',
                            500: '#A8967E',
                        },
                        stone: {
                            850: '#211E1B',
                            950: '#151311',
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

        /* Minimalist fine-art card */
        .art-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(221, 210, 191, 0.6);
        }

        .hairline-border {
            border-color: rgba(214, 203, 187, 0.7);
        }

        /* Subtle floating toast */
        .toast-enter {
            animation: slideUpFade 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Soundwave micro-animation */
        .sound-bar {
            animation: soundBounce 1.2s ease-in-out infinite alternate;
        }
        .sound-bar:nth-child(2) { animation-delay: 0.2s; }
        .sound-bar:nth-child(3) { animation-delay: 0.4s; }
        .sound-bar:nth-child(4) { animation-delay: 0.15s; }

        @keyframes soundBounce {
            0% { height: 4px; }
            100% { height: 16px; }
        }
    </style>
</head>

<body 
    class="bg-[#FBF9F5] text-[#24211D] font-sans antialiased selection:bg-[#DDD2BF] selection:text-[#151311] overflow-x-hidden min-h-screen"
    x-data="{
        isOpen: false,
        isPlaying: false,
        audio: null,
        lightboxOpen: false,
        lightboxImg: '',
        copiedToast: false,
        copiedMsg: '',
        activeTab: 'all',
        
        // Countdown
        days: '00',
        hours: '00',
        minutes: '00',
        seconds: '00',

        // RSVP
        rsvpName: '{{ $guestName ?? '' }}',
        rsvpGuests: '1',
        rsvpStatus: 'hadir',
        rsvpMessage: '',
        rsvpSubmitted: false,
        rsvpLoading: false,
        wishes: @json($data['sample_wishes']),

        init() {
            this.audio = document.getElementById('bgm-audio');
            this.startCountdown();
        },

        openInvitation() {
            this.isOpen = true;
            document.body.style.overflow = 'auto';
            if (this.audio) {
                this.audio.play().then(() => {
                    this.isPlaying = true;
                }).catch(() => {
                    this.isPlaying = false;
                });
            }
            setTimeout(() => {
                lucide.createIcons();
            }, 100);
        },

        toggleAudio() {
            if (!this.audio) return;
            if (this.isPlaying) {
                this.audio.pause();
                this.isPlaying = false;
            } else {
                this.audio.play();
                this.isPlaying = true;
            }
        },

        copyToClipboard(text, label) {
            navigator.clipboard.writeText(text).then(() => {
                this.copiedMsg = label + ' berhasil disalin';
                this.copiedToast = true;
                setTimeout(() => { this.copiedToast = false; }, 2800);
            });
        },

        async submitRsvp() {
            if (!this.rsvpName.trim() || !this.rsvpMessage.trim()) return;
            this.rsvpLoading = true;
            try {
                const res = await fetch('{{ url('/u/' . ($invitation->slug ?? '')) }}/wishes', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ guest_name: this.rsvpName, attendance: this.rsvpStatus + (this.rsvpGuests > 1 ? ' (' + this.rsvpGuests + ' Orang)' : ''), message: this.rsvpMessage })
                });
                const json = await res.json();
                if (json.success) {
                    this.wishes.unshift({ name: json.wish.name, time: json.wish.time, status: json.wish.attendance, msg: json.wish.message });
                    this.rsvpSubmitted = true;
                    this.rsvpMessage = '';
                    setTimeout(() => { this.rsvpSubmitted = false; }, 4000);
                }
            } finally {
                this.rsvpLoading = false;
            }
        },

        openPhoto(url) {
            this.lightboxImg = url;
            this.lightboxOpen = true;
        },

        startCountdown() {
            const targetStr = @json($data['countdown_target'] ?? '2026-10-24T08:00:00+07:00');
            const target = new Date(targetStr).getTime();
            
            const update = () => {
                const now = new Date().getTime();
                const diff = target - now;
                if (diff > 0) {
                    this.days = String(Math.floor(diff / (1000 * 60 * 60 * 24))).padStart(2, '0');
                    this.hours = String(Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                    this.minutes = String(Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                    this.seconds = String(Math.floor((diff % (1000 * 60)) / 1000)).padStart(2, '0');
                } else {
                    this.days = '00';
                    this.hours = '00';
                    this.minutes = '00';
                    this.seconds = '00';
                }
            };

            update();
            setInterval(update, 1000);
        }
    }"
    x-init="init()"
>

    <!-- HIDDEN BACKGROUND AUDIO -->
    <audio id="bgm-audio" loop preload="auto">
        <source src="{{ $data['background_music'] ?? $activeStyle['audio_url'] ?? '/audio/wedding-song.mp3' }}" type="audio/mpeg">
    </audio>

    <!-- TOAST NOTIFICATION -->
    <div 
        x-show="copiedToast" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        class="fixed bottom-6 inset-x-0 mx-auto w-fit z-50 px-5 py-3 rounded-full bg-stone-900 text-stone-100 text-xs font-medium shadow-2xl flex items-center gap-2 border border-stone-700"
        style="display: none;"
    >
        <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400"></i>
        <span x-text="copiedMsg"></span>
    </div>

    <!-- LIGHTBOX MODAL -->
    <div 
        x-show="lightboxOpen" 
        x-transition.opacity
        @keydown.escape.window="lightboxOpen = false"
        class="fixed inset-0 z-50 bg-stone-950/90 backdrop-blur-md flex items-center justify-center p-4"
        style="display: none;"
    >
        <button 
            @click="lightboxOpen = false" 
            class="absolute top-6 right-6 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition"
        >
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
        <img 
            :src="lightboxImg" 
            alt="Enlarged Photo" 
            class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl object-contain"
        >
    </div>

    <!-- ========================================================================= -->
    <!-- COVER ENTRANCE OVERLAY (Layar Pembuka Tenang & Bersih) -->
    <!-- ========================================================================= -->
    <div 
        x-show="!isOpen" 
        x-transition:leave="transition ease-in-out duration-700"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-98 pointer-events-none"
        class="fixed inset-0 z-50 flex items-center justify-center bg-[#FAF8F5] p-4 sm:p-6 overflow-hidden"
    >
        <!-- Frame Halus Monoline -->
        <div class="absolute inset-4 sm:inset-8 border hairline-border rounded-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-md w-full text-center flex flex-col items-center py-10 px-4">
            
            <!-- Delicate Botanical Line Art -->
            <div class="w-12 h-12 mb-6 text-stone-400">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                    <path d="M12 22C12 22 20 18 20 12C20 6 12 2 12 2C12 2 4 6 4 12C4 18 12 22 12 22Z" />
                    <path d="M12 2V22" />
                    <path d="M12 7C14 8 16.5 7.5 17 6" />
                    <path d="M12 12C14.5 13 17 12 17.5 10.5" />
                    <path d="M12 17C14 18 16 17 16.5 15.5" />
                    <path d="M12 7C10 8 7.5 7.5 7 6" />
                    <path d="M12 12C9.5 13 7 12 6.5 10.5" />
                    <path d="M12 17C10 18 8 17 7.5 15.5" />
                </svg>
            </div>

            <!-- Subtitle -->
            <p class="text-[11px] uppercase tracking-[0.3em] text-stone-500 font-medium mb-3">
                Undangan Pernikahan
            </p>

            <!-- Nama Pasangan -->
            <h1 class="font-editorial text-4xl sm:text-5xl font-light tracking-wide text-stone-900 mb-2 leading-tight">
                <span data-preview="groom-nickname">{{ $data['groom']['nickname'] ?? 'Raka' }}</span> <span class="font-serif italic font-normal text-stone-500 text-3xl sm:text-4xl">&amp;</span> <span data-preview="bride-nickname">{{ $data['bride']['nickname'] ?? 'Arinda' }}</span>
            </h1>

            <p class="text-xs tracking-[0.2em] text-stone-500 uppercase font-light mb-8" data-preview="event-date">
                {{ $data['events']['akad']['date'] ?? 'Sabtu, 24 Oktober 2026' }}
            </p>

            <!-- Guest Card -->
            <div class="w-full art-card rounded-2xl p-6 mb-8 border hairline-border shadow-sm text-center">
                <span class="text-[10px] uppercase tracking-[0.25em] text-stone-400 font-medium block mb-2">
                    Kepada Yth. Bapak/Ibu/Saudara/i:
                </span>
                <p class="font-serif text-xl sm:text-2xl font-normal text-stone-900 tracking-tight mb-2" data-preview="guest-name">
                    {{ $guestName ?? 'Reyhan' }}
                </p>
                <p class="text-[11px] text-stone-500 font-light leading-relaxed">
                    Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Anda berkenan hadir dan memberikan doa restu.
                </p>
            </div>

            <!-- Button Buka Undangan -->
            <button 
                @click="openInvitation()"
                class="group relative inline-flex items-center justify-center gap-3 px-8 py-3.5 rounded-full bg-stone-900 text-stone-100 text-xs font-semibold tracking-wider uppercase transition-all duration-300 hover:bg-stone-800 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0"
            >
                <i data-lucide="mail-open" class="w-4 h-4 text-stone-300 transition-transform group-hover:scale-110"></i>
                <span>Buka Undangan</span>
            </button>

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MAIN INVITATION CONTENT -->
    <!-- ========================================================================= -->
    <div class="min-h-screen relative flex flex-col items-center">

        <!-- FLOATING AUDIO WIDGET (Minimalist & Discreet) -->
        <div 
            x-show="isOpen"
            x-transition
            class="fixed bottom-6 right-6 z-40"
        >
            <button 
                @click="toggleAudio()"
                class="art-card pl-3.5 pr-4 py-2.5 rounded-full shadow-lg border hairline-border hover:shadow-xl transition-all duration-300 flex items-center gap-3 text-stone-800 hover:text-stone-950"
                title="Putar / Hentikan Musik"
            >
                <!-- Soundwave / Icon -->
                <div class="w-6 h-6 rounded-full bg-stone-900 text-stone-100 flex items-center justify-center shrink-0">
                    <i :data-lucide="isPlaying ? 'pause' : 'play'" class="w-3 h-3 fill-current"></i>
                </div>

                <div class="flex flex-col text-left pr-1">
                    <span class="text-[10px] uppercase tracking-wider text-stone-400 font-medium">Latar Musik</span>
                    <span class="text-xs font-serif font-medium text-stone-800 truncate max-w-[130px]">A Thousand Years</span>
                </div>

                <!-- Animated Equalizer Bars when playing -->
                <div x-show="isPlaying" class="flex items-end gap-0.5 h-4 px-1">
                    <span class="w-0.5 bg-stone-700 rounded-full sound-bar"></span>
                    <span class="w-0.5 bg-stone-700 rounded-full sound-bar"></span>
                    <span class="w-0.5 bg-stone-700 rounded-full sound-bar"></span>
                    <span class="w-0.5 bg-stone-700 rounded-full sound-bar"></span>
                </div>
            </button>
        </div>

        <!-- MAIN CONTAINER (Max width editorial canvas) -->
        <main class="w-full max-w-2xl mx-auto px-4 sm:px-6 py-12 space-y-20">

            <!-- ============================================================= -->
            <!-- 1. HERO SECTION -->
            <!-- ============================================================= -->
            <section class="text-center pt-8 space-y-8">
                
                <div class="space-y-3">
                    <span class="text-[11px] uppercase tracking-[0.3em] text-stone-400 font-medium block">
                        The Wedding of
                    </span>
                    <h1 class="font-editorial text-5xl sm:text-6xl font-light text-stone-900 tracking-wide">
                        <span data-preview="groom-nickname">{{ $data['groom']['nickname'] ?? 'Raka' }}</span> <span class="font-serif italic font-normal text-stone-500 text-4xl">&amp;</span> <span data-preview="bride-nickname">{{ $data['bride']['nickname'] ?? 'Arinda' }}</span>
                    </h1>
                    <p class="text-xs uppercase tracking-[0.25em] text-stone-500 font-light" data-preview="event-date">
                        {{ $data['events']['akad']['date'] ?? 'Sabtu, 24 Oktober 2026' }}
                    </p>
                </div>

                <!-- Fine Art Couple Portrait Frame -->
                <div class="relative mx-auto max-w-sm aspect-[4/5] rounded-3xl overflow-hidden shadow-sm border hairline-border p-2 bg-white">
                    <img 
                        src="{{ !empty($data['cover_image']) ? $data['cover_image'] : ($activeStyle['cover_bg'] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80') }}" 
                        alt="{{ $data['groom']['nickname'] ?? 'Raka' }} &amp; {{ $data['bride']['nickname'] ?? 'Arinda' }}" 
                        class="w-full h-full object-cover rounded-2xl"
                    >
                </div>

                @if(!empty($data['quote_text']))
                <!-- Ayat Suci / Kutipan Bijak -->
                <div class="max-w-md mx-auto space-y-3 px-4">
                    <p class="font-editorial italic text-base sm:text-lg text-stone-700 leading-relaxed">
                        “{{ $data['quote_text'] }}”
                    </p>
                    @if(!empty($data['quote_source']))
                    <span class="text-[11px] uppercase tracking-[0.2em] text-stone-400 font-medium block">
                        {{ $data['quote_source'] }}
                    </span>
                    @endif
                </div>
                @endif

                <!-- COUNTDOWN TIMER (Minimalist Pill Cards) -->
                <div class="pt-2 space-y-4">
                    <div class="grid grid-cols-4 gap-3 max-w-xs mx-auto text-center">
                        <div class="art-card rounded-2xl p-3 border hairline-border">
                            <span class="font-serif text-xl sm:text-2xl font-medium text-stone-900 block" x-text="days">00</span>
                            <span class="text-[10px] uppercase tracking-wider text-stone-400">Hari</span>
                        </div>
                        <div class="art-card rounded-2xl p-3 border hairline-border">
                            <span class="font-serif text-xl sm:text-2xl font-medium text-stone-900 block" x-text="hours">00</span>
                            <span class="text-[10px] uppercase tracking-wider text-stone-400">Jam</span>
                        </div>
                        <div class="art-card rounded-2xl p-3 border hairline-border">
                            <span class="font-serif text-xl sm:text-2xl font-medium text-stone-900 block" x-text="minutes">00</span>
                            <span class="text-[10px] uppercase tracking-wider text-stone-400">Menit</span>
                        </div>
                        <div class="art-card rounded-2xl p-3 border hairline-border">
                            <span class="font-serif text-xl sm:text-2xl font-medium text-stone-900 block" x-text="seconds">00</span>
                            <span class="text-[10px] uppercase tracking-wider text-stone-400">Detik</span>
                        </div>
                    </div>
                    @if(!empty($data['google_calendar_url']))
                    <div class="text-center pt-2">
                        <a 
                            href="{{ $data['google_calendar_url'] }}" 
                            target="_blank" 
                            class="inline-flex items-center gap-2 px-5 py-2 rounded-full border hairline-border bg-white hover:bg-stone-50 text-stone-700 text-xs font-medium tracking-wider uppercase transition shadow-sm hover:scale-105"
                        >
                            <i data-lucide="calendar-plus" class="w-3.5 h-3.5 text-stone-600"></i>
                            <span>Simpan di Kalender</span>
                        </a>
                    </div>
                    @endif
                </div>

            </section>

            <!-- ============================================================= -->
            <!-- 2. MEMPELAI (THE BRIDE & GROOM) -->
            <!-- ============================================================= -->
            <section class="space-y-12">
                
                <div class="text-center space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-stone-400 font-medium block">
                        Pasangan Mempelai
                    </span>
                    <h2 class="font-editorial text-3xl sm:text-4xl font-normal text-stone-900">
                        Mempelai yang Berbahagia
                    </h2>
                    <p class="text-xs text-stone-500 max-w-sm mx-auto leading-relaxed">
                        Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud melangsungkan pernikahan putra dan putri kami:
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    
                    <!-- GROOM -->
                    <div class="art-card rounded-3xl p-6 border hairline-border flex flex-col items-center text-center space-y-4">
                        <div class="w-32 h-32 rounded-full overflow-hidden border hairline-border p-1 bg-white shadow-sm">
                            <img 
                                src="{{ $data['groom']['photo'] }}" 
                                alt="{{ $data['groom']['name'] }}" 
                                class="w-full h-full object-cover rounded-full"
                            >
                        </div>
                        <div class="space-y-1.5">
                            <h3 class="font-editorial text-2xl font-medium text-stone-900" data-preview="groom-name">{{ $data['groom']['name'] }}</h3>
                            <p class="text-xs text-stone-500 leading-relaxed">
                                @if(!empty($data['groom']['child_order']))
                                    {{ $data['groom']['child_order'] }} dari<br>
                                @endif
                                @if(!empty($data['groom']['father']))
                                    <strong class="text-stone-800 font-medium">{{ $data['groom']['father'] }}</strong>
                                @endif
                                @if(!empty($data['groom']['father']) && !empty($data['groom']['mother']))
                                    &amp;
                                @endif
                                @if(!empty($data['groom']['mother']))
                                    {{ $data['groom']['mother'] }}
                                @endif
                            </p>
                        </div>
                        @if(!empty($data['groom']['instagram']))
                        <a 
                            href="https://instagram.com/{{ ltrim($data['groom']['instagram'], '@') }}" 
                            target="_blank" 
                            class="inline-flex items-center gap-1.5 text-xs text-stone-500 hover:text-stone-900 transition pt-1"
                        >
                            <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                            <span>{{ '@' . ltrim($data['groom']['instagram'], '@') }}</span>
                        </a>
                        @endif
                    </div>

                    <!-- BRIDE -->
                    <div class="art-card rounded-3xl p-6 border hairline-border flex flex-col items-center text-center space-y-4">
                        <div class="w-32 h-32 rounded-full overflow-hidden border hairline-border p-1 bg-white shadow-sm">
                            <img 
                                src="{{ $data['bride']['photo'] }}" 
                                alt="{{ $data['bride']['name'] }}" 
                                class="w-full h-full object-cover rounded-full"
                            >
                        </div>
                        <div class="space-y-1.5">
                            <h3 class="font-editorial text-2xl font-medium text-stone-900" data-preview="bride-name">{{ $data['bride']['name'] }}</h3>
                            <p class="text-xs text-stone-500 leading-relaxed">
                                @if(!empty($data['bride']['child_order']))
                                    {{ $data['bride']['child_order'] }} dari<br>
                                @endif
                                @if(!empty($data['bride']['father']))
                                    <strong class="text-stone-800 font-medium">{{ $data['bride']['father'] }}</strong>
                                @endif
                                @if(!empty($data['bride']['father']) && !empty($data['bride']['mother']))
                                    &amp;
                                @endif
                                @if(!empty($data['bride']['mother']))
                                    {{ $data['bride']['mother'] }}
                                @endif
                            </p>
                        </div>
                        @if(!empty($data['bride']['instagram']))
                        <a 
                            href="https://instagram.com/{{ ltrim($data['bride']['instagram'], '@') }}" 
                            target="_blank" 
                            class="inline-flex items-center gap-1.5 text-xs text-stone-500 hover:text-stone-900 transition pt-1"
                        >
                            <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                            <span>{{ '@' . ltrim($data['bride']['instagram'], '@') }}</span>
                        </a>
                        @endif
                    </div>

                </div>

            </section>

            <!-- ============================================================= -->
            <!-- 3. RANGKAIAN ACARA (EVENT DETAILS) -->
            <!-- ============================================================= -->
            <section class="space-y-10">
                
                <div class="text-center space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-stone-400 font-medium block">
                        Rangkaian Acara
                    </span>
                    <h2 class="font-editorial text-3xl sm:text-4xl font-normal text-stone-900">
                        Waktu &amp; Tempat Pelaksanaan
                    </h2>
                    <p class="text-xs text-stone-500 max-w-sm mx-auto">
                        Insya Allah seluruh rangkaian acara pernikahan akan diselenggarakan pada:
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    <!-- AKAD NIKAH -->
                    <div class="art-card rounded-3xl p-7 border hairline-border flex flex-col justify-between space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full bg-[#EBE3D5] text-stone-800 text-[10px] font-semibold uppercase tracking-wider">
                                    Akad Nikah
                                </span>
                                <i data-lucide="calendar" class="w-4 h-4 text-stone-400"></i>
                            </div>

                            <div>
                                <h3 class="font-editorial text-2xl font-medium text-stone-900" data-preview="event-date">{{ $data['events']['akad']['date'] }}</h3>
                                <p class="text-xs text-stone-600 font-medium mt-1">{{ $data['events']['akad']['time'] }}</p>
                            </div>

                            <div class="pt-3 border-t hairline-border text-xs text-stone-600 space-y-1">
                                <p class="font-medium text-stone-900" data-preview="venue-name">{{ $data['events']['akad']['venue'] }}</p>
                                <p class="text-stone-500 leading-relaxed">{{ $data['events']['akad']['address'] }}</p>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a 
                                href="{{ $data['events']['akad']['maps_link'] }}" 
                                target="_blank"
                                class="w-full py-2.5 rounded-xl bg-stone-900 hover:bg-stone-800 text-stone-100 text-xs font-medium transition flex items-center justify-center gap-2"
                            >
                                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                <span>Petunjuk Lokasi (Google Maps)</span>
                            </a>
                        </div>
                    </div>

                    <!-- RESEPSI PERNIKAHAN -->
                    <div class="art-card rounded-3xl p-7 border hairline-border flex flex-col justify-between space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full bg-[#EBE3D5] text-stone-800 text-[10px] font-semibold uppercase tracking-wider">
                                    Resepsi Pernikahan
                                </span>
                                <i data-lucide="clock" class="w-4 h-4 text-stone-400"></i>
                            </div>

                            <div>
                                <h3 class="font-editorial text-2xl font-medium text-stone-900" data-preview="event-date">{{ $data['events']['resepsi']['date'] }}</h3>
                                <p class="text-xs text-stone-600 font-medium mt-1">{{ $data['events']['resepsi']['time'] }}</p>
                            </div>

                            <div class="pt-3 border-t hairline-border text-xs text-stone-600 space-y-1">
                                <p class="font-medium text-stone-900" data-preview="venue-name">{{ $data['events']['resepsi']['venue'] }}</p>
                                <p class="text-stone-500 leading-relaxed">{{ $data['events']['resepsi']['address'] }}</p>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a 
                                href="{{ $data['events']['resepsi']['maps_link'] }}" 
                                target="_blank"
                                class="w-full py-2.5 rounded-xl bg-stone-900 hover:bg-stone-800 text-stone-100 text-xs font-medium transition flex items-center justify-center gap-2"
                            >
                                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                <span>Petunjuk Lokasi (Google Maps)</span>
                            </a>
                        </div>
                    </div>

                </div>

            </section>

            <!-- ============================================================= -->
            <!-- 4. KISAH KAMI (LOVE STORY TIMELINE) -->
            <!-- ============================================================= -->
            @if (!empty($data['stories']) && count($data['stories']) > 0)
            <section class="space-y-8">
                
                <div class="text-center space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-stone-400 font-medium block">
                        Kisah Cinta
                    </span>
                    <h2 class="font-editorial text-3xl sm:text-4xl font-normal text-stone-900">
                        Perjalanan Kisah Kami
                    </h2>
                </div>

                <div class="relative border-l hairline-border ml-4 sm:ml-8 pl-6 sm:pl-8 space-y-8 py-2" data-preview-container="stories">
                    @foreach ($data['stories'] as $index => $story)
                        <div class="relative">
                            <div class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-3.5 h-3.5 rounded-full bg-stone-900 border-2 border-[#FAF8F5]"></div>
                            <div class="space-y-1">
                                <span data-preview="story-year-{{ $index + 1 }}" class="text-[10px] uppercase tracking-widest text-stone-400 font-bold">{{ $story['year'] }}</span>
                                @if(!empty($story['image_url']))
                                    <div class="rounded-2xl overflow-hidden aspect-[16/10] my-2 border hairline-border">
                                        <img src="{{ $story['image_url'] }}" alt="{{ $story['title'] }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <h3 data-preview="story-title-{{ $index + 1 }}" class="font-editorial text-xl font-medium text-stone-900">{{ $story['title'] }}</h3>
                                <p data-preview="story-desc-{{ $index + 1 }}" class="text-xs text-stone-500 leading-relaxed">
                                    {{ $story['desc'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </section>
            @endif

            <!-- ============================================================= -->
            <!-- 5. GALERI FOTO (MOMEN BAHAGIA) -->
            <!-- ============================================================= -->
            @if(!empty($data['galleries']))
            <section class="space-y-8">
                
                <div class="text-center space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-stone-400 font-medium block">
                        Galeri Kenangan
                    </span>
                    <h2 class="font-editorial text-3xl sm:text-4xl font-normal text-stone-900">
                        Potret Bahagia Kami
                    </h2>
                </div>

                <!-- Masonry Gallery -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                    @foreach ($data['galleries'] as $img)
                        <div 
                            @click="openPhoto('{{ $img }}')"
                            class="relative aspect-[3/4] rounded-2xl overflow-hidden cursor-pointer group shadow-sm border hairline-border bg-white"
                        >
                            <img 
                                src="{{ $img }}" 
                                alt="Momen Indah {{ $data['groom']['nickname'] ?? 'Mempelai' }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                            <div class="absolute inset-0 bg-stone-950/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="w-8 h-8 rounded-full bg-white/90 text-stone-900 flex items-center justify-center shadow">
                                    <i data-lucide="maximize-2" class="w-4 h-4"></i>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

            </section>
            @endif

            <!-- ============================================================= -->
            <!-- 6. RSVP & KONFIRMASI KEHADIRAN -->
            <!-- ============================================================= -->
            <section class="space-y-8">
                
                <div class="text-center space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-stone-400 font-medium block">
                        RSVP &amp; Doa Restu
                    </span>
                    <h2 class="font-editorial text-3xl sm:text-4xl font-normal text-stone-900">
                        Konfirmasi Kehadiran
                    </h2>
                    <p class="text-xs text-stone-500 max-w-sm mx-auto">
                        Mohon kesediaan Bapak/Ibu/Saudara/i untuk mengonfirmasi kehadiran demi kenyamanan bersama.
                    </p>
                </div>

                <!-- Form Card -->
                <div class="art-card rounded-3xl p-6 sm:p-8 border hairline-border shadow-sm space-y-6">
                    
                    <div class="space-y-4">
                        
                        <!-- Nama -->
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-stone-700 block">Nama Lengkap</label>
                            <input 
                                type="text" 
                                x-model="rsvpName" 
                                class="w-full px-4 py-2.5 rounded-xl border hairline-border bg-white text-xs text-stone-900 focus:outline-none focus:border-stone-500"
                                placeholder="Masukkan nama Anda"
                            >
                        </div>

                        <!-- Jumlah Tamu & Konfirmasi -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-xs font-medium text-stone-700 block">Jumlah Tamu</label>
                                <select 
                                    x-model="rsvpGuests" 
                                    class="w-full px-4 py-2.5 rounded-xl border hairline-border bg-white text-xs text-stone-900 focus:outline-none focus:border-stone-500"
                                >
                                    <option value="1">1 Orang</option>
                                    <option value="2">2 Orang</option>
                                </select>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-medium text-stone-700 block">Konfirmasi</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <button 
                                        type="button"
                                        @click="rsvpStatus = 'hadir'"
                                        :class="rsvpStatus === 'hadir' ? 'bg-stone-900 text-stone-100 font-semibold' : 'bg-stone-100 text-stone-600'"
                                        class="py-2.5 rounded-xl text-xs text-center transition"
                                    >
                                        Hadir
                                    </button>
                                    <button 
                                        type="button"
                                        @click="rsvpStatus = 'berhalangan'"
                                        :class="rsvpStatus === 'berhalangan' ? 'bg-stone-900 text-stone-100 font-semibold' : 'bg-stone-100 text-stone-600'"
                                        class="py-2.5 rounded-xl text-xs text-center transition"
                                    >
                                        Berhalangan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Pesan & Doa -->
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-stone-700 block">Ucapan &amp; Doa Restu</label>
                            <textarea 
                                x-model="rsvpMessage"
                                rows="3" 
                                class="w-full px-4 py-2.5 rounded-xl border hairline-border bg-white text-xs text-stone-900 focus:outline-none focus:border-stone-500"
                                placeholder="Tuliskan ucapan dan doa tulus untuk kedua mempelai..."
                            ></textarea>
                        </div>

                        <button 
                            @click="submitRsvp()" 
                            class="w-full py-3 rounded-xl bg-stone-900 hover:bg-stone-800 text-stone-100 text-xs font-medium tracking-wider uppercase transition flex items-center justify-center gap-2"
                        >
                            <i data-lucide="send" class="w-3.5 h-3.5"></i>
                            <span>Kirim Konfirmasi &amp; Ucapan</span>
                        </button>

                    </div>

                    <!-- SUCCESS ALERT -->
                    <div 
                        x-show="rsvpSubmitted" 
                        x-transition 
                        class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2"
                    >
                        <i data-lucide="check" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                        <span>Terima kasih! Konfirmasi dan doa restu Anda telah berhasil dikirimkan.</span>
                    </div>

                    <!-- WISHES LIST -->
                    <div class="pt-4 border-t hairline-border space-y-3">
                        <span class="text-xs font-medium text-stone-800 block">Ucapan dari Sahabat &amp; Keluarga:</span>
                        
                        <div class="space-y-2.5 max-h-60 overflow-y-auto pr-1">
                            <template x-for="(w, idx) in wishes" :key="idx">
                                <div class="p-3.5 rounded-2xl bg-[#FBF9F5] border hairline-border space-y-1">
                                    <div class="flex items-center justify-between text-[11px]">
                                        <span class="font-semibold text-stone-900" x-text="w.name"></span>
                                        <span class="text-stone-400 text-[10px]" x-text="w.time"></span>
                                    </div>
                                    <p class="text-xs text-stone-600 leading-relaxed" x-text="w.msg"></p>
                                </div>
                            </template>
                        </div>
                    </div>

                </div>

            </section>

            <!-- ============================================================= -->
            <!-- 7. AMPLOP DIGITAL (TANDA KASIH & HADIAH) -->
            <!-- ============================================================= -->
            @if(!empty($data['bank_accounts']) || !empty($data['gift_address']))
            <section class="space-y-8">
                
                <div class="text-center space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-stone-400 font-medium block">
                        Tanda Kasih
                    </span>
                    <h2 class="font-editorial text-3xl sm:text-4xl font-normal text-stone-900">
                        Amplop Digital
                    </h2>
                    <p class="text-xs text-stone-500 max-w-sm mx-auto leading-relaxed">
                        Doa restu Anda merupakan karunia terindah bagi kami. Namun jika Anda bermaksud memberikan tanda kasih, Anda dapat menyalurkannya melalui rekening berikut:
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($data['bank_accounts'] as $acc)
                        <div class="art-card rounded-2xl p-5 border hairline-border space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="font-serif font-bold text-sm text-stone-900">{{ $acc['bank'] }}</span>
                                <i data-lucide="credit-card" class="w-4 h-4 text-stone-400"></i>
                            </div>
                            <div class="space-y-0.5">
                                <p class="font-mono text-base font-semibold text-stone-900">{{ $acc['account_number'] }}</p>
                                <p class="text-xs text-stone-500">a.n. {{ $acc['account_name'] }}</p>
                            </div>
                            <button 
                                @click="copyToClipboard('{{ str_replace(' ', '', $acc['account_number']) }}', 'Nomor Rekening {{ $acc['bank'] }}')"
                                class="w-full py-2 rounded-xl bg-[#F5F0E8] hover:bg-[#EBE3D5] text-stone-800 text-xs font-medium transition flex items-center justify-center gap-1.5"
                            >
                                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                <span>Salin Nomor Rekening</span>
                            </button>
                        </div>
                    @endforeach
                </div>

                @if(!empty($data['gift_address']))
                <div class="art-card rounded-2xl p-5 border hairline-border space-y-2 text-left">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-stone-500">Kirim Kado Fisik</span>
                        <i data-lucide="package" class="w-4 h-4 text-stone-400"></i>
                    </div>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        {{ $data['gift_address'] }}
                    </p>
                    <button 
                        @click="copyToClipboard('{{ $data['gift_address'] }}', 'Alamat Pengiriman Kado')"
                        class="inline-flex items-center gap-1 text-xs font-bold text-stone-900 hover:underline pt-1"
                    >
                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                        <span>Salin Alamat Lengkap</span>
                    </button>
                </div>
                @endif

            </section>
            @endif

            <!-- ============================================================= -->
            <!-- 8. FOOTER / CLOSING -->
            <!-- ============================================================= -->
            <footer class="text-center pt-12 pb-16 space-y-6 border-t hairline-border">
                <div class="space-y-2">
                    <p class="font-editorial italic text-base text-stone-600">
                        Atas kehadiran dan doa restu Bapak/Ibu/Saudara/i,<br>
                        kami mengucapkan terima kasih yang sedalam-dalamnya.
                    </p>
                    <h3 class="font-editorial text-3xl font-light text-stone-900 pt-2">
                        {{ $data['groom']['nickname'] ?? 'Raka' }} &amp; {{ $data['bride']['nickname'] ?? 'Arinda' }}
                    </h3>
                </div>

                <div class="pt-6">
                    <a 
                        href="{{ route('themes.catalog') }}" 
                        class="text-[11px] text-stone-400 hover:text-stone-700 transition"
                    >
                        Dibuat dengan penuh cinta melalui <strong class="text-stone-700">KlikMomen</strong>
                    </a>
                </div>
            </footer>

        </main>
    </div>

    <!-- Initialize Lucide Icons -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });
    </script>
    @include('demo.partials.preview-sync')
</body>
</html>
