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
     * Run the database seeds for all 16 themes.
     */
    public function run(): void
    {
        $canonicalThemes = [
            // 1. STANDART 01 (Rose Romance)
            [
                'name' => 'Standart 01',
                'slug' => 'standart-01',
                'category' => 'Standart',
                'thumbnail' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&auto=format&fit=crop&q=80',
                'view_path' => 'demo.standart-01',
                'price' => 49000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 01',
                    'category_label' => 'Dusty Rose & Floral Arch',
                    'tag' => 'Standart 01',
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
                    'has_story_images' => true,
                    'best_for' => 'Pernikahan romantis, intimate & ballroom wedding, pasangan pecinta estetika floral dusty rose',
                    'rating' => '4.99',
                    'reviews_count' => '1.450',
                ],
            ],

            // 2. STANDART 02 (Editorial)
            [
                'name' => 'Standart 02',
                'slug' => 'standart-02',
                'category' => 'Standart',
                'thumbnail' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=800&auto=format&fit=crop&q=80',
                'view_path' => 'demo.standart-02',
                'price' => 49000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 02',
                    'category_label' => 'Modern Dark Studio',
                    'tag' => 'Standart 02',
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

            // 3. STANDART 03 (Botanical)
            [
                'name' => 'Standart 03',
                'slug' => 'standart-03',
                'category' => 'Standart',
                'thumbnail' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=800&auto=format&fit=crop&q=80',
                'view_path' => 'demo.standart-03',
                'price' => 49000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 03',
                    'category_label' => 'Sage Botanical & Rustic',
                    'tag' => 'Standart 03',
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

            // 4. STANDART 04 (Classic)
            [
                'name' => 'Standart 04',
                'slug' => 'standart-04',
                'category' => 'Standart',
                'thumbnail' => 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=800&auto=format&fit=crop&q=80',
                'view_path' => 'demo.standart-04',
                'price' => 49000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 04',
                    'category_label' => 'Nusantara Adat & Heritage',
                    'tag' => 'Standart 04',
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

            // 5. STANDART 05 (Minimalist)
            [
                'name' => 'Standart 05',
                'slug' => 'standart-05',
                'category' => 'Standart',
                'thumbnail' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                'view_path' => 'demo.standart-05',
                'price' => 49000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 05',
                    'category_label' => 'Warm Minimalist & Aesthetic',
                    'tag' => 'Standart 05',
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

            // 6. 3D MOTION 01 (Garden Pavilion)
            [
                'name' => '3D Motion 01',
                'slug' => '3d-motion-01',
                'category' => '3D Motion',
                'thumbnail' => '/themes/3d-motion-01/uploads/2024/10/Garden-01-Overlay-1.jpg',
                'view_path' => 'demo.3d-motion-01',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 06',
                    'category_label' => '3D Motion & Garden Pavilion',
                    'tag' => '3D Motion 01',
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

            // 7. 3D MOTION 02 (Sage Arch)
            [
                'name' => '3D Motion 02',
                'slug' => '3d-motion-02',
                'category' => '3D Motion',
                'thumbnail' => '/themes/3d-motion-05/uploads/2024/10/Garden-05-Overlay.jpg',
                'view_path' => 'demo.3d-motion-02',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 07',
                    'category_label' => '3D Motion & Sage Arch',
                    'tag' => '3D Motion 02',
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

            // 8. SPECIAL 01 (Royal Gold)
            [
                'name' => 'Special 01',
                'slug' => 'special-01',
                'category' => 'Special',
                'thumbnail' => '/themes/luxury-01/uploads/2025/02/thumbnail-luxury-01-1.jpg',
                'view_path' => 'demo.special-01',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 08',
                    'category_label' => 'Luxury & Royal Gold',
                    'tag' => 'Special 01',
                    'tag_badge_class' => 'bg-amber-600 text-amber-50 font-bold shadow-sm',
                    'secondary_image' => '/themes/luxury-01/uploads/2025/02/thumbnail-luxury-01-1.jpg',
                    'description' => 'Sentuhan kemewahan istana dengan palet royal gold, layout grid simetris elegan, audio player romantis, dan sistem RSVP amplop digital.',
                    'typography' => 'Playball + Playfair Display + Plus Jakarta Sans',
                    'colors' => [
                        ['hex' => '#FAF8F5', 'name' => 'Ivory Cream'],
                        ['hex' => '#B67E22', 'name' => 'Royal Gold'],
                        ['hex' => '#2B0E11', 'name' => 'Imperial Maroon'],
                        ['hex' => '#FFFFFF', 'name' => 'Pure White'],
                    ],
                    'features' => [
                        'Royal Gold Architectural Accents',
                        'Digital Envelope & 1-Click Copy Rekening',
                        'Live RSVP & Wishes Feed System',
                        'Seamless Mobile Responsive Grid',
                    ],
                    'best_for' => 'Resepsi formal ballroom hotel, perayaan mewah, pasangan pencinta warna royal gold',
                    'rating' => '4.99',
                    'reviews_count' => '740',
                ],
            ],

            // 9. SPECIAL 02 (Minimal Luxe)
            [
                'name' => 'Special 02',
                'slug' => 'special-02',
                'category' => 'Special',
                'thumbnail' => '/themes/luxury-02/uploads/2025/02/thumbnail-luxury-02-1.jpg',
                'view_path' => 'demo.special-02',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 09',
                    'category_label' => 'Luxury Minimal Luxe',
                    'tag' => 'Special 02',
                    'tag_badge_class' => 'bg-yellow-700 text-yellow-50 font-bold shadow-sm',
                    'secondary_image' => '/themes/luxury-02/uploads/2025/02/thumbnail-luxury-02-1.jpg',
                    'description' => 'Perpaduan quiet luxury dan modern clean lines bernuansa soft gold ivory, tata letak seimbang nan lapang, dan pengalaman scrolling halus.',
                    'typography' => 'Playball + Playfair Display + Plus Jakarta Sans',
                    'colors' => [
                        ['hex' => '#FAF8F5', 'name' => 'Soft Linen'],
                        ['hex' => '#B67E22', 'name' => 'Refined Gold'],
                        ['hex' => '#1E293B', 'name' => 'Slate Navy'],
                        ['hex' => '#FFFFFF', 'name' => 'Pure White'],
                    ],
                    'features' => [
                        'Quiet Luxury Minimalist Layout',
                        'Direct Clipboard Bank Transfer Badges',
                        'Instant Wish & RSVP Streaming',
                        'Ultra Clean Typography Hierarchy',
                    ],
                    'best_for' => 'Intimate wedding modern, perayaan privat elegan, pecinta estetika quiet luxury',
                    'rating' => '4.98',
                    'reviews_count' => '680',
                ],
            ],

            // 10. SPECIAL 03 (Black & Gold Modern)
            [
                'name' => 'Special 03',
                'slug' => 'special-03',
                'category' => 'Special',
                'thumbnail' => '/themes/luxury-07/uploads/2026/06/thumbnail-luxury-07-rev.jpg',
                'view_path' => 'demo.special-03',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 10',
                    'category_label' => 'Luxury Black & Gold',
                    'tag' => 'Special 03',
                    'tag_badge_class' => 'bg-stone-900 text-amber-400 font-bold border border-amber-500/40 shadow-sm',
                    'secondary_image' => '/themes/luxury-07/uploads/2026/06/thumbnail-luxury-07-rev.jpg',
                    'description' => 'Nuansa glamor dramatis dark mode dipadu kilau emas bercahaya, kontras visual premium tinggi, dan alur narasi cinta yang eksklusif.',
                    'typography' => 'Playball + Playfair Display + Plus Jakarta Sans',
                    'colors' => [
                        ['hex' => '#111827', 'name' => 'Midnight Onyx'],
                        ['hex' => '#F59E0B', 'name' => 'Gilded Gold'],
                        ['hex' => '#1F2937', 'name' => 'Dark Slate'],
                        ['hex' => '#F9FAFB', 'name' => 'Pure Starlight'],
                    ],
                    'features' => [
                        'Dramatic Dark Mode & Gold Finish',
                        'Gilded Card Borders & Accent Icons',
                        'Integrated Instant RSVP & Doa Restu',
                        'Direct Bank Account Copy Badges',
                    ],
                    'best_for' => 'Resepsi malam mewah di ballroom hotel, pasangan pencinta konsep dark glamor bertaraf internasional',
                    'rating' => '5.00',
                    'reviews_count' => '890',
                ],
            ],

            // 11. 3D MOTION 03 (Modern Bloom)
            [
                'name' => '3D Motion 03',
                'slug' => '3d-motion-03',
                'category' => '3D Motion',
                'thumbnail' => '/themes/3d-motion-07/uploads/2026/01/preview-m07-reseller.jpg',
                'view_path' => 'demo.3d-motion-03',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 11',
                    'category_label' => '3D Motion & Modern Bloom',
                    'tag' => '3D Motion 03',
                    'tag_badge_class' => 'bg-emerald-800 text-emerald-100 font-bold shadow-sm',
                    'secondary_image' => '/themes/3d-motion-07/uploads/2024/10/background-cover-07-rev3-.jpg',
                    'description' => 'Undangan video animasi 3D interaktif berlatar floral bloom bermekaran, efek paralaks kedalaman kamera, dan alur romantis kontemporer.',
                    'typography' => 'Playball + Aston Script + Sora',
                    'colors' => [
                        ['hex' => '#F8F9FA', 'name' => 'Light Bloom'],
                        ['hex' => '#85A57A', 'name' => 'Sage Leaf'],
                        ['hex' => '#1E293B', 'name' => 'Slate Dark'],
                        ['hex' => '#FFFFFF', 'name' => 'Pure White'],
                    ],
                    'features' => [
                        'Immersive 3D Parallax Video Background',
                        'Dynamic 3D Floral Perspective Elements',
                        'Interactive Digital Envelope & Copy Account',
                        'Instant RSVP & Wishes Feed System',
                    ],
                    'best_for' => 'Garden party, outdoor wedding, pasangan yang menyukai animasi sinematik bertema bunga',
                    'rating' => '4.99',
                    'reviews_count' => '610',
                ],
            ],

            // 12. 3D MOTION 04 (Javanese Classic)
            [
                'name' => '3D Motion 04',
                'slug' => '3d-motion-04',
                'category' => '3D Motion',
                'thumbnail' => '/themes/3d-motion-10/uploads/2026/01/preview-m10-reseller.jpg',
                'view_path' => 'demo.3d-motion-04',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 12',
                    'category_label' => '3D Motion Adat Jawa',
                    'tag' => '3D Motion 04',
                    'tag_badge_class' => 'bg-amber-900 text-amber-200 font-bold shadow-sm',
                    'secondary_image' => '/themes/3d-motion-10/uploads/2024/12/JAWA-BACKGROUND.jpg',
                    'description' => 'Sentuhan agung budaya Jawa klasik dalam format 3D motion modern, animasi gunungan wayang, motif batik klasik, dan iringan gending gamelan sakral.',
                    'typography' => 'Playball + Aston Script + Sora',
                    'colors' => [
                        ['hex' => '#FAF7F2', 'name' => 'Batik Cream'],
                        ['hex' => '#A27B5C', 'name' => 'Sogan Brown'],
                        ['hex' => '#2A231D', 'name' => 'Classic Teak'],
                        ['hex' => '#FFFFFF', 'name' => 'Pure White'],
                    ],
                    'features' => [
                        '3D Animated Gunungan Wayang & Batik Layer',
                        'Traditional Gamelan Audio Background',
                        'Digital Envelope & Bank Transfer Copy',
                        'Full Dynamic RSVP & Guest Greetings',
                    ],
                    'best_for' => 'Pernikahan adat Jawa tradisional, resepsi keluarga besar, akad nikah budaya keraton',
                    'rating' => '5.00',
                    'reviews_count' => '940',
                ],
            ],

            // 13. 3D MOTION 05 (Royal Nusantara)
            [
                'name' => '3D Motion 05',
                'slug' => '3d-motion-05',
                'category' => '3D Motion',
                'thumbnail' => '/themes/3d-motion-27/uploads/2026/01/preview-m27-reseller.jpg',
                'view_path' => 'demo.3d-motion-05',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 13',
                    'category_label' => '3D Motion Royal Nusantara',
                    'tag' => '3D Motion 05',
                    'tag_badge_class' => 'bg-yellow-900 text-yellow-200 font-bold shadow-sm',
                    'secondary_image' => '/themes/3d-motion-27/uploads/2025/05/motion-jawa-03-bg.jpg',
                    'description' => 'Megahnya pesona pusaka warisan nusantara dengan gerak sinematik 3D, ornamen ukiran istana, dan tata warna keemasan berwibawa.',
                    'typography' => 'Playball + Aston Script + Sora',
                    'colors' => [
                        ['hex' => '#FAF8F5', 'name' => 'Royal Linen'],
                        ['hex' => '#936A44', 'name' => 'Golden Earth'],
                        ['hex' => '#2B1B17', 'name' => 'Noble Dark'],
                        ['hex' => '#FFFFFF', 'name' => 'Pure White'],
                    ],
                    'features' => [
                        'Royal Nusantara 3D Motion Perspective',
                        'Authentic Cultural Carving Accents',
                        '1-Click Gift Transfer & RSVP Form',
                        'Live Preview Studio Compatible',
                    ],
                    'best_for' => 'Akad nikah nusantara, perayaan adat, pasangan pencinta kemegahan tradisi Indonesia',
                    'rating' => '4.98',
                    'reviews_count' => '530',
                ],
            ],

            // 14. 3D MOTION 06 (Golden Bloom)
            [
                'name' => '3D Motion 06',
                'slug' => '3d-motion-06',
                'category' => '3D Motion',
                'thumbnail' => '/themes/3d-motion-47/uploads/2026/03/preview-m47-reseller-new.jpg',
                'view_path' => 'demo.3d-motion-06',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 14',
                    'category_label' => '3D Motion Golden Bloom',
                    'tag' => '3D Motion 06',
                    'tag_badge_class' => 'bg-amber-800 text-amber-100 font-bold shadow-sm',
                    'secondary_image' => '/themes/3d-motion-47/uploads/2026/03/BACKGROUND-ALL-PAGE-.jpg',
                    'description' => 'Animasi dedaunan emas dan floral mekar berselaras 3D lembut, transisi buka undangan menawan, dan kehangatan tata visual pesta.',
                    'typography' => 'Playball + Aston Script + Sora',
                    'colors' => [
                        ['hex' => '#FBF9F6', 'name' => 'Golden Mist'],
                        ['hex' => '#9E7745', 'name' => 'Amber Bloom'],
                        ['hex' => '#1F2421', 'name' => 'Deep Slate'],
                        ['hex' => '#FFFFFF', 'name' => 'Pure White'],
                    ],
                    'features' => [
                        'Golden Foliage 3D Motion Video Effect',
                        'Slide-up Romantic Cover Reveal',
                        'Integrated RSVP & Wishes Stream',
                        'One-Click Bank Account Copying',
                    ],
                    'best_for' => 'Resepsi ballroom, pernikahan bernuansa champagne & gold, pesta elegan romantis',
                    'rating' => '4.99',
                    'reviews_count' => '470',
                ],
            ],

            // 15. 3D MOTION 07 (Javanese Terracotta)
            [
                'name' => '3D Motion 07',
                'slug' => '3d-motion-07',
                'category' => '3D Motion',
                'thumbnail' => '/themes/3d-motion-49/uploads/2026/03/preview-m49-reseller-new.jpg',
                'view_path' => 'demo.3d-motion-07',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 15',
                    'category_label' => '3D Motion Terracotta Adat',
                    'tag' => '3D Motion 07',
                    'tag_badge_class' => 'bg-orange-950 text-orange-200 font-bold shadow-sm',
                    'secondary_image' => '/themes/3d-motion-49/uploads/2026/03/ALL-BG-TEMA-5-.jpg',
                    'description' => 'Keunikan nuansa etnik terracotta berpadu corak batik kontemporer, efek 3D berkedalaman lembut, dan alur sakral yang hangat.',
                    'typography' => 'Playball + Aston Script + Sora',
                    'colors' => [
                        ['hex' => '#FAF6F2', 'name' => 'Terracotta Linen'],
                        ['hex' => '#A75D43', 'name' => 'Warm Clay'],
                        ['hex' => '#2A1F1D', 'name' => 'Onyx Bronze'],
                        ['hex' => '#FFFFFF', 'name' => 'Pure White'],
                    ],
                    'features' => [
                        'Warm Terracotta Etnik 3D Layers',
                        'Floating Perspective Couple Animation',
                        'Responsive RSVP & Greetings Card Stream',
                        'Fast Loading Self-Hosted Assets',
                    ],
                    'best_for' => 'Akad nikah adat terracotta, intimate wedding etnik, pesta berkonsep hangat dan membumi',
                    'rating' => '4.97',
                    'reviews_count' => '390',
                ],
            ],

            // 16. 3D MOTION 08 (Jawa Biru Asmaranala)
            [
                'name' => '3D Motion 08',
                'slug' => '3d-motion-08',
                'category' => '3D Motion',
                'thumbnail' => '/themes/3d-motion-55/uploads/2026/06/preview-m55-reseller.jpg',
                'view_path' => 'demo.3d-motion-08',
                'price' => 59000,
                'is_active' => true,
                'is_premium' => true,
                'metadata' => [
                    'number' => 'Tema Desain 16',
                    'category_label' => '3D Motion Jawa Biru',
                    'tag' => '3D Motion 08',
                    'tag_badge_class' => 'bg-blue-900 text-blue-100 font-bold shadow-sm',
                    'secondary_image' => '/themes/3d-motion-55/uploads/2026/06/Design-Jawa-Biru-.jpg',
                    'description' => 'Pernikahan adat Jawa bernuansa Royal Blue sakral berhias gunungan emas, iringan narasi Jawa puitis Asmaranala, dan estetika video 3D berwibawa.',
                    'typography' => 'Playball + Aston Script + Sora',
                    'colors' => [
                        ['hex' => '#F2F6FA', 'name' => 'Sky Mist'],
                        ['hex' => '#2C5E8A', 'name' => 'Royal Blue'],
                        ['hex' => '#1A2A3A', 'name' => 'Deep Indigo'],
                        ['hex' => '#FFFFFF', 'name' => 'Pure White'],
                    ],
                    'features' => [
                        'Royal Blue Javanese Adat 3D Background',
                        'Narasi Puitis Jawa Asmaranala Audio',
                        'Gunungan Emas Interactive Intro',
                        'Amplop Digital & Form RSVP Interaktif',
                    ],
                    'best_for' => 'Pernikahan adat Jawa bertema Royal Blue, resepsi megah bernuansa biru keemasan',
                    'rating' => '5.00',
                    'reviews_count' => '860',
                ],
            ],
        ];

        // 1. Map legacy theme slugs to new canonical themes before upserting
        $legacySlugMap = [
            'rose-romance' => 'standart-01',
            'editorial' => 'standart-02',
            'botanical' => 'standart-03',
            'classic' => 'standart-04',
            'minimalist' => 'standart-05',
            'vogue-editorial' => 'standart-02',
            'midnight-starlight' => 'standart-02',
            'ethereal-botanical' => 'standart-03',
            'sage-botanical' => 'standart-03',
            'timeless-classic' => 'standart-04',
            'nusantara-heritage' => 'standart-04',
            'monochrome-elegance' => 'standart-05',
            'warm-minimalist' => 'standart-05',
            'minimalist-linen' => 'standart-05',
            'blush-silk' => 'standart-01',
            'luxury-01' => 'special-01',
            'luxury-02' => 'special-02',
            'luxury-07' => 'special-03',
        ];

        foreach ($legacySlugMap as $oldSlug => $newSlug) {
            $oldTheme = Theme::where('slug', $oldSlug)->first();
            if ($oldTheme && ! Theme::where('slug', $newSlug)->exists()) {
                $oldTheme->update(['slug' => $newSlug]);
            }
        }

        // 2. Upsert canonical themes
        $persistedThemes = [];
        foreach ($canonicalThemes as $data) {
            $theme = Theme::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
            $persistedThemes[$data['slug']] = $theme;
        }

        // 3. Clean up any remaining legacy links
        foreach ($legacySlugMap as $oldSlug => $canonicalSlug) {
            $oldTheme = Theme::where('slug', $oldSlug)->first();
            $targetTheme = $persistedThemes[$canonicalSlug] ?? null;

            if ($oldTheme && $targetTheme && $oldTheme->id !== $targetTheme->id) {
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
    }
}
