<?php

test('renders live demo page successfully with single master template', function () {
    $response = $this->get('/demo');

    $response->assertOk()
        ->assertSee('Raka')
        ->assertSee('Arinda')
        ->assertSee('Akad Nikah')
        ->assertSee('Resepsi Pernikahan');
});

test('handles demo slug route by rendering live demo', function () {
    $response = $this->get('/demo/wedding');

    $response->assertOk()
        ->assertSee('Raka')
        ->assertSee('Arinda');
});

test('displays personalized guest recipient name from query parameter on live demo', function () {
    $guestName = 'Bpk. Ridwan Kamil & Istri';
    $response = $this->get('/demo?to='.urlencode($guestName));

    $response->assertOk()
        ->assertSee('Bpk. Ridwan Kamil');
});

test('renders interactive demo studio with template list and customizer form', function () {
    $response = $this->get('/demo');

    $response->assertOk()
        ->assertSee('Kustomisasi Undangan')
        ->assertSee('Demo Studio Interaktif')
        ->assertSee('The Vogue Editorial Issue')
        ->assertSee('The Rose Romance Arch');
});

test('allows custom query parameters in demo studio', function () {
    $response = $this->get('/demo?theme=rose-romance&groom_nickname=Ryan&bride_nickname=Vanya&to=Aditya');

    $response->assertOk()
        ->assertSee('Ryan')
        ->assertSee('Vanya')
        ->assertSee('Aditya');
});

test('renders standalone demo view when standalone parameter is provided', function () {
    $response = $this->get('/demo?standalone=1&to=Aditya');

    $response->assertOk()
        ->assertSee('Aditya');
});
