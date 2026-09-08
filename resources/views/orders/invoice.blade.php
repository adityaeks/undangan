<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-sand-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice #INV-{{ $order->order_code }} - {{ config('app.name', 'KlikMomen') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
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

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        @media print {
            .noprint {
                display: none !important;
            }
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .invoice-container {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
            }
            @page {
                size: A4 portrait;
                margin: 1.5cm;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-sand-100 text-charcoal-900 font-sans antialiased py-6 sm:py-10 px-4 sm:px-6">

    <!-- FLOATING TOP BAR (NOPRINT) -->
    <div class="noprint max-w-4xl mx-auto mb-6 flex flex-col sm:flex-row items-center justify-between gap-4 p-4 rounded-2xl bg-white border border-sand-300 shadow-sm">
        <div class="flex items-center gap-3">
            @php
                $backUrl = route('orders.show', ['order' => $order, 'from' => 'dashboard']);
            @endphp
            <a href="{{ $backUrl }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 font-semibold text-xs transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Kembali ke Detail Pesanan</span>
            </a>
            <span class="text-xs text-sand-500 hidden sm:inline">•</span>
            <span class="text-xs text-sand-500 font-mono hidden sm:inline">#INV-{{ $order->order_code }}</span>
        </div>

        <div class="flex items-center gap-2.5 w-full sm:w-auto">
            <button 
                onclick="window.print()" 
                type="button" 
                class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white font-bold text-xs shadow-md transition cursor-pointer"
            >
                <i data-lucide="printer" class="w-4 h-4"></i>
                <span>Download / Cetak PDF</span>
            </button>
        </div>
    </div>

    <!-- MAIN INVOICE CONTAINER -->
    <div class="invoice-container max-w-4xl mx-auto">
        @include('orders.partials.invoice-card')
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }

            @if(request('print') == 1)
                setTimeout(() => {
                    window.print();
                }, 400);
            @endif
        });
    </script>
</body>
</html>
