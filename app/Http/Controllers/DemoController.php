<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    /**
     * Presets gaya desain untuk Master Dynamic Theme Engine.
     */
    protected array $stylePresets = [
        'minimalist' => [
            'id' => 'minimalist',
            'name' => 'Minimalist Editorial',
            'tagline' => 'Clean, Timeless & Editorial Serif',
            'is_dark' => false,
            'font_heading' => 'Playfair Display',
            'font_body' => 'Plus Jakarta Sans',
            'font_accent' => 'Cormorant Garamond',
            'cover_bg' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'A Thousand Years (Romantic Acoustic)',
            'bg_main' => '#FAF8F5',
            'bg_card' => '#FFFFFF',
            'text_primary' => '#181715',
            'text_secondary' => '#7A7469',
            'accent' => '#A68D5C',
            'border_color' => '#EFECE3',
            'btn_bg' => '#181715',
            'btn_text' => '#F4EFE6',
            'tag_bg' => '#E9DFC9',
            'tag_text' => '#6C5834',
            'card_radius' => 'rounded-3xl',
            'card_shadow' => 'shadow-sm',
        ],

        'modern' => [
            'id' => 'modern',
            'name' => 'Modern Dark Studio',
            'tagline' => 'Cinematic, Deep Starlight & Cosmic Aura',
            'is_dark' => true,
            'font_heading' => 'Plus Jakarta Sans',
            'font_body' => 'Plus Jakarta Sans',
            'font_accent' => 'Plus Jakarta Sans',
            'cover_bg' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'City of Stars & Modern Synth Strings',
            'bg_main' => '#0A0C13',
            'bg_card' => '#121624',
            'text_primary' => '#F8FAFC',
            'text_secondary' => '#94A3B8',
            'accent' => '#38BDF8',
            'border_color' => '#1E293B',
            'btn_bg' => '#3B82F6',
            'btn_text' => '#FFFFFF',
            'tag_bg' => '#1E253E',
            'tag_text' => '#93C5FD',
            'card_radius' => 'rounded-2xl',
            'card_shadow' => 'shadow-xl border border-sky-500/20',
        ],

        'luxury' => [
            'id' => 'luxury',
            'name' => 'Royal Champagne & Gold',
            'tagline' => 'Grandeur, Opulent & Regal Gold Foil',
            'is_dark' => true,
            'font_heading' => 'Playfair Display',
            'font_body' => 'Plus Jakarta Sans',
            'font_accent' => 'Cormorant Garamond',
            'cover_bg' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'Royal Symphony & Grand Harp',
            'bg_main' => '#0B1220',
            'bg_card' => '#131D31',
            'text_primary' => '#FDFBF7',
            'text_secondary' => '#9EAFC9',
            'accent' => '#D4AF37',
            'border_color' => '#273859',
            'btn_bg' => '#D4AF37',
            'btn_text' => '#0B1220',
            'tag_bg' => '#2A364F',
            'tag_text' => '#F3E5AB',
            'card_radius' => 'rounded-3xl',
            'card_shadow' => 'shadow-2xl border border-amber-400/30',
        ],

        'botanical' => [
            'id' => 'botanical',
            'name' => 'Sage Olive & Earthy Wood',
            'tagline' => 'Organic, Earthy & Ethereal Greenery',
            'is_dark' => false,
            'font_heading' => 'Cormorant Garamond',
            'font_body' => 'Plus Jakarta Sans',
            'font_accent' => 'Playfair Display',
            'cover_bg' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'Canon in D (Acoustic & Woodwinds)',
            'bg_main' => '#F2F6F3',
            'bg_card' => '#FFFFFF',
            'text_primary' => '#1B3227',
            'text_secondary' => '#526A5D',
            'accent' => '#3E6F56',
            'border_color' => '#D5E3D9',
            'btn_bg' => '#244234',
            'btn_text' => '#EFF6F1',
            'tag_bg' => '#DDE9E0',
            'tag_text' => '#244234',
            'card_radius' => 'rounded-[28px]',
            'card_shadow' => 'shadow-sm',
        ],

        'romantic' => [
            'id' => 'romantic',
            'name' => 'Blush Silk & Rose Romance',
            'tagline' => 'Delicate, Poetic & Soft Rose Watercolor',
            'is_dark' => false,
            'font_heading' => 'Cormorant Garamond',
            'font_body' => 'Plus Jakarta Sans',
            'font_accent' => 'Great Vibes',
            'cover_bg' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'La Vie En Rose (French Acoustic Harp)',
            'bg_main' => '#FAF3F5',
            'bg_card' => '#FFFFFF',
            'text_primary' => '#3B1A24',
            'text_secondary' => '#7F5160',
            'accent' => '#B85D77',
            'border_color' => '#EEDCE2',
            'btn_bg' => '#8C3A53',
            'btn_text' => '#FDF0F3',
            'tag_bg' => '#F5DEE5',
            'tag_text' => '#8C3A53',
            'card_radius' => 'rounded-3xl',
            'card_shadow' => 'shadow-sm',
        ],

        'nusantara' => [
            'id' => 'nusantara',
            'name' => 'Nusantara Songket Heritage',
            'tagline' => 'Majestic, Cultural & Golden Songket Batik',
            'is_dark' => false,
            'font_heading' => 'Playfair Display',
            'font_body' => 'Plus Jakarta Sans',
            'font_accent' => 'Cormorant Garamond',
            'cover_bg' => 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'audio_url' => '/audio/wedding-song.mp3',
            'audio_title' => 'Gending Sriwijaya & Royal Gamelan',
            'bg_main' => '#FDF8F2',
            'bg_card' => '#FFFFFF',
            'text_primary' => '#2B0E11',
            'text_secondary' => '#75484D',
            'accent' => '#B67E22',
            'border_color' => '#ECDDCB',
            'btn_bg' => '#5B1A21',
            'btn_text' => '#FDF4E7',
            'tag_bg' => '#F5E6D3',
            'tag_text' => '#5B1A21',
            'card_radius' => 'rounded-3xl',
            'card_shadow' => 'shadow-md border border-amber-400/30',
        ],
    ];

    /**
     * Menampilkan master invitation preview dengan gaya & layout terpilih.
     */
    public function index(Request $request): View
    {
        $layout = $request->query('layout', 'classic');
        $defaultStyle = match ($layout) {
            'editorial' => 'modern',
            'botanical' => 'botanical',
            'classic' => 'nusantara',
            default => 'nusantara',
        };
        $style = $request->query('style', $defaultStyle);

        return $this->renderInvitation($style, $layout, $request);
    }

    /**
     * Menampilkan master invitation preview berdasarkan slug tema/gaya/layout.
     */
    public function show(string $slug, Request $request): View
    {
        $layout = $request->query('layout', 'classic');

        if ($slug === 'editorial' || $slug === 'editorial-magazine' || $slug === 'vogue-editorial') {
            $slug = 'modern';
            $layout = 'editorial';
        } elseif ($slug === 'botanical-glass' || $slug === 'botanical-arch' || $slug === 'ethereal-botanical' || $slug === 'botanical') {
            $slug = 'botanical';
            $layout = 'botanical';
        } elseif ($slug === 'classic' || $slug === 'classic-card' || $slug === 'timeless-classic' || $slug === 'nusantara') {
            $slug = 'nusantara';
            $layout = 'classic';
        }

        // Petakan slug tema ke preset ID
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

        $style = $slugToPreset[$slug] ?? $slug;

        return $this->renderInvitation($style, $layout, $request);
    }

    /**
     * Helper render master invitation dengan data lengkap & live customizer.
     */
    protected function renderInvitation(string $styleKey, string $layout, Request $request): View
    {
        $guestName = $request->query('to', 'Bpk. Budi Santoso & Partner');

        $activeStyle = $this->stylePresets[$styleKey] ?? $this->stylePresets['minimalist'];

        $demoData = [
            'groom' => [
                'name' => 'Raka Pratama, S.T.',
                'nickname' => 'Raka',
                'father' => 'Bpk. Dr. H. Bambang Soediro',
                'mother' => 'Ibu Hj. Ratna Juwita',
                'child_order' => 'Putra pertama',
                'instagram' => 'rakapratama',
            ],
            'bride' => [
                'name' => 'Arinda Putri Larasati, S.I.Kom',
                'nickname' => 'Arinda',
                'father' => 'Bpk. Ir. H. Hendra Wijaya, M.M.',
                'mother' => 'Ibu Hj. Dewi Kusuma Wardani',
                'child_order' => 'Putri kedua',
                'instagram' => 'arindaputri.l',
            ],
            'events' => [
                'akad' => [
                    'title' => 'Akad Nikah',
                    'date' => 'Sabtu, 24 Oktober 2026',
                    'time' => '08.00 - 10.00 WIB',
                    'venue' => 'Masjid Agung Sunda Kelapa',
                    'address' => 'Jl. Taman Sunda Kelapa No.16, Menteng, Jakarta Pusat 10310',
                    'maps_link' => 'https://maps.google.com/?q=Masjid+Agung+Sunda+Kelapa+Jakarta',
                ],
                'resepsi' => [
                    'title' => 'Resepsi Pernikahan',
                    'date' => 'Sabtu, 24 Oktober 2026',
                    'time' => '11.00 - 14.00 WIB & 18.30 - 21.00 WIB',
                    'venue' => 'Grand Ballroom The Ritz-Carlton',
                    'address' => 'Mega Kuningan Barat No.1, Setiabudi, Jakarta Selatan 12950',
                    'maps_link' => 'https://maps.google.com/?q=The+Ritz-Carlton+Jakarta+Mega+Kuningan',
                ],
            ],
            'countdown_target' => '2026-10-24T08:00:00+07:00',
            'stories' => [
                [
                    'year' => 'Agustus 2020',
                    'title' => 'Pertemuan Pertama',
                    'desc' => 'Takdir mempertemukan kami di sebuah workshop desain dan arsitektur di Bandung. Berawal dari diskusi tugas dan obrolan secangkir kopi hangat.',
                ],
                [
                    'year' => 'November 2022',
                    'title' => 'Menjalin Komitmen',
                    'desc' => 'Setelah dua tahun saling mengenal kepribadian dan berbagi mimpi, kami memutuskan untuk melangkah bersama dalam ikatan kasih yang tulus.',
                ],
                [
                    'year' => 'Desember 2025',
                    'title' => 'Hari Lamaran Resmi',
                    'desc' => 'Di hadapan kedua keluarga besar, kami mengikat janji suci untuk melangkah ke jenjang pernikahan yang penuh berkah dan ridho Ilahi.',
                ],
                [
                    'year' => 'Oktober 2026',
                    'title' => 'Menuju Hari Bahagia',
                    'desc' => 'Dengan penuh rasa syukur, kami siap menyatukan cinta dalam ikatan pernikahan kudus seumur hidup.',
                ],
            ],
            'galleries' => [
                'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&auto=format&fit=crop&q=80',
                'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=800&auto=format&fit=crop&q=80',
            ],
            'bank_accounts' => [
                [
                    'bank' => 'Bank Central Asia (BCA)',
                    'account_number' => '8801 2345 67',
                    'account_name' => 'Raka Adiputra',
                    'color' => 'from-blue-600 to-blue-800',
                ],
                [
                    'bank' => 'Bank Mandiri',
                    'account_number' => '1370 0192 8374 1',
                    'account_name' => 'Arinda Putri Larasati',
                    'color' => 'from-amber-600 to-amber-800',
                ],
            ],
            'gift_address' => 'Jl. Senopati Raya No. 45, Kebayoran Baru, Jakarta Selatan 12190 (Penerima: Arinda / Raka - 0812-3456-7890)',
            'sample_wishes' => [
                [
                    'name' => 'Dimas & Anisa',
                    'attendance' => 'Hadir (2 Orang)',
                    'message' => 'Selamat menempuh hidup baru Raka & Arinda! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Bahagia selamanya!',
                    'time' => '10 menit yang lalu',
                ],
                [
                    'name' => 'Bpk. Ir. Gunawan Wibisono',
                    'attendance' => 'Hadir (2 Orang)',
                    'message' => 'Barakallahu lakuma wa baraka alaikuma wa jama\'a bainakuma fii khoir. Selamat berbahagia untuk kedua mempelai dan keluarga besar.',
                    'time' => '1 jam yang lalu',
                ],
                [
                    'name' => 'Clara Novita, S.Ds.',
                    'attendance' => 'Hadir (1 Orang)',
                    'message' => 'Happy Wedding Arinda sayang dan Raka! Cantik dan ganteng banget kalian berdua. Lancar sampai hari H yaa!',
                    'time' => '3 jam yang lalu',
                ],
            ],
        ];

        if ($layout === 'editorial') {
            $viewName = 'demo.editorial';
        } elseif ($layout === 'botanical') {
            $viewName = 'demo.botanical';
        } else {
            $viewName = 'demo.classic';
        }

        return view($viewName, [
            'activeStyle' => $activeStyle,
            'presets' => $this->stylePresets,
            'guestName' => $guestName,
            'layout' => $layout,
            'data' => $demoData,
        ]);
    }
}
