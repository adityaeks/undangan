<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class PartnerController extends Controller
{
    /**
     * Display the Wedding Organizer & Reseller Partner management page.
     */
    public function index(): View
    {
        $partners = User::where('role', 'partner')->latest()->get();
        $totalPartners = $partners->count();

        return view('admin.partners.index', compact('partners', 'totalPartners'));
    }
}
