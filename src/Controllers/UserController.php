<?php
namespace FSS\Controllers;

use FSS\Models\User;
use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Exception;

/**
 * The user controller for all user-related actions.
 *
 * @author Dewayne
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/users",
 *         description="User operations",
 *         produces="['application/json']"
 *         )
 */
class UserController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "User";
    
    /**
     * The constructor that sets The dependencies and
     * enable query logging if debug mode is true in settings.php
     *
     * @param Logger $logger
     * @param Manager $db
     * @param Cache $cache
     * @param bool $debug
     * @param AuthorizationServer $authorizer
     */
    public function __construct(Logger $logger, Manager $db, Cache $cache,
        bool $debug, AuthorizationServer $authorizer)
    {
        $this->logger = $logger;
        $this->db = $db;
        $this->cache = $cache;
        $this->debug = $debug;
        $this->authorizer = $authorizer;
        $this->modelName = $this->model;
        parent::__construct();
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read() @SWG\Api(
     *      path="/users/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a User",     
     *      nickname="UserRead",
     *      type="User",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of User to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="User not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/users",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch Users",     
     *      nickname="UserReadAll",
     *      type="User"
     *      )
     *      )
     */
//     public function readAll(ServerRequestInterface $request,
//         ResponseInterface $response, array $args): ResponseInterface
//         {
//             // $records = User::with(['person', 'gender'])->get();
//             // The above doesn't work
//             $records = User::with(
//                 [
//                     'person' => function ($q) {
//                     return $q->with('gender');
//                     // NOTE: If you need to traverse the depths of more
//                     // than two tables (in this case, the user, person
//                     // and gender tables) you will need to handle the
//                     // deeper relationships as done here.
//                     }
//                     ])->limit(200)->get();
//                     $this->logger->debug("All Users query: ", $this->db::getQueryLog());
//                     return $response->withJson(
//                         [
//                             "success" => true,
//                             "message" => "All users returned",
//                             "data" => $records
//                         ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
//     }
    
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/users/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays Users that meet the property=value search criteria",     
     *      nickname="UserReadAllWithFilter",
     *      type="User",
     *      @SWG\Parameter(
     *      name="filter",
     *      description="property to search for in the related model.",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="string"
     *      ),
     *      @SWG\Parameter(
     *      name="value",
     *      description="value to search for, given the property.",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="object"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="User not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/users",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a User. See User model for details.",     
     *      nickname="UserCreate",
     *      type="User",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/users/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a User. See the User model for details.",     
     *      nickname="UserUpdate",
     *      type="User",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of User to update",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::delete() @SWG\Api(
     *      path="/users/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a User",     
     *      nickname="UserDelete",
     *      type="User",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of User to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="User not found")
     *      )
     *      )
     */


    /**
     * The login action for a user.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @throws Exception
     * @return ResponseInterface
     */
    public function login(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $userData = $request->getParsedBody();
        
        try {
            $id = User::authenticate($userData, $this->logger, $this->cache,
                $this->db);
            $response = $this->authorizer->respondToAccessTokenRequest($request,
                $response);
            // $tokenData = $this->jwt->generate($id);
            // if(!setcookie('token', $tokenData['token'],
            // (int)$tokenData['expires'], '/', "", false, true)) {
            // if (! setcookie(getenv('JWT_NAME'), $tokenData['token'], 0, '/', '',
            // false, true)) {
            // throw new Exception(
            // "Cannot create the JWT Token. Disallowing authentication.");
            // }
            $this->logger->debug("Logging in user $id");
            // return $response->withJson(
            // [
            // "success" => true,
            // "message" => "$id logged in successfully.",
            // "id" => $id,
            // "token" => $tokenData['token']
            // ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            return $response;
        } catch (\League\OAuth2\Server\Exception\OAuthServerException $exception) {
            // All instances of OAuthServerException can be formatted into a HTTP response
            return $exception->generateHttpResponse($response);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => $e->getMessage()
                ], 401, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }
    }

    /**
     * The logout action for the user.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @throws Exception
     * @return ResponseInterface
     */
    public function logout(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        /*
         * $userIdFromToken = $request->getAttribute('oauth_user_id');
         * try {
         * $expireTime = new DateTime("now -60 minutes");
         * $expireTimestamp = $expireTime->getTimeStamp();
         * if (! setcookie(getenv('JWT_NAME'), '', $expireTimestamp, '/', '',
         * false, true)) {
         * throw new Exception("Cannot unset the JWT Token.");
         * }
         * unset($_COOKIE[getenv('JWT_NAME')]);
         * $this->logger->debug("Logging out user $userIdFromToken");
         * return $response->withJson(
         * [
         * "success" => true,
         * "message" => "$userIdFromToken logged out successfully."
         * ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
         * } catch (Exception $e) {
         * return $response->withJson(
         * [
         * "success" => false,
         * "message" => $e->getMessage()
         * ], 404, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
         * }
         */
    }
}
