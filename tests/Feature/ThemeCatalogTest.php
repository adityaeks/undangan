<?php

use App\Models\Order;
use App\Models\Theme;
use App\Models\User;
use Database\Seeders\ThemeSeeder;

test('renders public theme catalog page successfully on /tema', function () {
    $response = $this->get('/tema');

    $response->assertOk()
        ->assertSee('Koleksi Template Undangan')
        ->assertSee('The Vogue Editorial Issue')
        ->assertSee('The Ethereal Botanical Glass')
        ->assertSee('The Timeless Classic Card')
        ->assertSee('The Warm Minimalist')
        ->assertSee('The Rose Romance Arch')
        ->assertSee('Editorial Modern')
        ->assertSee('Botanical Sage')
        ->assertSee('Nusantara Adat')
        ->assertSee('Warm Minimalist')
        ->assertSee('Rose Romance');
});

test('renders public theme catalog page successfully on /templates alias', function () {
    $response = $this->get('/templates');

    $response->assertOk()
        ->assertSee('The Vogue Editorial Issue')
        ->assertSee('The Ethereal Botanical Glass')
        ->assertSee('The Timeless Classic Card')
        ->assertSee('The Warm Minimalist')
        ->assertSee('The Rose Romance Arch');
});

test('theme catalog contains valid live demo links for all master themes', function () {
    $response = $this->get('/tema');

    $response->assertOk()
        ->assertSee(route('demo.show', ['slug' => 'editorial']))
        ->assertSee(route('demo.show', ['slug' => 'botanical']))
        ->assertSee(route('demo.show', ['slug' => 'classic']))
        ->assertSee(route('demo.show', ['slug' => 'minimalist']))
        ->assertSee(route('demo.show', ['slug' => 'rose-romance']));
});

test('theme catalog supports category filter query parameter', function () {
    $response = $this->get('/tema?kategori=romantic');

    $response->assertOk()
        ->assertSee('The Rose Romance Arch');
});

test('renders warm minimalist demo page successfully', function () {
    $response = $this->get('/demo/minimalist');

    $response->assertOk()
        ->assertSee('Raka')
        ->assertSee('Arinda')
        ->assertSee('Undangan Pernikahan')
        ->assertSee('Mempelai yang Berbahagia');
});

test('renders rose romance demo page successfully with user screenshot features', function () {
    $response = $this->get('/demo/rose-romance');

    $response->assertOk()
        ->assertSee('Ryan')
        ->assertSee('Vanya')
        ->assertSee('BUKA UNDANGAN')
        ->assertSee('UNDANGAN PERNIKAHAN')
        ->assertSee('Our Love Story');
});

test('supports legacy royal-luxury alias to minimalist demo page', function () {
    $response = $this->get('/demo/royal-luxury');

    $response->assertOk()
        ->assertSee('Raka')
        ->assertSee('Arinda');
});

test('theme catalog Pilih Desain buttons link directly to checkout route', function () {
    (new ThemeSeeder)->run();
    $theme = Theme::where('is_active', true)->first();
    expect($theme)->not->toBeNull();

    $response = $this->get('/tema');

    $response->assertOk()
        ->assertSee(route('checkout.theme', ['theme' => $theme->id]));
});

test('authenticated member clicking Pilih Desain initiates checkout and lands on orders show page', function () {
    (new ThemeSeeder)->run();
    $member = User::factory()->create(['role' => 'member']);
    $theme = Theme::where('is_active', true)->where('is_premium', true)->first();
    expect($theme)->not->toBeNull();

    $response = $this->actingAs($member)->get(route('checkout.theme', ['theme' => $theme->id]));

    // Should redirect to orders.show for checkout
    $response->assertRedirect();
    $order = Order::where('user_id', $member->id)->latest()->first();
    expect($order)->not->toBeNull();
    $response->assertRedirect(route('orders.show', $order));

    // Follow redirect to order checkout page
    $orderResponse = $this->actingAs($member)->get(route('orders.show', $order));
    $orderResponse->assertOk()
        ->assertSee('Detail Pembelian')
        ->assertSee($order->order_code)
        ->assertSee('Menunggu Pembayaran')
        ->assertSee($theme->name)
        ->assertSee('Total Tagihan:');
});
