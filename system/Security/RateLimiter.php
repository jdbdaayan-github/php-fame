<?php

namespace System\Security;

class RateLimiter
{
    public static function tooManyAttempts(string $key, int $maxAttempts, int $decaySeconds): bool
    {
        $attempts = $_SESSION['rate'][$key]['count'] ?? 0;
        $last = $_SESSION['rate'][$key]['time'] ?? 0;

        if (time() - $last > $decaySeconds) {
            $_SESSION['rate'][$key] = ['count' => 0, 'time' => time()];
            return false;
        }

        return $attempts >= $maxAttempts;
    }

    public static function hit(string $key): void
    {
        $_SESSION['rate'][$key]['count'] = ($_SESSION['rate'][$key]['count'] ?? 0) + 1;
        $_SESSION['rate'][$key]['time'] = time();
    }
}
