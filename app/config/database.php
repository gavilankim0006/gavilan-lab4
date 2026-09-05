<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Database configuration
 * This framework expects a `$database` variable to be defined.
 */
$database = [
    'main' => [
        'dsn'        => '',
        'hostname'   => getenv('DB_HOST') ?: 'localhost',
        'username'   => getenv('DB_USERNAME') ?: 'root',
        'password'   => getenv('DB_PASSWORD') ?: '',
        'database'   => getenv('DB_DATABASE') ?: 'mydb',
        'dbdriver'   => 'mysqli',
        'dbprefix'   => '',
        'port'       => getenv('DB_PORT') ?: 3306,
        'charset'    => 'utf8mb4',
        'dbcollat'   => 'utf8mb4_general_ci',
    ],
];

// For backward compatibility, also return the array if someone expects a return value
return $database;