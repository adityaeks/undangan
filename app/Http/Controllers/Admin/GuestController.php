<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\InvitationGuest as Guest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuestController extends Controller
{
    /**
     * Display a listing of wedding guests with WhatsApp generators.
     */
    public function index(Request $request): View
    {
        $query = Guest::with('invitation');

        $totalGuests = Guest::count();
        $totalAttending = Guest::where('attendance_status', 'hadir')->count();
        $totalDeclined = Guest::where('attendance_status', 'tidak_hadir')->count();
        $totalPending = Guest::where('attendance_status', 'pending')->count();
        $primaryInvitation = Invitation::with('couple')->first();

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

        if ($request->filled('group') && $request->group !== 'all') {
            $query->where('category', $request->group);
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
