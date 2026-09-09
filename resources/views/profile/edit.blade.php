<x-app-layout>
    <div class="space-y-6 max-w-6xl pb-12" x-data="{ 
        activeTab: '{{ $errors->updatePassword->isNotEmpty() ? 'security' : ($errors->userDeletion->isNotEmpty() ? 'danger' : 'profile') }}',
        showCurrent: false,
        showNew: false,
        showConfirm: false,
        toast: { show: false, message: '' },
        showToast(msg) {
            this.toast.message = msg;
            this.toast.show = true;
            setTimeout(() => this.toast.show = false, 3500);
        }
    }">
        
        <!-- TOAST NOTIFICATION -->
        <div 
            x-show="toast.show" 
            x-transition 
            class="fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl bg-charcoal-950 text-white text-xs font-bold shadow-2xl flex items-center gap-2.5 border border-brand-500/40"
            style="display: none;"
        >
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
            <span x-text="toast.message"></span>
        </div>

        <!-- ============================================== -->
        <!-- 1. PAGE HEADER -->
        <!-- ============================================== -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-brand-500/10 text-brand-800 text-[10px] font-bold uppercase tracking-wider border border-brand-500/20">
                        <i data-lucide="user-cog" class="w-3 h-3 text-brand-600"></i>
                        <span>Pengaturan Akun</span>
                    </span>
                    <span class="text-xs text-sand-400">•</span>
                    <span class="text-xs text-sand-500">ID: #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950 tracking-tight">
                    Profil &amp; Keamanan Akun
                </h1>
                <p class="text-xs sm:text-sm text-sand-600">
                    Kelola informasi profil pribadi, integrasi akun, dan keamanan kata sandi Anda.
                </p>
            </div>

            <a href="{{ route('dashboard') }}" 
               class="px-4 py-2.5 rounded-2xl bg-white border border-sand-200 text-charcoal-800 hover:bg-sand-50 text-xs font-bold transition flex items-center gap-2 shadow-sm self-start sm:self-auto">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5 text-sand-500"></i>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>

        <!-- FLASH STATUS ALERTS -->
        @if (session('status') === 'profile-updated')
            <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center gap-2.5 shadow-sm">
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 flex-shrink-0"></i>
                <span class="font-semibold">Perubahan data profil Anda berhasil disimpan!</span>
            </div>
        @endif

        @if (session('status') === 'password-updated')
            <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center gap-2.5 shadow-sm">
                <i data-lucide="shield-check" class="w-4 h-4 text-emerald-600 flex-shrink-0"></i>
                <span class="font-semibold">Kata sandi akun Anda telah berhasil diperbarui!</span>
            </div>
        @endif

        <!-- ============================================== -->
        <!-- 2. MAIN 2-COLUMN SETTINGS STUDIO -->
        <!-- ============================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
            
            <!-- LEFT COLUMN (COL-4): PROFILE SUMMARY & NAVIGATION TABS -->
            <div class="lg:col-span-4 space-y-5">
                
                <!-- IDENTITY CARD -->
                <div class="p-6 rounded-3xl bg-white border border-sand-200 shadow-sm text-center space-y-4 relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-brand-500/10 rounded-full blur-2xl pointer-events-none"></div>

                    <!-- AVATAR PHOTO -->
                    <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" 
                                 class="w-full h-full rounded-3xl object-cover border-2 border-brand-400/50 shadow-md">
                        @else
                            <div class="w-full h-full rounded-3xl bg-gradient-to-br from-brand-400 via-brand-500 to-brand-700 text-white font-serif font-bold text-3xl flex items-center justify-center border-2 border-brand-400/40 shadow-md">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif

                        @if($user->google_id)
                            <div class="absolute -bottom-1.5 -right-1.5 w-7 h-7 rounded-full bg-white shadow-md border border-sand-200 flex items-center justify-center" title="Terhubung dengan Google">
                                <svg class="w-4 h-4" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- USER INFO -->
                    <div class="space-y-1">
                        <h2 class="font-serif text-lg font-bold text-charcoal-950">
                            {{ $user->name }}
                        </h2>
                        <p class="text-xs text-sand-600 truncate max-w-[240px] mx-auto">
                            {{ $user->email }}
                        </p>
                        
                        <div class="flex items-center justify-center gap-2 pt-1">
                            <span class="px-2.5 py-0.5 rounded-full bg-brand-50 text-brand-800 border border-brand-200 text-[10px] font-bold uppercase tracking-wider">
                                @if($user->isSuperAdmin())
                                    Super Admin
                                @elseif($user->isPartner())
                                    Mitra / Partner
                                @else
                                    Portal Pengantin
                                @endif
                            </span>
                            <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold">
                                ● Aktif
                            </span>
                        </div>
                    </div>

                    <!-- JOINED DATE -->
                    <div class="pt-3 border-t border-sand-100 text-[11px] text-sand-500">
                        Bergabung sejak <strong class="text-charcoal-900">{{ $user->created_at ? $user->created_at->isoFormat('D MMMM Y') : '2026' }}</strong>
                    </div>
                </div>

                <!-- NAVIGATION TABS LIST -->
                <div class="p-2 rounded-3xl bg-white border border-sand-200 shadow-sm space-y-1">
                    <button 
                        type="button" 
                        @click="activeTab = 'profile'; $nextTick(() => window.lucide && window.lucide.createIcons())"
                        :class="activeTab === 'profile' ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-charcoal-800 hover:bg-sand-50 text-sand-700'"
                        class="w-full px-4 py-3 rounded-2xl text-xs font-bold transition flex items-center justify-between gap-3 text-left"
                    >
                        <div class="flex items-center gap-3">
                            <i data-lucide="user" class="w-4 h-4"></i>
                            <span>Informasi Akun</span>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 opacity-70"></i>
                    </button>

                    <button 
                        type="button" 
                        @click="activeTab = 'security'; $nextTick(() => window.lucide && window.lucide.createIcons())"
                        :class="activeTab === 'security' ? 'bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md' : 'text-charcoal-800 hover:bg-sand-50 text-sand-700'"
                        class="w-full px-4 py-3 rounded-2xl text-xs font-bold transition flex items-center justify-between gap-3 text-left"
                    >
                        <div class="flex items-center gap-3">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                            <span>Keamanan &amp; Sandi</span>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 opacity-70"></i>
                    </button>

                    <button 
                        type="button" 
                        @click="activeTab = 'danger'; $nextTick(() => window.lucide && window.lucide.createIcons())"
                        :class="activeTab === 'danger' ? 'bg-rose-600 text-white shadow-md' : 'text-rose-700 hover:bg-rose-50'"
                        class="w-full px-4 py-3 rounded-2xl text-xs font-bold transition flex items-center justify-between gap-3 text-left"
                    >
                        <div class="flex items-center gap-3">
                            <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                            <span>Zona Hapus Akun</span>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 opacity-70"></i>
                    </button>
                </div>

                <!-- GOOGLE OAUTH SYNC INFO CARD -->
                <div class="p-5 rounded-3xl bg-sand-50/80 border border-sand-200/80 space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-charcoal-900 flex items-center gap-2">
                            <svg class="w-4 h-4" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                            </svg>
                            <span>Integrasi Google</span>
                        </span>
                        @if($user->google_id)
                            <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-full">
                                Terhubung
                            </span>
                        @else
                            <span class="text-[10px] font-bold text-sand-500 bg-sand-200 px-2 py-0.5 rounded-full">
                                Belum Terhubung
                            </span>
                        @endif
                    </div>
                    <p class="text-[11px] text-sand-600 leading-relaxed">
                        @if($user->google_id)
                            Akun Anda telah ditautkan dengan Google. Anda dapat masuk langsung dengan sekali klik.
                        @else
                            Tautkan akun dengan Google untuk kemudahan login sekali klik tanpa perlu mengetik kata sandi.
                        @endif
                    </p>
                    @if(!$user->google_id)
                        <a href="{{ route('auth.google.redirect') }}" 
                           class="inline-flex items-center gap-2 text-xs font-bold text-brand-700 hover:text-brand-800 transition pt-1">
                            <span>Hubungkan Sekarang</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    @endif
                </div>

            </div>

            <!-- RIGHT COLUMN (COL-8): DYNAMIC SETTINGS PANEL -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- ============================================== -->
                <!-- PANEL 1: INFORMASI PROFIL & EMAIL -->
                <!-- ============================================== -->
                <div x-show="activeTab === 'profile'" class="space-y-6">
                    <div class="p-6 sm:p-8 rounded-3xl bg-white border border-sand-200 shadow-sm space-y-6">
                        <div class="border-b border-sand-100 pb-4 space-y-1">
                            <h3 class="font-serif text-xl font-bold text-charcoal-950 flex items-center gap-2">
                                <i data-lucide="user" class="w-5 h-5 text-brand-600"></i>
                                <span>Informasi Profil Pengguna</span>
                            </h3>
                            <p class="text-xs text-sand-600">
                                Perbarui nama akun dan alamat email yang terdaftar pada sistem KlikMomen.
                            </p>
                        </div>

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
                                             <span>Email Anda belum terverifikasi.</span>
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

                            <!-- INFORMASI TAMBAHAN (ROLE & STATUS) -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                                <div class="p-3.5 rounded-2xl bg-sand-50/70 border border-sand-200/60">
                                    <span class="text-[10px] font-bold text-sand-500 uppercase tracking-wider block">Tipe Hak Akses</span>
                                    <span class="text-xs font-bold text-charcoal-950 flex items-center gap-1.5 mt-0.5">
                                        <i data-lucide="badge-check" class="w-4 h-4 text-brand-600"></i>
                                        <span>{{ ucfirst($user->role ?? 'member') }}</span>
                                    </span>
                                </div>

                                <div class="p-3.5 rounded-2xl bg-sand-50/70 border border-sand-200/60">
                                    <span class="text-[10px] font-bold text-sand-500 uppercase tracking-wider block">Status Akun</span>
                                    <span class="text-xs font-bold text-emerald-700 flex items-center gap-1.5 mt-0.5">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                                        <span>Aktif</span>
                                    </span>
                                </div>
                            </div>

                            <!-- SUBMIT BUTTON -->
                            <div class="pt-3 border-t border-sand-100 flex items-center justify-end">
                                <button 
                                    type="submit" 
                                    class="px-6 py-3 rounded-2xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 hover:from-brand-500 hover:to-brand-600 text-white font-bold text-xs shadow-lg shadow-brand-900/20 active:scale-[0.98] transition flex items-center gap-2"
                                >
                                    <i data-lucide="save" class="w-4 h-4"></i>
                                    <span>Simpan Perubahan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ============================================== -->
                <!-- PANEL 2: KEAMANAN & KATA SANDI -->
                <!-- ============================================== -->
                <div x-show="activeTab === 'security'" class="space-y-6" x-cloak>
                    <div class="p-6 sm:p-8 rounded-3xl bg-white border border-sand-200 shadow-sm space-y-6">
                        <div class="border-b border-sand-100 pb-4 space-y-1">
                            <h3 class="font-serif text-xl font-bold text-charcoal-950 flex items-center gap-2">
                                <i data-lucide="shield-check" class="w-5 h-5 text-brand-600"></i>
                                <span>Perbarui Kata Sandi</span>
                            </h3>
                            <p class="text-xs text-sand-600">
                                Pastikan akun Anda menggunakan kata sandi yang aman dan tidak digunakan di situs lain.
                            </p>
                        </div>

                        @if (is_null($user->password))
                            <div class="p-4 rounded-2xl bg-brand-50/80 border border-brand-200 text-xs text-brand-900 flex items-start gap-3">
                                <i data-lucide="info" class="w-4 h-4 text-brand-600 flex-shrink-0 mt-0.5"></i>
                                <div class="space-y-0.5">
                                    <span class="font-bold block">Akun Masuk dengan Google</span>
                                    <p class="text-brand-800 leading-relaxed">
                                        Akun ini dibuat menggunakan Google OAuth. Anda dapat mengatur kata sandi di bawah ini jika ingin bisa login dengan email &amp; kata sandi biasa.
                                    </p>
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
                                            <span x-show="!showCurrent"><i data-lucide="eye" class="w-4 h-4"></i></span>
                                            <span x-show="showCurrent" style="display: none;"><i data-lucide="eye-off" class="w-4 h-4"></i></span>
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
                                        <span x-show="!showNew"><i data-lucide="eye" class="w-4 h-4"></i></span>
                                        <span x-show="showNew" style="display: none;"><i data-lucide="eye-off" class="w-4 h-4"></i></span>
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
                                        <span x-show="!showConfirm"><i data-lucide="eye" class="w-4 h-4"></i></span>
                                        <span x-show="showConfirm" style="display: none;"><i data-lucide="eye-off" class="w-4 h-4"></i></span>
                                    </button>
                                </div>
                                @if ($errors->updatePassword->has('password_confirmation'))
                                    <p class="text-[11px] text-rose-600 font-semibold mt-1 flex items-center gap-1">
                                        <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                                        <span>{{ $errors->updatePassword->first('password_confirmation') }}</span>
                                    </p>
                                @endif
                            </div>

                            <!-- SUBMIT BUTTON -->
                            <div class="pt-3 border-t border-sand-100 flex items-center justify-end">
                                <button 
                                    type="submit" 
                                    class="px-6 py-3 rounded-2xl bg-charcoal-950 hover:bg-charcoal-900 text-white font-bold text-xs shadow-md active:scale-[0.98] transition flex items-center gap-2"
                                >
                                    <i data-lucide="lock" class="w-4 h-4 text-brand-400"></i>
                                    <span>Perbarui Kata Sandi</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ============================================== -->
                <!-- PANEL 3: ZONA HAPUS AKUN -->
                <!-- ============================================== -->
                <div x-show="activeTab === 'danger'" class="space-y-6" x-cloak>
                    <div class="p-6 sm:p-8 rounded-3xl bg-white border border-rose-200 shadow-sm space-y-6">
                        <div class="border-b border-rose-100 pb-4 space-y-1">
                            <h3 class="font-serif text-xl font-bold text-rose-950 flex items-center gap-2">
                                <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-600"></i>
                                <span>Penghapusan Akun Pengguna</span>
                            </h3>
                            <p class="text-xs text-sand-600">
                                Tindakan ini bersifat permanen dan akan menghapus seluruh data Anda dari sistem KlikMomen.
                            </p>
                        </div>

                        <div class="p-5 rounded-2xl bg-rose-50/80 border border-rose-200/80 text-xs text-rose-950 space-y-3">
                            <p class="leading-relaxed">
                                Setelah akun dihapus, seluruh undangan pernikahan, daftar tamu, data RSVP, serta buku ucapan Anda akan dihapus secara permanen dan tidak dapat dipulihkan kembali.
                            </p>

                            <button
                                type="button"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                class="px-5 py-3 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-md hover:shadow-rose-600/20 active:scale-[0.98] transition flex items-center gap-2"
                            >
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                <span>Hapus Akun Saya Secara Permanen</span>
                            </button>
                        </div>
                    </div>

                    <!-- MODAL CONFIRMATION -->
                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8 space-y-5 text-left">
                            @csrf
                            @method('delete')

                            <div class="space-y-2">
                                <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center">
                                    <i data-lucide="alert-octagon" class="w-6 h-6"></i>
                                </div>
                                <h2 class="font-serif text-xl font-bold text-charcoal-950">
                                    Apakah Anda Yakin Ingin Menghapus Akun?
                                </h2>
                                <p class="text-xs text-sand-600 leading-relaxed">
                                    Masukkan kata sandi akun Anda untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus akun ini secara permanen.
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
                                    placeholder="Ketik kata sandi akun Anda"
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
                                    class="px-5 py-2.5 rounded-2xl border border-sand-200 hover:bg-sand-100 text-charcoal-800 font-bold text-xs transition"
                                >
                                    Batalkan
                                </button>

                                <button 
                                    type="submit" 
                                    class="px-5 py-2.5 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-md active:scale-[0.98] transition flex items-center gap-1.5"
                                >
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    <span>Ya, Hapus Akun</span>
                                </button>
                            </div>
                        </form>
                    </x-modal>
                </div>

            </div>

        </div>

    </div>
</x-app-layout>
