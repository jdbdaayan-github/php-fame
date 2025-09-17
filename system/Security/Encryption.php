<?php

namespace System\Security;

class Encryption
{
    private static string $key = 'your-secret-key-change-this'; // ⚠️ dapat sa .env

    public static function encrypt(string $data): string
    {
        $iv = random_bytes(16);
        $cipher = openssl_encrypt($data, 'AES-256-CBC', self::$key, 0, $iv);
        return base64_encode($iv . $cipher);
    }

    public static function decrypt(string $payload): string|false
    {
        $decoded = base64_decode($payload);
        $iv = substr($decoded, 0, 16);
        $cipher = substr($decoded, 16);

        return openssl_decrypt($cipher, 'AES-256-CBC', self::$key, 0, $iv);
    }
}
