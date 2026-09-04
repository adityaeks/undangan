<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>The Wedding of Raka & Arinda — Botanical Glassmorphism Edition</title>

    <!-- Meta SEO & Social Sharing Preview (OpenGraph) -->
    <meta name="description" content="Official Wedding Website of Raka Pratama & Arinda Putri Larasati. Nuansa Botanical Sage & Ethereal Glass.">
    <meta property="og:title" content="Raka & Arinda — Botanical Wedding Edition">
    <meta property="og:description" content="Sabtu, 24 Oktober 2026 - Jakarta">
    <meta property="og:image" content="https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=1200&auto=format&fit=crop&q=85">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Monsieur+La+Doulaise&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Cormorant Garamond"', 'serif'],
                        italiana: ['"Italiana"', 'serif'],
                        script: ['"Monsieur La Doulaise"', 'cursive'],
                        playfair: ['"Playfair Display"', 'serif'],
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
        .font-script { font-family: 'Monsieur La Doulaise', cursive; }
        .font-italiana { font-family: 'Italiana', serif; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Arched Geometry Shape */
        .arch-frame {
            border-radius: 9999px 9999px 24px 24px;
        }

        /* Glassmorphic Frosted Glass */
        .glass-botanical {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.85);
            box-shadow: 0 20px 40px -15px rgba(27, 50, 39, 0.08);
        }

        /* Floating Falling Leaves Animation */
        @keyframes float-leaf {
            0% { transform: translateY(-10px) rotate(0deg); opacity: 0.8; }
            50% { transform: translateY(15px) rotate(15deg); opacity: 1; }
            100% { transform: translateY(-10px) rotate(0deg); opacity: 0.8; }
        }
        .animate-float-leaf {
            animation: float-leaf 6s ease-in-out infinite;
        }

        @keyframes pulse-gentle {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.04); opacity: 0.92; }
        }
        .animate-pulse-gentle {
            animation: pulse-gentle 3s ease-in-out infinite;
        }

        /* Vinyl Disc Rotation */
        @keyframes vinyl-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-vinyl {
            animation: vinyl-spin 12s linear infinite;
        }

        /* Hide scrollbars */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body 
    class="bg-[#F4F7F4] text-[#1D3328] font-sans antialiased overflow-x-hidden min-h-screen relative selection:bg-emerald-200 selection:text-emerald-950"
    x-data="botanicalInvitationApp()"
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
        class="fixed top-6 left-1/2 -translate-x-1/2 z-50 px-5 py-3 rounded-full bg-[#182C22]/95 backdrop-blur-md text-emerald-100 shadow-2xl border border-white/20 flex items-center gap-3 text-xs sm:text-sm font-medium"
        style="display: none;"
    >
        <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-300 flex items-center justify-center">
            <i data-lucide="leaf" class="w-3.5 h-3.5"></i>
        </span>
        <span x-text="toast.message"></span>
    </div>

    <!-- MAIN INVITATION WRAPPER -->
    <div class="max-w-md mx-auto min-h-screen bg-[#F4F7F4] shadow-2xl relative overflow-hidden">

        <!-- ============================================================== -->
        <!-- 1. BOTANICAL ARCHED COVER SCREEN WITH WATERCOLOR OVERLAY -->
        <!-- ============================================================== -->
        <div 
            x-show="!isOpened"
            x-transition:leave="transition ease-in-out duration-800 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-full scale-95 pointer-events-none"
            class="fixed inset-0 max-w-md mx-auto z-50 flex flex-col justify-between p-7 text-center text-[#1E362A] bg-[#EFF4F0] overflow-hidden"
        >
            <!-- TOP BOTANICAL WATERMARK -->
            <div class="absolute -top-12 -right-12 w-48 h-48 rounded-full bg-emerald-200/40 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-12 -left-12 w-48 h-48 rounded-full bg-amber-200/30 blur-3xl pointer-events-none"></div>

            <!-- HEADER TEXT -->
            <div class="relative z-10 pt-4 space-y-1">
                <span class="font-italiana text-xs uppercase tracking-[0.35em] text-[#3D6350] block font-bold">The Wedding Celebration</span>
                <p class="text-[10px] tracking-[0.2em] uppercase text-stone-500 font-medium">Under The Grace of Nature</p>
            </div>

            <!-- CENTER ARCHED PHOTO WITH FLOATING NAMES -->
            <div class="relative z-10 my-auto py-2">
                <div class="relative w-60 h-80 mx-auto arch-frame overflow-hidden shadow-2xl border-4 border-white">
                    <img src="{{ $data['cover_image'] ?? 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=85' }}" alt="Cover" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#152B20]/80 via-transparent to-transparent"></div>
                    
                    <div class="absolute bottom-4 inset-x-0 text-white text-center space-y-0.5">
                        <span class="text-[9px] uppercase tracking-widest text-emerald-200 font-bold">Save The Date</span>
                        <p class="font-serif text-sm font-semibold tracking-wider">24 • 10 • 2026</p>
                    </div>
                </div>

                <!-- OVERLAPPING CALLIGRAPHIC NAMES -->
                <div class="pt-4 space-y-1">
                    <h1 class="font-italiana text-3xl sm:text-4xl font-bold tracking-wider text-[#183024]">
                        Raka <span class="font-script text-4xl sm:text-5xl text-[#537D66]">&amp;</span> Arinda
                    </h1>
                </div>
            </div>

            <!-- BOTTOM RECIPIENT BOX & OPEN INVITATION BUTTON -->
            <div class="relative z-10 pb-4 space-y-4">
                <div class="p-3.5 rounded-2xl glass-botanical text-center space-y-1 max-w-xs mx-auto shadow-sm">
                    <span class="text-[9px] uppercase tracking-[0.2em] font-semibold text-[#507560]">Kepada Yth. Bapak/Ibu/Saudara(i):</span>
                    <h4 class="font-serif text-base font-bold text-[#183024]">{{ $guestName }}</h4>
                </div>

                <!-- OPEN BUTTON -->
                <button 
                    @click="openInvitation()"
                    type="button"
                    class="w-full max-w-xs mx-auto py-3.5 px-6 rounded-full bg-gradient-to-r from-[#294B3A] via-[#355E49] to-[#294B3A] text-white font-bold text-xs uppercase tracking-[0.2em] shadow-xl hover:shadow-emerald-900/30 hover:scale-[1.02] active:scale-[0.98] transition flex items-center justify-center gap-2 animate-pulse-gentle"
                >
                    <i data-lucide="flower-2" class="w-4 h-4 text-emerald-200"></i>
                    <span>Buka Undangan</span>
                </button>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- 2. FLOATING VINYL MUSIC & NAV CONTROLLER -->
        <!-- ============================================================== -->
        <div 
            x-show="isOpened" 
            x-transition
            class="fixed bottom-20 right-4 sm:right-[calc(50%-200px)] z-40"
        >
            <button 
                @click="toggleMusic()" 
                type="button"
                class="w-12 h-12 rounded-full bg-[#1A3326] text-emerald-200 shadow-2xl border-2 border-white/50 flex items-center justify-center hover:scale-110 active:scale-95 transition"
                title="A Thousand Years - Romantic Acoustic"
            >
                <div x-show="isPlaying" class="w-7 h-7 rounded-full border-2 border-dashed border-emerald-300 animate-vinyl flex items-center justify-center">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                </div>
                <div x-show="!isPlaying" class="text-stone-400">
                    <i data-lucide="volume-x" class="w-4 h-4"></i>
                </div>
            </button>
        </div>

        <!-- ============================================================== -->
        <!-- 3. INVITATION MAIN CONTENT (BOTANICAL GLASS NARRATIVE) -->
        <!-- ============================================================== -->
        <div x-show="isOpened" class="space-y-16 pb-28 pt-8 px-6">
            
            <!-- SECTION: HERO GREETING WITH ARCH GEOMETRY -->
            <section id="sec-cover" class="text-center space-y-6">
                <div class="space-y-1">
                    <span class="font-italiana text-xs uppercase tracking-[0.3em] text-[#3D6350] font-bold">Walimatul 'Ursy</span>
                    <h2 class="font-italiana text-4xl font-bold tracking-wide text-[#183024]">
                        Raka &amp; Arinda
                    </h2>
                    <p class="text-xs uppercase tracking-[0.2em] text-stone-500 font-medium">Sabtu, 24 Oktober 2026</p>
                </div>

                <!-- ARCHED PHOTO WITH BOTANICAL ACCENTS -->
                <div class="relative w-64 h-84 mx-auto arch-frame overflow-hidden shadow-xl border-4 border-white">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80" alt="Couple" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#152B20]/75 via-transparent to-transparent flex items-end justify-center p-6 text-white text-center">
                        <p class="font-serif text-sm italic">"Two souls, one sacred journey"</p>
                    </div>
                </div>

                <!-- SURAH AR-RUM CARD -->
                <div class="p-6 rounded-3xl glass-botanical text-center space-y-3">
                    <i data-lucide="heart" class="w-5 h-5 mx-auto text-[#3D6350] fill-current"></i>
                    <h4 class="font-italiana text-base font-bold text-[#183024]">Maha Suci Allah SWT</h4>
                    <p class="font-serif text-base italic leading-relaxed text-[#355243]">
                        "Dan di antara tanda-tanda kebesaran-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
                    </p>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#3D6350] block">(QS. Ar-Rum: 21)</span>
                </div>
            </section>

            <!-- SECTION: MEMPELAI (THE COUPLE) -->
            <section id="sec-mempelai" class="space-y-8">
                <div class="text-center space-y-1">
                    <span class="font-italiana text-xs uppercase tracking-[0.25em] text-[#3D6350] font-bold">The Bride &amp; Groom</span>
                    <h3 class="font-italiana text-3xl font-bold text-[#183024]">Pasangan Mempelai</h3>
                    <p class="text-xs text-stone-500">Maha Suci Allah yang telah mempertemukan kedua insan ini:</p>
                </div>

                <!-- GROOM ARCH CARD -->
                <div class="p-6 rounded-3xl glass-botanical text-center space-y-4">
                    <div class="w-32 h-40 mx-auto arch-frame overflow-hidden shadow-md border-2 border-white">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80" alt="{{ $data['groom']['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-italiana text-2xl font-bold text-[#183024]">{{ $data['groom']['name'] }}</h4>
                        <p class="text-xs text-[#406150] leading-relaxed">
                            {{ $data['groom']['child_order'] }} dari pasangan terhormat<br>
                            <strong class="text-[#183024] font-semibold">{{ $data['groom']['father'] }}</strong> &amp; <strong class="text-[#183024] font-semibold">{{ $data['groom']['mother'] }}</strong>
                        </p>
                    </div>
                    <a href="https://instagram.com/{{ $data['groom']['instagram'] }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-100/80 text-[#204030] text-xs font-semibold hover:bg-emerald-200 transition">
                        <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                        <span>{{ '@' . $data['groom']['instagram'] }}</span>
                    </a>
                </div>

                <!-- SCRIPT CONNECTOR -->
                <div class="text-center">
                    <span class="font-script text-6xl text-[#4A725D]">&amp;</span>
                </div>

                <!-- BRIDE ARCH CARD -->
                <div class="p-6 rounded-3xl glass-botanical text-center space-y-4">
                    <div class="w-32 h-40 mx-auto arch-frame overflow-hidden shadow-md border-2 border-white">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80" alt="{{ $data['bride']['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-italiana text-2xl font-bold text-[#183024]">{{ $data['bride']['name'] }}</h4>
                        <p class="text-xs text-[#406150] leading-relaxed">
                            {{ $data['bride']['child_order'] }} dari pasangan terhormat<br>
                            <strong class="text-[#183024] font-semibold">{{ $data['bride']['father'] }}</strong> &amp; <strong class="text-[#183024] font-semibold">{{ $data['bride']['mother'] }}</strong>
                        </p>
                    </div>
                    <a href="https://instagram.com/{{ $data['bride']['instagram'] }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-100/80 text-[#204030] text-xs font-semibold hover:bg-emerald-200 transition">
                        <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                        <span>{{ '@' . $data['bride']['instagram'] }}</span>
                    </a>
                </div>
            </section>

            <!-- SECTION: RANGKAIAN ACARA (EVENTS & ITINERARY) -->
            <section id="sec-acara" class="space-y-8">
                <div class="text-center space-y-1">
                    <span class="font-italiana text-xs uppercase tracking-[0.25em] text-[#3D6350] font-bold">Wedding Timeline</span>
                    <h3 class="font-italiana text-3xl font-bold text-[#183024]">Rangkaian Acara</h3>
                    <p class="text-xs text-stone-500">Waktu dan lokasi prosesi pernikahan kami</p>
                </div>

                <!-- COUNTDOWN TIMER -->
                <div class="p-6 rounded-3xl glass-botanical text-center space-y-4 shadow-sm">
                    <span class="text-[10px] uppercase font-bold tracking-[0.2em] text-[#3D6350]">Menuju Hari Bahagia</span>
                    <div class="grid grid-cols-4 gap-2">
                        <div class="p-3 rounded-2xl bg-[#E2ECE4] text-[#1E382A]">
                            <div class="font-italiana text-2xl font-bold" x-text="countdown.days">00</div>
                            <div class="text-[8px] uppercase tracking-wider font-bold">Hari</div>
                        </div>
                        <div class="p-3 rounded-2xl bg-[#E2ECE4] text-[#1E382A]">
                            <div class="font-italiana text-2xl font-bold" x-text="countdown.hours">00</div>
                            <div class="text-[8px] uppercase tracking-wider font-bold">Jam</div>
                        </div>
                        <div class="p-3 rounded-2xl bg-[#E2ECE4] text-[#1E382A]">
                            <div class="font-italiana text-2xl font-bold" x-text="countdown.minutes">00</div>
                            <div class="text-[8px] uppercase tracking-wider font-bold">Menit</div>
                        </div>
                        <div class="p-3 rounded-2xl bg-[#E2ECE4] text-[#1E382A]">
                            <div class="font-italiana text-2xl font-bold" x-text="countdown.seconds">00</div>
                            <div class="text-[8px] uppercase tracking-wider font-bold">Detik</div>
                        </div>
                    </div>
                </div>

                <!-- AKAD NIKAH CARD -->
                <div class="p-6 rounded-3xl glass-botanical space-y-4 text-center">
                    <div class="w-10 h-10 rounded-full bg-[#E2ECE4] text-[#294B3A] flex items-center justify-center mx-auto">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-italiana text-2xl font-bold text-[#183024]">{{ $data['events']['akad']['title'] }}</h4>
                        <p class="text-xs font-semibold text-[#3D6350]">{{ $data['events']['akad']['date'] }}</p>
                        <p class="text-xs font-bold text-[#183024]">{{ $data['events']['akad']['time'] }}</p>
                    </div>
                    <div class="pt-3 border-t border-emerald-900/10 text-xs space-y-1 text-[#406150]">
                        <p class="font-bold text-[#183024]">{{ $data['events']['akad']['venue'] }}</p>
                        <p>{{ $data['events']['akad']['address'] }}</p>
                    </div>
                    <a 
                        href="{{ $data['events']['akad']['maps_link'] }}" 
                        target="_blank" 
                        class="inline-flex items-center justify-center gap-2 w-full py-3 rounded-2xl bg-[#294B3A] text-white text-xs font-bold shadow-md hover:bg-[#1E382A] transition"
                    >
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        <span>Petunjuk Lokasi Google Maps</span>
                    </a>
                </div>

                <!-- RESEPSI PERNIKAHAN CARD -->
                <div class="p-6 rounded-3xl glass-botanical space-y-4 text-center">
                    <div class="w-10 h-10 rounded-full bg-[#E2ECE4] text-[#294B3A] flex items-center justify-center mx-auto">
                        <i data-lucide="sparkles" class="w-5 h-5"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-italiana text-2xl font-bold text-[#183024]">{{ $data['events']['resepsi']['title'] }}</h4>
                        <p class="text-xs font-semibold text-[#3D6350]">{{ $data['events']['resepsi']['date'] }}</p>
                        <p class="text-xs font-bold text-[#183024]">{{ $data['events']['resepsi']['time'] }}</p>
                    </div>
                    <div class="pt-3 border-t border-emerald-900/10 text-xs space-y-1 text-[#406150]">
                        <p class="font-bold text-[#183024]">{{ $data['events']['resepsi']['venue'] }}</p>
                        <p>{{ $data['events']['resepsi']['address'] }}</p>
                    </div>
                    <a 
                        href="{{ $data['events']['resepsi']['maps_link'] }}" 
                        target="_blank" 
                        class="inline-flex items-center justify-center gap-2 w-full py-3 rounded-2xl bg-[#294B3A] text-white text-xs font-bold shadow-md hover:bg-[#1E382A] transition"
                    >
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        <span>Petunjuk Lokasi Google Maps</span>
                    </a>
                </div>
            </section>

            <!-- SECTION: LOVE STORY TIMELINE -->
            <section id="sec-cerita" class="space-y-6">
                <div class="text-center space-y-1">
                    <span class="font-italiana text-xs uppercase tracking-[0.25em] text-[#3D6350] font-bold">Our Love Story</span>
                    <h3 class="font-italiana text-3xl font-bold text-[#183024]">Kisah Perjalanan</h3>
                    <p class="text-xs text-stone-500">Momen berharga dalam perjalanan cinta kami</p>
                </div>

                <div class="space-y-4">
                    @foreach ($data['stories'] as $story)
                        <div class="p-5 rounded-3xl glass-botanical space-y-2 text-left">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#3D6350]">{{ $story['year'] }}</span>
                            <h5 class="font-italiana text-lg font-bold text-[#183024]">{{ $story['title'] }}</h5>
                            <p class="text-xs text-[#406150] leading-relaxed">{{ $story['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- SECTION: GALERI PREWEDDING -->
            <section id="sec-galeri" class="space-y-6">
                <div class="text-center space-y-1">
                    <span class="font-italiana text-xs uppercase tracking-[0.25em] text-[#3D6350] font-bold">Gallery</span>
                    <h3 class="font-italiana text-3xl font-bold text-[#183024]">Galeri Bahagia</h3>
                    <p class="text-xs text-stone-500">Potret kebersamaan dan kenangan manis</p>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    @foreach ($data['galleries'] as $index => $photo)
                        <div 
                            @click="openLightbox('{{ $photo }}')" 
                            class="rounded-3xl overflow-hidden shadow-md cursor-pointer group relative bg-stone-200 aspect-square border border-white"
                        >
                            <img src="{{ $photo }}" alt="Gallery {{ $index + 1 }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-[#183024]/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white">
                                <i data-lucide="zoom-in" class="w-5 h-5"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- SECTION: DIGITAL ENVELOPE (AMPLOP DIGITAL) -->
            <section id="sec-amplop" class="space-y-6">
                <div class="text-center space-y-1">
                    <span class="font-italiana text-xs uppercase tracking-[0.25em] text-[#3D6350] font-bold">Wedding Gift</span>
                    <h3 class="font-italiana text-3xl font-bold text-[#183024]">Tanda Kasih &amp; Amplop</h3>
                    <p class="text-xs text-stone-500">Doa restu Anda adalah hadiah terindah. Bagi yang ingin memberikan tanda kasih secara digital:</p>
                </div>

                <div class="space-y-4">
                    @foreach ($data['bank_accounts'] as $acc)
                        <div class="p-6 rounded-3xl bg-gradient-to-br from-[#244234] to-[#162D23] text-white shadow-xl space-y-3 relative overflow-hidden">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider font-mono text-emerald-200">{{ $acc['bank'] }}</span>
                                <i data-lucide="credit-card" class="w-5 h-5 opacity-70"></i>
                            </div>
                            <div class="space-y-0.5">
                                <div class="font-mono text-xl font-bold tracking-wider text-amber-200">{{ $acc['account_number'] }}</div>
                                <div class="text-xs opacity-80">a.n. {{ $acc['account_name'] }}</div>
                            </div>
                            <button 
                                type="button"
                                @click="copyToClipboard('{{ str_replace(' ', '', $acc['account_number']) }}', 'Nomor Rekening {{ $acc['bank'] }}')"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white/20 hover:bg-white/30 backdrop-blur-md text-xs font-bold transition"
                            >
                                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                <span>Salin No. Rekening</span>
                            </button>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- SECTION: RSVP & GUESTBOOK -->
            <section id="sec-ucapan" class="space-y-6">
                <div class="text-center space-y-1">
                    <span class="font-italiana text-xs uppercase tracking-[0.25em] text-[#3D6350] font-bold">RSVP &amp; Guestbook</span>
                    <h3 class="font-italiana text-3xl font-bold text-[#183024]">Doa Restu &amp; Kehadiran</h3>
                    <p class="text-xs text-stone-500">Kirimkan konfirmasi kehadiran dan doa terbaik</p>
                </div>

                <!-- RSVP FORM CARD -->
                <div class="p-6 rounded-3xl glass-botanical space-y-4 text-left shadow-sm">
                    <form @submit.prevent="submitWish()" class="space-y-3.5 text-xs">
                        <div>
                            <label class="font-bold block mb-1 text-[#183024]">Nama Lengkap</label>
                            <input 
                                type="text" 
                                x-model="wishForm.name" 
                                required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-emerald-900/20 bg-white/80 text-stone-900 focus:outline-none focus:ring-2 focus:ring-emerald-600"
                            >
                        </div>

                        <div>
                            <label class="font-bold block mb-1 text-[#183024]">Konfirmasi Kehadiran</label>
                            <select 
                                x-model="wishForm.attendance"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-emerald-900/20 bg-white/80 text-stone-900 focus:outline-none focus:ring-2 focus:ring-emerald-600"
                            >
                                <option value="Hadir (1 Orang)">Hadir (1 Orang)</option>
                                <option value="Hadir (2 Orang)">Hadir (2 Orang)</option>
                                <option value="Masih Ragu">Masih Ragu</option>
                                <option value="Tidak Hadir">Mohon Maaf, Tidak Bisa Hadir</option>
                            </select>
                        </div>

                        <div>
                            <label class="font-bold block mb-1 text-[#183024]">Pesan &amp; Doa Restu</label>
                            <textarea 
                                x-model="wishForm.message" 
                                rows="3" 
                                required
                                placeholder="Tuliskan ucapan selamat &amp; doa restu Anda..." 
                                class="w-full px-3.5 py-2.5 rounded-xl border border-emerald-900/20 bg-white/80 text-stone-900 focus:outline-none focus:ring-2 focus:ring-emerald-600"
                            ></textarea>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full py-3 rounded-2xl bg-[#294B3A] text-white font-bold text-xs shadow-md transition hover:bg-[#1E382A] flex items-center justify-center gap-2"
                        >
                            <i data-lucide="send" class="w-4 h-4"></i>
                            <span>Kirim Konfirmasi &amp; Doa</span>
                        </button>
                    </form>
                </div>

                <!-- WISHES STREAM -->
                <div class="space-y-3 text-left">
                    <template x-for="(w, idx) in wishes" :key="idx">
                        <div class="p-4 rounded-2xl glass-botanical space-y-1.5">
                            <div class="flex items-center justify-between gap-2">
                                <span class="font-italiana font-bold text-sm text-[#183024]" x-text="w.name"></span>
                                <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-[#204030] text-[9px] font-semibold" x-text="w.attendance"></span>
                            </div>
                            <p class="text-xs text-[#406150] leading-relaxed italic" x-text="w.message"></p>
                            <span class="text-[10px] opacity-60 block text-right" x-text="w.time"></span>
                        </div>
                    </template>
                </div>
            </section>

            <!-- FOOTER SIGNATURE -->
            <footer class="text-center pt-8 border-t border-emerald-900/15 space-y-3 text-xs text-[#406150]">
                <p>Merupakan kehormatan dan kebahagiaan bagi kami atas kehadiran serta doa restu Anda.</p>
                <div class="font-italiana text-2xl font-bold text-[#183024]">
                    {{ $data['groom']['nickname'] }} &amp; {{ $data['bride']['nickname'] }}
                </div>
                <div class="pt-4 text-[10px] opacity-60">
                    Platform Undangan Digital oleh <a href="{{ route('home') }}" class="underline font-bold">KlikMomen.id</a> • Botanical Series
                </div>
            </footer>

        </div>

        <!-- ============================================================== -->
        <!-- 4. FLOATING BOTTOM DOCK NAVIGATION -->
        <!-- ============================================================== -->
        <nav 
            x-show="isOpened" 
            x-transition
            class="fixed bottom-4 inset-x-4 max-w-sm mx-auto z-40 bg-[#162D23]/90 backdrop-blur-md rounded-full border border-white/20 shadow-2xl p-1.5 flex items-center justify-around text-emerald-200/70 text-[10px]"
        >
            <a href="#sec-cover" class="p-2 hover:text-emerald-100 flex flex-col items-center gap-0.5">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Cover</span>
            </a>
            <a href="#sec-mempelai" class="p-2 hover:text-emerald-100 flex flex-col items-center gap-0.5">
                <i data-lucide="heart" class="w-4 h-4"></i>
                <span>Mempelai</span>
            </a>
            <a href="#sec-acara" class="p-2 hover:text-emerald-100 flex flex-col items-center gap-0.5">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                <span>Acara</span>
            </a>
            <a href="#sec-galeri" class="p-2 hover:text-emerald-100 flex flex-col items-center gap-0.5">
                <i data-lucide="image" class="w-4 h-4"></i>
                <span>Galeri</span>
            </a>
            <a href="#sec-amplop" class="p-2 hover:text-emerald-100 flex flex-col items-center gap-0.5">
                <i data-lucide="gift" class="w-4 h-4"></i>
                <span>Amplop</span>
            </a>
            <a href="#sec-ucapan" class="p-2 hover:text-emerald-100 flex flex-col items-center gap-0.5">
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
        function botanicalInvitationApp() {
            return {
                isOpened: false,
                isPlaying: false,
                audioEl: null,
                toast: { show: false, message: '' },
                lightbox: { open: false, imgUrl: '' },
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
                    this.showToast(label + ' berhasil disalin!');
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

                submitWish() {
                    if (!this.wishForm.message.trim()) return;
                    this.wishes.unshift({
                        name: this.wishForm.name,
                        attendance: this.wishForm.attendance,
                        message: this.wishForm.message,
                        time: 'Baru saja'
                    });
                    this.wishForm.message = '';
                    this.showToast('Terima kasih! Doa restu Anda telah terkirim.');
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
</body>
</html>
