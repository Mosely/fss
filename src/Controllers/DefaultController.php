<?php
namespace FSS\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Just the default controller when [url]/ is invoked.
 *
 * @author Dewayne
 *        
 */
class DefaultController
{

   /**
    * The default action when [url]/ is invoked.
    * 
    * @param ServerRequestInterface $request
    * @param ResponseInterface $response
    * @param array $args
    * @return ResponseInterface
    */
    public function indexAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $response->withJson(
            [
                "success" => true,
                "message" => "This is the default route for our user system",
                "data" => [
                    "isDefault" => true
                ]
            ]);
    }
}
