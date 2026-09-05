<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Theme;
use App\Models\UserTheme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InvitationController extends Controller
{
    /**
     * Display a listing of invitations.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $query = Invitation::with(['theme', 'couple', 'guests', 'events', 'user', 'galleries']);

        if (! $user->isSuperAdmin()) {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->status === 'published';
            $query->where('is_published', $status);
        }

        $invitations = $query->latest()->paginate(10);
        $totalActive = Invitation::where('is_published', true)->count();
        $totalDraft = Invitation::where('is_published', false)->count();

        return view('admin.invitations.index', compact('invitations', 'totalActive', 'totalDraft'));
    }

    /**
     * Show the form for creating a new invitation.
     */
    public function create(): View
    {
        $themes = Theme::where('is_active', true)->get();
        $musicPresets = config('themes.music_presets', []);

        return view('admin.invitations.create', compact('themes', 'musicPresets'));
    }

    /**
     * Store a newly created invitation in storage.
     */
    public function store(Request $request): RedirectResponse
    {
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
            'groom_father' => 'nullable|string|max:255',
            'groom_mother' => 'nullable|string|max:255',
            'groom_instagram' => 'nullable|string|max:100',
            'groom_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'groom_photo_url' => 'nullable|url|max:500',

            // Bride
            'bride_name' => 'required|string|max:255',
            'bride_nickname' => 'required|string|max:100',
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
        ]);

        // 1. Process Uploads
        // Cover Image
        if ($request->hasFile('cover_image_file')) {
            $coverPath = $request->file('cover_image_file')->store('invitations/covers', 'public');
            $coverImage = Storage::url($coverPath);
        } else {
            $coverImage = $validated['cover_image_url'] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&auto=format&fit=crop&q=85';
        }

        // Background Music
        if ($request->hasFile('music_file')) {
            $musicPath = $request->file('music_file')->store('invitations/music', 'public');
            $backgroundMusic = Storage::url($musicPath);
        } else {
            $backgroundMusic = $validated['music_preset'] ?? '/audio/wedding-song.mp3';
        }

        // Groom Photo
        if ($request->hasFile('groom_photo_file')) {
            $groomPath = $request->file('groom_photo_file')->store('invitations/couples', 'public');
            $groomPhoto = Storage::url($groomPath);
        } else {
            $groomPhoto = $validated['groom_photo_url'] ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80';
        }

        // Bride Photo
        if ($request->hasFile('bride_photo_file')) {
            $bridePath = $request->file('bride_photo_file')->store('invitations/couples', 'public');
            $bridePhoto = Storage::url($bridePath);
        } else {
            $bridePhoto = $validated['bride_photo_url'] ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80';
        }

        // Generate clean unique slug
        $baseSlug = $request->filled('slug')
            ? $request->slug
            : ($request->groom_nickname.'-'.$request->bride_nickname);
        $slug = Invitation::generateUniqueSlug($baseSlug);

        $userId = Auth::id() ?? 1;

        // 2. Create Invitation Aggregate
        $invitation = Invitation::create([
            'user_id' => $userId,
            'owner_id' => $userId,
            'theme_id' => $validated['theme_id'],
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

        // Auto unlock theme for owner if not already unlocked
        UserTheme::firstOrCreate([
            'user_id' => $userId,
            'theme_id' => $validated['theme_id'],
        ], [
            'unlocked_at' => now(),
        ]);

        // 3. Create Settings
        $invitation->setting()->create([
            'bg_music_url' => $backgroundMusic,
            'is_music_autoplay' => false,
            'quote_text' => $validated['quote_text'] ?? 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
            'quote_source' => $validated['quote_source'] ?? 'QS. Ar-Rum: 21',
            'enable_comments' => true,
            'enable_rsvp' => true,
        ]);

        // 4. Create Couple Data (Groom & Bride rows)
        $invitation->couples()->create([
            'role' => 'groom',
            'full_name' => $validated['groom_name'],
            'nickname' => $validated['groom_nickname'],
            'father_name' => $validated['groom_father'] ?? 'Bpk. Orang Tua Pria',
            'mother_name' => $validated['groom_mother'] ?? 'Ibu Orang Tua Pria',
            'instagram' => $validated['groom_instagram'] ?? 'rakapratama',
            'photo_url' => $groomPhoto,
            'order' => 1,
        ]);

        $invitation->couples()->create([
            'role' => 'bride',
            'full_name' => $validated['bride_name'],
            'nickname' => $validated['bride_nickname'],
            'father_name' => $validated['bride_father'] ?? 'Bpk. Orang Tua Wanita',
            'mother_name' => $validated['bride_mother'] ?? 'Ibu Orang Tua Wanita',
            'instagram' => $validated['bride_instagram'] ?? 'arindaputri.l',
            'photo_url' => $bridePhoto,
            'order' => 2,
        ]);

        // 5. Create Events (Akad & Resepsi)
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

        // 6. Create Prewedding Media Galleries
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

        if (! empty($validated['gallery_urls'])) {
            foreach ($validated['gallery_urls'] as $url) {
                if (! empty($url)) {
                    $invitation->media()->create([
                        'media_type' => 'photo',
                        'url' => $url,
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

        // 7. Create Gifts / Bank Accounts
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

        // 8. Create Default Sample Guest
        $invitation->guests()->create([
            'name' => 'Reyhan',
            'slug' => 'budi-santoso',
            'phone' => '081234567890',
            'category' => 'VIP',
            'attendance_status' => 'pending',
            'pax' => 2,
        ]);

        return redirect()->route('invitations.index')
            ->with('success', 'Selamat! Undangan pernikahan "'.$invitation->title.'" berhasil disimpan dan diterbitkan.');
    }

    /**
     * Toggle publish/draft status for moderation.
     */
    public function togglePublish(Invitation $invitation): RedirectResponse
    {
        $invitation->update([
            'is_published' => ! $invitation->is_published,
        ]);

        $status = $invitation->is_published ? 'dipublikasikan (Online)' : 'ditarik (Draft / Suspended)';

        return back()->with('success', "Status undangan \"{$invitation->title}\" berhasil diubah menjadi {$status}.");
    }

    /**
     * Remove the specified invitation from storage.
     */
    public function destroy(Invitation $invitation): RedirectResponse
    {
        $title = $invitation->title;
        $invitation->delete();

        return redirect()->route('invitations.index')
            ->with('success', 'Undangan "'.$title.'" berhasil dihapus.');
    }
}
