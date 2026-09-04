<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishController extends Controller
{
    /**
     * Display a listing of guestbook wishes and blessings.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $query = Wish::with('invitation');

        if (! $user->isSuperAdmin()) {
            $invitationIds = $user->invitations()->pluck('id');
            $query->whereIn('invitation_id', $invitationIds);

            $totalWishes = Wish::whereIn('invitation_id', $invitationIds)->count();
            $totalAttending = Wish::whereIn('invitation_id', $invitationIds)->where('attendance', 'like', '%Hadir%')->count();
            $totalHidden = Wish::whereIn('invitation_id', $invitationIds)->where('is_hidden', true)->count();
        } else {
            $totalWishes = Wish::count();
            $totalAttending = Wish::where('attendance', 'like', '%Hadir%')->count();
            $totalHidden = Wish::where('is_hidden', true)->count();
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('guest_name', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('attendance') && $request->attendance !== 'all') {
            $query->where('attendance', 'like', "%{$request->attendance}%");
        }

        $wishes = $query->latest()->paginate(15);

        return view('admin.wishes.index', compact('wishes', 'totalWishes', 'totalAttending', 'totalHidden'));
    }
}
