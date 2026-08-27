<!-- ADMIN SIDEBAR NAVIGATION -->
<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-charcoal-950 text-sand-200 flex flex-col justify-between transition-transform duration-300 ease-in-out border-r border-charcoal-800 shadow-2xl lg:static lg:translate-x-0"
>
    <!-- TOP BRAND & USER PROFILE -->
    <div class="flex-1 overflow-y-auto px-5 py-6 space-y-6">
        
        <!-- BRAND HEADER -->
        <div class="flex items-center justify-between px-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-brand-400 via-brand-500 to-brand-700 text-white flex items-center justify-center font-serif font-bold text-lg shadow-md group-hover:scale-105 transition-transform duration-200">
                    K
                </div>
                <div class="flex flex-col">
                    <span class="font-serif text-xl font-bold tracking-tight text-white">
                        KalaUndangan<span class="text-brand-400">.</span>
                    </span>
                    <span class="text-[10px] tracking-widest uppercase font-semibold text-brand-300">Admin Workspace</span>
                </div>
            </a>

            <!-- MOBILE CLOSE BUTTON -->
            <button @click="sidebarOpen = false" class="lg:hidden p-2 rounded-xl text-sand-400 hover:text-white hover:bg-charcoal-900 transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- USER INFO MINI CARD -->
        <div class="p-3.5 rounded-2xl bg-charcoal-900/90 border border-charcoal-800 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-600 to-amber-700 text-white flex items-center justify-center font-bold text-sm shadow">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-1.5">
                    <h4 class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</h4>
                </div>
                <p class="text-[11px] text-sand-400 truncate">{{ Auth::user()->email }}</p>
                <div class="mt-1">
                    @if(Auth::user()->role === 'super_admin')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-500/20 text-amber-300 text-[9px] font-extrabold uppercase tracking-wider border border-amber-500/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                            Super Admin
                        </span>
                    @elseif(Auth::user()->role === 'partner')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-brand-500/20 text-brand-300 text-[9px] font-extrabold uppercase tracking-wider border border-brand-500/30">
                            Partner WO
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-slate-500/20 text-slate-300 text-[9px] font-extrabold uppercase tracking-wider border border-slate-500/30">
                            Pengguna
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- NAVIGATION MENUS -->
        <nav class="space-y-6 pt-2">
            
            <!-- SECTION 1: MENU UTAMA -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Menu Utama</span>
                
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('demo.index') }}" target="_blank" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition group">
                    <div class="flex items-center gap-3">
                        <i data-lucide="play-circle" class="w-4 h-4 text-brand-400 group-hover:scale-110 transition"></i>
                        <span>Live Demo Undangan</span>
                    </div>
                    <i data-lucide="external-link" class="w-3 h-3 text-sand-500"></i>
                </a>
            </div>

            <!-- SECTION 2: KELOLA UNDANGAN -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Undangan & Acara</span>

                <a href="#daftar-undangan" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition">
                    <div class="flex items-center gap-3">
                        <i data-lucide="mail-open" class="w-4 h-4 text-sand-400"></i>
                        <span>Daftar Undangan</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-charcoal-800 text-[10px] text-brand-300 font-bold">1</span>
                </a>

                <a href="#koleksi-tema" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition">
                    <div class="flex items-center gap-3">
                        <i data-lucide="palette" class="w-4 h-4 text-sand-400"></i>
                        <span>Katalog Tema</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-brand-500/20 text-[10px] text-brand-300 font-bold">50+</span>
                </a>

                <a href="#tamu-rsvp" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition">
                    <i data-lucide="users" class="w-4 h-4 text-sand-400"></i>
                    <span>Daftar Tamu & RSVP</span>
                </a>

                <a href="#ucapan-doa" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition">
                    <i data-lucide="message-square-heart" class="w-4 h-4 text-sand-400"></i>
                    <span>Buku Tamu & Ucapan</span>
                </a>
            </div>

            <!-- SECTION 3: KEMITRAAN & TRANSAKSI -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Kemitraan & Billing</span>

                <a href="#partner-wo" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition">
                    <i data-lucide="handshake" class="w-4 h-4 text-sand-400"></i>
                    <span>Partner & Reseller WO</span>
                </a>

                <a href="#transaksi" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition">
                    <i data-lucide="receipt" class="w-4 h-4 text-sand-400"></i>
                    <span>Riwayat Transaksi</span>
                </a>
            </div>

            <!-- SECTION 4: PENGATURAN AKUN -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Sistem & Akun</span>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('profile.edit') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <i data-lucide="settings" class="w-4 h-4 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span>Pengaturan Profil</span>
                </a>
            </div>

        </nav>
    </div>

    <!-- BOTTOM LOGOUT ACTION -->
    <div class="p-4 border-t border-charcoal-800 bg-charcoal-950/60">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2.5 px-4 py-3 rounded-2xl bg-charcoal-900 hover:bg-rose-950/50 text-sand-300 hover:text-rose-200 border border-charcoal-800 hover:border-rose-900/50 text-xs font-bold transition duration-200">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                <span>Keluar dari Akun</span>
            </button>
        </form>
    </div>
</aside>
