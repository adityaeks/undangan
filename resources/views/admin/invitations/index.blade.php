<x-app-layout>
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
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">Daftar Undangan Terdaftar</h1>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">Monitoring</span>
                </div>
                <p class="text-xs text-sand-600">
                    Monitoring seluruh website undangan digital milik pengguna dan partner, periksa tautan publik, serta kelola moderasi publikasi.
                </p>
            </div>
        </div>

        <!-- SUCCESS ALERT -->
        @if (session('success'))
            <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2.5">
                    <div class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-xs">
                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                    </div>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- STATS PILLS -->
        <div class="grid grid-cols-3 gap-2.5">
            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block">Total Undangan</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-charcoal-950">{{ $invitations->total() }} <span class="text-xs font-sans text-sand-400 font-normal hidden sm:inline">Website</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-sand-100 text-charcoal-900 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block">Online / Aktif</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-emerald-600">{{ $totalActive }} <span class="text-xs font-sans text-emerald-500 font-normal hidden sm:inline">Aktif</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700 block">Draft / Offline</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-amber-600">{{ $totalDraft }} <span class="text-xs font-sans text-amber-500 font-normal hidden sm:inline">Draft</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="file-edit" class="w-4 h-4"></i>
                </div>
            </div>
        </div>

        <!-- SEARCH & FILTER BAR -->
        <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-2.5">
            <form method="GET" action="{{ route('invitations.index') }}" class="flex-1 w-full flex flex-col sm:flex-row items-center gap-2">
                <div class="relative w-full sm:max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari judul, nama mempelai, atau slug..." 
                        class="w-full pl-9 pr-3 py-1.5 rounded-xl border border-sand-200 bg-white text-xs text-charcoal-950 placeholder:text-sand-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                    >
                </div>

                <select 
                    name="status" 
                    onchange="this.form.submit()" 
                    class="w-full sm:w-auto px-3 py-1.5 rounded-xl border border-sand-200 bg-white text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500"
                >
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Aktif / Published</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>

                <button type="submit" class="px-4 py-2.5 rounded-xl bg-charcoal-950 text-white text-xs font-bold hover:bg-brand-600 transition">
                    Filter
                </button>
            </form>
        </div>

        <!-- INVITATIONS LIST -->
        <div class="space-y-4">
            @forelse ($invitations as $invitation)
                <div class="p-6 rounded-3xl glass-panel border border-sand-200 shadow-sm hover:shadow-md transition space-y-4">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        
                        <!-- LEFT INFO -->
                        <div class="flex items-start gap-4">
                            <div class="w-20 h-20 rounded-2xl bg-cover bg-center border border-sand-300 shadow-sm flex-shrink-0" style="background-image: url('{{ $invitation->cover_image ?? 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=400' }}');"></div>
                            
                            <div class="space-y-1.5">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">{{ $invitation->title }}</h3>
                                    @if ($invitation->is_published)
                                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase tracking-wider">Online</span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider">Draft</span>
                                    @endif
                                    <span class="px-2.5 py-0.5 rounded-full bg-sand-200 text-sand-800 text-[10px] font-semibold">
                                        Tema: {{ $invitation->theme->name ?? 'Custom' }}
                                    </span>
                                </div>

                                <p class="text-xs text-sand-600">
                                    Pemilik: <strong class="text-charcoal-900">{{ $invitation->owner?->name ?? ($invitation->user?->name ?? 'User') }}</strong>
                                    • Mempelai: <strong class="text-charcoal-900">{{ $invitation->couple->groom_nickname ?? 'Groom' }} & {{ $invitation->couple->bride_nickname ?? 'Bride' }}</strong>
                                    • Tanggal: <strong class="text-charcoal-900">{{ $invitation->event_date ? $invitation->event_date->format('d F Y') : '-' }}</strong>
                                </p>

                                <div class="flex items-center gap-2 pt-1 text-[11px] text-sand-500 font-mono">
                                    <span>Slug: {{ route('invitation.show', $invitation->slug) }}</span>
                                    <button 
                                        type="button" 
                                        @click="copyLink('{{ route('invitation.show', $invitation->slug) }}')"
                                        class="p-1 rounded text-sand-400 hover:text-brand-600 transition"
                                        title="Salin Link"
                                    >
                                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT ACTIONS -->
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank" class="px-4 py-2 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white font-bold text-xs transition flex items-center gap-1.5 shadow">
                                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                <span>Buka</span>
                            </a>

                            <!-- Toggle Status Publikasi -->
                            <form method="POST" action="{{ route('admin.invitations.toggle', $invitation) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-2 rounded-xl border text-xs font-semibold transition {{ $invitation->is_published ? 'border-amber-300 text-amber-800 bg-amber-50 hover:bg-amber-100' : 'border-emerald-300 text-emerald-800 bg-emerald-50 hover:bg-emerald-100' }}">
                                    {{ $invitation->is_published ? 'Tarik (Draft)' : 'Terbitkan' }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('invitations.destroy', $invitation) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus undangan ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 transition flex items-center justify-center" title="Hapus Undangan">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </button>
                            </form>
                        </div>

                    </div>

                    <!-- META CHIPS -->
                    <div class="pt-4 border-t border-sand-200/80 flex flex-wrap items-center justify-between gap-4 text-xs text-sand-600">
                        <div class="flex items-center gap-6">
                            <span>👥 Total Tamu: <strong class="text-charcoal-900">{{ $invitation->guests->count() }} Tamu</strong></span>
                            <span>💍 Agenda Acara: <strong class="text-charcoal-900">{{ $invitation->events->count() }} Sesi</strong></span>
                            <span>🎵 Lagu: <strong class="text-charcoal-900">{{ $invitation->background_music ? 'Kustom' : 'Default' }}</strong></span>
                        </div>
                        <span class="text-[11px] text-sand-400">Dibuat: {{ $invitation->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            @empty
                <div class="p-12 rounded-3xl glass-panel border border-sand-200 text-center space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-sand-200 text-sand-600 flex items-center justify-center mx-auto">
                        <i data-lucide="mail-search" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-base font-bold text-charcoal-950">Tidak Ada Undangan Ditemukan</h3>
                    <p class="text-xs text-sand-500 max-w-sm mx-auto">
                        Belum ada website undangan yang cocok dengan kriteria filter atau pencarian Anda.
                    </p>
                </div>
            @endforelse

            <!-- PAGINATION -->
            <div class="pt-4">
                {{ $invitations->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
