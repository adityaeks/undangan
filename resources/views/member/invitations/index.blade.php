<x-member-layout>
    <div class="space-y-3 sm:space-y-3.5" x-data="{ toast: { show: false, message: '' }, copyLink(url) { navigator.clipboard.writeText(url); this.toast.message = 'Link undangan berhasil disalin!'; this.toast.show = true; setTimeout(() => this.toast.show = false, 3000); } }">
        
        <!-- TOAST NOTIFICATION -->
        <div 
            x-show="toast.show" 
            x-transition 
            class="fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl bg-charcoal-950 text-white text-xs font-bold shadow-2xl flex items-center gap-2 border border-amber-500/40"
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
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-800 text-[10px] font-bold uppercase tracking-wider border border-amber-500/20">Undangan Saya</span>
                </div>
                <p class="text-xs text-sand-600">
                    Kelola website undangan digital Anda, status online, serta tautan tamu undangan.
                </p>
            </div>

            <a href="{{ route('member.invitations.create') }}" class="px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-amber-600 via-amber-700 to-brand-700 text-white font-bold text-xs shadow hover:shadow-amber-500/25 hover:scale-105 transition flex items-center justify-center gap-1.5 self-start sm:self-auto">
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

        <!-- COMPACT STATS TILES -->
        <div class="grid grid-cols-3 gap-2">
            <div class="p-2 sm:p-2.5 rounded-xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-sand-500 block">Total Undangan</span>
                    <div class="font-serif text-base font-bold text-charcoal-950">{{ $invitations->total() }} <span class="text-[11px] font-sans text-sand-400 font-normal">Website</span></div>
                </div>
                <div class="w-6 h-6 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs">
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
                        class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-sand-200 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-xs bg-white placeholder-sand-400"
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
                @endphp
                <div class="p-4 sm:p-5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition space-y-3">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start sm:items-center gap-4">
                            <!-- Cover thumbnail / Avatar -->
                            <div class="w-16 h-16 rounded-2xl overflow-hidden bg-sand-200 shrink-0 border border-sand-300">
                                @if($invitation->cover_image)
                                    <img src="{{ $invitation->cover_image }}" alt="{{ $invitation->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-amber-600 to-brand-700 text-white font-serif font-bold text-xl">
                                        {{ strtoupper(substr($invitation->title, 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Info -->
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h3 class="font-serif text-lg font-bold text-charcoal-950">
                                        {{ $invitation->title }}
                                    </h3>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $invitation->is_published ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
                                        {{ $invitation->is_published ? 'Online' : 'Draft' }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-4 text-xs text-sand-600 flex-wrap">
                                    @if($groom && $bride)
                                        <span class="flex items-center gap-1.5 font-medium text-charcoal-800">
                                            <i data-lucide="heart" class="w-3.5 h-3.5 text-rose-500"></i>
                                            {{ $groom->nickname ?? $groom->full_name }} & {{ $bride->nickname ?? $bride->full_name }}
                                        </span>
                                    @endif

                                    @if($firstEvent)
                                        <span class="flex items-center gap-1.5">
                                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-sand-400"></i>
                                            {{ \Carbon\Carbon::parse($firstEvent->date)->isoFormat('dddd, D MMMM Y') }}
                                        </span>
                                    @endif

                                    @if($invitation->theme)
                                        <span class="flex items-center gap-1.5">
                                            <i data-lucide="palette" class="w-3.5 h-3.5 text-amber-600"></i>
                                            Tema: <strong class="text-charcoal-900">{{ $invitation->theme->name }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <!-- Public URL link -->
                                <div class="pt-1 flex items-center gap-2 text-xs">
                                    <span class="text-sand-400">Link Publik:</span>
                                    <span class="font-mono text-amber-700 bg-amber-50 px-2 py-0.5 rounded-lg border border-amber-200/60 font-semibold truncate max-w-xs">
                                        {{ route('invitation.show', $invitation->slug) }}
                                    </span>
                                    <button 
                                        type="button" 
                                        @click="copyLink('{{ route('invitation.show', $invitation->slug) }}')"
                                        class="p-1 rounded-lg text-sand-500 hover:text-charcoal-900 hover:bg-sand-100 transition"
                                        title="Salin Link"
                                    >
                                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-2 self-end md:self-center">
                            <a 
                                href="{{ route('invitation.show', $invitation->slug) }}" 
                                target="_blank"
                                class="px-3.5 py-2 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-800 text-xs font-bold transition flex items-center gap-1.5"
                            >
                                <i data-lucide="external-link" class="w-3.5 h-3.5 text-amber-600"></i>
                                <span>Lihat Website</span>
                            </a>

                            <a 
                                href="{{ route('member.guests.index', ['invitation_id' => $invitation->id]) }}" 
                                class="px-3.5 py-2 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-900 text-xs font-bold transition flex items-center gap-1.5 border border-amber-200"
                            >
                                <i data-lucide="users" class="w-3.5 h-3.5 text-amber-700"></i>
                                <span>Kelola Tamu</span>
                            </a>

                            <form method="POST" action="{{ route('member.invitations.destroy', $invitation) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus undangan ini?');">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="p-2 rounded-xl text-sand-400 hover:text-rose-600 hover:bg-rose-50 transition"
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
                    <div class="w-16 h-16 rounded-full bg-amber-100 text-amber-700 mx-auto flex items-center justify-center font-bold">
                        <i data-lucide="heart" class="w-8 h-8"></i>
                    </div>
                    <div class="space-y-1 max-w-md mx-auto">
                        <h3 class="font-serif text-lg font-bold text-charcoal-950">Belum Ada Undangan</h3>
                        <p class="text-xs text-sand-600">
                            Anda belum membuat website undangan pernikahan. Buat sekarang dan sebarkan kebahagiaan Anda kepada seluruh keluarga & kerabat!
                        </p>
                    </div>
                    <a href="{{ route('member.invitations.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-amber-600 to-brand-700 text-white font-bold text-xs shadow-lg hover:shadow-amber-500/25 transition">
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
                    <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center">
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
