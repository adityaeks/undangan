<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Theme;
use App\Models\UserTheme;
use App\Services\ThemeOwnershipService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InvitationController extends Controller
{
    public function __construct(
        protected ThemeOwnershipService $themeOwnershipService,
    ) {}

    /**
     * Display a listing of member invitations.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $query = $user->invitations()
            ->with(['theme', 'couples', 'guests', 'events', 'media'])
            ->withCount(['guests', 'wishes']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        $invitations = $query->latest()->paginate(10);
        $totalActive = $user->invitations()->where('is_published', true)->count();
        $totalDraft = $user->invitations()->where('is_published', false)->count();

        // Hitung sisa kuota tema (1 tema = 1 undangan)
        $accessibleThemeIds = $this->themeOwnershipService->getUserOwnedThemeIds($user);
        $usedThemeIds = $user->invitations()->pluck('theme_id')->toArray();
        $availableThemesCount = count(array_diff($accessibleThemeIds, $usedThemeIds));

        return view('member.invitations.index', compact('invitations', 'totalActive', 'totalDraft', 'availableThemesCount'));
    }

    /**
     * Show the form for creating a new invitation.
     */
    public function create(Request $request): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            $themes = Theme::where('is_active', true)->get();
            $usedThemeIds = [];
        } else {
            $availableThemeIds = $this->themeOwnershipService->getUserAvailableThemeIdsForNewInvitation($user);
            $usedThemeIds = $user->invitations()->pluck('theme_id')->toArray();

            // Tema yang tersedia adalah tema aktif & belum kedaluwarsa milik user yang masih memiliki lisensi belum terpakai (atau gratis)
            $themes = Theme::where('is_active', true)
                ->whereIn('id', $availableThemeIds)
                ->get();
        }

        if ($request->filled('theme_id')) {
            $requestedThemeId = (int) $request->query('theme_id');
            if (! $themes->pluck('id')->contains($requestedThemeId)) {
                $requestedTheme = Theme::find($requestedThemeId);
                if ($requestedTheme) {
                    $isExpired = UserTheme::where('user_id', $user->id)
                        ->where('theme_id', $requestedTheme->id)
                        ->where('expires_at', '<=', now())
                        ->exists();

                    if ($isExpired) {
                        return redirect()->route('checkout.theme', $requestedTheme)
                            ->with('warning', 'Masa aktif lisensi tema "'.$requestedTheme->name.'" telah kedaluwarsa. Silakan beli lisensi baru untuk menggunakannya.');
                    }

                    if ($this->themeOwnershipService->getUsedLicensesCount($user, $requestedTheme) > 0) {
                        return redirect()->route('checkout.theme', ['theme' => $requestedTheme->id, 'additional' => 1])
                            ->with('warning', 'Semua lisensi tema "'.$requestedTheme->name.'" sudah digunakan. Silakan beli lisensi tambahan untuk membuat undangan baru.');
                    }
                }
            }
        }

        $musicPresets = config('themes.music_presets', []);

        return view('member.invitations.create', compact('themes', 'musicPresets', 'usedThemeIds'));
    }

    /**
     * Store a newly created invitation in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
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
            'music_preset' => 'nullable|string|max:500',
            'music_url' => 'nullable|url|max:500',

            // Groom
            'groom_name' => 'required|string|max:255',
            'groom_nickname' => 'required|string|max:100',
            'groom_child_order' => 'nullable|string|max:100',
            'groom_father' => 'nullable|string|max:255',
            'groom_mother' => 'nullable|string|max:255',
            'groom_instagram' => 'nullable|string|max:100',
            'groom_photo_files' => 'nullable|array|max:5',
            'groom_photo_files.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'existing_groom_photo_urls' => 'nullable|array',
            'existing_groom_photo_urls.*' => 'nullable|string|max:500',
            'groom_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'groom_photo_url' => 'nullable|url|max:500',

            // Bride
            'bride_name' => 'required|string|max:255',
            'bride_nickname' => 'required|string|max:100',
            'bride_child_order' => 'nullable|string|max:100',
            'bride_father' => 'nullable|string|max:255',
            'bride_mother' => 'nullable|string|max:255',
            'bride_instagram' => 'nullable|string|max:100',
            'bride_photo_files' => 'nullable|array|max:5',
            'bride_photo_files.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'existing_bride_photo_urls' => 'nullable|array',
            'existing_bride_photo_urls.*' => 'nullable|string|max:500',
            'bride_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'bride_photo_url' => 'nullable|url|max:500',

            // Gallery Files
            'gallery_files' => 'nullable|array',
            'gallery_files.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'gallery_urls' => 'nullable|array',
            'gallery_urls.*' => 'nullable|string|max:500',

            // Events - Akad
            'akad_date' => 'required|date',
            'akad_time' => 'nullable|string|max:100',
            'akad_start_time' => 'nullable|string|max:50',
            'akad_end_time' => 'nullable|string|max:50',
            'akad_timezone' => 'nullable|string|max:10',
            'akad_venue' => 'required|string|max:255',
            'akad_address' => 'required|string',
            'akad_maps_link' => 'nullable|url|max:500',

            // Events - Resepsi
            'resepsi_date' => 'required|date',
            'resepsi_time' => 'nullable|string|max:100',
            'resepsi_start_time' => 'nullable|string|max:50',
            'resepsi_end_time' => 'nullable|string|max:50',
            'resepsi_timezone' => 'nullable|string|max:10',
            'resepsi_venue' => 'required|string|max:255',
            'resepsi_address' => 'required|string',
            'resepsi_maps_link' => 'nullable|url|max:500',

            // Wallets
            'bank_1_name' => 'nullable|string|max:100',
            'bank_1_number' => 'nullable|string|max:100',
            'bank_1_account' => 'nullable|string|max:100',
            'bank_1_holder' => 'nullable|string|max:255',
            'bank_1_qris_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'bank_1_existing_qris' => 'nullable|string|max:500',

            'bank_2_name' => 'nullable|string|max:100',
            'bank_2_number' => 'nullable|string|max:100',
            'bank_2_account' => 'nullable|string|max:100',
            'bank_2_holder' => 'nullable|string|max:255',
            'bank_2_qris_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'bank_2_existing_qris' => 'nullable|string|max:500',

            'gift_address' => 'nullable|string|max:1000',

            // Stories (Kisah Perjalanan)
            'stories' => 'nullable|array',
            'stories.*.title' => 'nullable|string|max:255',
            'stories.*.date' => 'nullable|string|max:100',
            'stories.*.story' => 'nullable|string',
            'stories.*.image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',

            // WhatsApp Template
            'whatsapp_template' => 'nullable|string|max:2000',
        ]);

        $theme = Theme::findOrFail($validated['theme_id']);
        if (! $this->themeOwnershipService->canUseThemeForInvitation($user, $theme)) {
            if ($user->invitations()->where('theme_id', $theme->id)->exists()) {
                return redirect()->route('member.invitations.create')
                    ->withInput()
                    ->with('error', 'Tema "'.$theme->name.'" sudah digunakan untuk undangan Anda yang lain. Setiap lisensi tema hanya berlaku untuk 1 undangan.');
            }

            $isExpired = UserTheme::where('user_id', $user->id)
                ->where('theme_id', $theme->id)
                ->where('expires_at', '<=', now())
                ->exists();

            if ($isExpired) {
                return redirect()->route('checkout.theme', $theme)
                    ->with('warning', 'Masa aktif lisensi tema "'.$theme->name.'" telah kedaluwarsa. Silakan beli lisensi baru untuk dapat menggunakannya kembali.');
            }

            return redirect()->route('checkout.theme', $theme)
                ->with('warning', 'Template ini berbayar. Silakan lakukan aktivasi template terlebih dahulu.');
        }

        // Cover Images (Multiple or Single)
        $coverUrls = [];
        if ($request->hasFile('cover_image_files')) {
            foreach ($request->file('cover_image_files') as $cFile) {
                $path = upload_as_webp($cFile, 'invitations/covers');
                $coverUrls[] = Storage::url($path);
            }
        } elseif ($request->hasFile('cover_image_file')) {
            $path = upload_as_webp($request->file('cover_image_file'), 'invitations/covers');
            $coverUrls[] = Storage::url($path);
        }

        if ($request->filled('existing_cover_urls') && is_array($request->existing_cover_urls)) {
            foreach ($request->existing_cover_urls as $eUrl) {
                if (! empty($eUrl)) {
                    $coverUrls[] = $eUrl;
                }
            }
        } elseif ($request->filled('cover_image_url')) {
            $coverUrls[] = $request->cover_image_url;
        }

        $coverImage = $coverUrls[0] ?? null;

        // Background Music
        if ($request->hasFile('music_file')) {
            $musicPath = $request->file('music_file')->store('invitations/music', 'public');
            $backgroundMusic = Storage::url($musicPath);
        } elseif ($request->filled('music_url')) {
            $backgroundMusic = $validated['music_url'];
        } else {
            $backgroundMusic = $validated['music_preset'] ?? '/audio/wedding-song.mp3';
        }

        // Groom Photos (Multi-photo handling)
        $groomPhotos = [];
        if (! empty($validated['existing_groom_photo_urls'])) {
            foreach ($validated['existing_groom_photo_urls'] as $url) {
                if (! empty($url)) {
                    $groomPhotos[] = $url;
                }
            }
        }
        if ($request->hasFile('groom_photo_files')) {
            foreach ($request->file('groom_photo_files') as $file) {
                if ($file && $file->isValid()) {
                    $path = upload_as_webp($file, 'invitations/couples');
                    $groomPhotos[] = Storage::url($path);
                }
            }
        } elseif ($request->hasFile('groom_photo_file')) {
            $path = upload_as_webp($request->file('groom_photo_file'), 'invitations/couples');
            $groomPhotos[] = Storage::url($path);
        } elseif (! empty($validated['groom_photo_url'])) {
            $groomPhotos[] = $validated['groom_photo_url'];
        }
        $groomPhoto = $groomPhotos[0] ?? null;

        // Bride Photos (Multi-photo handling)
        $bridePhotos = [];
        if (! empty($validated['existing_bride_photo_urls'])) {
            foreach ($validated['existing_bride_photo_urls'] as $url) {
                if (! empty($url)) {
                    $bridePhotos[] = $url;
                }
            }
        }
        if ($request->hasFile('bride_photo_files')) {
            foreach ($request->file('bride_photo_files') as $file) {
                if ($file && $file->isValid()) {
                    $path = upload_as_webp($file, 'invitations/couples');
                    $bridePhotos[] = Storage::url($path);
                }
            }
        } elseif ($request->hasFile('bride_photo_file')) {
            $path = upload_as_webp($request->file('bride_photo_file'), 'invitations/couples');
            $bridePhotos[] = Storage::url($path);
        } elseif (! empty($validated['bride_photo_url'])) {
            $bridePhotos[] = $validated['bride_photo_url'];
        }
        $bridePhoto = $bridePhotos[0] ?? null;

        // Generate clean unique slug
        $baseSlug = $request->filled('slug')
            ? $request->slug
            : ($request->groom_nickname.'-'.$request->bride_nickname);
        $slug = Invitation::generateUniqueSlug($baseSlug);

        // Create Invitation
        $invitation = Invitation::create([
            'user_id' => $user->id,
            'owner_id' => $user->id,
            'theme_id' => $theme->id,
            'title' => $validated['title'],
            'slug' => $slug,
            'event_type' => 'Pernikahan',
            'event_date' => $validated['akad_date'],
            'background_music' => $backgroundMusic,
            'quote_text' => $validated['quote_text'] ?? 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
            'quote_source' => $validated['quote_source'] ?? 'QS. Ar-Rum: 21',
            'cover_image' => $coverImage,
            'is_published' => true,
            'status' => 'published',
            'published_at' => now(),
        ]);

        // Assign available theme license to this invitation
        $assignedLicense = $this->themeOwnershipService->assignThemeLicenseToInvitation($user, $theme, $invitation);
        if ($assignedLicense && $assignedLicense->expires_at) {
            $invitation->update(['expires_at' => $assignedLicense->expires_at]);
        }

        // Settings
        $settingMetadata = [];
        if (! empty($validated['whatsapp_template'])) {
            $settingMetadata['whatsapp_template'] = $validated['whatsapp_template'];
        }

        $invitation->setting()->create([
            'bg_music_url' => $backgroundMusic,
            'is_music_autoplay' => false,
            'quote_text' => $validated['quote_text'] ?? 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
            'quote_source' => $validated['quote_source'] ?? 'QS. Ar-Rum: 21',
            'enable_comments' => true,
            'enable_rsvp' => true,
            'metadata' => $settingMetadata,
        ]);

        // Couple (Groom & Bride rows)
        $cleanGroomIg = ! empty($validated['groom_instagram']) ? ltrim(trim($validated['groom_instagram']), '@') : null;
        $cleanBrideIg = ! empty($validated['bride_instagram']) ? ltrim(trim($validated['bride_instagram']), '@') : null;

        $invitation->couples()->create([
            'role' => 'groom',
            'full_name' => $validated['groom_name'],
            'nickname' => $validated['groom_nickname'],
            'child_number' => $request->input('groom_child_order'),
            'father_name' => $validated['groom_father'] ?? null,
            'mother_name' => $validated['groom_mother'] ?? null,
            'instagram' => $cleanGroomIg,
            'photo_url' => $groomPhoto,
            'order' => 1,
        ]);

        $invitation->couples()->create([
            'role' => 'bride',
            'full_name' => $validated['bride_name'],
            'nickname' => $validated['bride_nickname'],
            'child_number' => $request->input('bride_child_order'),
            'father_name' => $validated['bride_father'] ?? null,
            'mother_name' => $validated['bride_mother'] ?? null,
            'instagram' => $cleanBrideIg,
            'photo_url' => $bridePhoto,
            'order' => 2,
        ]);

        // Events
        $akadStartTime = $request->input('akad_start_time') ?: ($validated['akad_time'] ?? '08:00');
        $akadEndTime = $request->boolean('akad_is_until_finish') ? 'Selesai' : ($request->input('akad_end_time') ?: null);
        $akadTz = $request->input('akad_timezone') ?: 'WIB';

        $invitation->events()->create([
            'title' => 'Akad Nikah',
            'date' => $validated['akad_date'],
            'start_time' => $akadStartTime,
            'end_time' => $akadEndTime,
            'timezone' => $akadTz,
            'venue_name' => $validated['akad_venue'],
            'address' => $validated['akad_address'],
            'maps_url' => $validated['akad_maps_link'] ?? 'https://maps.google.com/?q=Jakarta',
            'order' => 1,
        ]);

        $resepsiStartTime = $request->input('resepsi_start_time') ?: ($validated['resepsi_time'] ?? '11:00');
        $resepsiEndTime = $request->boolean('resepsi_is_until_finish') ? 'Selesai' : ($request->input('resepsi_end_time') ?: null);
        $resepsiTz = $request->input('resepsi_timezone') ?: 'WIB';

        $invitation->events()->create([
            'title' => 'Resepsi Pernikahan',
            'date' => $validated['resepsi_date'],
            'start_time' => $resepsiStartTime,
            'end_time' => $resepsiEndTime,
            'timezone' => $resepsiTz,
            'venue_name' => $validated['resepsi_venue'],
            'address' => $validated['resepsi_address'],
            'maps_url' => $validated['resepsi_maps_link'] ?? 'https://maps.google.com/?q=Jakarta',
            'order' => 2,
        ]);

        // Cover Media Entries
        $coverOrder = 1;
        foreach ($coverUrls as $cUrl) {
            $invitation->media()->create([
                'media_type' => 'cover',
                'url' => $cUrl,
                'order' => $coverOrder++,
            ]);
        }

        // Groom Media Entries
        $groomOrder = 1;
        foreach ($groomPhotos as $gPhoto) {
            $invitation->media()->create([
                'media_type' => 'groom',
                'url' => $gPhoto,
                'order' => $groomOrder++,
            ]);
        }

        // Bride Media Entries
        $brideOrder = 1;
        foreach ($bridePhotos as $bPhoto) {
            $invitation->media()->create([
                'media_type' => 'bride',
                'url' => $bPhoto,
                'order' => $brideOrder++,
            ]);
        }

        // Galleries
        $orderPos = 1;
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $path = upload_as_webp($file, 'invitations/galleries');
                $invitation->media()->create([
                    'media_type' => 'photo',
                    'url' => Storage::url($path),
                    'order' => $orderPos++,
                ]);
            }
        }

        $existingUrls = array_merge(
            (array) $request->input('existing_gallery_urls', []),
            (array) $request->input('gallery_urls', [])
        );
        foreach ($existingUrls as $gUrl) {
            if (! empty($gUrl)) {
                $invitation->media()->create([
                    'media_type' => 'photo',
                    'url' => $gUrl,
                    'order' => $orderPos++,
                ]);
            }
        }

        if ($invitation->media()->count() === 0) {
            $defaultGalleries = [
                'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&auto=format&fit=crop&q=80',
            ];
            foreach ($defaultGalleries as $photoUrl) {
                $invitation->media()->create([
                    'media_type' => 'photo',
                    'url' => $photoUrl,
                    'order' => $orderPos++,
                ]);
            }
        }

        // Gifts / Wallets
        $bank1Number = $validated['bank_1_number'] ?? $validated['bank_1_account'] ?? $request->input('bank_1_number') ?? $request->input('bank_1_account');
        if (! empty($validated['bank_1_name']) && ! empty($bank1Number)) {
            $qris1 = $request->input('bank_1_existing_qris');
            if ($request->hasFile('bank_1_qris_file')) {
                $path1 = upload_as_webp($request->file('bank_1_qris_file'), 'invitations/qris');
                $qris1 = Storage::url($path1);
            }

            $invitation->gifts()->create([
                'gift_type' => 'bank_transfer',
                'bank_name' => $validated['bank_1_name'],
                'account_number' => $bank1Number,
                'account_name' => $validated['bank_1_holder'] ?? $validated['groom_name'] ?? 'Pengantin Pria',
                'qr_code_url' => $qris1,
                'qris_image' => $qris1,
                'order' => 1,
            ]);
        }

        $bank2Number = $validated['bank_2_number'] ?? $validated['bank_2_account'] ?? $request->input('bank_2_number') ?? $request->input('bank_2_account');
        if (! empty($validated['bank_2_name']) && ! empty($bank2Number)) {
            $qris2 = $request->input('bank_2_existing_qris');
            if ($request->hasFile('bank_2_qris_file')) {
                $path2 = upload_as_webp($request->file('bank_2_qris_file'), 'invitations/qris');
                $qris2 = Storage::url($path2);
            }

            $invitation->gifts()->create([
                'gift_type' => 'bank_transfer',
                'bank_name' => $validated['bank_2_name'],
                'account_number' => $bank2Number,
                'account_name' => $validated['bank_2_holder'] ?? $validated['bride_name'] ?? 'Pengantin Wanita',
                'qr_code_url' => $qris2,
                'qris_image' => $qris2,
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

        // Stories (Kisah Perjalanan)
        if ($request->has('stories') && is_array($request->stories)) {
            $storyOrder = 1;
            foreach ($request->stories as $index => $storyData) {
                if (! empty($storyData['title']) || ! empty($storyData['story'])) {
                    $storyImageUrl = null;
                    if ($request->hasFile("stories.{$index}.image_file")) {
                        $storyPath = upload_as_webp($request->file("stories.{$index}.image_file"), 'invitations/stories');
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

        return redirect()->route('member.invitations.index')
            ->with('success', 'Selamat! Undangan pernikahan "'.$invitation->title.'" berhasil disimpan dan diterbitkan.');
    }

    /**
     * Show the form for editing an existing invitation.
     */
    public function edit(Request $request, Invitation $invitation): View
    {
        $user = $request->user();
        if ($invitation->owner_id !== $user->id && $invitation->user_id !== $user->id && ! $user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses ke undangan ini.');
        }

        $invitation->load(['theme', 'couples', 'events', 'media', 'gifts', 'stories', 'setting']);

        if ($user->isSuperAdmin()) {
            $themes = Theme::where('is_active', true)->get();
            $usedThemeIds = [];
        } else {
            $availableThemeIds = $this->themeOwnershipService->getUserAvailableThemeIdsForNewInvitation($user);
            $usedThemeIds = $user->invitations()->pluck('theme_id')->toArray();

            $themes = Theme::where('is_active', true)
                ->where(function ($q) use ($availableThemeIds, $invitation) {
                    $q->whereIn('id', $availableThemeIds)
                        ->orWhere('id', $invitation->theme_id);
                })
                ->get();
        }

        if ($invitation->theme && ! $themes->contains('id', $invitation->theme_id)) {
            $themes->prepend($invitation->theme);
        }

        $musicPresets = config('themes.music_presets', []);

        return view('member.invitations.edit', compact('invitation', 'themes', 'musicPresets', 'usedThemeIds'));
    }

    /**
     * Update an existing invitation (slug remains unchanged).
     */
    public function update(Request $request, Invitation $invitation): RedirectResponse
    {
        $user = $request->user();
        if ($invitation->owner_id !== $user->id && $invitation->user_id !== $user->id && ! $user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses ke undangan ini.');
        }

        $validated = $request->validate([
            'theme_id' => 'nullable|exists:themes,id',
            'title' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'quote_text' => 'nullable|string',
            'quote_source' => 'nullable|string|max:255',
            'is_published' => 'nullable|in:0,1',

            // Media & Cover
            'cover_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'cover_image_files' => 'nullable|array|max:5',
            'cover_image_files.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'existing_cover_urls' => 'nullable|array',
            'existing_cover_urls.*' => 'nullable|string|max:500',
            'cover_image_url' => 'nullable|url|max:500',
            'music_file' => 'nullable|mimes:mp3,wav,ogg,m4a|max:10240',
            'music_preset' => 'nullable|string|max:500',
            'music_url' => 'nullable|url|max:500',

            // Groom
            'groom_name' => 'required|string|max:255',
            'groom_nickname' => 'required|string|max:100',
            'groom_child_order' => 'nullable|string|max:100',
            'groom_father' => 'nullable|string|max:255',
            'groom_mother' => 'nullable|string|max:255',
            'groom_instagram' => 'nullable|string|max:100',
            'groom_photo_files' => 'nullable|array|max:5',
            'groom_photo_files.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'existing_groom_photo_urls' => 'nullable|array',
            'existing_groom_photo_urls.*' => 'nullable|string|max:500',
            'groom_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'groom_photo_url' => 'nullable|url|max:500',

            // Bride
            'bride_name' => 'required|string|max:255',
            'bride_nickname' => 'required|string|max:100',
            'bride_child_order' => 'nullable|string|max:100',
            'bride_father' => 'nullable|string|max:255',
            'bride_mother' => 'nullable|string|max:255',
            'bride_instagram' => 'nullable|string|max:100',
            'bride_photo_files' => 'nullable|array|max:5',
            'bride_photo_files.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'existing_bride_photo_urls' => 'nullable|array',
            'existing_bride_photo_urls.*' => 'nullable|string|max:500',
            'bride_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'bride_photo_url' => 'nullable|url|max:500',

            // Gallery Files
            'gallery_files' => 'nullable|array',
            'gallery_files.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'existing_gallery_urls' => 'nullable|array',
            'existing_gallery_urls.*' => 'nullable|string|max:500',
            'gallery_urls' => 'nullable|array',
            'gallery_urls.*' => 'nullable|string|max:500',

            // Events - Akad
            'akad_date' => 'required|date',
            'akad_time' => 'nullable|string|max:100',
            'akad_start_time' => 'nullable|string|max:50',
            'akad_end_time' => 'nullable|string|max:50',
            'akad_timezone' => 'nullable|string|max:10',
            'akad_venue' => 'required|string|max:255',
            'akad_address' => 'required|string',
            'akad_maps_link' => 'nullable|url|max:500',

            // Events - Resepsi
            'resepsi_date' => 'required|date',
            'resepsi_time' => 'nullable|string|max:100',
            'resepsi_start_time' => 'nullable|string|max:50',
            'resepsi_end_time' => 'nullable|string|max:50',
            'resepsi_timezone' => 'nullable|string|max:10',
            'resepsi_venue' => 'required|string|max:255',
            'resepsi_address' => 'required|string',
            'resepsi_maps_link' => 'nullable|url|max:500',

            // Wallets
            'bank_1_name' => 'nullable|string|max:100',
            'bank_1_number' => 'nullable|string|max:100',
            'bank_1_account' => 'nullable|string|max:100',
            'bank_1_holder' => 'nullable|string|max:255',
            'bank_1_qris_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'bank_1_existing_qris' => 'nullable|string|max:500',

            'bank_2_name' => 'nullable|string|max:100',
            'bank_2_number' => 'nullable|string|max:100',
            'bank_2_account' => 'nullable|string|max:100',
            'bank_2_holder' => 'nullable|string|max:255',
            'bank_2_qris_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'bank_2_existing_qris' => 'nullable|string|max:500',

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

        // Tema TIDAK BOLEH BERUBAH (tetap memakai tema lama yang sudah terikat lisensi undangan)
        $theme = $invitation->theme ?? Theme::findOrFail($invitation->theme_id);

        DB::transaction(function () use ($invitation, $validated, $request) {

            // Cover Images
            $coverUrls = [];
            if ($request->hasFile('cover_image_files')) {
                foreach ($request->file('cover_image_files') as $cFile) {
                    $path = upload_as_webp($cFile, 'invitations/covers');
                    $coverUrls[] = Storage::url($path);
                }
            } elseif ($request->hasFile('cover_image_file')) {
                $path = upload_as_webp($request->file('cover_image_file'), 'invitations/covers');
                $coverUrls[] = Storage::url($path);
            }

            if ($request->filled('existing_cover_urls') && is_array($request->existing_cover_urls)) {
                foreach ($request->existing_cover_urls as $eUrl) {
                    if (! empty($eUrl)) {
                        $coverUrls[] = $eUrl;
                    }
                }
            } elseif ($request->filled('cover_image_url')) {
                $coverUrls[] = $request->cover_image_url;
            }

            if (empty($coverUrls) && $invitation->cover_image) {
                $coverUrls[] = $invitation->cover_image;
            }
            $coverImage = $coverUrls[0] ?? $invitation->cover_image;

            // Background Music
            $backgroundMusic = $invitation->background_music;
            if ($request->hasFile('music_file')) {
                delete_storage_file($invitation->background_music);
                $musicPath = $request->file('music_file')->store('invitations/music', 'public');
                $backgroundMusic = Storage::url($musicPath);
            } elseif ($request->filled('music_url')) {
                $backgroundMusic = $validated['music_url'];
            } elseif (! empty($validated['music_preset'])) {
                $backgroundMusic = $validated['music_preset'];
            }

            // Groom Photos
            $groom = $invitation->couples()->where('role', 'groom')->first();
            $groomPhotos = [];
            if (! empty($validated['existing_groom_photo_urls'])) {
                foreach ($validated['existing_groom_photo_urls'] as $url) {
                    if (! empty($url)) {
                        $groomPhotos[] = $url;
                    }
                }
            }
            if ($request->hasFile('groom_photo_files')) {
                foreach ($request->file('groom_photo_files') as $file) {
                    if ($file && $file->isValid()) {
                        $path = upload_as_webp($file, 'invitations/couples');
                        $groomPhotos[] = Storage::url($path);
                    }
                }
            } elseif ($request->hasFile('groom_photo_file')) {
                delete_storage_file($groom?->photo_url);
                $groomPath = upload_as_webp($request->file('groom_photo_file'), 'invitations/couples');
                $groomPhotos[] = Storage::url($groomPath);
            } elseif (! empty($validated['groom_photo_url'])) {
                $groomPhotos[] = $validated['groom_photo_url'];
            }
            if (empty($groomPhotos) && $groom?->photo_url) {
                $groomPhotos[] = $groom->photo_url;
            }
            $groomPhoto = $groomPhotos[0] ?? $groom?->photo_url;

            // Bride Photos
            $bride = $invitation->couples()->where('role', 'bride')->first();
            $bridePhotos = [];
            if (! empty($validated['existing_bride_photo_urls'])) {
                foreach ($validated['existing_bride_photo_urls'] as $url) {
                    if (! empty($url)) {
                        $bridePhotos[] = $url;
                    }
                }
            }
            if ($request->hasFile('bride_photo_files')) {
                foreach ($request->file('bride_photo_files') as $file) {
                    if ($file && $file->isValid()) {
                        $path = upload_as_webp($file, 'invitations/couples');
                        $bridePhotos[] = Storage::url($path);
                    }
                }
            } elseif ($request->hasFile('bride_photo_file')) {
                delete_storage_file($bride?->photo_url);
                $bridePath = upload_as_webp($request->file('bride_photo_file'), 'invitations/couples');
                $bridePhotos[] = Storage::url($bridePath);
            } elseif (! empty($validated['bride_photo_url'])) {
                $bridePhotos[] = $validated['bride_photo_url'];
            }
            if (empty($bridePhotos) && $bride?->photo_url) {
                $bridePhotos[] = $bride->photo_url;
            }
            $bridePhoto = $bridePhotos[0] ?? $bride?->photo_url;

            // Slug TIDAK BOLEH BERUBAH (tetap memakai slug lama)
            $slug = $invitation->slug;

            $isPublished = $request->has('is_published') ? ((int) $request->is_published === 1) : $invitation->is_published;

            // Update Invitation Model
            $invitation->update([
                'theme_id' => $invitation->theme_id, // tema tetap tidak berubah
                'title' => $validated['title'],
                'slug' => $slug, // slug tetap tidak berubah
                'event_date' => $validated['akad_date'] ?? $validated['resepsi_date'] ?? $invitation->event_date,
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
            if (! empty($validated['whatsapp_template'])) {
                $settingMetadata['whatsapp_template'] = $validated['whatsapp_template'];
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

            // Couples (Groom & Bride)
            $cleanGroomIg = ! empty($validated['groom_instagram']) ? ltrim(trim($validated['groom_instagram']), '@') : null;
            $cleanBrideIg = ! empty($validated['bride_instagram']) ? ltrim(trim($validated['bride_instagram']), '@') : null;

            $invitation->couples()->updateOrCreate(
                ['role' => 'groom'],
                [
                    'full_name' => $validated['groom_name'],
                    'nickname' => $validated['groom_nickname'],
                    'child_number' => $request->input('groom_child_order'),
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
                    'nickname' => $validated['bride_nickname'],
                    'child_number' => $request->input('bride_child_order'),
                    'father_name' => $validated['bride_father'] ?? null,
                    'mother_name' => $validated['bride_mother'] ?? null,
                    'instagram' => $cleanBrideIg,
                    'photo_url' => $bridePhoto,
                    'order' => 2,
                ]
            );

            // Events (Akad & Resepsi)
            $akadStartTime = $request->input('akad_start_time') ?: ($validated['akad_time'] ?? '08:00');
            $akadEndTime = $request->boolean('akad_is_until_finish') ? 'Selesai' : ($request->input('akad_end_time') ?: null);
            $akadTz = $request->input('akad_timezone') ?: 'WIB';

            $invitation->events()->updateOrCreate(
                ['order' => 1],
                [
                    'title' => 'Akad Nikah',
                    'date' => $validated['akad_date'],
                    'start_time' => $akadStartTime,
                    'end_time' => $akadEndTime,
                    'timezone' => $akadTz,
                    'venue_name' => $validated['akad_venue'],
                    'address' => $validated['akad_address'],
                    'maps_url' => $validated['akad_maps_link'] ?? 'https://maps.google.com/?q=Jakarta',
                ]
            );

            $resepsiStartTime = $request->input('resepsi_start_time') ?: ($validated['resepsi_time'] ?? '11:00');
            $resepsiEndTime = $request->boolean('resepsi_is_until_finish') ? 'Selesai' : ($request->input('resepsi_end_time') ?: null);
            $resepsiTz = $request->input('resepsi_timezone') ?: 'WIB';

            $invitation->events()->updateOrCreate(
                ['order' => 2],
                [
                    'title' => 'Resepsi Pernikahan',
                    'date' => $validated['resepsi_date'],
                    'start_time' => $resepsiStartTime,
                    'end_time' => $resepsiEndTime,
                    'timezone' => $resepsiTz,
                    'venue_name' => $validated['resepsi_venue'],
                    'address' => $validated['resepsi_address'],
                    'maps_url' => $validated['resepsi_maps_link'] ?? 'https://maps.google.com/?q=Jakarta',
                ]
            );

            // Media (Cover, Groom, Bride, Photo Galleries)
            if ($request->has('cover_image_files') || $request->has('existing_cover_urls') || $request->has('cover_image_file')) {
                $invitation->media()->where('media_type', 'cover')->delete();
                $coverOrder = 1;
                foreach ($coverUrls as $cUrl) {
                    $invitation->media()->create([
                        'media_type' => 'cover',
                        'url' => $cUrl,
                        'order' => $coverOrder++,
                    ]);
                }
            }

            if ($request->has('groom_photo_files') || $request->has('existing_groom_photo_urls') || $request->has('groom_photo_file')) {
                $invitation->media()->where('media_type', 'groom')->delete();
                foreach ($groomPhotos as $idx => $gPhoto) {
                    $invitation->media()->create([
                        'media_type' => 'groom',
                        'url' => $gPhoto,
                        'order' => $idx + 1,
                    ]);
                }
            }

            if ($request->has('bride_photo_files') || $request->has('existing_bride_photo_urls') || $request->has('bride_photo_file')) {
                $invitation->media()->where('media_type', 'bride')->delete();
                foreach ($bridePhotos as $idx => $bPhoto) {
                    $invitation->media()->create([
                        'media_type' => 'bride',
                        'url' => $bPhoto,
                        'order' => $idx + 1,
                    ]);
                }
            }

            // Galleries
            $uploadedGalleryUrls = [];
            if ($request->hasFile('gallery_files')) {
                foreach ($request->file('gallery_files') as $file) {
                    $path = upload_as_webp($file, 'invitations/galleries');
                    $uploadedGalleryUrls[] = Storage::url($path);
                }
            }

            $allGalleryUrls = array_merge(
                (array) $request->input('existing_gallery_urls', []),
                (array) $request->input('gallery_urls', []),
                $uploadedGalleryUrls
            );

            if ($request->has('gallery_files') || $request->has('existing_gallery_urls') || $request->has('gallery_urls')) {
                $invitation->media()->where('media_type', 'photo')->delete();
                $orderPos = 1;
                foreach ($allGalleryUrls as $gUrl) {
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
            $invitation->gifts()->delete();

            $bank1Number = $validated['bank_1_number'] ?? $validated['bank_1_account'] ?? $request->input('bank_1_number') ?? $request->input('bank_1_account');
            if (! empty($validated['bank_1_name']) && ! empty($bank1Number)) {
                $qris1 = $request->input('bank_1_existing_qris');
                if ($request->hasFile('bank_1_qris_file')) {
                    $path1 = upload_as_webp($request->file('bank_1_qris_file'), 'invitations/qris');
                    $qris1 = Storage::url($path1);
                }

                $invitation->gifts()->create([
                    'gift_type' => 'bank_transfer',
                    'bank_name' => $validated['bank_1_name'],
                    'account_number' => $bank1Number,
                    'account_name' => $validated['bank_1_holder'] ?? $validated['groom_name'] ?? 'Pengantin Pria',
                    'qr_code_url' => $qris1,
                    'qris_image' => $qris1,
                    'order' => 1,
                ]);
            }

            $bank2Number = $validated['bank_2_number'] ?? $validated['bank_2_account'] ?? $request->input('bank_2_number') ?? $request->input('bank_2_account');
            if (! empty($validated['bank_2_name']) && ! empty($bank2Number)) {
                $qris2 = $request->input('bank_2_existing_qris');
                if ($request->hasFile('bank_2_qris_file')) {
                    $path2 = upload_as_webp($request->file('bank_2_qris_file'), 'invitations/qris');
                    $qris2 = Storage::url($path2);
                }

                $invitation->gifts()->create([
                    'gift_type' => 'bank_transfer',
                    'bank_name' => $validated['bank_2_name'],
                    'account_number' => $bank2Number,
                    'account_name' => $validated['bank_2_holder'] ?? $validated['bride_name'] ?? 'Pengantin Wanita',
                    'qr_code_url' => $qris2,
                    'qris_image' => $qris2,
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
                            $storyPath = upload_as_webp($request->file("stories.{$index}.image_file"), 'invitations/stories');
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

        clear_invitation_cache($invitation->slug);

        return redirect()->route('member.invitations.index')
            ->with('success', 'Undangan pernikahan "'.$invitation->fresh()->title.'" berhasil diperbarui.');
    }

    /**
     * Delete invitation.
     */
    public function destroy(Request $request, Invitation $invitation): RedirectResponse
    {
        if ($invitation->owner_id !== $request->user()->id && $invitation->user_id !== $request->user()->id) {
            abort(403);
        }

        $title = $invitation->title;
        $slug = $invitation->slug;
        $this->themeOwnershipService->releaseThemeLicenseFromInvitation($invitation);
        $invitation->delete();

        clear_invitation_cache($slug);

        return redirect()->route('member.invitations.index')
            ->with('success', 'Undangan "'.$title.'" berhasil dihapus.');
    }
}
