<?php
namespace FSS\Controllers;

use \DateTime;
use \Exception;
use FSS\Models\User;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use FSS\Utilities\Token;
use League\OAuth2\Server\AuthorizationServer;

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
    implements ControllerInterface
{

    // The dependencies.
    private $logger;

    private $db;

    private $cache;
    
    /**
     * @var AuthorizationServer
     */
    private $authorizer;

    private $jwtToken;

    private $debug;

    /**
     * The constructor that sets the dependencies and
     * enable query logging if debug mode is true in settings.php
     *
     * @param Logger $logger
     * @param Manager $db
     * @param Cache $cache
     * @param Token $jwt
     * @param object $jwtToken
     * @param bool $debug
     */
    public function __construct(Logger $logger, Manager $db, Cache $cache,
        $authorizer, bool $debug)
    {
        $this->logger = $logger;
        $this->db = $db;
        $this->cache = $cache;
        $this->authorizer = $authorizer;
        //$this->jwtToken = $jwtToken;
        $this->debug = $debug;
        if ($this->debug) {
            $this->logger->debug("Enabling query log for the User Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read() 
     * @SWG\Api(
     *      path="/users/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a User",
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
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $params = ['id', $id];
        $request = $request->withAttribute('params', 
            implode('/', $params));
        $this->logger->debug("Reading user with id of $id");
        
        // $user = User::findOrFail($id);
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() 
     * @SWG\Api(
     *      path="/users",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch Users",
     *      type="User"
     *      )
     *      )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // $records = User::with(['person', 'gender'])->get();
        // The above doesn't work
        $records = User::with(
            [
                'person' => function ($q) {
                    return $q->with('gender');
                    // NOTE: If you need to traverse the depths of more
                    // than two tables (in this case, the user, person
                    // and gender tables) you will need to handle the
                    // deeper relationships as done here.
                }
            ])->limit(200)->get();
        $this->logger->debug("All Users query: ", $this->db::getQueryLog());
        return $response->withJson(
            [
                "success" => true,
                "message" => "All users returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() 
     * @SWG\Api(
     *      path="/users/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays Users that meet the property=value search criteria",
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
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        //$filter = $args['filter'];
        //$value = $args['value'];
        
        $params = explode('/', $request->getAttribute('params'));
        $filters = [];
        $values  = [];
        
        try {
            $this->getFilters($params, $filters, $values);
            
            foreach($filters as $filter) {
            User::validateColumn($filter, $this->logger, $this->cache, $this->db);
            }
            // $records = User::where($filter, 'like', '%' . $value . '%')->get();
            $records = User::with(
                [
                    'person' => function ($q) {
                        return $q->with('gender');
                        // NOTE: If you need to traverse the depths of more
                        // than two tables (in this case, the user, person
                        // and gender tables) you will need to handle the
                        // deeper relationships as done here.
                    }
                ])->whereRaw(
                    'LOWER(`' . $filters[0] . '`) like ?', 
                    ['%' . strtolower($values[0]) . '%']);
            for($i = 1; $i < count($filters); $i++) {
                $records = $records->whereRaw(
                    'LOWER(`' . $filters[$i] . '`) like ?', 
                    ['%' . strtolower($values[$i]) . '%']);
            }
            $records = $records->limit(200)->get();
            
            $this->logger->debug("Users with filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No users found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered users by $filter",
                    "data" => $records
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Error occured: " . $e->getMessage()
                ], 400);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() 
     * @SWG\Api(
     *      path="/users",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a User. See User model for details.",
     *      type="User",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
    public function create(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $recordData = $request->getParsedBody();
        $checkPassword = $recordData['password2'];
        unset($recordData['password2']);
        try {
            foreach ($recordData as $key => $val) {
                User::validateColumn($key, $this->logger, $this->cache,
                    $this->db);
                $this->logger->debug("POST values: ",
                    [$key . " => " . $val]);
            }
            if (! ($recordData['password'] === $checkPassword)) {
                throw new Exception("The passwords do not match.");
            }
            $recordData['password'] = password_hash($recordData['password'],
                PASSWORD_DEFAULT);
            $recordData['updated_by'] = $this->jwtToken->sub;
            $recordId = User::insertGetId($recordData);
            $this->logger->debug("Users create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "User $recordId has been created.",
                    "id" => $recordId
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Error occured: " . $e->getMessage()
                ], 400);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() 
     * @SWG\Api(
     *      path="/users/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a User. See the User model for details.",
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
    public function update(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // $id = $args['id'];
        $recordData = $request->getParsedBody();
        try {
            $updateData = [];
            foreach ($recordData as $key => $val) {
                User::validateColumn($key, $this->logger, $this->cache,
                    $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $updateData['updated_by'] = $this->jwtToken->sub;
            $recordId = User::update($updateData);
            $this->logger->debug("Users update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated user $recordId"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Error occured: " . $e->getMessage()
                ], 400);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::delete() 
     * @SWG\Api(
     *      path="/users/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a User",
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
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        
        try {
            $record = User::findOrFail($id);
            $record->delete();
            $this->logger->debug("Users delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted user $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "User not found"
                ], 404);
        }
    }

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
            $response = $this->authorizer->
                respondToAccessTokenRequest($request, $response);
            //$tokenData = $this->jwt->generate($id);
            // if(!setcookie('token', $tokenData['token'],
            // (int)$tokenData['expires'], '/', "", false, true)) {
            //if (! setcookie(getenv('JWT_NAME'), $tokenData['token'], 0, '/', '',
            //    false, true)) {
            //    throw new Exception(
            //        "Cannot create the JWT Token. Disallowing authentication.");
            //}
            $this->logger->debug("Logging in user $id");
            //return $response->withJson(
            //    [
            //        "success" => true,
            //        "message" => "$id logged in successfully.",
            //        "id" => $id,
            //        "token" => $tokenData['token']
            //    ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
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
        /*$userIdFromToken = $this->jwtToken->sub;
        try {
            $expireTime = new DateTime("now -60 minutes");
            $expireTimestamp = $expireTime->getTimeStamp();
            if (! setcookie(getenv('JWT_NAME'), '', $expireTimestamp, '/', '',
                false, true)) {
                throw new Exception("Cannot unset the JWT Token.");
            }
            unset($_COOKIE[getenv('JWT_NAME')]);
            $this->logger->debug("Logging out user $userIdFromToken");
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "$userIdFromToken logged out successfully."
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => $e->getMessage()
                ], 404, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }*/
    }
}
