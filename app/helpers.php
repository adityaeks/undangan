<?php

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
