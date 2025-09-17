<?php
namespace Config;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    | This option controls the default cache driver that will be used.
    | Examples: 'file', 'database', 'redis', etc.
    */
    'default' => env('CACHE_STORE', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Cache Prefix
    |--------------------------------------------------------------------------
    | Used to avoid key collisions when using a shared cache like Redis.
    */
    'prefix' => env('CACHE_PREFIX', 'fame_'),

    /*
    |--------------------------------------------------------------------------
    | File Cache Configuration
    |--------------------------------------------------------------------------
    | If you use the file driver, this defines where cache files are stored.
    */
    'file' => [
        'path' => storage_path('cache'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Cache Configuration
    |--------------------------------------------------------------------------
    | If you use the database driver, define the table name here.
    */
    'database' => [
        'table' => 'cache',
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Cache Configuration
    |--------------------------------------------------------------------------
    | Connection name for Redis if using redis driver.
    */
    'redis' => [
        'connection' => 'default',
    ],

];
