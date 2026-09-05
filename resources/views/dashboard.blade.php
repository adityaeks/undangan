<x-app-layout>
    <div class="space-y-3.5 sm:space-y-4">
        
        <!-- ============================================== -->
        <!-- 1. HERO GREETING BANNER -->
        <!-- ============================================== -->
        <div class="relative rounded-2xl overflow-hidden bg-gradient-to-r from-charcoal-950 via-charcoal-900 to-brand-950 p-4 sm:p-5 text-white shadow-lg border border-charcoal-800">
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="space-y-1 max-w-xl">
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-[10px] font-bold text-amber-200 uppercase tracking-wider">
                        <i data-lucide="shield-check" class="w-3 h-3"></i>
                        <span>Super Admin Dashboard & Workspace</span>
                    </div>
                    <h1 class="font-serif text-xl sm:text-2xl font-bold tracking-tight">
                        Selamat Datang, {{ Auth::user()->name }}! 👋
                    </h1>
                    <p class="text-xs text-sand-300 leading-relaxed">
                        Pusat kendali KlikMomen: pantau arus transaksi, moderasi undangan seluruh pengguna, kelola akun dan kupon promo.
                    </p>
                </div>

                <!-- ACTIONS -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('admin.users.index') }}" class="px-3.5 py-2 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs backdrop-blur-md transition flex items-center gap-1.5">
                        <i data-lucide="users" class="w-3.5 h-3.5"></i>
                        <span>Kelola Pengguna</span>
                    </a>
                    <a href="{{ route('admin.coupons.index') }}" class="px-3.5 py-2 rounded-xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs shadow-md hover:shadow-brand-500/30 transition flex items-center gap-1.5">
                        <i data-lucide="ticket" class="w-3.5 h-3.5"></i>
                        <span>Kupon & Diskon Promo</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- ============================================== -->
        <!-- 2. STATS & PLATFORM METRICS -->
        <!-- ============================================== -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-3">
            
            <!-- CARD 1: REVENUE -->
            <div class="p-3.5 sm:p-4 rounded-2xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Total Pendapatan</span>
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                        <i data-lucide="badge-dollar-sign" class="w-4 h-4"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </div>
                    <p class="text-[10px] text-emerald-600 font-semibold flex items-center gap-1 mt-0.5">
                        <i data-lucide="check-circle" class="w-3 h-3"></i>
                        <span>{{ $totalPaidOrders }} Order Lunas</span>
                    </p>
                </div>
            </div>

            <!-- CARD 2: PENGGUNA TERDAFTAR -->
            <div class="p-3.5 sm:p-4 rounded-2xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Pengguna</span>
                    <div class="w-8 h-8 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">
                        {{ $totalUsers }} <span class="text-xs font-sans text-sand-500 font-normal">Akun</span>
                    </div>
                    <p class="text-[10px] text-sand-600 font-medium mt-0.5">
                        {{ $totalMembers }} Member • {{ $totalPartners }} WO
                    </p>
                </div>
            </div>

            <!-- CARD 3: TOTAL UNDANGAN DI PLATFORM -->
            <div class="p-3.5 sm:p-4 rounded-2xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Undangan</span>
                    <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center">
                        <i data-lucide="mail-check" class="w-4 h-4"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">
                        {{ $totalInvitations }} <span class="text-xs font-sans text-sand-500 font-normal">Website</span>
                    </div>
                    <p class="text-[10px] text-indigo-600 font-semibold flex items-center gap-1 mt-0.5">
                        <i data-lucide="globe" class="w-3 h-3"></i>
                        <span>{{ $totalActiveInvitations }} Aktif Online</span>
                    </p>
                </div>
            </div>

            <!-- CARD 4: TRANSAKSI & KUPO -->
            <div class="p-3.5 sm:p-4 rounded-2xl glass-panel border border-sand-200/80 shadow-sm hover:shadow-md transition-all space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Katalog &amp; Diskon</span>
                    <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                        <i data-lucide="ticket" class="w-4 h-4"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">
                        {{ $totalThemes }} <span class="text-xs font-sans text-sand-500 font-normal">Tema</span>
                    </div>
                    <p class="text-[10px] text-amber-700 font-semibold flex items-center gap-1 mt-0.5">
                        <i data-lucide="tag" class="w-3 h-3"></i>
                        <span>{{ $totalCoupons }} Kupon Promo</span>
                    </p>
                </div>
            </div>

        </div>

        <!-- ============================================== -->
        <!-- 3. PLATFORM MANAGEMENT SPLIT -->
        <!-- ============================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-5">
            
            <!-- LEFT (COL-8): RECENT ORDERS & INVITATIONS -->
            <div class="lg:col-span-8 space-y-4 sm:space-y-5">
                
                <!-- TRANSAKSI TERAKHIR -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="font-serif text-xl font-bold text-charcoal-950">Transaksi Billing Terkini</h2>
                            <p class="text-xs text-sand-600">Monitoring pembayaran lisensi tema dan paket kemitraan.</p>
                        </div>
                        <a href="{{ route('orders.index') }}" class="text-xs text-brand-600 hover:text-brand-800 font-bold flex items-center gap-1">
                            <span>Lihat Semua</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>

                    <div class="rounded-3xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-sand-50/80 border-b border-sand-200/80 text-sand-600 font-bold uppercase tracking-wider">
                                <tr>
                                    <th class="p-4 pl-6">Kode Order</th>
                                    <th class="p-4">Pengguna</th>
                                    <th class="p-4">Tagihan</th>
                                    <th class="p-4 text-center">Status</th>
                                    <th class="p-4 pr-6 text-right">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-sand-200/60">
                                @forelse($recentOrders as $order)
                                    <tr class="hover:bg-sand-50/50 transition">
                                        <td class="p-4 pl-6">
                                            <a href="{{ route('orders.show', $order) }}" class="font-mono font-bold text-brand-700 hover:underline">
                                                {{ $order->order_code }}
                                            </a>
                                            @if($order->coupon)
                                                <span class="block text-[10px] text-emerald-600 font-semibold">Kupon: {{ $order->coupon->code }}</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            <span class="font-semibold text-charcoal-950 block">{{ $order->user?->name ?? 'User #'.$order->user_id }}</span>
                                            <span class="text-sand-500 text-[11px]">{{ $order->user?->email }}</span>
                                        </td>
                                        <td class="p-4 font-bold text-charcoal-950">
                                            Rp {{ number_format($order->total_amount ?: $order->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="p-4 text-center">
                                            @if($order->isPaid())
                                                <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase tracking-wider">Lunas</span>
                                            @else
                                                <span class="px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider">Pending</span>
                                            @endif
                                        </td>
                                        <td class="p-4 pr-6 text-right text-sand-500">
                                            {{ $order->created_at ? $order->created_at->isoFormat('D MMM Y, HH:mm') : '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-6 text-center text-sand-500">Belum ada transaksi di platform.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- MONITORING UNDANGAN TERBARU -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="font-serif text-xl font-bold text-charcoal-950">Monitoring Undangan Terkini</h2>
                            <p class="text-xs text-sand-600">Undangan pernikahan yang baru saja dibuat atau diperbarui di platform.</p>
                        </div>
                        <a href="{{ route('invitations.index') }}" class="text-xs text-brand-600 hover:text-brand-800 font-bold flex items-center gap-1">
                            <span>Lihat Semua</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentInvitations as $invitation)
                            <div class="p-5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-serif text-base font-bold text-charcoal-950">{{ $invitation->title }}</h3>
                                        @if($invitation->is_published)
                                            <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">Online</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full bg-sand-200 text-sand-700 text-[10px] font-bold">Draft</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-sand-600">
                                        Pemilik: <strong class="text-charcoal-900">{{ $invitation->owner?->name ?? 'User' }}</strong> • 
                                        Tema: <strong class="text-charcoal-900">{{ $invitation->theme?->name ?? '-' }}</strong>
                                    </p>
                                    <p class="text-[11px] font-mono text-sand-500">
                                        Tautan: /u/{{ $invitation->slug }}
                                    </p>
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-charcoal-900 hover:bg-charcoal-800 text-white font-bold text-xs transition flex items-center gap-1.5">
                                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                        <span>Buka</span>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 rounded-2xl glass-panel text-center text-sand-500 text-xs">
                                Belum ada undangan terdaftar di platform.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- RIGHT (COL-4): USERS & QUICK ACTIONS -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- PENGGUNA BARU BERGABUNG -->
                <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="font-serif text-base font-bold text-charcoal-950">Pengguna Baru</h3>
                        <a href="{{ route('admin.users.index') }}" class="text-[11px] font-bold text-brand-600 hover:underline">Semua</a>
                    </div>

                    <div class="divide-y divide-sand-200/60">
                        @forelse($recentUsers as $newUser)
                            <div class="py-3 flex items-center justify-between first:pt-0 last:pb-0">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-charcoal-900 text-brand-300 flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($newUser->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-charcoal-950">{{ $newUser->name }}</h4>
                                        <span class="text-[11px] text-sand-500">{{ $newUser->email }}</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider {{ $newUser->isPartner() ? 'bg-brand-100 text-brand-800' : ($newUser->isSuperAdmin() ? 'bg-indigo-100 text-indigo-800' : 'bg-amber-100 text-amber-800') }}">
                                        {{ $newUser->role }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-sand-500 py-4 text-center">Belum ada pengguna terdaftar.</p>
                        @endforelse
                    </div>
                </div>

                <!-- AKSI KELOLA CEPAT -->
                <div class="p-6 rounded-3xl bg-gradient-to-br from-charcoal-950 to-charcoal-900 text-white border border-charcoal-800 shadow-lg space-y-4">
                    <h3 class="font-serif text-base font-bold text-amber-200">Aksi Cepat Super Admin</h3>
                    <div class="space-y-2.5 text-xs">
                        <a href="{{ route('admin.coupons.index') }}" class="w-full flex items-center justify-between p-3 rounded-2xl bg-white/10 hover:bg-white/15 transition">
                            <span class="flex items-center gap-2">
                                <i data-lucide="plus-circle" class="w-4 h-4 text-amber-300"></i>
                                Buat Kupon Promo Diskon
                            </span>
                            <i data-lucide="chevron-right" class="w-4 h-4 text-sand-400"></i>
                        </a>

                        <a href="{{ route('themes.index') }}" class="w-full flex items-center justify-between p-3 rounded-2xl bg-white/10 hover:bg-white/15 transition">
                            <span class="flex items-center gap-2">
                                <i data-lucide="palette" class="w-4 h-4 text-brand-300"></i>
                                Kelola Katalog & Harga Tema
                            </span>
                            <i data-lucide="chevron-right" class="w-4 h-4 text-sand-400"></i>
                        </a>

                        <a href="{{ route('partners.index') }}" class="w-full flex items-center justify-between p-3 rounded-2xl bg-white/10 hover:bg-white/15 transition">
                            <span class="flex items-center gap-2">
                                <i data-lucide="handshake" class="w-4 h-4 text-emerald-300"></i>
                                Kemitraan Reseller & WO
                            </span>
                            <i data-lucide="chevron-right" class="w-4 h-4 text-sand-400"></i>
                        </a>

                        <a href="{{ route('wishes.index') }}" class="w-full flex items-center justify-between p-3 rounded-2xl bg-white/10 hover:bg-white/15 transition">
                            <span class="flex items-center gap-2">
                                <i data-lucide="message-square-heart" class="w-4 h-4 text-rose-300"></i>
                                Moderasi Ucapan Doa Tamu
                            </span>
                            <i data-lucide="chevron-right" class="w-4 h-4 text-sand-400"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</x-app-layout>
