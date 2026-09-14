<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicInvitationController extends Controller
{
    /**
     * Tampilkan website undangan digital publik interaktif (dengan server caching).
     */
    public function show(string $slug, Request $request): View
    {
        $cacheKey = "invitation:public:{$slug}";
        $payload = Cache::remember($cacheKey, now()->addHours(24), function () use ($slug) {
            return $this->buildInvitationPayload($slug);
        });

        if (! $payload) {
            abort(404);
        }

        $invitation = $payload['invitation'];
        $data = $payload['data'];
        $themeSlug = $payload['themeSlug'];

        $guestName = $request->query('to', 'Reyhan');

        $presets = config('themes.presets', []);
        $slugToPreset = config('themes.slug_to_preset', []);

        $styleKey = $request->query('style', $slugToPreset[$themeSlug] ?? 'minimalist');
        $activeStyle = $presets[$styleKey] ?? $presets['minimalist'];

        // Tentukan view layout dari database theme view_path atau override query parameter
        $requestedLayout = $request->query('layout');
        if ($requestedLayout && view()->exists("demo.{$requestedLayout}")) {
            $viewName = "demo.{$requestedLayout}";
        } elseif (! empty($payload['defaultViewName']) && view()->exists($payload['defaultViewName'])) {
            $viewName = $payload['defaultViewName'];
        } else {
            $viewName = 'demo.classic';
        }
        $layout = str_replace('demo.', '', $viewName);

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
     * Susun dan strukturkan data undangan untuk disimpan dalam cache.
     */
    protected function buildInvitationPayload(string $slug): ?array
    {
        $invitation = Invitation::where('slug', $slug)
            ->with(['theme', 'couples', 'events', 'stories', 'media', 'gifts', 'wallets', 'wishes', 'setting'])
            ->first();

        if (! $invitation) {
            return null;
        }

        $presets = config('themes.presets', []);
        $slugToPreset = config('themes.slug_to_preset', []);
        $themeSlug = $invitation->theme->slug ?? 'minimalist';
        $styleKey = $slugToPreset[$themeSlug] ?? 'minimalist';
        $activeStyle = $presets[$styleKey] ?? $presets['minimalist'];

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

        // Format tanggal acara dan komponen kalender
        $akadDate = $akad?->date ?? $invitation->event_date;
        $akadDateStr = $akadDate ? $akadDate->translatedFormat('l, d F Y') : '';
        $akadDay = $akadDate ? $akadDate->translatedFormat('l') : 'Minggu';
        $akadDayNum = $akadDate ? $akadDate->format('d') : '28';
        $akadMonth = $akadDate ? $akadDate->translatedFormat('F') : 'Desember';
        $akadYear = $akadDate ? $akadDate->format('Y') : '2026';
        $akadTimeFormatted = $akad?->start_time ? ($akad->start_time.($akad->end_time ? ' - '.$akad->end_time : '').($akad->timezone ? ' '.$akad->timezone : '')) : '08:00 WIB';
        $akadMapsLink = $akad?->maps_url ?: ($akad?->google_maps_url ?: ($akad?->address || $akad?->venue_name ? 'https://maps.google.com/?q='.urlencode(trim(($akad->venue_name ?? '').' '.($akad->address ?? ''))) : 'https://maps.google.com'));

        $resepsiDate = $resepsi?->date ?? $akadDate;
        $resepsiDateStr = $resepsiDate ? $resepsiDate->translatedFormat('l, d F Y') : '';
        $resepsiDay = $resepsiDate ? $resepsiDate->translatedFormat('l') : 'Minggu';
        $resepsiDayNum = $resepsiDate ? $resepsiDate->format('d') : '28';
        $resepsiMonth = $resepsiDate ? $resepsiDate->translatedFormat('F') : 'Desember';
        $resepsiYear = $resepsiDate ? $resepsiDate->format('Y') : '2026';
        $resepsiTimeFormatted = $resepsi?->start_time ? ($resepsi->start_time.($resepsi->end_time ? ' - '.$resepsi->end_time : '').($resepsi->timezone ? ' '.$resepsi->timezone : '')) : '09:00 - 13:00 WIB';
        $resepsiMapsLink = $resepsi?->maps_url ?: ($resepsi?->google_maps_url ?: ($resepsi?->address || $resepsi?->venue_name ? 'https://maps.google.com/?q='.urlencode(trim(($resepsi->venue_name ?? '').' '.($resepsi->address ?? ''))) : 'https://maps.google.com'));

        // Monogram / Inisial pengantin
        $brideInitial = $brideNickname ? mb_substr($brideNickname, 0, 1) : ($brideName ? mb_substr($brideName, 0, 1) : 'P');
        $groomInitial = $groomNickname ? mb_substr($groomNickname, 0, 1) : ($groomName ? mb_substr($groomName, 0, 1) : 'A');

        // Galeri foto dari media
        $galleryPhotos = $invitation->media
            ->filter(fn ($m) => ($m->media_type ?? 'photo') === 'photo')
            ->map(fn ($m) => $m->url ?? $m->file_url)
            ->filter()
            ->values()
            ->toArray();

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

        $sampleWishes = $invitation->wishes->take(20)->map(fn ($w) => [
            'name' => $w->guest_name,
            'time' => $w->created_at ? $w->created_at->diffForHumans() : 'Baru saja',
            'status' => $w->attendance ?? 'Hadir',
            'attendance' => $w->attendance ?? 'Hadir',
            'msg' => $w->message,
            'message' => $w->message,
        ])->values()->all();

        $timeStr = '08:00';
        if ($akad?->start_time && preg_match('/(\d{1,2}:\d{2})/', $akad->start_time, $matches)) {
            $timeStr = str_pad($matches[1], 5, '0', STR_PAD_LEFT);
        }
        $targetDate = $akadDate ? $akadDate->format('Y-m-d') : null;
        $countdownTarget = $targetDate ? $targetDate.'T'.$timeStr.':00+07:00' : null;
        $countdownTimestamp = $countdownTarget ? strtotime($countdownTarget) : false;
        if (! $countdownTimestamp && $targetDate) {
            $countdownTimestamp = strtotime($targetDate.' 08:00:00');
        }
        if (! $countdownTimestamp) {
            $countdownTimestamp = strtotime('+30 days 08:00:00');
        }

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
            'countdown_timestamp' => $countdownTimestamp,
            'google_calendar_url' => $googleCalendarUrl,

            'initials' => [
                'bride' => mb_strtoupper($brideInitial),
                'groom' => mb_strtoupper($groomInitial),
                'combined' => mb_strtoupper($brideInitial.' & '.$groomInitial),
            ],

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
                    'day' => $akadDay,
                    'day_num' => $akadDayNum,
                    'month' => $akadMonth,
                    'year' => $akadYear,
                    'time' => $akad?->start_time ?: '',
                    'formatted_time' => $akadTimeFormatted,
                    'venue' => $akad?->venue_name ?: '',
                    'address' => $akad?->address ?: '',
                    'maps_link' => $akadMapsLink,
                ],
                'resepsi' => [
                    'title' => $resepsi?->title ?: 'Resepsi Pernikahan',
                    'date' => $resepsiDateStr,
                    'day' => $resepsiDay,
                    'day_num' => $resepsiDayNum,
                    'month' => $resepsiMonth,
                    'year' => $resepsiYear,
                    'time' => $resepsi?->start_time ?: '',
                    'formatted_time' => $resepsiTimeFormatted,
                    'venue' => $resepsi?->venue_name ?: '',
                    'address' => $resepsi?->address ?: '',
                    'maps_link' => $resepsiMapsLink,
                ],
            ],

            'stories' => $invitation->stories->isNotEmpty()
                ? $invitation->stories->map(fn ($st) => [
                    'year' => $st->date ?? $st->year_or_date ?? '',
                    'date' => $st->date ?? $st->year_or_date ?? '',
                    'title' => $st->title,
                    'desc' => $st->story ?? $st->description ?? '',
                    'story' => $st->story ?? $st->description ?? '',
                    'image_url' => $st->image_url ?? '',
                    'image' => $st->image_url ?? '',
                ])->toArray()
                : [],

            'galleries' => $galleryPhotos,
            'bank_accounts' => $bankAccounts,
            'gift_address' => $giftAddress,
            'sample_wishes' => $sampleWishes,
        ];

        return [
            'invitation' => $invitation,
            'data' => $data,
            'defaultViewName' => $invitation->theme?->view_path ?: 'demo.classic',
            'themeSlug' => $themeSlug,
        ];
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

        clear_invitation_cache($slug);

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
