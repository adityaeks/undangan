<!-- GUEST TOP NAVBAR -->
<header class="w-full py-4 px-6 sm:px-10 border-b border-sand-200/80 bg-white/70 backdrop-blur-md sticky top-0 z-30">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
            <div class="w-9 h-9 rounded-full bg-charcoal-950 text-brand-300 flex items-center justify-center font-serif font-bold text-base shadow-sm group-hover:scale-105 transition-transform duration-200">
                K
            </div>
            <div class="flex flex-col">
                <span class="font-serif text-xl font-bold tracking-tight text-charcoal-950">
                    KalaUndangan<span class="text-brand-500">.</span>
                </span>
            </div>
        </a>

        <div class="flex items-center gap-4">
            <a href="{{ route('demo.index') }}" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold text-sand-600 hover:text-brand-600 transition">
                <i data-lucide="play" class="w-3.5 h-3.5 fill-current"></i>
                <span>Live Demo</span>
            </a>
            <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-sand-600 hover:text-brand-600 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>
</header>
