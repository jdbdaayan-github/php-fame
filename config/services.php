<?php
namespace Config;

return [

    /*
    |--------------------------------------------------------------------------
    | Mailgun
    |--------------------------------------------------------------------------
    */
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN', ''),
        'secret' => env('MAILGUN_SECRET', ''),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Postmark
    |--------------------------------------------------------------------------
    */
    'postmark' => [
        'token' => env('POSTMARK_TOKEN', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | AWS / S3
    |--------------------------------------------------------------------------
    */
    'aws' => [
        'key' => env('AWS_ACCESS_KEY_ID', ''),
        'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        'bucket' => env('AWS_BUCKET', ''),
        'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom APIs
    |--------------------------------------------------------------------------
    */
    'my_service' => [
        'api_key' => env('MY_SERVICE_KEY', ''),
        'base_url' => env('MY_SERVICE_URL', 'https://api.example.com'),
    ],

];
