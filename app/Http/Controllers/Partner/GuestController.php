<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\InvitationGuest as Guest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GuestController extends Controller
{
    /**
     * Display a listing of wedding guests for client invitations under partner.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $invitations = $user->partnerInvitations()->latest()->get();
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

        $selectedInvitation = $request->filled('invitation_id')
            ? $invitations->firstWhere('id', (int) $request->invitation_id)
            : $invitations->first();

        $totalGuests = Guest::whereIn('invitation_id', $invitationIds)->count();
        $totalAttending = Guest::whereIn('invitation_id', $invitationIds)->where('attendance_status', 'hadir')->count();
        $totalDeclined = Guest::whereIn('invitation_id', $invitationIds)->where('attendance_status', 'tidak_hadir')->count();
        $totalPending = Guest::whereIn('invitation_id', $invitationIds)->where('attendance_status', 'pending')->count();

        return view('partner.guests.index', compact(
            'guests',
            'invitations',
            'selectedInvitation',
            'totalGuests',
            'totalAttending',
            'totalDeclined',
            'totalPending'
        ));
    }

    /**
     * Store a new wedding guest under client invitation.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'invitation_id' => 'required|exists:invitations,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'category' => 'nullable|string|max:50',
            'pax' => 'nullable|integer|min:1|max:20',
        ]);

        $invitation = $request->user()->partnerInvitations()->findOrFail($validated['invitation_id']);

        $baseSlug = Str::slug($validated['name']);
        $uniqueSlug = $baseSlug ?: 'tamu';
        if ($invitation->guests()->where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug .= '-'.Str::lower(Str::random(4));
        }

        $invitation->guests()->create([
            'name' => $validated['name'],
            'slug' => $uniqueSlug,
            'phone' => $validated['phone'] ?? null,
            'category' => $validated['category'] ?? 'Umum',
            'pax' => $validated['pax'] ?? 1,
            'attendance_status' => 'pending',
            'is_invited' => true,
        ]);

        return redirect()->back()->with('success', 'Tamu undangan "'.$validated['name'].'" berhasil ditambahkan ke daftar.');
    }

    /**
     * Remove the specified guest from invitation.
     */
    public function destroy(Request $request, Guest $guest): RedirectResponse
    {
        $hasAccess = $request->user()->partnerInvitations()->where('id', $guest->invitation_id)->exists();
        abort_unless($hasAccess, 403, 'Anda tidak memiliki hak akses untuk menghapus tamu ini.');

        $guest->delete();

        return redirect()->back()->with('success', 'Tamu berhasil dihapus dari daftar undangan.');
    }

    /**
     * Update WhatsApp invitation template for client invitation.
     */
    public function updateTemplate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'invitation_id' => 'required|exists:invitations,id',
            'whatsapp_template' => 'nullable|string|max:2000',
        ]);

        $invitation = $request->user()->partnerInvitations()->findOrFail($validated['invitation_id']);

        $setting = $invitation->setting()->firstOrCreate(['invitation_id' => $invitation->id]);
        $metadata = $setting->metadata ?? [];
        $metadata['whatsapp_template'] = $validated['whatsapp_template'] ?: null;
        $setting->metadata = $metadata;
        $setting->save();

        return redirect()->back()->with('success', 'Template pesan WhatsApp untuk "'.$invitation->title.'" berhasil diperbarui.');
    }
}
