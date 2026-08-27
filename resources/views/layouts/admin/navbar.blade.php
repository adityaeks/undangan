<!-- ADMIN TOP NAVBAR -->
<header class="h-20 bg-white/80 backdrop-blur-md border-b border-sand-200 sticky top-0 z-30 flex items-center justify-between px-4 sm:px-8">
    
    <!-- LEFT: TOGGLE & SEARCH -->
    <div class="flex items-center gap-4 flex-1 max-w-xl">
        <button @click="sidebarOpen = true" class="lg:hidden p-2.5 rounded-2xl bg-sand-100 text-charcoal-900 hover:bg-sand-200 transition">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>

        <!-- SEARCH BAR -->
        <div class="relative w-full hidden sm:block">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </div>
            <input 
                type="text" 
                placeholder="Cari data undangan, tamu, atau transaksi..." 
                class="w-full pl-10 pr-4 py-2.5 rounded-2xl border border-sand-200 bg-sand-50/70 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
            >
        </div>
    </div>

    <!-- RIGHT: ACTIONS & USER PROFILE -->
    <div class="flex items-center gap-3">
        
        <!-- QUICK HOME LINK -->
        <a href="{{ url('/') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 text-xs font-semibold transition">
            <i data-lucide="globe" class="w-3.5 h-3.5 text-brand-600"></i>
            <span>Lihat Website</span>
        </a>

        <!-- NOTIFICATION BUTTON -->
        <button class="relative p-2.5 rounded-2xl bg-sand-100 hover:bg-sand-200 text-charcoal-800 transition" title="Notifikasi">
            <i data-lucide="bell" class="w-4 h-4"></i>
            <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
        </button>

        <div class="h-6 w-px bg-sand-200 hidden sm:block"></div>

        <!-- USER PROFILE DROPDOWN -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-3 p-1.5 sm:px-3 sm:py-1.5 rounded-2xl hover:bg-sand-100 transition text-left">
                <div class="w-9 h-9 rounded-xl bg-charcoal-950 text-brand-300 font-bold text-xs flex items-center justify-center border border-brand-400/30">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="hidden md:block">
                    <span class="text-xs font-bold text-charcoal-950 block leading-tight">{{ Auth::user()->name }}</span>
                    <span class="text-[10px] text-sand-500">{{ Auth::user()->role === 'super_admin' ? 'Super Admin' : (Auth::user()->role === 'partner' ? 'Partner WO' : 'Member') }}</span>
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
                        <span>Profil Saya</span>
                    </a>
                    <a href="{{ route('demo.index') }}" target="_blank" class="flex items-center gap-2.5 px-4 py-2 text-xs text-charcoal-800 hover:bg-sand-100 transition">
                        <i data-lucide="eye" class="w-3.5 h-3.5 text-sand-500"></i>
                        <span>Demo Undangan</span>
                    </a>
                </div>

                <div class="py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-xs text-rose-600 hover:bg-rose-50 transition">
                            <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</header>
