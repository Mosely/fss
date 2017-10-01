<?php
namespace FSS\Controllers;

use FSS\Models\CounseleeCounselingTopic;
use Interop\Container\ContainerInterface;
use \Exception;

/**
 * The controller for
 * counselee_counseling_topic-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 */
class CounseleeCounselingTopicController implements ControllerInterface
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
                "Enabling query log for the CounseleeCounselingTopic Controller.");
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
        
        $this->container['logger']->debug(
            "Reading CounseleeCounselingTopic with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     */
    public function readAll($request, $response, $args)
    {
        $records = CounseleeCounselingTopic::all();
        $this->container['logger']->debug(
            "All CounseleeCounselingTopic query: ",
            $this->container['db']::getQueryLog());
        // $records = CounseleeCounselingTopic::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All CounseleeCounselingTopic returned",
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
            CounseleeCounselingTopic::validateColumn(
                'CounseleeCounselingTopic', $filter, $this->container);
            $records = CounseleeCounselingTopic::where($filter, $value)->get();
            $this->container['logger']->debug(
                "CounseleeCounselingTopic filter query: ",
                $this->container['db']::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No CounseleeCounselingTopic found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered CounseleeCounselingTopic by $filter",
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
                CounseleeCounselingTopic::validateColumn(
                    'CounseleeCounselingTopic', $key, $this->container);
            }
            $recordId = CounseleeCounselingTopic::insertGetId($recordData);
            $this->container['logger']->debug(
                "CounseleeCounselingTopic create query: ",
                $this->container['db']::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "CounseleeCounselingTopic $recordId has been created."
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
                CounseleeCounselingTopic::validateColumn(
                    'CounseleeCounselingTopic', $key, $this->container);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = CounseleeCounselingTopic::update($updateData);
            $this->container['logger']->debug(
                "CounseleeCounselingTopic update query: ",
                $this->container['db']::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated CounseleeCounselingTopic $recordId"
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
            $record = CounseleeCounselingTopic::findOrFail($id);
            $record->delete();
            $this->container['logger']->debug(
                "CounseleeCounselingTopic delete query: ",
                $this->container['db']::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted CounseleeCounselingTopic $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "CounseleeCounselingTopic not found"
                ], 404);
        }
    }
}
