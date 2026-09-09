<section class="space-y-6">
    <header class="space-y-1">
        <h2 class="font-serif text-xl font-bold text-charcoal-950 flex items-center gap-2">
            <i data-lucide="user" class="w-5 h-5 text-brand-600"></i>
            <span>Informasi Akun</span>
        </h2>
        <p class="text-xs text-sand-600">
            Perbarui nama lengkap dan alamat email utama akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <!-- NAMA LENGKAP -->
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
                    name="name" 
                    type="text" 
                    value="{{ old('name', $user->name) }}" 
                    required 
                    autofocus 
                    autocomplete="name"
                    placeholder="Nama lengkap Anda" 
                    class="w-full pl-10 pr-4 py-3 rounded-2xl border border-sand-200 bg-sand-50/50 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                >
            </div>
            @if ($errors->has('name'))
                <p class="text-[11px] text-rose-600 font-semibold mt-1 flex items-center gap-1">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    <span>{{ $errors->first('name') }}</span>
                </p>
            @endif
        </div>

        <!-- ALAMAT EMAIL -->
        <div class="space-y-1.5">
            <label for="email" class="block text-xs font-bold text-charcoal-900">
                Alamat Email
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sand-400">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                </div>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    value="{{ old('email', $user->email) }}" 
                    required 
                    autocomplete="username"
                    placeholder="nama@email.com" 
                    class="w-full pl-10 pr-4 py-3 rounded-2xl border border-sand-200 bg-sand-50/50 text-xs text-charcoal-950 placeholder:text-sand-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition"
                >
            </div>
            @if ($errors->has('email'))
                <p class="text-[11px] text-rose-600 font-semibold mt-1 flex items-center gap-1">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    <span>{{ $errors->first('email') }}</span>
                </p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="p-3.5 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900 flex flex-col sm:flex-row sm:items-center justify-between gap-2 mt-2">
                    <div class="flex items-center gap-2">
                        <i data-lucide="alert-triangle" class="w-4 h-4 text-amber-600 flex-shrink-0"></i>
                        <span>Alamat email Anda belum terverifikasi.</span>
                    </div>
                    <button form="send-verification" class="font-bold text-amber-800 underline hover:text-amber-950 text-left">
                        Kirim Ulang Link Verifikasi
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-xs text-emerald-600 flex items-center gap-1">
                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                        <span>Link verifikasi baru telah dikirimkan ke email Anda.</span>
                    </p>
                @endif
            @endif
        </div>

        <!-- SUBMIT BUTTON & STATUS -->
        <div class="flex items-center gap-3 pt-2">
            <button 
                type="submit" 
                class="px-6 py-3 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 hover:from-brand-500 hover:to-brand-600 text-white font-bold text-xs shadow-md hover:shadow-brand-500/20 active:scale-[0.98] transition flex items-center gap-2"
            >
                <i data-lucide="save" class="w-4 h-4"></i>
                <span>Simpan Perubahan</span>
            </button>

            @if (session('status') === 'profile-updated')
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition 
                    x-init="setTimeout(() => show = false, 3500)" 
                    class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-3.5 py-2 rounded-xl border border-emerald-200 flex items-center gap-1.5"
                >
                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                    <span>Profil berhasil diperbarui!</span>
                </div>
            @endif
        </div>
    </form>
</section>
