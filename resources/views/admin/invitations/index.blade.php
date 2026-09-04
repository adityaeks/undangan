<x-app-layout>
    <div class="space-y-8" x-data="{ toast: { show: false, message: '' }, copyLink(url) { navigator.clipboard.writeText(url); this.toast.message = 'Link undangan berhasil disalin!'; this.toast.show = true; setTimeout(() => this.toast.show = false, 3000); } }">
        
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
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">
                    <span>Undangan Digital</span>
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                    Daftar Undangan Terdaftar
                </h1>
                <p class="text-xs text-sand-600">
                    Kelola seluruh website undangan digital, status publikasi, dan pengaturan acara.
                </p>
            </div>

            <a href="{{ route('invitations.create') }}" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs shadow-lg hover:shadow-brand-500/20 hover:scale-105 transition flex items-center justify-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Buat Undangan Baru</span>
            </a>
        </div>

        <!-- SUCCESS ALERT -->
        @if (session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold">
                        <i data-lucide="check" class="w-4 h-4"></i>
                    </div>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- STATS PILLS -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="p-5 rounded-2xl glass-panel border border-sand-200 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Total Undangan</span>
                    <div class="font-serif text-2xl font-bold text-charcoal-950">{{ $invitations->total() }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-sand-100 text-charcoal-900 flex items-center justify-center font-bold text-sm">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="p-5 rounded-2xl glass-panel border border-sand-200 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Status Online / Aktif</span>
                    <div class="font-serif text-2xl font-bold text-emerald-600">{{ $totalActive }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-sm">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="p-5 rounded-2xl glass-panel border border-sand-200 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Draft / Belum Publik</span>
                    <div class="font-serif text-2xl font-bold text-amber-600">{{ $totalDraft }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-sm">
                    <i data-lucide="file-edit" class="w-5 h-5"></i>
                </div>
            </div>
        </div>

        <!-- SEARCH & FILTER BAR -->
        <div class="p-4 rounded-2xl glass-panel border border-sand-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <form method="GET" action="{{ route('invitations.index') }}" class="flex-1 w-full flex flex-col sm:flex-row items-center gap-3">
                <div class="relative w-full sm:max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari judul, nama mempelai, atau slug..." 
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-sand-200 bg-sand-50/70 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                    >
                </div>

                <select 
                    name="status" 
                    onchange="this.form.submit()" 
                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-sand-200 bg-sand-50/70 text-xs text-charcoal-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500"
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
                                    Mempelai: <strong class="text-charcoal-900">{{ $invitation->couple->groom_nickname ?? 'Groom' }} & {{ $invitation->couple->bride_nickname ?? 'Bride' }}</strong>
                                    • Tanggal Acara: <strong class="text-charcoal-900">{{ $invitation->event_date ? $invitation->event_date->format('d F Y') : '-' }}</strong>
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
                            <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank" class="px-4 py-2.5 rounded-2xl bg-charcoal-950 hover:bg-brand-600 text-white font-bold text-xs transition flex items-center gap-1.5 shadow">
                                <i data-lucide="play" class="w-3.5 h-3.5 fill-current"></i>
                                <span>Preview Live</span>
                            </a>
                            <a href="{{ route('guests.index') }}" class="px-4 py-2.5 rounded-2xl bg-sand-200 hover:bg-sand-300 text-charcoal-900 font-bold text-xs transition flex items-center gap-1.5">
                                <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                <span>Buku Tamu</span>
                            </a>
                            <form method="POST" action="{{ route('invitations.destroy', $invitation) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus undangan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 rounded-2xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 transition flex items-center justify-center" title="Hapus Undangan">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </button>
                            </form>
                        </div>

                    </div>

                    <!-- META CHIPS -->
                    <div class="pt-4 border-t border-sand-200/80 flex flex-wrap items-center justify-between gap-4 text-xs text-sand-600">
                        <div class="flex items-center gap-6">
                            <span>👥 Total Tamu: <strong class="text-charcoal-900">{{ $invitation->guests->count() }} Tamu</strong></span>
                            <span>💍 Rangkaian Acara: <strong class="text-charcoal-900">{{ $invitation->events->count() }} Agenda</strong></span>
                            <span>🎵 Musik: <strong class="text-charcoal-900">{{ $invitation->background_music ? 'Lagu Terpasang' : 'Default' }}</strong></span>
                        </div>
                        <span class="text-[11px] text-sand-400">Dibuat: {{ $invitation->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            @empty
                <div class="p-12 rounded-3xl glass-panel border border-sand-200 text-center space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-sand-200 text-sand-600 flex items-center justify-center mx-auto">
                        <i data-lucide="mail-search" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-lg font-bold text-charcoal-950">Belum Ada Undangan</h3>
                    <p class="text-xs text-sand-500 max-w-sm mx-auto">
                        Mulai rancang undangan digital pernikahan pertama Anda sekarang dengan template eksklusif.
                    </p>
                    <a href="{{ route('invitations.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-brand-500 text-white font-bold text-xs shadow hover:bg-brand-600 transition">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>Buat Undangan Baru</span>
                    </a>
                </div>
            @endforelse

            <!-- PAGINATION -->
            <div class="pt-4">
                {{ $invitations->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
