<x-member-layout>
    <div class="space-y-8">
        
        @if($invitation)
            <!-- ============================================== -->
            <!-- 1. HERO WEDDING SUMMARY (MEMBER DENGAN UNDANGAN AKTIF) -->
            <!-- ============================================== -->
            @php
                $coupleTitle = $couple ? ($couple->groom_nickname . ' & ' . $couple->bride_nickname) : ($invitation->title ?? 'Mempelai Bahagia');
                $eventDate = $mainEvent && $mainEvent->event_date ? \Carbon\Carbon::parse($mainEvent->event_date)->isoFormat('dddd, D MMMM Y') : 'Tanggal Belum Diatur';
                $venueName = $mainEvent->venue_name ?? 'Lokasi Acara Belum Diatur';
                $daysRemaining = null;
                if ($mainEvent && $mainEvent->event_date) {
                    $daysRemaining = (int) \Carbon\Carbon::now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($mainEvent->event_date)->startOfDay(), false);
                }
            @endphp

            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-charcoal-950 via-charcoal-900 to-[#1e1a14] p-6 sm:p-8 lg:p-10 text-white shadow-2xl border border-brand-500/20">
                <!-- AMBIENT GLOW EFFECTS -->
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-brand-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <!-- LEFT: WEDDING IDENTITY -->
                    <div class="flex items-start sm:items-center gap-4 sm:gap-6">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-cover bg-center border-2 border-brand-400/40 shadow-lg flex-shrink-0 relative overflow-hidden" 
                             style="background-image: url('{{ $invitation->cover_image ?? 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=400&auto=format&fit=crop&q=80' }}');">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        </div>
                        
                        <div class="space-y-1.5">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full {{ $invitation->is_published ? 'bg-emerald-500/20 border border-emerald-400/30 text-emerald-300' : 'bg-amber-500/20 border border-amber-400/30 text-amber-300' }} text-[10px] font-extrabold uppercase tracking-wider">
                                    {{ $invitation->is_published ? '● Website Online' : '● Draft' }}
                                </span>
                                @if(!is_null($daysRemaining))
                                    <span class="px-2.5 py-0.5 rounded-full bg-white/10 border border-white/15 text-brand-200 text-[10px] font-bold">
                                        @if($daysRemaining > 0)
                                            ⏳ {{ $daysRemaining }} Hari Lagi
                                        @elseif($daysRemaining === 0)
                                            💍 Hari Bahagia Hari Ini!
                                        @else
                                            ✓ Acara Selesai
                                        @endif
                                    </span>
                                @endif
                            </div>

                            <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-white">
                                The Wedding of {{ $coupleTitle }}
                            </h1>

                            <div class="flex flex-wrap items-center gap-y-1 gap-x-3 text-xs text-sand-300/90">
                                <span class="flex items-center gap-1">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-brand-400"></i>
                                    <span>{{ $eventDate }}</span>
                                </span>
                                <span>•</span>
                                <span class="flex items-center gap-1">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-brand-400"></i>
                                    <span class="truncate max-w-xs">{{ $venueName }}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT: ACTION BUTTONS -->
                    <div class="flex flex-wrap items-center gap-3 pt-2 lg:pt-0">
                        <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank" 
                           class="px-4 sm:px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/15 border border-white/20 hover:border-white/30 text-white font-bold text-xs backdrop-blur-md transition-all flex items-center gap-2 shadow-sm">
                            <i data-lucide="eye" class="w-4 h-4 text-brand-300"></i>
                            <span>Lihat Undangan</span>
                        </a>
                        <a href="{{ route('member.guests.index') }}" 
                           class="px-5 sm:px-6 py-3 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 hover:from-brand-500 hover:to-brand-600 text-white font-bold text-xs shadow-lg shadow-brand-900/30 hover:shadow-brand-600/30 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            <span>Sebar Undangan (WA)</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- 2. STATS & METRICS OVERVIEW (RINGKAS & FOKUS) -->
            <!-- ============================================== -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                <!-- CARD 1: TOTAL TAMU -->
                <div class="p-5 sm:p-6 rounded-3xl bg-white border border-sand-200 shadow-sm hover:shadow-md transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-sand-500">Tamu Terdaftar</span>
                        <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center">
                            <i data-lucide="users" class="w-4 h-4"></i>
                        </div>
                    </div>
                    <div>
                        <div class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                            {{ $myGuestsCount }} <span class="text-xs font-sans text-sand-400 font-normal">Tamu</span>
                        </div>
                        <a href="{{ route('member.guests.index') }}" class="text-[11px] text-brand-700 hover:text-brand-800 font-semibold flex items-center gap-1 mt-1">
                            <span>Kelola Buku Tamu</span>
                            <i data-lucide="arrow-right" class="w-3 h-3"></i>
                        </a>
                    </div>
                </div>

                <!-- CARD 2: KONFIRMASI HADIR -->
                <div class="p-5 sm:p-6 rounded-3xl bg-white border border-sand-200 shadow-sm hover:shadow-md transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-sand-500">Konfirmasi Hadir</span>
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                        </div>
                    </div>
                    <div>
                        <div class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                            {{ $myConfirmedGuestsCount }} 
                            <span class="text-xs font-sans text-emerald-600 font-bold">({{ $myGuestsCount > 0 ? round(($myConfirmedGuestsCount / $myGuestsCount) * 100) : 0 }}%)</span>
                        </div>
                        <p class="text-[11px] text-sand-500 font-medium mt-1 truncate">
                            {{ $myConfirmedGuestsCount > 0 ? 'Respon RSVP diterima' : 'Menunggu respon tamu' }}
                        </p>
                    </div>
                </div>

                <!-- CARD 3: UCAPAN & DOA -->
                <div class="p-5 sm:p-6 rounded-3xl bg-white border border-sand-200 shadow-sm hover:shadow-md transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-sand-500">Ucapan & Doa</span>
                        <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center">
                            <i data-lucide="heart" class="w-4 h-4"></i>
                        </div>
                    </div>
                    <div>
                        <div class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                            {{ $myWishesCount }} <span class="text-xs font-sans text-sand-400 font-normal">Doa</span>
                        </div>
                        <a href="{{ route('member.wishes.index') }}" class="text-[11px] text-rose-700 hover:text-rose-800 font-semibold flex items-center gap-1 mt-1">
                            <span>Buka Buku Ucapan</span>
                            <i data-lucide="arrow-right" class="w-3 h-3"></i>
                        </a>
                    </div>
                </div>

                <!-- CARD 4: AMPLOP DIGITAL -->
                <div class="p-5 sm:p-6 rounded-3xl bg-white border border-sand-200 shadow-sm hover:shadow-md transition-all space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-sand-500">Amplop & QRIS</span>
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center">
                            <i data-lucide="wallet" class="w-4 h-4"></i>
                        </div>
                    </div>
                    <div>
                        <div class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                            {{ $invitation->wallets()->count() }} <span class="text-xs font-sans text-sand-400 font-normal">Rekening</span>
                        </div>
                        <p class="text-[11px] text-sand-500 font-medium mt-1 truncate">
                            {{ $invitation->wallets()->count() > 0 ? 'Siap terima hadiah' : 'Belum ditambahkan' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- 3. WORKSPACE: LINK UNDANGAN & UCAPAN TERBARU -->
            <!-- ============================================== -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">
                <!-- LEFT (COL-8): LINK UNDANGAN & SHORTCUTS -->
                <div class="lg:col-span-8 space-y-6">
                    <!-- COPY LINK & DISTRIBUSI CARD -->
                    <div class="p-6 sm:p-7 rounded-3xl bg-white border border-sand-200 shadow-sm space-y-5" 
                         x-data="{ copied: false, link: '{{ route('invitation.show', $invitation->slug) }}' }">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-serif text-lg font-bold text-charcoal-950">Link Website Undangan Anda</h3>
                                <p class="text-xs text-sand-600">Salin tautan ini untuk dibagikan langsung ke keluarga atau kerabat tercinta.</p>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200/60 text-xs font-bold">
                                Siap Disebar
                            </span>
                        </div>

                        <!-- COPY INPUT ROW -->
                        <div class="flex items-center gap-2">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                                    <i data-lucide="link" class="w-4 h-4"></i>
                                </div>
                                <input type="text" readonly :value="link" 
                                       class="w-full pl-10 pr-4 py-3 rounded-2xl border border-sand-200 bg-sand-50/70 text-xs text-charcoal-900 font-medium select-all focus:outline-none">
                            </div>
                            <button @click="navigator.clipboard.writeText(link); copied = true; setTimeout(() => copied = false, 2500)"
                                    class="px-5 py-3 rounded-2xl bg-charcoal-950 hover:bg-charcoal-900 text-white font-bold text-xs transition flex items-center gap-2 flex-shrink-0 shadow-sm">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-400" x-show="copied" style="display: none;"></i>
                                <i data-lucide="copy" class="w-4 h-4" x-show="!copied"></i>
                                <span x-text="copied ? 'Tersalin!' : 'Salin Link'">Salin Link</span>
                            </button>
                        </div>

                        <!-- QUICK SHORTCUT BUTTONS -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2 border-t border-sand-100">
                            <a href="{{ route('member.invitations.index') }}" 
                               class="p-3.5 rounded-2xl bg-sand-50 hover:bg-sand-100 border border-sand-200/80 transition flex items-center gap-3 group">
                                <div class="w-8 h-8 rounded-xl bg-white text-sand-700 flex items-center justify-center shadow-sm group-hover:text-brand-600 transition">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </div>
                                <div class="text-left">
                                    <span class="text-xs font-bold text-charcoal-950 block">Edit Acara</span>
                                    <span class="text-[10px] text-sand-500">Mempelai & Jadwal</span>
                                </div>
                            </a>

                            <a href="{{ route('member.guests.index') }}" 
                               class="p-3.5 rounded-2xl bg-sand-50 hover:bg-sand-100 border border-sand-200/80 transition flex items-center gap-3 group">
                                <div class="w-8 h-8 rounded-xl bg-white text-sand-700 flex items-center justify-center shadow-sm group-hover:text-emerald-600 transition">
                                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                                </div>
                                <div class="text-left">
                                    <span class="text-xs font-bold text-charcoal-950 block">Daftar Tamu</span>
                                    <span class="text-[10px] text-sand-500">Buku Tamu WhatsApp</span>
                                </div>
                            </a>

                            <a href="{{ route('member.themes.index') }}" 
                               class="p-3.5 rounded-2xl bg-sand-50 hover:bg-sand-100 border border-sand-200/80 transition flex items-center gap-3 group">
                                <div class="w-8 h-8 rounded-xl bg-white text-sand-700 flex items-center justify-center shadow-sm group-hover:text-indigo-600 transition">
                                    <i data-lucide="palette" class="w-4 h-4"></i>
                                </div>
                                <div class="text-left">
                                    <span class="text-xs font-bold text-charcoal-950 block">Ganti Tema</span>
                                    <span class="text-[10px] text-sand-500">Koleksi Template</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- PROGRES KELENGKAPAN UNDANGAN (COMPACT) -->
                    <div class="p-6 sm:p-7 rounded-3xl bg-white border border-sand-200 shadow-sm space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-serif text-base font-bold text-charcoal-950">Kelengkapan Konten Undangan</h3>
                            <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200/60">
                                Data Aktif
                            </span>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div class="p-3 rounded-2xl bg-sand-50 border border-sand-200/60 flex items-center gap-2.5">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 flex-shrink-0"></i>
                                <span class="text-xs font-semibold text-charcoal-900 truncate">Data Mempelai</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-sand-50 border border-sand-200/60 flex items-center gap-2.5">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 flex-shrink-0"></i>
                                <span class="text-xs font-semibold text-charcoal-900 truncate">Jadwal Acara</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-sand-50 border border-sand-200/60 flex items-center gap-2.5">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 flex-shrink-0"></i>
                                <span class="text-xs font-semibold text-charcoal-900 truncate">Galeri Foto</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-sand-50 border border-sand-200/60 flex items-center gap-2.5">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 flex-shrink-0"></i>
                                <span class="text-xs font-semibold text-charcoal-900 truncate">Amplop Digital</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT (COL-4): UCAPAN & DOA TERBARU -->
                <div class="lg:col-span-4 space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="font-serif text-lg font-bold text-charcoal-950">Ucapan Masuk</h3>
                        @if($myWishesCount > 0)
                            <a href="{{ route('member.wishes.index') }}" class="text-xs font-bold text-brand-700 hover:underline">
                                Lihat Semua ({{ $myWishesCount }})
                            </a>
                        @endif
                    </div>

                    <div class="rounded-3xl bg-white border border-sand-200 p-5 space-y-3 shadow-sm">
                        @forelse($recentWishes as $wish)
                            <div class="p-3.5 rounded-2xl bg-sand-50/80 border border-sand-200/60 space-y-1.5">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-charcoal-950 truncate">{{ $wish->sender_name }}</span>
                                    <span class="px-2 py-0.5 rounded-full {{ $wish->attendance_status === 'hadir' ? 'bg-emerald-100 text-emerald-800' : 'bg-sand-200 text-sand-700' }} text-[9px] font-bold shrink-0">
                                        {{ ucfirst($wish->attendance_status ?? 'Hadir') }}
                                    </span>
                                </div>
                                <p class="text-xs text-charcoal-800/90 leading-relaxed italic font-editorial text-sm line-clamp-2">
                                    "{{ $wish->message }}"
                                </p>
                                <span class="text-[10px] text-sand-400 block">{{ $wish->created_at ? $wish->created_at->diffForHumans() : 'Baru saja' }}</span>
                            </div>
                        @empty
                            <div class="py-8 px-4 text-center space-y-2">
                                <div class="w-10 h-10 rounded-2xl bg-sand-100 text-sand-400 flex items-center justify-center mx-auto">
                                    <i data-lucide="message-square" class="w-5 h-5"></i>
                                </div>
                                <h4 class="text-xs font-bold text-charcoal-950">Belum Ada Ucapan</h4>
                                <p class="text-[11px] text-sand-500 leading-relaxed max-w-xs mx-auto">
                                    Doa restu dari tamu undangan Anda akan otomatis tampil di sini saat mereka mengisi buku tamu.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        @else
            <!-- ============================================== -->
            <!-- 1. EMPTY STATE HERO (PENGGUNA BARU TANPA UNDANGAN) -->
            <!-- ============================================== -->
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-charcoal-950 via-charcoal-900 to-[#1e1a14] p-6 sm:p-8 lg:p-10 text-white shadow-2xl border border-brand-500/20">
                <!-- AMBIENT GLOW EFFECTS -->
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-brand-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2.5 max-w-xl">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-brand-400/10 border border-brand-400/20 text-[11px] font-bold text-brand-300 uppercase tracking-wider">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-brand-400"></i>
                            <span>Portal Pengantin • KlikMomen</span>
                        </div>
                        <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-white">
                            Selamat Datang, <span class="text-brand-200">{{ Auth::user()->name }}</span>! ✨
                        </h1>
                        <p class="text-xs sm:text-sm text-sand-300/90 leading-relaxed">
                            Mulai hari bahagia Anda dengan memilih desain tema impian atau langsung buat website undangan pernikahan pertama Anda sekarang.
                        </p>
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('member.themes.index') }}" 
                           class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/15 border border-white/20 hover:border-white/30 text-white font-semibold text-xs backdrop-blur-md transition flex items-center gap-2 shadow-sm">
                            <i data-lucide="palette" class="w-4 h-4 text-brand-300"></i>
                            <span>Pilihan Tema</span>
                        </a>
                        <a href="{{ route('member.invitations.create') }}" 
                           class="px-6 py-3 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 hover:from-brand-500 hover:to-brand-600 text-white font-bold text-xs shadow-lg shadow-brand-900/30 hover:shadow-brand-600/30 hover:scale-[1.02] active:scale-[0.98] transition flex items-center gap-2">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Buat Undangan Sekarang</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- 2. ONBOARDING 3 LANGKAH MUDAH (COMPACT & BERSIH) -->
            <!-- ============================================== -->
            <div class="rounded-3xl bg-white border border-sand-200 p-6 sm:p-8 shadow-sm space-y-6">
                <div class="text-center max-w-lg mx-auto space-y-1.5">
                    <span class="text-[11px] font-bold uppercase tracking-widest text-brand-600">Langkah Awal</span>
                    <h2 class="font-serif text-2xl font-bold text-charcoal-950">
                        3 Langkah Mudah Menyiapkan Undangan Anda
                    </h2>
                    <p class="text-xs text-sand-600 leading-relaxed">
                        Cukup ikuti alur praktis berikut untuk menyebarkan undangan pernikahan digital Anda.
                    </p>
                </div>

                <!-- 3 CARDS GRID -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-5">
                    <div class="p-5 sm:p-6 rounded-2xl bg-sand-50 border border-sand-200/80 space-y-3 relative overflow-hidden">
                        <span class="text-3xl font-serif font-bold text-sand-300 absolute top-4 right-5">01</span>
                        <div class="w-10 h-10 rounded-2xl bg-brand-600 text-white flex items-center justify-center shadow-sm">
                            <i data-lucide="palette" class="w-5 h-5"></i>
                        </div>
                        <h3 class="font-serif text-base font-bold text-charcoal-950">1. Pilih Desain Tema</h3>
                        <p class="text-xs text-sand-600 leading-relaxed">
                            Pilih template desain yang sesuai dengan konsep pernikahan Anda, dari gaya Tradisional Adat hingga Modern Floral.
                        </p>
                    </div>

                    <div class="p-5 sm:p-6 rounded-2xl bg-sand-50 border border-sand-200/80 space-y-3 relative overflow-hidden">
                        <span class="text-3xl font-serif font-bold text-sand-300 absolute top-4 right-5">02</span>
                        <div class="w-10 h-10 rounded-2xl bg-brand-600 text-white flex items-center justify-center shadow-sm">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                        </div>
                        <h3 class="font-serif text-base font-bold text-charcoal-950">2. Lengkapi Data & Foto</h3>
                        <p class="text-xs text-sand-600 leading-relaxed">
                            Masukkan data kedua mempelai, tanggal & lokasi akad/resepsi, peta lokasi, serta unggah foto prewedding romantis Anda.
                        </p>
                    </div>

                    <div class="p-5 sm:p-6 rounded-2xl bg-sand-50 border border-sand-200/80 space-y-3 relative overflow-hidden">
                        <span class="text-3xl font-serif font-bold text-sand-300 absolute top-4 right-5">03</span>
                        <div class="w-10 h-10 rounded-2xl bg-brand-600 text-white flex items-center justify-center shadow-sm">
                            <i data-lucide="send" class="w-5 h-5"></i>
                        </div>
                        <h3 class="font-serif text-base font-bold text-charcoal-950">3. Sebar via WhatsApp</h3>
                        <p class="text-xs text-sand-600 leading-relaxed">
                            Generate link personal otomatis untuk tiap nama tamu dan pantau konfirmasi kehadiran (RSVP) secara realtime.
                        </p>
                    </div>
                </div>

                <div class="pt-2 text-center">
                    <a href="{{ route('member.invitations.create') }}" 
                       class="inline-flex items-center gap-2 px-8 py-3.5 rounded-2xl bg-charcoal-950 hover:bg-charcoal-900 text-white font-bold text-xs shadow-md hover:scale-[1.01] active:scale-[0.99] transition">
                        <i data-lucide="plus-circle" class="w-4 h-4 text-brand-400"></i>
                        <span>Mulai Buat Undangan Pertama</span>
                    </a>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- 3. INSPIRASI & BANTUAN CEPAT (2-CARD GRID) -->
            <!-- ============================================== -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <a href="{{ route('themes.catalog') }}" 
                   class="p-6 rounded-3xl bg-white border border-sand-200 hover:border-brand-400/60 shadow-sm hover:shadow-md transition group flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-700 flex items-center justify-center group-hover:scale-105 transition flex-shrink-0">
                        <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-serif text-base font-bold text-charcoal-950 group-hover:text-brand-700 transition">
                            Jelajahi Katalog Tema
                        </h3>
                        <p class="text-xs text-sand-600 leading-relaxed">
                            Lihat beragam koleksi tema undangan digital elegan mulai dari gaya adat nusantara hingga minimalist modern.
                        </p>
                    </div>
                </a>

                <a href="{{ route('demo.index') }}" target="_blank" 
                   class="p-6 rounded-3xl bg-white border border-sand-200 hover:border-brand-400/60 shadow-sm hover:shadow-md transition group flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center group-hover:scale-105 transition flex-shrink-0">
                        <i data-lucide="play" class="w-6 h-6"></i>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-serif text-base font-bold text-charcoal-950 group-hover:text-emerald-700 transition">
                            Lihat Contoh Undangan (Live Demo)
                        </h3>
                        <p class="text-xs text-sand-600 leading-relaxed">
                            Coba langsung pengalaman interaktif website undangan digital seperti yang akan diterima oleh para tamu Anda.
                        </p>
                    </div>
                </a>
            </div>

            <!-- ============================================== -->
            <!-- 4. TEMA YANG DIMILIKI (JIKA USER SUDAH PUNYA TEMA) -->
            <!-- ============================================== -->
            @if($unlockedThemes && $unlockedThemes->isNotEmpty())
                <div class="rounded-3xl bg-white border border-sand-200 p-6 sm:p-8 space-y-5 shadow-sm">
                    <div class="flex items-center justify-between border-b border-sand-100 pb-4">
                        <div>
                            <h3 class="font-serif text-lg font-bold text-charcoal-950">Tema yang Anda Miliki</h3>
                            <p class="text-xs text-sand-600">Template aktif yang siap Anda gunakan untuk membuat undangan.</p>
                        </div>
                        <a href="{{ route('member.themes.index') }}" class="text-xs font-bold text-brand-700 hover:underline">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach($unlockedThemes as $theme)
                            <div class="rounded-2xl border border-sand-200 bg-sand-50/40 p-4 space-y-3 flex flex-col justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $theme->thumbnail }}" alt="{{ $theme->name }}" class="w-14 h-14 rounded-xl object-cover border border-sand-200">
                                    <div class="space-y-0.5">
                                        <span class="text-[10px] font-bold text-brand-700 uppercase tracking-wider">{{ ucfirst($theme->category) }}</span>
                                        <h4 class="text-xs font-serif font-bold text-charcoal-950">{{ $theme->name }}</h4>
                                    </div>
                                </div>
                                <a href="{{ route('member.invitations.create', ['theme_id' => $theme->id]) }}" 
                                   class="w-full py-2 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white text-[11px] font-bold text-center transition">
                                    Gunakan Tema Ini
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

    </div>
</x-member-layout>
