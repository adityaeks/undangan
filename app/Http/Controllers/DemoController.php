<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    /**
     * Menampilkan master invitation preview dengan gaya & layout terpilih.
     */
    public function index(Request $request): View
    {
        if ($request->boolean('standalone') || $request->boolean('raw')) {
            $layout = $request->query('layout', 'classic');
            $defaultStyle = match ($layout) {
                'editorial' => 'editorial',
                'botanical' => 'botanical',
                'minimalist' => 'minimalist',
                'rose-romance' => 'rose-romance',
                'classic' => 'classic',
                default => 'classic',
            };
            $style = $request->query('style', $defaultStyle);

            return $this->renderInvitation($style, $layout, $request);
        }

        $themes = ThemeCatalogController::getMasterThemes();
        $selectedThemeSlug = $request->query('theme', 'editorial');
        $guestName = $request->query('to', 'Reyhan');
        $defaultData = config('themes.demo_data');

        return view('demo.studio', [
            'themes' => $themes,
            'selectedThemeSlug' => $selectedThemeSlug,
            'defaultData' => [
                'groom_nickname' => $request->query('groom_nickname', 'Raka'),
                'bride_nickname' => $request->query('bride_nickname', 'Arinda'),
                'groom_name' => $request->query('groom_name', 'Raka Pratama, S.T.'),
                'bride_name' => $request->query('bride_name', 'Arinda Putri Larasati, S.I.Kom'),
                'guest_name' => $guestName,
                'event_date' => $request->query('date', 'Sabtu, 24 Oktober 2026'),
                'venue_name' => $request->query('venue', 'Grand Ballroom The Ritz-Carlton, Jakarta'),
                'akad_title' => 'Akad Nikah',
                'resepsi_title' => 'Resepsi Pernikahan',
                'stories' => $defaultData['stories'],
            ],
        ]);
    }

    /**
     * Menampilkan master invitation preview berdasarkan slug tema/gaya/layout.
     */
    public function show(string $slug, Request $request): View
    {
        $canonicalSlug = config("themes.slug_to_preset.{$slug}", $slug);
        $layout = in_array($canonicalSlug, ['editorial', 'botanical', 'classic', 'minimalist', 'rose-romance'], true)
            ? $canonicalSlug
            : 'classic';

        return $this->renderInvitation($canonicalSlug, $layout, $request);
    }

    /**
     * Helper render master invitation dengan data lengkap & live customizer.
     */
    protected function renderInvitation(string $styleKey, string $layout, Request $request): View
    {
        $presets = config('themes.presets', []);
        $activeStyle = $presets[$styleKey] ?? $presets['minimalist'];
        $defaults = config('themes.demo_data');

        $groomNickname = $request->query('groom_nickname', 'Raka');
        $brideNickname = $request->query('bride_nickname', 'Arinda');
        $groomName = $request->query('groom_name', 'Raka Pratama, S.T.');
        $brideName = $request->query('bride_name', 'Arinda Putri Larasati, S.I.Kom');
        $eventDate = $request->query('date', 'Sabtu, 24 Oktober 2026');
        $venueName = $request->query('venue', 'Grand Ballroom The Ritz-Carlton');

        $stories = $defaults['stories'];
        if ($request->filled('stories')) {
            $raw = $request->query('stories');
            $decoded = is_string($raw) ? json_decode($raw, true) : $raw;
            if (is_array($decoded) && ! empty($decoded)) {
                $stories = $decoded;
            }
        }

        $demoData = [
            'title' => 'The Wedding of '.$groomNickname.' & '.$brideNickname,
            'cover_image' => $activeStyle['cover_bg'] ?? null,
            'background_music' => $activeStyle['audio_url'] ?? '/audio/wedding-song.mp3',
            'quote_text' => $defaults['quote_text'] ?? 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
            'quote_source' => $defaults['quote_source'] ?? 'QS. Ar-Rum: 21',
            'groom' => array_merge($defaults['groom'], [
                'name' => $groomName,
                'nickname' => $groomNickname,
                'photo' => $activeStyle['groom_photo'] ?? ($defaults['groom']['photo'] ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80'),
            ]),
            'bride' => array_merge($defaults['bride'], [
                'name' => $brideName,
                'nickname' => $brideNickname,
                'photo' => $activeStyle['bride_photo'] ?? ($defaults['bride']['photo'] ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80'),
            ]),
            'events' => [
                'akad' => array_merge($defaults['events']['akad'], [
                    'date' => $eventDate,
                ]),
                'resepsi' => array_merge($defaults['events']['resepsi'], [
                    'date' => $eventDate,
                    'venue' => $venueName,
                ]),
            ],
            'countdown_target' => $defaults['countdown_target'],
            'google_calendar_url' => 'https://calendar.google.com/calendar/render?action=TEMPLATE'
                .'&text='.urlencode('Pernikahan '.($groomNickname ?: 'Raka').' & '.($brideNickname ?: 'Arinda'))
                .'&dates='.Carbon::parse($defaults['countdown_target'])->utc()->format('Ymd\THis\Z').'/'
                .Carbon::parse($defaults['countdown_target'])->utc()->addHours(4)->format('Ymd\THis\Z')
                .'&details='.urlencode('Pernikahan '.$groomName.' & '.$brideName)
                .'&location='.urlencode(($defaults['events']['akad']['venue'] ?? '').', '.($defaults['events']['akad']['address'] ?? '')),
            'stories' => $stories,
            'galleries' => $defaults['galleries'],
            'bank_accounts' => $defaults['bank_accounts'],
            'gift_address' => $defaults['gift_address'],
            'sample_wishes' => $defaults['sample_wishes'],
        ];

        $viewName = match ($layout) {
            'editorial' => 'demo.editorial',
            'botanical' => 'demo.botanical',
            'minimalist', 'warm-minimalist', 'royal-luxury' => 'demo.minimalist',
            'rose-romance', 'romantic', 'rose-floral' => 'demo.rose-romance',
            default => 'demo.classic',
        };

        return view($viewName, [
            'activeStyle' => $activeStyle,
            'presets' => $presets,
            'guestName' => $request->query('to', 'Reyhan'),
            'layout' => $layout,
            'data' => $demoData,
            'isEmbed' => $request->boolean('embed'),
        ]);
    }
}
