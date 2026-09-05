<x-app-layout>
    <div class="space-y-3 sm:space-y-3.5" x-data="{ addModal: false }">

        <!-- HEADER TITLE -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-serif text-lg sm:text-xl font-bold text-charcoal-950">Kelola Pengguna Platform</h1>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">Tata Kelola</span>
                </div>
                <p class="text-xs text-sand-600">
                    Audit, monitoring peran, dan kelola status akses seluruh pengguna (Member, Partner WO, dan Administrator).
                </p>
            </div>

            <button 
                type="button" 
                @click="addModal = true"
                class="px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-brand-600 via-brand-500 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white font-bold text-xs shadow-md hover:shadow-brand-500/25 transition flex items-center gap-1.5 self-start sm:self-auto shrink-0"
            >
                <i data-lucide="user-plus" class="w-3.5 h-3.5 text-amber-200"></i>
                <span>Tambah Pengguna</span>
            </button>
        </div>

        <!-- ADD USER MODAL -->
        <div 
            x-show="addModal" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto bg-charcoal-950/70 backdrop-blur-sm flex items-center justify-center p-4"
            style="display: none;"
        >
            <div 
                @click.away="addModal = false" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative w-full max-w-lg rounded-3xl bg-white p-6 shadow-2xl border border-sand-200 space-y-4"
            >
                <div class="flex items-center justify-between border-b border-sand-100 pb-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center font-bold">
                            <i data-lucide="user-plus" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h3 class="font-serif text-lg font-bold text-charcoal-950">Tambah Pengguna Baru</h3>
                            <p class="text-xs text-sand-500">Daftarkan akun member, partner WO, atau administrator.</p>
                        </div>
                    </div>
                    <button @click="addModal = false" class="p-2 rounded-xl text-sand-400 hover:text-charcoal-900 hover:bg-sand-100 transition">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-3.5">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-charcoal-900 mb-1">Nama Lengkap</label>
                        <input 
                            type="text" 
                            name="name" 
                            required 
                            placeholder="Contoh: Raka Aditya" 
                            class="w-full px-3.5 py-2 rounded-xl border border-sand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                        >
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-charcoal-900 mb-1">Alamat Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            required 
                            placeholder="Contoh: user@domain.com" 
                            class="w-full px-3.5 py-2 rounded-xl border border-sand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                        >
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-charcoal-900 mb-1">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            required 
                            minlength="8" 
                            placeholder="Minimal 8 karakter" 
                            class="w-full px-3.5 py-2 rounded-xl border border-sand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                        >
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-charcoal-900 mb-1">Peran Akun (Role)</label>
                            <select 
                                name="role" 
                                required 
                                class="w-full px-3.5 py-2 rounded-xl border border-sand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 bg-white"
                            >
                                <option value="member">Member (Calon Pengantin)</option>
                                <option value="partner">Partner (Wedding Organizer)</option>
                                <option value="super_admin">Super Administrator</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-charcoal-900 mb-1">Status Akun</label>
                            <select 
                                name="status" 
                                class="w-full px-3.5 py-2 rounded-xl border border-sand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 bg-white"
                            >
                                <option value="active">Aktif Langsung</option>
                                <option value="suspended">Ditangguhkan (Suspended)</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2 border-t border-sand-100">
                        <button 
                            type="button" 
                            @click="addModal = false" 
                            class="px-4 py-2 rounded-xl border border-sand-300 text-xs font-semibold text-sand-700 hover:bg-sand-50 transition"
                        >
                            Batal
                        </button>
                        <button 
                            type="submit" 
                            class="px-5 py-2 rounded-xl bg-charcoal-950 hover:bg-brand-600 text-white text-xs font-bold transition shadow-sm"
                        >
                            Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2">
                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 flex-shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-2.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 flex-shrink-0"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- STATS CARDS -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2">
            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-sand-500 block">Total Pengguna</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-charcoal-950">{{ $totalUsers }} <span class="text-[11px] font-sans text-sand-400 font-normal">Akun</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-sand-100 text-charcoal-900 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="users" class="w-3.5 h-3.5"></i>
                </div>
            </div>

            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-amber-700 block">Member (Pengantin)</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-charcoal-950">{{ $totalMembers }} <span class="text-[11px] font-sans text-sand-400 font-normal">Calon</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="user" class="w-3.5 h-3.5"></i>
                </div>
            </div>

            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-brand-700 block">Partner &amp; WO</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-charcoal-950">{{ $totalPartners }} <span class="text-[11px] font-sans text-sand-400 font-normal">Vendor</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="handshake" class="w-3.5 h-3.5"></i>
                </div>
            </div>

            <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-emerald-700 block">Super Administrator</span>
                    <div class="font-serif text-base sm:text-lg font-bold text-charcoal-950">{{ $totalAdmins }} <span class="text-[11px] font-sans text-sand-400 font-normal">Admin</span></div>
                </div>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs">
                    <i data-lucide="shield" class="w-3.5 h-3.5"></i>
                </div>
            </div>
        </div>

        <!-- SEARCH & FILTER BAR -->
        <div class="p-2.5 sm:p-3 rounded-2xl glass-panel border border-sand-200/80 shadow-sm">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col sm:flex-row gap-2">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-sand-400">
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email pengguna..."
                        class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-sand-300 text-xs focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                </div>

                <select name="role" class="py-1.5 px-2.5 rounded-xl border border-sand-300 text-xs focus:ring-2 focus:ring-brand-500 bg-white">
                    <option value="all">Semua Peran</option>
                    <option value="member" {{ request('role') === 'member' ? 'selected' : '' }}>Member</option>
                    <option value="partner" {{ request('role') === 'partner' ? 'selected' : '' }}>Partner (WO)</option>
                    <option value="super_admin" {{ request('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                </select>

                <select name="status" class="py-1.5 px-2.5 rounded-xl border border-sand-300 text-xs focus:ring-2 focus:ring-brand-500 bg-white">
                    <option value="all">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Ditangguhkan</option>
                </select>

                <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-charcoal-900 hover:bg-charcoal-800 text-white font-bold text-xs transition flex items-center justify-center gap-1.5 shadow-sm">
                    <i data-lucide="filter" class="w-3.5 h-3.5"></i>
                    <span>Filter</span>
                </button>

                @if(request()->anyFilled(['search', 'role', 'status']))
                    <a href="{{ route('admin.users.index') }}" class="px-2.5 py-1.5 rounded-xl border border-sand-300 hover:bg-sand-100 text-sand-700 text-xs font-semibold flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- USERS TABLE -->
        <div class="rounded-3xl glass-panel border border-sand-200/80 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-sand-50/80 border-b border-sand-200/80 text-sand-600 font-bold uppercase tracking-wider">
                            <th class="p-4 pl-6">Pengguna</th>
                            <th class="p-4">Peran (Role)</th>
                            <th class="p-4">Status Akun</th>
                            <th class="p-4 text-center">Undangan</th>
                            <th class="p-4 text-center">Pesanan</th>
                            <th class="p-4">Bergabung</th>
                            <th class="p-4 pr-6 text-right">Aksi Kelola</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sand-200/60">
                        @forelse($users as $user)
                            <tr class="hover:bg-sand-50/50 transition">
                                <td class="p-4 pl-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-charcoal-900 text-brand-300 flex items-center justify-center font-serif font-bold text-sm">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-charcoal-950 flex items-center gap-1.5">
                                                <span>{{ $user->name }}</span>
                                                @if($user->id === Auth::id())
                                                    <span class="px-1.5 py-0.5 rounded bg-amber-100 text-amber-800 text-[9px] font-bold">Anda</span>
                                                @endif
                                            </div>
                                            <span class="text-sand-500 text-[11px]">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    @if($user->isSuperAdmin())
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-indigo-100 text-indigo-800 text-[10px] font-bold uppercase tracking-wider">
                                            <i data-lucide="shield" class="w-3 h-3"></i> Super Admin
                                        </span>
                                    @elseif($user->isPartner())
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-brand-100 text-brand-800 text-[10px] font-bold uppercase tracking-wider">
                                            <i data-lucide="handshake" class="w-3 h-3"></i> Partner WO
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider">
                                            <i data-lucide="user" class="w-3 h-3"></i> Member
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($user->status === 'active')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-rose-100 text-rose-800 text-[10px] font-bold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Ditangguhkan
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-center font-semibold text-charcoal-900">
                                    {{ $user->invitations_count }}
                                </td>
                                <td class="p-4 text-center font-semibold text-charcoal-900">
                                    {{ $user->orders_count }}
                                </td>
                                <td class="p-4 text-sand-500 text-[11px]">
                                    {{ $user->created_at ? $user->created_at->isoFormat('D MMM Y') : '-' }}
                                </td>
                                <td class="p-4 pr-6 text-right">
                                    @if($user->id !== Auth::id())
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- Toggle Status -->
                                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-3 py-1.5 rounded-xl border text-xs font-semibold transition {{ $user->status === 'active' ? 'border-rose-300 text-rose-700 hover:bg-rose-50' : 'border-emerald-300 text-emerald-700 hover:bg-emerald-50' }}">
                                                    {{ $user->status === 'active' ? 'Suspend' : 'Aktifkan' }}
                                                </button>
                                            </form>

                                            <!-- Role Dropdown -->
                                            <form action="{{ route('admin.users.update-role', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" onchange="this.form.submit()" class="py-1 px-2 rounded-xl border border-sand-300 text-[11px] bg-white text-sand-700 cursor-pointer">
                                                    <option value="member" {{ $user->role === 'member' || $user->role === 'user' ? 'selected' : '' }}>Role: Member</option>
                                                    <option value="partner" {{ $user->role === 'partner' ? 'selected' : '' }}>Role: Partner</option>
                                                    <option value="super_admin" {{ $user->role === 'super_admin' ? 'selected' : '' }}>Role: Admin</option>
                                                </select>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-sand-400 text-[11px] italic">Akun Anda</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-sand-500">
                                    Tidak ada pengguna yang sesuai dengan kriteria pencarian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="p-4 border-t border-sand-200/80">
                    {{ $users->withQueryString()->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
