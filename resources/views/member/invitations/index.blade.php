<x-member-layout>
    <div class="space-y-3 sm:space-y-3.5" x-data="{ toast: { show: false, message: '' }, copyLink(url) { navigator.clipboard.writeText(url); this.toast.message = 'Link undangan berhasil disalin!'; this.toast.show = true; setTimeout(() => this.toast.show = false, 3000); } }">
        
        <!-- TOAST NOTIFICATION -->
        <div 
            x-show="toast.show" 
            x-transition 
            class="fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl bg-charcoal-950 text-white text-xs font-bold shadow-2xl flex items-center gap-2 border border-brand-500/40"
            style="display: none;"
        >
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
            <span x-text="toast.message"></span>
        </div>

        <!-- PAGE HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">Data Undangan Pernikahan</h1>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-brand-500/10 text-brand-800 text-[10px] font-bold uppercase tracking-wider border border-brand-500/20">Undangan Saya</span>
                </div>
                <p class="text-xs text-sand-600">
                    Kelola website undangan digital Anda, status online, serta tautan tamu undangan.
                </p>
            </div>

            <a href="{{ route('member.invitations.create') }}" class="px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs shadow hover:shadow-brand-500/25 hover:scale-105 transition flex items-center justify-center gap-1.5 self-start sm:self-auto">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                <span>Buat Undangan Baru</span>
            </a>
        </div>

        <!-- SUCCESS ALERT -->
        @if (session('success'))
            <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-xs">
                        <i data-lucide="check" class="w-3 h-3"></i>
                    </div>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- ERROR ALERT -->
        @if (session('error'))
            <div class="p-2.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-xs flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded-full bg-rose-500 text-white flex items-center justify-center font-bold text-xs">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    </div>
                    <span class="font-semibold">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- INFO KUOTA TEMA TERPAKAI -->
        @if (isset($availableThemesCount) && $availableThemesCount === 0 && !auth()->user()->isSuperAdmin() && $invitations->isNotEmpty())
            <div class="p-3 rounded-xl bg-brand-500/10 border border-brand-500/20 text-brand-900 text-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4 text-brand-600 flex-shrink-0"></i>
                    <span>Setiap lisensi tema hanya berlaku untuk 1 undangan. Semua tema aktif Anda sudah terpakai.</span>
                </div>
                <a href="{{ route('themes.catalog') }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-charcoal-950 text-brand-300 font-bold text-[11px] hover:bg-charcoal-900 transition shrink-0">
                    <i data-lucide="shopping-bag" class="w-3 h-3"></i>
                    <span>Beli Tema Baru</span>
                </a>
            </div>
        @endif

        <!-- COMPACT STATS TILES -->
        <div class="grid grid-cols-3 gap-2">
            <div class="p-2 sm:p-2.5 rounded-xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-sand-500 block">Total Undangan</span>
                    <div class="font-serif text-base font-bold text-charcoal-950">{{ $invitations->total() }} <span class="text-[11px] font-sans text-sand-400 font-normal">Website</span></div>
                </div>
                <div class="w-6 h-6 rounded-lg bg-brand-50 text-brand-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="mail" class="w-3.5 h-3.5"></i>
                </div>
            </div>

            <div class="p-2 sm:p-2.5 rounded-xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-emerald-700 block">Status Online</span>
                    <div class="font-serif text-base font-bold text-emerald-600">{{ $totalActive }} <span class="text-[11px] font-sans text-emerald-500 font-normal">Aktif</span></div>
                </div>
                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="globe" class="w-3.5 h-3.5"></i>
                </div>
            </div>

            <div class="p-2 sm:p-2.5 rounded-xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-amber-700 block">Draft Disimpan</span>
                    <div class="font-serif text-base font-bold text-amber-600">{{ $totalDraft }} <span class="text-[11px] font-sans text-amber-500 font-normal">Draft</span></div>
                </div>
                <div class="w-6 h-6 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
                </div>
            </div>
        </div>

        <!-- COMPACT SEARCH TOOLBAR -->
        <div class="p-2 sm:p-2.5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm">
            <form method="GET" action="{{ route('member.invitations.index') }}" class="flex flex-col sm:flex-row items-center gap-2">
                <div class="relative w-full">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari judul undangan atau tautan slug..." 
                        class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-sand-200 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 text-xs bg-white placeholder-sand-400"
                    >
                    <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    </div>
                </div>
                <button type="submit" class="w-full sm:w-auto px-3.5 py-1.5 rounded-xl bg-charcoal-900 text-white font-bold text-xs hover:bg-charcoal-800 transition shrink-0">
                    Filter
                </button>
                @if(request('search'))
                    <a href="{{ route('member.invitations.index') }}" class="px-3 py-2 rounded-xl bg-sand-100 text-sand-600 hover:text-charcoal-900 text-xs font-semibold transition shrink-0">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- INVITATIONS LIST -->
        <div class="space-y-3">
            @forelse($invitations as $invitation)
                @php
                    $groom = $invitation->couples->where('role', 'groom')->first();
                    $bride = $invitation->couples->where('role', 'bride')->first();
                    $firstEvent = $invitation->events->first();
                    $eventDate = $firstEvent 
                        ? \Carbon\Carbon::parse($firstEvent->date)->isoFormat('dddd, D MMMM Y') 
                        : ($invitation->event_date ? \Carbon\Carbon::parse($invitation->event_date)->isoFormat('dddd, D MMMM Y') : null);
                    $guestsCount = $invitation->guests_count ?? $invitation->guests->count();
                    $wishesCount = $invitation->wishes_count ?? $invitation->wishes()->count();
                @endphp
                <div class="p-4 sm:p-5 lg:p-6 rounded-2xl sm:rounded-3xl bg-white border border-sand-200/90 shadow-xs hover:shadow-md hover:border-brand-500/30 transition-all duration-300 relative group overflow-hidden">
                    <!-- Top subtle accent hairline gradient on hover -->
                    <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-brand-500 via-amber-400 to-brand-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 sm:gap-5">
                        
                        <!-- LEFT: THUMBNAIL & MAIN INFO -->
                        <div class="flex items-start sm:items-center gap-4 sm:gap-5 flex-1 min-w-0">
                            
                            <!-- Cover thumbnail -->
                            <div class="relative w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 rounded-2xl overflow-hidden shrink-0 bg-sand-100 border border-sand-200 shadow-2xs group-hover:shadow-sm transition-all duration-300">
                                @if($invitation->cover_image)
                                    <img src="{{ $invitation->cover_image }}" alt="{{ $invitation->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-sand-100 to-sand-200 text-brand-800 p-2 text-center">
                                        <i data-lucide="image" class="w-6 h-6 text-sand-400 mb-1"></i>
                                        <span class="font-serif font-bold text-[10px] uppercase tracking-wider text-charcoal-700">Foto Cover</span>
                                    </div>
                                @endif

                                <!-- Status Badge overlay for mobile view -->
                                <div class="absolute bottom-1.5 left-1.5 right-1.5 sm:hidden">
                                    <span class="w-full inline-flex items-center justify-center gap-1 px-1.5 py-0.5 rounded-md text-[9px] font-bold backdrop-blur-md {{ $invitation->is_published ? 'bg-emerald-950/80 text-emerald-300 border border-emerald-500/30' : 'bg-charcoal-950/80 text-amber-300 border border-amber-500/30' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $invitation->is_published ? 'bg-emerald-400 animate-pulse' : 'bg-amber-400' }}"></span>
                                        {{ $invitation->is_published ? 'ONLINE' : 'DRAFT' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content column -->
                            <div class="space-y-1.5 sm:space-y-2 min-w-0 flex-1">
                                
                                <!-- Row 1: Title & Status Badge -->
                                <div class="flex items-center gap-2.5 flex-wrap">
                                    <h3 class="font-serif text-base sm:text-lg lg:text-xl font-bold text-charcoal-950 group-hover:text-brand-700 transition-colors truncate" title="{{ $invitation->title }}">
                                        {{ $invitation->title }}
                                    </h3>
                                    
                                    <span class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold border {{ $invitation->is_published ? 'bg-emerald-50 text-emerald-700 border-emerald-200/80' : 'bg-amber-50 text-amber-700 border-amber-200/80' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $invitation->is_published ? 'bg-emerald-500 animate-pulse' : 'bg-amber-500' }}"></span>
                                        {{ $invitation->is_published ? 'Online' : 'Draf' }}
                                    </span>
                                </div>

                                <!-- Row 2: Couple Names & Event Date -->
                                <div class="flex items-center gap-y-1 gap-x-3 text-xs sm:text-sm text-sand-600 flex-wrap">
                                    @if($groom && $bride)
                                        <div class="inline-flex items-center gap-1.5 font-bold text-charcoal-900">
                                            <i data-lucide="heart" class="w-3.5 h-3.5 text-rose-500 fill-rose-500/20 shrink-0"></i>
                                            <span>{{ $groom->nickname ?? $groom->full_name }} &amp; {{ $bride->nickname ?? $bride->full_name }}</span>
                                        </div>
                                    @endif

                                    @if($eventDate)
                                        @if($groom && $bride)
                                            <span class="text-sand-300 hidden sm:inline">•</span>
                                        @endif
                                        <div class="inline-flex items-center gap-1.5 text-sand-600 text-xs">
                                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-sand-400 shrink-0"></i>
                                            <span>{{ $eventDate }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Row 3: Meta badges (Theme, Guests, Wishes) -->
                                <div class="flex items-center gap-2 flex-wrap pt-0.5">
                                    @if($invitation->theme)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-sand-100/70 text-charcoal-800 text-[11px] font-medium border border-sand-200/70">
                                            <i data-lucide="palette" class="w-3 h-3 text-brand-600"></i>
                                            <span>Tema: <strong class="text-charcoal-950 font-bold">{{ $invitation->theme->name }}</strong></span>
                                        </span>
                                    @endif

                                    <a href="{{ route('member.guests.index', ['invitation_id' => $invitation->id]) }}" 
                                       class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-brand-50 hover:bg-brand-100 text-brand-900 text-[11px] font-semibold border border-brand-200/60 transition"
                                       title="Kelola buku tamu undangan">
                                        <i data-lucide="users" class="w-3 h-3 text-brand-600"></i>
                                        <span>{{ $guestsCount }} Tamu</span>
                                    </a>

                                    @if($wishesCount > 0)
                                        <a href="{{ route('member.wishes.index') }}" 
                                           class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-purple-50 hover:bg-purple-100 text-purple-900 text-[11px] font-semibold border border-purple-200/60 transition"
                                           title="Lihat doa restu dan ucapan tamu">
                                            <i data-lucide="message-square" class="w-3 h-3 text-purple-600"></i>
                                            <span>{{ $wishesCount }} Ucapan</span>
                                        </a>
                                    @endif
                                </div>

                                <!-- Row 4: Public URL with 1-click Copy bar -->
                                <div class="pt-1">
                                    <div 
                                        x-data="{ copied: false, link: '{{ route('invitation.show', $invitation->slug) }}' }"
                                        @click="navigator.clipboard.writeText(link); copied = true; setTimeout(() => copied = false, 2500)"
                                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-sand-50/80 hover:bg-sand-100 border border-sand-200/90 hover:border-brand-400 text-xs text-charcoal-700 cursor-pointer transition-all max-w-full sm:max-w-md group/copy shadow-2xs"
                                        title="Klik untuk menyalin link website undangan"
                                    >
                                        <i data-lucide="link" class="w-3.5 h-3.5 text-brand-600 shrink-0 group-hover/copy:scale-110 transition-transform"></i>
                                        <span class="font-mono text-[11px] text-brand-900 truncate" x-text="copied ? '✓ Tautan undangan berhasil disalin!' : link"></span>
                                        <span 
                                            class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md transition-all shrink-0 shadow-2xs"
                                            :class="copied ? 'bg-emerald-600 text-white' : 'bg-sand-200 text-charcoal-800 group-hover/copy:bg-brand-600 group-hover/copy:text-white'"
                                            x-text="copied ? 'Tersalin' : 'Salin'"
                                        ></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- RIGHT: REFINED COHESIVE ACTION BUTTONS -->
                        <div class="flex items-center justify-start lg:justify-end gap-2 pt-3 lg:pt-0 border-t border-sand-100 lg:border-t-0 shrink-0 flex-wrap">
                            
                            <!-- Lihat Website -->
                            <a 
                                href="{{ route('invitation.show', $invitation->slug) }}" 
                                target="_blank"
                                class="px-3.5 sm:px-4 py-2.5 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white text-xs font-bold transition-all shadow-xs hover:shadow flex items-center gap-1.5 active:scale-95"
                                title="Buka website undangan di tab baru"
                            >
                                <i data-lucide="external-link" class="w-3.5 h-3.5 text-brand-400"></i>
                                <span>Lihat Website</span>
                            </a>

                            <!-- Edit Undangan -->
                            <a 
                                href="{{ route('member.invitations.edit', $invitation) }}" 
                                class="px-3.5 sm:px-4 py-2.5 rounded-xl bg-white hover:bg-sand-50 text-charcoal-900 text-xs font-bold transition-all border border-sand-300 shadow-2xs hover:shadow-xs flex items-center gap-1.5 active:scale-95"
                                title="Edit data & konten undangan"
                            >
                                <i data-lucide="pencil" class="w-3.5 h-3.5 text-amber-600"></i>
                                <span>Edit Undangan</span>
                            </a>

                            <!-- Kelola Tamu -->
                            <a 
                                href="{{ route('member.guests.index', ['invitation_id' => $invitation->id]) }}" 
                                class="px-3.5 sm:px-4 py-2.5 rounded-xl bg-brand-50 hover:bg-brand-100 text-brand-900 text-xs font-bold transition-all border border-brand-200/80 shadow-2xs hover:shadow-xs flex items-center gap-1.5 active:scale-95"
                                title="Kelola daftar tamu dan sebar undangan WhatsApp"
                            >
                                <i data-lucide="users" class="w-3.5 h-3.5 text-brand-700"></i>
                                <span>Kelola Tamu</span>
                            </a>

                            <!-- Hapus Undangan -->
                            <form method="POST" action="{{ route('member.invitations.destroy', $invitation) }}" data-confirm="Apakah Anda yakin ingin menghapus undangan ini? Seluruh data tamu dan acara terkait akan terhapus." data-confirm-title="Hapus Undangan?" class="inline">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="p-2.5 rounded-xl text-sand-400 hover:text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-200 transition-all flex items-center justify-center active:scale-95"
                                    title="Hapus Undangan"
                                >
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @empty
                <div class="p-12 rounded-3xl glass-panel border border-sand-200/80 text-center space-y-4">
                    <div class="w-16 h-16 rounded-full bg-brand-100 text-brand-700 mx-auto flex items-center justify-center font-bold">
                        <i data-lucide="heart" class="w-8 h-8"></i>
                    </div>
                    <div class="space-y-1 max-w-md mx-auto">
                        <h3 class="font-serif text-lg font-bold text-charcoal-950">Belum Ada Undangan</h3>
                        <p class="text-xs text-sand-600">
                            Anda belum membuat website undangan pernikahan. Buat sekarang dan sebarkan kebahagiaan Anda kepada seluruh keluarga & kerabat!
                        </p>
                    </div>
                    <a href="{{ route('member.invitations.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs shadow-lg hover:shadow-brand-500/25 transition">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>Mulai Buat Undangan Pertama</span>
                    </a>
                </div>
            @endforelse

            <div class="pt-4">
                {{ $invitations->links() }}
            </div>
        </div>

        <!-- SECTION ANCHORS: AMPLOP DIGITAL & GALERI CERITA -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
            <div id="amplop-digital" class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-brand-100 text-brand-700 flex items-center justify-center">
                        <i data-lucide="wallet" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-serif font-bold text-charcoal-950">Amplop Digital & QRIS</h4>
                        <p class="text-[11px] text-sand-500">Rekening transfer dan QRIS langsung terhubung di halaman undangan.</p>
                    </div>
                </div>
                <p class="text-xs text-sand-600 leading-relaxed">
                    Pengaturan nomor rekening bank atau e-wallet otomatis tercantum di undangan pernikahan Anda saat Anda mengisi form undangan. Tamu dapat menyalin nomor rekening dengan sekali klik.
                </p>
            </div>

            <div id="galeri-cerita" class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center">
                        <i data-lucide="image" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-serif font-bold text-charcoal-950">Galeri Foto & Musik Romantis</h4>
                        <p class="text-[11px] text-sand-500">Momen prewedding & backsound lagu romantis.</p>
                    </div>
                </div>
                <p class="text-xs text-sand-600 leading-relaxed">
                    Setiap undangan dilengkapi dengan pemutar musik latar romantis serta album foto prewedding berkualitas tinggi yang tampil memukau di perangkat mobile maupun desktop tamu.
                </p>
            </div>
        </div>

    </div>
</x-member-layout>
