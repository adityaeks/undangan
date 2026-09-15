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
                        name="bank_1_account" 
                        value="{{ old('bank_1_account', $bank1?->account_number) }}" 
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
                        name="bank_2_account" 
                        value="{{ old('bank_2_account', $bank2?->account_number) }}" 
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

    <!-- TEMPLATE WHATSAPP SEBAR UNDANGAN -->
    <div class="p-5 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-2">
        <div class="flex items-center gap-2 pb-1 border-b border-sand-200">
            <i data-lucide="message-square" class="w-4 h-4 text-emerald-600"></i>
            <h4 class="font-serif text-sm font-bold text-charcoal-950">Template Pesan WhatsApp Sebar Undangan</h4>
        </div>
        <textarea 
            name="whatsapp_template" 
            rows="4" 
            class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 font-mono"
        >{{ old('whatsapp_template', $invitation?->setting?->metadata['whatsapp_template'] ?? "Kepada Yth. *{nama}*\n\nTanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i untuk menghadiri pernikahan kami:\n\n*{judul}*\n\nInformasi lengkap dan konfirmasi kehadiran:\n{link}\n\nMerupakan suatu kehormatan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.\n\nTerima kasih.") }}</textarea>
        <p class="text-[10px] text-sand-500">Gunakan placeholder: <code class="bg-sand-200 px-1 py-0.5 rounded text-charcoal-900 font-bold">{nama}</code>, <code class="bg-sand-200 px-1 py-0.5 rounded text-charcoal-900 font-bold">{judul}</code>, dan <code class="bg-sand-200 px-1 py-0.5 rounded text-charcoal-900 font-bold">{link}</code>.</p>
    </div>

    <!-- STATUS PUBLIKASI UNDANGAN -->
    <div class="p-5 rounded-2xl bg-charcoal-950 text-white space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h4 class="font-serif text-sm font-bold text-brand-200">Status Publikasi Undangan</h4>
                <p class="text-xs text-sand-400">Pilih apakah website langsung aktif dapat diakses publik atau disimpan sebagai draf.</p>
            </div>
            <span class="px-3 py-1 rounded-full bg-brand-500/20 text-brand-300 text-xs font-bold border border-brand-500/40">
                Final Step
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 border-t border-charcoal-800">
            <label class="relative flex items-center gap-3 p-3.5 rounded-xl border border-charcoal-700 bg-charcoal-900/60 hover:border-brand-500/50 cursor-pointer transition">
                <input 
                    type="radio" 
                    name="is_published" 
                    value="1" 
                    @checked(old('is_published', $invitation ? ($invitation->is_published ? '1' : '0') : '1') === '1')
                    class="w-4 h-4 text-brand-500 focus:ring-brand-500"
                >
                <div>
                    <span class="text-xs font-bold text-white block">Langsung Terbitkan (Online)</span>
                    <span class="text-[11px] text-sand-400">Website undangan langsung dapat dibuka oleh tamu.</span>
                </div>
            </label>

            <label class="relative flex items-center gap-3 p-3.5 rounded-xl border border-charcoal-700 bg-charcoal-900/60 hover:border-brand-500/50 cursor-pointer transition">
                <input 
                    type="radio" 
                    name="is_published" 
                    value="0" 
                    @checked(old('is_published', $invitation ? ($invitation->is_published ? '1' : '0') : '1') === '0')
                    class="w-4 h-4 text-brand-500 focus:ring-brand-500"
                >
                <div>
                    <span class="text-xs font-bold text-white block">Simpan Sebagai Draf (Offline)</span>
                    <span class="text-[11px] text-sand-400">Belum dapat diakses tamu, bisa diedit kembali nanti.</span>
                </div>
            </label>
        </div>
    </div>
</div>
