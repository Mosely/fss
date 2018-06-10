<?php
// Dependency Injection Container configuration

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(
        new Monolog\Handler\StreamHandler($settings['path'], 
            $settings['level']));
    return $logger;
};

// illuminate capsule
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $capsule = new Illuminate\Database\Capsule\Manager();
    $capsule->addConnection($settings);
    $capsule->bootEloquent();
    
    // $capsule->getContainer()->singleton(
    // Illuminate\Contracts\Debug\ExceptionHandler::class);
    
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

// OAuth 2.0 Authorization Server
$container['oauth2authorizer'] = function($c) {
    // Init our repositories
    $clientRepository = 
        new FSS\Utilities\OAuth2\Repositories\ClientRepository();
    $scopeRepository = 
        new FSS\Utilities\OAuth2\Repositories\ScopeRepository();
    $accessTokenRepository = 
        new FSS\Utilities\OAuth2\Repositories\AccessTokenRepository();
    $userRepository = 
        new FSS\Utilities\OAuth2\Repositories\UserRepository();
    $refreshTokenRepository = 
        new FSS\Utilities\OAuth2\Repositories\RefreshTokenRepository();
    
    // Path to public and private keys
    $privateKey = getenv('PRIVATE_KEY_PATH');
    $encryptionKey = getenv('DEFUSE_KEY'); 
    // generate using generate_defuse_key PHP script
    
    // Setup the authorization server
    $server = new \League\OAuth2\Server\AuthorizationServer(
        $clientRepository,
        $accessTokenRepository,
        $scopeRepository,
        $privateKey,
        Defuse\Crypto\Key::loadFromAsciiSafeString($encryptionKey)
        );
    
    $grant = new \League\OAuth2\Server\Grant\PasswordGrant(
        $userRepository,
        $refreshTokenRepository
        );
    
    $grant->setRefreshTokenTTL(new \DateInterval('PT1H')); 
    // refresh tokens will expire after 1 hour
    
    // Enable the password grant on the server
    $server->enableGrantType(
        $grant,
        new \DateInterval('PT20M') 
    // access tokens will expire after 20 minutes
        );
    return $server;
};

$container['oauth2resource'] = function($c) {
    // Init our repositories
    $accessTokenRepository = 
        new FSS\Utilities\OAuth2\Repositories\AccessTokenRepository();
    
    // Path to authorization server's public key
    $publicKeyPath = getenv('PUBLIC_KEY_PATH');
    
    // Setup the authorization server
    $server = new \League\OAuth2\Server\ResourceServer(
        $accessTokenRepository,
        $publicKeyPath
        );
    return $server;
};
// DJH juryrigging the Illuminate Manager object to
// be global here, so Model extensions work
$container['db']->setAsGlobal();
