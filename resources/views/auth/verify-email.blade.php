<x-guest-layout>
    <div class="space-y-6">
        
        <!-- HEADER -->
        <div class="space-y-2 text-left">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Verifikasi Akun</span>
            <h2 class="font-serif text-3xl font-bold text-charcoal-950">
                Verifikasi Email Anda
            </h2>
            <p class="text-xs text-sand-600 leading-relaxed">
                Terima kasih telah mendaftar di KlikMomen! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan ke kotak masuk Anda.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 flex-shrink-0"></i>
                <span>Tautan verifikasi baru telah dikirimkan ke alamat email Anda.</span>
            </div>
        @endif

        <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-4">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf
                <button 
                    type="submit" 
                    class="w-full sm:w-auto py-3 px-6 rounded-2xl bg-brand-500 hover:bg-brand-600 text-white font-bold text-xs shadow transition flex items-center justify-center gap-2"
                >
                    <i data-lucide="mail" class="w-4 h-4"></i>
                    <span>Kirim Ulang Email Verifikasi</span>
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs font-semibold text-sand-600 hover:text-rose-600 transition flex items-center gap-1.5">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

    </div>
</x-guest-layout>
