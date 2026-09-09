<x-app-layout>
    <div class="space-y-3.5 sm:space-y-4">

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
            <div>
                <h1 class="font-serif text-xl sm:text-2xl font-bold text-charcoal-950">Kelola Kupon Promo &amp; Diskon</h1>
                <p class="text-xs text-sand-600">
                    Buat kode promosi, atur potongan harga persentase atau nominal tetap, dan pantau efektivitas pemakaian kupon checkout.
                </p>
            </div>
        </div>

        @if(session('success'))
            <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2">
                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 flex-shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 flex-shrink-0"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- STATS CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
            <div class="p-3 sm:p-3.5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block">Total Kupon Promo</span>
                    <div class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">{{ $totalCoupons }} <span class="text-xs font-sans text-sand-500 font-normal">Kupon</span></div>
                </div>
                <div class="w-8 h-8 rounded-xl bg-sand-100 text-charcoal-900 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="ticket" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-3 sm:p-3.5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block">Kupon Aktif</span>
                    <div class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">{{ $totalActive }} <span class="text-xs font-sans text-sand-500 font-normal">Aktif</span></div>
                </div>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-3 sm:p-3.5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700 block">Total Penggunaan</span>
                    <div class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">{{ $totalUsage }}x <span class="text-xs font-sans text-sand-500 font-normal">Terpakai</span></div>
                </div>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="badge-percent" class="w-4 h-4"></i>
                </div>
            </div>
        </div>

        <!-- CREATE COUPON FORM CARD -->
        <div x-data="{ open: false }" class="rounded-2xl glass-panel border border-sand-200/80 p-4 sm:p-5 shadow-sm space-y-3">
            <div class="flex items-center justify-between cursor-pointer" @click="open = !open">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h2 class="font-serif text-sm sm:text-base font-bold text-charcoal-950">Buat Kode Kupon Baru</h2>
                        <p class="text-[11px] text-sand-500">Klik untuk membuka formulir penambahan promo kupon.</p>
                    </div>
                </div>
                <button type="button" class="p-1 text-sand-500 hover:text-charcoal-900 transition">
                    <i data-lucide="chevron-down" class="w-4 h-4 transform transition-transform" :class="open ? 'rotate-180' : ''"></i>
                </button>
            </div>

            <form x-show="open" x-transition action="{{ route('admin.coupons.store') }}" method="POST" class="pt-4 border-t border-sand-200/60 space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-charcoal-900 mb-1">Kode Kupon <span class="text-rose-500">*</span></label>
                        <input type="text" name="code" value="{{ old('code') }}" placeholder="Cth: SPECIALWEDDING" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-sand-300 text-xs uppercase font-mono font-bold tracking-wider focus:ring-2 focus:ring-brand-500">
                        @error('code')
                            <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-charcoal-900 mb-1">Tipe Diskon <span class="text-rose-500">*</span></label>
                        <select name="discount_type" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-300 text-xs focus:ring-2 focus:ring-brand-500">
                            <option value="percent">Persentase (%)</option>
                            <option value="fixed">Nominal Tetap (Rp)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-charcoal-900 mb-1">Nilai Diskon <span class="text-rose-500">*</span></label>
                        <input type="number" step="0.01" name="discount_value" value="{{ old('discount_value') }}" placeholder="Cth: 30 untuk 30% atau 20000" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-sand-300 text-xs focus:ring-2 focus:ring-brand-500">
                        @error('discount_value')
                            <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-charcoal-900 mb-1">Minimal Belanja (Rp)</label>
                        <input type="text" inputmode="numeric" name="min_spend" value="{{ format_rupiah(old('min_spend', 0)) }}" oninput="maskRupiah(this)" placeholder="0 = tanpa minimum"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-sand-300 text-xs focus:ring-2 focus:ring-brand-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-charcoal-900 mb-1">Batas Maksimal Penggunaan</label>
                        <input type="number" name="max_uses" value="{{ old('max_uses') }}" placeholder="Kosongkan jika unlimited"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-sand-300 text-xs focus:ring-2 focus:ring-brand-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-charcoal-900 mb-1">Tanggal Kadaluwarsa</label>
                        <input type="date" name="expires_at" value="{{ old('expires_at') }}"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-sand-300 text-xs focus:ring-2 focus:ring-brand-500">
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-charcoal-900 hover:bg-charcoal-800 text-white font-bold text-xs shadow-md transition flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Simpan & Aktifkan Kupon</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- COUPONS TABLE -->
        <div class="rounded-3xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-sand-50/80 border-b border-sand-200/80 text-sand-600 font-bold uppercase tracking-wider">
                            <th class="p-4 pl-6">Kode Kupon</th>
                            <th class="p-4">Tipe & Potongan</th>
                            <th class="p-4">Min. Belanja</th>
                            <th class="p-4 text-center">Pemakaian</th>
                            <th class="p-4">Kadaluwarsa</th>
                            <th class="p-4 text-center">Status</th>
                            <th class="p-4 pr-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sand-200/60">
                        @forelse($coupons as $coupon)
                            <tr class="hover:bg-sand-50/50 transition">
                                <td class="p-4 pl-6">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-charcoal-900 text-amber-300 font-mono font-bold text-xs tracking-wider">
                                        <i data-lucide="tag" class="w-3.5 h-3.5"></i>
                                        {{ $coupon->code }}
                                    </span>
                                </td>
                                <td class="p-4 font-semibold text-charcoal-950">
                                    @if($coupon->discount_type === 'percent')
                                        <span class="text-emerald-700 font-bold">{{ number_format($coupon->discount_value, 0) }}% OFF</span>
                                    @else
                                        <span class="text-emerald-700 font-bold">{{ format_rupiah($coupon->discount_value) }}</span>
                                    @endif
                                </td>
                                <td class="p-4 text-sand-600">
                                    {{ $coupon->min_spend > 0 ? format_rupiah($coupon->min_spend) : 'Tanpa Min.' }}
                                </td>
                                <td class="p-4 text-center font-semibold text-charcoal-900">
                                    {{ $coupon->used_count }} {{ $coupon->max_uses ? '/ '.$coupon->max_uses : 'kali' }}
                                </td>
                                <td class="p-4 text-sand-600">
                                    @if($coupon->expires_at)
                                        <span class="{{ $coupon->expires_at->isPast() ? 'text-rose-600 font-bold' : '' }}">
                                            {{ $coupon->expires_at->isoFormat('D MMM Y') }}
                                        </span>
                                    @else
                                        <span class="text-sand-400">Selamanya</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    @if($coupon->is_active)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-sand-200 text-sand-700 text-[10px] font-bold">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 pr-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <form action="{{ route('admin.coupons.toggle', $coupon) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-2.5 py-1.5 rounded-xl border text-[11px] font-semibold transition {{ $coupon->is_active ? 'border-amber-300 text-amber-700 hover:bg-amber-50' : 'border-emerald-300 text-emerald-700 hover:bg-emerald-50' }}">
                                                {{ $coupon->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" data-confirm="Hapus kupon promo {{ $coupon->code }}?" data-confirm-title="Hapus Kupon?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-xl border border-rose-200 text-rose-600 hover:bg-rose-50 transition" title="Hapus Kupon">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-sand-500">
                                    Belum ada kupon promo yang dibuat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($coupons->hasPages())
                <div class="p-4 border-t border-sand-200/80">
                    {{ $coupons->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
