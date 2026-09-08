<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth h-full bg-sand-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran Berhasil - {{ config('app.name', 'KlikMomen') }}</title>

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
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="min-h-screen sm:h-screen flex flex-col justify-between items-center p-3 sm:p-4 text-charcoal-900 font-sans antialiased selection:bg-brand-200 selection:text-charcoal-950 overflow-x-hidden">
    <!-- SUCCESS MAIN CONTENT (SINGLE SECTION VIEWPORT FIT) -->
    <main class="w-full max-w-xl mx-auto my-auto py-2">
        <!-- CELEBRATION HEADER CARD WITH DIRECT ACTION BUTTON -->
        <div class="rounded-3xl glass-panel bg-white/95 border border-sand-200/80 p-6 sm:p-8 text-center shadow-xl space-y-4">
            
            <!-- Animated Check Badge -->
            <div class="relative w-14 h-14 sm:w-16 sm:h-16 mx-auto flex items-center justify-center">
                <div class="absolute inset-0 rounded-full bg-emerald-500/20 animate-ping"></div>
                <div class="relative w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <i data-lucide="check" class="w-7 h-7 sm:w-8 sm:h-8 stroke-[2.5]"></i>
                </div>
            </div>

            <div class="space-y-1">
                <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[11px] font-bold uppercase tracking-wider">
                    <i data-lucide="check-circle" class="w-3 h-3 text-emerald-600"></i>
                    <span>Pembayaran Berhasil Terverifikasi</span>
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                    Transaksi Berhasil & Akses Aktif!
                </h1>
                <p class="text-xs sm:text-sm text-sand-500 max-w-md mx-auto">
                    Terima kasih atas pesanan Anda. Pembayaran sebesar <strong class="text-charcoal-900 font-semibold">{{ format_rupiah($order->total_amount ?? $order->amount) }}</strong> telah kami terima.
                </p>
            </div>

            <!-- TRANSACTION CODE STRIP -->
            <div class="inline-flex flex-wrap items-center justify-center gap-2 sm:gap-3 px-4 py-1.5 rounded-xl bg-sand-100/80 border border-sand-200 text-xs text-sand-600">
                <div>Kode Transaksi: <strong class="text-charcoal-900 font-mono">{{ $order->order_code }}</strong></div>
                <span class="text-sand-300">•</span>
                <div>Waktu: <strong class="text-charcoal-900">{{ $order->paid_at ? $order->paid_at->isoFormat('D MMMM Y, HH:mm') : 'Hari ini' }}</strong></div>
            </div>

            <!-- DIRECT ACTION BUTTONS (2 ROWS, SIZED TO CONTENT) -->
            <div class="pt-3 border-t border-sand-200/80 flex flex-col items-center gap-2.5 w-full">
                {{-- ROW 1: PRIMARY ACTION BUTTON (CONTENT SIZED) --}}
                @if(($order->metadata['service_type'] ?? '') === 'assisted')
                    {{-- JIKA USER PILIH DIISIKAN OLEH TIM --}}
                    <a 
                        href="{{ $waUrl }}" 
                        target="_blank" 
                        id="whatsapp-cta-button"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-sm shadow-md hover:shadow-emerald-500/25 transition-all hover:scale-[1.02] active:scale-[0.98] cursor-pointer"
                    >
                        <i data-lucide="message-circle" class="w-4 h-4 fill-current"></i>
                        <span>Kirim Data via WhatsApp Admin</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                @else
                    {{-- JIKA USER PILIH ISI DATA SENDIRI --}}
                    @php
                        $targetUrl = Auth::user()?->isPartner()
                            ? route('partner.invitations.create')
                            : (Auth::user()?->isSuperAdmin() ? route('invitations.create') : ($themeItem ? route('member.invitations.create', ['theme_id' => $themeItem->item_id]) : route('member.invitations.create')));
                        $btnLabel = Auth::user()?->isPartner() ? 'Mulai Buat Undangan Klien' : 'Gunakan Template & Buat Undangan';
                    @endphp
                    <a 
                        href="{{ $targetUrl }}" 
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md hover:shadow-emerald-600/25 transition-all hover:scale-[1.02] active:scale-[0.98] cursor-pointer"
                    >
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        <span>{!! $btnLabel !!}</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                @endif

                {{-- ROW 2: SECONDARY ACTION BUTTON (CONTENT SIZED) --}}
                <a 
                    href="{{ route('member.dashboard') }}" 
                    class="inline-flex items-center justify-center gap-1.5 px-5 py-2 rounded-xl bg-sand-100 hover:bg-sand-200/90 border border-sand-300 text-charcoal-700 hover:text-charcoal-900 font-semibold text-xs transition-all hover:scale-[1.02] active:scale-[0.98]"
                >
                    <i data-lucide="layout-dashboard" class="w-3.5 h-3.5 text-sand-500"></i>
                    <span>Buka Dashboard</span>
                </a>
            </div>

            @if(($order->metadata['service_type'] ?? '') === 'assisted')
                <div class="text-[11px] text-emerald-800 bg-emerald-50 border border-emerald-200/80 rounded-xl py-2 px-3.5 flex items-center justify-center gap-1.5">
                    <i data-lucide="headphones" class="w-3.5 h-3.5 text-emerald-600 shrink-0"></i>
                    <span>Opsi: <strong>Layanan Diisikan Oleh Tim Kami (Terima Beres)</strong>. Silakan kirimkan data & foto pernikahan Anda melalui WhatsApp di atas.</span>
                </div>
            @else
                <div class="text-[11px] text-amber-900 bg-amber-50/80 border border-amber-200/80 rounded-xl py-2 px-3.5 flex items-center justify-center gap-1.5">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5 text-amber-600 shrink-0"></i>
                    <span><strong>Template Siap Digunakan!</strong> Klik tombol di atas untuk mulai membuat undangan pernikahan Anda.</span>
                </div>
            @endif
        </div>
    </main>

    <!-- CLEAN PUBLIC FOOTER (COMPACT) -->
    <footer class="w-full max-w-xl mx-auto py-2 text-center text-[11px] text-sand-500">
        <p>&copy; 2026 KlikMomen Studio • Transaksi Terverifikasi & Dilindungi SSL</p>
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
