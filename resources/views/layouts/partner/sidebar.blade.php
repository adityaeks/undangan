<!-- PARTNER SIDEBAR NAVIGATION -->
<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-72 h-screen bg-charcoal-950 text-sand-200 flex flex-col justify-between transition-transform duration-300 ease-in-out border-r border-charcoal-800 shadow-2xl lg:translate-x-0"
>
    <!-- BRAND HEADER -->
    <div class="p-5 pb-4 flex items-center justify-between border-b border-charcoal-900/60 shrink-0">
        <a href="{{ route('partner.dashboard') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-400 via-amber-500 to-brand-600 text-white flex items-center justify-center font-serif font-bold text-lg shadow-md group-hover:scale-105 transition-transform duration-200">
                K
            </div>
            <div class="flex flex-col">
                <span class="font-serif text-xl font-bold tracking-tight text-white">
                    KlikMomen<span class="text-amber-400">.</span>
                </span>
                <span class="text-[10px] tracking-widest uppercase font-semibold text-amber-300">Partner & WO Portal</span>
            </div>
        </a>

        <!-- MOBILE CLOSE BUTTON -->
        <button @click="sidebarOpen = false" class="lg:hidden p-2 rounded-xl text-sand-400 hover:text-white hover:bg-charcoal-900 transition" aria-label="Tutup sidebar">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>

    <!-- NAVIGATION MENUS -->
    <div id="sidebar-nav-scroll" data-sidebar-scroll="partner" class="flex-1 overflow-y-auto px-5 py-4 space-y-6">
        <nav class="space-y-6">
            
            <!-- SECTION 1: MENU UTAMA -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Menu Utama</span>
                
                <a href="{{ route('partner.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partner.dashboard') || request()->routeIs('dashboard') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" {{ request()->routeIs('partner.dashboard') || request()->routeIs('dashboard') ? 'data-active-link="true"' : '' }}>
                    <i data-lucide="layout-dashboard" class="w-4 h-4 {{ request()->routeIs('partner.dashboard') || request()->routeIs('dashboard') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span>Dashboard Partner</span>
                </a>

                <a href="{{ route('demo.index') }}" target="_blank" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition group">
                    <div class="flex items-center gap-3">
                        <i data-lucide="play-circle" class="w-4 h-4 text-amber-400 group-hover:scale-110 transition"></i>
                        <span>Live Demo Undangan</span>
                    </div>
                    <i data-lucide="external-link" class="w-3 h-3 text-sand-500"></i>
                </a>
            </div>

            <!-- SECTION 2: KLIEN & UNDANGAN -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Klien & Undangan</span>

                <a href="{{ route('partner.clients.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partner.clients.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" {{ request()->routeIs('partner.clients.*') ? 'data-active-link="true"' : '' }}>
                    <div class="flex items-center gap-3">
                        <i data-lucide="users" class="w-4 h-4 {{ request()->routeIs('partner.clients.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Kelola Klien WO</span>
                    </div>
                </a>

                <a href="{{ route('partner.invitations.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partner.invitations.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" {{ request()->routeIs('partner.invitations.*') ? 'data-active-link="true"' : '' }}>
                    <div class="flex items-center gap-3">
                        <i data-lucide="mail-check" class="w-4 h-4 {{ request()->routeIs('partner.invitations.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Undangan Klien</span>
                    </div>
                </a>

                <a href="{{ route('partner.guests.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partner.guests.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" {{ request()->routeIs('partner.guests.*') ? 'data-active-link="true"' : '' }}>
                    <div class="flex items-center gap-3">
                        <i data-lucide="send" class="w-4 h-4 {{ request()->routeIs('partner.guests.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Buku Tamu & Sebar WA</span>
                    </div>
                </a>

                <a href="{{ route('partner.packages.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partner.packages.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" {{ request()->routeIs('partner.packages.*') ? 'data-active-link="true"' : '' }}>
                    <div class="flex items-center gap-3">
                        <i data-lucide="award" class="w-4 h-4 {{ request()->routeIs('partner.packages.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Paket & Kuota WO</span>
                    </div>
                </a>
            </div>

            <!-- SECTION 3: PENGATURAN -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Akun & Sistem</span>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('profile.edit') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" {{ request()->routeIs('profile.edit') ? 'data-active-link="true"' : '' }}>
                    <i data-lucide="settings" class="w-4 h-4 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span>Pengaturan Profil</span>
                </a>
            </div>

        </nav>
    </div>

    <!-- BOTTOM LOGOUT -->
    <div class="p-4 border-t border-charcoal-800 bg-charcoal-950/60 shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2.5 px-4 py-3 rounded-2xl bg-charcoal-900 hover:bg-rose-950/50 text-sand-300 hover:text-rose-200 border border-charcoal-800 hover:border-rose-900/50 text-xs font-bold transition duration-200">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                <span>Keluar dari Akun</span>
            </button>
        </form>
    </div>

    <!-- SCRIPT FOR PERSISTING SIDEBAR SCROLL POSITION -->
    <script>
        (function () {
            const nav = document.getElementById('sidebar-nav-scroll');
            if (!nav) return;

            const roleKey = 'sidebar_scroll_' + (nav.dataset.sidebarScroll || 'partner');

            function restoreScroll() {
                const saved = sessionStorage.getItem(roleKey);
                if (saved !== null) {
                    nav.scrollTop = parseInt(saved, 10);
                }

                const active = nav.querySelector('[data-active-link="true"]');
                if (active) {
                    const navRect = nav.getBoundingClientRect();
                    const activeRect = active.getBoundingClientRect();
                    if (saved === null || activeRect.top < navRect.top || activeRect.bottom > navRect.bottom) {
                        active.scrollIntoView({ block: 'nearest', behavior: 'instant' });
                    }
                }
            }

            restoreScroll();
            document.addEventListener('DOMContentLoaded', restoreScroll);
            window.addEventListener('load', restoreScroll);

            let ticking = false;
            nav.addEventListener('scroll', function () {
                if (!ticking) {
                    window.requestAnimationFrame(function () {
                        sessionStorage.setItem(roleKey, nav.scrollTop);
                        ticking = false;
                    });
                    ticking = true;
                }
            }, { passive: true });

            nav.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    sessionStorage.setItem(roleKey, nav.scrollTop);
                });
            });
        })();
    </script>
</aside>
