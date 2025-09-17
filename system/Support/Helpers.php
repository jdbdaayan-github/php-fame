<?php

use System\Support\Config;
use System\Support\Env;
use System\View\View;

if (!function_exists('env')) {
    function env(string $key, $default = null) {
        return Env::get($key, $default);
    }
}

if (!function_exists('config')) {
    function config(string $key) {
        return Config::get($key);
    }
}


if (!function_exists('view')) {
    function view(string $view, array $data = [])
    {
        static $engine = null;

        if ($engine === null) {
            $engine = new View(__DIR__ . '/../../app/Views');
        }

        return $engine->render($view, $data);
    }
}

if (!function_exists('config')) {
    function config(string $key, $default = null)
    {
        static $configs = [];

        // Load all configs once
        if (empty($configs)) {
            foreach (glob(__DIR__ . '/../../config/*.php') as $file) {
                $name = basename($file, '.php');
                $configs[$name] = require $file;
            }
        }

        // Support dot notation: config('app.name')
        $segments = explode('.', $key);
        $value = $configs;

        foreach ($segments as $segment) {
            if (is_array($value) && array_key_exists($segment, $value)) {
                $value = $value[$segment];
            } else {
                return $default;
            }
        }

        return $value;
    }
}

function app(): \System\Application
{
    return \System\Application::getInstance();
}

if (!function_exists('base_path')) {
    function base_path(string $path = ''): string
    {
        // __DIR__ points to system/Support, so go two levels up
        $base = realpath(__DIR__ . '/../../');
        return $path ? $base . DIRECTORY_SEPARATOR . $path : $base;
    }
}

/**
 * Generate a full URL for the application.
 *
 * @param string $path Optional path to append
 * @param array $query Optional query parameters
 * @return string
 */
function url(string $path = '', array $query = []): string
{
    // Get base URL only from .env (no default)
    $base = rtrim(Env::get('APP_URL'), '/');

    // Clean leading slash from path
    $path = ltrim($path, '/');

    // Build full URL
    $full = $base . ($path ? '/' . $path : '');

    // Append query string if any
    if (!empty($query)) {
        $full .= '?' . http_build_query($query);
    }

    return $full;
}

