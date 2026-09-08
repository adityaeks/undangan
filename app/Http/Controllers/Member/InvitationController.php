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
        $query = $user->invitations()->with(['theme', 'couples', 'guests', 'events', 'media']);

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
            $accessibleThemeIds = $this->themeOwnershipService->getUserOwnedThemeIds($user);
            $usedThemeIds = $user->invitations()->pluck('theme_id')->toArray();

            // Tema yang tersedia adalah tema aktif & belum kedaluwarsa milik user yang belum pernah digunakan membuat undangan
            $themes = Theme::where('is_active', true)
                ->whereIn('id', $accessibleThemeIds)
                ->whereNotIn('id', $usedThemeIds)
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
            'music_preset' => 'nullable|string|max:255',

            // Groom
            'groom_name' => 'required|string|max:255',
            'groom_nickname' => 'required|string|max:100',
            'groom_child_order' => 'nullable|string|max:100',
            'groom_father' => 'nullable|string|max:255',
            'groom_mother' => 'nullable|string|max:255',
            'groom_instagram' => 'nullable|string|max:100',
            'groom_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'groom_photo_url' => 'nullable|url|max:500',

            // Bride
            'bride_name' => 'required|string|max:255',
            'bride_nickname' => 'required|string|max:100',
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
            'akad_date' => 'required|date',
            'akad_time' => 'required|string|max:100',
            'akad_venue' => 'required|string|max:255',
            'akad_address' => 'required|string',
            'akad_maps_link' => 'nullable|url|max:500',

            // Events - Resepsi
            'resepsi_date' => 'required|date',
            'resepsi_time' => 'required|string|max:100',
            'resepsi_venue' => 'required|string|max:255',
            'resepsi_address' => 'required|string',
            'resepsi_maps_link' => 'nullable|url|max:500',

            // Wallets
            'bank_1_name' => 'nullable|string|max:100',
            'bank_1_number' => 'nullable|string|max:100',
            'bank_1_holder' => 'nullable|string|max:255',

            'bank_2_name' => 'nullable|string|max:100',
            'bank_2_number' => 'nullable|string|max:100',
            'bank_2_holder' => 'nullable|string|max:255',

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

        // Cover Image
        if ($request->hasFile('cover_image_file')) {
            $coverPath = $request->file('cover_image_file')->store('invitations/covers', 'public');
            $coverImage = Storage::url($coverPath);
        } else {
            $coverImage = $validated['cover_image_url'] ?? null;
        }

        // Background Music
        if ($request->hasFile('music_file')) {
            $musicPath = $request->file('music_file')->store('invitations/music', 'public');
            $backgroundMusic = Storage::url($musicPath);
        } else {
            $backgroundMusic = $validated['music_preset'] ?? '/audio/wedding-song.mp3';
        }

        // Groom & Bride Photos
        if ($request->hasFile('groom_photo_file')) {
            $groomPath = $request->file('groom_photo_file')->store('invitations/couples', 'public');
            $groomPhoto = Storage::url($groomPath);
        } else {
            $groomPhoto = $validated['groom_photo_url'] ?? null;
        }

        if ($request->hasFile('bride_photo_file')) {
            $bridePath = $request->file('bride_photo_file')->store('invitations/couples', 'public');
            $bridePhoto = Storage::url($bridePath);
        } else {
            $bridePhoto = $validated['bride_photo_url'] ?? null;
        }

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
        $invitation->events()->create([
            'title' => 'Akad Nikah',
            'date' => $validated['akad_date'],
            'start_time' => $validated['akad_time'],
            'timezone' => 'WIB',
            'venue_name' => $validated['akad_venue'],
            'address' => $validated['akad_address'],
            'maps_url' => $validated['akad_maps_link'] ?? 'https://maps.google.com/?q=Jakarta',
            'order' => 1,
        ]);

        $invitation->events()->create([
            'title' => 'Resepsi Pernikahan',
            'date' => $validated['resepsi_date'],
            'start_time' => $validated['resepsi_time'],
            'timezone' => 'WIB',
            'venue_name' => $validated['resepsi_venue'],
            'address' => $validated['resepsi_address'],
            'maps_url' => $validated['resepsi_maps_link'] ?? 'https://maps.google.com/?q=Jakarta',
            'order' => 2,
        ]);

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

        // Stories (Kisah Perjalanan)
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

        // Default Sample Guest
        $invitation->guests()->create([
            'name' => 'Reyhan',
            'slug' => 'budi-santoso',
            'phone' => '081234567890',
            'category' => 'VIP',
            'attendance_status' => 'pending',
            'pax' => 2,
        ]);

        return redirect()->route('member.invitations.index')
            ->with('success', 'Selamat! Undangan pernikahan "'.$invitation->title.'" berhasil disimpan dan diterbitkan.');
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
        $invitation->delete();

        return redirect()->route('member.invitations.index')
            ->with('success', 'Undangan "'.$title.'" berhasil dihapus.');
    }
}
