<!-- MEMBER SIDEBAR NAVIGATION -->
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
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group overflow-hidden" :title="sidebarCollapsed ? 'KlikMomen - Portal Pengantin' : ''">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-400 via-brand-500 to-amber-600 text-white flex items-center justify-center font-serif font-bold text-lg shadow-md group-hover:scale-105 transition-transform duration-200 shrink-0">
                K
            </div>
            <div class="sidebar-brand-text flex flex-col whitespace-nowrap" :class="sidebarCollapsed ? 'lg:hidden' : ''">
                <span class="font-serif text-xl font-bold tracking-tight text-white">
                    KlikMomen<span class="text-amber-400">.</span>
                </span>
                <span class="text-[10px] tracking-widest uppercase font-semibold text-amber-300">Portal Pengantin</span>
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
        data-sidebar-scroll="member" 
        class="flex-1 overflow-y-auto px-5 py-4 space-y-6 transition-all duration-300"
        :class="sidebarCollapsed ? 'lg:px-2.5' : ''"
    >
        <nav class="space-y-6">
            
@php
    $memberInvitationsCount = Auth::user()->invitations()->count();
    $activeInvitation = Auth::user()->invitations()->latest()->first();
@endphp

            <!-- SECTION 1: MENU UTAMA -->
            <div class="space-y-1.5">
                <span class="sidebar-section-title px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500 block" :class="sidebarCollapsed ? 'lg:hidden' : ''">Menu Utama</span>
                <div class="sidebar-section-divider hidden my-2 border-t border-charcoal-900" :class="sidebarCollapsed ? 'lg:block' : ''"></div>
                
                <a href="{{ route('dashboard') }}" 
                   class="sidebar-nav-link flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('dashboard') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Dashboard"
                >
                    <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Dashboard</span>
                </a>
                <a href="{{ route('member.orders.index') }}" 
                   class="sidebar-nav-link flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('member.orders.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('member.orders.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Riwayat Transaksi"
                >
                    <i data-lucide="receipt" class="w-4 h-4 shrink-0 {{ request()->routeIs('member.orders.*') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Riwayat Transaksi</span>
                </a>
            </div>

            <!-- SECTION 2: KELOLA PERNIKAHAN -->
            <div class="space-y-1.5">
                <span class="sidebar-section-title px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500 block" :class="sidebarCollapsed ? 'lg:hidden' : ''">Undangan & Tamu</span>
                <div class="sidebar-section-divider hidden my-2 border-t border-charcoal-900" :class="sidebarCollapsed ? 'lg:block' : ''"></div>

                <a href="{{ route('member.invitations.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('member.invitations.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }} relative" 
                   {{ request()->routeIs('member.invitations.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Undangan Saya"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="heart-handshake" class="w-4 h-4 shrink-0 {{ request()->routeIs('member.invitations.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Undangan Saya</span>
                    </div>
                    <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-badge-count px-2 py-0.5 rounded-full {{ request()->routeIs('member.invitations.*') ? 'bg-white/20 text-white' : 'bg-charcoal-800 text-amber-300' }} text-[10px] font-bold">{{ $memberInvitationsCount }}</span>
                    @if($memberInvitationsCount > 0)
                        <span :class="sidebarCollapsed ? 'lg:block' : 'hidden'" class="sidebar-indicator-dot hidden absolute top-1.5 right-2 w-2 h-2 rounded-full bg-amber-400 ring-2 ring-charcoal-950"></span>
                    @endif
                </a>

                <a href="{{ route('member.themes.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('member.themes.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }} relative" 
                   {{ request()->routeIs('member.themes.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Template Saya"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="palette" class="w-4 h-4 shrink-0 {{ request()->routeIs('member.themes.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Template Saya</span>
                    </div>
                    @php
                        $sidebarThemesCount = Auth::user()->isSuperAdmin() ? \App\Models\Theme::where('is_active', true)->count() : Auth::user()->themes()->count();
                    @endphp
                    @if($sidebarThemesCount > 0)
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-badge-count px-2 py-0.5 rounded-full {{ request()->routeIs('member.themes.*') ? 'bg-white/20 text-white' : 'bg-amber-500/20 text-amber-300' }} text-[10px] font-bold">{{ $sidebarThemesCount }}</span>
                        <span :class="sidebarCollapsed ? 'lg:block' : 'hidden'" class="sidebar-indicator-dot hidden absolute top-1.5 right-2 w-2 h-2 rounded-full bg-amber-400 ring-2 ring-charcoal-950"></span>
                    @endif
                </a>

                <a href="{{ route('member.guests.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('member.guests.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('member.guests.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Daftar Tamu & Kirim WA"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="users" class="w-4 h-4 shrink-0 {{ request()->routeIs('member.guests.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Daftar Tamu & Kirim WA</span>
                    </div>
                </a>

                <a href="{{ route('member.wishes.index') }}" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('member.wishes.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('member.wishes.*') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Buku Tamu & Ucapan"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="message-square-heart" class="w-4 h-4 shrink-0 {{ request()->routeIs('member.wishes.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Buku Tamu & Ucapan</span>
                    </div>
                </a>
            </div>

            <!-- SECTION 4: AKUN & BANTUAN -->
            <div class="space-y-1.5">
                <span class="sidebar-section-title px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500 block" :class="sidebarCollapsed ? 'lg:hidden' : ''">Akun & Layanan</span>
                <div class="sidebar-section-divider hidden my-2 border-t border-charcoal-900" :class="sidebarCollapsed ? 'lg:block' : ''"></div>

                <a href="{{ route('profile.edit') }}" 
                   class="sidebar-nav-link flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('profile.edit') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}" 
                   {{ request()->routeIs('profile.edit') ? 'data-active-link="true"' : '' }}
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Pengaturan Akun"
                >
                    <i data-lucide="settings" class="w-4 h-4 shrink-0 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Pengaturan Akun</span>
                </a>

                <a href="https://wa.me/?text=Halo%20Admin%20KlikMomen,%20saya%20butuh%20bantuan%20undangan%20pernikahan%20saya" 
                   target="_blank" 
                   class="sidebar-nav-link flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-emerald-400 hover:bg-emerald-950/30 transition"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0 lg:py-3' : ''"
                   title="Bantuan & CS WhatsApp"
                >
                    <div class="flex items-center gap-3">
                        <i data-lucide="help-circle" class="w-4 h-4 shrink-0 text-emerald-400"></i>
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="sidebar-label-text truncate">Bantuan & CS WhatsApp</span>
                    </div>
                    <i data-lucide="arrow-up-right" class="w-3 h-3 shrink-0" :class="sidebarCollapsed ? 'lg:hidden' : ''"></i>
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

            const roleKey = 'sidebar_scroll_' + (nav.dataset.sidebarScroll || 'member');

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
