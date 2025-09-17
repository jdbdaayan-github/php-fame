<?php
namespace Config;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection
    |--------------------------------------------------------------------------
    | Options: "sync", "database", "redis"
    */
    'default' => env('QUEUE_CONNECTION', 'sync'),

    /*
    |--------------------------------------------------------------------------
    | Database Queue Configuration
    |--------------------------------------------------------------------------
    | Used if 'database' driver is selected
    */
    'database' => [
        'table' => 'jobs',
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Queue Configuration
    |--------------------------------------------------------------------------
    | Used if 'redis' driver is selected
    */
    'redis' => [
        'connection' => 'default',
        'queue' => env('REDIS_QUEUE', 'default'),
        'retry_after' => env('REDIS_RETRY_AFTER', 90),
    ],

    /*
    |--------------------------------------------------------------------------
    | Sync driver runs jobs immediately (no queue)
    |--------------------------------------------------------------------------
    */
    'sync' => [],

];
