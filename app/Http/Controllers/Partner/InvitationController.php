<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Theme;
use App\Services\ThemeOwnershipService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InvitationController extends Controller
{
    public function __construct(
        protected ThemeOwnershipService $themeOwnershipService,
    ) {}

    /**
     * Display a listing of partner invitations.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $invitations = $user->partnerInvitations()
            ->with(['theme', 'client'])
            ->latest()
            ->paginate(12);

        $invitationCount = $user->partnerInvitations()->count();
        $invitationQuota = $user->invitation_quota;
        $canCreate = $user->canCreateInvitation();
        $activePackage = $user->active_package;

        return view('partner.invitations.index', compact(
            'invitations',
            'invitationCount',
            'invitationQuota',
            'canCreate',
            'activePackage'
        ));
    }

    /**
     * Show form for creating a new invitation for a client.
     */
    public function create(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        if (! $user->canCreateInvitation()) {
            return redirect()->route('partner.invitations.index')
                ->with('error', 'Kuota pembuatan undangan paket Anda sudah tercapai ('.$user->partnerInvitations()->count().'/'.$user->invitation_quota.' undangan). Silakan upgrade paket kemitraan untuk menambah kuota.');
        }

        $clients = $user->partnerClients()->latest()->get();
        $themes = Theme::where('is_active', true)
            ->where('is_for_partner', true)
            ->get();
        $musicPresets = config('themes.music_presets', []);

        return view('partner.invitations.create', compact('clients', 'themes', 'musicPresets'));
    }

    /**
     * Store invitation for client with all modular data (couples, events, galleries, stories, gifts).
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (! $user->canCreateInvitation()) {
            return redirect()->route('partner.invitations.index')
                ->with('error', 'Kuota pembuatan undangan paket Anda sudah tercapai ('.$user->partnerInvitations()->count().'/'.$user->invitation_quota.' undangan). Silakan upgrade paket kemitraan untuk menambah kuota.');
        }

        $validated = $request->validate([
            'client_id' => 'nullable|exists:partner_clients,id',
            'theme_id' => 'required|exists:themes,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
            'quote_text' => 'nullable|string',
            'quote_source' => 'nullable|string|max:255',

            // Media & Cover
            'cover_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'cover_image_url' => 'nullable|url|max:500',
            'music_file' => 'nullable|mimes:mp3,wav,ogg,m4a|max:10240',
            'music_preset' => 'nullable|string|max:255',

            // Groom
            'groom_name' => 'required|string|max:255',
            'groom_nickname' => 'nullable|string|max:100',
            'groom_child_order' => 'nullable|string|max:100',
            'groom_father' => 'nullable|string|max:255',
            'groom_mother' => 'nullable|string|max:255',
            'groom_instagram' => 'nullable|string|max:100',
            'groom_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'groom_photo_url' => 'nullable|url|max:500',

            // Bride
            'bride_name' => 'required|string|max:255',
            'bride_nickname' => 'nullable|string|max:100',
            'bride_child_order' => 'nullable|string|max:100',
            'bride_father' => 'nullable|string|max:255',
            'bride_mother' => 'nullable|string|max:255',
            'bride_instagram' => 'nullable|string|max:100',
            'bride_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'bride_photo_url' => 'nullable|url|max:500',

            // Gallery Files
            'gallery_files' => 'nullable|array',
            'gallery_files.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'gallery_urls' => 'nullable|array',
            'gallery_urls.*' => 'nullable|string|max:500',

            // Events - Akad
            'akad_date' => 'nullable|date',
            'akad_time' => 'nullable|string|max:100',
            'akad_venue' => 'nullable|string|max:255',
            'akad_address' => 'nullable|string',
            'akad_maps_link' => 'nullable|url|max:500',

            // Events - Resepsi
            'resepsi_date' => 'nullable|date',
            'resepsi_time' => 'nullable|string|max:100',
            'resepsi_venue' => 'nullable|string|max:255',
            'resepsi_address' => 'nullable|string',
            'resepsi_maps_link' => 'nullable|url|max:500',

            // Wallets & Gifts
            'bank_1_name' => 'nullable|string|max:100',
            'bank_1_number' => 'nullable|string|max:100',
            'bank_1_holder' => 'nullable|string|max:255',
            'bank_2_name' => 'nullable|string|max:100',
            'bank_2_number' => 'nullable|string|max:100',
            'bank_2_holder' => 'nullable|string|max:255',
            'gift_address' => 'nullable|string|max:1000',

            // Stories
            'stories' => 'nullable|array',
            'stories.*.title' => 'nullable|string|max:255',
            'stories.*.date' => 'nullable|string|max:100',
            'stories.*.story' => 'nullable|string',
            'stories.*.image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',

            // WhatsApp Template
            'whatsapp_template' => 'nullable|string|max:2000',
        ]);

        $theme = Theme::findOrFail($validated['theme_id']);
        if (! $this->themeOwnershipService->canUseTheme($user, $theme)) {
            return back()->with('error', 'Template tema ini belum diaktifkan oleh Super Admin untuk Partner.');
        }

        DB::transaction(function () use ($user, $theme, $validated, $request) {
            // Cover Image
            $coverImage = $validated['cover_image_url'] ?? null;
            if ($request->hasFile('cover_image_file')) {
                $coverPath = $request->file('cover_image_file')->store('invitations/covers', 'public');
                $coverImage = Storage::url($coverPath);
            }

            // Background Music
            $backgroundMusic = $validated['music_preset'] ?? '/audio/wedding-song.mp3';
            if ($request->hasFile('music_file')) {
                $musicPath = $request->file('music_file')->store('invitations/music', 'public');
                $backgroundMusic = Storage::url($musicPath);
            }

            // Groom & Bride Photos
            $groomPhoto = $validated['groom_photo_url'] ?? null;
            if ($request->hasFile('groom_photo_file')) {
                $groomPath = $request->file('groom_photo_file')->store('invitations/couples', 'public');
                $groomPhoto = Storage::url($groomPath);
            }

            $bridePhoto = $validated['bride_photo_url'] ?? null;
            if ($request->hasFile('bride_photo_file')) {
                $bridePath = $request->file('bride_photo_file')->store('invitations/couples', 'public');
                $bridePhoto = Storage::url($bridePath);
            }

            // Slug
            $baseSlug = $request->filled('slug')
                ? $request->slug
                : ($request->groom_name.'-'.$request->bride_name);
            $slug = Invitation::generateUniqueSlug($baseSlug);

            $eventDate = $validated['event_date'] ?? $validated['akad_date'] ?? $validated['resepsi_date'] ?? now()->addMonths(2)->format('Y-m-d');

            // Create Invitation
            $invitation = Invitation::create([
                'user_id' => $user->id,
                'owner_id' => $user->id,
                'partner_id' => $user->id,
                'client_id' => $validated['client_id'] ?? null,
                'theme_id' => $theme->id,
                'title' => $validated['title'],
                'slug' => $slug,
                'event_type' => 'Pernikahan',
                'event_date' => $eventDate,
                'background_music' => $backgroundMusic,
                'quote_text' => $validated['quote_text'] ?? 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri...',
                'quote_source' => $validated['quote_source'] ?? 'QS. Ar-Rum: 21',
                'cover_image' => $coverImage,
                'is_published' => true,
                'status' => 'published',
                'published_at' => now(),
            ]);

            // Settings
            $settingMetadata = [];
            if (! empty($validated['whatsapp_template'])) {
                $settingMetadata['whatsapp_template'] = $validated['whatsapp_template'];
            }

            $invitation->setting()->create([
                'bg_music_url' => $backgroundMusic,
                'is_music_autoplay' => false,
                'quote_text' => $validated['quote_text'] ?? 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri...',
                'quote_source' => $validated['quote_source'] ?? 'QS. Ar-Rum: 21',
                'enable_comments' => true,
                'enable_rsvp' => true,
                'metadata' => $settingMetadata,
            ]);

            // Couples
            $cleanGroomIg = ! empty($validated['groom_instagram']) ? ltrim(trim($validated['groom_instagram']), '@') : null;
            $cleanBrideIg = ! empty($validated['bride_instagram']) ? ltrim(trim($validated['bride_instagram']), '@') : null;

            $invitation->couples()->create([
                'role' => 'groom',
                'full_name' => $validated['groom_name'],
                'nickname' => $validated['groom_nickname'] ?? explode(' ', trim($validated['groom_name']))[0],
                'child_number' => $validated['groom_child_order'] ?? null,
                'father_name' => $validated['groom_father'] ?? null,
                'mother_name' => $validated['groom_mother'] ?? null,
                'instagram' => $cleanGroomIg,
                'photo_url' => $groomPhoto,
                'order' => 1,
            ]);

            $invitation->couples()->create([
                'role' => 'bride',
                'full_name' => $validated['bride_name'],
                'nickname' => $validated['bride_nickname'] ?? explode(' ', trim($validated['bride_name']))[0],
                'child_number' => $validated['bride_child_order'] ?? null,
                'father_name' => $validated['bride_father'] ?? null,
                'mother_name' => $validated['bride_mother'] ?? null,
                'instagram' => $cleanBrideIg,
                'photo_url' => $bridePhoto,
                'order' => 2,
            ]);

            // Events (Akad & Resepsi)
            if (! empty($validated['akad_date']) || ! empty($validated['akad_venue'])) {
                $invitation->events()->create([
                    'title' => 'Akad Nikah',
                    'date' => $validated['akad_date'] ?? $eventDate,
                    'start_time' => $validated['akad_time'] ?? '08.00 - 10.00 WIB',
                    'timezone' => 'WIB',
                    'venue_name' => $validated['akad_venue'] ?? 'Lokasi Akad Nikah',
                    'address' => $validated['akad_address'] ?? 'Alamat Tempat Acara',
                    'maps_url' => $validated['akad_maps_link'] ?? 'https://maps.google.com/?q=Jakarta',
                    'order' => 1,
                ]);
            }

            if (! empty($validated['resepsi_date']) || ! empty($validated['resepsi_venue'])) {
                $invitation->events()->create([
                    'title' => 'Resepsi Pernikahan',
                    'date' => $validated['resepsi_date'] ?? $eventDate,
                    'start_time' => $validated['resepsi_time'] ?? '11.00 - 14.00 WIB',
                    'timezone' => 'WIB',
                    'venue_name' => $validated['resepsi_venue'] ?? 'Lokasi Resepsi',
                    'address' => $validated['resepsi_address'] ?? 'Alamat Tempat Acara',
                    'maps_url' => $validated['resepsi_maps_link'] ?? 'https://maps.google.com/?q=Jakarta',
                    'order' => 2,
                ]);
            }

            // Galleries
            $orderPos = 1;
            if ($request->hasFile('gallery_files')) {
                foreach ($request->file('gallery_files') as $file) {
                    $path = $file->store('invitations/galleries', 'public');
                    $invitation->media()->create([
                        'media_type' => 'photo',
                        'url' => Storage::url($path),
                        'order' => $orderPos++,
                    ]);
                }
            }

            if ($request->filled('gallery_urls') && is_array($request->gallery_urls)) {
                foreach ($request->gallery_urls as $gUrl) {
                    if (! empty($gUrl)) {
                        $invitation->media()->create([
                            'media_type' => 'photo',
                            'url' => $gUrl,
                            'order' => $orderPos++,
                        ]);
                    }
                }
            }

            // Wallets & Gifts
            if (! empty($validated['bank_1_name']) && ! empty($validated['bank_1_number'])) {
                $invitation->gifts()->create([
                    'gift_type' => 'bank_transfer',
                    'bank_name' => $validated['bank_1_name'],
                    'account_number' => $validated['bank_1_number'],
                    'account_name' => $validated['bank_1_holder'] ?? $validated['groom_name'],
                    'order' => 1,
                ]);
            }

            if (! empty($validated['bank_2_name']) && ! empty($validated['bank_2_number'])) {
                $invitation->gifts()->create([
                    'gift_type' => 'bank_transfer',
                    'bank_name' => $validated['bank_2_name'],
                    'account_number' => $validated['bank_2_number'],
                    'account_name' => $validated['bank_2_holder'] ?? $validated['bride_name'],
                    'order' => 2,
                ]);
            }

            if (! empty($validated['gift_address'])) {
                $invitation->gifts()->create([
                    'gift_type' => 'physical_gift',
                    'recipient_address' => $validated['gift_address'],
                    'order' => 3,
                ]);
            }

            // Stories
            if ($request->has('stories') && is_array($request->stories)) {
                $storyOrder = 1;
                foreach ($request->stories as $index => $storyData) {
                    if (! empty($storyData['title']) || ! empty($storyData['story'])) {
                        $storyImageUrl = null;
                        if ($request->hasFile("stories.{$index}.image_file")) {
                            $storyPath = $request->file("stories.{$index}.image_file")->store('invitations/stories', 'public');
                            $storyImageUrl = Storage::url($storyPath);
                        }

                        $invitation->stories()->create([
                            'title' => $storyData['title'] ?? 'Momen Berharga',
                            'date' => $storyData['date'] ?? null,
                            'story' => $storyData['story'] ?? '',
                            'image_url' => $storyImageUrl,
                            'order' => $storyOrder++,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('partner.invitations.index')->with('success', 'Undangan digital untuk klien berhasil dibuat lengkap!');
    }

    /**
     * Show form for editing an existing client invitation.
     */
    public function edit(Request $request, Invitation $invitation): View
    {
        abort_if($invitation->partner_id !== $request->user()->id && $invitation->owner_id !== $request->user()->id, 403, 'Anda tidak memiliki hak akses ke undangan ini.');

        $invitation->load(['theme', 'client', 'couples', 'events', 'media', 'gifts', 'stories', 'setting']);

        $clients = $request->user()->partnerClients()->latest()->get();
        $themes = Theme::where('is_active', true)
            ->where('is_for_partner', true)
            ->get();

        if ($invitation->theme && ! $themes->contains('id', $invitation->theme_id)) {
            $themes->prepend($invitation->theme);
        }

        $musicPresets = config('themes.music_presets', []);

        $groom = $invitation->couples->firstWhere('role', 'groom');
        $bride = $invitation->couples->firstWhere('role', 'bride');
        $akad = $invitation->events->firstWhere('title', 'Akad Nikah') ?? $invitation->events->first();
        $resepsi = $invitation->events->firstWhere('title', 'Resepsi Pernikahan') ?? $invitation->events->skip(1)->first();
        $bank1 = $invitation->gifts->where('gift_type', 'bank_transfer')->first();
        $bank2 = $invitation->gifts->where('gift_type', 'bank_transfer')->skip(1)->first();
        $giftAddress = $invitation->gifts->where('gift_type', 'physical_gift')->first()?->recipient_address;

        return view('partner.invitations.edit', compact(
            'invitation',
            'clients',
            'themes',
            'musicPresets',
            'groom',
            'bride',
            'akad',
            'resepsi',
            'bank1',
            'bank2',
            'giftAddress'
        ));
    }

    /**
     * Update existing client invitation.
     */
    public function update(Request $request, Invitation $invitation): RedirectResponse
    {
        abort_if($invitation->partner_id !== $request->user()->id && $invitation->owner_id !== $request->user()->id, 403, 'Anda tidak memiliki hak akses ke undangan ini.');

        $user = $request->user();

        $validated = $request->validate([
            'client_id' => 'nullable|exists:partner_clients,id',
            'theme_id' => 'required|exists:themes,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'is_published' => 'nullable|in:0,1',
            'event_date' => 'nullable|date',
            'quote_text' => 'nullable|string',
            'quote_source' => 'nullable|string|max:255',

            // Media & Cover
            'cover_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'cover_image_url' => 'nullable|url|max:500',
            'music_file' => 'nullable|mimes:mp3,wav,ogg,m4a|max:10240',
            'music_preset' => 'nullable|string|max:255',

            // Groom
            'groom_name' => 'required|string|max:255',
            'groom_nickname' => 'nullable|string|max:100',
            'groom_child_order' => 'nullable|string|max:100',
            'groom_father' => 'nullable|string|max:255',
            'groom_mother' => 'nullable|string|max:255',
            'groom_instagram' => 'nullable|string|max:100',
            'groom_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'groom_photo_url' => 'nullable|url|max:500',

            // Bride
            'bride_name' => 'required|string|max:255',
            'bride_nickname' => 'nullable|string|max:100',
            'bride_child_order' => 'nullable|string|max:100',
            'bride_father' => 'nullable|string|max:255',
            'bride_mother' => 'nullable|string|max:255',
            'bride_instagram' => 'nullable|string|max:100',
            'bride_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'bride_photo_url' => 'nullable|url|max:500',

            // Gallery Files
            'gallery_files' => 'nullable|array',
            'gallery_files.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'gallery_urls' => 'nullable|array',
            'gallery_urls.*' => 'nullable|string|max:500',
            'delete_media_ids' => 'nullable|array',
            'delete_media_ids.*' => 'integer',

            // Events - Akad
            'akad_date' => 'nullable|date',
            'akad_time' => 'nullable|string|max:100',
            'akad_venue' => 'nullable|string|max:255',
            'akad_address' => 'nullable|string',
            'akad_maps_link' => 'nullable|url|max:500',

            // Events - Resepsi
            'resepsi_date' => 'nullable|date',
            'resepsi_time' => 'nullable|string|max:100',
            'resepsi_venue' => 'nullable|string|max:255',
            'resepsi_address' => 'nullable|string',
            'resepsi_maps_link' => 'nullable|url|max:500',

            // Wallets & Gifts
            'bank_1_name' => 'nullable|string|max:100',
            'bank_1_number' => 'nullable|string|max:100',
            'bank_1_holder' => 'nullable|string|max:255',
            'bank_2_name' => 'nullable|string|max:100',
            'bank_2_number' => 'nullable|string|max:100',
            'bank_2_holder' => 'nullable|string|max:255',
            'gift_address' => 'nullable|string|max:1000',

            // Stories
            'stories' => 'nullable|array',
            'stories.*.title' => 'nullable|string|max:255',
            'stories.*.date' => 'nullable|string|max:100',
            'stories.*.story' => 'nullable|string',
            'stories.*.image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'stories.*.existing_image' => 'nullable|string',

            // WhatsApp Template
            'whatsapp_template' => 'nullable|string|max:2000',
        ]);

        $theme = Theme::findOrFail($validated['theme_id']);
        if ($theme->id !== $invitation->theme_id && ! $this->themeOwnershipService->canUseTheme($user, $theme)) {
            return back()->with('error', 'Template tema ini belum diaktifkan oleh Super Admin untuk Partner.');
        }

        DB::transaction(function () use ($invitation, $theme, $validated, $request) {
            // Cover Image
            $coverImage = $invitation->cover_image;
            if ($request->hasFile('cover_image_file')) {
                $coverPath = $request->file('cover_image_file')->store('invitations/covers', 'public');
                $coverImage = Storage::url($coverPath);
            } elseif (! empty($validated['cover_image_url'])) {
                $coverImage = $validated['cover_image_url'];
            }

            // Background Music
            $backgroundMusic = $invitation->background_music;
            if ($request->hasFile('music_file')) {
                $musicPath = $request->file('music_file')->store('invitations/music', 'public');
                $backgroundMusic = Storage::url($musicPath);
            } elseif (! empty($validated['music_preset'])) {
                $backgroundMusic = $validated['music_preset'];
            }

            // Groom & Bride Photos
            $groom = $invitation->couples()->where('role', 'groom')->first();
            $groomPhoto = $groom?->photo_url;
            if ($request->hasFile('groom_photo_file')) {
                $groomPath = $request->file('groom_photo_file')->store('invitations/couples', 'public');
                $groomPhoto = Storage::url($groomPath);
            } elseif (! empty($validated['groom_photo_url'])) {
                $groomPhoto = $validated['groom_photo_url'];
            }

            $bride = $invitation->couples()->where('role', 'bride')->first();
            $bridePhoto = $bride?->photo_url;
            if ($request->hasFile('bride_photo_file')) {
                $bridePath = $request->file('bride_photo_file')->store('invitations/couples', 'public');
                $bridePhoto = Storage::url($bridePath);
            } elseif (! empty($validated['bride_photo_url'])) {
                $bridePhoto = $validated['bride_photo_url'];
            }

            // Slug
            $slug = $invitation->slug;
            if ($request->filled('slug') && $request->slug !== $invitation->slug) {
                $slug = Invitation::generateUniqueSlug($request->slug, $invitation->id);
            }

            $eventDate = $validated['event_date'] ?? $validated['akad_date'] ?? $validated['resepsi_date'] ?? $invitation->event_date;
            $isPublished = $request->has('is_published') ? ((int) $request->is_published === 1) : $invitation->is_published;

            // Update Invitation
            $invitation->update([
                'client_id' => $validated['client_id'] ?? null,
                'theme_id' => $theme->id,
                'title' => $validated['title'],
                'slug' => $slug,
                'event_date' => $eventDate,
                'background_music' => $backgroundMusic,
                'quote_text' => $validated['quote_text'] ?? $invitation->quote_text,
                'quote_source' => $validated['quote_source'] ?? $invitation->quote_source,
                'cover_image' => $coverImage,
                'is_published' => $isPublished,
                'status' => $isPublished ? 'published' : 'draft',
                'published_at' => $isPublished ? ($invitation->published_at ?? now()) : null,
            ]);

            // Settings
            $settingMetadata = $invitation->setting?->metadata ?? [];
            if ($request->has('whatsapp_template')) {
                $settingMetadata['whatsapp_template'] = $validated['whatsapp_template'] ?: null;
            }

            $invitation->setting()->updateOrCreate(
                ['invitation_id' => $invitation->id],
                [
                    'bg_music_url' => $backgroundMusic,
                    'quote_text' => $validated['quote_text'] ?? $invitation->quote_text,
                    'quote_source' => $validated['quote_source'] ?? $invitation->quote_source,
                    'metadata' => $settingMetadata,
                ]
            );

            // Couples
            $cleanGroomIg = ! empty($validated['groom_instagram']) ? ltrim(trim($validated['groom_instagram']), '@') : null;
            $cleanBrideIg = ! empty($validated['bride_instagram']) ? ltrim(trim($validated['bride_instagram']), '@') : null;

            $invitation->couples()->updateOrCreate(
                ['role' => 'groom'],
                [
                    'full_name' => $validated['groom_name'],
                    'nickname' => $validated['groom_nickname'] ?? explode(' ', trim($validated['groom_name']))[0],
                    'child_number' => $validated['groom_child_order'] ?? null,
                    'father_name' => $validated['groom_father'] ?? null,
                    'mother_name' => $validated['groom_mother'] ?? null,
                    'instagram' => $cleanGroomIg,
                    'photo_url' => $groomPhoto,
                    'order' => 1,
                ]
            );

            $invitation->couples()->updateOrCreate(
                ['role' => 'bride'],
                [
                    'full_name' => $validated['bride_name'],
                    'nickname' => $validated['bride_nickname'] ?? explode(' ', trim($validated['bride_name']))[0],
                    'child_number' => $validated['bride_child_order'] ?? null,
                    'father_name' => $validated['bride_father'] ?? null,
                    'mother_name' => $validated['bride_mother'] ?? null,
                    'instagram' => $cleanBrideIg,
                    'photo_url' => $bridePhoto,
                    'order' => 2,
                ]
            );

            // Events (Akad & Resepsi)
            if (! empty($validated['akad_date']) || ! empty($validated['akad_venue'])) {
                $invitation->events()->updateOrCreate(
                    ['order' => 1],
                    [
                        'title' => 'Akad Nikah',
                        'date' => $validated['akad_date'] ?? $eventDate,
                        'start_time' => $validated['akad_time'] ?? '08.00 - 10.00 WIB',
                        'timezone' => 'WIB',
                        'venue_name' => $validated['akad_venue'] ?? 'Lokasi Akad Nikah',
                        'address' => $validated['akad_address'] ?? 'Alamat Tempat Acara',
                        'maps_url' => $validated['akad_maps_link'] ?? 'https://maps.google.com/?q=Jakarta',
                    ]
                );
            }

            if (! empty($validated['resepsi_date']) || ! empty($validated['resepsi_venue'])) {
                $invitation->events()->updateOrCreate(
                    ['order' => 2],
                    [
                        'title' => 'Resepsi Pernikahan',
                        'date' => $validated['resepsi_date'] ?? $eventDate,
                        'start_time' => $validated['resepsi_time'] ?? '11.00 - 14.00 WIB',
                        'timezone' => 'WIB',
                        'venue_name' => $validated['resepsi_venue'] ?? 'Lokasi Resepsi',
                        'address' => $validated['resepsi_address'] ?? 'Alamat Tempat Acara',
                        'maps_url' => $validated['resepsi_maps_link'] ?? 'https://maps.google.com/?q=Jakarta',
                    ]
                );
            }

            // Media deletions
            if (! empty($validated['delete_media_ids'])) {
                $invitation->media()->whereIn('id', $validated['delete_media_ids'])->delete();
            }

            // New Galleries
            $currentMaxOrder = (int) $invitation->media()->max('order');
            if ($request->hasFile('gallery_files')) {
                foreach ($request->file('gallery_files') as $file) {
                    $path = $file->store('invitations/galleries', 'public');
                    $invitation->media()->create([
                        'media_type' => 'photo',
                        'url' => Storage::url($path),
                        'order' => ++$currentMaxOrder,
                    ]);
                }
            }

            if ($request->filled('gallery_urls') && is_array($request->gallery_urls)) {
                foreach ($request->gallery_urls as $gUrl) {
                    if (! empty($gUrl)) {
                        $invitation->media()->create([
                            'media_type' => 'photo',
                            'url' => $gUrl,
                            'order' => ++$currentMaxOrder,
                        ]);
                    }
                }
            }

            // Wallets & Gifts
            $invitation->gifts()->delete();
            if (! empty($validated['bank_1_name']) && ! empty($validated['bank_1_number'])) {
                $invitation->gifts()->create([
                    'gift_type' => 'bank_transfer',
                    'bank_name' => $validated['bank_1_name'],
                    'account_number' => $validated['bank_1_number'],
                    'account_name' => $validated['bank_1_holder'] ?? $validated['groom_name'],
                    'order' => 1,
                ]);
            }

            if (! empty($validated['bank_2_name']) && ! empty($validated['bank_2_number'])) {
                $invitation->gifts()->create([
                    'gift_type' => 'bank_transfer',
                    'bank_name' => $validated['bank_2_name'],
                    'account_number' => $validated['bank_2_number'],
                    'account_name' => $validated['bank_2_holder'] ?? $validated['bride_name'],
                    'order' => 2,
                ]);
            }

            if (! empty($validated['gift_address'])) {
                $invitation->gifts()->create([
                    'gift_type' => 'physical_gift',
                    'recipient_address' => $validated['gift_address'],
                    'order' => 3,
                ]);
            }

            // Stories
            if ($request->has('stories') && is_array($request->stories)) {
                $invitation->stories()->delete();
                $storyOrder = 1;
                foreach ($request->stories as $index => $storyData) {
                    if (! empty($storyData['title']) || ! empty($storyData['story'])) {
                        $storyImageUrl = $storyData['existing_image'] ?? null;
                        if ($request->hasFile("stories.{$index}.image_file")) {
                            $storyPath = $request->file("stories.{$index}.image_file")->store('invitations/stories', 'public');
                            $storyImageUrl = Storage::url($storyPath);
                        }

                        $invitation->stories()->create([
                            'title' => $storyData['title'] ?? 'Momen Berharga',
                            'date' => $storyData['date'] ?? null,
                            'story' => $storyData['story'] ?? '',
                            'image_url' => $storyImageUrl,
                            'order' => $storyOrder++,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('partner.invitations.index')->with('success', 'Undangan digital untuk klien berhasil diperbarui!');
    }

    /**
     * Delete an invitation.
     */
    public function destroy(Request $request, Invitation $invitation): RedirectResponse
    {
        abort_if($invitation->partner_id !== $request->user()->id && $invitation->owner_id !== $request->user()->id, 403);

        $invitation->delete();

        return redirect()->route('partner.invitations.index')->with('success', 'Undangan berhasil dihapus.');
    }
}
