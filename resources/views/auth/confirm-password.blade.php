<x-guest-layout>
    <div class="space-y-6" x-data="{ showPassword: false }">
        
        <!-- HEADER -->
        <div class="space-y-2 text-left">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Konfirmasi Akses</span>
            <h2 class="font-serif text-3xl font-bold text-charcoal-950">
                Area Keamanan
            </h2>
            <p class="text-xs text-sand-600">
                Ini adalah area sensitif aplikasi. Mohon konfirmasi kata sandi Anda sebelum melanjutkan.
            </p>
        </div>

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
        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4 text-left">
            @csrf

            <!-- PASSWORD -->
            <div class="space-y-1.5">
                <label for="password" class="block text-xs font-bold text-charcoal-900">
                    Kata Sandi Anda
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
                        autocomplete="current-password"
                        placeholder="••••••••" 
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

            <!-- SUBMIT BUTTON -->
            <button 
                type="submit" 
                class="w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 text-white font-bold text-xs shadow-lg hover:shadow-brand-500/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2 pt-3"
            >
                <span>Konfirmasi Kata Sandi</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

    </div>
</x-guest-layout>
