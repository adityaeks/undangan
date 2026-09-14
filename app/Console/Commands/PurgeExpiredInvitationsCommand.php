<?php

namespace App\Console\Commands;

use App\Models\Invitation;
use App\Models\UserTheme;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('invitations:purge-expired {--dry-run : Simulate deletion without actually removing records}')]
#[Description('Hapus data undangan dan lisensi tema yang masa aktifnya telah habis beserta seluruh file fisiknya')]
class PurgeExpiredInvitationsCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $isDryRun = (bool) $this->option('dry-run');

        if ($isDryRun) {
            $this->warn('DRY RUN: Menjalankan simulasi pembersihan tanpa menghapus data.');
        }

        $now = now();
        $invitationsToPurge = collect();

        // 1. Ambil undangan yang memiliki expires_at langsung dan sudah lewat waktu
        $directExpiredInvitations = Invitation::query()
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', $now)
            ->get();

        foreach ($directExpiredInvitations as $invitation) {
            $invitationsToPurge->put($invitation->id, $invitation);
        }

        // 2. Ambil lisensi tema yang kedaluwarsa
        $expiredUserThemes = UserTheme::query()
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', $now)
            ->with('invitation')
            ->get();

        foreach ($expiredUserThemes as $userTheme) {
            if ($userTheme->invitation) {
                $invitationsToPurge->put($userTheme->invitation->id, $userTheme->invitation);
            }
        }

        $invitationCount = $invitationsToPurge->count();
        $themeCount = $expiredUserThemes->count();

        $this->info("Ditemukan {$invitationCount} undangan kedaluwarsa dan {$themeCount} lisensi tema kedaluwarsa.");

        // 3. Eksekusi penghapusan undangan (beserta cascade file fisik storage & relasi DB)
        foreach ($invitationsToPurge as $invitation) {
            $slug = $invitation->slug;
            $title = $invitation->title;

            if ($isDryRun) {
                $this->line(" [Simulasi] Akan menghapus undangan: [{$invitation->id}] {$title} ({$slug})");
            } else {
                $invitation->delete();
                $this->line(" <fg=green>✓</> Berhasil menghapus undangan: [{$invitation->id}] {$title} ({$slug})");
            }
        }

        // 4. Hapus record lisensi tema yang telah kedaluwarsa
        foreach ($expiredUserThemes as $userTheme) {
            if ($isDryRun) {
                $this->line(" [Simulasi] Akan menghapus UserTheme ID: {$userTheme->id} (User: {$userTheme->user_id}, Theme: {$userTheme->theme_id})");
            } else {
                $userTheme->delete();
                $this->line(" <fg=green>✓</> Berhasil menghapus lisensi tema ID: {$userTheme->id}");
            }
        }

        $actionWord = $isDryRun ? 'Teridentifikasi untuk dibersihkan' : 'Berhasil dibersihkan';
        $this->info("Selesai! {$actionWord}: {$invitationCount} undangan dan {$themeCount} lisensi tema.");

        return Command::SUCCESS;
    }
}
