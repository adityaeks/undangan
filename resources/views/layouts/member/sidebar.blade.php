<!-- MEMBER SIDEBAR NAVIGATION -->
<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-72 h-screen bg-charcoal-950 text-sand-200 flex flex-col justify-between transition-transform duration-300 ease-in-out border-r border-charcoal-800 shadow-2xl lg:translate-x-0"
>
    <!-- BRAND HEADER (FIXED AT TOP OF SIDEBAR) -->
    <div class="p-5 pb-4 flex items-center justify-between border-b border-charcoal-900/60 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-400 via-brand-500 to-amber-600 text-white flex items-center justify-center font-serif font-bold text-lg shadow-md group-hover:scale-105 transition-transform duration-200">
                K
            </div>
            <div class="flex flex-col">
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
    <div class="flex-1 overflow-y-auto px-5 py-4 space-y-6">
        <nav class="space-y-6">
            
@php
    $memberInvitationsCount = Auth::user()->invitations()->count();
    $activeInvitation = Auth::user()->invitations()->latest()->first();
@endphp

            <!-- SECTION 1: MENU UTAMA -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Menu Utama</span>
                
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span>Dashboard Saya</span>
                </a>

                @if($activeInvitation)
                    <a href="{{ route('invitation.show', $activeInvitation->slug) }}" target="_blank" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition group">
                        <div class="flex items-center gap-3">
                            <i data-lucide="eye" class="w-4 h-4 text-amber-400 group-hover:scale-110 transition"></i>
                            <span>Lihat Undangan Digital</span>
                        </div>
                        <i data-lucide="external-link" class="w-3 h-3 text-sand-500"></i>
                    </a>
                @else
                    <a href="{{ route('demo.index') }}" target="_blank" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition group">
                        <div class="flex items-center gap-3">
                            <i data-lucide="play-circle" class="w-4 h-4 text-amber-400 group-hover:scale-110 transition"></i>
                            <span>Lihat Contoh Undangan</span>
                        </div>
                        <i data-lucide="external-link" class="w-3 h-3 text-sand-500"></i>
                    </a>
                @endif
            </div>

            <!-- SECTION 2: KELOLA PERNIKAHAN -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Undangan & Tamu</span>

                <a href="{{ route('member.invitations.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('member.invitations.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="heart-handshake" class="w-4 h-4 {{ request()->routeIs('member.invitations.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Data Undangan Saya</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full {{ request()->routeIs('member.invitations.*') ? 'bg-white/20 text-white' : 'bg-charcoal-800 text-amber-300' }} text-[10px] font-bold">{{ $memberInvitationsCount }}</span>
                </a>

                <a href="{{ route('member.themes.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('member.themes.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="palette" class="w-4 h-4 {{ request()->routeIs('member.themes.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Template Saya</span>
                    </div>
                    @php
                        $sidebarThemesCount = Auth::user()->isSuperAdmin() ? \App\Models\Theme::where('is_active', true)->count() : Auth::user()->themes()->count();
                    @endphp
                    @if($sidebarThemesCount > 0)
                        <span class="px-2 py-0.5 rounded-full {{ request()->routeIs('member.themes.*') ? 'bg-white/20 text-white' : 'bg-amber-500/20 text-amber-300' }} text-[10px] font-bold">{{ $sidebarThemesCount }}</span>
                    @endif
                </a>
                <a href="{{ route('member.guests.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('member.guests.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="users" class="w-4 h-4 {{ request()->routeIs('member.guests.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Daftar Tamu & Kirim WA</span>
                    </div>
                </a>

                <a href="{{ route('member.wishes.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('member.wishes.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="message-square-heart" class="w-4 h-4 {{ request()->routeIs('member.wishes.*') ? 'text-white' : 'text-sand-400' }}"></i>
                        <span>Buku Tamu & Ucapan</span>
                    </div>
                </a>
            </div>

            <!-- SECTION 3: KELENGKAPAN ACARA -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Kebutuhan Acara</span>

                <a href="{{ route('member.invitations.index') }}#amplop-digital" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition">
                    <i data-lucide="wallet" class="w-4 h-4 text-sand-400"></i>
                    <span>Amplop Digital & QRIS</span>
                </a>

                <a href="{{ route('member.invitations.index') }}#galeri-cerita" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-sand-300 hover:bg-charcoal-900 hover:text-white transition">
                    <i data-lucide="image" class="w-4 h-4 text-sand-400"></i>
                    <span>Galeri Foto & Musik</span>
                </a>
            </div>

            <!-- SECTION 4: AKUN & BANTUAN -->
            <div class="space-y-1.5">
                <span class="px-3 text-[10px] font-bold uppercase tracking-widest text-sand-500">Akun & Layanan</span>

                <a href="{{ route('member.orders.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('member.orders.*') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <i data-lucide="receipt" class="w-4 h-4 {{ request()->routeIs('member.orders.*') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span>Riwayat Transaksi</span>
                </a>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition {{ request()->routeIs('profile.edit') ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white shadow-md' : 'text-sand-300 hover:bg-charcoal-900 hover:text-white' }}">
                    <i data-lucide="settings" class="w-4 h-4 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-sand-400' }}"></i>
                    <span>Pengaturan Akun</span>
                </a>

                <a href="https://wa.me/?text=Halo%20Admin%20KlikMomen,%20saya%20butuh%20bantuan%20undangan%20pernikahan%20saya" target="_blank" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-semibold text-emerald-400 hover:bg-emerald-950/30 transition">
                    <div class="flex items-center gap-3">
                        <i data-lucide="help-circle" class="w-4 h-4 text-emerald-400"></i>
                        <span>Bantuan & CS WhatsApp</span>
                    </div>
                    <i data-lucide="arrow-up-right" class="w-3 h-3"></i>
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
