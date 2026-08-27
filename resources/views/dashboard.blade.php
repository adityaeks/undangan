<x-app-layout>
    <div class="space-y-8">
        
        <!-- ============================================== -->
        <!-- 1. HERO GREETING BANNER -->
        <!-- ============================================== -->
        <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-charcoal-950 via-charcoal-900 to-brand-950 p-6 sm:p-10 text-white shadow-xl border border-charcoal-800">
            <!-- DECORATIVE ACCENTS -->
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2 max-w-xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-[11px] font-bold text-amber-200 uppercase tracking-wider">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                        <span>{{ Auth::user()->role === 'super_admin' ? 'Super Admin Dashboard' : 'Member Workspace' }}</span>
                    </div>
                    <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight">
                        Selamat Datang, {{ Auth::user()->name }}! 👋
                    </h1>
                    <p class="text-xs sm:text-sm text-sand-300 leading-relaxed">
                        Kelola seluruh data undangan digital, pantau konfirmasi kehadiran (RSVP) tamu, serta monitoring kemitraan Wedding Organizer dari panel ini.
                    </p>
                </div>

                <!-- ACTIONS -->
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('demo.index') }}" target="_blank" class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs backdrop-blur-md transition flex items-center gap-2">
                        <i data-lucide="play" class="w-3.5 h-3.5 fill-current"></i>
                        <span>Live Preview Demo</span>
                    </a>
                    <a href="#buat-undangan" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs shadow-lg hover:shadow-brand-500/30 hover:scale-105 transition flex items-center gap-2">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>Buat Undangan Baru</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- ============================================== -->
        <!-- 2. STATS & METRICS OVERVIEW -->
        <!-- ============================================== -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <!-- CARD 1: UNDANGAN AKTIF -->
            <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Undangan Aktif</span>
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                        <i data-lucide="mail-check" class="w-5 h-5"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">1</div>
                    <p class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1 mt-1">
                        <i data-lucide="trending-up" class="w-3.5 h-3.5"></i>
                        <span>100% Online & Terpublikasi</span>
                    </p>
                </div>
            </div>

            <!-- CARD 2: TAMU TERUNDANG -->
            <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Total Tamu RSVP</span>
                    <div class="w-10 h-10 rounded-2xl bg-brand-50 text-brand-700 flex items-center justify-center">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">248 <span class="text-xs font-sans text-sand-500">Tamu</span></div>
                    <p class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1 mt-1">
                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                        <span>186 Konfirmasi Hadir (75%)</span>
                    </p>
                </div>
            </div>

            <!-- CARD 3: KATALOG TEMA -->
            <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Katalog Desain</span>
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center">
                        <i data-lucide="palette" class="w-5 h-5"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">6 <span class="text-xs font-sans text-sand-500">Tema Siap</span></div>
                    <p class="text-[11px] text-brand-600 font-semibold flex items-center gap-1 mt-1">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                        <span>50+ Template dalam Antrean</span>
                    </p>
                </div>
            </div>

            <!-- CARD 4: TRANSAKSI / WO PARTNER -->
            <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Kemitraan WO & Reseller</span>
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                        <i data-lucide="badge-dollar-sign" class="w-5 h-5"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">3 <span class="text-xs font-sans text-sand-500">Paket</span></div>
                    <p class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1 mt-1">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                        <span>100% White-Label Siap</span>
                    </p>
                </div>
            </div>

        </div>

        <!-- ============================================== -->
        <!-- 3. MAIN TABLE & GUESTBOOK ACTIVITY SPLIT -->
        <!-- ============================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- LEFT (COL-8): DAFTAR UNDANGAN AKTIF -->
            <div class="lg:col-span-8 space-y-4">
                
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-serif text-xl font-bold text-charcoal-950">Daftar Undangan Terdaftar</h2>
                        <p class="text-xs text-sand-600">Daftar website undangan digital yang telah dibuat dan aktif.</p>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-sand-200 text-charcoal-900 text-xs font-bold">Total: 1</span>
                </div>

                <!-- INVITATION ITEM CARD -->
                <div class="rounded-3xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-sand-200/60">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-cover bg-center border border-sand-300 shadow-sm flex-shrink-0" style="background-image: url('https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=400&auto=format&fit=crop&q=80');"></div>
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-serif text-lg font-bold text-charcoal-950">The Wedding of Raka & Arinda</h3>
                                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase tracking-wider">Online</span>
                                </div>
                                <p class="text-xs text-sand-600">Tema: <span class="font-semibold text-charcoal-900">The Monochrome Elegance</span> • Tanggal: <span class="font-semibold text-charcoal-900">24 Oktober 2026</span></p>
                                <p class="text-[11px] text-sand-500">Slug URL: <a href="{{ route('demo.index') }}" target="_blank" class="font-mono text-brand-600 hover:underline">/demo (raka-arinda)</a></p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <a href="{{ route('demo.index') }}" target="_blank" class="flex-1 sm:flex-none px-4 py-2.5 rounded-2xl bg-charcoal-950 hover:bg-brand-600 text-white font-bold text-xs transition flex items-center justify-center gap-1.5 shadow">
                                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                <span>Lihat Undangan</span>
                            </a>
                        </div>
                    </div>

                    <!-- SUB-STATS OF INVITATION -->
                    <div class="bg-sand-50/80 px-6 py-4 grid grid-cols-3 gap-4 text-center divide-x divide-sand-200 text-xs">
                        <div>
                            <span class="text-sand-500 text-[10px] uppercase font-bold block">Tamu Terdaftar</span>
                            <span class="font-serif text-base font-bold text-charcoal-950">248</span>
                        </div>
                        <div>
                            <span class="text-sand-500 text-[10px] uppercase font-bold block">RSVP Hadir</span>
                            <span class="font-serif text-base font-bold text-emerald-600">186</span>
                        </div>
                        <div>
                            <span class="text-sand-500 text-[10px] uppercase font-bold block">Amplop Digital</span>
                            <span class="font-serif text-base font-bold text-brand-600">2 Rekening</span>
                        </div>
                    </div>
                </div>

                <!-- QUICK ACTIONS GRID -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                    <div class="p-5 rounded-2xl glass-panel border border-sand-200 space-y-2 hover:border-brand-400 transition cursor-pointer">
                        <div class="w-9 h-9 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center">
                            <i data-lucide="user-plus" class="w-4 h-4"></i>
                        </div>
                        <h4 class="font-serif text-sm font-bold text-charcoal-950">Tambah Data Tamu</h4>
                        <p class="text-[11px] text-sand-600">Generate link undangan personal dengan nama khusus tamu.</p>
                    </div>

                    <div class="p-5 rounded-2xl glass-panel border border-sand-200 space-y-2 hover:border-brand-400 transition cursor-pointer">
                        <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center">
                            <i data-lucide="wallet" class="w-4 h-4"></i>
                        </div>
                        <h4 class="font-serif text-sm font-bold text-charcoal-950">Atur Amplop Digital</h4>
                        <p class="text-[11px] text-sand-600">Konfigurasi rekening Bank BCA, Mandiri, dan QRIS instan.</p>
                    </div>

                    <div class="p-5 rounded-2xl glass-panel border border-sand-200 space-y-2 hover:border-brand-400 transition cursor-pointer">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <i data-lucide="music" class="w-4 h-4"></i>
                        </div>
                        <h4 class="font-serif text-sm font-bold text-charcoal-950">Musik & Foto Galeri</h4>
                        <p class="text-[11px] text-sand-600">Ganti lagu latar pernikahan dan unggah foto prewedding.</p>
                    </div>
                </div>

            </div>

            <!-- RIGHT (COL-4): UCAPAN & DOA TERBARU (LIVE FEED) -->
            <div class="lg:col-span-4 space-y-4">
                
                <div class="flex items-center justify-between">
                    <h2 class="font-serif text-xl font-bold text-charcoal-950">Ucapan Tamu Terbaru</h2>
                    <span class="text-xs font-bold text-brand-600 cursor-pointer hover:underline">Lihat Semua</span>
                </div>

                <div class="rounded-3xl glass-panel border border-sand-200/80 p-5 space-y-4 shadow-sm">
                    
                    <!-- WISH 1 -->
                    <div class="p-4 rounded-2xl bg-sand-50/80 border border-sand-200/60 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-charcoal-950">Dimas Anggara</span>
                            <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[9px] font-bold">Hadir</span>
                        </div>
                        <p class="text-xs text-charcoal-900/80 leading-relaxed italic font-editorial text-sm">
                            "Selamat menempuh hidup baru Raka & Arinda! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Aamiin."
                        </p>
                        <span class="text-[10px] text-sand-400 block">5 menit yang lalu</span>
                    </div>

                    <!-- WISH 2 -->
                    <div class="p-4 rounded-2xl bg-sand-50/80 border border-sand-200/60 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-charcoal-950">Siti Nurhaliza & Keluarga</span>
                            <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[9px] font-bold">Hadir</span>
                        </div>
                        <p class="text-xs text-charcoal-900/80 leading-relaxed italic font-editorial text-sm">
                            "Barakallahu lakum wa baraka alaikum. Bahagia selalu sampai kakek nenek ya kalian berdua!"
                        </p>
                        <span class="text-[10px] text-sand-400 block">1 jam yang lalu</span>
                    </div>

                    <!-- WISH 3 -->
                    <div class="p-4 rounded-2xl bg-sand-50/80 border border-sand-200/60 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-charcoal-950">Budi Santoso</span>
                            <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[9px] font-bold">Masih Ragu</span>
                        </div>
                        <p class="text-xs text-charcoal-900/80 leading-relaxed italic font-editorial text-sm">
                            "InsyaAllah saya usahakan hadir bro. Sukses lancar sampai hari H ya!"
                        </p>
                        <span class="text-[10px] text-sand-400 block">3 jam yang lalu</span>
                    </div>

                </div>

            </div>

        </div>

    </div>
</x-app-layout>
