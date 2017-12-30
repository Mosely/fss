<?php
namespace FSS\Controllers;

use FSS\Models\CityDataExtended;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use Swagger\Annotations as SWG;
use \Exception;

/**
 * The controller for city_data_extended-related actions.
 * (Not to be confused with city_data-related actions)
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/citydataextended",
 *     description="Extended city data operations",
 *     produces="['application/json']"
 * ) 
 */
class CityDataExtendedController implements ControllerInterface
{

    // The dependencies.
    private $logger;

    private $db;

    private $cache;

    private $debug;

    /**
     * The constructor that sets The dependencies and
     * enable query logging if debug mode is true in settings.php
     *
     * @param Logger $logger
     * @param Manager $db
     * @param Cache $cache
     * @param bool $debug
     */
    public function __construct(Logger $logger, Manager $db, Cache $cache,
        bool $debug)
    {
        $this->logger = $logger;
        $this->db = $db;
        $this->cache = $cache;
        $this->debug = $debug;
        if ($this->debug) {
            $this->logger->debug(
                "Enabling query log for the CityDataExtendedController.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     * 
     * @SWG\Api(
     *     path="/citydataextended/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays an extended city data record",
     *         type="CityDataExtended",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of extended city data to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="extended city data not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        // $this->logger->info("Reading CityDataExtended with id of $id");
        $this->logger->debug("Reading CityDataExtended with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     * 
     * @SWG\Api(
     *     path="/citydataextended",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch extended city data",
     *         type="CityDataExtended"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = CityDataExtended::with(
            [
                'CityData',
                'StateData'
            ]
            )->limit(200)->get();
        $this->logger->debug("All city_data_extended query: ",
            $this->db::getQueryLog());
        // $records = City_data_extended::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All CityDataExtended returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()]
     * 
     * @SWG\Api(
     *     path="/citydataextended/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays extended city data that meet the property=value search criteria",
     *         type="CityDataExtended",
     *         @SWG\Parameter(
     *             name="filter",
     *             description="property to search for in the related model.",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="string"
     *         ),
     *         @SWG\Parameter(
     *             name="value",
     *             description="value to search for, given the property.",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="object"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="extended city data not found")
     *     )
     * )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            CityDataExtended::validateColumn('CityDataExtended', $filter,
                $this->container);
            $records = CityDataExtended::with(
                [
                    'CityData',
                    'StateData'
                ]
            )->where($filter, 'like', '%' . $value . '%')->limit(200)->get();
            $this->logger->debug("CityDataExtended filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No CityDataExtended found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered CityDataExtended by $filter",
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
     * 
     * @SWG\Api(
     *     path="/citydataextended",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates an extended city data record.  See CityDataExtended model for details.",
     *         type="CityDataExtended",
     *         @SWG\ResponseMessage(code=400, message="Error occurred")
     *     )
     * )
     */
    public function create(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // Make sure the frontend only puts the name attribute
        // on form elements that actually contain data
        // for the record.
        $recordData = $request->getParsedBody();
        try {
            foreach ($recordData as $key => $val) {
                CityDataExtended::validateColumn('CityDataExtended', $key,
                    $this->container);
            }
            $recordId = CityDataExtended::insertGetId($recordData);
            $this->logger->debug("CityDataExtended create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "CityDataExtended $recordId has been created."
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
     * 
     * @SWG\Api(
     *     path="/citydataextended/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates an extended city data record.  See the CityDataExtended model for details.",
     *         type="CityDataExtended",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of extended city data record to update",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=400, message="Error occurred")
     *     )
     * )
     */
    public function update(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // $id = $args['id'];
        $recordData = $request->getParsedBody();
        try {
            $updateData = [];
            foreach ($recordData as $key => $val) {
                CityDataExtended::validateColumn('CityDataExtended', $key,
                    $this->container);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = CityDataExtended::update($updateData);
            $this->logger->debug("CityDataExtended update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated CityDataExtended $recordId"
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
     * 
     * @SWG\Api(
     *     path="/citydataextended/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes an extended city data record",
     *         type="CityDataExtended",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of extended city data record to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="extended city data not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = CityDataExtended::findOrFail($id);
            $record->delete();
            $this->logger->debug("CityDataExtended delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted CityDataExtended $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "CityDataExtended not found"
                ], 404);
        }
    }
}
