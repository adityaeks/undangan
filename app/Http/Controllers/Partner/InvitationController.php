<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Theme;
use App\Services\InvitationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvitationController extends Controller
{
    public function __construct(
        protected InvitationService $invitationService,
    ) {}

    /**
     * Display a listing of partner invitations.
     */
    public function index(Request $request): View
    {
        $invitations = $request->user()->partnerInvitations()
            ->with(['theme', 'client'])
            ->latest()
            ->paginate(12);

        return view('partner.invitations.index', compact('invitations'));
    }

    /**
     * Show form for creating a new invitation for a client.
     */
    public function create(Request $request): View
    {
        $clients = $request->user()->partnerClients()->get();
        $themes = Theme::where('is_active', true)->get();

        return view('partner.invitations.create', compact('clients', 'themes'));
    }

    /**
     * Store invitation for client.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_id' => 'nullable|exists:partner_clients,id',
            'theme_id' => 'required|exists:themes,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
            'groom_name' => 'nullable|string|max:255',
            'bride_name' => 'nullable|string|max:255',
        ]);

        $invitation = $this->invitationService->createInvitation($request->user(), $validated);

        return redirect()->route('partner.invitations.index')->with('success', 'Undangan untuk klien berhasil dibuat!');
    }
}
