<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicInvitationController extends Controller
{
    /**
     * Presets gaya desain untuk Master Dynamic Theme Engine.
     */
    protected array $stylePresets = [
        'minimalist' => [
            'id' => 'minimalist',
            'name' => 'The Monochrome Elegance',
            'category' => 'Minimalist Editorial',
            'bg_main' => '#FAF8F5',
            'bg_card' => '#FFFFFF',
            'text_primary' => '#181715',
            'text_secondary' => '#66615B',
            'accent' => '#A68D5C',
            'border_color' => '#E8E4DC',
            'button_style' => 'bg-stone-900 text-stone-50 hover:bg-stone-800',
            'font_heading' => 'Playfair Display',
            'font_body' => 'Plus Jakarta Sans',
            'tag_bg' => '#EFECE6',
            'tag_text' => '#181715',
            'card_radius' => 'rounded-3xl',
            'is_dark' => false,
            'cover_bg' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'A Thousand Years - Romantic Acoustic Piano',
        ],
        'botanical' => [
            'id' => 'botanical',
            'name' => 'Sage Botanical & Rustic',
            'category' => 'Botanical & Rustic',
            'bg_main' => '#F4F7F4',
            'bg_card' => '#FFFFFF',
            'text_primary' => '#1D3328',
            'text_secondary' => '#4D6B5A',
            'accent' => '#3E6F56',
            'border_color' => '#DCE5DE',
            'button_style' => 'bg-[#2D503F] text-emerald-50 hover:bg-[#233E31]',
            'font_heading' => 'Italiana',
            'font_body' => 'Plus Jakarta Sans',
            'tag_bg' => '#E3ECE4',
            'tag_text' => '#1D3328',
            'card_radius' => 'rounded-3xl',
            'is_dark' => false,
            'cover_bg' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'Canon in D - Acoustic Ensemble',
        ],
        'luxury' => [
            'id' => 'luxury',
            'name' => 'Royal Champagne Gold',
            'category' => 'Luxury Royal',
            'bg_main' => '#0B1220',
            'bg_card' => '#131D31',
            'text_primary' => '#F8FAFC',
            'text_secondary' => '#94A3B8',
            'accent' => '#D4AF37',
            'border_color' => '#24344D',
            'button_style' => 'bg-gradient-to-r from-amber-400 to-amber-600 text-slate-950 font-bold hover:brightness-110',
            'font_heading' => 'Playfair Display',
            'font_body' => 'Plus Jakarta Sans',
            'tag_bg' => '#1E293B',
            'tag_text' => '#FBBF24',
            'card_radius' => 'rounded-3xl',
            'is_dark' => true,
            'cover_bg' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'Until I Found You - Romantic Acoustic',
        ],
        'romantic' => [
            'id' => 'romantic',
            'name' => 'Blush Silk & Romance',
            'category' => 'Blush Romance',
            'bg_main' => '#FAF3F5',
            'bg_card' => '#FFFFFF',
            'text_primary' => '#3B1A24',
            'text_secondary' => '#7A5260',
            'accent' => '#B85D77',
            'border_color' => '#F0DCE2',
            'button_style' => 'bg-[#9E4761] text-rose-50 hover:bg-[#853B51]',
            'font_heading' => 'Playfair Display',
            'font_body' => 'Plus Jakarta Sans',
            'tag_bg' => '#F5E2E8',
            'tag_text' => '#3B1A24',
            'card_radius' => 'rounded-3xl',
            'is_dark' => false,
            'cover_bg' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'Marry Your Daughter - Soft Piano',
        ],
        'nusantara' => [
            'id' => 'nusantara',
            'name' => 'Nusantara Heritage Songket',
            'category' => 'Traditional Cultural',
            'bg_main' => '#FDF8F2',
            'bg_card' => '#FFFFFF',
            'text_primary' => '#2B0E11',
            'text_secondary' => '#6A4145',
            'accent' => '#B67E22',
            'border_color' => '#EEDCC8',
            'button_style' => 'bg-[#6D1B22] text-amber-50 hover:bg-[#57141A]',
            'font_heading' => 'Playfair Display',
            'font_body' => 'Plus Jakarta Sans',
            'tag_bg' => '#F4E5D4',
            'tag_text' => '#2B0E11',
            'card_radius' => 'rounded-3xl',
            'is_dark' => false,
            'cover_bg' => 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'Gending Sriwijaya - Modern Strings',
        ],
        'modern' => [
            'id' => 'modern',
            'name' => 'Midnight Starlight Edition',
            'category' => 'Modern Dark Aesthetic',
            'bg_main' => '#0A0C13',
            'bg_card' => '#121624',
            'text_primary' => '#F1F5F9',
            'text_secondary' => '#94A3B8',
            'accent' => '#38BDF8',
            'border_color' => '#1E293B',
            'button_style' => 'bg-sky-500 text-slate-950 font-bold hover:bg-sky-400',
            'font_heading' => 'Plus Jakarta Sans',
            'font_body' => 'Plus Jakarta Sans',
            'tag_bg' => '#1E293B',
            'tag_text' => '#38BDF8',
            'card_radius' => 'rounded-3xl',
            'is_dark' => true,
            'cover_bg' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'Rewrite The Stars - Cinematic Ambient',
        ],
    ];

    /**
     * Menampilkan halaman website undangan digital otentik sesuai inputan di database.
     */
    public function show(string $slug, Request $request): View
    {
        $invitation = Invitation::with(['theme', 'couple', 'events', 'galleries', 'wallets', 'wishes', 'stories'])
            ->where('slug', $slug)
            ->first();

        // Fallback jika tidak ada di DB, arahkan ke DemoController show
        if (! $invitation) {
            return app(DemoController::class)->show($slug, $request);
        }

        $guestName = $request->query('to', 'Reyhan & Lesti');

        // Tentukan style preset
        $themeSlug = $invitation->theme->slug ?? 'monochrome-elegance';
        $slugToPreset = [
            'monochrome-elegance' => 'minimalist',
            'minimalist' => 'minimalist',
            'sage-botanical' => 'botanical',
            'botanical' => 'botanical',
            'royal-champagne' => 'luxury',
            'luxury' => 'luxury',
            'blush-silk' => 'romantic',
            'romantic' => 'romantic',
            'nusantara-heritage' => 'nusantara',
            'nusantara' => 'nusantara',
            'midnight-starlight' => 'modern',
            'modern' => 'modern',
        ];

        $styleKey = $request->query('style', $slugToPreset[$themeSlug] ?? 'minimalist');
        $activeStyle = $this->stylePresets[$styleKey] ?? $this->stylePresets['minimalist'];

        // Tentukan layout template
        $layout = $request->query('layout');
        if (! $layout) {
            if (str_contains($themeSlug, 'editorial') || str_contains($invitation->title, 'Editorial')) {
                $layout = 'editorial';
            } elseif (str_contains($themeSlug, 'botanical') || str_contains($invitation->title, 'Botanical')) {
                $layout = 'botanical';
            } else {
                $layout = 'classic';
            }
        }

        // Susun data dari database
        $couple = $invitation->couple;
        $events = $invitation->events;
        $akad = $events->firstWhere('title', 'Akad Nikah') ?? $events->first();
        $resepsi = $events->firstWhere('title', 'Resepsi Pernikahan') ?? $events->last();

        // Format tanggal acara
        $akadDateStr = $akad && $akad->date ? $akad->date->translatedFormat('l, d F Y') : ($invitation->event_date ? $invitation->event_date->translatedFormat('l, d F Y') : 'Sabtu, 24 Oktober 2026');
        $resepsiDateStr = $resepsi && $resepsi->date ? $resepsi->date->translatedFormat('l, d F Y') : $akadDateStr;

        // Galeri foto
        $galleryPhotos = $invitation->galleries->pluck('file_url')->toArray();
        if (empty($galleryPhotos)) {
            $galleryPhotos = [
                'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&auto=format&fit=crop&q=80',
            ];
        }

        // Rekening bank
        $bankAccounts = [];
        $bankColors = ['from-blue-600 to-blue-800', 'from-amber-600 to-amber-800', 'from-emerald-600 to-emerald-800'];
        foreach ($invitation->wallets as $idx => $wallet) {
            $bankAccounts[] = [
                'bank' => $wallet->bank_name,
                'account_number' => $wallet->account_number,
                'account_name' => $wallet->account_name,
                'color' => $bankColors[$idx % count($bankColors)],
            ];
        }
        if (empty($bankAccounts)) {
            $bankAccounts = [
                [
                    'bank' => 'Bank Central Asia (BCA)',
                    'account_number' => '8801 2345 67',
                    'account_name' => $couple->groom_nickname ?? 'Raka Adiputra',
                    'color' => 'from-blue-600 to-blue-800',
                ],
            ];
        }

        // Wishes dari database
        $sampleWishes = [];
        foreach ($invitation->wishes->take(10) as $w) {
            $sampleWishes[] = [
                'name' => $w->guest_name,
                'attendance' => $w->attendance ?? 'Hadir',
                'message' => $w->message,
                'time' => $w->created_at ? $w->created_at->diffForHumans() : 'Baru saja',
            ];
        }
        if (empty($sampleWishes)) {
            $sampleWishes = [
                [
                    'name' => 'Dimas & Anisa',
                    'attendance' => 'Hadir (2 Orang)',
                    'message' => 'Selamat menempuh hidup baru untuk kedua mempelai! Semoga sakinah, mawaddah, warahmah.',
                    'time' => '10 menit yang lalu',
                ],
                [
                    'name' => 'Bpk. Ir. Gunawan Wibisono',
                    'attendance' => 'Hadir (2 Orang)',
                    'message' => 'Barakallahu lakuma wa baraka alaikuma wa jama\'a bainakuma fii khoir. Selamat berbahagia.',
                    'time' => '1 jam yang lalu',
                ],
            ];
        }

        // Countdown target
        $targetDate = $akad && $akad->date ? $akad->date->format('Y-m-d') : ($invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-10-24');
        $countdownTarget = $targetDate.'T08:00:00+07:00';

        $data = [
            'title' => $invitation->title,
            'cover_image' => $invitation->cover_image ?? $activeStyle['cover_bg'],
            'background_music' => $invitation->background_music ?? $activeStyle['audio_url'],
            'quote_text' => $invitation->quote_text ?? 'Dan di antara tanda-tanda kebesaran-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri...',
            'quote_source' => $invitation->quote_source ?? '(QS. Ar-Rum: 21)',
            'countdown_target' => $countdownTarget,

            'groom' => [
                'name' => $couple->groom_name ?? 'Raka Pratama, S.T.',
                'nickname' => $couple->groom_nickname ?? 'Raka',
                'father' => $couple->groom_father ?? 'Bpk. Orang Tua Pria',
                'mother' => $couple->groom_mother ?? 'Ibu Orang Tua Pria',
                'child_order' => $couple->groom_child_order ?? 'Putra pertama',
                'instagram' => $couple->groom_instagram ?? 'rakapratama',
                'photo' => $couple->groom_photo ?? $activeStyle['groom_photo'],
            ],
            'bride' => [
                'name' => $couple->bride_name ?? 'Arinda Putri Larasati, S.I.Kom',
                'nickname' => $couple->bride_nickname ?? 'Arinda',
                'father' => $couple->bride_father ?? 'Bpk. Orang Tua Wanita',
                'mother' => $couple->bride_mother ?? 'Ibu Orang Tua Wanita',
                'child_order' => $couple->bride_child_order ?? 'Putri kedua',
                'instagram' => $couple->bride_instagram ?? 'arindaputri.l',
                'photo' => $couple->bride_photo ?? $activeStyle['bride_photo'],
            ],

            'events' => [
                'akad' => [
                    'title' => $akad->title ?? 'Akad Nikah',
                    'date' => $akadDateStr,
                    'time' => $akad->start_time ?? '08.00 - 10.00 WIB',
                    'venue' => $akad->venue_name ?? 'Masjid Agung Sunda Kelapa',
                    'address' => $akad->address ?? 'Jl. Taman Sunda Kelapa No.16, Menteng, Jakarta Pusat',
                    'maps_link' => $akad->google_maps_url ?? 'https://maps.google.com/?q=Jakarta',
                ],
                'resepsi' => [
                    'title' => $resepsi->title ?? 'Resepsi Pernikahan',
                    'date' => $resepsiDateStr,
                    'time' => $resepsi->start_time ?? '11.00 - 14.00 WIB',
                    'venue' => $resepsi->venue_name ?? 'Grand Ballroom The Ritz-Carlton',
                    'address' => $resepsi->address ?? 'Mega Kuningan Barat No.1, Jakarta Selatan',
                    'maps_link' => $resepsi->google_maps_url ?? 'https://maps.google.com/?q=Jakarta',
                ],
            ],

            'stories' => [
                [
                    'year' => 'Agustus 2020',
                    'title' => 'Pertemuan Pertama',
                    'desc' => 'Takdir mempertemukan kami di sebuah workshop desain dan arsitektur di Bandung.',
                ],
                [
                    'year' => 'November 2022',
                    'title' => 'Menjalin Komitmen',
                    'desc' => 'Setelah dua tahun saling mengenal kepribadian, kami memutuskan melangkah bersama.',
                ],
                [
                    'year' => 'Oktober 2026',
                    'title' => 'Hari Bahagia Pernikahan',
                    'desc' => 'Dengan penuh rasa syukur, kami siap menyatukan cinta dalam ikatan pernikahan kudus seumur hidup.',
                ],
            ],

            'galleries' => $galleryPhotos,
            'bank_accounts' => $bankAccounts,
            'gift_address' => 'Penerima: '.$couple->groom_nickname.' / '.$couple->bride_nickname,
            'sample_wishes' => $sampleWishes,
        ];

        if ($invitation->theme && $invitation->theme->view_path && view()->exists($invitation->theme->view_path)) {
            $viewName = $invitation->theme->view_path;
        } elseif ($layout === 'editorial') {
            $viewName = 'demo.editorial';
        } elseif ($layout === 'botanical') {
            $viewName = 'demo.botanical';
        } else {
            $viewName = 'demo.classic';
        }

        return view($viewName, [
            'invitation' => $invitation,
            'activeStyle' => $activeStyle,
            'presets' => $this->stylePresets,
            'guestName' => $guestName,
            'layout' => $layout,
            'data' => $data,
        ]);
    }

    /**
     * Kirim ucapan doa restu dan konfirmasi RSVP dari website undangan publik.
     */
    public function storeWish(string $slug, Request $request): JsonResponse
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'guest_name' => 'required|string|max:255',
            'attendance' => 'nullable|string|max:100',
            'message' => 'required|string|max:1000',
        ]);

        $wish = $invitation->wishes()->create([
            'guest_name' => $validated['guest_name'],
            'attendance' => $validated['attendance'] ?? 'Hadir',
            'message' => $validated['message'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Doa restu Anda berhasil dikirim!',
            'wish' => [
                'name' => $wish->guest_name,
                'attendance' => $wish->attendance,
                'message' => $wish->message,
                'time' => 'Baru saja',
            ],
        ]);
    }
}
