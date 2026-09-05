<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\InvitationGuest as Guest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GuestController extends Controller
{
    /**
     * Display a listing of wedding guests with WhatsApp generators for member invitations.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $invitations = $user->invitations()->latest()->get();
        $invitationIds = $invitations->pluck('id');

        $query = Guest::whereIn('invitation_id', $invitationIds)->with('invitation');

        if ($request->filled('invitation_id')) {
            $query->where('invitation_id', $request->invitation_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('attendance_status', $request->status);
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $guests = $query->latest()->paginate(15)->withQueryString();

        $totalGuests = Guest::whereIn('invitation_id', $invitationIds)->count();
        $totalAttending = Guest::whereIn('invitation_id', $invitationIds)->where('attendance_status', 'hadir')->count();
        $totalDeclined = Guest::whereIn('invitation_id', $invitationIds)->where('attendance_status', 'tidak_hadir')->count();
        $totalPending = Guest::whereIn('invitation_id', $invitationIds)->where('attendance_status', 'pending')->count();

        $primaryInvitation = $invitations->first();

        return view('member.guests.index', compact(
            'guests',
            'invitations',
            'primaryInvitation',
            'totalGuests',
            'totalAttending',
            'totalDeclined',
            'totalPending'
        ));
    }

    /**
     * Store a new wedding guest under member's invitation.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'invitation_id' => 'required|exists:invitations,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'category' => 'nullable|string|max:50',
            'pax' => 'nullable|integer|min:1|max:20',
        ]);

        $invitation = $user->invitations()->findOrFail($validated['invitation_id']);

        $baseSlug = Str::slug($validated['name']);
        $uniqueSlug = $baseSlug ?: 'tamu';
        if ($invitation->guests()->where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug .= '-'.Str::lower(Str::random(4));
        }

        $invitation->guests()->create([
            'name' => $validated['name'],
            'slug' => $uniqueSlug,
            'phone' => $validated['phone'] ?? null,
            'category' => $validated['category'] ?? 'General',
            'pax' => $validated['pax'] ?? 1,
            'attendance_status' => 'pending',
            'is_invited' => true,
        ]);

        return redirect()->route('member.guests.index')
            ->with('success', 'Tamu undangan "'.$validated['name'].'" berhasil ditambahkan.');
    }

    /**
     * Delete a guest.
     */
    public function destroy(Request $request, Guest $guest): RedirectResponse
    {
        $user = Auth::user();

        // Ensure guest belongs to an invitation owned by the authenticated member
        if ($guest->invitation->owner_id !== $user->id && $guest->invitation->user_id !== $user->id) {
            abort(403, 'Akses ditolak. Tamu ini bukan milik undangan Anda.');
        }

        $name = $guest->name;
        $guest->delete();

        return redirect()->route('member.guests.index')
            ->with('success', 'Tamu "'.$name.'" berhasil dihapus dari daftar.');
    }
}
