<?php

namespace System\Support;

class Env
{
    /**
     * Load .env file into $_ENV and $_SERVER
     */
    public static function load(string $path): void
    {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);

            // Skip comments
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            // Split key=value
            [$name, $value] = array_map('trim', explode('=', $line, 2));

            // Remove surrounding quotes
            $value = trim($value, "\"'");

            // Store into global env
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
            putenv("$name=$value");
        }
    }

    /**
     * Get an environment variable
     */
    public static function get(string $key, $default = null)
    {
        return $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key) ?: $default;
    }
}
