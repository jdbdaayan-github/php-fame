<?php

namespace System\Support;

class Config
{
    protected static array $instances = [];

    public static function get(string $key)
    {
        $segments = explode('.', $key);
        $file = ucfirst(array_shift($segments)) . 'Config';

        $class = "\\Config\\{$file}";

        if (!isset(self::$instances[$file])) {
            if (!class_exists($class)) {
                throw new \Exception("Config class {$class} not found.");
            }
            self::$instances[$file] = new $class();
        }

        $config = self::$instances[$file];

        foreach ($segments as $segment) {
            if (isset($config->$segment)) {
                $config = $config->$segment;
            } else {
                return null;
            }
        }

        return $config;
    }
}
