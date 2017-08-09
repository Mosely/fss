<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
use FSS\Utilities\Token;

$app->add(new \Slim\Middleware\JwtAuthentication([
    "cookie" => getenv('JWT_NAME'),
    "secure" => true,
    "relaxed" => [
        "localhost",
        "nginx2.pantheon.local"
    ],
    "secret" => getenv('JWT_SECRET'), // DJH don't forget to change this and store it in an environment variable
    "algorithm" => getenv('JWT_ALGORITHM'),
    "callback" => function ($request, $response, $arguments) use ($container) {
        // $tokenContents = $arguments["decoded"];
        // DJH if this callbck executes, then that means the current JWT is good.
        // If the current JWT is good, issue a new JWT with a new expire time.
        // This should allow the JWT auth process to work until the end-user is
        // inactive for more than the JWT expire interval. Hopefully.
        $tokenData = Token::generate($arguments["decoded"]->sub);
        if (! setcookie(getenv('JWT_NAME'), $tokenData['token'], 0, '/', '', false, true)) {
            throw new \Exception("Cannot recreate the JWT Token with time extension. Disallowing authentication.");
            return false;
        }
        $container["jwt"] = $arguments["decoded"]; // DJH NOTE: this is the JWT that auth'ed this call, not the new JWT.
    },
    "error" => function ($request, $response, $arguments) {
        $data["success"] = false;
        $data["message"] = $arguments["message"];
        return $response->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    },
    "rules" => [
        new \Slim\Middleware\JwtAuthentication\RequestPathRule([
            "path" => "/",
            "passthrough" => [
                "/login"
            ]
        ]),
        new \Slim\Middleware\JwtAuthentication\RequestMethodRule([
            "passthrough" => [
                "OPTIONS"
            ]
        ])
    ]
]));