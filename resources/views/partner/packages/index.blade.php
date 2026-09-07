<x-partner-layout>
    <div class="space-y-8">
        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">Paket Kemitraan & Kuota Undangan</h1>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider">
                        WO / Reseller
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-sand-600 mt-1">
                    Pilih paket kemitraan yang sesuai dengan kebutuhan operasional bisnis Wedding Organizer Anda.
                </p>
            </div>

            <a href="{{ route('partner.invitations.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-sand-200 hover:bg-sand-300 text-charcoal-900 font-bold text-xs transition">
                <i data-lucide="mail" class="w-4 h-4"></i>
                <span>Kelola Undangan</span>
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 shrink-0"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- CURRENT ACTIVE PACKAGE BANNER -->
        @php
            $currentSlug = $activePackage?->slug ?? 'partner-starter';
            $quota = $invitationQuota;
            $used = $invitationCount;
            $pct = $quota > 0 ? min(100, round(($used / $quota) * 100)) : 0;
        @endphp

        <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-charcoal-950 via-charcoal-900 to-amber-950 text-white shadow-xl border border-charcoal-800 relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-3 max-w-xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 text-xs font-bold uppercase tracking-wider">
                        <i data-lucide="award" class="w-3.5 h-3.5"></i>
                        <span>Paket Aktif Anda</span>
                    </div>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold">
                        {{ $activePackage->name ?? 'Starter Partner' }}
                    </h2>
                    <p class="text-xs sm:text-sm text-sand-300 leading-relaxed">
                        Anda telah menggunakan <strong class="text-white">{{ $used }}</strong> dari <strong class="text-white">{{ $quota > 0 ? $quota : 'Unlimited' }}</strong> kuota undangan digital untuk klien Anda.
                    </p>
                </div>

                <div class="min-w-[260px] p-5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 space-y-3">
                    <div class="flex items-center justify-between text-xs font-semibold">
                        <span class="text-sand-300">Penggunaan Kuota</span>
                        <span class="{{ $pct >= 90 ? 'text-rose-400 font-bold' : ($pct >= 70 ? 'text-amber-300 font-bold' : 'text-emerald-400 font-bold') }}">
                            {{ $used }} / {{ $quota > 0 ? $quota : '∞' }}
                        </span>
                    </div>
                    @if($quota > 0)
                        <div class="w-full bg-white/20 rounded-full h-2.5 overflow-hidden">
                            <div class="h-2.5 rounded-full transition-all duration-500 {{ $pct >= 90 ? 'bg-rose-400' : ($pct >= 70 ? 'bg-amber-400' : 'bg-emerald-400') }}" style="width: {{ $pct }}%"></div>
                        </div>
                    @endif
                    <div class="text-[11px] text-sand-400 flex items-center justify-between">
                        <span>Sisa Kuota:</span>
                        <strong class="text-white">{{ $quota > 0 ? max(0, $quota - $used) . ' Undangan' : 'Tidak Terbatas' }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3 PACKAGES GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($packages as $pkg)
                @php
                    $isCurrent = ($activePackage && $activePackage->id === $pkg->id) || (! $activePackage && $pkg->slug === 'partner-starter');
                    $isPro = $pkg->slug === 'partner-pro';
                @endphp

                <div class="p-8 rounded-3xl {{ $isPro ? 'bg-charcoal-950 text-white shadow-2xl relative ring-2 ring-amber-500' : 'glass-panel border border-sand-200 text-charcoal-950' }} flex flex-col justify-between space-y-6">
                    
                    <div>
                        @if($isPro)
                            <div class="inline-block px-3 py-0.5 rounded-full bg-gradient-to-r from-amber-500 to-amber-600 text-white text-[10px] font-bold uppercase tracking-wider shadow mb-3">
                                🌟 Paling Populer (Best for WO)
                            </div>
                        @elseif($isCurrent)
                            <div class="inline-block px-3 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase tracking-wider mb-3">
                                ✓ Sedang Digunakan
                            </div>
                        @endif

                        <div class="space-y-3">
                            <h3 class="font-serif text-2xl font-bold {{ $isPro ? 'text-white' : 'text-charcoal-950' }}">
                                {{ $pkg->name }}
                            </h3>

                            <div class="font-serif text-3xl font-bold {{ $isPro ? 'text-white' : 'text-charcoal-950' }}">
                                Rp {{ number_format($pkg->price, 0, ',', '.') }}
                                <span class="text-xs font-sans {{ $isPro ? 'text-sand-400' : 'text-sand-500' }}">
                                    / {{ $pkg->quota_invitations > 0 ? $pkg->quota_invitations . ' Undangan' : 'Unlimited' }}
                                </span>
                            </div>

                            <p class="text-xs {{ $isPro ? 'text-sand-300' : 'text-sand-600' }}">
                                Kuota pembuatan: <strong class="{{ $isPro ? 'text-amber-300' : 'text-charcoal-950' }}">{{ $pkg->quota_invitations > 0 ? $pkg->quota_invitations . ' Undangan' : 'Unlimited' }}</strong>
                            </p>

                            <!-- Features list -->
                            <ul class="space-y-2.5 pt-4 border-t {{ $isPro ? 'border-charcoal-800 text-sand-300' : 'border-sand-200 text-sand-700' }} text-xs">
                                @if(!empty($pkg->features) && is_array($pkg->features))
                                    @foreach($pkg->features as $feature)
                                        <li class="flex items-start gap-2">
                                            <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div>
                        @if($isCurrent)
                            <button type="button" disabled class="w-full py-3 rounded-2xl bg-emerald-600 text-white font-bold text-xs cursor-default flex items-center justify-center gap-2 shadow">
                                <i data-lucide="check-circle" class="w-4 h-4"></i>
                                <span>Paket Aktif Saat Ini</span>
                            </button>
                        @else
                            <a href="{{ route('checkout.package', $pkg) }}" class="w-full py-3.5 rounded-2xl {{ $isPro ? 'bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white shadow-lg' : 'bg-charcoal-950 hover:bg-amber-700 text-white' }} font-bold text-xs transition flex items-center justify-center gap-2">
                                <span>Pilih & Upgrade Paket</span>
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</x-partner-layout>
