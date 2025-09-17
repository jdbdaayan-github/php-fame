<?php

namespace System\Security;

class Token
{
    private static string $secret = 'your-jwt-secret-change-this';

    public static function generate(array $payload, int $expiry = 3600): string
    {
        $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload['exp'] = time() + $expiry;
        $payload = base64_encode(json_encode($payload));

        $signature = hash_hmac('sha256', "$header.$payload", self::$secret, true);
        $signature = base64_encode($signature);

        return "$header.$payload.$signature";
    }

    public static function validate(string $token): bool|array
    {
        [$header, $payload, $signature] = explode('.', $token);
        $expected = base64_encode(hash_hmac('sha256', "$header.$payload", self::$secret, true));

        if (!hash_equals($expected, $signature)) {
            return false;
        }

        $data = json_decode(base64_decode($payload), true);
        if ($data['exp'] < time()) {
            return false;
        }

        return $data;
    }
}
