<?php
// Dependency Injection Container configuration
$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(
        new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// illuminate capsule
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $capsule = new Illuminate\Database\Capsule\Manager();
    $capsule->addConnection($settings);
    $capsule->bootEloquent();
    
    //$capsule->getContainer()->singleton(
    //   Illuminate\Contracts\Debug\ExceptionHandler::class);
    
    return $capsule;
};

// opcache magic
$container['cache'] = function ($c) {
    return new FSS\Utilities\Cache($c->get('logger'));
};

// JWT Token Generator
$container['jwt'] = function ($c) {
    return new FSS\Utilities\Token();
};

// DJH juryrigging the Illuminate Manager object to
// be global here, so Model extensions work
$container['db']->setAsGlobal();
