<?php

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;

beforeEach(function () {
    $this->member = User::factory()->create(['role' => 'member']);
    $this->otherMember = User::factory()->create(['role' => 'member']);
    $this->partner = User::factory()->create(['role' => 'partner']);
    $this->otherPartner = User::factory()->create(['role' => 'partner']);

    $this->theme = Theme::create([
        'name' => 'Template WA Theme',
        'slug' => 'template-wa-theme-'.uniqid(),
        'category' => 'modern',
        'thumbnail' => 'https://images.unsplash.com/photo-1509927083803-4bd519298ac4?w=800',
        'view_path' => 'demo.editorial',
        'is_active' => true,
        'is_premium' => false,
        'is_for_partner' => true,
        'price' => 0,
    ]);
});

test('invitation uses polite default template when no custom template is set', function () {
    $invitation = Invitation::create([
        'user_id' => $this->member->id,
        'owner_id' => $this->member->id,
        'theme_id' => $this->theme->id,
        'title' => 'Wedding Member Default WA',
        'slug' => 'wedding-member-default-wa',
    ]);

    expect($invitation->whatsapp_template)->toBe(Invitation::defaultWhatsappTemplate());

    $formatted = $invitation->formatWhatsappMessage('Ahmad Dani', 'https://undangan.test/u/wedding-member-default-wa?to=Ahmad+Dani');
    expect($formatted)->toContain('Ahmad Dani')
        ->toContain('https://undangan.test/u/wedding-member-default-wa?to=Ahmad+Dani')
        ->toContain('Kepada Yth.');
});

test('invitation supports curly braces and square brackets for variables in custom template', function () {
    $invitation = Invitation::create([
        'user_id' => $this->member->id,
        'owner_id' => $this->member->id,
        'theme_id' => $this->theme->id,
        'title' => 'Wedding Bracket Test',
        'slug' => 'wedding-bracket-test',
    ]);

    $invitation->setting()->create([
        'metadata' => [
            'whatsapp_template' => "Salam hangat {nama}!\nBuka link: {link}",
        ],
    ]);

    $invitation->refresh();
    $formatted = $invitation->formatWhatsappMessage('Rina & Rekan', 'https://undangan.test/link-undangan');

    expect($formatted)->toBe("Salam hangat Rina & Rekan!\nBuka link: https://undangan.test/link-undangan");
});

test('member can update whatsapp template via member guest controller', function () {
    $invitation = Invitation::create([
        'user_id' => $this->member->id,
        'owner_id' => $this->member->id,
        'theme_id' => $this->theme->id,
        'title' => 'Wedding Member Custom WA',
        'slug' => 'wedding-member-custom-wa',
    ]);

    $newTemplate = "Kepada Sahabatku [nama],\nYuk hadir ke pernikahanku di [link]. Ditunggu kehadirannya!";

    $response = $this->actingAs($this->member)->post(route('member.guests.template'), [
        'invitation_id' => $invitation->id,
        'whatsapp_template' => $newTemplate,
    ]);

    $response->assertRedirect()
        ->assertSessionHas('success');

    $invitation->refresh();
    expect($invitation->whatsapp_template)->toBe($newTemplate);

    // Check formatting
    $message = $invitation->formatWhatsappMessage('Sarah', 'https://undangan.test/u/wedding-member-custom-wa?to=Sarah');
    expect($message)->toContain('Kepada Sahabatku Sarah,')
        ->toContain('https://undangan.test/u/wedding-member-custom-wa?to=Sarah');
});

test('member cannot update whatsapp template of another member invitation', function () {
    $otherInvitation = Invitation::create([
        'user_id' => $this->otherMember->id,
        'owner_id' => $this->otherMember->id,
        'theme_id' => $this->theme->id,
        'title' => 'Other Member Invitation',
        'slug' => 'other-member-invitation',
    ]);

    $response = $this->actingAs($this->member)->post(route('member.guests.template'), [
        'invitation_id' => $otherInvitation->id,
        'whatsapp_template' => 'Hacked template',
    ]);

    $response->assertNotFound();
});

test('partner cannot update whatsapp template of another partner invitation', function () {
    $otherInvitation = Invitation::create([
        'user_id' => $this->otherPartner->id,
        'owner_id' => $this->otherPartner->id,
        'partner_id' => $this->otherPartner->id,
        'theme_id' => $this->theme->id,
        'title' => 'Other Partner Invitation',
        'slug' => 'other-partner-invitation',
    ]);

    $response = $this->actingAs($this->partner)->post(route('partner.guests.template'), [
        'invitation_id' => $otherInvitation->id,
        'whatsapp_template' => 'Hacked partner template',
    ]);

    $response->assertNotFound();
});
