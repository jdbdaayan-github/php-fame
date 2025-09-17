<?php
namespace System\Support\Facades;

use System\Application;

class Route
{
    public static function __callStatic($method, $args)
    {
        $app = Application::getInstance();
        return $app->router()->$method(...$args);
    }
}
