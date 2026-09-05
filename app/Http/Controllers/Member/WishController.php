<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\InvitationWish as Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishController extends Controller
{
    /**
     * Display a listing of guestbook wishes and prayers for member invitations.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $invitations = $user->invitations()->latest()->get();
        $invitationIds = $invitations->pluck('id');

        $query = Wish::whereIn('invitation_id', $invitationIds)->with('invitation');

        if ($request->filled('invitation_id')) {
            $query->where('invitation_id', $request->invitation_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('guest_name', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('attendance') && $request->attendance !== 'all') {
            $query->where('attendance_status', 'like', "%{$request->attendance}%");
        }

        $wishes = $query->latest()->paginate(15)->withQueryString();

        $totalWishes = Wish::whereIn('invitation_id', $invitationIds)->count();
        $totalAttending = Wish::whereIn('invitation_id', $invitationIds)->where('attendance_status', 'like', '%hadir%')->count();
        $primaryInvitation = $invitations->first();

        return view('member.wishes.index', compact('wishes', 'invitations', 'primaryInvitation', 'totalWishes', 'totalAttending'));
    }
}
