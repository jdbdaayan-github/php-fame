<?php
// system/Security/CSRF.php
namespace System\Security;

class CSRF
{
    public static function token()
    {
        if (!isset($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['_csrf'];
    }

    public static function tokenField(): string
    {
        return '<input type="hidden" name="_csrf" value="' . self::token() . '">';
    }

    public static function methodField(string $method): string
    {
        return '<input type="hidden" name="_method" value="' . $method . '">';
    }

    public static function validate($token): bool
    {
        return isset($_SESSION['_csrf']) && hash_equals($_SESSION['_csrf'], $token);
    }
}
