<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

// Setting up JWT Authentication
/*$app->add(
    new \Slim\Middleware\JwtAuthentication(
        [
            "environment" => "HTTP_AUTHORIZATION",
            "header" => "Authorization",
            "cookie" => getenv('JWT_NAME'),
            "secure" => true,
            "relaxed" => [
                "localhost",
                "nginx2.pantheon.local",
                "nginx3.pantheon.local"
            ],
            "secret" => getenv('JWT_SECRET'),
            "algorithm" => getenv('JWT_ALGORITHM'),
            "callback" => function ($request, $response, $arguments) use (
            $container) {
                // $tokenContents = $arguments["decoded"];
                // DJH if this callbck executes, then that means the current JWT is good.
                // If the current JWT is good, issue a new JWT with a new expire time.
                // This should allow the JWT auth process to work until the end-user is
                // inactive for more than the JWT expire interval. Hopefully.
                $tokenData = $container['jwt']->generate(
                    $arguments["decoded"]->sub);
                if (! setcookie(getenv('JWT_NAME'), $tokenData['token'], 0, '/',
                    '', false, true)) {
                    throw new Exception(
                        "Cannot recreate the JWT Token with time extension. Disallowing authentication.");
                    return false;
                }
                // DJH NOTE: this is the JWT that auth'ed this call, not the new JWT.
                $container['jwt']->decoded = $arguments["decoded"];
            },
            "error" => function ($request, $response, $arguments) {
                $data = [];
                $data["success"] = false;
                $data["message"] = $arguments["message"];
                return $response->withHeader("Content-Type", "application/json")
                    ->write(
                    json_encode($data,
                        JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            },
            "rules" => [
                new \Slim\Middleware\JwtAuthentication\RequestPathRule(
                    [
                        "path" => "/",
                        "passthrough" => [
                            "/login",
                            "/docs",
                            "/api-docs"
                        ]
                    ]),
                new \Slim\Middleware\JwtAuthentication\RequestMethodRule(
                    [
                        "passthrough" => [
                            "OPTIONS"
                        ]
                    ])
            ]
        ]));*/

//$app->add(new \League\OAuth2\Server\Middleware\ResourceServerMiddleware($container['oauth2resource']));
$app->add(
    function ($request, $response, $next) use ($container) {
        //$route = $request->getAttribute('route');
        //$name = $route->getName();
        $name = $request->getUri()->getPath();
        
        if ($name !== '/login') {
            $oAuthResourceMiddleware = new \League\OAuth2\Server\Middleware\ResourceServerMiddleware(
                $container['oauth2resource']);
            return $oAuthResourceMiddleware($request, $response, $next);
        }
        
        return $next($request, $response);
    });

$app->add(
        new Tuupola\Middleware\CorsMiddleware([
            "origin" => ["*"],
            "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
            "headers.allow" => ["Authorization", "If-Match", "If-Unmodified-Since", "Content-Type"],
            "headers.expose" => ["Etag"],
            "credentials" => true,
            "cache" => 0,
            "logger" => $container['logger'],
            "error" => function ($request, $response, $arguments) {
                $data = [];
                $data["status"] = "error";
                $data["message"] = $arguments["message"];
                return $response
                    ->withHeader("Content-Type", "application/json")
                    ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            }
        ]));