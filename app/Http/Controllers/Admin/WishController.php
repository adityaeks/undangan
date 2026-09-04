<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wish;
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

        if ($request->filled('search')) {
            $query->where('guest_name', 'like', "%{$request->search}%")
                ->orWhere('message', 'like', "%{$request->search}%");
        }

        if ($request->filled('attendance') && $request->attendance !== 'all') {
            $query->where('attendance', 'like', "%{$request->attendance}%");
        }

        $wishes = $query->latest()->paginate(15);
        $totalWishes = Wish::count();
        $totalAttending = Wish::where('attendance', 'like', '%Hadir%')->count();
        $totalHidden = Wish::where('is_hidden', true)->count();

        return view('admin.wishes.index', compact('wishes', 'totalWishes', 'totalAttending', 'totalHidden'));
    }
}
