<section class="space-y-6" x-data="{ showCurrent: false, showNew: false, showConfirm: false }">
    <header class="space-y-1">
        <h2 class="font-serif text-xl font-bold text-charcoal-950 flex items-center gap-2">
            <i data-lucide="shield-check" class="w-5 h-5 text-brand-600"></i>
            <span>Keamanan &amp; Kata Sandi</span>
        </h2>
        <p class="text-xs text-sand-600">
            Pastikan akun Anda menggunakan kata sandi yang kuat dan unik agar tetap aman.
        </p>
    </header>

    @if (is_null($user->password))
        <div class="p-4 rounded-2xl bg-brand-50 border border-brand-200 text-xs text-brand-900 flex items-start gap-3">
            <i data-lucide="info" class="w-4 h-4 text-brand-600 flex-shrink-0 mt-0.5"></i>
            <div>
                <span class="font-bold block">Masuk Menggunakan Akun Google</span>
                <span class="text-brand-800">
                    Akun Anda terhubung langsung dengan Google. Anda dapat membuat kata sandi baru di bawah ini jika ingin memiliki opsi masuk menggunakan email &amp; kata sandi biasa.
                </span>
            </div>
        </div>
    @endif

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        @if (! is_null($user->password))
            <!-- KATA SANDI SAAT INI -->
            <div class="space-y-1.5">
                <label for="update_password_current_password" class="block text-xs font-bold text-charcoal-900">
                    Kata Sandi Saat Ini
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </div>
                    <input 
                        id="update_password_current_password" 
                        name="current_password" 
                        :type="showCurrent ? 'text' : 'password'" 
                        autocomplete="current-password"
                        placeholder="••••••••" 
                        class="w-full pl-10 pr-11 py-3 rounded-2xl border border-sand-200 bg-sand-50/50 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                    >
                    <button 
                        type="button" 
                        @click="showCurrent = !showCurrent"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-sand-400 hover:text-charcoal-950 transition"
                    >
                        <i data-lucide="eye" class="w-4 h-4" x-show="!showCurrent"></i>
                        <i data-lucide="eye-off" class="w-4 h-4" x-show="showCurrent" style="display: none;"></i>
                    </button>
                </div>
                @if ($errors->updatePassword->has('current_password'))
                    <p class="text-[11px] text-rose-600 font-semibold mt-1 flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                        <span>{{ $errors->updatePassword->first('current_password') }}</span>
                    </p>
                @endif
            </div>
        @endif

        <!-- KATA SANDI BARU -->
        <div class="space-y-1.5">
            <label for="update_password_password" class="block text-xs font-bold text-charcoal-900">
                Kata Sandi Baru
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                    <i data-lucide="key" class="w-4 h-4"></i>
                </div>
                <input 
                    id="update_password_password" 
                    name="password" 
                    :type="showNew ? 'text' : 'password'" 
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter" 
                    class="w-full pl-10 pr-11 py-3 rounded-2xl border border-sand-200 bg-sand-50/50 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                >
                <button 
                    type="button" 
                    @click="showNew = !showNew"
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-sand-400 hover:text-charcoal-950 transition"
                >
                    <i data-lucide="eye" class="w-4 h-4" x-show="!showNew"></i>
                    <i data-lucide="eye-off" class="w-4 h-4" x-show="showNew" style="display: none;"></i>
                </button>
            </div>
            @if ($errors->updatePassword->has('password'))
                <p class="text-[11px] text-rose-600 font-semibold mt-1 flex items-center gap-1">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    <span>{{ $errors->updatePassword->first('password') }}</span>
                </p>
            @endif
        </div>

        <!-- KONFIRMASI KATA SANDI BARU -->
        <div class="space-y-1.5">
            <label for="update_password_password_confirmation" class="block text-xs font-bold text-charcoal-900">
                Konfirmasi Kata Sandi Baru
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                </div>
                <input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    :type="showConfirm ? 'text' : 'password'" 
                    autocomplete="new-password"
                    placeholder="Ketik ulang kata sandi baru" 
                    class="w-full pl-10 pr-11 py-3 rounded-2xl border border-sand-200 bg-sand-50/50 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                >
                <button 
                    type="button" 
                    @click="showConfirm = !showConfirm"
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-sand-400 hover:text-charcoal-950 transition"
                >
                    <i data-lucide="eye" class="w-4 h-4" x-show="!showConfirm"></i>
                    <i data-lucide="eye-off" class="w-4 h-4" x-show="showConfirm" style="display: none;"></i>
                </button>
            </div>
            @if ($errors->updatePassword->has('password_confirmation'))
                <p class="text-[11px] text-rose-600 font-semibold mt-1 flex items-center gap-1">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    <span>{{ $errors->updatePassword->first('password_confirmation') }}</span>
                </p>
            @endif
        </div>

        <!-- SUBMIT BUTTON & STATUS -->
        <div class="flex items-center gap-3 pt-2">
            <button 
                type="submit" 
                class="px-6 py-3 rounded-2xl bg-charcoal-950 hover:bg-charcoal-900 text-white font-bold text-xs shadow-md active:scale-[0.98] transition flex items-center gap-2"
            >
                <i data-lucide="lock" class="w-4 h-4 text-brand-400"></i>
                <span>Perbarui Kata Sandi</span>
            </button>

            @if (session('status') === 'password-updated')
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition 
                    x-init="setTimeout(() => show = false, 3500)" 
                    class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-3.5 py-2 rounded-xl border border-emerald-200 flex items-center gap-1.5"
                >
                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                    <span>Kata sandi berhasil diperbarui!</span>
                </div>
            @endif
        </div>
    </form>
</section>
