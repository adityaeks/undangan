<?php

namespace Database\Seeders;

use App\Models\Invitation;
use App\Models\OrderItem;
use App\Models\Theme;
use App\Models\UserTheme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds for exactly the 5 canonical themes.
     */
    public function run(): void
    {
        $canonicalThemes = [
            [
                'name' => 'The Vogue Editorial Issue',
                'slug' => 'editorial',
                'category' => 'modern',
                'thumbnail' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=800&auto=format&fit=crop&q=80',
                'view_path' => 'demo.editorial',
                'price' => 49000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 01',
                    'category_label' => 'Modern Dark Studio',
                    'tag' => 'Editorial',
                    'tag_badge_class' => 'bg-amber-500 text-charcoal-950 font-extrabold',
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
                ],
            ],
            [
                'name' => 'The Ethereal Botanical Glass',
                'slug' => 'botanical',
                'category' => 'botanical',
                'thumbnail' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=80',
                'view_path' => 'demo.botanical',
                'price' => 49000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 02',
                    'category_label' => 'Sage Botanical & Rustic',
                    'tag' => 'Botanical Glass',
                    'tag_badge_class' => 'bg-emerald-600 text-white font-bold',
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
                ],
            ],
            [
                'name' => 'The Timeless Classic Card',
                'slug' => 'classic',
                'category' => 'classic',
                'thumbnail' => 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=800&auto=format&fit=crop&q=80',
                'view_path' => 'demo.classic',
                'price' => 49000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 03',
                    'category_label' => 'Nusantara Adat & Heritage',
                    'tag' => 'Timeless Simplicity',
                    'tag_badge_class' => 'bg-slate-800 text-amber-300 font-bold border border-amber-400/30',
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
                ],
            ],
            [
                'name' => 'The Warm Minimalist',
                'slug' => 'minimalist',
                'category' => 'minimalist',
                'thumbnail' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                'view_path' => 'demo.minimalist',
                'price' => 49000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 04',
                    'category_label' => 'Warm Minimalist & Aesthetic',
                    'tag' => 'Clean Art',
                    'tag_badge_class' => 'bg-stone-800 text-stone-100 font-semibold',
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
                ],
            ],
            [
                'name' => 'The Rose Romance Arch',
                'slug' => 'rose-romance',
                'category' => 'romantic',
                'thumbnail' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&auto=format&fit=crop&q=80',
                'view_path' => 'demo.rose-romance',
                'price' => 49000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 05',
                    'category_label' => 'Dusty Rose & Floral Arch',
                    'tag' => 'Floral Arch',
                    'tag_badge_class' => 'bg-rose-700 text-white font-bold',
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
                ],
            ],
            [
                'name' => 'Tema 3D Motion 01 (Garden Pavilion)',
                'slug' => '3d-motion-01',
                'category' => 'motion',
                'thumbnail' => '/themes/3d-motion-01/uploads/2024/10/Garden-01-Overlay-1.jpg',
                'view_path' => 'demo.3d-motion-01',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 06',
                    'category_label' => '3D Motion & Garden Pavilion',
                    'tag' => '3D Motion',
                    'tag_badge_class' => 'bg-emerald-700 text-emerald-50 font-bold shadow-sm',
                    'secondary_image' => '/themes/3d-motion-01/uploads/2024/10/Garden-01-Ayat-1.jpg',
                    'description' => 'Tema undangan video 3D Pavilion Garden yang imersif dengan transisi slide opening sinematik, efek floating couple, dan pemutar musik otomatis.',
                    'typography' => 'Playball + Aston Script + Sora',
                    'colors' => [
                        ['hex' => '#F4F7F4', 'name' => 'Garden Sage'],
                        ['hex' => '#85A57A', 'name' => 'Olive Olive'],
                        ['hex' => '#333333', 'name' => 'Charcoal Dark'],
                        ['hex' => '#FFFFFF', 'name' => 'Pure White'],
                    ],
                    'features' => [
                        'Immersive 3D Motion Pavilion Garden Video Background',
                        'Cinematic Slide-up Cover Animation',
                        'Floating Couple Animated Illustration',
                        'Direct Copy Bank Account & Local RSVP Form',
                    ],
                    'best_for' => 'Pasangan yang menginginkan konsep animasi 3D modern, garden party, dan undangan sinematik',
                    'rating' => '5.00',
                    'reviews_count' => '420',
                ],
            ],
            [
                'name' => 'Tema 3D Motion 05 (Sage Arch)',
                'slug' => '3d-motion-05',
                'category' => 'modern',
                'thumbnail' => '/themes/3d-motion-05/uploads/2024/10/Garden-05-Overlay.jpg',
                'view_path' => 'demo.3d-motion-05',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 07',
                    'category_label' => '3D Motion & Sage Arch',
                    'tag' => '3D Motion',
                    'tag_badge_class' => 'bg-slate-700 text-slate-50 font-bold shadow-sm',
                    'secondary_image' => '/themes/3d-motion-05/uploads/2024/10/Garden-05-Ayat.jpg',
                    'description' => 'Estetika modern 3D motion bertema Sage Arch dengan aksen biru lembut, transisi video dinamis, dan tipografi Playball & Sora yang anggun.',
                    'typography' => 'Playball + Aston Script + Sora',
                    'colors' => [
                        ['hex' => '#F5F7F8', 'name' => 'Crisp Light'],
                        ['hex' => '#7F96A8', 'name' => 'Sage Slate'],
                        ['hex' => '#01928B', 'name' => 'Teal Accent'],
                        ['hex' => '#333333', 'name' => 'Charcoal Dark'],
                    ],
                    'features' => [
                        'Immersive 3D Motion Sage Arch Video Background',
                        'Cinematic Perspective Couple Animation',
                        'Interactive Gift Envelope & Copy Account Number',
                        'Instant RSVP & Wishes Feed System',
                    ],
                    'best_for' => 'Pasangan pencinta nuansa modern elegan bernuansa sage-blue dan video animasi 3D',
                    'rating' => '5.00',
                    'reviews_count' => '380',
                ],
            ],
        ];

        // 1. Upsert canonical themes
        $persistedThemes = [];
        foreach ($canonicalThemes as $data) {
            $theme = Theme::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
            $persistedThemes[$data['slug']] = $theme;
        }

        // 2. Map legacy themes to canonical themes before deletion
        $legacySlugMap = [
            'vogue-editorial' => 'editorial',
            'midnight-starlight' => 'editorial',
            'ethereal-botanical' => 'botanical',
            'sage-botanical' => 'botanical',
            'timeless-classic' => 'classic',
            'nusantara-heritage' => 'classic',
            'monochrome-elegance' => 'minimalist',
            'warm-minimalist' => 'minimalist',
            'minimalist-linen' => 'minimalist',
            'blush-silk' => 'rose-romance',
        ];

        foreach ($legacySlugMap as $oldSlug => $canonicalSlug) {
            $oldTheme = Theme::where('slug', $oldSlug)->first();
            $targetTheme = $persistedThemes[$canonicalSlug] ?? null;

            if ($oldTheme && $targetTheme) {
                Invitation::where('theme_id', $oldTheme->id)->update(['theme_id' => $targetTheme->id]);
                UserTheme::where('theme_id', $oldTheme->id)->update(['theme_id' => $targetTheme->id]);
                OrderItem::where('item_id', $oldTheme->id)
                    ->where(function ($q) {
                        $q->where('item_type', 'theme')->orWhere('item_type', Theme::class);
                    })
                    ->update(['item_id' => $targetTheme->id]);

                $oldTheme->delete();
            }
        }

        // 3. Delete any remaining themes outside the 5 canonical ones
        $canonicalSlugs = array_column($canonicalThemes, 'slug');
        Theme::whereNotIn('slug', $canonicalSlugs)->delete();
    }
}
