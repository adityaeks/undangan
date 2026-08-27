<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-sand-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KalaUndangan') }} - Admin Dashboard</title>

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

        .glass-panel {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        /* Custom subtle scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.03);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.25);
        }
    </style>
</head>

<body class="h-full bg-sand-100 text-charcoal-900 font-sans antialiased selection:bg-brand-200 selection:text-charcoal-950" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex">

        <!-- MOBILE SIDEBAR BACKDROP -->
        <div 
            x-show="sidebarOpen" 
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false" 
            class="fixed inset-0 bg-charcoal-950/70 backdrop-blur-sm z-40 lg:hidden"
            style="display: none;"
        ></div>

        <!-- SIDEBAR COMPONENT -->
        @include('layouts.admin.sidebar')

        <!-- MAIN CONTENT WRAPPER -->
        <div class="flex-1 flex flex-col min-w-0 min-h-screen overflow-hidden">
            
            <!-- TOP NAVBAR COMPONENT -->
            @include('layouts.admin.navbar')

            <!-- PAGE CONTENT BODY -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 space-y-8">
                {{ $slot }}
            </main>

            <!-- FOOTER COMPONENT -->
            @include('layouts.admin.footer')

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
