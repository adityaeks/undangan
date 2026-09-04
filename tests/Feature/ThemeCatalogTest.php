<?php

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
