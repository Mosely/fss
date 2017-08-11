<?php
namespace FSS\Controllers;

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
     * @param unknown $request
     * @param unknown $response
     * @param unknown $args
     * @return unknown
     */
    public function indexAction($request, $response, $args)
    {
        return $response->withJson([
            "success" => true,
            "message" => "This is the default route for our user system",
            "data" => [
                "isDefault" => true
            ]
        ]);
    }
}