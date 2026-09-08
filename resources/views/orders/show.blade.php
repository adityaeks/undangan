@php
    $fromDashboard = request('from') === 'dashboard';
@endphp

@if($fromDashboard)
    {{-- TAMPILAN DALAM DASHBOARD (RIWAYAT TRANSAKSI) --}}
    @php
        $layoutComponent = Auth::user()?->isPartner() ? 'partner-layout' : (Auth::user()?->isSuperAdmin() ? 'app-layout' : 'member-layout');
    @endphp

    <x-dynamic-component :component="$layoutComponent">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header for Dashboard View -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    @php
                        $backUrl = Auth::user()?->isPartner() 
                            ? route('partner.dashboard') 
                            : (Auth::user()?->isSuperAdmin() ? route('admin.dashboard') : route('member.orders.index'));
                    @endphp
                    <a href="{{ $backUrl }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-sand-600 hover:text-charcoal-900 transition mb-2">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        <span>Kembali ke Riwayat Transaksi</span>
                    </a>
                    <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                        {{ $order->isPaid() ? 'Invoice Pembayaran' : 'Detail Pembelian & Tagihan' }}
                    </h1>
                    <p class="text-xs text-sand-500">Nomor Invoice: <strong class="text-charcoal-900 font-mono">#INV-{{ $order->order_code }}</strong></p>
                </div>
                <div class="flex items-center gap-2.5">
                    @if($order->isPaid())
                        <a 
                            href="{{ route('orders.invoice', ['order' => $order, 'print' => 1]) }}" 
                            target="_blank"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-charcoal-950 hover:bg-brand-600 text-white font-bold text-xs shadow-sm transition cursor-pointer"
                        >
                            <i data-lucide="printer" class="w-4 h-4"></i>
                            <span>Download / Cetak Invoice</span>
                        </a>
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider shadow-sm border border-emerald-200">
                            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                            <span>Lunas</span>
                        </span>
                    @elseif($order->isExpired())
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-rose-100 text-rose-800 text-xs font-bold uppercase tracking-wider shadow-sm border border-rose-200">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600"></i>
                            <span>Kedaluwarsa</span>
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-900 text-xs font-bold uppercase tracking-wider shadow-sm border border-amber-200">
                            <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
                            <span>Menunggu Pembayaran</span>
                        </span>
                    @endif
                </div>
            </div>

            @if($order->isPaid())
                @include('orders.partials.invoice-card')
            @else
                @include('orders.partials.order-card')
            @endif
        </div>
    </x-dynamic-component>

@else
    {{-- TAMPILAN CHECKOUT STANDALONE (DENGAN NAVBAR SEPERTI DI HOME) --}}
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth h-full bg-sand-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Checkout &amp; Pembayaran Tema - {{ config('app.name', 'KlikMomen') }}</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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

        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Lucide Icons -->
        <script src="https://unpkg.com/lucide@latest"></script>

        <style>
            [x-cloak] { display: none !important; }
            .font-serif { font-family: 'Playfair Display', serif; }
            .glass-panel {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }
        </style>
    </head>
    <body class="min-h-screen flex flex-col justify-between text-charcoal-900 font-sans antialiased selection:bg-brand-200 selection:text-charcoal-950" x-data="{ mobileMenuOpen: false }">
        
        <!-- NAVBAR LIKE HOME -->
        @include('layouts.navbar')

        <!-- CHECKOUT MAIN CONTENT -->
        <main class="flex-1 py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto space-y-6">
                
                <!-- STANDALONE CHECKOUT HEADER -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-sand-200/80">
                    <div>
                        <a href="{{ route('themes.catalog') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-700 hover:text-brand-900 transition mb-2">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                            <span>Kembali ke Katalog Tema</span>
                        </a>
                        <div class="flex items-center gap-2">
                            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">Detail Pembelian & Tagihan</h1>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">Checkout Tema</span>
                        </div>
                        <p class="text-xs text-sand-500 mt-0.5">Kode Transaksi: <strong class="text-charcoal-900 font-mono">{{ $order->order_code }}</strong></p>
                    </div>

                    <div>
                        @if($order->isPaid())
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider shadow-sm border border-emerald-200">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                                <span>Lunas &amp; Aktif</span>
                            </span>
                        @elseif($order->isExpired())
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-rose-100 text-rose-800 text-xs font-bold uppercase tracking-wider shadow-sm border border-rose-200">
                                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600"></i>
                                <span>Kedaluwarsa</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-amber-100 text-amber-900 text-xs font-bold uppercase tracking-wider shadow-sm border border-amber-200">
                                <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
                                <span>Menunggu Pembayaran</span>
                            </span>
                        @endif
                    </div>
                </div>

                @include('orders.partials.order-card')

            </div>
        </main>

        <!-- CLEAN PUBLIC FOOTER -->
        <footer class="py-6 px-6 sm:px-8 border-t border-sand-200 bg-white/70 backdrop-blur-sm text-xs text-sand-500">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="font-medium text-charcoal-800">KlikMomen Secure Checkout • Transaksi Dilindungi SSL 256-Bit</span>
                </div>
                <p>&copy; 2026 KlikMomen Studio. Hak Cipta Dilindungi.</p>
            </div>
        </footer>

        <!-- Scripts -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            });
        </script>
    </body>
    </html>
@endif
