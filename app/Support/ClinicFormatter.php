<?php

namespace App\Support;

use DateTimeInterface;

class ClinicFormatter
{
    /**
     * Store Philippine mobile numbers in one canonical local form: 9XXXXXXXXX.
     * Non-mobile values are reduced to digits so legacy records remain usable.
     */
    public static function normalizePhone(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $digits = preg_replace('/\D+/', '', trim($value)) ?? '';
        if ($digits === '') {
            return null;
        }

        if (strlen($digits) === 12 && str_starts_with($digits, '63')) {
            $digits = substr($digits, 2);
        } elseif (strlen($digits) === 11 && str_starts_with($digits, '09')) {
            $digits = substr($digits, 1);
        }

        return $digits;
    }

    /**
     * Standard clinic display format: +63 9XX XXX XXXX.
     */
    public static function phone(?string $value, string $fallback = '—'): string
    {
        $digits = self::normalizePhone($value);
        if (! $digits) {
            return $fallback;
        }

        if (preg_match('/^9\d{9}$/', $digits)) {
            return '+63 '.substr($digits, 0, 3).' '.substr($digits, 3, 3).' '.substr($digits, 6, 4);
        }

        return $value ?: $fallback;
    }

    /**
     * Patient identifiers use one readable clinic-wide format: PT-YYYY-NNNN.
     */
    public static function patientCode(?string $code, ?int $id = null, DateTimeInterface|string|null $createdAt = null): string
    {
        $candidate = strtoupper(trim((string) $code));
        if (preg_match('/^PT-\d{4}-\d{4,}$/', $candidate)) {
            return $candidate;
        }

        $year = date('Y');
        if ($createdAt instanceof DateTimeInterface) {
            $year = $createdAt->format('Y');
        } elseif (is_string($createdAt) && $createdAt !== '') {
            $timestamp = strtotime($createdAt);
            if ($timestamp !== false) {
                $year = date('Y', $timestamp);
            }
        }

        if ($id !== null && $id > 0) {
            return sprintf('PT-%s-%04d', $year, $id);
        }

        return $candidate !== '' ? $candidate : sprintf('PT-%s-0000', $year);
    }
}
