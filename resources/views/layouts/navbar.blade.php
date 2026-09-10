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
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-full bg-charcoal-900 text-brand-200 flex items-center justify-center font-serif text-xl font-bold shadow-md group-hover:scale-105 transition-transform duration-300 border border-brand-400/40">
                    K
                </div>
                <div class="flex flex-col">
                    <span class="font-serif text-2xl font-bold tracking-tight text-charcoal-950 flex items-center gap-1">
                        KlikMomen<span class="text-brand-500">.</span>
                    </span>
                    <span class="text-[10px] tracking-[0.25em] uppercase text-sand-500 font-semibold -mt-1">
                        Digital Invitation Studio
                    </span>
                </div>
            </a>

            <!-- DESKTOP NAVIGATION -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-charcoal-900/80">
                <a href="{{ route('home') }}" class="hover:text-brand-600 transition-colors duration-200 {{ request()->routeIs('home') ? 'text-brand-700 font-semibold' : '' }}">Home</a>
                <a href="{{ route('themes.catalog') }}" class="hover:text-brand-600 transition-colors duration-200 {{ request()->routeIs('themes.catalog') || request()->routeIs('templates.index') ? 'text-brand-700 font-semibold' : '' }}">Katalog Tema</a>
                <a href="{{ url('/#simulasi') }}" class="hover:text-brand-600 transition-colors duration-200">Simulasi Tamu</a>
                <a href="{{ url('/#partner') }}" class="hover:text-brand-600 transition-colors duration-200">Join Partner (WO)</a>
                <a href="{{ url('/#faq') }}" @click="if (typeof openCsModal === 'function') { $event.preventDefault(); openCsModal(); }" class="hover:text-brand-600 transition-colors duration-200">FAQ &amp; Bantuan</a>
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
        <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="block text-base font-medium text-charcoal-900 py-1">Home</a>
        <a href="{{ route('themes.catalog') }}" @click="mobileMenuOpen = false" class="block text-base font-medium text-charcoal-900 py-1">Koleksi Tema</a>
        <a href="{{ url('/#simulasi') }}" @click="mobileMenuOpen = false" class="block text-base font-medium text-charcoal-900 py-1">Simulasi Tamu</a>
        <a href="{{ url('/#partner') }}" @click="mobileMenuOpen = false" class="block text-base font-medium text-charcoal-900 py-1">Join Partner (WO & Vendor)</a>
        <a href="{{ url('/#faq') }}" @click="mobileMenuOpen = false; if (typeof openCsModal === 'function') { $event.preventDefault(); openCsModal(); }" class="block text-base font-medium text-charcoal-900 py-1">Tanya Jawab (FAQ &amp; CS)</a>
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
