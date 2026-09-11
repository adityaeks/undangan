<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'thumbnail',
        'view_path',
        'price',
        'metadata',
        'is_active',
        'is_premium',
        'is_for_partner',
    ];

    protected $appends = [
        'has_story_images',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'metadata' => 'array',
            'is_active' => 'boolean',
            'is_premium' => 'boolean',
            'is_for_partner' => 'boolean',
        ];
    }

    /**
     * Determine if the theme template supports story images.
     */
    public function getHasStoryImagesAttribute(): bool
    {
        $meta = $this->metadata ?? [];
        if (isset($meta['has_story_images'])) {
            return (bool) $meta['has_story_images'];
        }

        $canonicalSlug = config("themes.slug_to_preset.{$this->slug}", $this->slug);
        $preset = config("themes.presets.{$canonicalSlug}", []);
        if (isset($preset['has_story_images'])) {
            return (bool) $preset['has_story_images'];
        }

        return in_array($canonicalSlug, ['3d-motion-05', 'motion-05', 'm05'], true);
    }

    /**
     * Get all invitations using this theme.
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    /**
     * User theme ownership records.
     */
    public function userThemes(): HasMany
    {
        return $this->hasMany(UserTheme::class);
    }

    /**
     * Users who own this theme.
     */
    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_themes')
            ->withPivot(['order_id', 'unlocked_at', 'is_active'])
            ->withTimestamps();
    }

    /**
     * Check if theme is free to use without purchasing.
     */
    public function isFree(): bool
    {
        return ! $this->is_premium || (float) $this->price <= 0.00;
    }

    /**
     * Retrieve the model for a bound value (supports numeric ID or slug).
     */
    public function resolveRouteBinding($value, $field = null): ?self
    {
        return $this->where('id', $value)->orWhere('slug', $value)->firstOrFail();
    }

    /**
     * Get price for 45-day duration package.
     */
    public function getPrice45Days(): float
    {
        if ($this->isFree()) {
            return 0.00;
        }

        $price = (float) $this->price;
        if ($price > 0.00) {
            return $price;
        }

        return (float) Setting::get('theme_price_45_days', 49000);
    }

    /**
     * Get price for lifetime duration package.
     */
    public function getLifetimePrice(): float
    {
        if ($this->isFree()) {
            return 0.00;
        }

        $meta = $this->metadata ?? [];
        if (isset($meta['price_lifetime']) && (float) $meta['price_lifetime'] > 0.00) {
            return (float) $meta['price_lifetime'];
        }

        return (float) Setting::get('theme_price_lifetime', 99000);
    }

    /**
     * Get fee for assisted data entry service.
     */
    public static function getAssistedFee(): float
    {
        return (float) Setting::get('theme_assisted_fee', 25000);
    }

    /**
     * Convert theme model into standardized catalog array for UI components.
     *
     * @return array<string, mixed>
     */
    public function toCatalogArray(): array
    {
        $meta = $this->metadata ?? [];
        $price45 = $this->getPrice45Days();
        $priceLifetime = $this->getLifetimePrice();
        $assistedFee = static::getAssistedFee();

        return [
            'id' => $this->slug,
            'db_id' => $this->id,
            'number' => $meta['number'] ?? 'Tema Desain',
            'name' => $this->name,
            'slug' => $this->slug,
            'category' => $this->category,
            'category_label' => $meta['category_label'] ?? ucfirst($this->category),
            'tag' => $meta['tag'] ?? ucfirst($this->category),
            'tag_badge_class' => $meta['tag_badge_class'] ?? 'bg-amber-500 text-charcoal-950 font-bold',
            'thumbnail' => $this->thumbnail,
            'secondary_image' => $meta['secondary_image'] ?? $this->thumbnail,
            'description' => $meta['description'] ?? 'Desain tema undangan digital elegan dan responsif.',
            'typography' => $meta['typography'] ?? 'Plus Jakarta Sans + Cormorant Garamond',
            'colors' => $meta['colors'] ?? [],
            'features' => $meta['features'] ?? [
                'Bento Grid Event Schedule',
                'Dynamic Island Floating Audio Player',
                'Interactive Love Story Horizontal Carousel',
                'Modern Responsive Finish',
            ],
            'best_for' => $meta['best_for'] ?? 'Pasangan modern, resepsi pernikahan elegan minimalis',
            'rating' => $meta['rating'] ?? '4.98',
            'reviews_count' => $meta['reviews_count'] ?? '1.200',
            'price' => format_rupiah($price45),
            'raw_price' => (float) $price45,
            'price_45_days' => format_rupiah($price45),
            'raw_price_45_days' => (float) $price45,
            'price_lifetime' => format_rupiah($priceLifetime),
            'raw_price_lifetime' => (float) $priceLifetime,
            'assisted_fee' => format_rupiah($assistedFee),
            'raw_assisted_fee' => (float) $assistedFee,
            'is_premium' => $this->is_premium,
            'has_story_images' => $this->has_story_images,
            'demo_url' => route('demo.show', ['slug' => $this->slug]),
            'checkout_url' => route('checkout.theme', ['theme' => $this->id]),
        ];
    }
}
