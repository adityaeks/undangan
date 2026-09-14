<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (! function_exists('format_phone')) {
    /**
     * Normalize and format Indonesian phone number to international 62 standard.
     */
    function format_phone(?string $phone): string
    {
        if (! $phone) {
            return '';
        }

        $cleaned = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($cleaned, '0')) {
            return '62'.substr($cleaned, 1);
        }

        return $cleaned;
    }
}

if (! function_exists('whatsapp_url')) {
    /**
     * Generate standard WhatsApp chat / share URL.
     */
    function whatsapp_url(?string $phone, string $message = ''): string
    {
        $normalizedPhone = format_phone($phone);
        $encodedMessage = urlencode($message);

        if (empty($normalizedPhone)) {
            return "https://api.whatsapp.com/send?text={$encodedMessage}";
        }

        return "https://api.whatsapp.com/send?phone={$normalizedPhone}&text={$encodedMessage}";
    }
}

if (! function_exists('format_rupiah')) {
    /**
     * Format number or numeric string to Indonesian Rupiah currency representation.
     */
    function format_rupiah(float|int|string|null $amount): string
    {
        if ($amount === null || $amount === '') {
            return 'Rp 0';
        }

        if (is_string($amount)) {
            if (str_contains($amount, 'Rp') || str_contains($amount, 'rp')) {
                $amount = preg_replace('/[^0-9]/', '', $amount);
            }
        }

        $num = (float) $amount;

        return 'Rp '.number_format($num, 0, ',', '.');
    }
}

if (! function_exists('upload_as_webp')) {
    /**
     * Store an uploaded image file as an optimized WebP file.
     */
    function upload_as_webp(
        UploadedFile $file,
        string $directory = 'invitations',
        int $quality = 85,
        int $maxWidth = 1920,
        string $disk = 'public'
    ): string {
        $cleanDirectory = trim($directory, '/');

        // If already WebP format, store directly
        if (strtolower($file->getClientOriginalExtension()) === 'webp' || $file->getMimeType() === 'image/webp') {
            return $file->store($cleanDirectory, $disk);
        }

        // Attempt to create image resource via GD
        $mime = $file->getMimeType();
        $sourcePath = $file->getRealPath();

        $image = match ($mime) {
            'image/jpeg', 'image/jpg' => @imagecreatefromjpeg($sourcePath),
            'image/png' => @imagecreatefrompng($sourcePath),
            'image/gif' => @imagecreatefromgif($sourcePath),
            'image/webp' => @imagecreatefromwebp($sourcePath),
            default => null,
        };

        // If GD cannot process or extension isn't loaded, fallback safely to standard store()
        if (! $image || ! function_exists('imagewebp')) {
            return $file->store($cleanDirectory, $disk);
        }

        // Preserve alpha transparency for PNG/GIF
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        // Smart downscale if dimensions exceed maxWidth
        $origWidth = imagesx($image);
        $origHeight = imagesy($image);

        if ($origWidth > $maxWidth && $maxWidth > 0) {
            $newWidth = $maxWidth;
            $newHeight = (int) round(($origHeight * $maxWidth) / $origWidth);

            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($resizedImage, false);
            imagesavealpha($resizedImage, true);
            imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
            imagedestroy($image);
            $image = $resizedImage;
        }

        // Convert to WebP in memory
        ob_start();
        imagewebp($image, null, $quality);
        $webpContent = ob_get_clean();
        imagedestroy($image);

        // If conversion produced valid content, save as .webp
        if (! empty($webpContent)) {
            $fileName = Str::random(40).'.webp';
            $fullPath = $cleanDirectory.'/'.$fileName;
            Storage::disk($disk)->put($fullPath, $webpContent);

            return $fullPath;
        }

        // Fallback if buffer empty
        return $file->store($cleanDirectory, $disk);
    }
}

if (! function_exists('clear_invitation_cache')) {
    /**
     * Clear server-side public cache for a given invitation slug.
     */
    function clear_invitation_cache(string $slug): void
    {
        Cache::forget("invitation:public:{$slug}");
    }
}

if (! function_exists('delete_storage_file')) {
    /**
     * Delete a stored file on the given disk if it exists and is local to storage.
     */
    function delete_storage_file(?string $urlOrPath, string $disk = 'public'): bool
    {
        if (empty($urlOrPath)) {
            return false;
        }

        // Ignore external urls unless matching local storage path
        if (preg_match('#^https?://#i', $urlOrPath)) {
            $parsedPath = parse_url($urlOrPath, PHP_URL_PATH);
            if (! $parsedPath || ! str_contains($parsedPath, '/storage/')) {
                return false;
            }
            $urlOrPath = $parsedPath;
        }

        // Normalize /storage/path/to/file to path/to/file
        $relativePath = preg_replace('#^/?storage/#', '', ltrim($urlOrPath, '/'));

        if (Storage::disk($disk)->exists($relativePath)) {
            return Storage::disk($disk)->delete($relativePath);
        }

        return false;
    }
}
