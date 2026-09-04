<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Pernikahan Raka & Arinda — KlikMomen</title>

    <!-- Meta SEO & Social Sharing Preview -->
    <meta name="description" content="Undangan Pernikahan Raka & Arinda. Sabtu, 24 Oktober 2026. Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir.">
    <meta property="og:title" content="The Wedding of Raka & Arinda">
    <meta property="og:description" content="Sabtu, 24 Oktober 2026 — Jakarta">
    <meta property="og:image" content="https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&auto=format&fit=crop&q=85">

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
        days: 28,
        hours: 14,
        minutes: 42,
        seconds: 18,

        // RSVP
        rsvpName: '{{ $guestName ?? 'Tamu Terhormat' }}',
        rsvpGuests: '1',
        rsvpStatus: 'hadir',
        rsvpMessage: '',
        rsvpSubmitted: false,
        wishes: [
            { name: 'Sarah Amanda, S.Kom', time: '2 jam yang lalu', status: 'hadir', msg: 'Selamat berbahagia Raka & Arinda! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah selamanya. Aamiin.' },
            { name: 'Dimas Wicaksono', time: '5 jam yang lalu', status: 'hadir', msg: 'Barakallahu lakuma wa baraka alaikuma wa jama\'a bainakuma fii khair. Turut berbahagia untuk kalian berdua!' },
            { name: 'Clara & Rio', time: '1 hari yang lalu', status: 'hadir', msg: 'Congratulations lovebirds! Sangat terharu melihat perjalanan kalian hingga ke pelaminan. See you on the big day!' }
        ],

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

        submitRsvp() {
            if (!this.rsvpName.trim() || !this.rsvpMessage.trim()) return;
            this.wishes.unshift({
                name: this.rsvpName,
                time: 'Baru saja',
                status: this.rsvpStatus,
                msg: this.rsvpMessage
            });
            this.rsvpSubmitted = true;
            this.rsvpMessage = '';
            setTimeout(() => { this.rsvpSubmitted = false; }, 4000);
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

    <!-- HIDDEN BACKGROUND AUDIO -->
    <audio id="bgm-audio" loop preload="auto">
        <source src="https://cdn.pixabay.com/download/audio/2022/05/27/audio_1808fbf07a.mp3?filename=piano-moment-9835.mp3" type="audio/mpeg">
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
                Raka <span class="font-serif italic font-normal text-stone-500 text-3xl sm:text-4xl">&amp;</span> Arinda
            </h1>

            <p class="text-xs tracking-[0.2em] text-stone-500 uppercase font-light mb-8">
                Sabtu, 24 Oktober 2026
            </p>

            <!-- Guest Card -->
            <div class="w-full art-card rounded-2xl p-6 mb-8 border hairline-border shadow-sm text-center">
                <span class="text-[10px] uppercase tracking-[0.25em] text-stone-400 font-medium block mb-2">
                    Kepada Yth. Bapak/Ibu/Saudara/i:
                </span>
                <p class="font-serif text-xl sm:text-2xl font-normal text-stone-900 tracking-tight mb-2">
                    {{ $guestName ?? 'Reyhan & Lesti' }}
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
                        Raka <span class="font-serif italic font-normal text-stone-500 text-4xl">&amp;</span> Arinda
                    </h1>
                    <p class="text-xs uppercase tracking-[0.25em] text-stone-500 font-light">
                        Sabtu, 24 Oktober 2026 • Jakarta
                    </p>
                </div>

                <!-- Fine Art Couple Portrait Frame -->
                <div class="relative mx-auto max-w-sm aspect-[4/5] rounded-3xl overflow-hidden shadow-sm border hairline-border p-2 bg-white">
                    <img 
                        src="https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80" 
                        alt="Raka & Arinda" 
                        class="w-full h-full object-cover rounded-2xl"
                    >
                </div>

                <!-- Ayat Suci / Kutipan Bijak -->
                <div class="max-w-md mx-auto space-y-3 px-4">
                    <p class="font-editorial italic text-base sm:text-lg text-stone-700 leading-relaxed">
                        “Dan di antara tanda-tanda kebesaran-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.”
                    </p>
                    <span class="text-[11px] uppercase tracking-[0.2em] text-stone-400 font-medium block">
                        QS. Ar-Rum: 21
                    </span>
                </div>

                <!-- COUNTDOWN TIMER (Minimalist Pill Cards) -->
                <div class="pt-2">
                    <div class="grid grid-cols-4 gap-3 max-w-xs mx-auto text-center">
                        <div class="art-card rounded-2xl p-3 border hairline-border">
                            <span class="font-serif text-xl sm:text-2xl font-medium text-stone-900 block" x-text="days">28</span>
                            <span class="text-[10px] uppercase tracking-wider text-stone-400">Hari</span>
                        </div>
                        <div class="art-card rounded-2xl p-3 border hairline-border">
                            <span class="font-serif text-xl sm:text-2xl font-medium text-stone-900 block" x-text="hours">14</span>
                            <span class="text-[10px] uppercase tracking-wider text-stone-400">Jam</span>
                        </div>
                        <div class="art-card rounded-2xl p-3 border hairline-border">
                            <span class="font-serif text-xl sm:text-2xl font-medium text-stone-900 block" x-text="minutes">42</span>
                            <span class="text-[10px] uppercase tracking-wider text-stone-400">Menit</span>
                        </div>
                        <div class="art-card rounded-2xl p-3 border hairline-border">
                            <span class="font-serif text-xl sm:text-2xl font-medium text-stone-900 block" x-text="seconds">18</span>
                            <span class="text-[10px] uppercase tracking-wider text-stone-400">Detik</span>
                        </div>
                    </div>
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
                                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&auto=format&fit=crop&q=80" 
                                alt="Raka Pratama" 
                                class="w-full h-full object-cover rounded-full"
                            >
                        </div>
                        <div class="space-y-1.5">
                            <h3 class="font-editorial text-2xl font-medium text-stone-900">Raka Pratama, S.T.</h3>
                            <p class="text-xs text-stone-500 leading-relaxed">
                                Putra pertama dari<br>
                                <strong class="text-stone-800 font-medium">Bpk. Dr. H. Bambang Soediro</strong><br>
                                &amp; Ibu Hj. Ratna Juwita
                            </p>
                        </div>
                        <a 
                            href="https://instagram.com" 
                            target="_blank" 
                            class="inline-flex items-center gap-1.5 text-xs text-stone-500 hover:text-stone-900 transition pt-1"
                        >
                            <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                            <span>@raka.pratama</span>
                        </a>
                    </div>

                    <!-- BRIDE -->
                    <div class="art-card rounded-3xl p-6 border hairline-border flex flex-col items-center text-center space-y-4">
                        <div class="w-32 h-32 rounded-full overflow-hidden border hairline-border p-1 bg-white shadow-sm">
                            <img 
                                src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500&auto=format&fit=crop&q=80" 
                                alt="Arinda Citra Kirana" 
                                class="w-full h-full object-cover rounded-full"
                            >
                        </div>
                        <div class="space-y-1.5">
                            <h3 class="font-editorial text-2xl font-medium text-stone-900">Arinda Citra Kirana, S.Ds.</h3>
                            <p class="text-xs text-stone-500 leading-relaxed">
                                Putri kedua dari<br>
                                <strong class="text-stone-800 font-medium">Bpk. Ir. H. Hendra Wijaya</strong><br>
                                &amp; Ibu Hj. Siti Aminah
                            </p>
                        </div>
                        <a 
                            href="https://instagram.com" 
                            target="_blank" 
                            class="inline-flex items-center gap-1.5 text-xs text-stone-500 hover:text-stone-900 transition pt-1"
                        >
                            <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                            <span>@arinda.kirana</span>
                        </a>
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
                                <h3 class="font-editorial text-2xl font-medium text-stone-900">Sabtu, 24 Oktober 2026</h3>
                                <p class="text-xs text-stone-600 font-medium mt-1">Pukul 08.00 - 10.00 WIB</p>
                            </div>

                            <div class="pt-3 border-t hairline-border text-xs text-stone-600 space-y-1">
                                <p class="font-medium text-stone-900">The Langham Hotel, Ballroom Lantai 2</p>
                                <p class="text-stone-500 leading-relaxed">District 8, SCBD Lot 28, Jl. Jend. Sudirman, Senayan, Kebayoran Baru, Jakarta Selatan</p>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a 
                                href="https://maps.google.com" 
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
                                <h3 class="font-editorial text-2xl font-medium text-stone-900">Sabtu, 24 Oktober 2026</h3>
                                <p class="text-xs text-stone-600 font-medium mt-1">Pukul 11.00 - 14.00 WIB</p>
                            </div>

                            <div class="pt-3 border-t hairline-border text-xs text-stone-600 space-y-1">
                                <p class="font-medium text-stone-900">The Langham Hotel, Grand Ballroom</p>
                                <p class="text-stone-500 leading-relaxed">District 8, SCBD Lot 28, Jl. Jend. Sudirman, Senayan, Kebayoran Baru, Jakarta Selatan</p>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a 
                                href="https://maps.google.com" 
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
            <section class="space-y-8">
                
                <div class="text-center space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-stone-400 font-medium block">
                        Kisah Cinta
                    </span>
                    <h2 class="font-editorial text-3xl sm:text-4xl font-normal text-stone-900">
                        Perjalanan Kisah Kami
                    </h2>
                </div>

                <div class="relative border-l hairline-border ml-4 sm:ml-8 pl-6 sm:pl-8 space-y-8 py-2">
                    
                    <!-- MILESTONE 1 -->
                    <div class="relative">
                        <div class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-3.5 h-3.5 rounded-full bg-stone-900 border-2 border-[#FAF8F5]"></div>
                        <div class="space-y-1">
                            <span class="text-[10px] uppercase tracking-widest text-stone-400 font-bold">November 2021</span>
                            <h3 class="font-editorial text-xl font-medium text-stone-900">Pertemuan Pertama di Galeri Seni</h3>
                            <p class="text-xs text-stone-500 leading-relaxed">
                                Berawal dari sebuah pameran seni rupa di Jakarta Pusat, ketertarikan pada karya lukis membawa kami pada obrolan hangat pertama yang mengalir tanpa henti.
                            </p>
                        </div>
                    </div>

                    <!-- MILESTONE 2 -->
                    <div class="relative">
                        <div class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-3.5 h-3.5 rounded-full bg-stone-900 border-2 border-[#FAF8F5]"></div>
                        <div class="space-y-1">
                            <span class="text-[10px] uppercase tracking-widest text-stone-400 font-bold">Desember 2024</span>
                            <h3 class="font-editorial text-xl font-medium text-stone-900">Mengikat Janji Menuju Masa Depan</h3>
                            <p class="text-xs text-stone-500 leading-relaxed">
                                Setelah saling mengenal dan tumbuh bersama melewati berbagai musim, di hadapan kedua orang tua kami memantapkan hati untuk melangkah ke jenjang yang lebih serius.
                            </p>
                        </div>
                    </div>

                    <!-- MILESTONE 3 -->
                    <div class="relative">
                        <div class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-3.5 h-3.5 rounded-full bg-stone-900 border-2 border-[#FAF8F5]"></div>
                        <div class="space-y-1">
                            <span class="text-[10px] uppercase tracking-widest text-stone-400 font-bold">Oktober 2026</span>
                            <h3 class="font-editorial text-xl font-medium text-stone-900">Menyempurnakan Ikatan Suci</h3>
                            <p class="text-xs text-stone-500 leading-relaxed">
                                Bersama Anda sekalian sebagai saksi, kami mengikrarkan janji suci pernikahan untuk saling mendampingi dalam suka dan duka seumur hidup.
                            </p>
                        </div>
                    </div>

                </div>

            </section>

            <!-- ============================================================= -->
            <!-- 5. GALERI FOTO (MOMEN BAHAGIA) -->
            <!-- ============================================================= -->
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
                    
                    @php
                        $galleries = [
                            'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                            'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80',
                            'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&auto=format&fit=crop&q=80',
                            'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=80',
                            'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&auto=format&fit=crop&q=80',
                            'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=800&auto=format&fit=crop&q=80',
                        ];
                    @endphp

                    @foreach ($galleries as $img)
                        <div 
                            @click="openPhoto('{{ $img }}')"
                            class="relative aspect-[3/4] rounded-2xl overflow-hidden cursor-pointer group shadow-sm border hairline-border bg-white"
                        >
                            <img 
                                src="{{ $img }}" 
                                alt="Momen Indah Raka & Arinda" 
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
                    
                    <!-- REKENING 1 (BCA) -->
                    <div class="art-card rounded-2xl p-5 border hairline-border space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="font-serif font-bold text-sm text-stone-900">Bank BCA</span>
                            <i data-lucide="credit-card" class="w-4 h-4 text-stone-400"></i>
                        </div>
                        <div class="space-y-0.5">
                            <p class="font-mono text-base font-semibold text-stone-900">8820 1928 4710</p>
                            <p class="text-xs text-stone-500">a.n. Raka Pratama</p>
                        </div>
                        <button 
                            @click="copyToClipboard('882019284710', 'Nomor Rekening BCA')"
                            class="w-full py-2 rounded-xl bg-[#F5F0E8] hover:bg-[#EBE3D5] text-stone-800 text-xs font-medium transition flex items-center justify-center gap-1.5"
                        >
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                            <span>Salin Nomor Rekening</span>
                        </button>
                    </div>

                    <!-- REKENING 2 (MANDIRI) -->
                    <div class="art-card rounded-2xl p-5 border hairline-border space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="font-serif font-bold text-sm text-stone-900">Bank Mandiri</span>
                            <i data-lucide="credit-card" class="w-4 h-4 text-stone-400"></i>
                        </div>
                        <div class="space-y-0.5">
                            <p class="font-mono text-base font-semibold text-stone-900">1370 0192 8472 1</p>
                            <p class="text-xs text-stone-500">a.n. Arinda Citra Kirana</p>
                        </div>
                        <button 
                            @click="copyToClipboard('1370019284721', 'Nomor Rekening Mandiri')"
                            class="w-full py-2 rounded-xl bg-[#F5F0E8] hover:bg-[#EBE3D5] text-stone-800 text-xs font-medium transition flex items-center justify-center gap-1.5"
                        >
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                            <span>Salin Nomor Rekening</span>
                        </button>
                    </div>

                </div>

            </section>

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
                        Raka &amp; Arinda
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
</body>
</html>
