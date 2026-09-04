<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GuestController extends Controller
{
    /**
     * Display a listing of wedding guests with WhatsApp generators.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $query = Guest::with('invitation');

        if (! $user->isSuperAdmin()) {
            $invitationIds = $user->invitations()->pluck('id');
            $query->whereIn('invitation_id', $invitationIds);

            $totalGuests = Guest::whereIn('invitation_id', $invitationIds)->count();
            $totalAttending = Guest::whereIn('invitation_id', $invitationIds)->where('attendance_status', 'hadir')->count();
            $totalDeclined = Guest::whereIn('invitation_id', $invitationIds)->where('attendance_status', 'tidak_hadir')->count();
            $totalPending = Guest::whereIn('invitation_id', $invitationIds)->where('attendance_status', 'pending')->count();
            $primaryInvitation = $user->invitations()->with('couple')->latest()->first();
        } else {
            $totalGuests = Guest::count();
            $totalAttending = Guest::where('attendance_status', 'hadir')->count();
            $totalDeclined = Guest::where('attendance_status', 'tidak_hadir')->count();
            $totalPending = Guest::where('attendance_status', 'pending')->count();
            $primaryInvitation = Invitation::with('couple')->first();
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('attendance_status', $request->status);
        }

        if ($request->filled('group') && $request->group !== 'all') {
            $query->where('group', $request->group);
        }

        $guests = $query->latest()->paginate(15);

        return view('admin.guests.index', compact(
            'guests',
            'totalGuests',
            'totalAttending',
            'totalDeclined',
            'totalPending',
            'primaryInvitation'
        ));
    }
}
