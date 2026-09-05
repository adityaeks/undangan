<!-- MEMBER TOP NAVBAR -->
<header class="h-14 sm:h-16 bg-white/80 backdrop-blur-md border-b border-sand-200 sticky top-0 z-30 flex items-center justify-between px-4 sm:px-6 transition-all">
    
    <!-- LEFT: TOGGLE & WEDDING STATUS -->
    <div class="flex items-center gap-4 flex-1 max-w-xl">
        <button @click="sidebarOpen = true" class="lg:hidden p-2.5 rounded-2xl bg-sand-100 text-charcoal-900 hover:bg-sand-200 transition" aria-label="Buka Menu">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>

        @php
            $activeInvitation = Auth::user()->invitations()->latest()->first();
        @endphp

        <!-- CURRENT INVITATION STATUS BADGE -->
        @if($activeInvitation)
            <div class="hidden sm:flex items-center gap-2.5 px-3.5 py-1.5 rounded-2xl bg-amber-50 border border-amber-200/80 text-xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="font-bold text-charcoal-950 font-serif truncate max-w-xs">{{ $activeInvitation->title }}</span>
                <span class="text-[10px] uppercase font-extrabold px-2 py-0.5 rounded-full {{ $activeInvitation->is_published ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }} tracking-wider">{{ $activeInvitation->is_published ? 'Online' : 'Draft' }}</span>
            </div>
        @else
            <div class="hidden sm:flex items-center gap-2.5 px-3.5 py-1.5 rounded-2xl bg-sand-100 border border-sand-200 text-xs text-sand-600">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                <span class="font-medium">Belum Ada Undangan Aktif</span>
                <a href="{{ route('member.invitations.create') }}" class="text-[10px] font-bold text-amber-700 hover:underline">+ Buat Sekarang</a>
            </div>
        @endif
    </div>

    <!-- RIGHT: ACTIONS & USER PROFILE -->
    <div class="flex items-center gap-3">
        
        <!-- QUICK ACTION BUTTON -->
        @if($activeInvitation)
            <a href="{{ route('invitation.show', $activeInvitation->slug) }}" target="_blank" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white text-xs font-bold shadow-sm hover:shadow transition">
                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                <span>Buka Undangan</span>
            </a>
        @else
            <a href="{{ route('member.invitations.create') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white text-xs font-bold shadow-sm hover:shadow transition">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                <span>Buat Undangan</span>
            </a>
        @endif

        <!-- NOTIFICATION BUTTON -->
        <div class="relative" x-data="{ notifyOpen: false }">
            <button @click="notifyOpen = !notifyOpen" class="relative p-2.5 rounded-2xl bg-sand-100 hover:bg-sand-200 text-charcoal-800 transition" title="Notifikasi Kehadiran & Ucapan">
                <i data-lucide="bell" class="w-4 h-4"></i>
                <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-amber-500 ring-2 ring-white"></span>
            </button>

            <!-- NOTIFICATION DROPDOWN -->
            <div 
                x-show="notifyOpen" 
                @click.away="notifyOpen = false" 
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 mt-2 w-80 rounded-2xl bg-white shadow-2xl border border-sand-200 py-3 z-50 divide-y divide-sand-100"
                style="display: none;"
            >
                <div class="px-4 pb-2 flex items-center justify-between">
                    <span class="text-xs font-bold text-charcoal-950">Notifikasi Terbaru</span>
                    <span class="text-[10px] font-bold text-amber-600">3 Baru</span>
                </div>
                <div class="py-2 px-3 space-y-2 max-h-60 overflow-y-auto">
                    <div class="p-2.5 rounded-xl bg-sand-50 hover:bg-amber-50/50 transition flex items-start gap-2.5 text-xs">
                        <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="check" class="w-3.5 h-3.5"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-charcoal-950 truncate">Dimas Anggara</p>
                            <p class="text-[11px] text-sand-600">Konfirmasi hadir (2 tamu)</p>
                            <span class="text-[9px] text-sand-400">5 menit yang lalu</span>
                        </div>
                    </div>
                    <div class="p-2.5 rounded-xl bg-sand-50 hover:bg-amber-50/50 transition flex items-start gap-2.5 text-xs">
                        <div class="w-7 h-7 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="message-square" class="w-3.5 h-3.5"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-charcoal-950 truncate">Siti Nurhaliza</p>
                            <p class="text-[11px] text-sand-600">Mengirim ucapan selamat</p>
                            <span class="text-[9px] text-sand-400">1 jam yang lalu</span>
                        </div>
                    </div>
                </div>
                <div class="pt-2 px-4 text-center">
                    <a href="{{ route('member.wishes.index') }}" class="text-[11px] font-bold text-amber-700 hover:underline">Lihat Semua Ucapan & Tamu</a>
                </div>
            </div>
        </div>

        <div class="h-6 w-px bg-sand-200 hidden sm:block"></div>

        <!-- USER PROFILE DROPDOWN -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-3 p-1.5 sm:px-3 sm:py-1.5 rounded-2xl hover:bg-sand-100 transition text-left">
                <div class="w-9 h-9 rounded-xl bg-charcoal-950 text-amber-300 font-bold text-xs flex items-center justify-center border border-amber-400/30">
                    {{ strtoupper(substr(Auth::user()->name ?? 'M', 0, 1)) }}
                </div>
                <div class="hidden md:block">
                    <span class="text-xs font-bold text-charcoal-950 block leading-tight">{{ Auth::user()->name }}</span>
                    <span class="text-[10px] text-amber-600 font-semibold">Member Aktif</span>
                </div>
                <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-sand-500 hidden sm:block"></i>
            </button>

            <!-- DROPDOWN MENU -->
            <div 
                x-show="open" 
                @click.away="open = false" 
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 mt-2 w-56 rounded-2xl bg-white shadow-2xl border border-sand-200 py-2 z-50 divide-y divide-sand-100"
                style="display: none;"
            >
                <div class="px-4 py-2.5">
                    <p class="text-xs font-bold text-charcoal-950">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-sand-500 truncate">{{ Auth::user()->email }}</p>
                </div>

                <div class="py-1">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs text-charcoal-800 hover:bg-sand-100 transition">
                        <i data-lucide="user" class="w-3.5 h-3.5 text-sand-500"></i>
                        <span>Pengaturan Akun</span>
                    </a>
                    <a href="{{ route('demo.index') }}" target="_blank" class="flex items-center gap-2.5 px-4 py-2 text-xs text-charcoal-800 hover:bg-sand-100 transition">
                        <i data-lucide="eye" class="w-3.5 h-3.5 text-sand-500"></i>
                        <span>Preview Undangan</span>
                    </a>
                </div>

                <div class="py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-xs text-rose-600 hover:bg-rose-50 transition">
                            <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                            <span>Keluar dari Akun</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</header>
