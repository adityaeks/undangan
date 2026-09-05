<x-app-layout>
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <a href="{{ route('partner.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-sand-600 hover:text-charcoal-900 transition mb-1">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali ke Dashboard Partner
                </a>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">Kelola Klien WO</h1>
                <p class="text-xs text-sand-500">Daftar calon pengantin & klien yang menggunakan jasa undangan digital Anda.</p>
            </div>
            <div>
                <button type="button" onclick="document.getElementById('addClientModal').classList.remove('hidden')" class="px-5 py-2.5 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-700 text-white font-bold text-xs shadow-md transition flex items-center gap-2">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    <span>Tambah Klien Baru</span>
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 flex-shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Clients Table -->
        <div class="rounded-3xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-sand-100/70 border-b border-sand-200 text-sand-600 font-bold uppercase text-[10px] tracking-wider">
                        <tr>
                            <th class="py-3 px-4">Nama Klien</th>
                            <th class="py-3 px-4">Kontak (HP / WA)</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4 text-center">Undangan Dibuat</th>
                            <th class="py-3 px-4">Catatan</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sand-200/60 text-charcoal-900">
                        @forelse($clients as $client)
                            <tr class="hover:bg-sand-50/60 transition">
                                <td class="py-3.5 px-4 font-bold text-charcoal-950">{{ $client->name }}</td>
                                <td class="py-3.5 px-4">{{ $client->phone ?? '-' }}</td>
                                <td class="py-3.5 px-4">{{ $client->email ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900 font-bold text-[10px]">
                                        {{ $client->invitations_count }} Undangan
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-sand-500 max-w-xs truncate">{{ $client->notes ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-right space-x-2">
                                    <form action="{{ route('partner.clients.destroy', $client) }}" method="POST" class="inline" onsubmit="return confirm('Hapus klien ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-sand-400">
                                    Belum ada data klien. Klik tombol "Tambah Klien Baru" di atas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($clients->hasPages())
                <div class="p-4 border-t border-sand-200">
                    {{ $clients->links() }}
                </div>
            @endif
        </div>

        <!-- Add Client Modal -->
        <div id="addClientModal" class="fixed inset-0 z-50 bg-charcoal-950/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-serif text-lg font-bold text-charcoal-950">Tambah Klien Baru</h3>
                    <button type="button" onclick="document.getElementById('addClientModal').classList.add('hidden')" class="text-sand-400 hover:text-charcoal-900 text-xl font-bold">&times;</button>
                </div>

                <form action="{{ route('partner.clients.store') }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Nama Klien / Mempelai *</label>
                        <input type="text" name="name" required class="w-full rounded-2xl border-sand-300 focus:border-amber-500 focus:ring-amber-500 text-xs" placeholder="Contoh: Rian & Anisa">
                    </div>
                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Nomor WhatsApp / HP</label>
                        <input type="text" name="phone" class="w-full rounded-2xl border-sand-300 focus:border-amber-500 focus:ring-amber-500 text-xs" placeholder="0812xxxxxxx">
                    </div>
                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Email</label>
                        <input type="email" name="email" class="w-full rounded-2xl border-sand-300 focus:border-amber-500 focus:ring-amber-500 text-xs" placeholder="email@klien.com">
                    </div>
                    <div>
                        <label class="block font-bold text-charcoal-950 mb-1">Catatan Tambahan</label>
                        <textarea name="notes" rows="2" class="w-full rounded-2xl border-sand-300 focus:border-amber-500 focus:ring-amber-500 text-xs" placeholder="Paket resepsi, venue gedung, etc."></textarea>
                    </div>
                    <div class="pt-2 flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('addClientModal').classList.add('hidden')" class="px-4 py-2.5 rounded-2xl bg-sand-100 hover:bg-sand-200 text-charcoal-900 font-bold">Batal</button>
                        <button type="submit" class="px-5 py-2.5 rounded-2xl bg-amber-600 hover:bg-amber-700 text-white font-bold">Simpan Klien</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
