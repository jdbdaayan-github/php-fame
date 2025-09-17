<?php

use System\Support\Env;

return [

    'default' => Env::get('DB_CONNECTION', 'mysql'),

    'connections' => [

        'mysql' => [
            'driver'   => 'mysql',
            'host'     => Env::get('DB_HOST', '127.0.0.1'),
            'port'     => (int) Env::get('DB_PORT', 3306),
            'database' => Env::get('DB_DATABASE', 'fame_db'),
            'username' => Env::get('DB_USERNAME', 'root'),
            'password' => Env::get('DB_PASSWORD', ''),
            'charset'  => 'utf8mb4',
            'collation'=> 'utf8mb4_unicode_ci',
            'prefix'   => '',
            'strict'   => true,
        ],

        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => Env::get('PGSQL_HOST', '127.0.0.1'),
            'port'     => (int) Env::get('PGSQL_PORT', 5432),
            'database' => Env::get('PGSQL_DATABASE', 'fame_pg'),
            'username' => Env::get('PGSQL_USERNAME', 'root'),
            'password' => Env::get('PGSQL_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
            'sslmode'  => 'prefer',
        ],

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => Env::get('SQLITE_PATH', __DIR__ . '/../database.sqlite'),
            'prefix'   => '',
        ],

        'sqlsrv' => [
            'driver'   => 'sqlsrv',
            'host'     => Env::get('SQLSRV_HOST', '127.0.0.1'),
            'port'     => (int) Env::get('SQLSRV_PORT', 1433),
            'database' => Env::get('SQLSRV_DATABASE', 'fame_sqlsrv'),
            'username' => Env::get('SQLSRV_USERNAME', 'sa'),
            'password' => Env::get('SQLSRV_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
        ],

        'oci8' => [
            'driver'   => 'oci8',
            'host'     => Env::get('OCI_HOST', '127.0.0.1'),
            'port'     => (int) Env::get('OCI_PORT', 1521),
            'database' => Env::get('OCI_DATABASE', 'XE'),
            'username' => Env::get('OCI_USERNAME', 'root'),
            'password' => Env::get('OCI_PASSWORD', 'root'),
            'charset'  => 'AL32UTF8',
            'prefix'   => '',
        ],

    ],

];
