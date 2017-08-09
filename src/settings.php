<?php
// DJH Juryrigging the Token and Cache class Utilities
require '../src/Utilities/token.php';
require '../src/Utilities/cache.php';

return [
    'settings' => [
        'debug' => ($debug = true), // DJH Adding a setting bool for checking if we're in debug mode
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        
        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => ($debug ? \Monolog\Logger::DEBUG : \Monolog\Logger::INFO),
        ],
        
        // MariaDB connection
        'db' => [
            // Eloquent configuration
            'driver'    => getenv('DB_DRIVER'),
            'host'      => getenv('DB_HOST'),
            'database'  => getenv('DB_DATABASE'),
            'username'  => getenv('DB_USERNAME'),
            'password'  => getenv('DB_PASSWORD'),
            'charset'   => getenv('DB_CHARSET'),
            'collation' => getenv('DB_COLLATION'),
            'prefix'    => getenv('DB_PREFIX'),
        ],
    ],
];
