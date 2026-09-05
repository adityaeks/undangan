<?php

namespace App\Services;

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvitationService
{
    public function __construct(
        protected ThemeOwnershipService $themeOwnershipService,
    ) {}

    /**
     * Create a new invitation aggregate with its default settings and initial couples.
     *
     * @param  array<string, mixed>  $data
     *
     * @throws AuthorizationException
     */
    public function createInvitation(User $user, array $data): Invitation
    {
        /** @var Theme $theme */
        $theme = Theme::findOrFail($data['theme_id']);

        if (! $this->themeOwnershipService->canUseTheme($user, $theme)) {
            throw new AuthorizationException('Anda belum memiliki template ini. Silakan lakukan pembelian terlebih dahulu.');
        }

        return DB::transaction(function () use ($user, $theme, $data) {
            $slug = ! empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['title'].'-'.Str::random(5));

            $invitation = Invitation::create([
                'user_id' => $user->id,
                'owner_id' => $user->id,
                'partner_id' => $user->isPartner() ? $user->id : null,
                'client_id' => $data['client_id'] ?? null,
                'theme_id' => $theme->id,
                'title' => $data['title'],
                'slug' => $slug,
                'event_type' => $data['event_type'] ?? 'wedding',
                'event_date' => $data['event_date'] ?? null,
                'background_music' => $data['background_music'] ?? null,
                'quote_text' => $data['quote_text'] ?? null,
                'quote_source' => $data['quote_source'] ?? null,
                'cover_image' => $data['cover_image'] ?? null,
                'is_published' => false,
                'status' => 'draft',
                'passcode' => $data['passcode'] ?? null,
            ]);

            // Create modular settings
            $invitation->setting()->create([
                'bg_music_url' => $data['background_music'] ?? null,
                'is_music_autoplay' => false,
                'quote_text' => $data['quote_text'] ?? null,
                'quote_source' => $data['quote_source'] ?? null,
                'enable_comments' => true,
                'enable_rsvp' => true,
            ]);

            // If groom & bride names provided, create couples
            if (! empty($data['groom_name'])) {
                $invitation->couples()->create([
                    'role' => 'groom',
                    'full_name' => $data['groom_name'],
                    'nickname' => $data['groom_nickname'] ?? null,
                    'order' => 1,
                ]);
            }

            if (! empty($data['bride_name'])) {
                $invitation->couples()->create([
                    'role' => 'bride',
                    'full_name' => $data['bride_name'],
                    'nickname' => $data['bride_nickname'] ?? null,
                    'order' => 2,
                ]);
            }

            return $invitation;
        });
    }

    /**
     * Publish an invitation.
     */
    public function publishInvitation(Invitation $invitation): bool
    {
        return $invitation->update([
            'status' => 'published',
            'is_published' => true,
            'published_at' => now(),
        ]);
    }

    /**
     * Archive an invitation.
     */
    public function archiveInvitation(Invitation $invitation): bool
    {
        return $invitation->update([
            'status' => 'archived',
            'is_published' => false,
        ]);
    }
}
