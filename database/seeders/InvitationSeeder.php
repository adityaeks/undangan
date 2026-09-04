<?php

namespace Database\Seeders;

use App\Models\Couple;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Guest;
use App\Models\Invitation;
use App\Models\Story;
use App\Models\Theme;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Wish;
use Illuminate\Database\Seeder;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $theme = Theme::where('slug', 'monochrome-elegance')->first() ?? Theme::first();

        if (! $user || ! $theme) {
            return;
        }

        $invitation = Invitation::updateOrCreate(
            ['slug' => 'raka-arinda'],
            [
                'user_id' => $user->id,
                'theme_id' => $theme->id,
                'title' => 'The Wedding of Raka & Arinda',
                'event_type' => 'wedding',
                'event_date' => '2026-10-24',
                'background_music' => asset('audio/wedding-song.mp3'),
                'quote_text' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
                'quote_source' => 'Q.S. Ar-Rum: 21',
                'cover_image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&auto=format&fit=crop&q=80',
                'is_published' => true,
            ]
        );

        // Couple
        Couple::updateOrCreate(
            ['invitation_id' => $invitation->id],
            [
                'groom_name' => 'Raka Adiputra, S.T.',
                'groom_nickname' => 'Raka',
                'groom_father' => 'Bpk. Dr. H. Bambang Soediro',
                'groom_mother' => 'Ibu Hj. Ratna Juwita',
                'groom_instagram' => 'raka.adiputra',
                'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
                'bride_name' => 'Arinda Putri Larasati, S.I.Kom',
                'bride_nickname' => 'Arinda',
                'bride_father' => 'Bpk. Ir. H. Hendra Wijaya, M.M.',
                'bride_mother' => 'Ibu Hj. Dewi Kusuma Wardani',
                'bride_instagram' => 'arindaputri.l',
                'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
            ]
        );

        // Events: Akad & Resepsi
        Event::updateOrCreate(
            ['invitation_id' => $invitation->id, 'title' => 'Akad Nikah'],
            [
                'date' => '2026-10-24',
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
                'timezone' => 'WIB',
                'venue_name' => 'Masjid Agung Sunda Kelapa, Jakarta',
                'address' => 'Jl. Taman Sunda Kelapa No.16, Menteng, Kota Jakarta Pusat, DKI Jakarta 10310',
                'google_maps_url' => 'https://maps.google.com/?q=Masjid+Agung+Sunda+Kelapa+Jakarta',
                'calendar_url' => 'https://calendar.google.com/',
            ]
        );

        Event::updateOrCreate(
            ['invitation_id' => $invitation->id, 'title' => 'Resepsi Pernikahan'],
            [
                'date' => '2026-10-24',
                'start_time' => '11:00:00',
                'end_time' => '14:00:00',
                'timezone' => 'WIB',
                'venue_name' => 'The Glass House Grand Ballroom, Ritz Carlton Jakarta',
                'address' => 'Jl. Mega Kuningan Barat No.1, Kuningan Timur, Setiabudi, Jakarta Selatan 12950',
                'google_maps_url' => 'https://maps.google.com/?q=The+Ritz-Carlton+Jakarta+Mega+Kuningan',
                'calendar_url' => 'https://calendar.google.com/',
            ]
        );

        // Story Timeline
        $stories = [
            [
                'year_or_date' => '2020',
                'title' => 'Awal Mula Pertemuan',
                'description' => 'Kami pertama kali dipertemukan dalam sebuah proyek perancangan arsitektur di Bandung. Berawal dari diskusi profesional yang intens, perlahan rasa saling mengagumi dan kenyamanan tumbuh.',
                'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=600&auto=format&fit=crop&q=80',
                'order_position' => 1,
            ],
            [
                'year_or_date' => '2023',
                'title' => 'Komitmen & Kebersamaan',
                'description' => 'Setelah melalui berbagai pencapaian hidup bersama, saling mendukung karir dan impian, kami sepakat untuk melangkah ke jenjang yang lebih serius dan berkomitmen seumur hidup.',
                'image' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=600&auto=format&fit=crop&q=80',
                'order_position' => 2,
            ],
            [
                'year_or_date' => '2025',
                'title' => 'Momen Lamaran Resmi',
                'description' => 'Di hadapan kedua keluarga besar tercinta di Jakarta, kami resmi mengikat janji suci pertunangan untuk menyatukan dua keluarga dalam ikatan pernikahan yang berkah.',
                'image' => 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=600&auto=format&fit=crop&q=80',
                'order_position' => 3,
            ],
        ];

        foreach ($stories as $storyData) {
            Story::updateOrCreate(
                ['invitation_id' => $invitation->id, 'title' => $storyData['title']],
                $storyData
            );
        }

        // Galleries
        $galleries = [
            ['media_type' => 'photo', 'file_url' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 1', 'order_position' => 1],
            ['media_type' => 'photo', 'file_url' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 2', 'order_position' => 2],
            ['media_type' => 'photo', 'file_url' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 3', 'order_position' => 3],
            ['media_type' => 'photo', 'file_url' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 4', 'order_position' => 4],
            ['media_type' => 'photo', 'file_url' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 5', 'order_position' => 5],
            ['media_type' => 'photo', 'file_url' => 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 6', 'order_position' => 6],
        ];

        foreach ($galleries as $galleryData) {
            Gallery::updateOrCreate(
                ['invitation_id' => $invitation->id, 'file_url' => $galleryData['file_url']],
                $galleryData
            );
        }

        // Wallets
        Wallet::updateOrCreate(
            ['invitation_id' => $invitation->id, 'bank_name' => 'BCA'],
            [
                'account_number' => '8801234567',
                'account_name' => 'Raka Adiputra',
                'gift_address' => 'Jl. Senopati Raya No. 45, Kebayoran Baru, Jakarta Selatan 12190',
            ]
        );

        Wallet::updateOrCreate(
            ['invitation_id' => $invitation->id, 'bank_name' => 'Bank Mandiri'],
            [
                'account_number' => '1370019283741',
                'account_name' => 'Arinda Putri Larasati',
                'gift_address' => 'Jl. Senopati Raya No. 45, Kebayoran Baru, Jakarta Selatan 12190',
            ]
        );

        // Guests
        Guest::updateOrCreate(
            ['invitation_id' => $invitation->id, 'name' => 'Reyhan'],
            [
                'phone_number' => '081234567890',
                'slug_url' => 'budi-santoso',
                'group' => 'VIP',
                'attendance_status' => 'hadir',
                'pax_confirmed' => 2,
            ]
        );

        // Wishes
        Wish::updateOrCreate(
            ['invitation_id' => $invitation->id, 'guest_name' => 'Dimas & Anisa'],
            [
                'attendance' => 'Hadir (2 Orang)',
                'message' => 'Selamat menempuh hidup baru Raka & Arinda! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Bahagia selamanya!',
                'is_hidden' => false,
            ]
        );

        Wish::updateOrCreate(
            ['invitation_id' => $invitation->id, 'guest_name' => 'Bpk. Ir. Gunawan Wibisono'],
            [
                'attendance' => 'Hadir (2 Orang)',
                'message' => 'Barakallahu lakuma wa baraka alaikuma wa jama\'a bainakuma fii khoir. Selamat berbahagia untuk kedua mempelai dan keluarga besar.',
                'is_hidden' => false,
            ]
        );
    }
}
