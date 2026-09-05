<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Undangan Pernikahan {{ $data['groom']['nickname'] ?? 'Ryan' }} &amp; {{ $data['bride']['nickname'] ?? 'Vanya' }} — KlikMomen</title>

    <!-- Meta SEO & Social Sharing Preview -->
    <meta name="description" content="The Wedding of {{ $data['groom']['name'] ?? 'Ryan' }} &amp; {{ $data['bride']['name'] ?? 'Vanya' }}. {{ $data['events']['akad']['date'] ?? 'Sabtu, 24 Oktober 2026' }}.">
    <meta property="og:title" content="The Wedding of {{ $data['groom']['nickname'] ?? 'Ryan' }} &amp; {{ $data['bride']['nickname'] ?? 'Vanya' }}">
    <meta property="og:description" content="{{ $data['events']['akad']['date'] ?? 'Sabtu, 24 Oktober 2026' }} — {{ $data['events']['akad']['venue'] ?? 'Jakarta' }}">
    <meta property="og:image" content="{{ !empty($data['cover_image']) ? $data['cover_image'] : ($activeStyle['cover_bg'] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&auto=format&fit=crop&q=85') }}">

    <!-- Google Fonts: Alex Brush, Great Vibes, Cormorant Garamond, Playfair Display, Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Great+Vibes&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
                        script: ['"Alex Brush"', 'cursive'],
                        vibes: ['"Great Vibes"', 'cursive'],
                    },
                    colors: {
                        rosewood: {
                            50: '#FBF6F7',
                            100: '#F7EDF0',
                            200: '#EED9DF',
                            300: '#DFB8C4',
                            400: '#C991A3',
                            500: '#B06F85',
                            600: '#9B5B71',
                            700: '#7E465A',
                            800: '#683B4A',
                            900: '#55333F',
                            950: '#351C25',
                        },
                        dusty: {
                            100: '#FAF2F4',
                            200: '#EFE1E5',
                            300: '#DEC4CB',
                            400: '#C79EA9',
                            500: '#A97583',
                            600: '#8E5968',
                            700: '#734452',
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
        .font-script { font-family: 'Alex Brush', cursive; }
        .font-vibes { font-family: 'Great Vibes', cursive; }
        .font-editorial { font-family: 'Cormorant Garamond', serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Dusty Rose Button Gradient exactly like user screenshot */
        .btn-dusty-gradient {
            background: linear-gradient(135deg, #A46D7D 0%, #C48E9E 50%, #986070 100%);
            box-shadow: 0 8px 24px -4px rgba(152, 96, 112, 0.45);
        }
        .btn-dusty-gradient:hover {
            background: linear-gradient(135deg, #935E6D 0%, #B47E8E 50%, #885261 100%);
        }

        /* Arch Window Geometric Frame */
        .arch-frame {
            border-top-left-radius: 9999px;
            border-top-right-radius: 9999px;
        }

        /* Oval Portrait Frame */
        .oval-frame {
            border-radius: 50% / 40%;
        }

        /* Delicate floral card shadow */
        .floral-card {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(223, 184, 196, 0.4);
            box-shadow: 0 10px 30px -8px rgba(115, 68, 82, 0.08);
        }

        /* Equalizer Animation */
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

<script>
    window._inviteWishes = @json($data['sample_wishes']);
    window._guestName = @json($guestName ?? '');
</script>

<body 
    class="bg-[#FBF6F7] text-rosewood-950 font-sans antialiased selection:bg-rosewood-200 selection:text-rosewood-950 overflow-x-hidden min-h-screen"
    x-data="{
        isOpen: false,
        isPlaying: false,
        audio: null,
        lightboxOpen: false,
        lightboxImg: '',
        copiedToast: false,
        copiedMsg: '',

        // Countdown
        days: 28,
        hours: 14,
        minutes: 42,
        seconds: 18,

        // RSVP
        rsvpName: window._guestName || '',
        rsvpGuests: '1',
        rsvpStatus: 'hadir',
        rsvpMessage: '',
        rsvpSubmitted: false,
        rsvpLoading: false,
        wishes: window._inviteWishes || [],

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
            setInterval(() => {
                if (this.seconds > 0) {
                    this.seconds--;
                } else {
                    this.seconds = 59;
                    if (this.minutes > 0) {
                        this.minutes--;
                    } else {
                        this.minutes = 59;
                        if (this.hours > 0) {
                            this.hours--;
                        } else {
                            this.hours = 23;
                            if (this.days > 0) this.days--;
                        }
                    }
                }
            }, 1000);
        }
    }"
    x-init="init()"
>

    <!-- AUDIO ELEMENT -->
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
        class="fixed bottom-6 inset-x-0 mx-auto w-fit z-50 px-5 py-3 rounded-full bg-rosewood-900 text-white text-xs font-medium shadow-2xl flex items-center gap-2 border border-rosewood-700"
        style="display: none;"
    >
        <i data-lucide="check-circle-2" class="w-4 h-4 text-rose-300"></i>
        <span x-text="copiedMsg"></span>
    </div>

    <!-- LIGHTBOX MODAL -->
    <div 
        x-show="lightboxOpen" 
        x-transition.opacity
        @keydown.escape.window="lightboxOpen = false"
        class="fixed inset-0 z-50 bg-rosewood-950/90 backdrop-blur-md flex items-center justify-center p-4"
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
            alt="Foto Detail" 
            class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl object-contain border-2 border-white/20"
        >
    </div>

    <!-- ========================================================================= -->
    <!-- 1. COVER ENTRANCE OVERLAY (Persis seperti Gambar 1 yang diunggah) -->
    <!-- ========================================================================= -->
    <div 
        x-show="!isOpen" 
        x-transition:leave="transition ease-in-out duration-700"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95 pointer-events-none"
        class="fixed inset-0 z-50 flex items-center justify-center overflow-hidden bg-rosewood-950"
    >
        <!-- Background Foto Pasangan di Pintu Kaca Putih Konservatori -->
        <div 
            class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-1000 scale-105"
            style="background-image: url('{{ !empty($data['cover_image']) ? $data['cover_image'] : ($activeStyle['cover_bg'] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1600&auto=format&fit=crop&q=85') }}');"
        >
            <!-- Gradient Scrim / Dark Tint agar teks dan lingkaran pop jelas -->
            <div class="absolute inset-0 bg-gradient-to-b from-rosewood-950/40 via-rosewood-950/50 to-rosewood-950/80"></div>
        </div>

        <!-- Konten Lingkaran Tipis Tengah (Identik dengan Screenshot User) -->
        <div class="relative z-10 w-full max-w-sm mx-auto px-4 flex flex-col items-center justify-center text-center">
            
            <!-- White Thin Circular Ring Frame -->
            <div class="w-[320px] h-[320px] sm:w-[350px] sm:h-[350px] rounded-full border border-white/60 flex flex-col items-center justify-center p-6 text-center text-white backdrop-blur-[2px] shadow-2xl relative">
                
                <!-- Subtitle -->
                <span class="text-[11px] uppercase tracking-[0.25em] font-medium text-white/90 drop-shadow-sm mb-2">
                    UNDANGAN PERNIKAHAN
                </span>

                <!-- Nama Kaligrafi Ryan & Vanya -->
                <h1 class="font-script text-4xl sm:text-5xl text-white font-normal leading-tight drop-shadow-md my-1">
                    <span data-preview="groom-nickname">{{ $data['groom']['nickname'] ?? 'Ryan' }}</span> &amp; <span data-preview="bride-nickname">{{ $data['bride']['nickname'] ?? 'Vanya' }}</span>
                </h1>

                <!-- Recipient Info -->
                <div class="my-3 space-y-0.5">
                    <p class="text-[11px] text-white/80 font-light">Kepada Yth.</p>
                    <p class="text-[11px] text-white/80 font-light">Bapak/Ibu/Saudara/i:</p>
                    <p class="font-sans font-bold text-base sm:text-lg text-white drop-shadow tracking-wide pt-1" data-preview="guest-name">
                        {{ $guestName ?? 'Nama Tamu' }}
                    </p>
                </div>

                <!-- Tombol Buka Undangan Gradient Dusty Rose -->
                <button 
                    @click="openInvitation()"
                    class="btn-dusty-gradient px-8 py-2.5 rounded-full text-white font-serif tracking-widest text-xs uppercase font-medium transition-all duration-300 hover:scale-105 active:scale-95 flex items-center justify-center gap-2 mt-2"
                >
                    <span>BUKA UNDANGAN</span>
                </button>

            </div>

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MAIN INVITATION BODY (Sesuai Alur Panjang Gambar 2) -->
    <!-- ========================================================================= -->
    <div class="min-h-screen relative flex flex-col items-center">

        <!-- FLOATING AUDIO WIDGET -->
        <div 
            x-show="isOpen"
            x-transition
            class="fixed bottom-6 right-6 z-40"
        >
            <button 
                @click="toggleAudio()"
                class="floral-card pl-3 pr-4 py-2 rounded-full shadow-xl border border-rosewood-200 hover:shadow-2xl transition-all duration-300 flex items-center gap-3 text-rosewood-900"
                title="Putar / Hentikan Musik"
            >
                <!-- Spin Vinyl or Music Icon -->
                <div class="w-7 h-7 rounded-full bg-rosewood-700 text-white flex items-center justify-center shrink-0 shadow-sm">
                    <i :data-lucide="isPlaying ? 'pause' : 'music'" class="w-3.5 h-3.5 fill-current"></i>
                </div>

                <div class="flex flex-col text-left pr-1">
                    <span class="text-[9px] uppercase tracking-wider text-rosewood-500 font-semibold">Wedding Song</span>
                    <span class="text-xs font-serif font-medium text-rosewood-900 truncate max-w-[120px]">A Thousand Years</span>
                </div>

                <!-- Equalizer animated bars -->
                <div x-show="isPlaying" class="flex items-end gap-0.5 h-3.5 px-0.5">
                    <span class="w-0.5 bg-rosewood-600 rounded-full sound-bar"></span>
                    <span class="w-0.5 bg-rosewood-600 rounded-full sound-bar"></span>
                    <span class="w-0.5 bg-rosewood-600 rounded-full sound-bar"></span>
                    <span class="w-0.5 bg-rosewood-600 rounded-full sound-bar"></span>
                </div>
            </button>
        </div>

        <!-- MAIN CONTAINER (Max width smartphone/tablet layout) -->
        <main class="w-full max-w-lg mx-auto bg-white shadow-2xl min-h-screen relative overflow-hidden flex flex-col">

            <!-- ============================================================= -->
            <!-- SECTION 1: ARCH TOP HEADER & BISMILLAH -->
            <!-- ============================================================= -->
            <section class="relative pt-16 pb-12 px-6 text-center bg-gradient-to-b from-[#FBF6F7] via-white to-white overflow-hidden">
                
                <!-- Floral Watercolor Garland Header (SVG Artwork) -->
                <div class="w-full max-w-xs mx-auto mb-6 opacity-90">
                    <svg viewBox="0 0 320 80" fill="none" class="w-full h-auto">
                        <!-- Watercolor Eucalyptus & Dusty Rose Garland -->
                        <path d="M40 50C90 20 150 25 160 30C170 25 230 20 280 50" stroke="#8E5968" stroke-width="1.5" stroke-linecap="round" opacity="0.4" />
                        <!-- Left Leaves -->
                        <ellipse cx="70" cy="38" rx="14" ry="7" transform="rotate(-25 70 38)" fill="#8FA494" opacity="0.65" />
                        <ellipse cx="100" cy="30" rx="12" ry="6" transform="rotate(15 100 30)" fill="#788F7F" opacity="0.7" />
                        <ellipse cx="130" cy="28" rx="10" ry="5" transform="rotate(-10 130 28)" fill="#9FB2A4" opacity="0.6" />
                        <!-- Center Flower Bouquet -->
                        <circle cx="160" cy="25" r="14" fill="#C79EA9" opacity="0.85" />
                        <circle cx="160" cy="25" r="9" fill="#B06F85" opacity="0.9" />
                        <circle cx="160" cy="25" r="5" fill="#7E465A" />
                        <!-- Right Leaves -->
                        <ellipse cx="190" cy="28" rx="10" ry="5" transform="rotate(10 190 28)" fill="#9FB2A4" opacity="0.6" />
                        <ellipse cx="220" cy="30" rx="12" ry="6" transform="rotate(-15 220 30)" fill="#788F7F" opacity="0.7" />
                        <ellipse cx="250" cy="38" rx="14" ry="7" transform="rotate(25 250 38)" fill="#8FA494" opacity="0.65" />
                        <!-- Accent Rosebuds -->
                        <circle cx="138" cy="32" r="7" fill="#DFB8C4" />
                        <circle cx="182" cy="32" r="7" fill="#DFB8C4" />
                    </svg>
                </div>

                <!-- Arched Container Border -->
                <div class="arch-frame border-2 border-rosewood-200/80 p-8 sm:p-10 bg-gradient-to-b from-[#FDF8F9] to-white relative">
                    
                    <!-- Bismillah Typography -->
                    <div class="font-serif text-xl sm:text-2xl text-rosewood-800 tracking-wide mb-4 font-normal">
                        بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                    </div>

                    @if(!empty($data['quote_text']))
                    <p class="text-xs text-rosewood-600/80 font-light leading-relaxed mb-6 max-w-xs mx-auto">
                        “{{ $data['quote_text'] }}”
                        @if(!empty($data['quote_source']))
                        <span class="block font-medium text-rosewood-800 mt-1.5 uppercase text-[10px] tracking-wider">
                            {{ Str::startsWith($data['quote_source'], '(') ? $data['quote_source'] : "({$data['quote_source']})" }}
                        </span>
                        @endif
                    </p>
                    @endif

                    <div class="w-12 h-px bg-rosewood-300 mx-auto my-6"></div>

                    <!-- Couple Names -->
                    <span class="text-[10px] uppercase tracking-[0.25em] text-rosewood-500 font-semibold block mb-2">
                        Walimatul 'Ursy
                    </span>
                    <h2 class="font-script text-5xl sm:text-6xl text-rosewood-900 leading-tight mb-3" data-preview="couple-nickname">
                        {{ ($data['groom']['nickname'] ?? 'Raka') . ' & ' . ($data['bride']['nickname'] ?? 'Arinda') }}
                    </h2>
                    <p class="text-xs font-serif tracking-[0.2em] uppercase text-rosewood-700" data-preview="event-date">
                        {{ $data['events']['akad']['date'] ?? 'Sabtu, 24 Oktober 2026' }}
                    </p>

                </div>

            </section>

            <!-- ============================================================= -->
            <!-- SECTION 2: COUNTDOWN & SAVE THE DATE -->
            <!-- ============================================================= -->
            <section class="py-8 px-6 text-center bg-[#FDF8F9] border-y border-rosewood-100">
                <span class="text-[10px] uppercase tracking-[0.25em] text-rosewood-500 font-bold block mb-4">
                    Menuju Hari Bahagia
                </span>

                <!-- COUNTDOWN 4 PILL BOXES -->
                <div class="grid grid-cols-4 gap-2.5 max-w-xs mx-auto">
                    <div class="floral-card rounded-2xl py-3 px-1 border border-rosewood-200 shadow-sm">
                        <span class="font-serif text-xl sm:text-2xl font-bold text-rosewood-900 block" x-text="days">28</span>
                        <span class="text-[9px] uppercase tracking-wider text-rosewood-500 font-medium">Hari</span>
                    </div>
                    <div class="floral-card rounded-2xl py-3 px-1 border border-rosewood-200 shadow-sm">
                        <span class="font-serif text-xl sm:text-2xl font-bold text-rosewood-900 block" x-text="hours">14</span>
                        <span class="text-[9px] uppercase tracking-wider text-rosewood-500 font-medium">Jam</span>
                    </div>
                    <div class="floral-card rounded-2xl py-3 px-1 border border-rosewood-200 shadow-sm">
                        <span class="font-serif text-xl sm:text-2xl font-bold text-rosewood-900 block" x-text="minutes">42</span>
                        <span class="text-[9px] uppercase tracking-wider text-rosewood-500 font-medium">Menit</span>
                    </div>
                    <div class="floral-card rounded-2xl py-3 px-1 border border-rosewood-200 shadow-sm">
                        <span class="font-serif text-xl sm:text-2xl font-bold text-rosewood-900 block" x-text="seconds">18</span>
                        <span class="text-[9px] uppercase tracking-wider text-rosewood-500 font-medium">Detik</span>
                    </div>
                </div>

                <div class="pt-6">
                    <a 
                        href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode('Pernikahan ' . ($data['groom']['nickname'] ?? 'Raka') . ' & ' . ($data['bride']['nickname'] ?? 'Arinda')) }}&details={{ urlencode('Pernikahan ' . ($data['groom']['name'] ?? '') . ' & ' . ($data['bride']['name'] ?? '')) }}&location={{ urlencode(($data['events']['akad']['venue'] ?? '') . ', ' . ($data['events']['akad']['address'] ?? '')) }}" 
                        target="_blank" 
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-rosewood-700 hover:bg-rosewood-800 text-white text-xs font-medium tracking-wider uppercase transition shadow-md hover:scale-105"
                    >
                        <i data-lucide="calendar-plus" class="w-3.5 h-3.5"></i>
                        <span>Simpan di Kalender</span>
                    </a>
                </div>
            </section>

            <!-- ============================================================= -->
            <!-- SECTION 3: MEMPELAI (OVAL FRAMES DENGAN KORSASE BUNGA) -->
            <!-- ============================================================= -->
            <section class="py-16 px-6 text-center space-y-12 bg-white">
                
                <div class="space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-rosewood-500 font-bold block">
                        Pasangan Mempelai
                    </span>
                    <h2 class="font-script text-4xl sm:text-5xl text-rosewood-900">
                        Mempelai yang Berbahagia
                    </h2>
                    <p class="text-xs text-rosewood-600 max-w-xs mx-auto leading-relaxed">
                        Maha Suci Allah yang telah mempertemukan kami berdua dalam sebuah ikatan suci pernikahan:
                    </p>
                </div>

                <!-- 1. MEMPELAI PRIA (OVAL FRAME) -->
                <div class="flex flex-col items-center space-y-4">
                    
                    <!-- Oval Photo Container with Corner Floral Flourish -->
                    <div class="relative">
                        <!-- Floral Corner SVG Decoration -->
                        <div class="absolute -top-4 -left-4 w-16 h-16 pointer-events-none z-10 text-rosewood-400">
                            <svg viewBox="0 0 60 60" fill="none">
                                <circle cx="18" cy="18" r="10" fill="#C991A3" opacity="0.8" />
                                <circle cx="28" cy="14" r="8" fill="#DFB8C4" />
                                <ellipse cx="10" cy="30" rx="9" ry="5" transform="rotate(40 10 30)" fill="#8FA494" opacity="0.7" />
                            </svg>
                        </div>

                        <!-- Oval Frame -->
                        <div class="w-44 h-56 rounded-full overflow-hidden border-4 border-[#F7EDF0] shadow-xl p-1 bg-white">
                            <img 
                                src="{{ $data['groom']['photo'] }}" 
                                alt="{{ $data['groom']['name'] }}" 
                                class="w-full h-full object-cover rounded-full"
                            >
                        </div>
                    </div>

                    <div class="space-y-1.5 pt-2">
                        <h3 class="font-serif text-2xl font-bold text-rosewood-950" data-preview="groom-name">{{ $data['groom']['name'] ?? 'Ryan Pratama, S.Kom.' }}</h3>
                        <p class="text-xs text-rosewood-700 leading-relaxed max-w-xs">
                            @if(!empty($data['groom']['child_order']))
                                {{ $data['groom']['child_order'] }} dari<br>
                            @endif
                            @if(!empty($data['groom']['father']))
                                <strong class="font-semibold text-rosewood-950">{{ $data['groom']['father'] }}</strong>
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
                        class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-rosewood-50 text-rosewood-700 text-xs font-medium border border-rosewood-200 hover:bg-rosewood-100 transition"
                    >
                        <i data-lucide="instagram" class="w-3.5 h-3.5 text-rosewood-600"></i>
                        <span>{{ '@' . ltrim($data['groom']['instagram'], '@') }}</span>
                    </a>
                    @endif

                </div>

                <!-- Divider Heart / Florals -->
                <div class="flex items-center justify-center gap-3 text-rosewood-300">
                    <span class="w-12 h-px bg-rosewood-200"></span>
                    <span class="font-script text-3xl text-rosewood-500">&amp;</span>
                    <span class="w-12 h-px bg-rosewood-200"></span>
                </div>

                <!-- 2. MEMPELAI WANITA (OVAL FRAME) -->
                <div class="flex flex-col items-center space-y-4">
                    
                    <!-- Oval Photo Container with Corner Floral Flourish -->
                    <div class="relative">
                        <!-- Floral Corner SVG Decoration (Bottom-Right) -->
                        <div class="absolute -bottom-4 -right-4 w-16 h-16 pointer-events-none z-10 text-rosewood-400">
                            <svg viewBox="0 0 60 60" fill="none">
                                <circle cx="42" cy="42" r="10" fill="#C991A3" opacity="0.8" />
                                <circle cx="32" cy="46" r="8" fill="#DFB8C4" />
                                <ellipse cx="50" cy="30" rx="9" ry="5" transform="rotate(-40 50 30)" fill="#8FA494" opacity="0.7" />
                            </svg>
                        </div>

                        <!-- Oval Frame -->
                        <div class="w-44 h-56 rounded-full overflow-hidden border-4 border-[#F7EDF0] shadow-xl p-1 bg-white">
                            <img 
                                src="{{ $data['bride']['photo'] }}" 
                                alt="{{ $data['bride']['name'] }}" 
                                class="w-full h-full object-cover rounded-full"
                            >
                        </div>
                    </div>

                    <div class="space-y-1.5 pt-2">
                        <h3 class="font-serif text-2xl font-bold text-rosewood-950" data-preview="bride-name">{{ $data['bride']['name'] ?? 'Vanya Citra Kirana, S.I.Kom.' }}</h3>
                        <p class="text-xs text-rosewood-700 leading-relaxed max-w-xs">
                            @if(!empty($data['bride']['child_order']))
                                {{ $data['bride']['child_order'] }} dari<br>
                            @endif
                            @if(!empty($data['bride']['father']))
                                <strong class="font-semibold text-rosewood-950">{{ $data['bride']['father'] }}</strong>
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
                        class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-rosewood-50 text-rosewood-700 text-xs font-medium border border-rosewood-200 hover:bg-rosewood-100 transition"
                    >
                        <i data-lucide="instagram" class="w-3.5 h-3.5 text-rosewood-600"></i>
                        <span>{{ '@' . ltrim($data['bride']['instagram'], '@') }}</span>
                    </a>
                    @endif

                </div>

            </section>

            <!-- ============================================================= -->
            <!-- SECTION 4: LOVE STORY (DEEP DUSTY ROSE STRIP DENGAN KARTU) -->
            <!-- ============================================================= -->
            @if (!empty($data['stories']) && count($data['stories']) > 0)
            <section class="py-16 px-6 bg-[#7E465A] text-white text-center space-y-10 relative">
                
                <div class="space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-rose-200 font-bold block">
                        Perjalanan Cinta
                    </span>
                    <h2 class="font-script text-4xl sm:text-5xl text-rose-100">
                        Our Love Story
                    </h2>
                    <p class="text-xs text-rose-200/80 max-w-xs mx-auto">
                        Momen-momen indah yang menuntun langkah kami hingga menuju pelaminan suci:
                    </p>
                </div>

                <!-- Story Vertical Cards -->
                <div class="space-y-6 max-w-sm mx-auto text-left" data-preview-container="stories">
                    
                    @foreach ($data['stories'] as $index => $story)
                        @php
                            $storyImages = [
                                'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80',
                                'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&auto=format&fit=crop&q=80',
                                'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                                'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=80',
                            ];
                            $storyImg = !empty($story['image_url']) ? $story['image_url'] : $storyImages[$index % count($storyImages)];
                        @endphp
                        <div class="bg-white rounded-3xl overflow-hidden shadow-xl text-rosewood-950 border border-rosewood-200">
                            <div class="aspect-[16/10] overflow-hidden">
                                <img 
                                    src="{{ $storyImg }}" 
                                    alt="{{ $story['title'] }}" 
                                    class="w-full h-full object-cover"
                                >
                            </div>
                            <div class="p-5 space-y-1.5">
                                <span data-preview="story-year-{{ $index + 1 }}" class="text-[10px] font-bold uppercase tracking-wider text-rosewood-500">{{ $story['year'] }}</span>
                                <h4 data-preview="story-title-{{ $index + 1 }}" class="font-serif text-lg font-bold text-rosewood-950">{{ $story['title'] }}</h4>
                                <p data-preview="story-desc-{{ $index + 1 }}" class="text-xs text-rosewood-700 leading-relaxed">
                                    {{ $story['desc'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>

            </section>
            @endif

            <!-- ============================================================= -->
            <!-- SECTION 5: RANGKAIAN ACARA (ARCH CARDS & GOOGLE MAPS) -->
            <!-- ============================================================= -->
            <section class="py-16 px-6 bg-[#FBF6F7] space-y-10">
                
                <div class="text-center space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-rosewood-500 font-bold block">
                        Rangkaian Acara
                    </span>
                    <h2 class="font-script text-4xl sm:text-5xl text-rosewood-900">
                        Waktu &amp; Tempat
                    </h2>
                    <p class="text-xs text-rosewood-600 max-w-xs mx-auto">
                        Dengan penuh rasa syukur, kami mengundang Anda untuk hadir pada:
                    </p>
                </div>

                <div class="space-y-6 max-w-sm mx-auto">
                    
                    <!-- 1. AKAD NIKAH ARCH CARD -->
                    <div class="floral-card arch-frame p-8 text-center space-y-4 border-2 border-rosewood-200">
                        
                        <div class="w-10 h-10 rounded-full bg-rosewood-100 text-rosewood-700 mx-auto flex items-center justify-center">
                            <i data-lucide="heart" class="w-5 h-5 fill-current"></i>
                        </div>

                        <div>
                            <span class="px-3 py-1 rounded-full bg-rosewood-100 text-rosewood-800 text-[10px] font-bold uppercase tracking-wider">
                                Akad Nikah
                            </span>
                            <h3 class="font-serif text-xl font-bold text-rosewood-950 mt-3" data-preview="event-date">{{ $data['events']['akad']['date'] }}</h3>
                            <p class="text-xs font-semibold text-rosewood-700 mt-1">{{ $data['events']['akad']['time'] }}</p>
                        </div>

                        <div class="pt-3 border-t border-rosewood-100 text-xs text-rosewood-700 space-y-1">
                            <p class="font-bold text-rosewood-900" data-preview="venue-name">{{ $data['events']['akad']['venue'] }}</p>
                            <p class="leading-relaxed">{{ $data['events']['akad']['address'] }}</p>
                        </div>

                        <div class="pt-2">
                            <a 
                                href="{{ $data['events']['akad']['maps_link'] }}" 
                                target="_blank" 
                                class="w-full py-2.5 rounded-full bg-rosewood-700 hover:bg-rosewood-800 text-white text-xs font-medium transition flex items-center justify-center gap-2 shadow"
                            >
                                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                <span>Buka Google Maps</span>
                            </a>
                        </div>

                    </div>

                    <!-- 2. RESEPSI PERNIKAHAN ARCH CARD -->
                    <div class="floral-card arch-frame p-8 text-center space-y-4 border-2 border-rosewood-200">
                        
                        <div class="w-10 h-10 rounded-full bg-rosewood-100 text-rosewood-700 mx-auto flex items-center justify-center">
                            <i data-lucide="sparkles" class="w-5 h-5"></i>
                        </div>

                        <div>
                            <span class="px-3 py-1 rounded-full bg-rosewood-100 text-rosewood-800 text-[10px] font-bold uppercase tracking-wider">
                                Resepsi Pernikahan
                            </span>
                            <h3 class="font-serif text-xl font-bold text-rosewood-950 mt-3" data-preview="event-date">{{ $data['events']['resepsi']['date'] }}</h3>
                            <p class="text-xs font-semibold text-rosewood-700 mt-1">{{ $data['events']['resepsi']['time'] }}</p>
                        </div>

                        <div class="pt-3 border-t border-rosewood-100 text-xs text-rosewood-700 space-y-1">
                            <p class="font-bold text-rosewood-900" data-preview="venue-name">{{ $data['events']['resepsi']['venue'] }}</p>
                            <p class="leading-relaxed">{{ $data['events']['resepsi']['address'] }}</p>
                        </div>

                        <div class="pt-2">
                            <a 
                                href="{{ $data['events']['resepsi']['maps_link'] }}" 
                                target="_blank" 
                                class="w-full py-2.5 rounded-full bg-rosewood-700 hover:bg-rosewood-800 text-white text-xs font-medium transition flex items-center justify-center gap-2 shadow"
                            >
                                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                <span>Buka Google Maps</span>
                            </a>
                        </div>
                    </div>

                    </div>

                </div>

            </section>

            <!-- ============================================================= -->
            <!-- SECTION 6: PROTOKOL KESEHATAN -->
            <!-- ============================================================= -->
            <!-- <section class="py-12 px-6 bg-white text-center space-y-6 border-b border-rosewood-100">
                <div class="space-y-1">
                    <span class="text-[10px] uppercase tracking-[0.25em] text-rosewood-500 font-bold block">
                        Himbauan Kenyamanan
                    </span>
                    <h3 class="font-serif text-lg font-bold text-rosewood-950">
                        Protokol Acara
                    </h3>
                    <p class="text-[11px] text-rosewood-600 max-w-xs mx-auto">
                        Demi kenyamanan bersama seluruh tamu undangan, mohon memperhatikan hal berikut:
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-sm mx-auto">
                    <div class="p-3.5 rounded-2xl bg-[#FBF6F7] border border-rosewood-100 flex flex-col items-center text-center space-y-1.5">
                        <i data-lucide="smile" class="w-5 h-5 text-rosewood-600"></i>
                        <span class="text-[10px] font-semibold text-rosewood-900">Gunakan Masker</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-[#FBF6F7] border border-rosewood-100 flex flex-col items-center text-center space-y-1.5">
                        <i data-lucide="shield-check" class="w-5 h-5 text-rosewood-600"></i>
                        <span class="text-[10px] font-semibold text-rosewood-900">Cuci Tangan</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-[#FBF6F7] border border-rosewood-100 flex flex-col items-center text-center space-y-1.5">
                        <i data-lucide="users" class="w-5 h-5 text-rosewood-600"></i>
                        <span class="text-[10px] font-semibold text-rosewood-900">Jaga Jarak</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-[#FBF6F7] border border-rosewood-100 flex flex-col items-center text-center space-y-1.5">
                        <i data-lucide="hand-metal" class="w-5 h-5 text-rosewood-600"></i>
                        <span class="text-[10px] font-semibold text-rosewood-900">Hindari Kontak</span>
                    </div>
                </div>
            </section> -->

            <!-- ============================================================= -->
            <!-- SECTION 7: GALERI FOTO (MOMEN BAHAGIA) -->
            <!-- ============================================================= -->
            @if(!empty($data['galleries']))
            <section class="py-16 px-6 bg-white space-y-8">
                
                <div class="text-center space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-rosewood-500 font-bold block">
                        Galeri Kenangan
                    </span>
                    <h2 class="font-script text-4xl sm:text-5xl text-rosewood-900">
                        Our Happy Moments
                    </h2>
                </div>

                <div class="grid grid-cols-2 gap-3 max-w-sm mx-auto">
                    @foreach ($data['galleries'] as $img)
                        <div 
                            @click="openPhoto('{{ $img }}')"
                            class="relative aspect-[3/4] rounded-2xl overflow-hidden cursor-pointer group shadow-sm border border-rosewood-200"
                        >
                            <img 
                                src="{{ $img }}" 
                                alt="Galeri {{ $data['groom']['nickname'] ?? 'Mempelai' }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                            <div class="absolute inset-0 bg-rosewood-950/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="w-8 h-8 rounded-full bg-white/90 text-rosewood-900 flex items-center justify-center shadow">
                                    <i data-lucide="maximize-2" class="w-4 h-4"></i>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

            </section>
            @endif

            <!-- ============================================================= -->
            <!-- SECTION 8: AMPLOP DIGITAL (TANDA KASIH) -->
            <!-- ============================================================= -->
            @if(!empty($data['bank_accounts']) || !empty($data['gift_address']))
            <section class="py-16 px-6 bg-[#FDF8F9] space-y-8 border-t border-rosewood-100">
                
                <div class="text-center space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-rosewood-500 font-bold block">
                        Tanda Kasih
                    </span>
                    <h2 class="font-script text-4xl sm:text-5xl text-rosewood-900">
                        Amplop Digital
                    </h2>
                    <p class="text-xs text-rosewood-600 max-w-xs mx-auto leading-relaxed">
                        Doa restu Anda adalah karunia terbaik. Namun jika Anda bermaksud memberi tanda kasih, dapat disalurkan melalui:
                    </p>
                </div>

                <div class="space-y-4 max-w-sm mx-auto">
                    @foreach ($data['bank_accounts'] as $acc)
                        <div class="floral-card rounded-2xl p-5 border border-rosewood-200 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="font-serif font-bold text-sm text-rosewood-950">{{ $acc['bank'] }}</span>
                                <i data-lucide="credit-card" class="w-4 h-4 text-rosewood-400"></i>
                            </div>
                            <div class="space-y-0.5">
                                <p class="font-mono text-base font-bold text-rosewood-950">{{ $acc['account_number'] }}</p>
                                <p class="text-xs text-rosewood-600">a.n. {{ $acc['account_name'] }}</p>
                            </div>
                            <button 
                                @click="copyToClipboard('{{ str_replace(' ', '', $acc['account_number']) }}', 'Nomor Rekening {{ $acc['bank'] }}')"
                                class="w-full py-2 rounded-xl bg-rosewood-50 hover:bg-rosewood-100 text-rosewood-800 text-xs font-semibold border border-rosewood-200 transition flex items-center justify-center gap-1.5"
                            >
                                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                <span>Salin Nomor Rekening</span>
                            </button>
                        </div>
                    @endforeach

                    @if(!empty($data['gift_address']))
                        <div class="floral-card rounded-2xl p-5 border border-rosewood-200 space-y-2 text-left">
                            <div class="flex items-center justify-between">
                                <span class="font-serif font-bold text-xs text-rosewood-950 uppercase tracking-wider">Kirim Kado Fisik</span>
                                <i data-lucide="package" class="w-4 h-4 text-rosewood-400"></i>
                            </div>
                            <p class="text-xs text-rosewood-700 leading-relaxed">
                                {{ $data['gift_address'] }}
                            </p>
                            <button 
                                type="button" 
                                @click="copyToClipboard('{{ $data['gift_address'] }}', 'Alamat Pengiriman Kado')"
                                class="inline-flex items-center gap-1.5 text-xs font-semibold text-rosewood-800 hover:underline pt-1"
                            >
                                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                <span>Salin Alamat Lengkap</span>
                            </button>
                        </div>
                    @endif
                </div>

            </section>
            @endif

            <!-- ============================================================= -->
            <!-- SECTION 9: RSVP & BUKU TAMU (DOA RESTU) -->
            <!-- ============================================================= -->
            <section class="py-16 px-6 bg-white space-y-8">
                
                <div class="text-center space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-rosewood-500 font-bold block">
                        RSVP &amp; Doa Restu
                    </span>
                    <h2 class="font-script text-4xl sm:text-5xl text-rosewood-900">
                        Konfirmasi Kehadiran
                    </h2>
                    <p class="text-xs text-rosewood-600 max-w-xs mx-auto">
                        Mohon kesediaan Anda untuk mengonfirmasi kehadiran demi kelancaran acara:
                    </p>
                </div>

                <div class="floral-card rounded-3xl p-6 sm:p-7 border border-rosewood-200 shadow-md space-y-6 max-w-sm mx-auto">
                    
                    <div class="space-y-4">
                        
                        <!-- Nama -->
                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-rosewood-800 block">Nama Lengkap</label>
                            <input 
                                type="text" 
                                x-model="rsvpName" 
                                class="w-full px-4 py-2.5 rounded-xl border border-rosewood-200 bg-white text-xs text-rosewood-950 focus:outline-none focus:border-rosewood-500"
                                placeholder="Masukkan nama Anda"
                            >
                        </div>

                        <!-- Jumlah & Status -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-rosewood-800 block">Jumlah Tamu</label>
                                <select 
                                    x-model="rsvpGuests" 
                                    class="w-full px-3 py-2.5 rounded-xl border border-rosewood-200 bg-white text-xs text-rosewood-950 focus:outline-none focus:border-rosewood-500"
                                >
                                    <option value="1">1 Orang</option>
                                    <option value="2">2 Orang</option>
                                </select>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-rosewood-800 block">Status Kehadiran</label>
                                <select 
                                    x-model="rsvpStatus" 
                                    class="w-full px-3 py-2.5 rounded-xl border border-rosewood-200 bg-white text-xs text-rosewood-950 focus:outline-none focus:border-rosewood-500"
                                >
                                    <option value="hadir">Hadir</option>
                                    <option value="berhalangan">Berhalangan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Ucapan -->
                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-rosewood-800 block">Ucapan &amp; Doa Restu</label>
                            <textarea 
                                x-model="rsvpMessage"
                                rows="3" 
                                class="w-full px-4 py-2.5 rounded-xl border border-rosewood-200 bg-white text-xs text-rosewood-950 focus:outline-none focus:border-rosewood-500"
                                placeholder="Tulis doa restu hangat untuk Ryan & Vanya..."
                            ></textarea>
                        </div>

                        <button 
                            @click="submitRsvp()" 
                            :disabled="rsvpLoading"
                            class="w-full py-3 rounded-xl bg-rosewood-700 hover:bg-rosewood-800 disabled:opacity-60 text-white text-xs font-semibold tracking-wider uppercase transition flex items-center justify-center gap-2 shadow"
                        >
                            <template x-if="rsvpLoading">
                                <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                            </template>
                            <template x-if="!rsvpLoading">
                                <i data-lucide="send" class="w-3.5 h-3.5"></i>
                            </template>
                            <span x-text="rsvpLoading ? 'Mengirim...' : 'Kirim Konfirmasi'"></span>
                        </button>

                    </div>

                    <!-- SUCCESS ALERT -->
                    <div 
                        x-show="rsvpSubmitted" 
                        x-transition 
                        class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2"
                    >
                        <i data-lucide="check" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                        <span>Terima kasih! Konfirmasi dan doa Anda telah tersimpan.</span>
                    </div>

                    <!-- WISHES FEED -->
                    <div class="pt-4 border-t border-rosewood-100 space-y-3">
                        <span class="text-xs font-bold text-rosewood-900 block">Doa &amp; Ucapan Sahabat:</span>
                        
                        <div class="space-y-2.5 max-h-56 overflow-y-auto pr-1">
                            <template x-for="(w, idx) in wishes" :key="idx">
                                <div class="p-3 rounded-2xl bg-[#FDF8F9] border border-rosewood-100 space-y-1 text-left">
                                    <div class="flex items-center justify-between text-[11px]">
                                        <span class="font-bold text-rosewood-900" x-text="w.name"></span>
                                        <span class="text-rosewood-400 text-[10px]" x-text="w.time"></span>
                                    </div>
                                    <p class="text-xs text-rosewood-700 leading-relaxed" x-text="w.msg"></p>
                                </div>
                            </template>
                        </div>
                    </div>

                </div>

            </section>

            <!-- ============================================================= -->
            <!-- SECTION 10: PENUTUP (CLOSING OVAL & THANK YOU) -->
            <!-- ============================================================= -->
            <footer class="py-16 px-6 bg-gradient-to-b from-white to-[#F7EDF0] text-center space-y-6 border-t border-rosewood-100">
                
                <div class="w-28 h-36 rounded-full overflow-hidden border-2 border-rosewood-300 mx-auto shadow-md p-1 bg-white">
                    <img 
                        src="{{ !empty($data['cover_image']) ? $data['cover_image'] : ($activeStyle['cover_bg'] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?w=500&auto=format&fit=crop&q=80') }}" 
                        alt="{{ $data['groom']['nickname'] ?? 'Ryan' }} &amp; {{ $data['bride']['nickname'] ?? 'Vanya' }}" 
                        class="w-full h-full object-cover rounded-full"
                    >
                </div>

                <div class="space-y-2 max-w-xs mx-auto">
                    <p class="font-serif italic text-sm text-rosewood-700 leading-relaxed">
                        Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Anda berkenan hadir dan memberikan doa restu.
                    </p>
                    <h3 class="font-script text-4xl text-rosewood-900 pt-1">
                        {{ $data['groom']['nickname'] ?? 'Ryan' }} &amp; {{ $data['bride']['nickname'] ?? 'Vanya' }}
                    </h3>
                </div>

                <div class="pt-6">
                    <a 
                        href="{{ route('themes.catalog') }}" 
                        class="text-[11px] text-rosewood-400 hover:text-rosewood-700 transition"
                    >
                        Dibuat dengan cinta menggunakan <strong class="text-rosewood-800">KlikMomen</strong>
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
