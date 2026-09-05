<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::updateOrCreate(
            ['code' => 'MOMENINDAH'],
            [
                'discount_type' => 'percent',
                'discount_value' => 30.00,
                'min_spend' => 0.00,
                'is_active' => true,
            ]
        );
    }
}
