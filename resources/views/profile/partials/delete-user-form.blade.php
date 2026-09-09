<section class="space-y-6">
    <header class="space-y-1">
        <h2 class="font-serif text-xl font-bold text-rose-950 flex items-center gap-2">
            <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-600"></i>
            <span>Zona Bahaya: Hapus Akun</span>
        </h2>
        <p class="text-xs text-sand-600">
            Setelah akun dihapus, seluruh data undangan, daftar tamu, dan pengaturan Anda akan dihapus secara permanen.
        </p>
    </header>

    <div class="p-4 rounded-2xl bg-rose-50/70 border border-rose-200 text-xs text-rose-900 space-y-3">
        <p class="leading-relaxed">
            Tindakan ini tidak dapat dibatalkan. Pastikan Anda telah mengunduh atau mencadangkan seluruh data penting yang ingin Anda simpan sebelum menghapus akun.
        </p>
        <div>
            <button
                type="button"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-sm hover:shadow transition flex items-center gap-2"
            >
                <i data-lucide="trash-2" class="w-4 h-4"></i>
                <span>Hapus Akun Permanen</span>
            </button>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8 space-y-5 text-left">
            @csrf
            @method('delete')

            <div class="space-y-2">
                <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center">
                    <i data-lucide="alert-octagon" class="w-6 h-6"></i>
                </div>
                <h2 class="font-serif text-xl font-bold text-charcoal-950">
                    Konfirmasi Hapus Akun
                </h2>
                <p class="text-xs text-sand-600 leading-relaxed">
                    Apakah Anda yakin ingin menghapus akun ini secara permanen? Masukkan kata sandi akun Anda untuk mengonfirmasi penghapusan.
                </p>
            </div>

            <div class="space-y-1.5">
                <label for="password" class="block text-xs font-bold text-charcoal-900">
                    Kata Sandi Konfirmasi
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Masukkan kata sandi Anda"
                    class="w-full px-4 py-3 rounded-2xl border border-sand-200 bg-sand-50/50 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition"
                />
                @if ($errors->userDeletion->has('password'))
                    <p class="text-[11px] text-rose-600 font-semibold mt-1 flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                        <span>{{ $errors->userDeletion->first('password') }}</span>
                    </p>
                @endif
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-sand-100">
                <button 
                    type="button" 
                    x-on:click="$dispatch('close')" 
                    class="px-5 py-2.5 rounded-xl border border-sand-200 hover:bg-sand-100 text-charcoal-800 font-bold text-xs transition"
                >
                    Batalkan
                </button>

                <button 
                    type="submit" 
                    class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow transition flex items-center gap-1.5"
                >
                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                    <span>Ya, Hapus Akun</span>
                </button>
            </div>
        </form>
    </x-modal>
</section>
