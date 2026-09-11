<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicInvitationController extends Controller
{
    /**
     * Tampilkan website undangan digital publik interaktif.
     */
    public function show(string $slug, Request $request): View
    {
        $invitation = Invitation::where('slug', $slug)
            ->with(['theme', 'couples', 'events', 'stories', 'media', 'gifts', 'wallets', 'wishes', 'setting'])
            ->firstOrFail();

        $guestName = $request->query('to', 'Reyhan');

        $presets = config('themes.presets', []);
        $slugToPreset = config('themes.slug_to_preset', []);

        $themeSlug = $invitation->theme->slug ?? 'minimalist';
        $styleKey = $request->query('style', $slugToPreset[$themeSlug] ?? 'minimalist');
        $activeStyle = $presets[$styleKey] ?? $presets['minimalist'];

        // Tentukan view layout dari database theme view_path atau override query parameter
        $requestedLayout = $request->query('layout');
        if ($requestedLayout && view()->exists("demo.{$requestedLayout}")) {
            $viewName = "demo.{$requestedLayout}";
        } elseif ($invitation->theme?->view_path && view()->exists($invitation->theme->view_path)) {
            $viewName = $invitation->theme->view_path;
        } else {
            $viewName = 'demo.classic';
        }
        $layout = str_replace('demo.', '', $viewName);

        // Susun data dari database
        $couples = $invitation->couples;
        $groom = $couples->firstWhere('role', 'groom');
        $bride = $couples->firstWhere('role', 'bride');

        $groomName = $groom?->full_name ?: '';
        $groomNickname = $groom?->nickname ?: ($groom?->full_name ? explode(' ', trim($groom->full_name))[0] : '');
        $groomFather = $groom?->father_name ?: '';
        $groomMother = $groom?->mother_name ?: '';
        $groomChildOrder = $groom?->child_number ?: '';
        $groomInstagram = $groom?->instagram ? ltrim(trim($groom->instagram), '@') : '';
        $groomPhoto = $groom?->photo_url ?: ($activeStyle['groom_photo'] ?? null);

        $brideName = $bride?->full_name ?: '';
        $brideNickname = $bride?->nickname ?: ($bride?->full_name ? explode(' ', trim($bride->full_name))[0] : '');
        $brideFather = $bride?->father_name ?: '';
        $brideMother = $bride?->mother_name ?: '';
        $brideChildOrder = $bride?->child_number ?: '';
        $brideInstagram = $bride?->instagram ? ltrim(trim($bride->instagram), '@') : '';
        $bridePhoto = $bride?->photo_url ?: ($activeStyle['bride_photo'] ?? null);

        $events = $invitation->events;
        $akad = $events->firstWhere('title', 'Akad Nikah') ?? $events->first();
        $resepsi = $events->firstWhere('title', 'Resepsi Pernikahan') ?? $events->skip(1)->first();

        // Format tanggal acara
        $akadDateStr = $akad?->date ? $akad->date->translatedFormat('l, d F Y') : ($invitation->event_date ? $invitation->event_date->translatedFormat('l, d F Y') : '');
        $resepsiDateStr = $resepsi?->date ? $resepsi->date->translatedFormat('l, d F Y') : '';

        // Galeri foto dari media
        $galleryPhotos = $invitation->media
            ->filter(fn ($m) => ($m->media_type ?? 'photo') === 'photo')
            ->map(fn ($m) => $m->url ?? $m->file_url)
            ->filter()
            ->values()
            ->toArray();

        // ponytail: no demo fallback for gallery; empty array renders no section

        // Rekening bank / amplop digital
        $bankAccounts = [];
        $bankColors = ['from-blue-600 to-blue-800', 'from-amber-600 to-amber-800', 'from-emerald-600 to-emerald-800', 'from-rose-600 to-rose-800'];
        $gifts = $invitation->gifts->isNotEmpty() ? $invitation->gifts : $invitation->wallets;
        foreach ($gifts as $idx => $wallet) {
            if (! empty($wallet->bank_name) && ! empty($wallet->account_number)) {
                $bankAccounts[] = [
                    'bank' => $wallet->bank_name,
                    'account_number' => $wallet->account_number,
                    'account_name' => $wallet->account_name ?: $groomNickname,
                    'color' => $bankColors[$idx % count($bankColors)],
                ];
            }
        }
        // ponytail: no demo fallback for bank accounts; empty array = no amplop digital section
        // ponytail: no demo wishes; empty array = clean RSVP section
        // Keys: name, time, status, msg — used directly by Alpine.js in all templates
        $sampleWishes = $invitation->wishes->take(20)->map(fn ($w) => [
            'name' => $w->guest_name,
            'time' => $w->created_at ? $w->created_at->diffForHumans() : 'Baru saja',
            'status' => $w->attendance ?? 'Hadir',
            'attendance' => $w->attendance ?? 'Hadir',
            'msg' => $w->message,
            'message' => $w->message,
        ])->values()->all();
        $targetDate = $akad?->date ? $akad->date->format('Y-m-d') : ($invitation->event_date ? $invitation->event_date->format('Y-m-d') : null);
        $countdownTarget = $targetDate ? $targetDate.'T'.($akad?->start_time ? substr($akad->start_time, 0, 5) : '08:00').':00+07:00' : null;

        $gcalDates = '';
        if ($countdownTarget) {
            try {
                $startDt = Carbon::parse($countdownTarget)->utc();
                $endDt = (clone $startDt)->addHours(4);
                $gcalDates = '&dates='.$startDt->format('Ymd\THis\Z').'/'.$endDt->format('Ymd\THis\Z');
            } catch (\Throwable) {
            }
        }
        $calendarTitle = 'Pernikahan '.($groomNickname ?: 'Pengantin').' & '.($brideNickname ?: 'Pengantin');
        $calendarDetails = 'Pernikahan '.trim($groomName.' & '.$brideName, ' &');
        $calendarLocation = trim(($akad?->venue_name ?: '').', '.($akad?->address ?: ''), ', ');
        $googleCalendarUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE'
            .'&text='.urlencode($calendarTitle)
            .$gcalDates
            .'&details='.urlencode($calendarDetails)
            .'&location='.urlencode($calendarLocation);

        $giftAddress = null;
        $physicalGift = $invitation->gifts->firstWhere('gift_type', 'physical_gift')
            ?? $invitation->gifts->first(fn ($g) => ! empty($g->recipient_address));
        if ($physicalGift && ! empty($physicalGift->recipient_address)) {
            $giftAddress = $physicalGift->recipient_address;
        } elseif (! empty($invitation->setting?->metadata['gift_address'])) {
            $giftAddress = $invitation->setting->metadata['gift_address'];
        }

        $data = [
            'title' => $invitation->title,
            'cover_image' => $invitation->cover_image ?: ($activeStyle['cover_bg'] ?? null),
            'background_music' => $invitation->background_music ?: ($activeStyle['audio_url'] ?? '/audio/wedding-song.mp3'),
            'quote_text' => $invitation->quote_text ?: '',
            'quote_source' => $invitation->quote_source ?: '',
            'countdown_target' => $countdownTarget,
            'google_calendar_url' => $googleCalendarUrl,

            'groom' => [
                'name' => $groomName,
                'nickname' => $groomNickname,
                'father' => $groomFather,
                'mother' => $groomMother,
                'child_order' => $groomChildOrder,
                'instagram' => $groomInstagram,
                'photo' => $groomPhoto,
            ],
            'bride' => [
                'name' => $brideName,
                'nickname' => $brideNickname,
                'father' => $brideFather,
                'mother' => $brideMother,
                'child_order' => $brideChildOrder,
                'instagram' => $brideInstagram,
                'photo' => $bridePhoto,
            ],

            'events' => [
                'akad' => [
                    'title' => $akad?->title ?: 'Akad Nikah',
                    'date' => $akadDateStr,
                    'time' => $akad?->start_time ?: '',
                    'venue' => $akad?->venue_name ?: '',
                    'address' => $akad?->address ?: '',
                    'maps_link' => $akad?->maps_url ?: ($akad?->google_maps_url ?: ''),
                ],
                'resepsi' => [
                    'title' => $resepsi?->title ?: 'Resepsi Pernikahan',
                    'date' => $resepsiDateStr,
                    'time' => $resepsi?->start_time ?: '',
                    'venue' => $resepsi?->venue_name ?: '',
                    'address' => $resepsi?->address ?: '',
                    'maps_link' => $resepsi?->maps_url ?: ($resepsi?->google_maps_url ?: ''),
                ],
            ],

            'stories' => $invitation->stories->isNotEmpty()
                ? $invitation->stories->map(fn ($st) => [
                    'year' => $st->date ?? $st->year_or_date ?? '',
                    'title' => $st->title,
                    'desc' => $st->story ?? $st->description ?? '',
                    'image_url' => $st->image_url ?? '',
                ])->toArray()
                : [],

            'galleries' => $galleryPhotos,
            'bank_accounts' => $bankAccounts,
            'gift_address' => $giftAddress,
            'sample_wishes' => $sampleWishes,
        ];

        return view($viewName, [
            'invitation' => $invitation,
            'activeStyle' => $activeStyle,
            'presets' => $presets,
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
