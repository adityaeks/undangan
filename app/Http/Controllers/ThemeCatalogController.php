<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ThemeCatalogController extends Controller
{
    /**
     * Mengambil daftar master tema terstandarisasi.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getMasterThemes(): array
    {
        return [
            [
                'id' => 'editorial',
                'number' => 'Tema Desain 01',
                'name' => 'The Vogue Editorial Issue',
                'slug' => 'editorial',
                'category' => 'modern',
                'category_label' => 'Modern Dark Studio',
                'tag' => 'Editorial',
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
                'tag' => 'Botanical Glass',
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
                'tag' => 'Timeless Simplicity',
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
            [
                'id' => 'minimalist',
                'number' => 'Tema Desain 04',
                'name' => 'The Warm Minimalist',
                'slug' => 'minimalist',
                'category' => 'minimalist',
                'category_label' => 'Warm Minimalist & Aesthetic',
                'tag' => 'Clean Art',
                'tag_badge_class' => 'bg-stone-800 text-stone-100 font-semibold',
                'thumbnail' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                'secondary_image' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80',
                'description' => 'Estetika minimalis kontemporer bernuansa warm linen dan soft beige. Tipografi halus, tata letak tenang tanpa ornamen berlebih, dan pemutar musik lembut.',
                'typography' => 'Cormorant Garamond + Plus Jakarta Sans',
                'colors' => [
                    ['hex' => '#FAF8F5', 'name' => 'Warm Linen'],
                    ['hex' => '#EBE3D5', 'name' => 'Soft Cashmere'],
                    ['hex' => '#A8967E', 'name' => 'Muted Earth'],
                    ['hex' => '#211E1B', 'name' => 'Deep Espresso'],
                ],
                'features' => [
                    'Clean Monoline Layout & Fine Serif',
                    'Aesthetic Warm Linen & Paper Palette',
                    'Quiet Luxury Intimate Wedding Flow',
                    'Discreet Minimalist Audio Player',
                ],
                'best_for' => 'Intimate wedding, aesthetic modern, pasangan pecinta konsep minimalis yang hangat dan bersih',
                'rating' => '4.98',
                'reviews_count' => '810',
                'price' => 'Rp 49.000',
                'demo_url' => route('demo.show', ['slug' => 'minimalist']),
            ],
            [
                'id' => 'rose-romance',
                'number' => 'Tema Desain 05',
                'name' => 'The Rose Romance Arch',
                'slug' => 'rose-romance',
                'category' => 'romantic',
                'category_label' => 'Dusty Rose & Floral Arch',
                'tag' => 'Floral Arch',
                'tag_badge_class' => 'bg-rose-700 text-white font-bold',
                'thumbnail' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                'secondary_image' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format&fit=crop&q=80',
                'description' => 'Nuansa romantis dusty rose dan floral watercolor dengan bingkai lengkung (arch frame), potret oval anggun, dan sampul foto transparan Ryan & Vanya.',
                'typography' => 'Alex Brush + Cormorant + Plus Jakarta',
                'colors' => [
                    ['hex' => '#FBF6F7', 'name' => 'Blush Mist'],
                    ['hex' => '#B06F85', 'name' => 'Dusty Mauve'],
                    ['hex' => '#7E465A', 'name' => 'Rosewood'],
                    ['hex' => '#351C25', 'name' => 'Deep Plum'],
                ],
                'features' => [
                    'Cover Transparan Lingkar Monoline Ryan & Vanya',
                    'Bingkai Arch & Potret Oval Floral Watercolor',
                    'Perjalanan Cinta Timeline Cards',
                    'Floating Audio & Amplop Digital 1-Klik',
                ],
                'best_for' => 'Pernikahan romantis, intimate & ballroom wedding, pasangan pecinta estetika floral dusty rose',
                'rating' => '4.99',
                'reviews_count' => '1.450',
                'price' => 'Rp 49.000',
                'demo_url' => route('demo.show', ['slug' => 'rose-romance']),
            ],
        ];
    }

    /**
     * Menampilkan halaman kumpulan katalog template tema undangan pernikahan.
     */
    public function index(Request $request): View
    {
        $masterThemes = self::getMasterThemes();

        // Total tema aktif di database jika ada data tambahan
        $databaseThemesCount = Theme::where('is_active', true)->count();

        return view('themes.catalog', [
            'themes' => $masterThemes,
            'databaseThemesCount' => $databaseThemesCount,
            'currentCategory' => $request->query('kategori', 'all'),
        ]);
    }
}
