<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

return [
    'main' => [
        'dsn'        => '',
        'hostname'   => env('DB_HOST', 'localhost'),
        'username'   => env('DB_USERNAME', 'root'),
        'password'   => env('DB_PASSWORD', ''),
        'database'   => env('DB_DATABASE', 'mydb'),
        'dbdriver'   => 'mysqli',
        'dbprefix'   => '',
        'port'       => env('DB_PORT', 3306),
        'charset'    => 'utf8mb4',
        'dbcollat'   => 'utf8mb4_general_ci',
    ],
];