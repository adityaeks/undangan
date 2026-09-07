<x-app-layout>
    <div class="space-y-6">
        
        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">Katalog Tema & Kustomisasi Gaya</h1>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">Super Admin</span>
                </div>
                <p class="text-xs text-sand-600 mt-1">
                    Kelola template undangan pernikahan dan atur tema mana saja yang tersedia langsung untuk digunakan oleh Partner & WO.
                </p>
            </div>

            <!-- STATS SUMMARY -->
            <div class="flex flex-wrap items-center gap-2.5">
                <div class="flex items-center gap-2 text-xs font-bold text-charcoal-950 bg-sand-200/80 px-3.5 py-2 rounded-2xl shadow-sm">
                    <i data-lucide="palette" class="w-4 h-4 text-brand-700"></i>
                    <span>{{ $totalThemes }} Total Tema</span>
                </div>
                <div class="flex items-center gap-2 text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-3.5 py-2 rounded-2xl shadow-sm">
                    <i data-lucide="briefcase" class="w-4 h-4 text-emerald-600"></i>
                    <span>{{ $totalPartner }} Tersedia untuk Partner</span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2 shadow-sm">
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- THEMES GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($themes as $theme)
                @php
                    $meta = $theme->metadata ?? [];
                    $colors = $meta['colors'] ?? ['#2A2824', '#C2AA7D', '#FAF8F5'];
                    $typography = $meta['typography'] ?? 'Plus Jakarta Sans';
                    $description = $meta['description'] ?? 'Desain tema undangan digital elegan, modern, dan responsif.';
                    $demoUrl = route('demo.show', ['slug' => $theme->slug]);
                @endphp

                <div class="group rounded-3xl glass-panel border border-sand-200 hover:border-brand-400/80 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden bg-white/95">
                    
                    <!-- THUMBNAIL WRAPPER -->
                    <div class="relative aspect-[16/10] overflow-hidden bg-charcoal-950">
                        <img 
                            src="{{ $theme->thumbnail }}" 
                            alt="{{ $theme->name }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950/85 via-charcoal-950/20 to-transparent"></div>

                        <!-- TOP BADGES -->
                        <div class="absolute top-3 inset-x-3 flex items-center justify-between pointer-events-none">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider shadow {{ $theme->is_active ? 'bg-emerald-600 text-white' : 'bg-rose-600 text-white' }}">
                                {{ $theme->is_active ? '● Aktif' : '● Nonaktif' }}
                            </span>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold shadow {{ $theme->is_for_partner ? 'bg-amber-400 text-charcoal-950' : 'bg-charcoal-900/80 text-sand-300' }}">
                                <i data-lucide="briefcase" class="w-3 h-3 inline mr-0.5"></i>
                                {{ $theme->is_for_partner ? 'Partner: Aktif' : 'Partner: Off' }}
                            </span>
                        </div>

                        <!-- BOTTOM OVERLAY (PALETTE & DEMO) -->
                        <div class="absolute bottom-3 inset-x-3 flex items-center justify-between">
                            <div class="flex items-center gap-1.5 bg-charcoal-950/70 backdrop-blur-md px-2.5 py-1 rounded-full border border-white/10">
                                <span class="text-[9px] text-white/70 font-bold uppercase">Palet:</span>
                                <div class="flex items-center -space-x-1">
                                    @foreach ($colors as $color)
                                        <span style="background-color: {{ $color }};" class="w-3.5 h-3.5 rounded-full border border-charcoal-950 shadow-sm"></span>
                                    @endforeach
                                </div>
                            </div>

                            <a 
                                href="{{ $demoUrl }}" 
                                target="_blank" 
                                class="px-3 py-1 rounded-full bg-white text-charcoal-950 font-bold text-[11px] shadow-md hover:bg-sand-100 transition flex items-center gap-1"
                            >
                                <i data-lucide="play" class="w-3 h-3 fill-current"></i>
                                <span>Preview Live</span>
                            </a>
                        </div>
                    </div>

                    <!-- BODY -->
                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-[11px]">
                                <span class="font-bold tracking-wider text-brand-700 uppercase">{{ ucfirst($theme->category) }}</span>
                                <span class="px-2 py-0.5 rounded-full bg-sand-100 text-charcoal-800 font-semibold text-[10px]">
                                    {{ $theme->invitations_count ?? 0 }} Undangan Dibuat
                                </span>
                            </div>

                            <h3 class="font-serif text-lg font-bold text-charcoal-950 group-hover:text-brand-600 transition-colors leading-snug">
                                {{ $theme->name }}
                            </h3>

                            <p class="text-xs text-sand-600 line-clamp-2 leading-relaxed">
                                {{ $description }}
                            </p>

                            <div class="pt-2 flex items-center justify-between text-[11px] text-sand-500 border-t border-sand-100">
                                <div class="flex items-center gap-1 truncate">
                                    <i data-lucide="type" class="w-3 h-3 text-sand-400 shrink-0"></i>
                                    <span class="truncate">{{ $typography }}</span>
                                </div>
                                <span class="text-[10px] text-sand-400 font-medium shrink-0">Slug: {{ $theme->slug }}</span>
                            </div>
                        </div>

                        <!-- PARTNER ACCESS TOGGLE & ADMIN ACTIONS -->
                        <div class="pt-3 border-t border-sand-200 space-y-2">
                            <div class="flex items-center justify-between gap-2">
                                <span class="text-[11px] font-bold text-charcoal-900">Akses Khusus Partner:</span>
                                @if($theme->is_for_partner)
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md">
                                        <i data-lucide="check" class="w-3 h-3"></i> Tersedia
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-sand-500 bg-sand-100 px-2 py-0.5 rounded-md">
                                        <i data-lucide="x" class="w-3 h-3"></i> Tidak Tersedia
                                    </span>
                                @endif
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <!-- TOGGLE FOR PARTNER -->
                                <form action="{{ route('admin.themes.toggle-partner', $theme) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button 
                                        type="submit" 
                                        class="w-full py-2 px-2.5 rounded-xl text-xs font-bold text-center transition flex items-center justify-center gap-1.5 {{ $theme->is_for_partner ? 'bg-amber-100 hover:bg-amber-200 text-amber-900' : 'bg-sand-100 hover:bg-amber-600 hover:text-white text-charcoal-900' }}"
                                        title="{{ $theme->is_for_partner ? 'Cabut template dari Partner' : 'Sediakan template untuk Partner' }}"
                                    >
                                        <i data-lucide="briefcase" class="w-3.5 h-3.5"></i>
                                        <span>{{ $theme->is_for_partner ? 'Batal Partner' : '+ Beri ke Partner' }}</span>
                                    </button>
                                </form>

                                <!-- TOGGLE STATUS TEMA -->
                                <form action="{{ route('admin.themes.toggle', $theme) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button 
                                        type="submit" 
                                        class="w-full py-2 px-2.5 rounded-xl text-xs font-bold text-center transition flex items-center justify-center gap-1.5 {{ $theme->is_active ? 'bg-rose-50 hover:bg-rose-100 text-rose-800' : 'bg-emerald-50 hover:bg-emerald-100 text-emerald-800' }}"
                                    >
                                        <i data-lucide="power" class="w-3.5 h-3.5"></i>
                                        <span>{{ $theme->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-sand-400">
                    Tidak ada data tema ditemukan.
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
