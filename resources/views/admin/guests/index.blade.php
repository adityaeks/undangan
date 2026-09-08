<x-app-layout>
    <div class="space-y-8" x-data="{ 
        modalOpen: false, 
        toast: { show: false, message: '' }, 
        showToast(msg) { this.toast.message = msg; this.toast.show = true; setTimeout(() => this.toast.show = false, 3000); },
        copyLink(name) {
            const url = '{{ url('/demo') }}?to=' + encodeURIComponent(name);
            navigator.clipboard.writeText(url);
            this.showToast('Link personal untuk ' + name + ' berhasil disalin!');
        },
        openWhatsApp(phone, name) {
            const link = '{{ url('/demo') }}?to=' + encodeURIComponent(name);
            const text = 'Kepada Yth. ' + name + ',\n\nTanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk menghadiri acara pernikahan kami.\n\nBuka Undangan:\n' + link + '\n\nMerupakan suatu kehormatan dan kebahagiaan bagi kami apabila berkenan hadir.\n\nTerima kasih.';
            const cleanPhone = phone ? phone.replace(/[^0-9]/g, '') : '';
            const waUrl = 'https://api.whatsapp.com/send?phone=' + (cleanPhone.startsWith('0') ? '62' + cleanPhone.slice(1) : cleanPhone) + '&text=' + encodeURIComponent(text);
            window.open(waUrl, '_blank');
        }
    }">
        
        <!-- TOAST NOTIFICATION -->
        <div 
            x-show="toast.show" 
            x-transition 
            class="fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl bg-charcoal-950 text-white text-xs font-bold shadow-2xl flex items-center gap-2 border border-brand-500/40"
            style="display: none;"
        >
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
            <span x-text="toast.message"></span>
        </div>

        <!-- PAGE HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">
                    <span>Manajemen Tamu</span>
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                    Daftar Tamu & Sebar WhatsApp
                </h1>
                <p class="text-xs text-sand-600">
                    Kelola nama tamu undangan khusus, pantau konfirmasi kehadiran (RSVP), dan kirim undangan personal 1-klik via WhatsApp.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <button 
                    @click="modalOpen = true" 
                    type="button" 
                    class="px-5 py-3 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs shadow-lg hover:shadow-brand-500/20 hover:scale-105 transition flex items-center gap-2"
                >
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    <span>+ Tambah Tamu Baru</span>
                </button>
            </div>
        </div>

        <!-- STATS PILLS -->
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div class="p-5 rounded-2xl glass-panel border border-sand-200 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Total Tamu</span>
                    <div class="font-serif text-2xl font-bold text-charcoal-950">{{ $totalGuests }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-sand-100 text-charcoal-900 flex items-center justify-center font-bold text-sm">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="p-5 rounded-2xl glass-panel border border-sand-200 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Konfirmasi Hadir</span>
                    <div class="font-serif text-2xl font-bold text-emerald-600">{{ $totalAttending }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-sm">
                    <i data-lucide="user-check" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="p-5 rounded-2xl glass-panel border border-sand-200 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Belum Konfirmasi</span>
                    <div class="font-serif text-2xl font-bold text-amber-600">{{ $totalPending }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-sm">
                    <i data-lucide="clock" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="p-5 rounded-2xl glass-panel border border-sand-200 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500">Berhalangan Hadir</span>
                    <div class="font-serif text-2xl font-bold text-rose-600">{{ $totalDeclined }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center font-bold text-sm">
                    <i data-lucide="user-x" class="w-5 h-5"></i>
                </div>
            </div>
        </div>

        <!-- SEARCH & FILTER BAR -->
        <div class="p-4 rounded-2xl glass-panel border border-sand-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <form method="GET" action="{{ route('guests.index') }}" class="flex-1 w-full flex flex-col sm:flex-row items-center gap-3">
                <div class="relative w-full sm:max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari nama tamu atau no. WhatsApp..." 
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-sand-200 bg-sand-50/70 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                    >
                </div>

                <select 
                    name="status" 
                    onchange="this.form.submit()" 
                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-sand-200 bg-sand-50/70 text-xs text-charcoal-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500"
                >
                    <option value="all">Semua Status RSVP</option>
                    <option value="hadir" {{ request('status') === 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Belum Konfirmasi</option>
                    <option value="tidak_hadir" {{ request('status') === 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                </select>

                <select 
                    name="group" 
                    onchange="this.form.submit()" 
                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-sand-200 bg-sand-50/70 text-xs text-charcoal-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500"
                >
                    <option value="all">Semua Kategori Grup</option>
                    <option value="VIP" {{ request('group') === 'VIP' ? 'selected' : '' }}>VIP</option>
                    <option value="Keluarga" {{ request('group') === 'Keluarga' ? 'selected' : '' }}>Keluarga</option>
                    <option value="Teman Kantor" {{ request('group') === 'Teman Kantor' ? 'selected' : '' }}>Teman Kantor</option>
                    <option value="Reguler" {{ request('group') === 'Reguler' ? 'selected' : '' }}>Reguler</option>
                </select>

                <button type="submit" class="px-4 py-2.5 rounded-xl bg-charcoal-950 text-white text-xs font-bold hover:bg-brand-600 transition">
                    Filter
                </button>
            </form>
        </div>

        <!-- GUEST TABLE -->
        <div class="rounded-3xl overflow-hidden glass-panel border border-sand-200 shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-charcoal-900">
                    <thead class="bg-sand-200/70 uppercase text-[10px] tracking-wider text-sand-700 font-bold border-b border-sand-300">
                        <tr>
                            <th class="py-4 px-6">Nama Tamu</th>
                            <th class="py-4 px-6">Kategori Grup</th>
                            <th class="py-4 px-6">No. WhatsApp</th>
                            <th class="py-4 px-6 text-center">Status RSVP</th>
                            <th class="py-4 px-6 text-center">Pax Hadir</th>
                            <th class="py-4 px-6 text-right">Aksi & Kirim WA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sand-200/60">
                        @forelse ($guests as $guest)
                            <tr class="hover:bg-sand-50/80 transition">
                                <td class="py-4 px-6">
                                    <div class="font-serif text-sm font-bold text-charcoal-950">{{ $guest->name }}</div>
                                    <span class="text-[10px] text-sand-500 font-mono">/demo?to={{ urlencode($guest->name) }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-2.5 py-1 rounded-full bg-sand-200 text-charcoal-900 text-[10px] font-bold">
                                        {{ $guest->group }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-sand-600 font-mono">
                                    {{ $guest->phone_number ?? '-' }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if ($guest->attendance_status === 'hadir')
                                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">Hadir</span>
                                    @elseif ($guest->attendance_status === 'tidak_hadir')
                                        <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-800 text-[10px] font-bold">Tidak Hadir</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold">Pending</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center font-bold text-charcoal-950">
                                    {{ $guest->pax_confirmed }} Org
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- COPY LINK -->
                                        <button 
                                            type="button" 
                                            @click="copyLink('{{ $guest->name }}')"
                                            class="p-2 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 transition"
                                            title="Salin Link Undangan"
                                        >
                                            <i data-lucide="copy" class="w-4 h-4"></i>
                                        </button>

                                        <!-- PREVIEW -->
                                        <a 
                                            href="{{ route('demo.index', ['to' => $guest->name]) }}" 
                                            target="_blank" 
                                            class="p-2 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 transition"
                                            title="Buka Undangan Tamu Ini"
                                        >
                                            <i data-lucide="external-link" class="w-4 h-4"></i>
                                        </a>

                                        <!-- SEND WHATSAPP -->
                                        <button 
                                            type="button" 
                                            @click="openWhatsApp('{{ $guest->phone_number }}', '{{ $guest->name }}')"
                                            class="px-3 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition flex items-center gap-1.5 shadow"
                                            title="Kirim Pesan WhatsApp"
                                        >
                                            <i data-lucide="send" class="w-3.5 h-3.5"></i>
                                            <span>Kirim WA</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-sand-500">
                                    Belum ada data tamu. Klik <strong>+ Tambah Tamu Baru</strong> untuk memasukkan daftar penerima undangan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="p-4 border-t border-sand-200">
                {{ $guests->links() }}
            </div>
        </div>

        <!-- MODAL TAMBAH TAMU -->
        <div 
            x-show="modalOpen" 
            x-transition 
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-charcoal-950/70 backdrop-blur-sm"
            style="display: none;"
        >
            <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 space-y-6 shadow-2xl border border-sand-200">
                <div class="flex items-center justify-between">
                    <h3 class="font-serif text-xl font-bold text-charcoal-950">+ Tambah Tamu Baru</h3>
                    <button @click="modalOpen = false" class="p-1 rounded-lg text-sand-400 hover:text-charcoal-950">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <div class="space-y-4 text-xs">
                    <div>
                        <label class="font-bold text-charcoal-900 block mb-1">Nama Tamu Undangan</label>
                        <input type="text" placeholder="Contoh: Bpk. Dr. H. Ahmad Dahlan & Istri" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-sand-50">
                    </div>
                    <div>
                        <label class="font-bold text-charcoal-900 block mb-1">Nomor WhatsApp (Opsional)</label>
                        <input type="text" placeholder="Contoh: 081234567890" class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-sand-50">
                    </div>
                    <div>
                        <label class="font-bold text-charcoal-900 block mb-1">Kategori Grup</label>
                        <select class="w-full px-3.5 py-2.5 rounded-xl border border-sand-200 bg-sand-50">
                            <option value="VIP">VIP</option>
                            <option value="Keluarga">Keluarga</option>
                            <option value="Teman Kantor">Teman Kantor</option>
                            <option value="Reguler" selected>Reguler</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button @click="modalOpen = false" class="px-4 py-2.5 rounded-xl bg-sand-200 text-charcoal-900 font-bold text-xs">Batal</button>
                    <button @click="modalOpen = false; showToast('Data tamu berhasil ditambahkan!');" class="px-5 py-2.5 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white font-bold text-xs transition">Simpan Tamu</button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
