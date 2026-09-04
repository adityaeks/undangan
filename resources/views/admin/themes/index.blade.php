<x-app-layout>
    <div class="space-y-8">
        
        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">
                    <span>Koleksi Tema Desain 2026</span>
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                    Katalog Tema & Kustomisasi Gaya
                </h1>
                <p class="text-xs text-sand-600">
                    Pilihan arsitektur desain template eksklusif dengan tata letak visual modern, interaktif, dan responsif.
                </p>
            </div>

            <div class="flex items-center gap-2 text-xs font-bold text-charcoal-950 bg-sand-200/80 px-4 py-2.5 rounded-2xl">
                <span>3 Seri Tema Pilihan • Siap Pakai</span>
            </div>
        </div>

        @php
            $themeCards = [
                [
                    'number' => 'Tema Desain 01',
                    'title' => 'The Vogue Editorial Issue',
                    'layout_format' => 'Vogue Editorial Magazine',
                    'category_name' => 'Modern Dark Studio',
                    'tag' => '★ Tren 2026 • Editorial',
                    'tag_bg' => 'bg-amber-500 text-charcoal-950',
                    'thumbnail' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=800&auto=format&fit=crop&q=80',
                    'colors' => ['#0A0C13', '#121624', '#38BDF8'],
                    'description' => 'Tata letak majalah high-fashion dengan Bento Grid acara, timeline kartu horizontal, dan Dynamic Island audio.',
                    'typography' => 'Cinzel + Cormorant',
                    'demo_url' => route('demo.index', ['layout' => 'editorial', 'style' => 'modern']),
                ],
                [
                    'number' => 'Tema Desain 02',
                    'title' => 'The Ethereal Botanical Glass',
                    'layout_format' => 'Ethereal Botanical Glass',
                    'category_name' => 'Sage Botanical & Rustic',
                    'tag' => '🌿 Organic & Glass',
                    'tag_bg' => 'bg-emerald-600 text-white',
                    'thumbnail' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=80',
                    'colors' => ['#F4F7F4', '#1D3328', '#3E6F56'],
                    'description' => 'Bingkai lengkung arsitektural (arch geometry), kartu kaca buram (frosted glass), dan pemutar piringan hitam vinyl.',
                    'typography' => 'Italiana + Cormorant',
                    'demo_url' => route('demo.index', ['layout' => 'botanical', 'style' => 'botanical']),
                ],
                [
                    'number' => 'Tema Desain 03',
                    'title' => 'The Timeless Classic Card',
                    'layout_format' => 'Classic Elegant Card',
                    'category_name' => 'Nusantara Adat',
                    'tag' => '👑 Timeless Simplicity',
                    'tag_bg' => 'bg-slate-800 text-amber-300',
                    'thumbnail' => 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=800&auto=format&fit=crop&q=80',
                    'colors' => ['#FDF8F2', '#2B0E11', '#B67E22'],
                    'description' => 'Format kartu vertikal bertingkat rapi, cover amplop pembuka melayang, countdown timer card, dan ornamen batik songket.',
                    'typography' => 'Playfair + Plus Jakarta',
                    'demo_url' => route('demo.index', ['layout' => 'classic', 'style' => 'nusantara']),
                ],
            ];
        @endphp

        <!-- THEMES GRID (COMPACT CARDS) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($themeCards as $theme)
                <div class="group rounded-3xl glass-panel border border-sand-200 hover:border-brand-400/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden bg-white/90">
                    <!-- THUMBNAIL WRAPPER -->
                    <div class="relative aspect-[16/10] overflow-hidden bg-charcoal-950">
                        <img 
                            src="{{ $theme['thumbnail'] }}" 
                            alt="{{ $theme['title'] }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950/85 via-charcoal-950/20 to-transparent"></div>

                        <!-- TOP BADGES -->
                        <div class="absolute top-3 inset-x-3 flex items-center justify-between pointer-events-none">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider shadow {{ $theme['tag_bg'] }}">
                                {{ $theme['tag'] }}
                            </span>
                            <span class="px-2.5 py-1 rounded-full bg-white/95 backdrop-blur-md text-emerald-800 text-[10px] font-bold shadow">
                                Rp 49.000
                            </span>
                        </div>

                        <!-- BOTTOM OVERLAY (PALETTE & PREVIEW LIVE) -->
                        <div class="absolute bottom-3 inset-x-3 flex items-center justify-between">
                            <div class="flex items-center gap-1.5 bg-charcoal-950/70 backdrop-blur-md px-2.5 py-1 rounded-full border border-white/10">
                                <span class="text-[9px] text-white/70 font-bold uppercase">Palet:</span>
                                <div class="flex items-center -space-x-1">
                                    @foreach ($theme['colors'] as $color)
                                        <span style="background-color: {{ $color }};" class="w-3.5 h-3.5 rounded-full border border-charcoal-950 shadow-sm"></span>
                                    @endforeach
                                </div>
                            </div>

                            <a 
                                href="{{ $theme['demo_url'] }}" 
                                target="_blank" 
                                class="px-3 py-1 rounded-full bg-white text-charcoal-950 font-bold text-[11px] shadow-md hover:bg-sand-100 hover:scale-105 transition flex items-center gap-1"
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
                                <span class="font-bold tracking-wider text-brand-700 uppercase">{{ $theme['number'] }}</span>
                                <span class="px-2 py-0.5 rounded-full bg-sand-100 text-charcoal-800 font-semibold text-[10px]">
                                    {{ $theme['category_name'] }}
                                </span>
                            </div>

                            <h3 class="font-serif text-lg font-bold text-charcoal-950 group-hover:text-brand-600 transition-colors leading-snug">
                                {{ $theme['title'] }}
                            </h3>

                            <p class="text-xs text-sand-600 line-clamp-2 leading-relaxed">
                                {{ $theme['description'] }}
                            </p>

                            <div class="pt-2 flex items-center justify-between text-[11px] text-sand-500 border-t border-sand-100">
                                <div class="flex items-center gap-1 truncate">
                                    <i data-lucide="type" class="w-3 h-3 text-sand-400 shrink-0"></i>
                                    <span class="truncate">{{ $theme['typography'] }}</span>
                                </div>
                                <span class="text-[10px] text-sand-400 font-medium shrink-0">{{ $theme['layout_format'] }}</span>
                            </div>
                        </div>

                        <!-- ACTIONS -->
                        <div class="pt-3 border-t border-sand-200 flex items-center gap-2">
                            <a 
                                href="{{ $theme['demo_url'] }}" 
                                target="_blank" 
                                class="flex-1 py-2 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 font-bold text-xs text-center transition flex items-center justify-center gap-1.5"
                            >
                                <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                <span>Demo</span>
                            </a>
                            <a 
                                href="{{ route('invitations.create') }}" 
                                class="flex-1 py-2 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white font-bold text-xs text-center shadow transition flex items-center justify-center gap-1.5"
                            >
                                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                                <span>Pilih Tema</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
