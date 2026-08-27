<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    /**
     * Menampilkan halaman Live Demo utama (1 Template Master Pilihan).
     */
    public function index(Request $request): View
    {
        $guestName = $request->query('to', 'Bpk. Budi Santoso & Partner');

        $theme = [
            'name' => 'The Monochrome & Luxury Elegance',
            'font_heading' => 'Playfair Display',
            'font_body' => 'Plus Jakarta Sans',
            'font_accent' => 'Cormorant Garamond',
            'cover_bg' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&auto=format&fit=crop&q=85',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            'couple_photo' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=1000&auto=format&fit=crop&q=80',
            'audio_url' => asset('audio/wedding-song.mp3'),
            'audio_title' => 'A Thousand Years (Romantic Acoustic)',
            'audio_artist' => 'Piano & Strings Ensemble',
            'palette' => [
                'bg_main' => 'bg-[#FAF8F5]',
                'bg_card' => 'bg-white',
                'bg_accent' => 'bg-[#22201D]',
                'text_primary' => 'text-[#181715]',
                'text_secondary' => 'text-[#7A7469]',
                'text_accent' => 'text-[#A68D5C]',
                'border_color' => 'border-[#EFECE3]',
                'btn_primary' => 'bg-[#181715] text-[#F4EFE6] hover:bg-[#2A2824]',
                'tag_bg' => 'bg-[#E9DFC9]/40 text-[#6C5834]',
                'icon_bg' => 'bg-[#E9DFC9]/30 text-[#8A7245]',
                'pill_active' => 'bg-[#181715] text-white',
            ],
        ];

        $demoData = [
            'groom' => [
                'name' => 'Raka Pratama, S.T.',
                'nickname' => 'Raka',
                'father' => 'Bpk. Hendra Pratama',
                'mother' => 'Ibu Susi Hendra',
                'child_order' => 'Putra pertama',
                'instagram' => 'rakapratama',
            ],
            'bride' => [
                'name' => 'Arinda Putri, S.Ds.',
                'nickname' => 'Arinda',
                'father' => 'Bpk. Irwan Syahputra',
                'mother' => 'Ibu Dewi Sartika',
                'child_order' => 'Putri kedua',
                'instagram' => 'arindaputri',
            ],
            'events' => [
                'akad' => [
                    'title' => 'Akad Nikah',
                    'date' => 'Sabtu, 24 Oktober 2026',
                    'time' => '08.00 - 10.00 WIB',
                    'venue' => 'Masjid Agung Al-Azhar',
                    'address' => 'Jl. Sisingamangaraja No.1, Kebayoran Baru, Jakarta Selatan',
                    'maps_link' => 'https://maps.google.com/?q=Masjid+Agung+Al-Azhar+Jakarta',
                ],
                'resepsi' => [
                    'title' => 'Resepsi Pernikahan',
                    'date' => 'Sabtu, 24 Oktober 2026',
                    'time' => '11.00 - 14.00 WIB & 18.30 - 21.00 WIB',
                    'venue' => 'Grand Ballroom The Ritz-Carlton',
                    'address' => 'Mega Kuningan, Jl. DR. Ide Anak Agung Gde Agung, Jakarta Selatan',
                    'maps_link' => 'https://maps.google.com/?q=The+Ritz-Carlton+Jakarta+Mega+Kuningan',
                ],
            ],
            'countdown_target' => '2026-10-24T08:00:00+07:00',
            'stories' => [
                [
                    'year' => 'Agustus 2020',
                    'title' => 'Pertemuan Pertama',
                    'desc' => 'Takdir mempertemukan kami di sebuah workshop desain dan arsitektur di Jakarta. Berawal dari diskusi tugas dan obrolan secangkir kopi.',
                ],
                [
                    'year' => 'November 2022',
                    'title' => 'Menjalin Komitmen',
                    'desc' => 'Setelah dua tahun saling mengenal kepribadian masing-masing dan berbagi mimpi, kami memutuskan untuk melangkah bersama dalam ikatan kasih.',
                ],
                [
                    'year' => 'Desember 2025',
                    'title' => 'Hari Lamaran',
                    'desc' => 'Di hadapan kedua keluarga besar, kami mengikat janji suci untuk melangkah ke jenjang pernikahan yang penuh berkah.',
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
                    'account_number' => '8735 1234 5678',
                    'account_name' => 'Raka Pratama',
                    'color' => 'from-blue-600 to-blue-800',
                ],
                [
                    'bank' => 'Bank Mandiri',
                    'account_number' => '1370 0192 8374 1',
                    'account_name' => 'Arinda Putri',
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

        return view('demo.index', [
            'theme' => $theme,
            'guestName' => $guestName,
            'data' => $demoData,
        ]);
    }

    /**
     * Redirect slug demo langsung ke /demo utama.
     */
    public function show(Request $request): View
    {
        return $this->index($request);
    }
}
