<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KlikMomen') }} - Digital Invitation Studio</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN with custom colors -->
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
                            50: '#FBF9F5',
                            100: '#F5EFE6',
                            200: '#E9DFC9',
                            300: '#D8C7A5',
                            400: '#C2AA7D',
                            500: '#A68D5C',
                            600: '#8A7245',
                            700: '#6C5834',
                            800: '#4F4024',
                            900: '#332917',
                        },
                        sand: {
                            50: '#FDFCFA',
                            100: '#FAF8F5',
                            200: '#EFECE3',
                            300: '#E2DEC6',
                            400: '#C8C2A8',
                            500: '#A8A287',
                            600: '#7A7469',
                            700: '#575249',
                            800: '#38342D',
                            900: '#1E1C18',
                        },
                        charcoal: {
                            800: '#2A2824',
                            900: '#181715',
                            950: '#0E0D0C',
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
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-editorial { font-family: 'Cormorant Garamond', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }

        .glass-card {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
</head>

<body class="min-h-screen bg-sand-100 text-charcoal-900 font-sans antialiased selection:bg-brand-200 selection:text-charcoal-950 flex flex-col justify-between">

    <!-- NAVBAR COMPONENT -->
    @include('layouts.guest.navbar')

    <!-- MAIN SPLIT CONTENT -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-10">
        <div class="w-full max-w-5xl rounded-[32px] overflow-hidden glass-card border border-sand-200 shadow-2xl grid grid-cols-1 lg:grid-cols-12 min-h-[620px]">
            
            <!-- LEFT COLUMN: EDITORIAL SHOWCASE (DESKTOP) -->
            <div class="hidden lg:flex lg:col-span-5 relative bg-cover bg-center flex-col justify-between p-10 text-white overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1519741497674-611481863552?w=1000&auto=format&fit=crop&q=85');">
                <!-- DARK GRADIENT OVERLAY -->
                <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950/95 via-charcoal-950/50 to-charcoal-950/70 z-0"></div>

                <!-- TOP BADGE -->
                <div class="relative z-10 space-y-2">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-[11px] font-bold tracking-wider uppercase text-amber-200">
                        <span>✨ Platform Undangan #1</span>
                    </div>
                    <h3 class="font-serif text-2xl font-bold leading-snug">
                        Bagikan Kebahagiaan Momen Istimewa Anda
                    </h3>
                </div>

                <!-- BOTTOM QUOTE & STATS -->
                <div class="relative z-10 space-y-6">
                    <div class="p-5 rounded-2xl bg-black/40 backdrop-blur-md border border-white/15 space-y-2">
                        <div class="flex text-amber-400 gap-1 text-xs">
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                        </div>
                        <p class="text-xs text-white/90 italic font-editorial text-sm leading-relaxed">
                            "Desain editorialnya mewah banget, tamu-tamu kami sangat terkesan. Pembuatannya cepat dan mudah!"
                        </p>
                        <span class="text-[10px] text-amber-200 font-semibold block">— Alika & Farhan (Jakarta)</span>
                    </div>

                    <div class="flex items-center justify-between text-[11px] text-white/75 pt-2 border-t border-white/15 font-medium">
                        <span>✓ 50+ Pilihan Tema</span>
                        <span>✓ Tanpa Batas Tamu</span>
                        <span>✓ Aktif Selamanya</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: FORM SLOT -->
            <div class="lg:col-span-7 p-6 sm:p-10 lg:p-12 flex flex-col justify-center bg-white/90">
                <div class="max-w-md w-full mx-auto space-y-6">
                    {{ $slot }}
                </div>
            </div>

        </div>
    </main>

    <!-- FOOTER COMPONENT -->
    @include('layouts.guest.footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>

    <!-- SWEETALERT NOTIFICATION SYSTEM -->
    <x-sweetalert />
</body>
</html>
