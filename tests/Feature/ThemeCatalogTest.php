<?php

use App\Models\Order;
use App\Models\Theme;
use App\Models\User;
use Database\Seeders\ThemeSeeder;

test('renders public theme catalog page successfully on /tema', function () {
    (new ThemeSeeder)->run();

    $response = $this->get('/tema');

    $response->assertOk()
        ->assertSee('Koleksi Template Undangan')
        ->assertSee('Standart 01')
        ->assertSee('Standart 02')
        ->assertSee('Standart 03')
        ->assertSee('Standart 04')
        ->assertSee('Standart 05')
        ->assertSee('Special 01')
        ->assertSee('Special 02')
        ->assertSee('Special 03')
        ->assertSee('3D Motion 01')
        ->assertSee('3D Motion 02')
        ->assertSee('3D Motion 08')
        ->assertSee('Standart')
        ->assertSee('Special')
        ->assertSee('3D Motion');
});

test('renders public theme catalog page successfully on /templates alias', function () {
    (new ThemeSeeder)->run();

    $response = $this->get('/templates');

    $response->assertOk()
        ->assertSee('Standart 01')
        ->assertSee('Special 01')
        ->assertSee('3D Motion 01');
});

test('theme catalog contains valid live demo links for all master themes', function () {
    (new ThemeSeeder)->run();

    $response = $this->get('/tema');

    $response->assertOk()
        ->assertSee(route('demo.show', ['slug' => 'standart-01']))
        ->assertSee(route('demo.show', ['slug' => 'standart-02']))
        ->assertSee(route('demo.show', ['slug' => 'special-01']))
        ->assertSee(route('demo.show', ['slug' => '3d-motion-01']))
        ->assertSee(route('demo.show', ['slug' => '3d-motion-08']));
});

test('theme catalog supports category filter query parameter', function () {
    (new ThemeSeeder)->run();

    $response = $this->get('/tema?kategori=standart');
    $response->assertOk()
        ->assertSee('Standart 01');

    $specialResponse = $this->get('/tema?kategori=special');
    $specialResponse->assertOk()
        ->assertSee('Special 01');
});

test('welcome page renders all themes in exclusive collection slider', function () {
    (new ThemeSeeder)->run();

    $response = $this->get('/');

    $response->assertOk()
        ->assertSee('Special 01')
        ->assertSee('Special 02')
        ->assertSee('Special 03')
        ->assertSee('3D Motion 01')
        ->assertSee('3D Motion 08');
});

test('renders standart-05 demo page successfully', function () {
    $response = $this->get('/demo/standart-05');

    $response->assertOk()
        ->assertSee('Raka')
        ->assertSee('Arinda')
        ->assertSee('Undangan Pernikahan')
        ->assertSee('Mempelai yang Berbahagia');
});

test('renders standart-01 demo page successfully with user screenshot features', function () {
    $response = $this->get('/demo/standart-01');

    $response->assertOk()
        ->assertSee('Ryan')
        ->assertSee('Vanya')
        ->assertSee('BUKA UNDANGAN')
        ->assertSee('UNDANGAN PERNIKAHAN')
        ->assertSee('Our Love Story');
});

test('renders special-01 demo page successfully', function () {
    $response = $this->get('/demo/special-01');

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
