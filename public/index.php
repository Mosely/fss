<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check
    // if the request was actually for
    // something which should probably be
    // served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

// If anything needs to be in a session, just
// consider adding it to the JWT payload.
// session_start();

// DJH Loading the .env environment variable file
$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();
$dotenv->required(
    [
        'DB_DRIVER',
        'DB_HOST',
        'DB_DATABASE',
        'DB_USERNAME',
        'DB_PASSWORD',
        'DB_CHARSET',
        'DB_COLLATION',
        'DB_PREFIX',
        'JWT_NAME',
        'JWT_SECRET',
        'JWT_ALGORITHM',
        'JWT_EXPIRATION'
    ]);

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Register controllers in the DI Container
require __DIR__ . '/../src/controllers.php';

// Run app
$app->run();
