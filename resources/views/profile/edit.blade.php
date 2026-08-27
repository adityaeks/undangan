<x-app-layout>
    <div class="space-y-6 max-w-4xl">
        
        <!-- HEADER -->
        <div class="space-y-1">
            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-charcoal-950">
                Pengaturan Profil & Keamanan
            </h1>
            <p class="text-xs text-sand-600">
                Kelola informasi akun, alamat email, dan perbarui kata sandi Anda.
            </p>
        </div>

        <!-- PROFILE INFORMATION -->
        <div class="p-6 sm:p-8 rounded-3xl glass-panel border border-sand-200 shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- UPDATE PASSWORD -->
        <div class="p-6 sm:p-8 rounded-3xl glass-panel border border-sand-200 shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- DELETE ACCOUNT -->
        <div class="p-6 sm:p-8 rounded-3xl glass-panel border border-sand-200 shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</x-app-layout>
