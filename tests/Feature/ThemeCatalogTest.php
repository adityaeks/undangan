<?php

test('renders public theme catalog page successfully on /tema', function () {
    $response = $this->get('/tema');

    $response->assertOk()
        ->assertSee('Koleksi Template Undangan')
        ->assertSee('The Vogue Editorial Issue')
        ->assertSee('The Ethereal Botanical Glass')
        ->assertSee('The Timeless Classic Card')
        ->assertSee('Editorial Modern')
        ->assertSee('Botanical Sage')
        ->assertSee('Nusantara Adat');
});

test('renders public theme catalog page successfully on /templates alias', function () {
    $response = $this->get('/templates');

    $response->assertOk()
        ->assertSee('The Vogue Editorial Issue')
        ->assertSee('The Ethereal Botanical Glass')
        ->assertSee('The Timeless Classic Card');
});

test('theme catalog contains valid live demo links for all 3 master themes', function () {
    $response = $this->get('/tema');

    $response->assertOk()
        ->assertSee(route('demo.show', ['slug' => 'editorial']))
        ->assertSee(route('demo.show', ['slug' => 'botanical']))
        ->assertSee(route('demo.show', ['slug' => 'classic']));
});

test('theme catalog supports category filter query parameter', function () {
    $response = $this->get('/tema?kategori=botanical');

    $response->assertOk()
        ->assertSee('The Ethereal Botanical Glass');
});
