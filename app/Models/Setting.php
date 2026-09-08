<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'system_settings';

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Retrieve a setting value by key with optional fallback.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();

        if ($setting === null || $setting->value === null) {
            return $default;
        }

        return $setting->value;
    }

    /**
     * Set or update a setting value.
     */
    public static function set(string $key, mixed $value, string $group = 'pricing'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => (string) $value,
                'group' => $group,
            ]
        );
    }
}
