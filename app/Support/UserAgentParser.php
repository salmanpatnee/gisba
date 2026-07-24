<?php

namespace App\Support;

final class UserAgentParser
{
    /**
     * @return array{browser: string, platform: string, device_type: string}
     */
    public static function parse(string $userAgent): array
    {
        return [
            'browser' => self::browser($userAgent),
            'platform' => self::platform($userAgent),
            'device_type' => self::deviceType($userAgent),
        ];
    }

    public static function browser(string $userAgent): string
    {
        return match (true) {
            str_contains($userAgent, 'Edg/') => 'Edge',
            str_contains($userAgent, 'Chrome/') => 'Chrome',
            str_contains($userAgent, 'Firefox/') => 'Firefox',
            str_contains($userAgent, 'Safari/') => 'Safari',
            default => 'Unknown',
        };
    }

    public static function platform(string $userAgent): string
    {
        return match (true) {
            str_contains($userAgent, 'Windows') => 'Windows',
            str_contains($userAgent, 'iPhone'), str_contains($userAgent, 'iPad') => 'iOS',
            str_contains($userAgent, 'Mac OS X') => 'macOS',
            str_contains($userAgent, 'Android') => 'Android',
            str_contains($userAgent, 'Linux') => 'Linux',
            default => 'Unknown',
        };
    }

    public static function deviceType(string $userAgent): string
    {
        return match (true) {
            str_contains($userAgent, 'iPad'), str_contains($userAgent, 'Tablet') => 'Tablet',
            str_contains($userAgent, 'Mobile'), str_contains($userAgent, 'Android') => 'Mobile',
            default => 'Desktop',
        };
    }
}
