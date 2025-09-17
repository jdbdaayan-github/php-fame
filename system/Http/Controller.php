<?php
namespace System\Http;

use System\View\ViewException;

class View
{
    public static string $basePath = __DIR__ . '/../../resources/views/';

    public static function make(string $view, array $data = []): string
    {
        $path = static::$basePath . str_replace('.', '/', $view) . '.fame.php';

        if (!file_exists($path)) {
            throw new ViewException("View [{$view}] not found at {$path}");
        }

        // extract() para maging variables yung array keys
        extract($data, EXTR_SKIP);

        // i-buffer yung output ng PHP file
        ob_start();
        include $path;
        return ob_get_clean();
    }
}
