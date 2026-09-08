<x-app-layout>
    <div class="space-y-6 sm:space-y-8" x-data="{ activeTab: 'packages' }">
        
        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-serif text-xl sm:text-2xl font-bold text-charcoal-950">Pengaturan Paket Partner &amp; Kemitraan Wedding Organizer (WO)</h1>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider">
                        Kemitraan
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-sand-600 mt-0.5">
                    Kelola nama, harga, kuota undangan, dan rincian fitur untuk ketiga paket kemitraan (Starter, Pro WO, dan Enterprise).
                </p>
            </div>

            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('partner.packages.index') }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-white border border-sand-300 text-charcoal-900 font-bold text-xs hover:bg-sand-50 transition flex items-center gap-1.5 shadow-sm">
                    <i data-lucide="eye" class="w-3.5 h-3.5 text-amber-600"></i>
                    <span>Lihat Tampilan Partner</span>
                </a>
                <a href="{{ url('/#partner') }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-charcoal-950 hover:bg-amber-700 text-white font-bold text-xs transition flex items-center gap-1.5 shadow">
                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                    <span>Landing Page WO</span>
                </a>
            </div>
        </div>

        <!-- STATS ROW -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="p-4 sm:p-5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-sand-500">Total Paket Kemitraan</span>
                    <div class="font-serif text-2xl font-bold text-charcoal-950 mt-1">{{ $packages->count() }} Paket</div>
                    <span class="text-[10px] text-amber-700 font-medium">Starter, Pro WO, Enterprise</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                    <i data-lucide="layers" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="p-4 sm:p-5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-sand-500">Partner Terdaftar</span>
                    <div class="font-serif text-2xl font-bold text-charcoal-950 mt-1">{{ $totalPartners }} Partner</div>
                    <span class="text-[10px] text-emerald-700 font-medium">Wedding Organizer & Reseller</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="p-4 sm:p-5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-sand-500">Undangan Klien Partner</span>
                    <div class="font-serif text-2xl font-bold text-charcoal-950 mt-1">{{ $totalPartnerInvitations }} Undangan</div>
                    <span class="text-[10px] text-indigo-700 font-medium">Dikelola oleh seluruh partner</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center shrink-0">
                    <i data-lucide="mail-check" class="w-5 h-5"></i>
                </div>
            </div>
        </div>

        <!-- FLASH MESSAGES -->
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-2 shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm flex items-center gap-2 shadow-sm">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 shrink-0"></i>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm space-y-1 shadow-sm">
                <div class="font-bold flex items-center gap-1.5">
                    <i data-lucide="alert-triangle" class="w-4 h-4 text-rose-600"></i>
                    <span>Terdapat kesalahan pada isian form:</span>
                </div>
                <ul class="list-disc list-inside pl-4 text-xs">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- SECTION 1: PENGATURAN 3 PAKET PARTNER -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">Konfigurasi 3 Paket Kemitraan</h2>
                    <p class="text-xs text-sand-500">Edit nama paket, tarif, batas kuota undangan, dan daftar fitur di bawah ini.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @foreach($packages as $pkg)
                    @php
                        $isPro = $pkg->slug === 'partner-pro';
                        $featuresText = is_array($pkg->features) ? implode("\n", $pkg->features) : '';
                    @endphp

                    <div class="rounded-3xl {{ $isPro ? 'bg-charcoal-950 text-white border-2 border-amber-500 shadow-2xl relative' : 'glass-panel border border-sand-200 text-charcoal-950 shadow-sm' }} flex flex-col justify-between overflow-hidden">
                        
                        @if($isPro)
                            <div class="bg-gradient-to-r from-amber-500 to-amber-600 text-white text-[10px] font-bold uppercase tracking-widest text-center py-1">
                                🌟 Rekomendasi Utama (Best for WO)
                            </div>
                        @endif

                        <form action="{{ route('admin.partners.packages.update', $pkg) }}" method="POST" class="p-6 space-y-5 flex-1 flex flex-col justify-between">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                <!-- Package Identification -->
                                <div class="flex items-center justify-between pb-3 border-b {{ $isPro ? 'border-charcoal-800' : 'border-sand-200' }}">
                                    <span class="px-2.5 py-0.5 rounded-full {{ $isPro ? 'bg-white/10 text-amber-300' : 'bg-sand-100 text-sand-700' }} text-[10px] font-mono font-bold uppercase">
                                        {{ $pkg->slug }}
                                    </span>
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full {{ $pkg->is_active ? 'bg-emerald-400' : 'bg-sand-400' }}"></span>
                                        <span class="text-[11px] font-semibold {{ $isPro ? 'text-sand-300' : 'text-sand-600' }}">
                                            {{ $pkg->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Field: Nama Paket -->
                                <div class="space-y-1">
                                    <label for="name_{{ $pkg->id }}" class="block text-xs font-bold {{ $isPro ? 'text-sand-200' : 'text-charcoal-900' }}">
                                        Nama Paket
                                    </label>
                                    <input 
                                        type="text" 
                                        id="name_{{ $pkg->id }}" 
                                        name="name" 
                                        value="{{ old('name', $pkg->name) }}" 
                                        required 
                                        class="w-full px-3.5 py-2 rounded-xl text-xs font-bold {{ $isPro ? 'bg-charcoal-900 border-charcoal-700 text-white focus:border-amber-400 focus:ring-amber-400/20' : 'bg-white border-sand-300 text-charcoal-950 focus:border-amber-600 focus:ring-amber-500/20' }} transition"
                                    >
                                </div>

                                <!-- Field: Harga & Kuota Undangan (Grid 2 Kolom) -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div class="space-y-1">
                                        <label for="price_{{ $pkg->id }}" class="block text-xs font-bold {{ $isPro ? 'text-sand-200' : 'text-charcoal-900' }}">
                                            Harga (Rp)
                                        </label>
                                        <input 
                                            type="text" 
                                            inputmode="numeric"
                                            id="price_{{ $pkg->id }}" 
                                            name="price" 
                                            value="{{ format_rupiah(old('price', (int) $pkg->price)) }}" 
                                            oninput="maskRupiah(this)"
                                            required 
                                            class="w-full px-3.5 py-2 rounded-xl text-xs font-bold {{ $isPro ? 'bg-charcoal-900 border-charcoal-700 text-white focus:border-amber-400 focus:ring-amber-400/20' : 'bg-white border-sand-300 text-charcoal-950 focus:border-amber-600 focus:ring-amber-500/20' }} transition"
                                        >
                                    </div>

                                    <div class="space-y-1">
                                        <label for="quota_{{ $pkg->id }}" class="block text-xs font-bold {{ $isPro ? 'text-sand-200' : 'text-charcoal-900' }}">
                                            Kuota Undangan
                                        </label>
                                        <input 
                                            type="number" 
                                            id="quota_{{ $pkg->id }}" 
                                            name="quota_invitations" 
                                            value="{{ old('quota_invitations', $pkg->quota_invitations) }}" 
                                            min="0" 
                                            required 
                                            class="w-full px-3.5 py-2 rounded-xl text-xs font-bold {{ $isPro ? 'bg-charcoal-900 border-charcoal-700 text-white focus:border-amber-400 focus:ring-amber-400/20' : 'bg-white border-sand-300 text-charcoal-950 focus:border-amber-600 focus:ring-amber-500/20' }} transition"
                                        >
                                    </div>
                                </div>
                                <p class="text-[10px] {{ $isPro ? 'text-sand-400' : 'text-sand-500' }}">
                                    *Isi 0 jika kuota tidak terbatas (unlimited).
                                </p>

                                <!-- Field: Daftar Fitur (1 baris per fitur) -->
                                <div class="space-y-1">
                                    <label for="features_{{ $pkg->id }}" class="block text-xs font-bold {{ $isPro ? 'text-sand-200' : 'text-charcoal-900' }}">
                                        Daftar Fitur Paket <span class="text-[10px] font-normal {{ $isPro ? 'text-sand-400' : 'text-sand-500' }}">(1 baris per poin fitur)</span>
                                    </label>
                                    <textarea 
                                        id="features_{{ $pkg->id }}" 
                                        name="features" 
                                        rows="5" 
                                        placeholder="Contoh:&#10;10 Kuota Undangan&#10;100% White-Label&#10;Custom Domain"
                                        class="w-full px-3.5 py-2 rounded-xl text-xs leading-relaxed font-sans {{ $isPro ? 'bg-charcoal-900 border-charcoal-700 text-white focus:border-amber-400 focus:ring-amber-400/20' : 'bg-white border-sand-300 text-charcoal-950 focus:border-amber-600 focus:ring-amber-500/20' }} transition"
                                    >{{ old('features', $featuresText) }}</textarea>
                                </div>

                                <!-- Toggle Status Aktif -->
                                <div class="pt-1">
                                    <label class="inline-flex items-center gap-2 cursor-pointer">
                                        <input 
                                            type="checkbox" 
                                            name="is_active" 
                                            value="1" 
                                            {{ old('is_active', $pkg->is_active) ? 'checked' : '' }} 
                                            class="rounded border-sand-300 text-amber-600 focus:ring-amber-500"
                                        >
                                        <span class="text-xs font-medium {{ $isPro ? 'text-sand-200' : 'text-charcoal-800' }}">
                                            Aktif & Tersedia Dipilih Partner
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-4 border-t {{ $isPro ? 'border-charcoal-800' : 'border-sand-200' }}">
                                <button 
                                    type="submit" 
                                    class="w-full py-2.5 px-4 rounded-xl font-bold text-xs transition flex items-center justify-center gap-2 shadow {{ $isPro ? 'bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white' : 'bg-charcoal-950 hover:bg-amber-700 text-white' }}"
                                >
                                    <i data-lucide="save" class="w-4 h-4"></i>
                                    <span>Simpan Paket {{ $pkg->name }}</span>
                                </button>
                            </div>
                        </form>

                    </div>
                @endforeach
            </div>
        </div>

        <!-- SECTION 2: DAFTAR PARTNER & PENGATURAN KUOTA PENGGUNA -->
        <div class="space-y-4 pt-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">Daftar Partner & Monitoring Kuota</h2>
                    <p class="text-xs text-sand-500">Daftar pengguna terdaftar dengan peran Partner WO, paket aktif mereka, dan kontrol penggantian paket.</p>
                </div>
                <span class="text-xs font-semibold text-sand-500">
                    Total: {{ $totalPartners }} Partner
                </span>
            </div>

            <div class="rounded-3xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-sand-700">
                        <thead class="bg-sand-50/80 text-[10px] uppercase font-bold tracking-wider text-sand-500 border-b border-sand-200">
                            <tr>
                                <th class="py-3.5 px-5">Partner WO</th>
                                <th class="py-3.5 px-5">Paket Aktif</th>
                                <th class="py-3.5 px-5">Pemakaian Kuota Undangan</th>
                                <th class="py-3.5 px-5">Ganti Paket Kemitraan</th>
                                <th class="py-3.5 px-5 text-right">Status Akun</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sand-200/60 font-medium">
                            @forelse($partners as $partner)
                                @php
                                    $pkg = $partner->active_package;
                                    $quota = $partner->invitation_quota;
                                    $used = $partner->partner_invitations_count ?? 0;
                                    $pct = $quota > 0 ? min(100, round(($used / $quota) * 100)) : 0;
                                @endphp
                                <tr class="hover:bg-sand-50/40 transition">
                                    <!-- Partner info -->
                                    <td class="py-4 px-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-900 flex items-center justify-center font-bold text-sm shrink-0">
                                                {{ strtoupper(substr($partner->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-charcoal-950 text-xs sm:text-sm">{{ $partner->name }}</div>
                                                <div class="text-[11px] text-sand-500">{{ $partner->email }}</div>
                                                <div class="text-[10px] text-sand-400 mt-0.5">Terdaftar: {{ $partner->created_at ? $partner->created_at->isoFormat('D MMM Y') : '-' }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Paket Aktif -->
                                    <td class="py-4 px-5">
                                        @if($pkg)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold {{ $pkg->slug === 'partner-pro' ? 'bg-amber-100 text-amber-900 border border-amber-200' : ($pkg->slug === 'partner-enterprise' ? 'bg-indigo-100 text-indigo-900 border border-indigo-200' : 'bg-sand-100 text-sand-800 border border-sand-200') }}">
                                                <i data-lucide="award" class="w-3.5 h-3.5 {{ $pkg->slug === 'partner-pro' ? 'text-amber-600' : 'text-sand-500' }}"></i>
                                                {{ $pkg->name }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-sand-100 text-sand-600 text-[10px] font-semibold">
                                                Default Starter
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Pemakaian Kuota -->
                                    <td class="py-4 px-5 min-w-[200px]">
                                        <div class="space-y-1.5">
                                            <div class="flex items-center justify-between text-xs">
                                                <span><strong class="text-charcoal-950">{{ $used }}</strong> / {{ $quota > 0 ? $quota : '∞' }} Undangan</span>
                                                <span class="font-bold {{ $pct >= 90 ? 'text-rose-600' : ($pct >= 70 ? 'text-amber-600' : 'text-emerald-600') }}">
                                                    {{ $quota > 0 ? $pct . '%' : 'Unlimited' }}
                                                </span>
                                            </div>
                                            @if($quota > 0)
                                                <div class="w-full bg-sand-200/80 rounded-full h-2 overflow-hidden">
                                                    <div class="h-2 rounded-full transition-all duration-300 {{ $pct >= 90 ? 'bg-rose-500' : ($pct >= 70 ? 'bg-amber-500' : 'bg-emerald-500') }}" style="width: {{ $pct }}%"></div>
                                                </div>
                                            @endif
                                            @if($quota > 0 && $used >= $quota)
                                                <span class="text-[10px] text-rose-600 font-bold block">
                                                    ⚠️ Kuota Penuh
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Ganti Paket Form -->
                                    <td class="py-4 px-5">
                                        <form action="{{ route('admin.partners.users.package', $partner) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select 
                                                name="package_id" 
                                                class="text-xs font-semibold py-1.5 px-2.5 rounded-xl border-sand-300 bg-white text-charcoal-950 focus:border-amber-600 focus:ring-amber-500/20"
                                            >
                                                @foreach($packages as $pOption)
                                                    <option value="{{ $pOption->id }}" {{ ($partner->package_id === $pOption->id || (! $partner->package_id && $pOption->slug === 'partner-starter')) ? 'selected' : '' }}>
                                                        {{ $pOption->name }} ({{ $pOption->quota_invitations > 0 ? $pOption->quota_invitations . ' Undangan' : 'Unlimited' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button 
                                                type="submit" 
                                                class="px-3 py-1.5 rounded-xl bg-charcoal-950 hover:bg-amber-700 text-white text-xs font-bold transition shrink-0 shadow-sm"
                                            >
                                                Terapkan
                                            </button>
                                        </form>
                                    </td>

                                    <!-- Status Akun -->
                                    <td class="py-4 px-5 text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $partner->status === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                            {{ $partner->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-xs text-sand-500">
                                        <i data-lucide="users" class="w-8 h-8 mx-auto text-sand-300 mb-2"></i>
                                        <p>Belum ada partner atau Wedding Organizer yang terdaftar.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($partners->hasPages())
                    <div class="p-4 border-t border-sand-200">
                        {{ $partners->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>
