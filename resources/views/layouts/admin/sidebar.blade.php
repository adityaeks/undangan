<!-- ADMIN SIDEBAR NAVIGATION -->
<aside 
    :class="[
        sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
        sidebarCollapsed ? 'lg:w-20' : 'lg:w-72'
    ]"
    class="sidebar-collapsible fixed inset-y-0 left-0 z-50 w-72 h-screen bg-charcoal-950 text-sand-200 flex flex-col justify-between transition-[width,transform] duration-300 ease-in-out border-r border-charcoal-800 shadow-2xl lg:translate-x-0"
>
    <!-- BRAND HEADER (FIXED AT TOP OF SIDEBAR) -->
    <div 
        class="sidebar-header-box p-5 pb-4 flex items-center justify-between border-b border-charcoal-900/60 shrink-0 transition-all duration-300"
        :class="sidebarCollapsed ? 'lg:px-3 lg:justify-center' : ''"
    >
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group overflow-hidden" :title="sidebarCollapsed ? 'KlikMomen - Admin Workspace' : ''">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-brand-400 via-brand-500 to-brand-700 text-white flex items-center justify-center font-serif font-bold text-lg shadow-md group-hover:scale-105 transition-transform duration-200 shrink-0">
                K
            </div>
            <div class="sidebar-brand-text flex flex-col whitespace-nowrap" :class="sidebarCollapsed ? 'lg:hidden' : ''">
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
    <div 
        id="sidebar-nav-scroll" 
        data-sidebar-scroll="admin" 
        class="flex-1 overflow-y-auto px-5 py-4 space-y-6 transition-all duration-300"
        :class="sidebarCollapsed ? 'lg:px-2.5' : ''"
    >
        <nav class="space-y-6">
            
            <!-- SECTION 1: MENU UTAMA -->
            <div class="space-y-1.5">
                <span class="sidebar-section-title px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500 block" :class="sidebarCollapsed ? 'lg:hidden' : ''">Menu Utama</span>
                <div class="sidebar-section-divider hidden my-2 border-t border-charcoal-900" :class="sidebarCollapsed ? 'lg:block' : ''"></div>
                
                <a href="{{ route('dashboard') }}" 
                   class="sidebar-nav-link flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Dashboard Platform"
                >
                    <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0 {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Dashboard Platform</span>
                </a>

                <a href="{{ route('demo.index') }}" 
                   target="_blank" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition group"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Live Demo Undangan"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="play-circle" class="w-4 h-4 shrink-0 text-brand-400 group-hover:scale-110 transition"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Live Demo Undangan</span>
                    </div>
                    <i data-lucide="external-link" class="w-3 h-3 text-sand-500 shrink-0" :class="sidebarCollapsed ? 'lg:hidden' : ''"></i>
                </a>
            </div>

            <!-- SECTION 2: MANAJEMEN PLATFORM -->
            <div class="space-y-1.5">
                <span class="sidebar-section-title px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500 block" :class="sidebarCollapsed ? 'lg:hidden' : ''">Manajemen Platform</span>
                <div class="sidebar-section-divider hidden my-2 border-t border-charcoal-900" :class="sidebarCollapsed ? 'lg:block' : ''"></div>

                <a href="{{ route('admin.users.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('admin.users.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Kelola Pengguna"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="users" class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Kelola Pengguna</span>
                    </div>
                </a>

                <a href="{{ route('invitations.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('invitations.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('invitations.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Monitoring Undangan"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="mail-check" class="w-4 h-4 shrink-0 {{ request()->routeIs('invitations.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Monitoring Undangan</span>
                    </div>
                </a>

                <a href="{{ route('admin.coupons.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('admin.coupons.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }} relative" 
                   {{ request()->routeIs('admin.coupons.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Kupon & Diskon Promo"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="ticket" class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.coupons.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Kupon & Diskon Promo</span>
                    </div>
                    <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-badge-count px-2 py-0.5 rounded-full {{ request()->routeIs('admin.coupons.*') ? 'bg-white/20 text-white' : 'bg-brand-500/20 text-brand-300' }} text-[10px] font-bold">Promo</span>
                </a>

                <a href="{{ route('themes.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('themes.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('themes.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Katalog & Harga Tema"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="palette" class="w-4 h-4 shrink-0 {{ request()->routeIs('themes.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Katalog & Harga Tema</span>
                    </div>
                </a>
            </div>

            <!-- SECTION 3: KEMITRAAN & TRANSAKSI -->
            <div class="space-y-1.5">
                <span class="sidebar-section-title px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500 block" :class="sidebarCollapsed ? 'lg:hidden' : ''">Kemitraan & Billing</span>
                <div class="sidebar-section-divider hidden my-2 border-t border-charcoal-900" :class="sidebarCollapsed ? 'lg:block' : ''"></div>

                <a href="{{ route('partners.index') }}" 
                   class="sidebar-nav-link flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('partners.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('partners.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Partner & Reseller WO"
                >
                    <i data-lucide="handshake" class="w-4 h-4 shrink-0 {{ request()->routeIs('partners.*') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Partner & Reseller WO</span>
                </a>

                <a href="{{ route('orders.index') }}" 
                   class="sidebar-nav-link flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('orders.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('orders.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Riwayat Transaksi"
                >
                    <i data-lucide="receipt" class="w-4 h-4 shrink-0 {{ request()->routeIs('orders.*') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Riwayat Transaksi</span>
                </a>

                <a href="{{ route('wishes.index') }}" 
                   class="sidebar-nav-link flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('wishes.*') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('wishes.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Moderasi Buku Tamu"
                >
                    <i data-lucide="message-square-heart" class="w-4 h-4 shrink-0 {{ request()->routeIs('wishes.*') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Moderasi Buku Tamu</span>
                </a>
            </div>

            <!-- SECTION 4: PENGATURAN AKUN -->
            <div class="space-y-1.5">
                <span class="sidebar-section-title px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500 block" :class="sidebarCollapsed ? 'lg:hidden' : ''">Sistem & Akun</span>
                <div class="sidebar-section-divider hidden my-2 border-t border-charcoal-900" :class="sidebarCollapsed ? 'lg:block' : ''"></div>

                <a href="{{ route('profile.edit') }}" 
                   class="sidebar-nav-link flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('profile.edit') ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
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

    <!-- BOTTOM LOGOUT ACTION -->
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

            const roleKey = 'sidebar_scroll_' + (nav.dataset.sidebarScroll || 'admin');

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
