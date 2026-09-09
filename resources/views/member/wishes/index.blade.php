<x-member-layout>
    <div class="space-y-4">
        
        <!-- PAGE HEADER & STATS BAR -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div class="space-y-0.5">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-rose-500/10 text-rose-800 text-[10px] font-bold uppercase tracking-wider border border-rose-500/20">
                    <i data-lucide="message-square-heart" class="w-3 h-3 text-rose-600"></i>
                    <span>Portal Pengantin • Buku Tamu</span>
                </div>
                <h1 class="font-serif text-xl sm:text-2xl font-bold text-charcoal-950">
                    Buku Tamu &amp; Doa Restu
                </h1>
                <p class="text-xs text-sand-600">
                    Kumpulan doa tulus, ucapan selamat, dan respon kehadiran dari para tamu.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <!-- COMPACT STAT PILLS -->
                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/90 border border-sand-200 shadow-sm text-xs">
                    <i data-lucide="heart" class="w-3.5 h-3.5 text-rose-500"></i>
                    <span class="text-sand-500 font-medium">Total Doa:</span>
                    <span class="font-bold text-charcoal-950">{{ $totalWishes }}</span>
                </div>

                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/90 border border-sand-200 shadow-sm text-xs">
                    <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-600"></i>
                    <span class="text-sand-500 font-medium">Hadir:</span>
                    <span class="font-bold text-emerald-700">{{ $totalAttending }}</span>
                </div>

                @if($primaryInvitation)
                    <a 
                        href="{{ route('invitation.show', $primaryInvitation->slug) }}" 
                        target="_blank"
                        class="px-3.5 py-1.5 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 font-bold text-xs transition flex items-center gap-1.5 shadow-sm"
                    >
                        <i data-lucide="external-link" class="w-3.5 h-3.5 text-brand-600"></i>
                        <span>Lihat Undangan</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- SEARCH & FILTERS (COMPACT TOOLBAR) -->
        <div class="p-2.5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm">
            <form method="GET" action="{{ route('member.wishes.index') }}" class="flex flex-col sm:flex-row items-center gap-2">
                <div class="relative w-full">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari pengirim atau isi pesan doa..." 
                        class="w-full pl-9 pr-3 py-2 rounded-xl border border-sand-200 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 text-xs bg-white placeholder-sand-400"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    </div>
                </div>

                <div class="w-full sm:w-auto flex items-center gap-2 shrink-0">
                    <select 
                        name="attendance" 
                        class="w-full sm:w-36 px-3 py-2 rounded-xl border border-sand-200 text-xs font-medium bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500"
                    >
                        <option value="all">Semua Respon</option>
                        <option value="hadir" {{ request('attendance') === 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="tidak" {{ request('attendance') === 'tidak' ? 'selected' : '' }}>Tidak Hadir</option>
                    </select>

                    <button type="submit" class="px-4 py-2 rounded-xl bg-charcoal-900 text-white font-bold text-xs hover:bg-charcoal-800 transition shrink-0">
                        Filter
                    </button>
                    @if(request('search') || (request('attendance') && request('attendance') !== 'all'))
                        <a href="{{ route('member.wishes.index') }}" class="px-3 py-2 rounded-xl bg-sand-100 text-sand-600 hover:text-charcoal-900 text-xs font-semibold transition shrink-0">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- WISHES LIST -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @forelse($wishes as $wish)
                <div class="p-4 sm:p-5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition space-y-2.5 flex flex-col justify-between">
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-brand-100 text-brand-800 font-bold text-xs flex items-center justify-center">
                                    {{ strtoupper(substr($wish->sender_name ?? 'T', 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-xs text-charcoal-950">{{ $wish->sender_name }}</h4>
                                    <span class="text-[10px] text-sand-400 block">{{ $wish->created_at ? $wish->created_at->diffForHumans() : 'Baru saja' }}</span>
                                </div>
                            </div>

                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ str_contains(strtolower($wish->attendance_status ?? ''), 'hadir') && !str_contains(strtolower($wish->attendance_status ?? ''), 'tidak') ? 'bg-emerald-100 text-emerald-800' : 'bg-sand-200 text-sand-700' }}">
                                {{ ucfirst($wish->attendance_status ?? 'Hadir') }}
                            </span>
                        </div>

                        <p class="text-xs text-charcoal-800/90 leading-relaxed italic font-editorial text-sm pt-0.5">
                            "{{ $wish->message }}"
                        </p>
                    </div>

                    @if($wish->invitation)
                        <div class="pt-2 border-t border-sand-100 text-[10px] text-sand-500">
                            Undangan: <span class="font-semibold text-charcoal-800">{{ $wish->invitation->title }}</span>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full p-8 sm:p-10 rounded-2xl glass-panel border border-sand-200/80 text-center space-y-2">
                    <div class="w-10 h-10 rounded-full bg-rose-50 text-rose-400 mx-auto flex items-center justify-center">
                        <i data-lucide="message-square-heart" class="w-5 h-5"></i>
                    </div>
                    <p class="font-serif font-bold text-charcoal-900 text-sm">Belum Ada Ucapan Masuk</p>
                    <p class="text-xs text-sand-500 max-w-sm mx-auto leading-relaxed">
                        Saat tamu membuka website undangan dan menuliskan ucapan di buku tamu digital, pesan mereka akan langsung muncul di sini.
                    </p>
                </div>
            @endforelse
        </div>

        @if($wishes->hasPages())
            <div class="pt-1">
                {{ $wishes->links() }}
            </div>
        @endif

    </div>
</x-member-layout>
