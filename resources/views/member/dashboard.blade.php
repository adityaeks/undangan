<x-member-layout>
    <div class="space-y-8">
        
        @if($invitation)
            <!-- ============================================== -->
            <!-- 1. HERO GREETING (AKTIF) -->
            <!-- ============================================== -->
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-charcoal-950 via-charcoal-900 to-amber-950 p-6 sm:p-10 text-white shadow-xl border border-charcoal-800">
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-amber-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2 max-w-xl">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-[11px] font-bold text-amber-200 uppercase tracking-wider">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-amber-300"></i>
                            <span>Portal Pengantin • KlikMomen</span>
                        </div>
                        <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight">
                            Selamat Datang, {{ Auth::user()->name }}! 💍
                        </h1>
                        <p class="text-xs sm:text-sm text-sand-300 leading-relaxed">
                            Pantau konfirmasi kehadiran (RSVP) tamu undangan Anda, kelola ucapan & doa restu, serta bagikan link undangan digital personal ke kerabat via WhatsApp.
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank" class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs backdrop-blur-md transition flex items-center gap-2">
                            <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                            <span>Lihat Undangan</span>
                        </a>
                        <a href="{{ route('guests.index') }}" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 text-white font-bold text-xs shadow-lg hover:shadow-amber-500/30 hover:scale-105 transition flex items-center gap-2">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            <span>Sebar Undangan (WA)</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- 2. WEDDING COUNTDOWN & SUMMARY CARD -->
            <!-- ============================================== -->
            @php
                $coupleTitle = $couple ? ($couple->groom_nickname . ' & ' . $couple->bride_nickname) : ($invitation->title ?? 'Mempelai Bahagia');
                $eventDate = $mainEvent ? \Carbon\Carbon::parse($mainEvent->event_date)->isoFormat('dddd, D MMMM Y') : 'Jadwal Acara Telah Ditentukan';
                $venueName = $mainEvent->venue_name ?? 'Lokasi Acara';
            @endphp
            <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 sm:p-8 shadow-sm space-y-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-sand-200/60">
                    <div class="flex items-center gap-5">
                        <div class="w-20 h-20 rounded-3xl bg-cover bg-center border-2 border-amber-300/80 shadow-md flex-shrink-0" style="background-image: url('{{ $invitation->cover_image ?? 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=400&auto=format&fit=crop&q=80' }}');"></div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-2.5">
                                <span class="px-2.5 py-0.5 rounded-full {{ $invitation->is_published ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }} text-[10px] font-extrabold uppercase tracking-wider">
                                    {{ $invitation->is_published ? 'Website Online' : 'Draft' }}
                                </span>
                                <span class="text-xs text-sand-500">Tema: <strong class="text-charcoal-900">{{ $invitation->theme->name ?? 'Custom Theme' }}</strong></span>
                            </div>
                            <h2 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                                The Wedding of {{ $coupleTitle }}
                            </h2>
                            <p class="text-xs text-sand-600 flex items-center gap-1.5">
                                <i data-lucide="calendar" class="w-3.5 h-3.5 text-amber-600"></i>
                                <span>{{ $eventDate }}</span>
                                <span>•</span>
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-amber-600"></i>
                                <span class="truncate max-w-xs">{{ $venueName }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('member.invitations.index') }}" class="px-4 py-2.5 rounded-2xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 font-bold text-xs transition flex items-center gap-2">
                            <i data-lucide="edit-3" class="w-3.5 h-3.5 text-sand-600"></i>
                            <span>Edit Data Acara</span>
                        </a>
                        <a href="{{ route('member.themes.index') }}" class="px-4 py-2.5 rounded-2xl bg-amber-500/10 hover:bg-amber-500/20 text-amber-900 font-bold text-xs transition flex items-center gap-2 border border-amber-500/30">
                            <i data-lucide="palette" class="w-3.5 h-3.5 text-amber-600"></i>
                            <span>Ganti Tema</span>
                        </a>
                    </div>
                </div>

                <!-- COUNTDOWN TIMER WIDGET -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                    <div class="p-4 rounded-2xl bg-sand-50/90 border border-sand-200/80">
                        <div class="font-serif text-3xl font-bold text-charcoal-950">50</div>
                        <span class="text-[10px] uppercase font-bold text-sand-500 tracking-wider">Hari Lagi</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-sand-50/90 border border-sand-200/80">
                        <div class="font-serif text-3xl font-bold text-charcoal-950">14</div>
                        <span class="text-[10px] uppercase font-bold text-sand-500 tracking-wider">Jam</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-sand-50/90 border border-sand-200/80">
                        <div class="font-serif text-3xl font-bold text-charcoal-950">32</div>
                        <span class="text-[10px] uppercase font-bold text-sand-500 tracking-wider">Menit</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-sand-50/90 border border-sand-200/80">
                        <div class="font-serif text-3xl font-bold text-amber-600">08</div>
                        <span class="text-[10px] uppercase font-bold text-sand-500 tracking-wider">Detik</span>
                    </div>
                </div>
            </div>

        @else
            <!-- ============================================== -->
            <!-- 1. EMPTY STATE HERO (SAAT BARU REGISTER) -->
            <!-- ============================================== -->
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-charcoal-950 via-charcoal-900 to-amber-950 p-6 sm:p-10 text-white shadow-xl border border-charcoal-800">
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-amber-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2 max-w-xl">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-[11px] font-bold text-amber-200 uppercase tracking-wider">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-amber-300"></i>
                            <span>Portal Pengantin • KlikMomen</span>
                        </div>
                        <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight">
                            Selamat Datang, {{ Auth::user()->name }}! ✨
                        </h1>
                        <p class="text-xs sm:text-sm text-sand-300 leading-relaxed">
                            Akun Anda telah siap. Anda belum memiliki undangan pernikahan aktif. Mulai hari bahagia Anda dengan memilih desain tema impian atau buat undangan pertama sekarang!
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('member.themes.index') }}" class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs backdrop-blur-md transition flex items-center gap-2">
                            <i data-lucide="palette" class="w-3.5 h-3.5"></i>
                            <span>Pilihan Tema</span>
                        </a>
                        <a href="{{ route('member.invitations.create') }}" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 text-white font-bold text-xs shadow-lg hover:shadow-amber-500/30 hover:scale-105 transition flex items-center gap-2">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Buat Undangan Sekarang</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- 2. EMPTY STATE ONBOARDING CARD (3 LANGKAH MUDAH) -->
            <!-- ============================================== -->
            <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 sm:p-10 shadow-sm space-y-8 text-center">
                <div class="max-w-xl mx-auto space-y-3">
                    <div class="w-16 h-16 rounded-3xl bg-amber-500/10 text-amber-600 border border-amber-500/20 flex items-center justify-center font-bold text-2xl mx-auto shadow-sm">
                        💍
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-900 text-xs font-bold uppercase tracking-wider">
                        Undangan Belum Dibuat
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                        Buat Undangan Digital Pernikahan Anda
                    </h2>
                    <p class="text-xs sm:text-sm text-sand-600 leading-relaxed">
                        Nikmati kemudahan mengatur data mempelai, jadwal acara, galeri foto, hingga konfirmasi kehadiran tamu (RSVP) dalam satu website undangan digital yang elegan.
                    </p>
                </div>

                <!-- 3 STEPS GRID -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 text-left">
                    <div class="p-6 rounded-3xl bg-sand-50/90 border border-sand-200/80 space-y-3 relative overflow-hidden">
                        <span class="text-3xl font-serif font-bold text-amber-600/30 absolute top-4 right-5">01</span>
                        <div class="w-10 h-10 rounded-2xl bg-amber-500 text-white flex items-center justify-center">
                            <i data-lucide="palette" class="w-5 h-5"></i>
                        </div>
                        <h3 class="font-serif text-base font-bold text-charcoal-950">1. Pilih Tema Desain</h3>
                        <p class="text-xs text-sand-600 leading-relaxed">
                            Pilih desain template eksklusif mulai dari gaya Tradisional Adat Nusantara, Modern Minimalis, hingga Luxury Floral.
                        </p>
                    </div>

                    <div class="p-6 rounded-3xl bg-sand-50/90 border border-sand-200/80 space-y-3 relative overflow-hidden">
                        <span class="text-3xl font-serif font-bold text-amber-600/30 absolute top-4 right-5">02</span>
                        <div class="w-10 h-10 rounded-2xl bg-amber-500 text-white flex items-center justify-center">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                        </div>
                        <h3 class="font-serif text-base font-bold text-charcoal-950">2. Isi Data & Foto</h3>
                        <p class="text-xs text-sand-600 leading-relaxed">
                            Masukkan nama kedua mempelai, tanggal & lokasi akad/resepsi, Google Maps, serta unggah foto romantis prewedding Anda.
                        </p>
                    </div>

                    <div class="p-6 rounded-3xl bg-sand-50/90 border border-sand-200/80 space-y-3 relative overflow-hidden">
                        <span class="text-3xl font-serif font-bold text-amber-600/30 absolute top-4 right-5">03</span>
                        <div class="w-10 h-10 rounded-2xl bg-amber-500 text-white flex items-center justify-center">
                            <i data-lucide="send" class="w-5 h-5"></i>
                        </div>
                        <h3 class="font-serif text-base font-bold text-charcoal-950">3. Sebar via WhatsApp</h3>
                        <p class="text-xs text-sand-600 leading-relaxed">
                            Generate link personal otomatis untuk tiap nama tamu dan pantau konfirmasi kehadiran (RSVP) secara realtime.
                        </p>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ route('member.invitations.create') }}" class="inline-flex items-center gap-2.5 px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 hover:from-amber-600 hover:to-amber-800 text-white font-bold text-sm shadow-xl hover:shadow-amber-500/25 hover:scale-105 transition duration-200">
                        <i data-lucide="plus" class="w-5 h-5"></i>
                        <span>Mulai Buat Undangan Pertama Saya</span>
                    </a>
                </div>
            </div>
        @endif

        <!-- ============================================== -->
        <!-- 3. STATS & METRICS OVERVIEW (SESUAI DATA) -->
        <!-- ============================================== -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <!-- CARD 1: TOTAL TAMU -->
            <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Tamu Terdaftar</span>
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">{{ $myGuestsCount }} <span class="text-xs font-sans text-sand-500">Tamu</span></div>
                    <p class="text-[11px] {{ $myGuestsCount > 0 ? 'text-brand-600' : 'text-sand-400' }} font-semibold flex items-center gap-1 mt-1">
                        <i data-lucide="link" class="w-3.5 h-3.5"></i>
                        <span>{{ $myGuestsCount > 0 ? 'Link personal aktif' : 'Belum ada tamu diinput' }}</span>
                    </p>
                </div>
            </div>

            <!-- CARD 2: KONFIRMASI HADIR -->
            <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Konfirmasi Hadir</span>
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">{{ $myConfirmedGuestsCount }} <span class="text-xs font-sans text-emerald-600 font-bold">({{ $myGuestsCount > 0 ? round(($myConfirmedGuestsCount / $myGuestsCount) * 100) : 0 }}%)</span></div>
                    <p class="text-[11px] {{ $myConfirmedGuestsCount > 0 ? 'text-emerald-600' : 'text-sand-400' }} font-semibold flex items-center gap-1 mt-1">
                        <i data-lucide="trending-up" class="w-3.5 h-3.5"></i>
                        <span>{{ $myConfirmedGuestsCount > 0 ? 'Respon RSVP aktif' : 'Menunggu respon tamu' }}</span>
                    </p>
                </div>
            </div>

            <!-- CARD 3: BUKU UCAPAN & DOA -->
            <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Ucapan & Doa Restu</span>
                    <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-700 flex items-center justify-center">
                        <i data-lucide="message-square-heart" class="w-5 h-5"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">{{ $myWishesCount }} <span class="text-xs font-sans text-sand-500">Pesan</span></div>
                    <p class="text-[11px] {{ $myWishesCount > 0 ? 'text-rose-600' : 'text-sand-400' }} font-semibold flex items-center gap-1 mt-1">
                        <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                        <span>{{ $myWishesCount > 0 ? 'Doa restu sahabat & keluarga' : 'Buku tamu siap digunakan' }}</span>
                    </p>
                </div>
            </div>

            <!-- CARD 4: AMPLOP DIGITAL -->
            <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Amplop Digital / Hadiah</span>
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                        <i data-lucide="wallet" class="w-5 h-5"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">{{ $invitation ? ($invitation->wallets()->count() ?: 0) : 0 }} <span class="text-xs font-sans text-sand-500">Rekening</span></div>
                    <p class="text-[11px] text-amber-600 font-semibold flex items-center gap-1 mt-1">
                        <i data-lucide="qr-code" class="w-3.5 h-3.5"></i>
                        <span>{{ $invitation && $invitation->wallets()->count() > 0 ? 'Transfer & QRIS aktif' : 'Dapat diatur saat buat undangan' }}</span>
                    </p>
                </div>
            </div>

        </div>

        <!-- ============================================== -->
        <!-- 4. TEMA YANG TELAH DIBAYAR & DIMILIKI -->
        <!-- ============================================== -->
        <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 sm:p-8 space-y-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-sand-200/60 pb-5">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-extrabold uppercase tracking-wider mb-2">
                        <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-600"></i>
                        <span>Akses Template Digital</span>
                    </div>
                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-charcoal-950">Tema yang Telah Anda Miliki</h3>
                    <p class="text-xs text-sand-600">Daftar desain tema undangan yang telah Anda bayar dan aktif digunakan kapan saja.</p>
                </div>
                <div class="flex items-center gap-2 self-start sm:self-auto">
                    <a href="{{ route('member.themes.index') }}" class="px-4 py-2.5 rounded-2xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 font-bold text-xs transition flex items-center gap-2">
                        <i data-lucide="palette" class="w-3.5 h-3.5 text-amber-600"></i>
                        <span>Tema Saya</span>
                    </a>
                    <a href="{{ route('themes.catalog') }}" class="px-4 py-2.5 rounded-2xl bg-charcoal-900 hover:bg-charcoal-800 text-white font-bold text-xs transition flex items-center gap-2 shadow-sm">
                        <i data-lucide="shopping-bag" class="w-3.5 h-3.5 text-amber-400"></i>
                        <span>Beli Tema Baru</span>
                    </a>
                </div>
            </div>

            @if($unlockedThemes && $unlockedThemes->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($unlockedThemes as $theme)
                        @php
                            $isThemeExpired = $theme->pivot?->expires_at && \Carbon\Carbon::parse($theme->pivot->expires_at)->isPast();
                        @endphp
                        <div class="rounded-2xl border border-sand-200/80 bg-white shadow-sm hover:shadow-md transition-all overflow-hidden flex flex-col group">
                            <!-- THUMBNAIL -->
                            <div class="relative aspect-[4/3] overflow-hidden bg-sand-100">
                                <img src="{{ $theme->thumbnail }}" alt="{{ $theme->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950/80 via-transparent to-transparent"></div>
                                @if($isThemeExpired)
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-rose-600 text-white text-[10px] font-bold shadow flex items-center gap-1">
                                        <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                        <span>Kedaluwarsa</span>
                                    </span>
                                @else
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-emerald-500 text-white text-[10px] font-bold shadow flex items-center gap-1">
                                        <i data-lucide="shield-check" class="w-3 h-3"></i>
                                        <span>Lunas &amp; Aktif</span>
                                    </span>
                                @endif
                                <div class="absolute bottom-3 left-3 right-3 text-white">
                                    <span class="text-[10px] font-bold text-amber-300 uppercase tracking-wider block">{{ ucfirst($theme->category) }}</span>
                                    <h4 class="text-sm font-serif font-bold truncate">{{ $theme->name }}</h4>
                                </div>
                            </div>

                            <!-- CARD CONTENT -->
                            <div class="p-4 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-1">
                                    <div class="flex items-center justify-between text-[11px]">
                                        <span class="font-semibold text-sand-500">Status Lisensi:</span>
                                        @if($isThemeExpired)
                                            <span class="text-rose-700 font-bold flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                Kedaluwarsa
                                            </span>
                                        @else
                                            <span class="text-emerald-700 font-bold flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Lunas &amp; Aktif
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-sand-600 line-clamp-2">
                                        {{ $theme->metadata['description'] ?? 'Desain tema undangan digital eksklusif siap pakai.' }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-2 pt-2 border-t border-sand-100">
                                    <a href="{{ route('demo.show', ['slug' => $theme->slug]) }}" target="_blank" class="py-2 px-3 rounded-xl border border-sand-200 hover:bg-sand-50 text-charcoal-800 text-[11px] font-bold flex items-center justify-center gap-1 transition text-center">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        <span>Demo</span>
                                    </a>
                                    @if($isThemeExpired)
                                        <a href="{{ route('checkout.theme', ['theme' => $theme->id]) }}" class="py-2 px-3 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-[11px] font-bold flex items-center justify-center gap-1 transition text-center shadow-sm">
                                            <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                                            <span>Beli Lagi</span>
                                        </a>
                                    @else
                                        <a href="{{ route('member.invitations.create', ['theme_id' => $theme->id]) }}" class="py-2 px-3 rounded-xl bg-charcoal-950 hover:bg-amber-600 text-white text-[11px] font-bold flex items-center justify-center gap-1 transition text-center shadow-sm">
                                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                                            <span>Gunakan</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-8 px-4 text-center rounded-2xl bg-sand-50/60 border border-dashed border-sand-300 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto text-xl shadow-sm">
                        <i data-lucide="palette" class="w-6 h-6"></i>
                    </div>
                    <div class="space-y-1 max-w-sm mx-auto">
                        <h4 class="font-serif text-base font-bold text-charcoal-950">Belum Ada Tema yang Dibeli</h4>
                        <p class="text-xs text-sand-500 leading-relaxed">
                            Pilih desain template impian Anda dari koleksi eksklusif KlikMomen dan selesaikan aktivasi untuk membuat website undangan pernikahan Anda.
                        </p>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('themes.catalog') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-bold text-xs shadow-md transition">
                            <i data-lucide="shopping-bag" class="w-3.5 h-3.5"></i>
                            <span>Jelajahi &amp; Beli Tema (Mulai Rp 49.000)</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- ============================================== -->
        <!-- 5. CHECKLIST KELENGKAPAN UNDANGAN & AKSI CEPAT -->
        <!-- ============================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- LEFT (COL-8): CHECKLIST & QUICK ACTIONS -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- CHECKLIST CARD -->
                <div class="p-6 sm:p-7 rounded-3xl glass-panel border border-sand-200/80 shadow-sm space-y-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-serif text-lg font-bold text-charcoal-950">Progres Kelengkapan Undangan</h3>
                            <p class="text-xs text-sand-600">{{ $invitation ? 'Pastikan seluruh data pernikahan telah terisi dengan sempurna.' : 'Buat undangan pertama untuk memulai kelengkapan data.' }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full {{ $invitation ? 'bg-emerald-100 text-emerald-800' : 'bg-sand-200 text-sand-700' }} text-xs font-extrabold">
                            {{ $invitation ? '95% Siap' : '0% Belum Dimulai' }}
                        </span>
                    </div>

                    <!-- PROGRESS BAR -->
                    <div class="w-full bg-sand-200 h-2.5 rounded-full overflow-hidden">
                        <div class="bg-gradient-to-r from-amber-500 to-emerald-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $invitation ? '95%' : '5%' }};"></div>
                    </div>

                    <!-- STEPS GRID -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="p-3.5 rounded-2xl bg-sand-50/80 border border-sand-200/70 flex items-center gap-3">
                            <div class="w-7 h-7 rounded-xl {{ $invitation ? 'bg-emerald-500 text-white' : 'bg-sand-200 text-sand-400' }} flex items-center justify-center text-xs">
                                <i data-lucide="{{ $invitation ? 'check' : 'clock' }}" class="w-4 h-4"></i>
                            </div>
                            <div class="text-xs">
                                <span class="font-bold text-charcoal-950 block">Data Mempelai</span>
                                <span class="text-sand-500 text-[11px]">{{ $invitation ? 'Nama lengkap & orang tua terisi' : 'Belum diisi' }}</span>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-sand-50/80 border border-sand-200/70 flex items-center gap-3">
                            <div class="w-7 h-7 rounded-xl {{ $invitation ? 'bg-emerald-500 text-white' : 'bg-sand-200 text-sand-400' }} flex items-center justify-center text-xs">
                                <i data-lucide="{{ $invitation ? 'check' : 'clock' }}" class="w-4 h-4"></i>
                            </div>
                            <div class="text-xs">
                                <span class="font-bold text-charcoal-950 block">Waktu & Lokasi Acara</span>
                                <span class="text-sand-500 text-[11px]">{{ $invitation ? 'Akad nikah & resepsi terisi' : 'Belum diisi' }}</span>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-sand-50/80 border border-sand-200/70 flex items-center gap-3">
                            <div class="w-7 h-7 rounded-xl {{ $invitation ? 'bg-emerald-500 text-white' : 'bg-sand-200 text-sand-400' }} flex items-center justify-center text-xs">
                                <i data-lucide="{{ $invitation ? 'check' : 'clock' }}" class="w-4 h-4"></i>
                            </div>
                            <div class="text-xs">
                                <span class="font-bold text-charcoal-950 block">Galeri Foto & Musik</span>
                                <span class="text-sand-500 text-[11px]">{{ $invitation ? 'Lagu & foto prewedding siap' : 'Belum diisi' }}</span>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-sand-50/80 border border-sand-200/70 flex items-center gap-3">
                            <div class="w-7 h-7 rounded-xl {{ $invitation ? 'bg-emerald-500 text-white' : 'bg-sand-200 text-sand-400' }} flex items-center justify-center text-xs">
                                <i data-lucide="{{ $invitation ? 'check' : 'clock' }}" class="w-4 h-4"></i>
                            </div>
                            <div class="text-xs">
                                <span class="font-bold text-charcoal-950 block">Amplop Digital & QRIS</span>
                                <span class="text-sand-500 text-[11px]">{{ $invitation ? 'Nomor rekening aktif' : 'Belum diisi' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QUICK ACTIONS -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <a href="{{ route('member.invitations.create') }}" class="p-5 rounded-2xl glass-panel border border-sand-200 space-y-2 hover:border-amber-400 hover:shadow-md transition group">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center group-hover:scale-105 transition">
                            <i data-lucide="plus-circle" class="w-5 h-5"></i>
                        </div>
                        <h4 class="font-serif text-sm font-bold text-charcoal-950">Buat Undangan Baru</h4>
                        <p class="text-[11px] text-sand-600">Form pembuatan website undangan pernikahan digital lengkap.</p>
                    </a>

                    <a href="{{ route('themes.catalog') }}" class="p-5 rounded-2xl glass-panel border border-sand-200 space-y-2 hover:border-amber-400 hover:shadow-md transition group">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center group-hover:scale-105 transition">
                            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        </div>
                        <h4 class="font-serif text-sm font-bold text-charcoal-950">Katalog & Beli Tema</h4>
                        <p class="text-[11px] text-sand-600">Jelajahi dan beli tema eksklusif mulai Rp 49.000.</p>
                    </a>

                    <a href="{{ route('demo.index') }}" target="_blank" class="p-5 rounded-2xl glass-panel border border-sand-200 space-y-2 hover:border-amber-400 hover:shadow-md transition group">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center group-hover:scale-105 transition">
                            <i data-lucide="play" class="w-5 h-5"></i>
                        </div>
                        <h4 class="font-serif text-sm font-bold text-charcoal-950">Live Demo Contoh</h4>
                        <p class="text-[11px] text-sand-600">Lihat tampilan contoh undangan digital yang telah selesai.</p>
                    </a>
                </div>

            </div>

            <!-- RIGHT (COL-4): LIVE WISHES FEED -->
            <div class="lg:col-span-4 space-y-4">
                
                <div class="flex items-center justify-between">
                    <h3 class="font-serif text-xl font-bold text-charcoal-950">Ucapan Masuk Terbaru</h3>
                    @if($myWishesCount > 0)
                        <a href="{{ route('member.wishes.index') }}" class="text-xs font-bold text-amber-700 hover:underline">Lihat Semua</a>
                    @endif
                </div>

                <div class="rounded-3xl glass-panel border border-sand-200/80 p-5 space-y-4 shadow-sm">
                    @forelse($recentWishes as $wish)
                        <div class="p-4 rounded-2xl bg-sand-50/80 border border-sand-200/60 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-charcoal-950">{{ $wish->sender_name }}</span>
                                <span class="px-2 py-0.5 rounded-full {{ $wish->attendance_status === 'hadir' ? 'bg-emerald-100 text-emerald-800' : 'bg-sand-200 text-sand-700' }} text-[9px] font-bold">
                                    {{ ucfirst($wish->attendance_status ?? 'Hadir') }}
                                </span>
                            </div>
                            <p class="text-xs text-charcoal-900/80 leading-relaxed italic font-editorial text-sm">
                                "{{ $wish->message }}"
                            </p>
                            <span class="text-[10px] text-sand-400 block">{{ $wish->created_at ? $wish->created_at->diffForHumans() : 'Baru saja' }}</span>
                        </div>
                    @empty
                        <div class="py-8 px-4 text-center space-y-2">
                            <div class="w-10 h-10 rounded-2xl bg-sand-100 text-sand-500 flex items-center justify-center mx-auto">
                                <i data-lucide="message-square-off" class="w-5 h-5"></i>
                            </div>
                            <h4 class="text-xs font-bold text-charcoal-950">Belum Ada Ucapan</h4>
                            <p class="text-[11px] text-sand-500 leading-relaxed max-w-xs mx-auto">
                                Doa restu dan ucapan dari tamu undangan Anda akan otomatis tampil di sini setelah undangan disebarkan.
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>

        </div>

    </div>
</x-member-layout>
