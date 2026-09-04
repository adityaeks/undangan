<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ThemeCatalogController extends Controller
{
    /**
     * Menampilkan halaman kumpulan katalog template tema undangan pernikahan.
     */
    public function index(Request $request): View
    {
        $masterThemes = [
            [
                'id' => 'editorial',
                'number' => 'Tema Desain 01',
                'name' => 'The Vogue Editorial Issue',
                'slug' => 'editorial',
                'category' => 'modern',
                'category_label' => 'Modern Dark Studio',
                'tag' => '★ Tren 2026 • Editorial',
                'tag_badge_class' => 'bg-amber-500 text-charcoal-950 font-extrabold',
                'thumbnail' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=800&auto=format&fit=crop&q=80',
                'secondary_image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                'description' => 'Desain bergaya majalah fashion internasional dengan Bento Grid arsitektural, timeline horizontal estetik, dan pemutar musik Dynamic Island.',
                'typography' => 'Cinzel + Cormorant Garamond',
                'colors' => [
                    ['hex' => '#0A0C13', 'name' => 'Obsidian Deep'],
                    ['hex' => '#121624', 'name' => 'Midnight Slate'],
                    ['hex' => '#38BDF8', 'name' => 'Cosmic Cyan'],
                    ['hex' => '#F8FAFC', 'name' => 'Pure Starlight'],
                ],
                'features' => [
                    'Bento Grid Event Schedule',
                    'Dynamic Island Floating Audio Player',
                    'Interactive Love Story Horizontal Carousel',
                    'Modern Dark Mode Luxury Finish',
                ],
                'best_for' => 'Pasangan modern, resepsi malam ballroom, pesta elegan minimalis',
                'rating' => '4.98',
                'reviews_count' => '1.240',
                'price' => 'Rp 49.000',
                'demo_url' => route('demo.show', ['slug' => 'editorial']),
            ],
            [
                'id' => 'botanical',
                'number' => 'Tema Desain 02',
                'name' => 'The Ethereal Botanical Glass',
                'slug' => 'botanical',
                'category' => 'botanical',
                'category_label' => 'Sage Botanical & Rustic',
                'tag' => '🌿 Botanical Glass & Rustic',
                'tag_badge_class' => 'bg-emerald-600 text-white font-bold',
                'thumbnail' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=80',
                'secondary_image' => 'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&auto=format&fit=crop&q=80',
                'description' => 'Bingkai lengkung arsitektural (arch geometry) dengan layer kaca buram (frosted glass) lembut, floral watermark, dan pemutar piringan hitam vintage.',
                'typography' => 'Italiana + Cormorant Garamond',
                'colors' => [
                    ['hex' => '#F4F7F4', 'name' => 'Sage Mist'],
                    ['hex' => '#1D3328', 'name' => 'Forest Pine'],
                    ['hex' => '#3E6F56', 'name' => 'Olive Leaf'],
                    ['hex' => '#DCE5DE', 'name' => 'Frosted Frost'],
                ],
                'features' => [
                    'Arch Window Architectural Frames',
                    'Vinyl Record Player Animated Spinner',
                    'Frosted Glass Translucent Cards',
                    'Gentle Organic Floral Accents',
                ],
                'best_for' => 'Garden party, resepsi outdoor, rustic chic, pernikahan alam terbuka',
                'rating' => '4.95',
                'reviews_count' => '890',
                'price' => 'Rp 49.000',
                'demo_url' => route('demo.show', ['slug' => 'botanical']),
            ],
            [
                'id' => 'classic',
                'number' => 'Tema Desain 03',
                'name' => 'The Timeless Classic Card',
                'slug' => 'classic',
                'category' => 'classic',
                'category_label' => 'Nusantara Adat & Heritage',
                'tag' => '👑 Timeless Simplicity • Adat',
                'tag_badge_class' => 'bg-slate-800 text-amber-300 font-bold border border-amber-400/30',
                'thumbnail' => 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=800&auto=format&fit=crop&q=80',
                'secondary_image' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&auto=format&fit=crop&q=80',
                'description' => 'Tata letak kartu vertikal bertingkat rapi dengan amplop pembuka bersimbol wax seal emas, countdown timer terpusat, dan motif songket batik warisan nusantara.',
                'typography' => 'Playfair Display + Plus Jakarta Sans',
                'colors' => [
                    ['hex' => '#FDF8F2', 'name' => 'Warm Ivory'],
                    ['hex' => '#2B0E11', 'name' => 'Royal Maroon'],
                    ['hex' => '#B67E22', 'name' => 'Songket Gold'],
                    ['hex' => '#ECDDCB', 'name' => 'Linen Silk'],
                ],
                'features' => [
                    'Wax Seal Envelope Interactive Intro',
                    'Songket & Batik Gold Borders',
                    'Clean Stacked Information Hierarchy',
                    'Direct Bank Transfer Badges',
                ],
                'best_for' => 'Akad nikah tradisional, adat Jawa/Sunda/Minang/Melayu, resepsi formal sakral',
                'rating' => '4.97',
                'reviews_count' => '960',
                'price' => 'Rp 49.000',
                'demo_url' => route('demo.show', ['slug' => 'classic']),
            ],
        ];

        // Total tema aktif di database jika ada data tambahan
        $databaseThemesCount = Theme::where('is_active', true)->count();

        return view('themes.catalog', [
            'themes' => $masterThemes,
            'databaseThemesCount' => $databaseThemesCount,
            'currentCategory' => $request->query('kategori', 'all'),
        ]);
    }
}
