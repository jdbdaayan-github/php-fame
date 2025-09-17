<?php

namespace System\Security;

use App\Models\User;
use System\Security\Hash;

class Auth
{
    protected static ?User $user = null;

    public static function attempt(string $email, string $password): bool
    {
        // Example: query your user model
        $user = User::findByEmail($email);

        if ($user && Hash::check($password, $user->password)) {
            $_SESSION['user_id'] = $user->id;
            static::$user = $user;
            return true;
        }

        return false;
    }

    public static function user(): ?User
    {
        if (static::$user) {
            return static::$user;
        }

        if (isset($_SESSION['user_id'])) {
            static::$user = User::find($_SESSION['user_id']);
            return static::$user;
        }

        return null;
    }

    public static function check(): bool
    {
        return static::user() !== null;
    }

    public static function logout()
    {
        unset($_SESSION['user_id']);
        static::$user = null;
    }
}
