<?php
// The settings array to be use by a variety 
// of dependencies and midlewares
return [
    'settings' => [
    // DJH Adding a setting bool for checking if we're in debug mode
        'debug' => ($debug = true), 
        // set to false in production
        'displayErrorDetails' => true, 
        // Allow the web server to send the content-length header
        'addContentLengthHeader' => false, 
                                           
        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => ($debug ? \Monolog\Logger::DEBUG : \Monolog\Logger::INFO)
        ],
        
        // MariaDB connection
        'db' => [
            // Eloquent configuration
            'driver' => getenv('DB_DRIVER'),
            'host' => getenv('DB_HOST'),
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => getenv('DB_CHARSET'),
            'collation' => getenv('DB_COLLATION'),
            'prefix' => getenv('DB_PREFIX')
        ]
    ]
];
