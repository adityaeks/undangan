<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvitationWish as Wish;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WishController extends Controller
{
    /**
     * Display a listing of guestbook wishes and blessings.
     */
    public function index(Request $request): View
    {
        $query = Wish::with('invitation');

        $totalWishes = Wish::count();
        $totalAttending = Wish::where('attendance_status', 'like', '%hadir%')->orWhere('attendance_status', 'attending')->count();
        $totalHidden = Wish::where('is_approved', false)->count();

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

        $wishes = $query->latest()->paginate(15);

        return view('admin.wishes.index', compact('wishes', 'totalWishes', 'totalAttending', 'totalHidden'));
    }

    /**
     * Toggle approval status of a wish/blessing.
     */
    public function toggleApproval(Wish $wish): RedirectResponse
    {
        $wish->update(['is_approved' => ! $wish->is_approved]);
        $status = $wish->is_approved ? 'ditampilkan' : 'disembunyikan';

        return back()->with('success', "Ucapan dari {$wish->guest_name} berhasil {$status}.");
    }

    /**
     * Delete an inappropriate or spam wish.
     */
    public function destroy(Wish $wish): RedirectResponse
    {
        $guest = $wish->guest_name;
        $wish->delete();

        return back()->with('success', "Ucapan dari {$guest} berhasil dihapus.");
    }
}
