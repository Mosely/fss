<?php
namespace FSS\Controllers;

use FSS\Models\UserView;
use Interop\Container\ContainerInterface;
use \Exception;

/**
 * The controller for user_view-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 */
class UserViewController implements ControllerInterface
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
                "Enabling query log for the UserView Controller.");
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
        
        $this->container['logger']->debug("Reading UserView with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     */
    public function readAll($request, $response, $args)
    {
        $records = UserView::all();
        $this->container['logger']->debug("All UserView query: ",
            $this->container['db']::getQueryLog());
        // $records = User_view::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All UserView returned",
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
            UserView::validateColumn('UserView', $filter, $this->container);
            $records = UserView::where($filter, $value)->get();
            $this->container['logger']->debug("UserView filter query: ",
                $this->container['db']::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No UserView found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered UserView by $filter",
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
        // Make sure the frontend only puts the name attribute
        // on form elements that actually contain data
        // for the record.
        $recordData = $request->getParsedBody();
        try {
            foreach ($recordData as $key => $val) {
                UserView::validateColumn('UserView', $key, $this->container);
            }
            $recordId = UserView::insertGetId($recordData);
            $this->container['logger']->debug("UserView create query: ",
                $this->container['db']::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "UserView $recordId has been created."
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
                UserView::validateColumn('UserView', $key, $this->container);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = UserView::update($updateData);
            $this->container['logger']->debug("UserView update query: ",
                $this->container['db']::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated UserView $recordId"
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
            $record = UserView::findOrFail($id);
            $record->delete();
            $this->container['logger']->debug("UserView delete query: ",
                $this->container['db']::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted UserView $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "UserView not found"
                ], 404);
        }
    }
}
