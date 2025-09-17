<?php

namespace System\Security;

class Hash
{
    public static function make(string $value): string
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }

    public static function check(string $value, string $hashedValue): bool
    {
        return password_verify($value, $hashedValue);
    }
}
