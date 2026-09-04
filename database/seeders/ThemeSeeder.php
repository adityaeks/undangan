<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            [
                'name' => 'The Vogue Editorial Issue',
                'slug' => 'vogue-editorial',
                'category' => 'modern',
                'thumbnail' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=700&auto=format&fit=crop&q=80',
                'view_path' => 'demo.editorial',
                'is_active' => true,
                'is_premium' => false,
            ],
            [
                'name' => 'The Ethereal Botanical Glass',
                'slug' => 'ethereal-botanical',
                'category' => 'botanical',
                'thumbnail' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=700&auto=format&fit=crop&q=80',
                'view_path' => 'demo.botanical',
                'is_active' => true,
                'is_premium' => false,
            ],
            [
                'name' => 'The Timeless Classic Card',
                'slug' => 'timeless-classic',
                'category' => 'traditional',
                'thumbnail' => 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=700&auto=format&fit=crop&q=80',
                'view_path' => 'demo.classic',
                'is_active' => true,
                'is_premium' => false,
            ],
            [
                'name' => 'The Monochrome Elegance',
                'slug' => 'monochrome-elegance',
                'category' => 'minimalist',
                'thumbnail' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=700&auto=format&fit=crop&q=80',
                'view_path' => 'demo.editorial',
                'is_active' => true,
                'is_premium' => false,
            ],
            [
                'name' => 'Sage Olive & Earthy Wood',
                'slug' => 'sage-botanical',
                'category' => 'botanical',
                'thumbnail' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?w=700&auto=format&fit=crop&q=80',
                'view_path' => 'demo.botanical',
                'is_active' => true,
                'is_premium' => false,
            ],
            [
                'name' => 'Royal Champagne & Navy',
                'slug' => 'royal-champagne',
                'category' => 'luxury',
                'thumbnail' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=700&auto=format&fit=crop&q=80',
                'view_path' => 'demo.editorial',
                'is_active' => true,
                'is_premium' => true,
            ],
            [
                'name' => 'Blush Silk & Watercolor',
                'slug' => 'blush-silk',
                'category' => 'minimalist',
                'thumbnail' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=700&auto=format&fit=crop&q=80',
                'view_path' => 'demo.botanical',
                'is_active' => true,
                'is_premium' => false,
            ],
            [
                'name' => 'Nusantara Songket Heritage',
                'slug' => 'nusantara-heritage',
                'category' => 'traditional',
                'thumbnail' => 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=700&auto=format&fit=crop&q=80',
                'view_path' => 'demo.classic',
                'is_active' => true,
                'is_premium' => false,
            ],
            [
                'name' => 'Midnight Starlight Studio',
                'slug' => 'midnight-starlight',
                'category' => 'modern',
                'thumbnail' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=700&auto=format&fit=crop&q=80',
                'view_path' => 'demo.editorial',
                'is_active' => true,
                'is_premium' => true,
            ],
        ];

        foreach ($themes as $themeData) {
            Theme::updateOrCreate(
                ['slug' => $themeData['slug']],
                $themeData
            );
        }
    }
}
