<x-partner-layout>
    <div 
        class="space-y-6"
        x-data="{
            shareModal: false,
            selectedSlug: '',
            selectedTitle: '',
            selectedId: null,
            guestName: '',
            guestPhone: '',
            guestCategory: 'Umum',
            saveToDb: true,
            toast: { show: false, message: '' },
            defaultTemplate: @js(\App\Models\Invitation::defaultWhatsappTemplate()),
            invitationTemplates: @js($invitations->mapWithKeys(fn($i) => [$i->id => $i->whatsapp_template])),
            openShareModal(slug, title, id) {
                this.selectedSlug = slug;
                this.selectedTitle = title;
                this.selectedId = id;
                this.guestName = '';
                this.guestPhone = '';
                this.guestCategory = 'Umum';
                this.shareModal = true;
            },
            getGeneratedLink() {
                if (!this.selectedSlug) return '';
                const base = '{{ url('/u') }}/' + this.selectedSlug;
                return this.guestName ? base + '?to=' + encodeURIComponent(this.guestName) : base;
            },
            getWhatsAppLink() {
                const link = this.getGeneratedLink();
                const nama = this.guestName || 'Bapak/Ibu/Saudara/i';
                const template = (this.selectedId && this.invitationTemplates[this.selectedId]) 
                    ? this.invitationTemplates[this.selectedId] 
                    : this.defaultTemplate;
                const msg = template
                    .replaceAll('[nama]', nama)
                    .replaceAll('{nama}', nama)
                    .replaceAll('[link]', link)
                    .replaceAll('{link}', link);
                let cleanPhone = (this.guestPhone || '').replace(/[^0-9]/g, '');
                if (cleanPhone.startsWith('0')) cleanPhone = '62' + cleanPhone.slice(1);
                return 'https://api.whatsapp.com/send?' + (cleanPhone ? 'phone=' + cleanPhone + '&' : '') + 'text=' + encodeURIComponent(msg);
            },
            copyGeneratedLink() {
                const link = this.getGeneratedLink();
                navigator.clipboard.writeText(link);
                this.toast.message = 'Link personal untuk ' + (this.guestName || 'tamu') + ' berhasil disalin!';
                this.toast.show = true;
                setTimeout(() => this.toast.show = false, 3000);
            }
        }"
    >
        <!-- TOAST NOTIFICATION -->
        <div 
            x-show="toast.show" 
            x-transition 
            class="fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl bg-charcoal-950 text-white text-xs font-bold shadow-2xl flex items-center gap-2 border border-amber-500/40"
            style="display: none;"
        >
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
            <span x-text="toast.message"></span>
        </div>

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-sand-200">
            <div>
                <a href="{{ route('partner.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-sand-600 hover:text-charcoal-900 transition mb-1">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali ke Dashboard Partner
                </a>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">Undangan Klien Partner</h1>
                <p class="text-xs text-sand-500">Semua undangan digital yang dibuat dan dikelola atas nama klien Anda.</p>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <div class="px-3.5 py-2 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs font-semibold flex items-center gap-1.5">
                    <i data-lucide="award" class="w-4 h-4 text-amber-600"></i>
                    <span>{{ $activePackage->name ?? 'Starter Partner' }}: <strong>{{ $invitationCount }}</strong> / {{ $invitationQuota > 0 ? $invitationQuota : '∞' }} Undangan</span>
                </div>
                <a href="{{ route('partner.guests.index') }}" class="px-4 py-2.5 rounded-2xl bg-white border border-sand-300 text-charcoal-900 font-bold text-xs hover:bg-sand-50 transition flex items-center gap-2 shadow-sm">
                    <i data-lucide="users" class="w-4 h-4 text-amber-600"></i>
                    <span>Buku Tamu &amp; Sebar WA</span>
                </a>
                @if($canCreate)
                    <a href="{{ route('partner.invitations.create') }}" class="px-5 py-2.5 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-700 text-white font-bold text-xs shadow-md transition flex items-center gap-2">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>Buat Undangan Baru</span>
                    </a>
                @else
                    <a href="{{ route('partner.packages.index') }}" class="px-5 py-2.5 rounded-2xl bg-gradient-to-r from-rose-500 to-rose-700 text-white font-bold text-xs shadow-md transition flex items-center gap-2" title="Kuota penuh. Upgrade paket untuk menambah kuota">
                        <i data-lucide="arrow-up-circle" class="w-4 h-4"></i>
                        <span>Upgrade Kuota Paket</span>
                    </a>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 flex-shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 flex-shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <a href="{{ route('partner.packages.index') }}" class="px-3 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shrink-0 transition">
                    Lihat Paket
                </a>
            </div>
        @endif

        @if(!$canCreate)
            <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs sm:text-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-sm">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-amber-200 text-amber-900 flex items-center justify-center shrink-0">
                        <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="font-bold">Batas Kuota Paket Tercapai ({{ $invitationCount }}/{{ $invitationQuota }} Undangan)</p>
                        <p class="text-xs text-amber-800">Paket {{ $activePackage->name ?? 'Starter Partner' }} Anda telah memenuhi batas kuota. Upgrade paket kemitraan untuk menambah kuota pembuatan undangan klien.</p>
                    </div>
                </div>
                <a href="{{ route('partner.packages.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-charcoal-950 text-white font-bold text-xs hover:bg-amber-600 transition shrink-0">
                    <span>Upgrade Paket Sekarang</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($invitations as $invitation)
                <div class="rounded-3xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between bg-white/90">
                    <div class="p-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-0.5 rounded-full {{ $invitation->is_published ? 'bg-emerald-100 text-emerald-800' : 'bg-sand-200 text-sand-700' }} text-[10px] font-bold uppercase tracking-wider">
                                {{ $invitation->is_published ? 'Published' : 'Draft' }}
                            </span>
                            <span class="text-xs text-sand-500">{{ $invitation->theme->name ?? 'Custom Theme' }}</span>
                        </div>

                        <div>
                            <h3 class="font-serif text-lg font-bold text-charcoal-950">{{ $invitation->title }}</h3>
                            <p class="text-xs text-sand-600">Klien: <strong class="text-charcoal-900">{{ $invitation->client->name ?? 'Direct' }}</strong></p>
                            @if($invitation->event_date)
                                <p class="text-[11px] text-sand-500 mt-1">Tanggal: {{ \Carbon\Carbon::parse($invitation->event_date)->isoFormat('D MMMM Y') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="bg-sand-50/80 p-4 border-t border-sand-200 flex flex-col gap-2">
                        <div class="flex items-center justify-between text-[11px] text-sand-500 pb-1 border-b border-sand-200/60">
                            <span class="truncate max-w-[170px]" title="/u/{{ $invitation->slug }}">/u/{{ $invitation->slug }}</span>
                            <a href="{{ route('partner.guests.index', ['invitation_id' => $invitation->id]) }}" class="text-amber-700 hover:text-amber-800 font-bold flex items-center gap-1">
                                <i data-lucide="users" class="w-3 h-3"></i>
                                <span>{{ $invitation->guests()->count() }} Tamu</span>
                            </a>
                        </div>

                        <div class="flex items-center justify-between gap-1.5 flex-wrap">
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank" class="px-2.5 py-1.5 rounded-xl bg-charcoal-950 text-white text-xs font-bold hover:bg-amber-600 transition flex items-center gap-1" title="Lihat Website Undangan">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    <span>Lihat</span>
                                </a>
                                <a href="{{ route('partner.invitations.edit', $invitation) }}" class="px-2.5 py-1.5 rounded-xl bg-amber-50 border border-amber-300 text-amber-900 text-xs font-bold hover:bg-amber-100 transition flex items-center gap-1" title="Edit Rincian Undangan">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5 text-amber-700"></i>
                                    <span>Edit</span>
                                </a>
                                <button 
                                    type="button" 
                                    @click="openShareModal('{{ $invitation->slug }}', '{{ addslashes($invitation->title) }}', {{ $invitation->id }})" 
                                    class="px-2.5 py-1.5 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs font-bold hover:bg-emerald-100 transition flex items-center gap-1" 
                                    title="Buat Link Kepada Yth & Sebar WA"
                                >
                                    <i data-lucide="send" class="w-3.5 h-3.5 text-emerald-700"></i>
                                    <span>Kirim / Kepada</span>
                                </button>
                            </div>

                            <form method="POST" action="{{ route('partner.invitations.destroy', $invitation) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus undangan klien ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-xl text-sand-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus Undangan">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-sand-400 glass-panel rounded-3xl border border-sand-200">
                    Belum ada undangan yang dibuat. Silakan buat undangan baru untuk klien Anda.
                </div>
            @endforelse
        </div>

        @if($invitations->hasPages())
            <div class="pt-4">
                {{ $invitations->links() }}
            </div>
        @endif

        <!-- MODAL KIRIM / TAUTAN KEPADA TAMU -->
        <div 
            x-show="shareModal" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto bg-charcoal-950/70 backdrop-blur-sm flex items-center justify-center p-4"
            style="display: none;"
        >
            <div 
                @click.away="shareModal = false"
                class="w-full max-w-lg rounded-3xl glass-panel bg-white p-6 sm:p-8 shadow-2xl border border-sand-200 space-y-5"
            >
                <div class="flex items-center justify-between pb-3 border-b border-sand-200">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold text-xs shadow">
                            <i data-lucide="send" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h3 class="font-serif text-lg font-bold text-charcoal-950">Kirim Undangan / Kepada</h3>
                            <p class="text-[11px] text-sand-500" x-text="selectedTitle"></p>
                        </div>
                    </div>
                    <button type="button" @click="shareModal = false" class="p-1 rounded-xl text-sand-400 hover:text-charcoal-900 transition">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <div class="space-y-4 text-xs">
                    <!-- NAMA TAMU -->
                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Nama Tamu / Kepada Yth *</label>
                        <input 
                            type="text" 
                            x-model="guestName" 
                            placeholder="Contoh: Bpk. Budi Santoso &amp; Keluarga" 
                            class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs text-charcoal-950 placeholder:text-sand-400 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        >
                        <p class="text-[10px] text-sand-500 mt-1">Nama ini akan otomatis ditampilkan di cover undangan digital: <em>"Kepada Yth. Bapak/Ibu/Saudara/i: ..."</em></p>
                    </div>

                    <!-- NO WHATSAPP -->
                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Nomor WhatsApp (Opsional)</label>
                        <input 
                            type="text" 
                            x-model="guestPhone" 
                            placeholder="Contoh: 081234567890" 
                            class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs text-charcoal-950 placeholder:text-sand-400 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        >
                    </div>

                    <!-- TAUTAN PERSONAL HASIL GENERATE -->
                    <div class="p-3.5 rounded-2xl bg-sand-50 border border-sand-200 space-y-1.5">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-sand-600 block">Tautan Khusus Tamu:</span>
                        <div class="font-mono text-xs text-emerald-800 break-all bg-white p-2 rounded-xl border border-sand-200 select-all" x-text="getGeneratedLink()"></div>
                    </div>

                    <!-- TOMBOL AKSI CEPAT -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 pt-1">
                        <button 
                            type="button" 
                            @click="copyGeneratedLink()"
                            class="w-full px-4 py-2.5 rounded-2xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 font-bold text-xs transition flex items-center justify-center gap-1.5"
                        >
                            <i data-lucide="copy" class="w-4 h-4 text-charcoal-700"></i>
                            <span>Salin Tautan</span>
                        </button>

                        <a 
                            :href="getWhatsAppLink()" 
                            target="_blank"
                            class="w-full px-4 py-2.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition flex items-center justify-center gap-1.5 shadow-sm"
                        >
                            <i data-lucide="send" class="w-4 h-4"></i>
                            <span>Kirim Pesan WhatsApp</span>
                        </a>
                    </div>

                    <!-- SIMPAN KE BUKU TAMU DATABASE (OPSIONAL FORM) -->
                    <div class="pt-3 border-t border-sand-200">
                        <form method="POST" action="{{ route('partner.guests.store') }}" class="space-y-3">
                            @csrf
                            <input type="hidden" name="invitation_id" :value="selectedId">
                            <input type="hidden" name="name" :value="guestName">
                            <input type="hidden" name="phone" :value="guestPhone">
                            <input type="hidden" name="category" value="Umum">
                            <input type="hidden" name="pax" value="2">

                            <div class="flex items-center justify-between">
                                <span class="text-[11px] text-sand-600">Simpan nama ini ke buku tamu undangan klien?</span>
                                <button 
                                    type="submit" 
                                    :disabled="!guestName"
                                    :class="guestName ? 'bg-amber-500 hover:bg-amber-600 text-charcoal-950' : 'bg-sand-200 text-sand-400 cursor-not-allowed'"
                                    class="px-3.5 py-1.5 rounded-xl font-bold text-xs transition flex items-center gap-1"
                                >
                                    <i data-lucide="bookmark-plus" class="w-3.5 h-3.5"></i>
                                    <span>Simpan ke Buku Tamu</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- LINK KE DAFTAR BUKU TAMU LENGKAP -->
                    <div class="pt-2 text-center">
                        <a 
                            :href="'{{ route('partner.guests.index') }}?invitation_id=' + selectedId"
                            class="inline-flex items-center gap-1 text-[11px] font-bold text-amber-700 hover:text-amber-800"
                        >
                            <span>Buka Halaman Buku Tamu &amp; Sebar WA Lengkap</span>
                            <i data-lucide="arrow-right" class="w-3 h-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-partner-layout>
