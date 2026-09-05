<x-member-layout>
    <div class="space-y-4">
        
        <!-- PAGE HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="space-y-0.5">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-amber-500/10 text-amber-800 text-[10px] font-bold uppercase tracking-wider border border-amber-500/20">
                    <i data-lucide="palette" class="w-3 h-3 text-amber-600"></i>
                    <span>Portal Pengantin • Tema Undangan Saya</span>
                </div>
                <h1 class="font-serif text-xl sm:text-2xl font-bold text-charcoal-950">
                    Pilihan Desain Tema Undangan Anda yang Telah Aktif
                </h1>
                <p class="text-xs text-sand-600">
                    Hanya menampilkan tema undangan digital yang telah Anda bayar lunas dan siap digunakan.
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('themes.catalog') }}" class="px-3.5 py-2 rounded-xl bg-charcoal-900 hover:bg-charcoal-800 text-white font-bold text-xs shadow transition flex items-center justify-center gap-1.5">
                    <i data-lucide="shopping-bag" class="w-3.5 h-3.5 text-amber-400"></i>
                    <span>Beli Tema Baru</span>
                </a>

                @if($totalOwned > 0)
                    <a href="{{ route('member.invitations.create') }}" class="px-3.5 py-2 rounded-xl bg-gradient-to-r from-amber-600 via-amber-700 to-brand-700 text-white font-bold text-xs shadow hover:shadow-amber-500/25 hover:scale-105 transition flex items-center justify-center gap-1.5">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                        <span>Buat Undangan</span>
                    </a>
                @endif
            </div>
        </div>

        @if($totalOwned > 0)
            <!-- COMPACT STATS & SEARCH TOOLBAR -->
            <div class="p-2.5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-2.5">
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/90 border border-sand-200 text-xs">
                        <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-600"></i>
                        <span class="text-sand-500 font-medium">Tema Aktif:</span>
                        <span class="font-bold text-emerald-700">{{ $totalOwned }}</span>
                    </div>
                    <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/90 border border-sand-200 text-xs">
                        <i data-lucide="compass" class="w-3.5 h-3.5 text-amber-600"></i>
                        <span class="text-sand-500 font-medium">Katalog:</span>
                        <span class="font-bold text-charcoal-900">{{ $totalCatalogThemes ?? 5 }}</span>
                    </div>
                </div>

                <form method="GET" action="{{ route('member.themes.index') }}" class="flex items-center gap-2 w-full sm:w-auto">
                    <div class="relative w-full sm:w-64">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Cari tema aktif Anda..." 
                            class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-sand-200 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-xs bg-white placeholder-sand-400"
                        >
                        <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-sand-400">
                            <i data-lucide="search" class="w-3.5 h-3.5"></i>
                        </div>
                    </div>
                    <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-charcoal-900 text-white font-bold text-xs hover:bg-charcoal-800 transition shrink-0">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('member.themes.index') }}" class="px-2.5 py-1.5 rounded-xl bg-sand-100 text-sand-600 hover:text-charcoal-900 text-xs font-semibold transition shrink-0">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        @endif

        <!-- THEME GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($themes as $theme)
                <div class="group rounded-2xl overflow-hidden glass-panel border border-sand-200/80 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition duration-300 flex flex-col justify-between">
                    <div>
                        <!-- THUMBNAIL -->
                        <div class="relative aspect-[4/3] overflow-hidden bg-sand-200">
                            <img src="{{ $theme->thumbnail }}" alt="{{ $theme->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- CATEGORY BADGE -->
                            <div class="absolute top-2.5 left-2.5">
                                <span class="px-2.5 py-0.5 rounded-full bg-charcoal-950/80 backdrop-blur-md text-amber-200 text-[10px] font-bold uppercase tracking-wider shadow">
                                    {{ $theme->category }}
                                </span>
                            </div>

                            <!-- ACTIVE & PAID BADGE -->
                            <div class="absolute top-2.5 right-2.5">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-600/95 backdrop-blur-md text-white text-[10px] font-bold shadow">
                                    <i data-lucide="check-circle" class="w-3 h-3"></i>
                                    <span>Aktif &amp; Lunas</span>
                                </span>
                            </div>
                        </div>

                        <!-- CONTENT INFO -->
                        <div class="p-4 space-y-1.5">
                            <h3 class="font-serif text-base font-bold text-charcoal-950 group-hover:text-amber-700 transition truncate">
                                {{ $theme->name }}
                            </h3>
                            <p class="text-xs text-sand-600 line-clamp-2 leading-relaxed">
                                {{ $theme->metadata['description'] ?? 'Desain modern bernuansa '.strtolower($theme->category).', dilengkapi animasi lembut, pemutar musik, dan RSVP otomatis.' }}
                            </p>
                        </div>
                    </div>

                    <!-- CARD FOOTER ACTIONS -->
                    <div class="p-4 pt-0 border-t border-sand-200/60 mt-2 flex items-center justify-between gap-2.5 pt-3">
                        <a 
                            href="{{ route('demo.show', $theme->slug) }}" 
                            target="_blank"
                            class="flex-1 py-2 px-3 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 text-xs font-bold transition flex items-center justify-center gap-1.5"
                        >
                            <i data-lucide="play" class="w-3.5 h-3.5 text-amber-600"></i>
                            <span>Live Demo</span>
                        </a>

                        <a 
                            href="{{ route('member.invitations.create', ['theme_id' => $theme->id]) }}" 
                            class="flex-1 py-2 px-3 rounded-xl bg-gradient-to-r from-amber-600 to-brand-700 hover:from-amber-700 hover:to-brand-800 text-white text-xs font-bold shadow-sm hover:shadow transition flex items-center justify-center gap-1.5"
                        >
                            <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                            <span>Gunakan Tema</span>
                        </a>
                    </div>
                </div>
            @empty
                @if($totalOwned === 0)
                    <!-- EMPTY STATE: USER HAS NOT PURCHASED ANY THEMES -->
                    <div class="col-span-full p-8 sm:p-10 rounded-2xl glass-panel border border-sand-200/80 text-center space-y-3">
                        <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-600 border border-amber-500/20 flex items-center justify-center font-bold text-2xl mx-auto shadow-sm">
                            🎨
                        </div>
                        <div class="space-y-1.5 max-w-md mx-auto">
                            <h3 class="font-serif text-xl font-bold text-charcoal-950">Belum Ada Tema yang Dibeli</h3>
                            <p class="text-xs text-sand-600 leading-relaxed">
                                Anda belum memiliki tema undangan digital yang aktif. Silakan jelajahi katalog tema kami, pilih desain terbaik untuk hari bahagia Anda, dan selesaikan pembayaran mulai Rp 49.000.
                            </p>
                        </div>
                        <div class="pt-1">
                            <a href="{{ route('themes.catalog') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-600 via-amber-700 to-brand-700 hover:from-amber-700 hover:to-brand-800 text-white font-bold text-xs shadow hover:scale-105 transition duration-200">
                                <i data-lucide="shopping-bag" class="w-3.5 h-3.5"></i>
                                <span>Jelajahi Katalog Tema (Mulai Rp 49.000)</span>
                            </a>
                        </div>
                    </div>
                @else
                    <!-- EMPTY STATE: NO THEMES MATCHING FILTER/SEARCH -->
                    <div class="col-span-full p-8 rounded-2xl glass-panel border border-sand-200/80 text-center space-y-2.5">
                        <div class="w-10 h-10 rounded-full bg-sand-100 text-sand-500 mx-auto flex items-center justify-center font-bold">
                            <i data-lucide="palette" class="w-5 h-5"></i>
                        </div>
                        <div class="space-y-0.5">
                            <h3 class="font-serif text-base font-bold text-charcoal-950">Tema Tidak Ditemukan</h3>
                            <p class="text-xs text-sand-500">Tidak ada tema milik Anda yang cocok dengan kata kunci pencarian.</p>
                        </div>
                        <a href="{{ route('member.themes.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-charcoal-900 text-white font-bold text-xs hover:bg-charcoal-800 transition">
                            Reset Filter
                        </a>
                    </div>
                @endif
            @endforelse
        </div>

    </div>
</x-member-layout>
