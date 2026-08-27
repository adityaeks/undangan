<?php

test('renders live demo page successfully with single master template', function () {
    $response = $this->get('/demo');

    $response->assertOk()
        ->assertSee('The Wedding Celebration')
        ->assertSee('Raka')
        ->assertSee('Arinda')
        ->assertSee('Akad Nikah')
        ->assertSee('Resepsi Pernikahan');
});

test('handles demo slug route by rendering live demo', function () {
    $response = $this->get('/demo/wedding');

    $response->assertOk()
        ->assertSee('Raka & Arinda');
});

test('displays personalized guest recipient name from query parameter on live demo', function () {
    $guestName = 'Bpk. Ridwan Kamil & Istri';
    $response = $this->get('/demo?to='.urlencode($guestName));

    $response->assertOk()
        ->assertSee($guestName);
});
