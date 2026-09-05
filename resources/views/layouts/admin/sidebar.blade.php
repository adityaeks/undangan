<!-- ADMIN SIDEBAR NAVIGATION -->
<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-72 h-screen bg-charcoal-950 text-sand-200 flex flex-col justify-between transition-transform duration-300 ease-in-out border-r border-charcoal-800 shadow-2xl lg:translate-x-0"
>
    <!-- BRAND HEADER (FIXED AT TOP OF SIDEBAR) -->
    <div class="p-5 pb-4 flex items-center justify-between border-b border-charcoal-900/60 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-brand-400 via-brand-500 to-brand-700 text-white flex items-center justify-center font-serif font-bold text-lg shadow-md group-hover:scale-105 transition-transform duration-200">
                K
            </div>
            <div class="flex flex-col">
                <span class="font-serif text-xl font-bold tracking-tight text-white">
                    KlikMomen<span class="text-brand-400">.</span>
                </span>
                <span class="text-[10px] tracking-widest uppercase font-semibold text-brand-300">Admin Workspace</span>
            </div>
        </a>

        <!-- MOBILE CLOSE BUTTON -->
        <button @click="sidebarOpen = false" class="lg:hidden p-2 rounded-xl text-sand-400 hover:text-white hover:bg-charcoal-900 transition" aria-label="Tutup sidebar">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>

    <!-- NAVIGATION MENUS (SCROLLABLE INDEPENDENTLY) -->
    <div class="flex-1 overflow-y-auto px-5 py-4 space-y-6">
        <nav class="space-y-6">
            
            <!-- SECTION 1: MENU UTAMA -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Menu Utama</span>
                
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span>Dashboard Platform</span>
                </a>

                <a href="{{ route('demo.index') }}" target="_blank" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition group">
                    <div class="flex items-center gap-3">
                        <i data-lucide="play-circle" class="w-4 h-4 text-brand-400 group-hover:scale-110 transition"></i>
                        <span>Live Demo Undangan</span>
                    </div>
                    <i data-lucide="external-link" class="w-3 h-3 text-sand-500"></i>
                </a>
            </div>

            <!-- SECTION 2: MANAJEMEN PLATFORM -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Manajemen Platform</span>

                <a href="{{ route('admin.users.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="users" class="w-4 h-4 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Kelola Pengguna</span>
                    </div>
                </a>

                <a href="{{ route('invitations.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('invitations.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="mail-check" class="w-4 h-4 {{ request()->routeIs('invitations.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Monitoring Undangan</span>
                    </div>
                </a>

                <a href="{{ route('admin.coupons.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('admin.coupons.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="ticket" class="w-4 h-4 {{ request()->routeIs('admin.coupons.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Kupon & Diskon Promo</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full {{ request()->routeIs('admin.coupons.*') ? 'bg-white/20 text-white' : 'bg-brand-500/20 text-brand-300' }} text-[10px] font-bold">Promo</span>
                </a>

                <a href="{{ route('themes.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('themes.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="palette" class="w-4 h-4 {{ request()->routeIs('themes.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Katalog & Harga Tema</span>
                    </div>
                </a>
            </div>

            <!-- SECTION 3: KEMITRAAN & TRANSAKSI -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Kemitraan & Billing</span>

                <a href="{{ route('partners.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partners.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <i data-lucide="handshake" class="w-4 h-4 {{ request()->routeIs('partners.*') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span>Partner & Reseller WO</span>
                </a>

                <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('orders.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <i data-lucide="receipt" class="w-4 h-4 {{ request()->routeIs('orders.*') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span>Riwayat Transaksi</span>
                </a>

                <a href="{{ route('wishes.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('wishes.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <i data-lucide="message-square-heart" class="w-4 h-4 {{ request()->routeIs('wishes.*') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span>Moderasi Buku Tamu</span>
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
    <div class="p-4 border-t border-charcoal-800 bg-charcoal-950/60 shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2.5 px-4 py-3 rounded-2xl bg-charcoal-900 hover:bg-rose-950/50 text-sand-300 hover:text-rose-200 border border-charcoal-800 hover:border-rose-900/50 text-xs font-bold transition duration-200">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                <span>Keluar dari Akun</span>
            </button>
        </form>
    </div>
</aside>
