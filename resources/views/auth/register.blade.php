<x-guest-layout>
    <div class="space-y-6" x-data="{ showPassword: false, showPasswordConfirm: false }">
        
        <!-- HEADER -->
        <div class="space-y-2 text-left">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Pendaftaran Akun</span>
            <h2 class="font-serif text-3xl font-bold text-charcoal-950">
                Buat Akun Anda
            </h2>
            <p class="text-xs text-sand-600">
                Mulai buat dan bagikan undangan digital pernikahan elegan Anda dalam hitungan menit.
            </p>
        </div>

        <!-- ERROR ALERT -->
        @if ($errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
                <div class="flex items-center gap-2 font-bold">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 flex-shrink-0"></i>
                    <span>Mohon periksa data formulir:</span>
                </div>
                <ul class="list-disc list-inside pl-1 text-[11px] text-rose-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4 text-left">
            @csrf

            <!-- FULL NAME -->
            <div class="space-y-1.5">
                <label for="name" class="block text-xs font-bold text-charcoal-900">
                    Nama Lengkap
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="user" class="w-4 h-4"></i>
                    </div>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Contoh: Raka Pratama" 
                        class="w-full pl-10 pr-4 py-3 rounded-2xl border border-sand-200 bg-sand-50/50 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                    >
                </div>
            </div>

            <!-- EMAIL -->
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-bold text-charcoal-900">
                    Alamat Email Aktif
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
                        autocomplete="username"
                        placeholder="nama@email.com" 
                        class="w-full pl-10 pr-4 py-3 rounded-2xl border border-sand-200 bg-sand-50/50 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                    >
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="space-y-1.5">
                <label for="password" class="block text-xs font-bold text-charcoal-900">
                    Kata Sandi
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </div>
                    <input 
                        id="password" 
                        :type="showPassword ? 'text' : 'password'" 
                        name="password" 
                        required 
                        autocomplete="new-password"
                        placeholder="Minimal 8 karakter" 
                        class="w-full pl-10 pr-11 py-3 rounded-2xl border border-sand-200 bg-sand-50/50 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                    >
                    <button 
                        type="button" 
                        @click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-sand-400 hover:text-charcoal-950 transition"
                    >
                        <i data-lucide="eye" class="w-4 h-4" x-show="!showPassword"></i>
                        <i data-lucide="eye-off" class="w-4 h-4" x-show="showPassword" style="display: none;"></i>
                    </button>
                </div>
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="space-y-1.5">
                <label for="password_confirmation" class="block text-xs font-bold text-charcoal-900">
                    Konfirmasi Kata Sandi
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                    </div>
                    <input 
                        id="password_confirmation" 
                        :type="showPasswordConfirm ? 'text' : 'password'" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="Ketik ulang kata sandi" 
                        class="w-full pl-10 pr-11 py-3 rounded-2xl border border-sand-200 bg-sand-50/50 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                    >
                    <button 
                        type="button" 
                        @click="showPasswordConfirm = !showPasswordConfirm"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-sand-400 hover:text-charcoal-950 transition"
                    >
                        <i data-lucide="eye" class="w-4 h-4" x-show="!showPasswordConfirm"></i>
                        <i data-lucide="eye-off" class="w-4 h-4" x-show="showPasswordConfirm" style="display: none;"></i>
                    </button>
                </div>
            </div>

            <!-- TERMS -->
            <p class="text-[11px] text-sand-500 leading-relaxed pt-1">
                Dengan mendaftar, Anda menyetujui 
                <a href="#" class="font-semibold text-brand-600 hover:underline">Syarat & Ketentuan</a> serta 
                <a href="#" class="font-semibold text-brand-600 hover:underline">Kebijakan Privasi</a> KlikMomen.
            </p>

            <!-- SUBMIT BUTTON -->
            <button 
                type="submit" 
                class="w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs shadow-lg hover:shadow-brand-500/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2 pt-3"
            >
                <span>Daftar & Buat Undangan</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

        <!-- OAUTH SEPARATOR -->
        <div class="relative flex items-center justify-center my-4">
            <div class="border-t border-sand-200 w-full"></div>
            <span class="bg-white/90 px-3 text-[10px] font-bold text-sand-400 uppercase tracking-widest absolute">
                atau daftar cepat dengan
            </span>
        </div>

        <!-- GOOGLE OAUTH BUTTON -->
        <div>
            <a 
                href="{{ route('auth.google.redirect') }}" 
                class="w-full py-3 px-5 rounded-2xl border border-sand-200 bg-white hover:bg-sand-50/80 text-charcoal-800 font-bold text-xs shadow-sm hover:shadow hover:border-sand-300 active:scale-[0.99] transition-all flex items-center justify-center gap-3 group"
            >
                <svg class="w-4 h-4 transition-transform group-hover:scale-110 flex-shrink-0" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                <span>Daftar dengan Akun Google</span>
            </a>
        </div>

        <!-- FOOTER LOGIN REDIRECT -->
        <div class="pt-4 border-t border-sand-200 text-center space-y-2">
            <p class="text-xs text-sand-600">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-bold text-brand-600 hover:text-brand-800 transition underline underline-offset-4">
                    Masuk ke Akun Anda
                </a>
            </p>
        </div>

    </div>
</x-guest-layout>
