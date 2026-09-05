<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Database configuration
 * This framework expects a `$database` variable to be defined.
 */
$db_env = static function (string $key, $default = '') {
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
    return ($value !== false && $value !== '') ? $value : $default;
};

$database = [
    'main' => [
        'dsn'        => '',
        'hostname'   => $db_env('DB_HOST', 'localhost'),
        'username'   => $db_env('DB_USERNAME', 'root'),
        'password'   => $db_env('DB_PASSWORD', ''),
        'database'   => $db_env('DB_DATABASE', 'mydb'),
        'driver'     => $db_env('DB_DRIVER', 'mysql'),
        'dbprefix'   => '',
        'port'       => $db_env('DB_PORT', 3306),
        'charset'    => 'utf8mb4',
        'dbcollat'   => 'utf8mb4_general_ci',
        'ssl_ca'     => $db_env('DB_SSL_CA', 'certs/ca.pem'),
    ],
];

// For backward compatibility, also return the array if someone expects a return value
return $database;