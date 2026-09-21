<!-- STEP 6: AMPLOP DIGITAL, KADO & RILIS -->
<div x-show="currentStep === 6" x-transition data-step="6" class="space-y-6">

    <!-- REKENING TANDA KASIH (AMPLOP DIGITAL) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- REKENING 1 -->
        <div class="p-5 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-3">
            <div class="flex items-center gap-2 pb-2 border-b border-sand-200">
                <i data-lucide="credit-card" class="w-4 h-4 text-brand-600"></i>
                <h4 class="font-serif text-sm font-bold text-charcoal-950">Rekening Bank / Dompet Digital 1</h4>
            </div>

            <div class="space-y-2.5">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">Nama Bank / E-Wallet</label>
                    <input 
                        type="text" 
                        name="bank_1_name" 
                        value="{{ old('bank_1_name', $bank1?->bank_name) }}" 
                        placeholder="BCA / Mandiri / BSI / GoPay / OVO" 
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">Nomor Rekening / No. HP</label>
                    <input 
                        type="text" 
                        name="bank_1_number" 
                        value="{{ old('bank_1_number', old('bank_1_account', $bank1?->account_number)) }}" 
                        placeholder="1234567890" 
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 font-mono"
                    >
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">Atas Nama Pemilik</label>
                    <input 
                        type="text" 
                        name="bank_1_holder" 
                        value="{{ old('bank_1_holder', $bank1?->account_name) }}" 
                        placeholder="Romeo Montague" 
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>

                <div class="space-y-1 pt-1">
                    <label class="block text-[11px] font-semibold text-sand-600">Gambar QRIS (Opsional)</label>
                    @if($bank1?->qr_code_url ?? $bank1?->qris_image)
                        <div class="flex items-center gap-2 mb-1.5 p-2 rounded-lg bg-emerald-50/80 border border-emerald-200">
                            <img src="{{ $bank1?->qr_code_url ?? $bank1?->qris_image }}" alt="QRIS 1" class="w-10 h-10 rounded object-cover border border-emerald-300">
                            <div class="text-[11px] text-emerald-800 leading-tight">
                                <span class="font-bold block">QRIS Tersimpan</span>
                                <span class="text-[10px] text-emerald-600">Pilih file baru di bawah jika ingin mengganti.</span>
                            </div>
                        </div>
                    @endif
                    <input type="hidden" name="bank_1_existing_qris" value="{{ $bank1?->qr_code_url ?? $bank1?->qris_image }}">
                    <input 
                        type="file" 
                        name="bank_1_qris_file" 
                        accept="image/*"
                        class="w-full text-xs text-sand-600 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-sand-200 file:text-charcoal-900 hover:file:bg-sand-300 cursor-pointer"
                    >
                </div>
            </div>
        </div>

        <!-- REKENING 2 -->
        <div class="p-5 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-3">
            <div class="flex items-center gap-2 pb-2 border-b border-sand-200">
                <i data-lucide="credit-card" class="w-4 h-4 text-brand-600"></i>
                <h4 class="font-serif text-sm font-bold text-charcoal-950">Rekening Bank / Dompet Digital 2 (Opsional)</h4>
            </div>

            <div class="space-y-2.5">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">Nama Bank / E-Wallet</label>
                    <input 
                        type="text" 
                        name="bank_2_name" 
                        value="{{ old('bank_2_name', $bank2?->bank_name) }}" 
                        placeholder="BNI / BRI / Dana / QRIS" 
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">Nomor Rekening / No. HP</label>
                    <input 
                        type="text" 
                        name="bank_2_number" 
                        value="{{ old('bank_2_number', old('bank_2_account', $bank2?->account_number)) }}" 
                        placeholder="0987654321" 
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 font-mono"
                    >
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">Atas Nama Pemilik</label>
                    <input 
                        type="text" 
                        name="bank_2_holder" 
                        value="{{ old('bank_2_holder', $bank2?->account_name) }}" 
                        placeholder="Juliet Capulet" 
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                    >
                </div>

                <div class="space-y-1 pt-1">
                    <label class="block text-[11px] font-semibold text-sand-600">Gambar QRIS (Opsional)</label>
                    @if($bank2?->qr_code_url ?? $bank2?->qris_image)
                        <div class="flex items-center gap-2 mb-1.5 p-2 rounded-lg bg-emerald-50/80 border border-emerald-200">
                            <img src="{{ $bank2?->qr_code_url ?? $bank2?->qris_image }}" alt="QRIS 2" class="w-10 h-10 rounded object-cover border border-emerald-300">
                            <div class="text-[11px] text-emerald-800 leading-tight">
                                <span class="font-bold block">QRIS Tersimpan</span>
                                <span class="text-[10px] text-emerald-600">Pilih file baru di bawah jika ingin mengganti.</span>
                            </div>
                        </div>
                    @endif
                    <input type="hidden" name="bank_2_existing_qris" value="{{ $bank2?->qr_code_url ?? $bank2?->qris_image }}">
                    <input 
                        type="file" 
                        name="bank_2_qris_file" 
                        accept="image/*"
                        class="w-full text-xs text-sand-600 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-sand-200 file:text-charcoal-900 hover:file:bg-sand-300 cursor-pointer"
                    >
                </div>
            </div>
        </div>

    </div>

    <!-- ALAMAT KADO FISIK -->
    <div class="p-5 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-2">
        <div class="flex items-center gap-2 pb-1 border-b border-sand-200">
            <i data-lucide="package" class="w-4 h-4 text-brand-600"></i>
            <h4 class="font-serif text-sm font-bold text-charcoal-950">Alamat Pengiriman Kado Fisik (Opsional)</h4>
        </div>
        <textarea 
            name="gift_address" 
            rows="2" 
            placeholder="Penerima: Romeo & Juliet, No HP: 08123456789, Alamat: Jl. Mawar Indah No. 12, Jakarta Selatan" 
            class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
        >{{ old('gift_address', $giftAddress) }}</textarea>
    </div>

    <!-- DEFAULT PUBLISHED STATUS (HIDDEN) -->
    <input 
        type="hidden" 
        name="is_published" 
        value="{{ old('is_published', $invitation ? ($invitation->is_published ? '1' : '0') : '1') }}"
    >
</div>
