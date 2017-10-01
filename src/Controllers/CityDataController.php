<?php
namespace FSS\Controllers;

use FSS\Models\CityData;
use Interop\Container\ContainerInterface;
use \Exception;

/**
 * The controller for city_data-related actions.
 * (Not to be confused with city_data_extended-related actions)
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 */
class CityDataController implements ControllerInterface
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
                "Enabling query log for the CityData Controller.");
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
        
        // $this->container['logger']->info("Reading city_data with id of $id");
        $this->container['logger']->debug("Reading city_data with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     */
    public function readAll($request, $response, $args)
    {
        $records = CityData::all();
        $this->container['logger']->debug("All city_data query: ",
            $this->container['db']::getQueryLog());
        // $records = City_data::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All CityData returned",
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
            CityData::validateColumn('city_data', $filter, $this->container);
            $records = CityData::where($filter, $value)->get();
            $this->container['logger']->debug("CityData filter query: ",
                $this->container['db']::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No CityData found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered CityData by $filter",
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
                CityData::validateColumn('city_data', $key, $this->container);
            }
            $recordId = CityData::insertGetId($recordData);
            $this->container['logger']->debug("CityData create query: ",
                $this->container['db']::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "CityData $recordId has been created."
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
                CityData::validateColumn('city_data', $key, $this->container);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = CityData::update($updateData);
            $this->container['logger']->debug("CityData update query: ",
                $this->container['db']::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated CityData $recordId"
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
            $record = CityData::findOrFail($id);
            $record->delete();
            $this->container['logger']->debug("CityData delete query: ",
                $this->container['db']::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted CityData $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "CityData not found"
                ], 404);
        }
    }
}
