<?php
// system/Security/CSRF.php
namespace System\Security;

class CSRF
{
    public static function token(): string
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

    public static function validate(string $token): bool
    {
        return isset($_SESSION['_csrf']) && hash_equals($_SESSION['_csrf'], $token);
    }

    public static function check(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $token = $_POST['_csrf'] ?? '';
            if (!self::validate($token)) {
                http_response_code(419);
                die('CSRF token mismatch!');
            }
        }
    }
}
