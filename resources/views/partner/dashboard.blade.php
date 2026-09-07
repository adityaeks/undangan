<x-partner-layout>
    <div class="space-y-8">
        <!-- Partner Hero Banner -->
        <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-charcoal-950 via-charcoal-900 to-amber-950 p-6 sm:p-10 text-white shadow-xl border border-charcoal-800">
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-amber-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2 max-w-xl">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-[11px] font-bold text-amber-200 uppercase tracking-wider">
                        <i data-lucide="briefcase" class="w-3.5 h-3.5 text-amber-300"></i>
                        <span>Partner & Wedding Organizer Portal</span>
                    </div>
                    <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight">
                        Dashboard Partner, {{ Auth::user()->name }}! 💼
                    </h1>
                    <p class="text-xs sm:text-sm text-sand-300 leading-relaxed">
                        Kelola katalog undangan klien Anda, input data klien pengantin, dan kelola template secara profesional dengan mudah.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('partner.clients.index') }}" class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs backdrop-blur-md transition flex items-center gap-2">
                        <i data-lucide="users" class="w-3.5 h-3.5"></i>
                        <span>Kelola Klien</span>
                    </a>
                    <a href="{{ route('partner.invitations.create') }}" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 text-white font-bold text-xs shadow-lg hover:shadow-amber-500/30 hover:scale-105 transition flex items-center gap-2">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>Buat Undangan Klien</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Metrics Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <!-- Card 1: Total Klien -->
            <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Total Klien</span>
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">{{ $totalClients }} <span class="text-xs font-sans text-sand-500">Klien</span></div>
                    <p class="text-[11px] text-amber-600 font-semibold flex items-center gap-1 mt-1">
                        <i data-lucide="user-check" class="w-3.5 h-3.5"></i>
                        <span>Klien Pengantin Terdaftar</span>
                    </p>
                </div>
            </div>

            <!-- Card 2: Undangan Dikelola -->
            <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Undangan Dikelola</span>
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                    </div>
                </div>
                <div>
                    <div class="font-serif text-3xl font-bold text-charcoal-950">{{ $totalInvitations }} <span class="text-xs font-sans text-sand-500">Undangan</span></div>
                    <p class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1 mt-1">
                        <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                        <span>Aktif & Terintegrasi</span>
                    </p>
                </div>
            </div>

            <!-- Card 3: Status Paket & Kuota -->
            <div class="p-6 rounded-3xl glass-panel border border-sand-200/80 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sand-500">Paket & Kuota Aktif</span>
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center">
                        <i data-lucide="award" class="w-5 h-5"></i>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="font-serif text-xl sm:text-2xl font-bold text-charcoal-950">
                            {{ $activePackage->name ?? 'Starter Partner' }}
                        </div>
                        <a href="{{ route('partner.packages.index') }}" class="text-[11px] font-bold text-amber-700 hover:text-amber-800 hover:underline">
                            Upgrade Paket
                        </a>
                    </div>

                    @php
                        $quota = $invitationQuota;
                        $used = $totalInvitations;
                        $pct = $quota > 0 ? min(100, round(($used / $quota) * 100)) : 0;
                    @endphp

                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between text-[11px] font-medium text-sand-600">
                            <span>Terpakai: <strong class="text-charcoal-950">{{ $used }}</strong> / {{ $quota > 0 ? $quota : '∞' }} Undangan</span>
                            <span class="font-bold {{ $pct >= 90 ? 'text-rose-600' : ($pct >= 70 ? 'text-amber-600' : 'text-emerald-600') }}">{{ $quota > 0 ? $pct . '%' : 'Unlimited' }}</span>
                        </div>
                        @if($quota > 0)
                            <div class="w-full bg-sand-200/80 rounded-full h-2 overflow-hidden">
                                <div class="h-2 rounded-full transition-all duration-500 {{ $pct >= 90 ? 'bg-rose-500' : ($pct >= 70 ? 'bg-amber-500' : 'bg-emerald-500') }}" style="width: {{ $pct }}%"></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Clients & Invitations -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left: Recent Clients -->
            <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 space-y-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="font-serif text-lg font-bold text-charcoal-950">Klien Terbaru</h2>
                    <a href="{{ route('partner.clients.index') }}" class="text-xs font-bold text-amber-700 hover:underline">Lihat Semua</a>
                </div>

                <div class="divide-y divide-sand-200/60">
                    @forelse($recentClients as $client)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-bold text-charcoal-950">{{ $client->name }}</h3>
                                <p class="text-xs text-sand-500">{{ $client->phone ?? 'No Phone' }} • {{ $client->email ?? 'No Email' }}</p>
                            </div>
                            <span class="text-xs text-sand-500">{{ $client->created_at ? $client->created_at->diffForHumans() : '' }}</span>
                        </div>
                    @empty
                        <div class="py-8 text-center text-xs text-sand-500">
                            Belum ada klien yang didaftarkan.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right: Recent Invitations -->
            <div class="rounded-3xl glass-panel border border-sand-200/80 p-6 space-y-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="font-serif text-lg font-bold text-charcoal-950">Undangan Klien Terbaru</h2>
                    <a href="{{ route('partner.invitations.index') }}" class="text-xs font-bold text-amber-700 hover:underline">Lihat Semua</a>
                </div>

                <div class="divide-y divide-sand-200/60">
                    @forelse($recentInvitations as $inv)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-bold text-charcoal-950">{{ $inv->title }}</h3>
                                <p class="text-xs text-sand-500">Klien: {{ $inv->client->name ?? 'Direct' }} • Tema: {{ $inv->theme->name ?? 'Custom' }}</p>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full {{ $inv->is_published ? 'bg-emerald-100 text-emerald-800' : 'bg-sand-200 text-sand-700' }} text-[10px] font-bold">
                                {{ $inv->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                    @empty
                        <div class="py-8 text-center text-xs text-sand-500">
                            Belum ada undangan yang dibuat untuk klien.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-partner-layout>
