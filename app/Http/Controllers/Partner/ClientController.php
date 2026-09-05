<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\PartnerClient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Display a listing of partner clients.
     */
    public function index(Request $request): View
    {
        $clients = $request->user()->partnerClients()->withCount('invitations')->latest()->paginate(15);

        return view('partner.clients.index', compact('clients'));
    }

    /**
     * Store a newly created client.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|string',
        ]);

        $request->user()->partnerClients()->create($validated);

        return redirect()->back()->with('success', 'Klien berhasil ditambahkan.');
    }

    /**
     * Update client details.
     */
    public function update(Request $request, PartnerClient $client): RedirectResponse
    {
        if ($client->partner_id !== $request->user()->id && ! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|string',
        ]);

        $client->update($validated);

        return redirect()->back()->with('success', 'Data klien berhasil diperbarui.');
    }

    /**
     * Remove client.
     */
    public function destroy(Request $request, PartnerClient $client): RedirectResponse
    {
        if ($client->partner_id !== $request->user()->id && ! $request->user()->isSuperAdmin()) {
            abort(403);
        }

        $client->delete();

        return redirect()->back()->with('success', 'Klien berhasil dihapus.');
    }
}
