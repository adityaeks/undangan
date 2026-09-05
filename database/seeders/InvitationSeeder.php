<?php

namespace Database\Seeders;

use App\Models\Invitation;
use App\Models\InvitationCouple;
use App\Models\InvitationEvent;
use App\Models\InvitationGift;
use App\Models\InvitationGuest;
use App\Models\InvitationMedia;
use App\Models\InvitationSetting;
use App\Models\InvitationStory;
use App\Models\InvitationWish;
use App\Models\Theme;
use App\Models\User;
use App\Models\UserTheme;
use Illuminate\Database\Seeder;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $theme = Theme::where('slug', 'minimalist')->first() ?? Theme::first();

        if (! $user || ! $theme) {
            return;
        }

        $invitation = Invitation::updateOrCreate(
            ['slug' => 'raka-arinda'],
            [
                'user_id' => $user->id,
                'owner_id' => $user->id,
                'theme_id' => $theme->id,
                'title' => 'The Wedding of Raka & Arinda',
                'event_type' => 'wedding',
                'event_date' => '2026-10-24',
                'background_music' => asset('audio/wedding-song.mp3'),
                'quote_text' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
                'quote_source' => 'Q.S. Ar-Rum: 21',
                'cover_image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&auto=format&fit=crop&q=80',
                'is_published' => true,
                'status' => 'published',
                'published_at' => now(),
            ]
        );

        // Ensure user theme ownership
        UserTheme::firstOrCreate(
            ['user_id' => $user->id, 'theme_id' => $theme->id],
            ['unlocked_at' => now()]
        );

        // Settings
        InvitationSetting::updateOrCreate(
            ['invitation_id' => $invitation->id],
            [
                'bg_music_url' => asset('audio/wedding-song.mp3'),
                'is_music_autoplay' => false,
                'quote_text' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
                'quote_source' => 'Q.S. Ar-Rum: 21',
                'enable_comments' => true,
                'enable_rsvp' => true,
            ]
        );

        // Couples (Groom & Bride)
        InvitationCouple::updateOrCreate(
            ['invitation_id' => $invitation->id, 'role' => 'groom'],
            [
                'full_name' => 'Raka Adiputra, S.T.',
                'nickname' => 'Raka',
                'father_name' => 'Bpk. Dr. H. Bambang Soediro',
                'mother_name' => 'Ibu Hj. Ratna Juwita',
                'instagram' => 'raka.adiputra',
                'photo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
                'order' => 1,
            ]
        );

        InvitationCouple::updateOrCreate(
            ['invitation_id' => $invitation->id, 'role' => 'bride'],
            [
                'full_name' => 'Arinda Putri Larasati, S.I.Kom',
                'nickname' => 'Arinda',
                'father_name' => 'Bpk. Ir. H. Hendra Wijaya, M.M.',
                'mother_name' => 'Ibu Hj. Dewi Kusuma Wardani',
                'instagram' => 'arindaputri.l',
                'photo_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80',
                'order' => 2,
            ]
        );

        // Events: Akad & Resepsi
        InvitationEvent::updateOrCreate(
            ['invitation_id' => $invitation->id, 'title' => 'Akad Nikah'],
            [
                'type' => 'wedding',
                'date' => '2026-10-24',
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
                'timezone' => 'WIB',
                'venue_name' => 'Masjid Agung Sunda Kelapa, Jakarta',
                'address' => 'Jl. Taman Sunda Kelapa No.16, Menteng, Kota Jakarta Pusat, DKI Jakarta 10310',
                'maps_url' => 'https://maps.google.com/?q=Masjid+Agung+Sunda+Kelapa+Jakarta',
                'order' => 1,
            ]
        );

        InvitationEvent::updateOrCreate(
            ['invitation_id' => $invitation->id, 'title' => 'Resepsi Pernikahan'],
            [
                'type' => 'wedding',
                'date' => '2026-10-24',
                'start_time' => '11:00:00',
                'end_time' => '14:00:00',
                'timezone' => 'WIB',
                'venue_name' => 'The Glass House Grand Ballroom, Ritz Carlton Jakarta',
                'address' => 'Jl. Mega Kuningan Barat No.1, Kuningan Timur, Setiabudi, Jakarta Selatan 12950',
                'maps_url' => 'https://maps.google.com/?q=The+Ritz-Carlton+Jakarta+Mega+Kuningan',
                'order' => 2,
            ]
        );

        // Story Timeline
        $stories = [
            [
                'title' => 'Awal Mula Pertemuan',
                'date' => '2020',
                'story' => 'Kami pertama kali dipertemukan dalam sebuah proyek perancangan arsitektur di Bandung. Berawal dari diskusi profesional yang intens, perlahan rasa saling mengagumi dan kenyamanan tumbuh.',
                'image_url' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=600&auto=format&fit=crop&q=80',
                'order' => 1,
            ],
            [
                'title' => 'Komitmen & Kebersamaan',
                'date' => '2023',
                'story' => 'Setelah melalui berbagai pencapaian hidup bersama, saling mendukung karir dan impian, kami sepakat untuk melangkah ke jenjang yang lebih serius dan berkomitmen seumur hidup.',
                'image_url' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=600&auto=format&fit=crop&q=80',
                'order' => 2,
            ],
            [
                'title' => 'Momen Lamaran Resmi',
                'date' => '2025',
                'story' => 'Di hadapan kedua keluarga besar tercinta di Jakarta, kami resmi mengikat janji suci pertunangan untuk menyatukan dua keluarga dalam ikatan pernikahan yang berkah.',
                'image_url' => 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=600&auto=format&fit=crop&q=80',
                'order' => 3,
            ],
        ];

        foreach ($stories as $storyData) {
            InvitationStory::updateOrCreate(
                ['invitation_id' => $invitation->id, 'title' => $storyData['title']],
                $storyData
            );
        }

        // Media
        $galleries = [
            ['media_type' => 'photo', 'url' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 1', 'order' => 1],
            ['media_type' => 'photo', 'url' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 2', 'order' => 2],
            ['media_type' => 'photo', 'url' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 3', 'order' => 3],
            ['media_type' => 'photo', 'url' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 4', 'order' => 4],
            ['media_type' => 'photo', 'url' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 5', 'order' => 5],
            ['media_type' => 'photo', 'url' => 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=800&auto=format&fit=crop&q=80', 'caption' => 'Prewedding Photo 6', 'order' => 6],
        ];

        foreach ($galleries as $galleryData) {
            InvitationMedia::updateOrCreate(
                ['invitation_id' => $invitation->id, 'url' => $galleryData['url']],
                $galleryData
            );
        }

        // Gifts / Wallets
        InvitationGift::updateOrCreate(
            ['invitation_id' => $invitation->id, 'bank_name' => 'BCA'],
            [
                'gift_type' => 'bank_transfer',
                'account_number' => '8801234567',
                'account_name' => 'Raka Adiputra',
                'recipient_address' => 'Jl. Senopati Raya No. 45, Kebayoran Baru, Jakarta Selatan 12190',
                'order' => 1,
            ]
        );

        InvitationGift::updateOrCreate(
            ['invitation_id' => $invitation->id, 'bank_name' => 'Bank Mandiri'],
            [
                'gift_type' => 'bank_transfer',
                'account_number' => '1370019283741',
                'account_name' => 'Arinda Putri Larasati',
                'recipient_address' => 'Jl. Senopati Raya No. 45, Kebayoran Baru, Jakarta Selatan 12190',
                'order' => 2,
            ]
        );

        // Guests
        InvitationGuest::updateOrCreate(
            ['invitation_id' => $invitation->id, 'name' => 'Reyhan'],
            [
                'phone' => '081234567890',
                'slug' => 'budi-santoso',
                'category' => 'VIP',
                'attendance_status' => 'hadir',
                'pax' => 2,
            ]
        );

        // Wishes
        InvitationWish::updateOrCreate(
            ['invitation_id' => $invitation->id, 'guest_name' => 'Dimas & Anisa'],
            [
                'attendance_status' => 'Hadir (2 Orang)',
                'message' => 'Selamat menempuh hidup baru Raka & Arinda! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Bahagia selamanya!',
                'is_approved' => true,
            ]
        );

        InvitationWish::updateOrCreate(
            ['invitation_id' => $invitation->id, 'guest_name' => 'Bpk. Ir. Gunawan Wibisono'],
            [
                'attendance_status' => 'Hadir (2 Orang)',
                'message' => 'Barakallahu lakuma wa baraka alaikuma wa jama\'a bainakuma fii khoir. Selamat berbahagia untuk kedua mempelai dan keluarga besar.',
                'is_approved' => true,
            ]
        );
    }
}
