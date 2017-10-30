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

/**
 * The user controller for all user-related actions.
 *
 * @author Dewayne
 *        
 */
class UserController implements ControllerInterface
{

    // The dependencies.
    private $logger;

    private $db;

    private $cache;

    private $jwt;

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
        Token $jwt, $jwtToken, bool $debug)
    {
        $this->logger = $logger;
        $this->db = $db;
        $this->cache = $cache;
        $this->jwt = $jwt;
        $this->jwtToken = $jwtToken;
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
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->logger->debug("Reading user with id of $id");
        
        // $user = User::findOrFail($id);
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
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
            ])->get();
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
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            User::validateColumn('user', $filter, $this->logger, $this->cache,
                $this->db);
            // $records = User::where($filter, $value)->get();
            $records = User::with(
                [
                    'person' => function ($q) {
                        return $q->with('gender');
                        // NOTE: If you need to traverse the depths of more
                        // than two tables (in this case, the user, person
                        // and gender tables) you will need to handle the
                        // deeper relationships as done here.
                    }
                ])->where($filter, $value)->get();
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
     */
    public function create(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $recordData = $request->getParsedBody();
        $checkPassword = $recordData['password2'];
        unset($recordData['password2']);
        try {
            foreach ($recordData as $key => $val) {
                User::validateColumn('user', $key, $this->logger, $this->cache,
                    $this->db);
            }
            if (! ($recordData['password'] === $checkPassword)) {
                throw new Exception("The passwords do not match.");
            }
            $recordData['password'] = password_hash($recordData['password'],
                PASSWORD_DEFAULT);
            $recordId = User::insertGetId($recordData);
            $this->logger->debug("Users create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "User $recordId has been created."
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
     */
    public function update(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // $id = $args['id'];
        $recordData = $request->getParsedBody();
        try {
            $updateData = [];
            foreach ($recordData as $key => $val) {
                User::validateColumn('user', $key, $this->logger, $this->cache,
                    $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
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
                $this->db, 'user');
            $tokenData = $this->jwt->generate($id);
            // if(!setcookie('token', $tokenData['token'],
            // (int)$tokenData['expires'], '/', "", false, true)) {
            if (! setcookie(getenv('JWT_NAME'), $tokenData['token'], 0, '/', '',
                false, true)) {
                throw new Exception(
                    "Cannot create the JWT Token. Disallowing authentication.");
            }
            $this->logger->debug("Logging in user $id");
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "$id logged in successfully.",
                    "id" => $id,
                    "token" => $tokenData['token']
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => $e->getMessage()
                ], 404, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
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
        $userIdFromToken = $this->jwtToken->sub;
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
        }
    }
}
