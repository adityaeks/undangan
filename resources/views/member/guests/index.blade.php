<x-member-layout>
    <div class="space-y-3 sm:space-y-3.5" x-data="{ 
        addModal: false, 
        templateModal: false,
        toast: { show: false, message: '' }, 
        defaultTemplate: @js(\App\Models\Invitation::defaultWhatsappTemplate()),
        invitationTemplates: @js($invitations->mapWithKeys(fn($i) => [$i->id => $i->whatsapp_template])),
        templateInvId: '{{ $primaryInvitation?->id ?? '' }}',
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
            const sampleLink = '{{ url('/u/undangan-saya') }}?to=' + encodeURIComponent(sampleName);
            return (this.templateText || this.defaultTemplate)
                .replaceAll('[nama]', sampleName)
                .replaceAll('{nama}', sampleName)
                .replaceAll('[link]', sampleLink)
                .replaceAll('{link}', sampleLink);
        },
        copyLink(url) { 
            navigator.clipboard.writeText(url); 
            this.toast.message = 'Link personal tamu berhasil disalin!'; 
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
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">Daftar Tamu &amp; Sebar Undangan WA</h1>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-800 text-[10px] font-bold uppercase tracking-wider border border-amber-500/20">Buku Tamu</span>
                </div>
                <p class="text-xs text-sand-600">
                    Kelola nama tamu personal, tautan khusus, dan kirim pesan undangan WhatsApp 1-klik.
                </p>
            </div>

            <div class="flex items-center gap-2.5 flex-shrink-0 self-start sm:self-auto">
                @if($primaryInvitation)
                    <button 
                        type="button" 
                        @click="templateModal = true"
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-sand-300 hover:border-sand-400 text-charcoal-900 font-bold text-xs hover:bg-sand-50 transition shadow-sm whitespace-nowrap cursor-pointer"
                    >
                        <i data-lucide="message-square-text" class="w-3.5 h-3.5 text-emerald-600"></i>
                        <span>Template Pesan WA</span>
                    </button>
                    <button 
                        type="button" 
                        @click="addModal = true"
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gradient-to-r from-amber-600 via-amber-700 to-brand-700 text-white font-bold text-xs shadow hover:shadow-amber-500/25 hover:scale-[1.02] transition whitespace-nowrap cursor-pointer"
                    >
                        <i data-lucide="user-plus" class="w-3.5 h-3.5"></i>
                        <span>Tambah Tamu</span>
                    </button>
                @else
                    <a 
                        href="{{ route('member.invitations.create') }}" 
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gradient-to-r from-amber-600 to-brand-700 text-white font-bold text-xs shadow hover:scale-[1.02] transition whitespace-nowrap cursor-pointer"
                    >
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                        <span>Buat Undangan Dulu</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- SUCCESS ALERT -->
        @if (session('success'))
            <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-xs">
                        <i data-lucide="check" class="w-3 h-3"></i>
                    </div>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- COMPACT STATS TILES -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
            <div class="p-2 sm:p-2.5 rounded-xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-sand-500 block">Total Tamu</span>
                    <div class="font-serif text-base font-bold text-charcoal-950">{{ $totalGuests }} <span class="text-[11px] font-sans text-sand-400 font-normal">Tamu</span></div>
                </div>
                <div class="w-6 h-6 rounded-lg bg-sand-100 text-charcoal-900 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="users" class="w-3.5 h-3.5"></i>
                </div>
            </div>

            <div class="p-2 sm:p-2.5 rounded-xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-emerald-700 block">Hadir</span>
                    <div class="font-serif text-base font-bold text-emerald-600">{{ $totalAttending }} <span class="text-[11px] font-sans text-emerald-500 font-normal">Tamu</span></div>
                </div>
                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                </div>
            </div>

            <div class="p-2 sm:p-2.5 rounded-xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-rose-700 block">Berhalangan</span>
                    <div class="font-serif text-base font-bold text-rose-600">{{ $totalDeclined }} <span class="text-[11px] font-sans text-rose-400 font-normal">Tamu</span></div>
                </div>
                <div class="w-6 h-6 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="x-circle" class="w-3.5 h-3.5"></i>
                </div>
            </div>

            <div class="p-2 sm:p-2.5 rounded-xl glass-panel border border-sand-200/80 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-amber-700 block">Menunggu</span>
                    <div class="font-serif text-base font-bold text-amber-600">{{ $totalPending }} <span class="text-[11px] font-sans text-amber-500 font-normal">Tamu</span></div>
                </div>
                <div class="w-6 h-6 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                </div>
            </div>
        </div>

        <!-- COMPACT SEARCH & FILTERS TOOLBAR -->
        <div class="p-2 sm:p-2.5 rounded-2xl glass-panel border border-sand-200/80 shadow-sm">
            <form method="GET" action="{{ route('member.guests.index') }}" class="flex flex-col sm:flex-row items-center gap-2">
                <div class="relative w-full">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari nama tamu atau nomor WhatsApp..." 
                        class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-sand-200 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-xs bg-white placeholder-sand-400"
                    >
                    <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    </div>
                </div>

                <div class="w-full sm:w-auto flex items-center gap-2 shrink-0">
                    <select 
                        name="status" 
                        class="w-full sm:w-36 px-2.5 py-1.5 rounded-xl border border-sand-200 text-xs font-medium bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20"
                    >
                        <option value="all">Semua Status</option>
                        <option value="hadir" {{ request('status') === 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="tidak_hadir" {{ request('status') === 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>

                    <button type="submit" class="px-4 py-2 rounded-xl bg-charcoal-900 text-white font-bold text-xs hover:bg-charcoal-800 transition shrink-0">
                        Filter
                    </button>
                    @if(request('search') || (request('status') && request('status') !== 'all'))
                        <a href="{{ route('member.guests.index') }}" class="px-3 py-2 rounded-xl bg-sand-100 text-sand-600 hover:text-charcoal-900 text-xs font-semibold transition shrink-0">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- GUESTS TABLE -->
        <div class="rounded-3xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-sand-50/80 border-b border-sand-200/80 text-sand-600 font-bold uppercase tracking-wider text-[10px]">
                        <tr>
                            <th class="p-4 pl-6">Nama Tamu &amp; Kategori</th>
                            <th class="p-4">No. WhatsApp</th>
                            <th class="p-4">Pax</th>
                            <th class="p-4">Status Kehadiran</th>
                            <th class="p-4 text-right pr-6">Aksi &amp; Kirim WA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sand-200/60 font-medium text-charcoal-900">
                        @forelse($guests as $guest)
                            @php
                                $invitationSlug = $guest->invitation->slug ?? 'demo';
                                $personalLink = route('invitation.show', $invitationSlug) . '?to=' . urlencode($guest->name);
                                $waText = $guest->invitation 
                                    ? $guest->invitation->formatWhatsappMessage($guest->name, $personalLink)
                                    : "Halo {$guest->name}! Kami mengundang Anda ke pernikahan kami: {$personalLink} . Terima kasih!";
                                $waUrl = whatsapp_url($guest->phone, $waText);
                            @endphp
                            <tr class="hover:bg-amber-50/30 transition">
                                <td class="p-4 pl-6">
                                    <div class="font-bold text-charcoal-950 font-serif text-sm">{{ $guest->name }}</div>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-sand-200 text-charcoal-800 text-[10px] font-bold">
                                            {{ $guest->category ?? 'Umum' }}
                                        </span>
                                        @if($guest->invitation)
                                            <span class="text-[10px] text-sand-500">
                                                • {{ $guest->invitation->title }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 font-mono text-sand-700">
                                    {{ $guest->phone ?: '-' }}
                                </td>
                                <td class="p-4">
                                    <span class="px-2 py-0.5 rounded-full bg-sand-100 text-charcoal-900 font-bold text-[11px]">
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
                                        <!-- WhatsApp Direct Share -->
                                        @if($guest->phone)
                                            <a 
                                                href="{{ $waUrl }}" 
                                                target="_blank"
                                                class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] transition inline-flex items-center gap-1 shadow-sm"
                                                title="Kirim Pesan WhatsApp"
                                            >
                                                <i data-lucide="send" class="w-3 h-3"></i>
                                                <span>Kirim WA</span>
                                            </a>
                                        @endif

                                        <!-- Copy Personal Link -->
                                        <button 
                                            type="button" 
                                            @click="copyLink('{{ $personalLink }}')"
                                            class="p-1.5 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-800 transition"
                                            title="Salin Link Personal Tamu"
                                        >
                                            <i data-lucide="copy" class="w-4 h-4"></i>
                                        </button>

                                        <!-- Delete Guest -->
                                        <form method="POST" action="{{ route('member.guests.destroy', $guest) }}" onsubmit="return confirm('Hapus tamu ini dari daftar undangan?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="p-1.5 rounded-xl text-sand-400 hover:text-rose-600 hover:bg-rose-50 transition"
                                                title="Hapus Tamu"
                                            >
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-sand-500">
                                    <div class="w-12 h-12 rounded-full bg-sand-100 text-sand-400 mx-auto flex items-center justify-center mb-3">
                                        <i data-lucide="users" class="w-6 h-6"></i>
                                    </div>
                                    <p class="font-serif font-bold text-charcoal-900 text-sm">Belum Ada Data Tamu</p>
                                    <p class="text-xs text-sand-500 mt-1">Tambahkan tamu pertama Anda untuk mulai menyebarkan undangan digital.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-sand-200/80">
                {{ $guests->links() }}
            </div>
        </div>

        <!-- ADD GUEST MODAL -->
        @if($primaryInvitation)
            <div 
                x-show="addModal" 
                x-transition 
                class="fixed inset-0 z-50 overflow-y-auto bg-charcoal-950/60 backdrop-blur-sm flex items-center justify-center p-4"
                style="display: none;"
            >
                <div 
                    @click.away="addModal = false"
                    class="bg-white rounded-3xl border border-sand-200 max-w-md w-full p-6 sm:p-8 space-y-6 shadow-2xl"
                >
                    <div class="flex items-center justify-between pb-3 border-b border-sand-100">
                        <h3 class="font-serif text-lg font-bold text-charcoal-950">Tambah Tamu Undangan Baru</h3>
                        <button @click="addModal = false" class="p-1 rounded-xl text-sand-400 hover:text-charcoal-950 transition">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('member.guests.store') }}" class="space-y-4 text-xs">
                        @csrf

                        <!-- INVITATION SELECTOR -->
                        @if($invitations->count() > 1)
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Pilih Undangan</label>
                                <select name="invitation_id" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white font-medium">
                                    @foreach($invitations as $inv)
                                        <option value="{{ $inv->id }}">{{ $inv->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="invitation_id" value="{{ $primaryInvitation->id }}">
                        @endif

                        <!-- GUEST NAME -->
                        <div>
                            <label class="font-bold text-charcoal-900 block mb-1">Nama Tamu / Keluarga <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="name" 
                                required
                                placeholder="Contoh: Budi Santoso & Partner"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white focus:ring-2 focus:ring-amber-500"
                            >
                        </div>

                        <!-- WHATSAPP NUMBER -->
                        <div>
                            <label class="font-bold text-charcoal-900 block mb-1">Nomor WhatsApp (Opsional)</label>
                            <input 
                                type="text" 
                                name="phone" 
                                placeholder="Contoh: 081234567890"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white focus:ring-2 focus:ring-amber-500"
                            >
                            <span class="text-[10px] text-sand-500 mt-1 block">Diperlukan jika ingin langsung mengirim link via WhatsApp 1-klik.</span>
                        </div>

                        <!-- CATEGORY & PAX -->
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Kategori / Grup</label>
                                <input 
                                    type="text" 
                                    name="category" 
                                    value="Umum" 
                                    placeholder="VIP / Teman / Keluarga"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white"
                                >
                            </div>
                            <div>
                                <label class="font-bold text-charcoal-900 block mb-1">Jumlah Pax Tamu</label>
                                <input 
                                    type="number" 
                                    name="pax" 
                                    value="1" 
                                    min="1" 
                                    max="10"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-white"
                                >
                            </div>
                        </div>

                        <div class="pt-4 flex items-center justify-end gap-3 border-t border-sand-100">
                            <button 
                                type="button" 
                                @click="addModal = false"
                                class="px-4 py-2.5 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-800 font-bold transition"
                            >
                                Batal
                            </button>
                            <button 
                                type="submit" 
                                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-600 to-brand-700 text-white font-bold transition shadow"
                            >
                                Simpan Tamu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

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
                @click.away="templateModal = false"
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

                <form method="POST" action="{{ route('member.guests.template') }}" class="space-y-4 text-xs">
                    @csrf

                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Pilih Undangan *</label>
                        <select 
                            name="invitation_id" 
                            x-model="templateInvId" 
                            @change="updateTemplateText()" 
                            required 
                            class="w-full px-4 py-2.5 rounded-2xl border border-sand-300 bg-white text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        >
                            @foreach($invitations as $inv)
                                <option value="{{ $inv->id }}">{{ $inv->title }}</option>
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

                    <!-- LIVE PREVIEW -->
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

    </div>
</x-member-layout>
