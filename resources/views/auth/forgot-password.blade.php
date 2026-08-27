<x-guest-layout>
    <div class="space-y-6">
        
        <!-- HEADER -->
        <div class="space-y-2 text-left">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Pemulihan Akun</span>
            <h2 class="font-serif text-3xl font-bold text-charcoal-950">
                Lupa Kata Sandi?
            </h2>
            <p class="text-xs text-sand-600 leading-relaxed">
                Jangan khawatir. Masukkan alamat email Anda yang terdaftar, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi baru.
            </p>
        </div>

        <!-- SESSION STATUS -->
        @if (session('status'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 flex-shrink-0"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <!-- ERROR ALERT -->
        @if ($errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
                <div class="flex items-center gap-2 font-bold">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 flex-shrink-0"></i>
                    <span>Terdapat kendala:</span>
                </div>
                <ul class="list-disc list-inside pl-1 text-[11px] text-rose-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-4 text-left">
            @csrf

            <!-- EMAIL -->
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-bold text-charcoal-900">
                    Alamat Email Terdaftar
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </div>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        placeholder="nama@email.com" 
                        class="w-full pl-10 pr-4 py-3 rounded-2xl border border-sand-200 bg-sand-50/50 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                    >
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <button 
                type="submit" 
                class="w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs shadow-lg hover:shadow-brand-500/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2"
            >
                <i data-lucide="send" class="w-4 h-4"></i>
                <span>Kirim Link Reset Sandi</span>
            </button>
        </form>

        <!-- BACK TO LOGIN -->
        <div class="pt-4 border-t border-sand-200 text-center">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-600 hover:text-brand-800 transition">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Halaman Masuk</span>
            </a>
        </div>

    </div>
</x-guest-layout>
