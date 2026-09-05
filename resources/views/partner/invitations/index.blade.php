<x-app-layout>
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <a href="{{ route('partner.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-sand-600 hover:text-charcoal-900 transition mb-1">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali ke Dashboard Partner
                </a>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">Undangan Klien Partner</h1>
                <p class="text-xs text-sand-500">Semua undangan digital yang dibuat dan dikelola atas nama klien Anda.</p>
            </div>
            <div>
                <a href="{{ route('invitations.create') }}" class="px-5 py-2.5 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-700 text-white font-bold text-xs shadow-md transition flex items-center gap-2">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Buat Undangan Baru</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 flex-shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($invitations as $invitation)
                <div class="rounded-3xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
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

                    <div class="bg-sand-50/80 p-4 border-t border-sand-200 flex items-center justify-between gap-2">
                        <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-charcoal-950 text-white text-xs font-bold hover:bg-amber-600 transition flex items-center gap-1.5">
                            <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                            <span>Lihat</span>
                        </a>
                        <span class="text-[11px] text-sand-500">Slug: /u/{{ $invitation->slug }}</span>
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
    </div>
</x-app-layout>
