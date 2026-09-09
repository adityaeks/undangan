<x-partner-layout>
    <div class="space-y-6" x-data="{ 
        addModal: false, 
        templateModal: false,
        toast: { show: false, message: '' }, 
        defaultTemplate: @js(\App\Models\Invitation::defaultWhatsappTemplate()),
        invitationTemplates: @js($invitations->mapWithKeys(fn($i) => [$i->id => $i->whatsapp_template])),
        templateInvId: '{{ $selectedInvitation?->id ?? ($invitations->first()?->id ?? '') }}',
        templateText: '',
        
        init() {
            this.updateTemplateText();
        },
        updateTemplateText() {
            this.templateText = this.invitationTemplates[this.templateInvId] || this.defaultTemplate;
        },
        resetTemplateToDefault() {
            this.templateText = this.defaultTemplate;
        },
        insertTag(tag) {
            const textarea = this.$refs.templateTextarea;
            if (textarea) {
                const start = textarea.selectionStart;
                const end = textarea.selectionEnd;
                this.templateText = this.templateText.substring(0, start) + tag + this.templateText.substring(end);
                this.$nextTick(() => {
                    textarea.focus();
                    textarea.setSelectionRange(start + tag.length, start + tag.length);
                });
            } else {
                this.templateText += ' ' + tag;
            }
        },
        getTemplatePreview() {
            const sampleName = 'Bpk. Budi Santoso & Keluarga';
            const sampleLink = '{{ url('/u/undangan-klien') }}?to=' + encodeURIComponent(sampleName);
            return (this.templateText || this.defaultTemplate)
                .replaceAll('[nama]', sampleName)
                .replaceAll('{nama}', sampleName)
                .replaceAll('[link]', sampleLink)
                .replaceAll('{link}', sampleLink);
        },
        copyLink(url) { 
            navigator.clipboard.writeText(url); 
            this.toast.message = 'Link personal undangan berhasil disalin!'; 
            this.toast.show = true; 
            setTimeout(() => this.toast.show = false, 3000); 
        } 
    }">
        
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

        <!-- PAGE HEADER -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-3 border-b border-sand-200">
            <div class="max-w-2xl">
                <a href="{{ route('partner.invitations.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-sand-600 hover:text-charcoal-900 transition mb-1">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali ke Daftar Undangan
                </a>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">Buku Tamu &amp; Sebar Undangan WA</h1>
                <p class="text-xs text-sand-500 mt-0.5">Kelola daftar penerima undangan (Kepada Yth: ...), salin tautan personal, dan sebar via WhatsApp untuk klien Anda.</p>
            </div>

            <div class="flex items-center gap-2.5 flex-shrink-0">
                @if($invitations->isNotEmpty())
                    <button 
                        type="button" 
                        @click="templateModal = true"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-sand-300 hover:border-sand-400 text-charcoal-900 font-bold text-xs hover:bg-sand-50 shadow-sm transition whitespace-nowrap cursor-pointer"
                    >
                        <i data-lucide="message-square-text" class="w-4 h-4 text-emerald-600"></i>
                        <span>Template Pesan WA</span>
                    </button>
                    <button 
                        type="button" 
                        @click="addModal = true"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 text-white font-bold text-xs shadow-md hover:shadow-amber-500/25 hover:scale-[1.02] transition whitespace-nowrap cursor-pointer"
                    >
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        <span>Tambah Tamu Penerima</span>
                    </button>
                @else
                    <a 
                        href="{{ route('partner.invitations.create') }}" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 text-white font-bold text-xs shadow-md hover:scale-[1.02] transition whitespace-nowrap cursor-pointer"
                    >
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>Buat Undangan Dulu</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- SUCCESS ALERT -->
        @if (session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2.5">
                    <div class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-xs">
                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                    </div>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- STATS TILES -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="p-4 rounded-3xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm bg-white/80">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block">Total Tamu</span>
                    <div class="font-serif text-xl font-bold text-charcoal-950">{{ $totalGuests }} <span class="text-xs font-sans text-sand-400 font-normal">Tamu</span></div>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-sand-100 text-charcoal-900 flex items-center justify-center font-bold">
                    <i data-lucide="users" class="w-4 h-4 text-amber-700"></i>
                </div>
            </div>

            <div class="p-4 rounded-3xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm bg-white/80">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block">Konfirmasi Hadir</span>
                    <div class="font-serif text-xl font-bold text-emerald-600">{{ $totalAttending }} <span class="text-xs font-sans text-emerald-500 font-normal">Tamu</span></div>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-4 rounded-3xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm bg-white/80">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-rose-700 block">Berhalangan</span>
                    <div class="font-serif text-xl font-bold text-rose-600">{{ $totalDeclined }} <span class="text-xs font-sans text-rose-400 font-normal">Tamu</span></div>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold">
                    <i data-lucide="x-circle" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-4 rounded-3xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm bg-white/80">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700 block">Belum Konfirmasi</span>
                    <div class="font-serif text-xl font-bold text-amber-600">{{ $totalPending }} <span class="text-xs font-sans text-amber-500 font-normal">Pending</span></div>
                </div>
                <div class="w-9 h-9 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                </div>
            </div>
        </div>

        <!-- SEARCH & FILTER TOOLBAR -->
        <div class="p-4 rounded-3xl glass-panel border border-sand-200/80 shadow-sm bg-white/95">
            <form method="GET" action="{{ route('partner.guests.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 text-xs">
                <!-- FILTER UNDANGAN -->
                <div>
                    <label class="block font-bold text-charcoal-900 mb-1">Pilih Undangan Klien</label>
                    <select name="invitation_id" class="w-full px-3 py-2 rounded-xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">-- Semua Undangan Klien --</option>
                        @foreach($invitations as $inv)
                            <option value="{{ $inv->id }}" {{ request('invitation_id') == $inv->id ? 'selected' : '' }}>
                                {{ $inv->title }} ({{ $inv->client->name ?? 'Klien WO' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- CARI NAMA / WA -->
                <div>
                    <label class="block font-bold text-charcoal-900 mb-1">Cari Nama / No. WA</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Ketik nama tamu..." 
                            class="w-full pl-8 pr-3 py-2 rounded-xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-amber-500"
                        >
                        <i data-lucide="search" class="w-3.5 h-3.5 text-sand-400 absolute left-2.5 top-2.5"></i>
                    </div>
                </div>

                <!-- FILTER STATUS -->
                <div>
                    <label class="block font-bold text-charcoal-900 mb-1">Status Kehadiran</label>
                    <select name="status" class="w-full px-3 py-2 rounded-xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="all">Semua Status</option>
                        <option value="hadir" {{ request('status') === 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="tidak_hadir" {{ request('status') === 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Belum Konfirmasi</option>
                    </select>
                </div>

                <!-- FILTER ACTIONS -->
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 rounded-xl bg-charcoal-950 text-white font-bold text-xs hover:bg-amber-600 transition flex items-center justify-center gap-1.5">
                        <i data-lucide="filter" class="w-3.5 h-3.5"></i>
                        <span>Terapkan</span>
                    </button>
                    @if(request()->hasAny(['invitation_id', 'search', 'status', 'category']))
                        <a href="{{ route('partner.guests.index') }}" class="px-3 py-2 rounded-xl bg-sand-200 text-charcoal-900 font-bold text-xs hover:bg-sand-300 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- GUESTS TABLE -->
        <div class="rounded-3xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm bg-white">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-sand-50/90 border-b border-sand-200/80 text-sand-600 font-bold uppercase tracking-wider text-[10px]">
                        <tr>
                            <th class="p-4 pl-6">Nama Penerima &amp; Undangan</th>
                            <th class="p-4">No. WhatsApp</th>
                            <th class="p-4">Pax</th>
                            <th class="p-4">Status RSVP</th>
                            <th class="p-4 text-right pr-6">Tautan &amp; Sebar WA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sand-200/60 font-medium text-charcoal-900">
                        @forelse($guests as $guest)
                            @php
                                $invitationSlug = $guest->invitation->slug ?? 'demo';
                                $personalLink = route('invitation.show', $invitationSlug) . '?to=' . urlencode($guest->name);
                                $waText = $guest->invitation 
                                    ? $guest->invitation->formatWhatsappMessage($guest->name, $personalLink)
                                    : "Kepada Yth. *{$guest->name}*\n\nKami mengundang Anda ke pernikahan kami:\n{$personalLink}\n\nTerima kasih.";
                                $waUrl = whatsapp_url($guest->phone, $waText);
                            @endphp
                            <tr class="hover:bg-amber-50/40 transition">
                                <td class="p-4 pl-6">
                                    <div class="font-bold text-charcoal-950 font-serif text-sm">{{ $guest->name }}</div>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-sand-200 text-charcoal-800 text-[10px] font-bold">
                                            {{ $guest->category ?? 'Umum' }}
                                        </span>
                                        @if($guest->invitation)
                                            <span class="text-[11px] text-sand-500">
                                                • {{ $guest->invitation->title }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 font-mono text-sand-700">
                                    {{ $guest->phone ?: '-' }}
                                </td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 rounded-full bg-sand-100 text-charcoal-900 font-bold text-[11px]">
                                        {{ $guest->pax }} Orang
                                    </span>
                                </td>
                                <td class="p-4">
                                    @if($guest->attendance_status === 'hadir')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold border border-emerald-200">
                                            <i data-lucide="check" class="w-3 h-3"></i>
                                            <span>Hadir</span>
                                        </span>
                                    @elseif($guest->attendance_status === 'tidak_hadir')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-rose-100 text-rose-800 text-[10px] font-bold border border-rose-200">
                                            <i data-lucide="x" class="w-3 h-3"></i>
                                            <span>Tidak Hadir</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold border border-amber-200">
                                            <i data-lucide="clock" class="w-3 h-3"></i>
                                            <span>Belum Konfirmasi</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 pr-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- WhatsApp Share -->
                                        @if($guest->phone)
                                            <a 
                                                href="{{ $waUrl }}" 
                                                target="_blank"
                                                class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] transition inline-flex items-center gap-1.5 shadow-sm"
                                                title="Kirim Undangan WhatsApp"
                                            >
                                                <i data-lucide="send" class="w-3.5 h-3.5"></i>
                                                <span>Kirim WA</span>
                                            </a>
                                        @else
                                            <a 
                                                href="{{ $waUrl }}" 
                                                target="_blank"
                                                class="px-2.5 py-1.5 rounded-xl bg-sand-200 hover:bg-emerald-600 hover:text-white text-charcoal-800 font-bold text-[11px] transition inline-flex items-center gap-1"
                                                title="Buka WhatsApp Share"
                                            >
                                                <i data-lucide="share-2" class="w-3.5 h-3.5"></i>
                                                <span>Share WA</span>
                                            </a>
                                        @endif

                                        <!-- Copy Personal Link -->
                                        <button 
                                            type="button" 
                                            @click="copyLink('{{ $personalLink }}')"
                                            class="p-1.5 rounded-xl bg-amber-50 hover:bg-amber-100 border border-amber-200 text-amber-900 transition"
                                            title="Salin Tautan Personal Tamu"
                                        >
                                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                        </button>

                                        <!-- Delete Guest -->
                                        <form method="POST" action="{{ route('partner.guests.destroy', $guest) }}" data-confirm="Hapus {{ $guest->name }} dari daftar undangan klien?" data-confirm-title="Hapus Tamu?" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="p-1.5 rounded-xl text-sand-400 hover:text-rose-600 hover:bg-rose-50 transition"
                                                title="Hapus Tamu"
                                            >
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-sand-400">
                                    <div class="max-w-sm mx-auto space-y-3">
                                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center mx-auto">
                                            <i data-lucide="users" class="w-6 h-6"></i>
                                        </div>
                                        <p class="text-xs">Belum ada daftar tamu untuk undangan klien yang dipilih. Klik tombol <strong>Tambah Tamu Penerima</strong> untuk mulai memasukkan nama tamu.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($guests->hasPages())
                <div class="p-4 border-t border-sand-200">
                    {{ $guests->links() }}
                </div>
            @endif
        </div>

        <!-- MODAL EDIT TEMPLATE UCAPAN WA -->
        <div 
            x-show="templateModal" 
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
                class="w-full max-w-xl rounded-3xl glass-panel bg-white p-6 sm:p-8 shadow-2xl border border-sand-200 space-y-5"
            >
                <div class="flex items-center justify-between pb-3 border-b border-sand-200">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-xs shadow">
                            <i data-lucide="message-square-text" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h3 class="font-serif text-lg font-bold text-charcoal-950">Template Pesan WhatsApp</h3>
                            <p class="text-[11px] text-sand-500">Sesuaikan kata-kata undangan yang dikirimkan via WhatsApp ke para tamu</p>
                        </div>
                    </div>
                    <button type="button" @click="templateModal = false" class="p-1 rounded-xl text-sand-400 hover:text-charcoal-900 transition">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('partner.guests.template') }}" class="space-y-4 text-xs">
                    @csrf

                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Pilih Undangan Klien *</label>
                        <select 
                            name="invitation_id" 
                            x-model="templateInvId" 
                            @change="updateTemplateText()" 
                            required 
                            class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        >
                            @foreach($invitations as $inv)
                                <option value="{{ $inv->id }}">{{ $inv->title }} ({{ $inv->client->name ?? 'Klien WO' }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="font-bold text-charcoal-950">Format Teks Ucapan WhatsApp</label>
                            <button 
                                type="button" 
                                @click="resetTemplateToDefault()" 
                                class="text-[11px] text-sand-500 hover:text-amber-700 underline font-semibold"
                            >
                                Reset ke Bawaan
                            </button>
                        </div>
                        <textarea 
                            name="whatsapp_template" 
                            x-ref="templateTextarea"
                            x-model="templateText" 
                            rows="7" 
                            required
                            class="w-full px-4 py-3 rounded-2xl border border-sand-300 bg-white text-xs font-mono leading-relaxed focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            placeholder="Tulis format pesan WhatsApp..."
                        ></textarea>
                    </div>

                    <!-- TAG HELPER BUTTONS -->
                    <div class="flex items-center gap-2 flex-wrap text-[11px]">
                        <span class="text-sand-500 font-semibold">Sisipkan Variabel:</span>
                        <button 
                            type="button" 
                            @click="insertTag('[nama]')"
                            class="px-2.5 py-1 rounded-xl bg-amber-50 hover:bg-amber-100 border border-amber-300 text-amber-900 font-bold transition flex items-center gap-1"
                        >
                            <i data-lucide="plus" class="w-3 h-3"></i>
                            <span>[nama] (Nama Tamu)</span>
                        </button>
                        <button 
                            type="button" 
                            @click="insertTag('[link]')"
                            class="px-2.5 py-1 rounded-xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-300 text-emerald-900 font-bold transition flex items-center gap-1"
                        >
                            <i data-lucide="plus" class="w-3 h-3"></i>
                            <span>[link] (Tautan Undangan)</span>
                        </button>
                    </div>

                    <!-- LIVE PREVIEW ACCORDION -->
                    <div class="p-4 rounded-2xl bg-sand-50 border border-sand-200 space-y-1.5">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block">Preview Hasil Pesan WhatsApp:</span>
                        <div class="p-3 bg-white rounded-xl border border-sand-200 whitespace-pre-wrap text-[11px] text-charcoal-900 leading-relaxed font-sans" x-text="getTemplatePreview()"></div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button type="button" @click="templateModal = false" class="px-4 py-2.5 rounded-xl bg-sand-100 text-charcoal-800 font-bold text-xs hover:bg-sand-200 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-bold text-xs shadow hover:scale-[1.02] transition">
                            Simpan Template Ucapan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL TAMBAH TAMU -->
        <div 
            x-show="addModal" 
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
                class="w-full max-w-lg rounded-3xl glass-panel bg-white p-6 sm:p-8 shadow-2xl border border-sand-200 space-y-5"
                x-data="{ 
                    guestName: '', 
                    guestPhone: '', 
                    invId: '{{ $selectedInvitation?->id ?? ($invitations->first()?->id ?? '') }}',
                    getPreviewUrl() {
                        const inv = @js($invitations->keyBy('id'));
                        const slug = inv[this.invId] ? inv[this.invId].slug : 'undangan';
                        return '{{ url('/u') }}/' + slug + '?to=' + encodeURIComponent(this.guestName || 'Nama Tamu');
                    }
                }"
            >
                <div class="flex items-center justify-between pb-3 border-b border-sand-200">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-amber-500 text-white flex items-center justify-center font-bold text-xs shadow">
                            <i data-lucide="user-plus" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h3 class="font-serif text-lg font-bold text-charcoal-950">Tambah Tamu Penerima</h3>
                            <p class="text-[11px] text-sand-500">Tentukan nama yang muncul di cover "Kepada Yth: ..."</p>
                        </div>
                    </div>
                    <button type="button" @click="addModal = false" class="p-1 rounded-xl text-sand-400 hover:text-charcoal-900 transition">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('partner.guests.store') }}" class="space-y-4 text-xs">
                    @csrf
                    
                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Undangan Klien *</label>
                        <select name="invitation_id" x-model="invId" required class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @foreach($invitations as $inv)
                                <option value="{{ $inv->id }}" {{ ($selectedInvitation?->id ?? '') == $inv->id ? 'selected' : '' }}>
                                    {{ $inv->title }} (Klien: {{ $inv->client->name ?? 'Direct' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Nama Tamu / Kepada Yth *</label>
                        <input 
                            type="text" 
                            name="name" 
                            x-model="guestName" 
                            required 
                            placeholder="Contoh: Bpk. Bambang Pamungkas &amp; Keluarga" 
                            class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-amber-500"
                        >
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">No. WhatsApp (Opsional)</label>
                            <input 
                                type="text" 
                                name="phone" 
                                x-model="guestPhone" 
                                placeholder="08123456789" 
                                class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-amber-500"
                            >
                        </div>
                        <div>
                            <label class="block font-bold text-charcoal-950 mb-1">Kategori / Hubungan</label>
                            <input 
                                type="text" 
                                name="category" 
                                placeholder="Keluarga / VIP / Teman Kantor" 
                                class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-amber-500"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Jumlah Undangan / Pax</label>
                        <input 
                            type="number" 
                            name="pax" 
                            value="2" 
                            min="1" 
                            max="20" 
                            class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-amber-500"
                        >
                    </div>

                    <!-- PREVIEW LINK -->
                    <div class="p-3.5 rounded-2xl bg-sand-50 border border-sand-200 space-y-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block">Preview Tautan Personal Tamu:</span>
                        <div class="font-mono text-[11px] text-amber-700 break-all" x-text="getPreviewUrl()"></div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-3">
                        <button type="button" @click="addModal = false" class="px-4 py-2 rounded-xl bg-sand-100 text-charcoal-800 font-bold text-xs hover:bg-sand-200 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-amber-500 to-amber-700 text-white font-bold text-xs shadow hover:scale-[1.02] transition">
                            Simpan Tamu
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-partner-layout>
