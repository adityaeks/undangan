<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'KalaUndangan') }} - Studio Undangan Digital Minimalis & Elegan</title>

    <!-- Meta SEO -->
    <meta name="description" content="Platform penyedia website undangan digital pernikahan, khitanan, dan acara spesial dengan desain minimalis, stylist, RSVP real-time, amplop digital tanpa potongan, dan musik romantis.">
    <meta name="keywords" content="undangan digital, wedding invitation, undangan online, website pernikahan, undangan pernikahan aesthetic, rsvp online, amplop digital">

    <!-- Google Fonts: Plus Jakarta Sans & Playfair Display & Cormorant Garamond -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN (Ensures full styling with custom colors & utilities) -->
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

    <!-- Alpine.js for Interactive Widgets -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom CSS styles -->
    <style>
        .font-editorial { font-family: 'Cormorant Garamond', serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }

        .glass-panel {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(233, 223, 201, 0.5);
        }

        .glass-dark {
            background: rgba(24, 23, 21, 0.85);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .gold-gradient-bg {
            background: linear-gradient(135deg, #C2AA7D 0%, #E9DFC9 50%, #A68D5C 100%);
        }

        .gold-text-gradient {
            background: linear-gradient(135deg, #8A7245 0%, #C2AA7D 50%, #6C5834 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .soft-glow {
            box-shadow: 0 20px 40px -15px rgba(166, 141, 92, 0.18);
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(0.5deg); }
        }

        @keyframes float-reverse {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(10px) rotate(-0.5deg); }
        }

        @keyframes music-bar {
            0%, 100% { height: 4px; }
            50% { height: 16px; }
        }

        .animate-float-slow {
            animation: float-slow 5s ease-in-out infinite;
        }

        .animate-float-reverse {
            animation: float-reverse 6s ease-in-out infinite;
        }

        .bar-1 { animation: music-bar 0.9s ease-in-out infinite; }
        .bar-2 { animation: music-bar 1.2s ease-in-out infinite 0.2s; }
        .bar-3 { animation: music-bar 0.7s ease-in-out infinite 0.4s; }
        .bar-4 { animation: music-bar 1.1s ease-in-out infinite 0.1s; }
    </style>
</head>

<body class="bg-sand-50 text-charcoal-900 font-sans antialiased selection:bg-brand-200 selection:text-charcoal-950 overflow-x-hidden" x-data="{
    demoModalOpen: false,
    selectedTemplate: 'all',
    guestNameInput: 'Bpk. Budi Santoso & Partner',
    guestCount: 350,
    pricePerPrint: 12000,
    activeFaq: null,
    isPlayingMusic: true,
    mobileMenuOpen: false,
    previewTab: 'cover'
}">

    <!-- TOP PROMO TICKER -->
    <div class="bg-charcoal-950 text-brand-200 text-xs py-2 px-4 text-center font-medium tracking-wide border-b border-brand-800/30 flex items-center justify-center gap-2">
        <span class="inline-block w-2 h-2 rounded-full bg-brand-400 animate-ping"></span>
        <span>✨ <strong>Promo Spesial Bulan Ini:</strong> Dapatkan Diskon 30% Semua Tema Premium dengan Kupon <strong>MOMENINDAH</strong> ✨</span>
    </div>

    <!-- MAIN NAVBAR -->
    <header class="sticky top-0 z-40 w-full glass-panel border-b border-sand-200/80 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- BRAND LOGO -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-full bg-charcoal-900 text-brand-200 flex items-center justify-center font-serif text-xl font-bold shadow-md group-hover:scale-105 transition-transform duration-300 border border-brand-400/40">
                        K
                    </div>
                    <div class="flex flex-col">
                        <span class="font-serif text-2xl font-bold tracking-tight text-charcoal-950 flex items-center gap-1">
                            KalaUndangan<span class="text-brand-500">.</span>
                        </span>
                        <span class="text-[10px] tracking-[0.25em] uppercase text-sand-500 font-semibold -mt-1">
                            Digital Invitation Studio
                        </span>
                    </div>
                </a>

                <!-- DESKTOP NAVIGATION -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-charcoal-900/80">
                    <a href="#fitur" class="hover:text-brand-600 transition-colors duration-200">Fitur</a>
                    <a href="#tema" class="hover:text-brand-600 transition-colors duration-200">Galeri Tema</a>
                    <a href="{{ route('demo.index') }}" class="hover:text-brand-600 transition-colors duration-200 flex items-center gap-1 text-brand-600 font-semibold">
                        <span>Live Demo</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    </a>
                    <a href="#simulasi" class="hover:text-brand-600 transition-colors duration-200">Simulasi Tamu</a>
                    <a href="#kalkulator" class="hover:text-brand-600 transition-colors duration-200">Hemat Biaya</a>
                    <a href="#harga" class="hover:text-brand-600 transition-colors duration-200">Paket Harga</a>
                    <a href="#faq" class="hover:text-brand-600 transition-colors duration-200">FAQ</a>
                </nav>

                <!-- AUTH & CTA BUTTONS -->
                <div class="hidden sm:flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-full text-sm font-semibold bg-charcoal-900 text-brand-100 hover:bg-charcoal-800 transition-all duration-200 shadow-sm">
                                Dashboard Saya
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-charcoal-900 hover:text-brand-600 px-3 py-2 transition-colors">
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-full text-sm font-semibold bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white hover:shadow-lg hover:shadow-brand-500/20 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 flex items-center gap-2">
                                    <span>Buat Undangan</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            @endif
                        @endauth
                    @else
                        <a href="{{ route('demo.index') }}" class="px-5 py-2.5 rounded-full text-sm font-semibold bg-brand-500 text-white hover:bg-brand-600 transition-all shadow-sm">
                            Coba Demo Gratis
                        </a>
                    @endif
                </div>

                <!-- MOBILE MENU TOGGLE -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-charcoal-900 hover:text-brand-600 focus:outline-none" aria-label="Menu">
                    <i data-lucide="menu" class="w-6 h-6" x-show="!mobileMenuOpen"></i>
                    <i data-lucide="x" class="w-6 h-6" x-show="mobileMenuOpen"></i>
                </button>

            </div>
        </div>

        <!-- MOBILE MENU DRAWER -->
        <div x-show="mobileMenuOpen" x-transition.origin.top class="md:hidden bg-sand-50/95 backdrop-blur-lg border-b border-sand-200 px-6 py-5 space-y-4">
            <a href="{{ route('demo.index') }}" class="block text-base font-bold text-brand-600 py-1 flex items-center justify-between">
                <span>✨ Buka Live Demo (URL Khusus)</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
            <a href="#fitur" @click="mobileMenuOpen = false" class="block text-base font-medium text-charcoal-900 py-1">Fitur Lengkap</a>
            <a href="#tema" @click="mobileMenuOpen = false" class="block text-base font-medium text-charcoal-900 py-1">Koleksi Tema</a>
            <a href="#simulasi" @click="mobileMenuOpen = false" class="block text-base font-medium text-charcoal-900 py-1">Simulasi Tamu</a>
            <a href="#kalkulator" @click="mobileMenuOpen = false" class="block text-base font-medium text-charcoal-900 py-1">Kalkulator Penghematan</a>
            <a href="#harga" @click="mobileMenuOpen = false" class="block text-base font-medium text-charcoal-900 py-1">Paket & Harga</a>
            <a href="#faq" @click="mobileMenuOpen = false" class="block text-base font-medium text-charcoal-900 py-1">Tanya Jawab (FAQ)</a>
            <div class="pt-3 border-t border-sand-200 flex flex-col gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full text-center py-2.5 rounded-xl bg-charcoal-900 text-white font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="w-full text-center py-2.5 rounded-xl border border-sand-300 font-medium">Masuk ke Akun</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="w-full text-center py-2.5 rounded-xl bg-brand-500 text-white font-medium">Daftar & Buat Undangan</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="relative pt-12 pb-20 md:pt-20 md:pb-32 overflow-hidden">
        
        <!-- Ambient Decorative Blurs -->
        <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-gradient-to-tr from-brand-100/70 via-sand-200/40 to-brand-200/50 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-brand-300/20 rounded-full blur-2xl -z-10 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <!-- LEFT CONTENT -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    
                    <!-- BADGE -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/90 border border-brand-300/60 shadow-sm text-xs font-semibold tracking-wide text-brand-700">
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                        </span>
                        <span>#1 Platform Undangan Digital Paling Elegan & Stylist</span>
                    </div>

                    <!-- HERO HEADLINE -->
                    <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-extrabold text-charcoal-950 tracking-tight leading-[1.15]">
                        Rayakan Hari Bahagiamu dengan Undangan Digital yang 
                        <span class="italic font-editorial font-normal text-brand-600 block sm:inline">Penuh Makna & Berkesan.</span>
                    </h1>

                    <!-- SUBTITLE -->
                    <p class="text-base sm:text-lg text-charcoal-900/70 max-w-2xl mx-auto lg:mx-0 font-normal leading-relaxed">
                        Kirimkan kabar gembira kepada keluarga dan sahabat dengan sentuhan visual minimalis nan mewah. Dilengkapi fitur <strong>RSVP instan</strong>, <strong>Buku Tamu digital</strong>, <strong>Amplop online 0% potongan</strong>, dan alunan musik romantis.
                    </p>

                    <!-- ACTION BUTTONS -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-full bg-charcoal-950 text-brand-100 hover:bg-charcoal-800 font-semibold text-base shadow-xl shadow-charcoal-950/15 hover:shadow-2xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 flex items-center justify-center gap-3">
                                <span>Buat Undangan Sekarang</span>
                                <i data-lucide="sparkles" class="w-5 h-5 text-brand-400"></i>
                            </a>
                        @else
                            <a href="#harga" class="w-full sm:w-auto px-8 py-4 rounded-full bg-charcoal-950 text-brand-100 hover:bg-charcoal-800 font-semibold text-base shadow-xl flex items-center justify-center gap-3">
                                <span>Pilih Paket Undangan</span>
                                <i data-lucide="sparkles" class="w-5 h-5 text-brand-400"></i>
                            </a>
                        @endif

                        <a href="{{ route('demo.index') }}" class="w-full sm:w-auto px-7 py-4 rounded-full bg-white/90 hover:bg-white border border-sand-300/90 text-charcoal-900 font-semibold text-base hover:shadow-md transition-all duration-200 flex items-center justify-center gap-2 group">
                            <span class="w-8 h-8 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i data-lucide="play" class="w-4 h-4 fill-current ml-0.5"></i>
                            </span>
                            <span>Lihat Live Demo</span>
                        </a>
                    </div>

                    <!-- TRUST & SOCIAL PROOF -->
                    <div class="pt-6 border-t border-sand-200/80 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-sm text-sand-500 font-medium">
                        <div class="flex -space-x-2 overflow-hidden">
                            <img class="inline-block h-9 w-9 rounded-full ring-2 ring-white object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="User Avatar">
                            <img class="inline-block h-9 w-9 rounded-full ring-2 ring-white object-cover" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80" alt="User Avatar">
                            <img class="inline-block h-9 w-9 rounded-full ring-2 ring-white object-cover" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&auto=format&fit=crop&q=80" alt="User Avatar">
                            <img class="inline-block h-9 w-9 rounded-full ring-2 ring-white object-cover" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?w=100&auto=format&fit=crop&q=80" alt="User Avatar">
                        </div>
                        <div class="flex flex-col text-left">
                            <div class="flex items-center gap-1 text-amber-500 text-xs">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <span class="font-bold text-charcoal-900 ml-1">4.9 / 5.0</span>
                            </div>
                            <span class="text-xs text-charcoal-900/70">Dipercaya <strong>15.000+</strong> Calon Pengantin di Indonesia</span>
                        </div>
                    </div>

                </div>

                <!-- RIGHT INTERACTIVE PHONE MOCKUP -->
                <div class="lg:col-span-5 relative flex items-center justify-center">
                    
                    <!-- FLOATING NOTIFICATION BADGES -->
                    <!-- Top Floating Widget: Music Player -->
                    <div class="absolute -top-4 -left-4 sm:-left-8 z-30 glass-panel px-4 py-2.5 rounded-2xl shadow-xl border border-white/80 animate-float-slow hidden sm:flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-brand-500 text-white flex items-center justify-center">
                            <i data-lucide="music" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold text-charcoal-950">A Thousand Years</p>
                            <p class="text-[9px] text-sand-500">Christina Perri (Acoustic)</p>
                        </div>
                        <div class="flex items-end gap-0.5 h-4 ml-1">
                            <span class="w-1 bg-brand-500 rounded-full bar-1"></span>
                            <span class="w-1 bg-brand-500 rounded-full bar-2"></span>
                            <span class="w-1 bg-brand-500 rounded-full bar-3"></span>
                            <span class="w-1 bg-brand-500 rounded-full bar-4"></span>
                        </div>
                    </div>

                    <!-- Bottom Floating Widget: Amplop Digital -->
                    <div class="absolute -bottom-6 -right-4 sm:-right-6 z-30 glass-panel px-4 py-3 rounded-2xl shadow-2xl border border-white/80 animate-float-reverse hidden sm:flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-emerald-500/10 text-emerald-600 flex items-center justify-center border border-emerald-500/20">
                            <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-wider uppercase text-emerald-600">Amplop Digital Diterima</span>
                            <p class="text-xs font-bold text-charcoal-950">Rp 500.000 <span class="font-normal text-[10px] text-charcoal-900/60">• Nadya & Dimas</span></p>
                        </div>
                    </div>

                    <!-- Left Floating Widget: RSVP Counter -->
                    <div class="absolute top-1/2 -left-6 z-30 glass-panel px-3.5 py-2 rounded-xl shadow-lg border border-white/80 animate-float-slow hidden md:flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-xs font-semibold text-charcoal-900"><strong>412</strong> Tamu RSVP Hadir</span>
                    </div>

                    <!-- SMARTPHONE SHELL -->
                    <div class="relative w-[300px] sm:w-[320px] rounded-[42px] p-3 bg-charcoal-950 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.35)] ring-1 ring-white/20">
                        
                        <!-- Dynamic Island / Speaker -->
                        <div class="absolute top-6 left-1/2 -translate-x-1/2 w-28 h-5 bg-black rounded-full z-40 flex items-center justify-center gap-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-[#1a1a1a]"></div>
                            <div class="w-10 h-1 bg-[#1f1f1f] rounded-full"></div>
                        </div>

                        <!-- SCREEN CONTENT -->
                        <div class="relative rounded-[32px] overflow-hidden bg-sand-100 border border-charcoal-900/10 text-charcoal-900 aspect-[9/18.5] flex flex-col justify-between">
                            
                            <!-- Cover Background Image with Overlay -->
                            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80');">
                                <div class="absolute inset-0 bg-gradient-to-b from-charcoal-950/40 via-charcoal-950/20 to-sand-50"></div>
                            </div>

                            <!-- Screen Header -->
                            <div class="relative z-10 p-6 pt-10 text-center text-white space-y-1">
                                <span class="text-[10px] tracking-[0.25em] uppercase font-medium text-brand-200">The Wedding Of</span>
                                <h3 class="font-serif text-3xl font-bold tracking-tight">Raka & Arinda</h3>
                                <p class="text-xs font-light text-white/80">Sabtu, 24 Oktober 2026</p>
                            </div>

                            <!-- Floating Guest Card Inside Phone -->
                            <div class="relative z-10 m-4 p-4 rounded-2xl glass-panel shadow-lg border border-sand-200/80 text-center space-y-3">
                                <div>
                                    <span class="text-[10px] uppercase font-semibold text-sand-500 tracking-wider">Kepada Yth.</span>
                                    <p class="font-serif text-base font-bold text-charcoal-950" x-text="guestNameInput"></p>
                                    <span class="text-[9px] text-charcoal-900/60">Kami mengundang Anda untuk hadir di momen bahagia kami.</span>
                                </div>

                                <!-- Countdown Mini -->
                                <div class="grid grid-cols-4 gap-1 pt-1 border-t border-sand-200/60 text-charcoal-900">
                                    <div class="bg-sand-100/90 rounded-lg py-1">
                                        <div class="font-bold text-xs">28</div>
                                        <div class="text-[8px] text-sand-500">Hari</div>
                                    </div>
                                    <div class="bg-sand-100/90 rounded-lg py-1">
                                        <div class="font-bold text-xs">14</div>
                                        <div class="text-[8px] text-sand-500">Jam</div>
                                    </div>
                                    <div class="bg-sand-100/90 rounded-lg py-1">
                                        <div class="font-bold text-xs">45</div>
                                        <div class="text-[8px] text-sand-500">Mnt</div>
                                    </div>
                                    <div class="bg-sand-100/90 rounded-lg py-1">
                                        <div class="font-bold text-xs">12</div>
                                        <div class="text-[8px] text-sand-500">Dtk</div>
                                    </div>
                                </div>

                                <!-- Interactive Button Inside Screen -->
                                <a href="{{ route('demo.show', ['slug' => 'monochrome-elegance']) }}" class="w-full py-2 rounded-xl bg-charcoal-900 text-brand-100 text-xs font-semibold shadow-md flex items-center justify-center gap-1.5 hover:bg-charcoal-800 transition">
                                    <i data-lucide="mail-open" class="w-3.5 h-3.5"></i>
                                    <span>Buka Undangan</span>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- VALUE PROPOSITIONS STRIP -->
    <section class="py-8 bg-charcoal-950 text-brand-100 border-y border-brand-900/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                
                <div class="flex flex-col items-center justify-center p-3 space-y-1">
                    <div class="w-10 h-10 rounded-full bg-brand-900/40 text-brand-300 flex items-center justify-center mb-1">
                        <i data-lucide="zap" class="w-5 h-5"></i>
                    </div>
                    <span class="font-serif text-lg font-bold text-white">Selesai 5 Menit</span>
                    <span class="text-xs text-sand-400">Proses instan tanpa coding</span>
                </div>

                <div class="flex flex-col items-center justify-center p-3 space-y-1">
                    <div class="w-10 h-10 rounded-full bg-brand-900/40 text-brand-300 flex items-center justify-center mb-1">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                    <span class="font-serif text-lg font-bold text-white">Unlimited Tamu</span>
                    <span class="text-xs text-sand-400">Kirim ke ribuan kontak gratis</span>
                </div>

                <div class="flex flex-col items-center justify-center p-3 space-y-1">
                    <div class="w-10 h-10 rounded-full bg-brand-900/40 text-brand-300 flex items-center justify-center mb-1">
                        <i data-lucide="wallet" class="w-5 h-5"></i>
                    </div>
                    <span class="font-serif text-lg font-bold text-white">Amplop 0% Biaya</span>
                    <span class="text-xs text-sand-400">Dana langsung ke rekening Anda</span>
                </div>

                <div class="flex flex-col items-center justify-center p-3 space-y-1">
                    <div class="w-10 h-10 rounded-full bg-brand-900/40 text-brand-300 flex items-center justify-center mb-1">
                        <i data-lucide="smartphone" class="w-5 h-5"></i>
                    </div>
                    <span class="font-serif text-lg font-bold text-white">100% Responsif</span>
                    <span class="text-xs text-sand-400">Sempurna di Android & iPhone</span>
                </div>

            </div>
        </div>
    </section>

    <!-- LIVE GUEST NAME SIMULATOR SECTION -->
    <section id="simulasi" class="py-20 bg-sand-100/70 border-b border-sand-200/80">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
            
            <div class="space-y-3">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-600">Fitur Personalisasi Tamu</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal-950">
                    Coba Sensasi Menerima Undangan dengan Nama Khusus
                </h2>
                <p class="text-sm sm:text-base text-charcoal-900/70 max-w-xl mx-auto">
                    Setiap tamu akan merasa sangat dihargai saat membuka link dengan nama mereka yang tertulis rapi di sampul depan dan pesan WhatsApp.
                </p>
            </div>

            <!-- INTERACTIVE INPUT SIMULATOR -->
            <div class="p-6 sm:p-8 rounded-3xl glass-panel shadow-xl border border-white max-w-2xl mx-auto space-y-6">
                
                <div class="text-left space-y-2">
                    <label for="guest-name-field" class="block text-xs font-bold uppercase tracking-wider text-charcoal-900/80">
                        Ketik Nama Teman / Keluarga untuk Melihat Simulasi:
                    </label>
                    <div class="relative">
                        <input 
                            id="guest-name-field"
                            type="text" 
                            x-model="guestNameInput" 
                            placeholder="Contoh: Bpk. Bambang Pamungkas & Partner"
                            class="w-full px-5 py-3.5 rounded-2xl bg-white border border-sand-300 text-charcoal-950 font-medium focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all shadow-inner"
                        >
                        <div class="absolute right-3 top-1/2 -translate-y-1/2">
                            <span class="px-2.5 py-1 rounded-full bg-brand-100 text-brand-700 text-xs font-semibold">Live Preview</span>
                        </div>
                    </div>
                </div>

                <!-- SIMULATED WHATSAPP SHARE MESSAGE -->
                <div class="p-4 rounded-2xl bg-[#EFEAE2] border border-[#D5CDBC] text-left text-xs text-charcoal-900 space-y-2 font-sans">
                    <div class="flex items-center gap-2 text-[#075E54] font-bold pb-1 border-b border-[#D5CDBC]/60">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>Format Pesan WhatsApp Otomatis:</span>
                    </div>
                    <p class="leading-relaxed">
                        Kepada Yth. <strong class="text-charcoal-950" x-text="guestNameInput"></strong>,<br>
                        Tanpa mengurangi rasa hormat, kami bermaksud mengundang Anda untuk hadir di momen pernikahan kami.<br><br>
                        ✨ Buka undangan digital Anda melalui link berikut:<br>
                        <span class="text-blue-700 underline break-all font-mono">https://kalaundangan.id/raka-arinda?to=<span x-text="encodeURIComponent(guestNameInput)"></span></span><br><br>
                        Merupakan suatu kehormatan & kebahagiaan bagi kami apabila Anda berkenan hadir dan memberikan doa restu.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- TEMPLATE SHOWCASE / GALERI TEMA SECTION -->
    <section id="tema" class="py-24 bg-sand-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <!-- SECTION HEADER -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 text-center md:text-left">
                <div class="space-y-3">
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-600">Koleksi Desain Eksklusif</span>
                    <h2 class="font-serif text-3xl sm:text-5xl font-bold text-charcoal-950 tracking-tight">
                        Pilihan Tema Minimalis, Elegan & Stylist
                    </h2>
                    <p class="text-sm sm:text-base text-charcoal-900/70 max-w-xl">
                        Didesain secara presisi oleh desainer profesional untuk menciptakan kesan pertama yang tak terlupakan bagi para tamu undangan.
                    </p>
                </div>

                <!-- CATEGORY FILTER TABS -->
                <div class="flex flex-wrap items-center justify-center gap-2 bg-sand-200/70 p-1.5 rounded-full self-center md:self-auto text-xs font-semibold">
                    <button 
                        @click="selectedTemplate = 'all'" 
                        :class="selectedTemplate === 'all' ? 'bg-charcoal-950 text-white shadow-sm' : 'text-charcoal-900 hover:text-brand-700'"
                        class="px-4 py-2 rounded-full transition-all duration-200">
                        Semua Tema
                    </button>
                    <button 
                        @click="selectedTemplate = 'minimalist'" 
                        :class="selectedTemplate === 'minimalist' ? 'bg-charcoal-950 text-white shadow-sm' : 'text-charcoal-900 hover:text-brand-700'"
                        class="px-4 py-2 rounded-full transition-all duration-200">
                        Minimalist Editorial
                    </button>
                    <button 
                        @click="selectedTemplate = 'luxury'" 
                        :class="selectedTemplate === 'luxury' ? 'bg-charcoal-950 text-white shadow-sm' : 'text-charcoal-900 hover:text-brand-700'"
                        class="px-4 py-2 rounded-full transition-all duration-200">
                        Luxury Gold
                    </button>
                    <button 
                        @click="selectedTemplate = 'botanical'" 
                        :class="selectedTemplate === 'botanical' ? 'bg-charcoal-950 text-white shadow-sm' : 'text-charcoal-900 hover:text-brand-700'"
                        class="px-4 py-2 rounded-full transition-all duration-200">
                        Botanical & Rustic
                    </button>
                </div>
            </div>

            <!-- TEMPLATE CARDS GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- TEMPLATE 1 -->
                <div x-show="selectedTemplate === 'all' || selectedTemplate === 'minimalist'" x-transition class="group rounded-3xl overflow-hidden glass-panel border border-sand-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col">
                    <div class="relative aspect-[4/3] overflow-hidden bg-sand-200">
                        <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=700&auto=format&fit=crop&q=80" alt="Minimalist Monochrome" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-charcoal-950/80 backdrop-blur-md text-brand-200 text-[10px] font-bold uppercase tracking-wider">Terpopuler</span>
                        </div>
                        <div class="absolute inset-0 bg-charcoal-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                            <a href="{{ route('demo.index') }}" class="px-4 py-2 rounded-full bg-white text-charcoal-950 font-semibold text-xs shadow-lg hover:scale-105 transition flex items-center gap-1.5">
                                <i data-lucide="play" class="w-3 h-3 fill-current"></i>
                                <span>Live Preview</span>
                            </a>
                        </div>
                    </div>
                    <div class="p-6 space-y-3 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs text-sand-500 font-medium">
                                <span>Kategori: Minimalist Editorial</span>
                                <span class="text-amber-600 font-bold">★ 4.9 (1.2k)</span>
                            </div>
                            <h3 class="font-serif text-xl font-bold text-charcoal-950 group-hover:text-brand-600 transition-colors">The Monochrome Elegance</h3>
                            <p class="text-xs text-charcoal-900/60">Tipografi kontemporer bernuansa editorial majalah high-fashion dengan palet warna hitam putih abadi.</p>
                        </div>
                        <div class="pt-4 border-t border-sand-200 flex items-center justify-between">
                            <span class="text-sm font-bold text-charcoal-950">Gratis di Paket Gold</span>
                            <a href="{{ route('demo.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-800 flex items-center gap-1">
                                <span>Lihat Demo</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TEMPLATE 2 -->
                <div x-show="selectedTemplate === 'all' || selectedTemplate === 'botanical'" x-transition class="group rounded-3xl overflow-hidden glass-panel border border-sand-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col">
                    <div class="relative aspect-[4/3] overflow-hidden bg-sand-200">
                        <img src="https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=700&auto=format&fit=crop&q=80" alt="Sage Botanical" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-emerald-950/80 backdrop-blur-md text-emerald-200 text-[10px] font-bold uppercase tracking-wider">Natural Vibe</span>
                        </div>
                        <div class="absolute inset-0 bg-charcoal-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                            <a href="{{ route('demo.index') }}" class="px-4 py-2 rounded-full bg-white text-charcoal-950 font-semibold text-xs shadow-lg hover:scale-105 transition flex items-center gap-1.5">
                                <i data-lucide="play" class="w-3 h-3 fill-current"></i>
                                <span>Live Preview</span>
                            </a>
                        </div>
                    </div>
                    <div class="p-6 space-y-3 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs text-sand-500 font-medium">
                                <span>Kategori: Botanical & Rustic</span>
                                <span class="text-amber-600 font-bold">★ 4.95 (840)</span>
                            </div>
                            <h3 class="font-serif text-xl font-bold text-charcoal-950 group-hover:text-brand-600 transition-colors">Sage Olive & Earthy Wood</h3>
                            <p class="text-xs text-charcoal-900/60">Sentuhan dedaunan sage natural dengan aksen earthy tones yang menyejukkan mata dan hangat di hati.</p>
                        </div>
                        <div class="pt-4 border-t border-sand-200 flex items-center justify-between">
                            <span class="text-sm font-bold text-charcoal-950">Gratis di Paket Gold</span>
                            <a href="{{ route('demo.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-800 flex items-center gap-1">
                                <span>Lihat Demo</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TEMPLATE 3 -->
                <div x-show="selectedTemplate === 'all' || selectedTemplate === 'luxury'" x-transition class="group rounded-3xl overflow-hidden glass-panel border border-sand-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col">
                    <div class="relative aspect-[4/3] overflow-hidden bg-sand-200">
                        <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=700&auto=format&fit=crop&q=80" alt="Champagne Gold" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-amber-950/80 backdrop-blur-md text-amber-200 text-[10px] font-bold uppercase tracking-wider">Luxury Tier</span>
                        </div>
                        <div class="absolute inset-0 bg-charcoal-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                            <a href="{{ route('demo.index') }}" class="px-4 py-2 rounded-full bg-white text-charcoal-950 font-semibold text-xs shadow-lg hover:scale-105 transition flex items-center gap-1.5">
                                <i data-lucide="play" class="w-3 h-3 fill-current"></i>
                                <span>Live Preview</span>
                            </a>
                        </div>
                    </div>
                    <div class="p-6 space-y-3 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs text-sand-500 font-medium">
                                <span>Kategori: Luxury Royal</span>
                                <span class="text-amber-600 font-bold">★ 5.0 (980)</span>
                            </div>
                            <h3 class="font-serif text-xl font-bold text-charcoal-950 group-hover:text-brand-600 transition-colors">Royal Champagne & Navy</h3>
                            <p class="text-xs text-charcoal-900/60">Aksen foil emas berkilau berpadu latar biru midnight agung, memberikan aura kemegahan acara istimewa.</p>
                        </div>
                        <div class="pt-4 border-t border-sand-200 flex items-center justify-between">
                            <span class="text-sm font-bold text-charcoal-950">Gratis di Paket Gold</span>
                            <a href="{{ route('demo.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-800 flex items-center gap-1">
                                <span>Lihat Demo</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TEMPLATE 4 -->
                <div x-show="selectedTemplate === 'all' || selectedTemplate === 'minimalist'" x-transition class="group rounded-3xl overflow-hidden glass-panel border border-sand-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col">
                    <div class="relative aspect-[4/3] overflow-hidden bg-sand-200">
                        <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=700&auto=format&fit=crop&q=80" alt="Soft Blush Romance" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-rose-950/80 backdrop-blur-md text-rose-200 text-[10px] font-bold uppercase tracking-wider">Romance Sweet</span>
                        </div>
                        <div class="absolute inset-0 bg-charcoal-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                            <a href="{{ route('demo.index') }}" class="px-4 py-2 rounded-full bg-white text-charcoal-950 font-semibold text-xs shadow-lg hover:scale-105 transition flex items-center gap-1.5">
                                <i data-lucide="play" class="w-3 h-3 fill-current"></i>
                                <span>Live Preview</span>
                            </a>
                        </div>
                    </div>
                    <div class="p-6 space-y-3 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs text-sand-500 font-medium">
                                <span>Kategori: Minimalist Modern</span>
                                <span class="text-amber-600 font-bold">★ 4.9 (610)</span>
                            </div>
                            <h3 class="font-serif text-xl font-bold text-charcoal-950 group-hover:text-brand-600 transition-colors">Blush Silk & Watercolor</h3>
                            <p class="text-xs text-charcoal-900/60">Nuansa pastel pink lembut dengan tipografi kaligrafi modern yang sangat manis dan anggun.</p>
                        </div>
                        <div class="pt-4 border-t border-sand-200 flex items-center justify-between">
                            <span class="text-sm font-bold text-charcoal-950">Gratis di Paket Gold</span>
                            <a href="{{ route('demo.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-800 flex items-center gap-1">
                                <span>Lihat Demo</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TEMPLATE 5 -->
                <div x-show="selectedTemplate === 'all' || selectedTemplate === 'luxury'" x-transition class="group rounded-3xl overflow-hidden glass-panel border border-sand-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col">
                    <div class="relative aspect-[4/3] overflow-hidden bg-sand-200">
                        <img src="https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=700&auto=format&fit=crop&q=80" alt="Nusantara Modern" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-brand-950/80 backdrop-blur-md text-brand-200 text-[10px] font-bold uppercase tracking-wider">Tradisional Elegan</span>
                        </div>
                        <div class="absolute inset-0 bg-charcoal-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                            <a href="{{ route('demo.index') }}" class="px-4 py-2 rounded-full bg-white text-charcoal-950 font-semibold text-xs shadow-lg hover:scale-105 transition flex items-center gap-1.5">
                                <i data-lucide="play" class="w-3 h-3 fill-current"></i>
                                <span>Live Preview</span>
                            </a>
                        </div>
                    </div>
                    <div class="p-6 space-y-3 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs text-sand-500 font-medium">
                                <span>Kategori: Nusantara Adat</span>
                                <span class="text-amber-600 font-bold">★ 4.9 (450)</span>
                            </div>
                            <h3 class="font-serif text-xl font-bold text-charcoal-950 group-hover:text-brand-600 transition-colors">Nusantara Songket Heritage</h3>
                            <p class="text-xs text-charcoal-900/60">Harmoni motif ornamen budaya nusantara (Jawa, Sunda, Minang, Bali) dengan sentuhan minimalis modern.</p>
                        </div>
                        <div class="pt-4 border-t border-sand-200 flex items-center justify-between">
                            <span class="text-sm font-bold text-charcoal-950">Gratis di Paket Gold</span>
                            <a href="{{ route('demo.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-800 flex items-center gap-1">
                                <span>Lihat Demo</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TEMPLATE 6 -->
                <div x-show="selectedTemplate === 'all' || selectedTemplate === 'minimalist'" x-transition class="group rounded-3xl overflow-hidden glass-panel border border-sand-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col">
                    <div class="relative aspect-[4/3] overflow-hidden bg-sand-200">
                        <img src="https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=700&auto=format&fit=crop&q=80" alt="Midnight Starlight Dark Mode" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 rounded-full bg-slate-900/80 backdrop-blur-md text-purple-200 text-[10px] font-bold uppercase tracking-wider">Dark Mode Aesthetic</span>
                        </div>
                        <div class="absolute inset-0 bg-charcoal-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                            <a href="{{ route('demo.index') }}" class="px-4 py-2 rounded-full bg-white text-charcoal-950 font-semibold text-xs shadow-lg hover:scale-105 transition flex items-center gap-1.5">
                                <i data-lucide="play" class="w-3 h-3 fill-current"></i>
                                <span>Live Preview</span>
                            </a>
                        </div>
                    </div>
                    <div class="p-6 space-y-3 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs text-sand-500 font-medium">
                                <span>Kategori: Dark Mode Stylist</span>
                                <span class="text-amber-600 font-bold">★ 4.98 (730)</span>
                            </div>
                            <h3 class="font-serif text-xl font-bold text-charcoal-950 group-hover:text-brand-600 transition-colors">Midnight Starlight Studio</h3>
                            <p class="text-xs text-charcoal-900/60">Tampilan gelap yang memukau dengan aksen gemerlap bintang dan pencahayaan sinematik yang mempesona.</p>
                        </div>
                        <div class="pt-4 border-t border-sand-200 flex items-center justify-between">
                            <span class="text-sm font-bold text-charcoal-950">Gratis di Paket Gold</span>
                            <a href="{{ route('demo.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-800 flex items-center gap-1">
                                <span>Lihat Demo</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- VIEW ALL TEMPLATES BUTTON -->
            <div class="text-center pt-6">
                <a href="{{ route('demo.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-sand-200/90 hover:bg-sand-300 text-charcoal-950 font-semibold text-sm transition">
                    <span>Eksplorasi 50+ Desain Template Lainnya</span>
                    <i data-lucide="sparkles" class="w-4 h-4 text-brand-600"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- FITUR UNGGULAN (FEATURE MATRIX) -->
    <section id="fitur" class="py-24 bg-sand-100/50 border-y border-sand-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <!-- HEADER -->
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-600">Fitur Studio Terlengkap</span>
                <h2 class="font-serif text-3xl sm:text-5xl font-bold text-charcoal-950">
                    Segala Kemudahan untuk Acara Bahagiamu dalam Satu Genggaman
                </h2>
                <p class="text-sm sm:text-base text-charcoal-900/70">
                    Kami melengkapi setiap undangan dengan fitur modern tercanggih untuk memastikan kenyamanan Anda dan seluruh tamu undangan.
                </p>
            </div>

            <!-- GRID OF 8 FEATURES -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- FEATURE 1 -->
                <div class="p-6 rounded-3xl glass-panel border border-sand-200 hover:border-brand-300 hover:shadow-xl transition-all duration-300 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="user-check" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-charcoal-950">Nama Tamu Otomatis</h3>
                    <p class="text-xs text-charcoal-900/70 leading-relaxed">
                        Kustomisasi nama penerima tanpa batas secara instan dengan generator link WhatsApp 1-klik yang mudah.
                    </p>
                </div>

                <!-- FEATURE 2 -->
                <div class="p-6 rounded-3xl glass-panel border border-sand-200 hover:border-brand-300 hover:shadow-xl transition-all duration-300 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="wallet-cards" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-charcoal-950">Amplop & Kado Digital</h3>
                    <p class="text-xs text-charcoal-900/70 leading-relaxed">
                        Tamu dapat mengirim amplop via QRIS, Transfer Bank (BCA, Mandiri, BRI, BNI) langsung ke rekening tanpa potongan admin.
                    </p>
                </div>

                <!-- FEATURE 3 -->
                <div class="p-6 rounded-3xl glass-panel border border-sand-200 hover:border-brand-300 hover:shadow-xl transition-all duration-300 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="message-square-heart" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-charcoal-950">RSVP & Doa Restu Real-time</h3>
                    <p class="text-xs text-charcoal-900/70 leading-relaxed">
                        Rekap data kehadiran tamu secara real-time langsung ke dashboard, lengkap dengan ucapan doa manis dari kerabat.
                    </p>
                </div>

                <!-- FEATURE 4 -->
                <div class="p-6 rounded-3xl glass-panel border border-sand-200 hover:border-brand-300 hover:shadow-xl transition-all duration-300 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="music-4" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-charcoal-950">Background Musik Pilihan</h3>
                    <p class="text-xs text-charcoal-900/70 leading-relaxed">
                        Pilih dari ratusan lagu romantis terpopuler atau unggah lagu kenangan spesial pasangan Anda dengan autoplay mulus.
                    </p>
                </div>

                <!-- FEATURE 5 -->
                <div class="p-6 rounded-3xl glass-panel border border-sand-200 hover:border-brand-300 hover:shadow-xl transition-all duration-300 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="map-pin" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-charcoal-950">Petunjuk Arah Google Maps</h3>
                    <p class="text-xs text-charcoal-900/70 leading-relaxed">
                        Navigasi 1-klik membuka Google Maps / Waze langsung menuju lokasi akad dan resepsi agar tamu tidak tersesat.
                    </p>
                </div>

                <!-- FEATURE 6 -->
                <div class="p-6 rounded-3xl glass-panel border border-sand-200 hover:border-brand-300 hover:shadow-xl transition-all duration-300 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="image" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-charcoal-950">Galeri Foto & Video Prewedding</h3>
                    <p class="text-xs text-charcoal-900/70 leading-relaxed">
                        Tampilkan album foto beresolusi tinggi dan video cinematic prewedding dengan slider elegan dan fullscreen lightbox.
                    </p>
                </div>

                <!-- FEATURE 7 -->
                <div class="p-6 rounded-3xl glass-panel border border-sand-200 hover:border-brand-300 hover:shadow-xl transition-all duration-300 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="heart-handshake" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-charcoal-950">Love Story Timeline</h3>
                    <p class="text-xs text-charcoal-900/70 leading-relaxed">
                        Bagikan cerita perjalanan cinta yang mengharukan mulai dari pandangan pertama, komitmen, hingga pelaminan.
                    </p>
                </div>

                <!-- FEATURE 8 -->
                <div class="p-6 rounded-3xl glass-panel border border-sand-200 hover:border-brand-300 hover:shadow-xl transition-all duration-300 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-charcoal-950">Proteksi Privasi & Password</h3>
                    <p class="text-xs text-charcoal-900/70 leading-relaxed">
                        Lindungi privasi acara privat Anda dengan fitur kode sandi khusus yang hanya diketahui oleh tamu terundang.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- SAVINGS CALCULATOR (HEMAT BIAYA CETAK VS DIGITAL) -->
    <section id="kalkulator" class="py-24 bg-sand-50 relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <div class="text-center space-y-3">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-600">Simulasi Penghematan Anggaran</span>
                <h2 class="font-serif text-3xl sm:text-5xl font-bold text-charcoal-950">
                    Bandingkan Biaya Undangan Fisik vs Digital
                </h2>
                <p class="text-sm sm:text-base text-charcoal-900/70 max-w-xl mx-auto">
                    Ketahui berapa juta rupiah yang bisa Anda hemat dan alihkan untuk tabungan bulan madu atau kebutuhan rumah tangga baru.
                </p>
            </div>

            <!-- INTERACTIVE CALCULATOR CARD -->
            <div class="p-8 sm:p-12 rounded-[36px] glass-panel border border-sand-200 shadow-2xl space-y-10">
                
                <!-- SLIDER CONTROL -->
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <label for="guest-range-slider" class="text-sm font-bold uppercase tracking-wider text-charcoal-950">
                            Perkiraan Jumlah Undangan Tamu:
                        </label>
                        <span class="text-2xl font-serif font-bold text-brand-600 bg-brand-100 px-4 py-1 rounded-full self-start sm:self-auto">
                            <span x-text="guestCount"></span> Undangan
                        </span>
                    </div>

                    <input 
                        id="guest-range-slider"
                        type="range" 
                        min="50" 
                        max="1000" 
                        step="25" 
                        x-model="guestCount" 
                        class="w-full h-3 bg-sand-200 rounded-lg appearance-none cursor-pointer accent-brand-600"
                    >
                    
                    <div class="flex justify-between text-xs text-sand-500 font-semibold">
                        <span>50 Undangan</span>
                        <span>500 Undangan</span>
                        <span>1.000 Undangan</span>
                    </div>
                </div>

                <!-- COMPARISON COLUMNS -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
                    
                    <!-- COLUMN 1: CETAK FISIK -->
                    <div class="p-6 rounded-2xl bg-rose-50/70 border border-rose-200/80 space-y-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-rose-700">Undangan Cetak Fisik</span>
                        <div class="font-serif text-2xl sm:text-3xl font-extrabold text-charcoal-950">
                            Rp <span x-text="(guestCount * pricePerPrint).toLocaleString('id-ID')"></span>
                        </div>
                        <ul class="text-xs text-charcoal-900/70 space-y-1.5 pt-2 border-t border-rose-200/60">
                            <li>• Biaya cetak ~Rp 12.000 / pcs</li>
                            <li>• Ongkos kirim / bensin antar fisik</li>
                            <li>• Risiko salah cetak / revisi mahal</li>
                            <li>• Menghabiskan banyak kertas</li>
                        </ul>
                    </div>

                    <!-- COLUMN 2: DIGITAL KALAUNDANGAN -->
                    <div class="p-6 rounded-2xl bg-emerald-50/70 border border-emerald-200/80 space-y-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-700">Undangan Digital KalaUndangan</span>
                        <div class="font-serif text-2xl sm:text-3xl font-extrabold text-emerald-700">
                            Rp 99.000
                        </div>
                        <ul class="text-xs text-charcoal-900/70 space-y-1.5 pt-2 border-t border-emerald-200/60">
                            <li>• <strong>Sekali bayar</strong> untuk seumur hidup acara</li>
                            <li>• Unlimited tamu (bebas kirim sepuasnya)</li>
                            <li>• Revisi instan tanpa biaya tambahan</li>
                            <li>• 100% Ramah lingkungan (Zero Waste 🌿)</li>
                        </ul>
                    </div>

                    <!-- COLUMN 3: TOTAL SAVINGS -->
                    <div class="p-6 rounded-2xl bg-charcoal-950 text-brand-100 space-y-3 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-brand-400">Total Uang Yang Anda Hemat</span>
                            <div class="font-serif text-3xl font-extrabold text-white pt-1">
                                Rp <span x-text="((guestCount * pricePerPrint) - 99000).toLocaleString('id-ID')"></span>
                            </div>
                            <p class="text-xs text-sand-400 pt-2">
                                Anda menghemat hingga <strong class="text-brand-300">98%</strong> anggaran pengeluaran undangan!
                            </p>
                        </div>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="w-full py-2.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white text-xs font-bold text-center transition">
                                Ambil Hemat Sekarang
                            </a>
                        @endif
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- CARA KERJA (HOW IT WORKS) -->
    <section class="py-24 bg-sand-100/60 border-b border-sand-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-600">Langkah Mudah & Praktis</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal-950">
                    Hanya 3 Langkah Menuju Undangan Sempurna
                </h2>
                <p class="text-sm text-charcoal-900/70">
                    Tidak perlu keahlian desain atau teknis. Siapapun bisa membuat undangan menawan dalam hitungan menit.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                
                <!-- STEP 1 -->
                <div class="p-8 rounded-3xl glass-panel border border-sand-200 text-center space-y-4 relative">
                    <div class="w-14 h-14 rounded-full bg-charcoal-950 text-brand-200 font-serif text-2xl font-bold flex items-center justify-center mx-auto shadow-md">
                        1
                    </div>
                    <h3 class="font-serif text-xl font-bold text-charcoal-950">Pilih Desain Favorit</h3>
                    <p class="text-xs text-charcoal-900/70 leading-relaxed">
                        Jelajahi puluhan tema minimalis yang tersedia. Anda bebas memilih warna tema dan gaya tipografi yang sesuai selera.
                    </p>
                </div>

                <!-- STEP 2 -->
                <div class="p-8 rounded-3xl glass-panel border border-sand-200 text-center space-y-4 relative">
                    <div class="w-14 h-14 rounded-full bg-charcoal-950 text-brand-200 font-serif text-2xl font-bold flex items-center justify-center mx-auto shadow-md">
                        2
                    </div>
                    <h3 class="font-serif text-xl font-bold text-charcoal-950">Isi Data & Cerita</h3>
                    <p class="text-xs text-charcoal-900/70 leading-relaxed">
                        Masukkan nama mempelai, tanggal & lokasi acara, nomor rekening amplop, serta galeri foto dan lagu kesukaan.
                    </p>
                </div>

                <!-- STEP 3 -->
                <div class="p-8 rounded-3xl glass-panel border border-sand-200 text-center space-y-4 relative">
                    <div class="w-14 h-14 rounded-full bg-charcoal-950 text-brand-200 font-serif text-2xl font-bold flex items-center justify-center mx-auto shadow-md">
                        3
                    </div>
                    <h3 class="font-serif text-xl font-bold text-charcoal-950">Sebarkan 1-Klik</h3>
                    <p class="text-xs text-charcoal-900/70 leading-relaxed">
                        Undangan siap dibagikan ke seluruh daftar kontak tamu Anda di WhatsApp secara otomatis dan personal.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- PAKET & HARGA (PRICING TIERS) -->
    <section id="harga" class="py-24 bg-sand-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-600">Investasi Hemat Sekali Bayar</span>
                <h2 class="font-serif text-3xl sm:text-5xl font-bold text-charcoal-950">
                    Pilihan Paket Undangan Terbaik
                </h2>
                <p class="text-sm sm:text-base text-charcoal-900/70">
                    Tidak ada biaya bulanan atau biaya per tamu tersembunyi. Sekali bayar aktif selamanya.
                </p>
            </div>

            <!-- PRICING CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                
                <!-- TIER 1: BASIC -->
                <div class="p-8 rounded-3xl glass-panel border border-sand-200 flex flex-col justify-between space-y-6 hover:shadow-xl transition-all duration-300">
                    <div class="space-y-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Paket Hemat</span>
                        <h3 class="font-serif text-2xl font-bold text-charcoal-950">Silver Basic</h3>
                        <p class="text-xs text-charcoal-900/70">Pilihan tepat untuk acara sederhana atau syukuran privat.</p>
                        
                        <div class="pt-2">
                            <span class="text-xs text-sand-500 line-through">Rp 89.000</span>
                            <div class="font-serif text-3xl sm:text-4xl font-extrabold text-charcoal-950">
                                Rp 49.000
                                <span class="text-xs font-sans font-normal text-sand-500">/ acara</span>
                            </div>
                        </div>

                        <ul class="space-y-3 pt-4 border-t border-sand-200 text-xs text-charcoal-900/80">
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-600"></i>
                                <span>Pilihan 10 Template Basic</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-600"></i>
                                <span>Masa Aktif 6 Bulan</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-600"></i>
                                <span>Custom Nama Tamu (Maks 100)</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-600"></i>
                                <span>Petunjuk Peta Google Maps</span>
                            </li>
                            <li class="flex items-center gap-2.5 text-sand-400">
                                <i data-lucide="x" class="w-4 h-4"></i>
                                <span>Amplop Digital & QRIS</span>
                            </li>
                            <li class="flex items-center gap-2.5 text-sand-400">
                                <i data-lucide="x" class="w-4 h-4"></i>
                                <span>Galeri Video Prewedding</span>
                            </li>
                        </ul>
                    </div>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full py-3.5 rounded-full border border-sand-300 font-semibold text-xs text-center text-charcoal-950 hover:bg-charcoal-950 hover:text-white transition">
                            Pilih Paket Silver
                        </a>
                    @endif
                </div>

                <!-- TIER 2: GOLD (RECOMMENDED) -->
                <div class="p-8 rounded-3xl bg-charcoal-950 text-brand-100 flex flex-col justify-between space-y-6 shadow-2xl relative ring-2 ring-brand-500/80 scale-105 z-10">
                    
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-brand-600 to-brand-400 text-white text-[11px] font-bold uppercase tracking-wider shadow-md">
                        🌟 Paling Populer (Best Value)
                    </div>

                    <div class="space-y-4 pt-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-brand-400">Paket Favorit Pengantin</span>
                        <h3 class="font-serif text-2xl font-bold text-white">Gold Premium</h3>
                        <p class="text-xs text-sand-400">Fitur lengkap tanpa batasan untuk acara pernikahan impian Anda.</p>
                        
                        <div class="pt-2">
                            <span class="text-xs text-sand-500 line-through">Rp 169.000</span>
                            <div class="font-serif text-3xl sm:text-4xl font-extrabold text-white">
                                Rp 99.000
                                <span class="text-xs font-sans font-normal text-sand-400">/ acara</span>
                            </div>
                        </div>

                        <ul class="space-y-3 pt-4 border-t border-brand-900/50 text-xs text-sand-200">
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-400"></i>
                                <span>Akses <strong>Semua 50+ Template</strong></span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-400"></i>
                                <span><strong>Unlimited</strong> Tamu Undangan</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-400"></i>
                                <span>Masa Aktif <strong>Selamanya (Lifetime)</strong></span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-400"></i>
                                <span>Amplop Digital & QRIS Otomatis</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-400"></i>
                                <span>Background Musik Romantis Bebas Pilih</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-400"></i>
                                <span>Buku Tamu & RSVP Real-time</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-400"></i>
                                <span>Galeri 15 Foto & Video YouTube</span>
                            </li>
                        </ul>
                    </div>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full py-4 rounded-full bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs text-center shadow-lg hover:shadow-brand-500/30 hover:scale-[1.02] transition">
                            Buat Undangan Gold Sekarang
                        </a>
                    @endif
                </div>

                <!-- TIER 3: PLATINUM -->
                <div class="p-8 rounded-3xl glass-panel border border-sand-200 flex flex-col justify-between space-y-6 hover:shadow-xl transition-all duration-300">
                    <div class="space-y-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Paket VIP Eksklusif</span>
                        <h3 class="font-serif text-2xl font-bold text-charcoal-950">Platinum Royal</h3>
                        <p class="text-xs text-charcoal-900/70">Layanan premium dengan custom domain dan WhatsApp helper.</p>
                        
                        <div class="pt-2">
                            <span class="text-xs text-sand-500 line-through">Rp 249.000</span>
                            <div class="font-serif text-3xl sm:text-4xl font-extrabold text-charcoal-950">
                                Rp 149.000
                                <span class="text-xs font-sans font-normal text-sand-500">/ acara</span>
                            </div>
                        </div>

                        <ul class="space-y-3 pt-4 border-t border-sand-200 text-xs text-charcoal-900/80">
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-600"></i>
                                <span>Semua Fitur Paket Gold</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-600"></i>
                                <span><strong>Custom Subdomain</strong> Khusus</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-600"></i>
                                <span>QR Code Check-in Tamu Resepsi</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-600"></i>
                                <span>WhatsApp Blaster Generator</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-600"></i>
                                <span>Bantuan Input Data oleh Admin 24/7</span>
                            </li>
                        </ul>
                    </div>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full py-3.5 rounded-full border border-sand-300 font-semibold text-xs text-center text-charcoal-950 hover:bg-charcoal-950 hover:text-white transition">
                            Pilih Paket Platinum
                        </a>
                    @endif
                </div>

            </div>

        </div>
    </section>

    <!-- TESTIMONIALS (KISAH NYATA PASANGAN) -->
    <section class="py-24 bg-sand-100/50 border-y border-sand-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-600">Ulasan Nyata Pasangan</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal-950">
                    Cerita Bahagia dari Mereka yang Telah Menggunakan KalaUndangan
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- TESTIMONIAL 1 -->
                <div class="p-8 rounded-3xl glass-panel border border-sand-200 space-y-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex text-amber-500 gap-1 text-xs">
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        </div>
                        <p class="text-xs text-charcoal-900/80 italic leading-relaxed">
                            "Desainnya bener-bener minimalis dan berkelas banget! Tamu-tamu banyak yang muji undangannya kayak majalah fashion. Fitur amplop digitalnya juga ngebantu banget langsung masuk ke rekening tanpa potongan sama sekali."
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-sand-200">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Alika & Farhan" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h4 class="font-serif text-sm font-bold text-charcoal-950">Alika & Farhan</h4>
                            <span class="text-[10px] text-sand-500">Menikah di Jakarta • Oktober 2025</span>
                        </div>
                    </div>
                </div>

                <!-- TESTIMONIAL 2 -->
                <div class="p-8 rounded-3xl glass-panel border border-sand-200 space-y-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex text-amber-500 gap-1 text-xs">
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        </div>
                        <p class="text-xs text-charcoal-900/80 italic leading-relaxed">
                            "Hemat anggaran pernikahan hampir 8 juta dibanding cetak undangan fisik! Nyebarin ke 600 tamu cuma butuh 15 menit via WhatsApp. Sangat direkomendasikan buat pasangan muda zaman now."
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-sand-200">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80" alt="Bram & Gita" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h4 class="font-serif text-sm font-bold text-charcoal-950">Bram & Gita</h4>
                            <span class="text-[10px] text-sand-500">Menikah di Bandung • Januari 2026</span>
                        </div>
                    </div>
                </div>

                <!-- TESTIMONIAL 3 -->
                <div class="p-8 rounded-3xl glass-panel border border-sand-200 space-y-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex text-amber-500 gap-1 text-xs">
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        </div>
                        <p class="text-xs text-charcoal-900/80 italic leading-relaxed">
                            "Fitur RSVP real-time nya ngebantu tim catering kami memperkirakan porsi makanan dengan akurat banget. Gak ada makanan yang mubazir! Admin CS-nya juga super ramah dan fast response."
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-sand-200">
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&auto=format&fit=crop&q=80" alt="Dion & Clara" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h4 class="font-serif text-sm font-bold text-charcoal-950">Dion & Clara</h4>
                            <span class="text-[10px] text-sand-500">Menikah di Surabaya • Februari 2026</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- FAQ SECTION (ACCORDION) -->
    <section id="faq" class="py-24 bg-sand-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <div class="text-center space-y-3">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-600">Pusat Informasi</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal-950">
                    Pertanyaan yang Sering Diajukan
                </h2>
                <p class="text-sm text-charcoal-900/70">
                    Punya pertanyaan seputar layanan KalaUndangan? Temukan jawabannya di bawah ini.
                </p>
            </div>

            <div class="space-y-4">
                
                <!-- FAQ 1 -->
                <div class="rounded-2xl glass-panel border border-sand-200 overflow-hidden">
                    <button 
                        @click="activeFaq = (activeFaq === 1 ? null : 1)"
                        class="w-full px-6 py-4 text-left font-serif font-bold text-base text-charcoal-950 flex items-center justify-between gap-4">
                        <span>Berapa lama proses pembuatan undangan digital?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300" :class="activeFaq === 1 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 1" x-transition class="px-6 pb-5 text-xs text-charcoal-900/70 leading-relaxed border-t border-sand-200/60 pt-3">
                        Proses pembuatan bersifat otomatis dan instan! Anda hanya perlu memilih template, mengisi data acara dan foto, dan undangan Anda langsung aktif dan siap disebarkan dalam 5 hingga 10 menit saja.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="rounded-2xl glass-panel border border-sand-200 overflow-hidden">
                    <button 
                        @click="activeFaq = (activeFaq === 2 ? null : 2)"
                        class="w-full px-6 py-4 text-left font-serif font-bold text-base text-charcoal-950 flex items-center justify-between gap-4">
                        <span>Apakah data atau foto masih bisa diedit setelah undangan disebarkan?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300" :class="activeFaq === 2 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 2" x-transition class="px-6 pb-5 text-xs text-charcoal-900/70 leading-relaxed border-t border-sand-200/60 pt-3">
                        Tentu saja! Anda memiliki akses dashboard penuh untuk memperbarui waktu acara, lokasi, foto galeri, nomor rekening, atau musik kapan saja tanpa mengubah link undangan yang telah Anda kirimkan.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="rounded-2xl glass-panel border border-sand-200 overflow-hidden">
                    <button 
                        @click="activeFaq = (activeFaq === 3 ? null : 3)"
                        class="w-full px-6 py-4 text-left font-serif font-bold text-base text-charcoal-950 flex items-center justify-between gap-4">
                        <span>Bagaimana sistem amplop digital dan QRIS bekerja?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300" :class="activeFaq === 3 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 3" x-transition class="px-6 pb-5 text-xs text-charcoal-900/70 leading-relaxed border-t border-sand-200/60 pt-3">
                        Kami tidak memotong sepeserpun dari amplop yang Anda terima (0% Fee). Tamu akan langsung mentransfer dana ke nomor rekening bank atau scan QRIS pribadi Anda. Tombol salin nomor rekening otomatis juga memudahkan tamu agar tidak salah transfer.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="rounded-2xl glass-panel border border-sand-200 overflow-hidden">
                    <button 
                        @click="activeFaq = (activeFaq === 4 ? null : 4)"
                        class="w-full px-6 py-4 text-left font-serif font-bold text-base text-charcoal-950 flex items-center justify-between gap-4">
                        <span>Apakah tamu undangan perlu mengunduh / menginstal aplikasi khusus?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300" :class="activeFaq === 4 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 4" x-transition class="px-6 pb-5 text-xs text-charcoal-900/70 leading-relaxed border-t border-sand-200/60 pt-3">
                        Tidak perlu sama sekali! Tamu cukup mengklik tautan (link) yang Anda bagikan di WhatsApp, Instagram, atau SMS. Undangan akan terbuka dengan mulus dan cepat di browser smartphone apapun (Chrome, Safari, dsb).
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- FINAL CALL TO ACTION (CTA BANNER) -->
    <section class="py-20 bg-charcoal-950 text-white relative overflow-hidden">
        
        <!-- Ambient Decorative Glows -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-gradient-to-r from-brand-700/20 via-brand-500/20 to-brand-300/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-8">
            
            <div class="w-14 h-14 rounded-full bg-brand-500/20 text-brand-400 border border-brand-500/40 flex items-center justify-center mx-auto mb-2 animate-bounce">
                <i data-lucide="heart" class="w-6 h-6 fill-current"></i>
            </div>

            <div class="space-y-4 max-w-2xl mx-auto">
                <h2 class="font-serif text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                    Mulai Bagikan Kebahagiaan Pernikahan Impian Anda Hari Ini
                </h2>
                <p class="text-sm sm:text-base text-sand-300 leading-relaxed">
                    Bergabunglah bersama belasan ribu pasangan bahagia yang telah mempercayakan momen istimewa mereka kepada KalaUndangan.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-4 rounded-full bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-base shadow-xl hover:shadow-brand-500/30 hover:scale-105 active:scale-95 transition-all flex items-center justify-center gap-3">
                        <span>Buat Undangan Saya Sekarang</span>
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                @endif
                <button @click="demoModalOpen = true" class="w-full sm:w-auto px-8 py-4 rounded-full bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold text-base backdrop-blur-md transition">
                    Coba Demo Undangan
                </button>
            </div>

            <p class="text-xs text-sand-400 font-medium">
                ⚡ Tidak ada kartu kredit diperlukan • Garansi kepuasan 100%
            </p>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-charcoal-900 text-sand-400 text-xs py-16 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-white/10">
                
                <!-- BRAND BIO -->
                <div class="space-y-4 md:col-span-1">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-charcoal-950 text-brand-300 flex items-center justify-center font-serif font-bold border border-brand-400/40">
                            K
                        </div>
                        <span class="font-serif text-xl font-bold text-white">KalaUndangan.</span>
                    </div>
                    <p class="text-xs text-sand-400 leading-relaxed">
                        Studio undangan digital pernikahan & acara istimewa dengan estetika minimalis, teknologi modern, dan layanan sepenuh hati.
                    </p>
                    <div class="flex items-center gap-3 text-sand-300 pt-2">
                        <a href="#" class="w-8 h-8 rounded-full bg-white/5 hover:bg-brand-500 hover:text-white flex items-center justify-center transition"><i data-lucide="instagram" class="w-4 h-4"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-white/5 hover:bg-brand-500 hover:text-white flex items-center justify-center transition"><i data-lucide="facebook" class="w-4 h-4"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-white/5 hover:bg-brand-500 hover:text-white flex items-center justify-center transition"><i data-lucide="youtube" class="w-4 h-4"></i></a>
                    </div>
                </div>

                <!-- NAVIGATION -->
                <div class="space-y-3">
                    <h5 class="font-serif text-sm font-bold text-white">Navigasi Cepat</h5>
                    <ul class="space-y-2">
                        <li><a href="#fitur" class="hover:text-brand-400 transition">Fitur Utama</a></li>
                        <li><a href="#tema" class="hover:text-brand-400 transition">Koleksi Desain</a></li>
                        <li><a href="#simulasi" class="hover:text-brand-400 transition">Simulasi Tamu</a></li>
                        <li><a href="#kalkulator" class="hover:text-brand-400 transition">Kalkulator Hemat</a></li>
                        <li><a href="#harga" class="hover:text-brand-400 transition">Paket & Harga</a></li>
                    </ul>
                </div>

                <!-- CATEGORIES -->
                <div class="space-y-3">
                    <h5 class="font-serif text-sm font-bold text-white">Kategori Undangan</h5>
                    <ul class="space-y-2">
                        <li><a href="#tema" class="hover:text-brand-400 transition">Undangan Pernikahan (Wedding)</a></li>
                        <li><a href="#tema" class="hover:text-brand-400 transition">Undangan Khitanan / Sunatan</a></li>
                        <li><a href="#tema" class="hover:text-brand-400 transition">Ulang Tahun & Sweet Seventeen</a></li>
                        <li><a href="#tema" class="hover:text-brand-400 transition">Syukuran & Lamaran (Engagement)</a></li>
                    </ul>
                </div>

                <!-- SUPPORT & CONTACT -->
                <div class="space-y-3">
                    <h5 class="font-serif text-sm font-bold text-white">Hubungi Kami</h5>
                    <p class="leading-relaxed">
                        Punya pertanyaan khusus atau ingin custom template sesuai tema pernikahan Anda?
                    </p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600/20 text-emerald-400 border border-emerald-500/30 hover:bg-emerald-600 hover:text-white transition font-medium text-xs">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>WhatsApp Customer Care</span>
                    </a>
                </div>

            </div>

            <!-- COPYRIGHT & CREDITS -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left text-[11px] text-sand-500">
                <p>&copy; 2026 KalaUndangan Studio. Hak Cipta Dilindungi Undang-Undang.</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-sand-300">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-sand-300">Kebijakan Privasi</a>
                </div>
            </div>

        </div>
    </footer>

    <!-- INITIALIZE LUCIDE ICONS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
