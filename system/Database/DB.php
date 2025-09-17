<?php
namespace System\Database;

use PDO;
use System\Support\Env;

class DB
{
    private static ?PDO $pdo = null;

    /**
     * Connect to the database using the default connection from config
     */
    public static function connect(): PDO
    {
        if (!self::$pdo) {
            $config = require __DIR__ . '/../../config/database.php';
            $default = $config['default'];
            $conn = $config['connections'][$default];

            $driver   = $conn['driver'];
            $host     = $conn['host'] ?? null;
            $port     = $conn['port'] ?? null;
            $database = $conn['database'] ?? null;
            $username = $conn['username'] ?? null;
            $password = $conn['password'] ?? null;
            $charset  = $conn['charset'] ?? 'utf8';

            $dsn = match($driver) {
                'mysql'  => "mysql:host=$host;port=$port;dbname=$database;charset=$charset",
                'pgsql'  => "pgsql:host=$host;port=$port;dbname=$database",
                'sqlite' => "sqlite:$database",
                'sqlsrv' => "sqlsrv:Server=$host,$port;Database=$database",
                'oci8'   => "oci:dbname=//$host:$port/$database;charset=$charset",
                default  => die("Unsupported driver: $driver"),
            };

            self::$pdo = new PDO($dsn, $username, $password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }

    /**
     * Start a query builder for a table
     */
    public static function table(string $table): QueryBuilder
    {
        return new QueryBuilder(self::connect(), $table);
    }

    /**
     * Execute a raw query
     */
    public static function raw(string $sql, array $bindings = []): array
    {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($bindings);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
