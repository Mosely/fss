<?php
namespace FSS\Controllers;

use \DateTime;
use \Exception;
use FSS\Models\User;
use Interop\Container\ContainerInterface;

/**
 * The user controller for all user-related actions.
 *
 * @author Dewayne
 *        
 */
class UserController implements ControllerInterface
{

    // The DI container reference.
    private $container;

    /**
     * The constructor that sets the DI Container reference and
     * enable query logging if debug mode is true in settings.php
     *
     * @param ContainerInterface $c
     */
    public function __construct(ContainerInterface $c)
    {
        $this->container = $c;
        if ($this->container['settings']['debug']) {
            $this->container['logger']->debug(
                "Enabling query log for the User Controller.");
            $this->container['db']::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     */
    public function read($request, $response, $args)
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->container['logger']->debug("Reading user with id of $id");
        
        // $user = User::findOrFail($id);
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     */
    public function readAll($request, $response, $args)
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
        $this->container['logger']->debug("All Users query: ",
            $this->container['db']::getQueryLog());
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
    public function readAllWithFilter($request, $response, $args)
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            User::validateColumn('user', $filter, $this->container);
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
            $this->container['logger']->debug("Users with filter query: ",
                $this->container['db']::getQueryLog());
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
    public function create($request, $response, $args)
    {
        $recordData = $request->getParsedBody();
        $checkPassword = $recordData['password2'];
        unset($recordData['password2']);
        try {
            foreach ($recordData as $key => $val) {
                User::validateColumn('user', $key, $this->container);
            }
            if (! ($recordData['password'] === $checkPassword)) {
                throw new Exception("The passwords do not match.");
            }
            $recordData['password'] = password_hash($recordData['password'],
                PASSWORD_DEFAULT);
            $recordId = User::insertGetId($recordData);
            $this->container['logger']->debug("Users create query: ",
                $this->container['db']::getQueryLog());
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
    public function update($request, $response, $args)
    {
        // $id = $args['id'];
        $recordData = $request->getParsedBody();
        try {
            $updateData = [];
            foreach ($recordData as $key => $val) {
                User::validateColumn('user', $key, $this->container);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = User::update($updateData);
            $this->container['logger']->debug("Users update query: ",
                $this->container['db']::getQueryLog());
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
    public function delete($request, $response, $args)
    {
        $id = $args['id'];
        
        try {
            $record = User::findOrFail($id);
            $record->delete();
            $this->container['logger']->debug("Users delete query: ",
                $this->container['db']::getQueryLog());
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
     * @param unknown $request
     * @param unknown $response
     * @param unknown $args
     * @throws Exception
     * @return unknown
     */
    public function login($request, $response, $args)
    {
        $userData = $request->getParsedBody();
        
        try {
            $id = User::authenticate($userData, $this->container, 'user');
            $tokenData = $this->container['jwt']->generate($id);
            // if(!setcookie('token', $tokenData['token'],
            // (int)$tokenData['expires'], '/', "", false, true)) {
            if (! setcookie(getenv('JWT_NAME'), $tokenData['token'], 0, '/', '',
                false, true)) {
                throw new Exception(
                    "Cannot create the JWT Token. Disallowing authentication.");
            }
            $this->container['logger']->debug("Logging in user $id");
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
     * @param unknown $request
     * @param unknown $response
     * @param unknown $args
     * @throws Exception
     * @return unknown
     */
    public function logout($request, $response, $args)
    {
        $userIdFromToken = $this->container['jwtToken']->sub;
        try {
            $expireTime = new DateTime("now -60 minutes");
            $expireTimestamp = $expireTime->getTimeStamp();
            if (! setcookie(getenv('JWT_NAME'), '', $expireTimestamp, '/', '',
                false, true)) {
                throw new Exception("Cannot unset the JWT Token.");
            }
            unset($_COOKIE[getenv('JWT_NAME')]);
            $this->container['logger']->debug(
                "Logging out user $userIdFromToken");
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
