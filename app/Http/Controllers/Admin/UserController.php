<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of registered users.
     */
    public function index(Request $request): View
    {
        $query = User::withCount(['invitations', 'orders']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(15);

        $totalUsers = User::count();
        $totalMembers = User::whereIn('role', ['member', 'user'])->count();
        $totalPartners = User::where('role', 'partner')->count();
        $totalAdmins = User::where('role', 'super_admin')->count();

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'totalMembers',
            'totalPartners',
            'totalAdmins'
        ));
    }

    /**
     * Create and store a new user account.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:member,partner,super_admin'],
            'status' => ['nullable', 'in:active,suspended'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
            'status' => $validated['status'] ?? 'active',
            'email_verified_at' => now(),
        ]);

        return back()->with('success', "Pengguna {$user->name} ({$user->email}) berhasil ditambahkan sebagai {$user->role}.");
    }

    /**
     * Toggle active or suspended status for a user.
     */
    public function toggleStatus(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
        }

        $newStatus = $user->status === 'active' ? 'suspended' : 'active';
        $user->update(['status' => $newStatus]);

        $label = $newStatus === 'active' ? 'diaktifkan' : 'ditangguhkan (suspend)';

        return back()->with('success', "Akun {$user->name} berhasil {$label}.");
    }

    /**
     * Update user role.
     */
    public function updateRole(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Anda tidak dapat mengubah peran akun Anda sendiri.');
        }

        $validated = $request->validate([
            'role' => ['required', 'in:member,partner,super_admin'],
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('success', "Peran akun {$user->name} berhasil diubah menjadi {$validated['role']}.");
    }
}
