<!-- PARTNER SIDEBAR NAVIGATION -->
<aside 
    :class="[
        sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
        sidebarCollapsed ? 'lg:w-20' : 'lg:w-72'
    ]"
    class="sidebar-collapsible fixed inset-y-0 left-0 z-50 w-72 h-screen bg-charcoal-950 text-sand-200 flex flex-col justify-between transition-[width,transform] duration-300 ease-in-out border-r border-charcoal-800 shadow-2xl lg:translate-x-0"
>
    <!-- BRAND HEADER -->
    <div 
        class="sidebar-header-box p-5 pb-4 flex items-center justify-between border-b border-charcoal-900/60 shrink-0 transition-all duration-300"
        :class="sidebarCollapsed ? 'lg:px-3 lg:justify-center' : ''"
    >
        <a href="{{ route('partner.dashboard') }}" class="flex items-center gap-3 group overflow-hidden" :title="sidebarCollapsed ? 'KlikMomen - Partner & WO Portal' : ''">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-400 via-amber-500 to-brand-600 text-white flex items-center justify-center font-serif font-bold text-lg shadow-md group-hover:scale-105 transition-transform duration-200 shrink-0">
                K
            </div>
            <div class="sidebar-brand-text flex flex-col whitespace-nowrap" :class="sidebarCollapsed ? 'lg:hidden' : ''">
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
    <div 
        id="sidebar-nav-scroll" 
        data-sidebar-scroll="partner" 
        class="flex-1 overflow-y-auto px-5 py-4 space-y-6 transition-all duration-300"
        :class="sidebarCollapsed ? 'lg:px-2.5' : ''"
    >
        <nav class="space-y-6">
            
            <!-- SECTION 1: MENU UTAMA -->
            <div class="space-y-1.5">
                <span class="sidebar-section-title px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500 block" :class="sidebarCollapsed ? 'lg:hidden' : ''">Menu Utama</span>
                <div class="sidebar-section-divider hidden my-2 border-t border-charcoal-900" :class="sidebarCollapsed ? 'lg:block' : ''"></div>
                
                <a href="{{ route('partner.dashboard') }}" 
                   class="sidebar-nav-link flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partner.dashboard') || request()->routeIs('dashboard') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('partner.dashboard') || request()->routeIs('dashboard') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Dashboard Partner"
                >
                    <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0 {{ request()->routeIs('partner.dashboard') || request()->routeIs('dashboard') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Dashboard Partner</span>
                </a>

                <a href="{{ route('demo.index') }}" 
                   target="_blank" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition group"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Live Demo Undangan"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="play-circle" class="w-4 h-4 shrink-0 text-amber-400 group-hover:scale-110 transition"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Live Demo Undangan</span>
                    </div>
                    <i data-lucide="external-link" class="w-3 h-3 text-sand-500 shrink-0" :class="sidebarCollapsed ? 'lg:hidden' : ''"></i>
                </a>
            </div>

            <!-- SECTION 2: KLIEN & UNDANGAN -->
            <div class="space-y-1.5">
                <span class="sidebar-section-title px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500 block" :class="sidebarCollapsed ? 'lg:hidden' : ''">Klien & Undangan</span>
                <div class="sidebar-section-divider hidden my-2 border-t border-charcoal-900" :class="sidebarCollapsed ? 'lg:block' : ''"></div>

                <a href="{{ route('partner.clients.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partner.clients.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('partner.clients.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Kelola Klien WO"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="users" class="w-4 h-4 shrink-0 {{ request()->routeIs('partner.clients.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Kelola Klien WO</span>
                    </div>
                </a>

                <a href="{{ route('partner.invitations.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partner.invitations.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('partner.invitations.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Undangan Klien"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="mail-check" class="w-4 h-4 shrink-0 {{ request()->routeIs('partner.invitations.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Undangan Klien</span>
                    </div>
                </a>

                <a href="{{ route('partner.guests.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partner.guests.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('partner.guests.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Buku Tamu & Sebar WA"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="send" class="w-4 h-4 shrink-0 {{ request()->routeIs('partner.guests.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Buku Tamu & Sebar WA</span>
                    </div>
                </a>

                <a href="{{ route('partner.packages.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partner.packages.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('partner.packages.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Paket & Kuota WO"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="award" class="w-4 h-4 shrink-0 {{ request()->routeIs('partner.packages.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Paket & Kuota WO</span>
                    </div>
                </a>
            </div>

            <!-- SECTION 3: PENGATURAN -->
            <div class="space-y-1.5">
                <span class="sidebar-section-title px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500 block" :class="sidebarCollapsed ? 'lg:hidden' : ''">Akun & Sistem</span>
                <div class="sidebar-section-divider hidden my-2 border-t border-charcoal-900" :class="sidebarCollapsed ? 'lg:block' : ''"></div>

                <a href="{{ route('profile.edit') }}" 
                   class="sidebar-nav-link flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('profile.edit') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('profile.edit') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Pengaturan Profil"
                >
                    <i data-lucide="settings" class="w-4 h-4 shrink-0 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Pengaturan Profil</span>
                </a>
            </div>

        </nav>
    </div>

    <!-- BOTTOM LOGOUT -->
    <div 
        class="sidebar-logout-box p-4 border-t border-charcoal-800 bg-charcoal-950/60 shrink-0 transition-all duration-300"
        :class="sidebarCollapsed ? 'lg:p-2 lg:flex lg:justify-center' : ''"
    >
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button 
                type="submit" 
                class="sidebar-logout-button w-full flex items-center justify-center gap-2.5 px-4 py-3 rounded-2xl bg-charcoal-900 hover:bg-rose-950/50 text-sand-300 hover:text-rose-200 border border-charcoal-800 hover:border-rose-900/50 text-xs font-bold transition duration-200"
                :class="sidebarCollapsed ? 'lg:px-0 lg:py-3' : ''"
                title="Keluar dari Akun"
            >
                <i data-lucide="log-out" class="w-4 h-4 shrink-0"></i>
                <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Keluar dari Akun</span>
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
