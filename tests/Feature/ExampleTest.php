<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertSee('Customer Service')
        ->assertSee('wa.me/6281234567890', false)
        ->assertSee('Pertanyaan Umum (FAQ)')
        ->assertSee('openCsModal')
        ->assertDontSee('scrollRestoration', false);
});

it('returns a successful response for theme catalog without scroll manipulation', function () {
    $response = $this->get('/tema');

    $response->assertStatus(200)
        ->assertDontSee('scrollRestoration', false);
});
