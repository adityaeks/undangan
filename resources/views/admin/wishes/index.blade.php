<x-app-layout>
    <div class="space-y-3 sm:space-y-3.5" x-data="{ toast: { show: false, message: '' }, showToast(msg) { this.toast.message = msg; this.toast.show = true; setTimeout(() => this.toast.show = false, 3000); } }">
        
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

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">Ucapan Doa & Respon Kehadiran</h1>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">Buku Tamu</span>
                </div>
                <p class="text-xs text-sand-600">
                    Pantau dan moderasi pesan ucapan selamat, doa restu, serta status RSVP dari para tamu undangan.
                </p>
            </div>

            <div class="flex items-center gap-1.5 text-xs font-bold text-charcoal-950 bg-sand-200/80 px-3 py-1.5 rounded-xl self-start sm:self-auto">
                <i data-lucide="message-square" class="w-3.5 h-3.5 text-brand-700"></i>
                <span>Total: {{ $totalWishes }} Pesan</span>
            </div>
        </div>

        <!-- STATS PILLS -->
        <div class="grid grid-cols-3 gap-2.5">
            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sand-500 block">Total Ucapan</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-charcoal-950">{{ $totalWishes }} <span class="text-xs font-sans text-sand-400 font-normal hidden sm:inline">Pesan</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-sand-100 text-charcoal-900 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="message-square" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block">Konfirmasi Hadir</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-emerald-600">{{ $totalAttending }} <span class="text-xs font-sans text-emerald-500 font-normal hidden sm:inline">Tamu</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700 block">Disembunyikan (Spam)</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-amber-600">{{ $totalHidden }} <span class="text-xs font-sans text-amber-500 font-normal hidden sm:inline">Spam</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="eye-off" class="w-4 h-4"></i>
                </div>
            </div>
        </div>

        <!-- SEARCH & FILTER BAR -->
        <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-2.5">
            <form method="GET" action="{{ route('wishes.index') }}" class="flex-1 w-full flex flex-col sm:flex-row items-center gap-2">
                <div class="relative w-full sm:max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari nama pengirim atau isi pesan..." 
                        class="w-full pl-9 pr-3 py-1.5 rounded-xl border border-sand-200 bg-white text-xs text-charcoal-950 placeholder:text-sand-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                    >
                </div>

                <select 
                    name="attendance" 
                    onchange="this.form.submit()" 
                    class="w-full sm:w-auto px-3 py-1.5 rounded-xl border border-sand-200 bg-white text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500"
                >
                    <option value="all">Semua Status Kehadiran</option>
                    <option value="Hadir" {{ request('attendance') === 'Hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="Ragu" {{ request('attendance') === 'Ragu' ? 'selected' : '' }}>Masih Ragu</option>
                    <option value="Tidak" {{ request('attendance') === 'Tidak' ? 'selected' : '' }}>Tidak Hadir</option>
                </select>

                <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-charcoal-950 text-white text-xs font-bold hover:bg-brand-600 transition">
                    Filter
                </button>
            </form>
        </div>

        <!-- WISHES CARDS LIST -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($wishes as $wish)
                <div class="p-6 rounded-3xl glass-panel border border-sand-200 shadow-sm space-y-3 flex flex-col justify-between hover:border-brand-300 transition">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-brand-100 text-brand-800 font-bold text-xs flex items-center justify-center">
                                    {{ strtoupper(substr($wish->guest_name, 0, 1)) }}
                                </div>
                                <span class="font-serif text-sm font-bold text-charcoal-950">{{ $wish->guest_name }}</span>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                {{ $wish->attendance }}
                            </span>
                        </div>

                        <p class="text-xs text-charcoal-900/80 leading-relaxed italic font-editorial text-sm bg-sand-50/70 p-3.5 rounded-2xl border border-sand-200/50">
                            "{{ $wish->message }}"
                        </p>
                    </div>

                    <div class="pt-3 border-t border-sand-200/60 flex items-center justify-between text-[11px] text-sand-500">
                        <span>{{ $wish->created_at->diffForHumans() }}</span>
                        <div class="flex items-center gap-2">
                            <button 
                                type="button" 
                                @click="showToast('Status pesan diperbarui!')"
                                class="px-3 py-1 rounded-xl bg-sand-100 hover:bg-sand-200 text-charcoal-800 text-[10px] font-bold transition"
                            >
                                {{ $wish->is_hidden ? 'Tampilkan' : 'Sembunyikan' }}
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2 p-12 rounded-3xl glass-panel border border-sand-200 text-center text-sand-500 text-xs">
                    Belum ada ucapan doa masuk dari tamu.
                </div>
            @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="pt-4">
            {{ $wishes->links() }}
        </div>

    </div>
</x-app-layout>
