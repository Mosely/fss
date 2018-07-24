<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

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
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/citydata",
 *         description="City data operations",
 *         produces="['application/json']"
 *         )
 */
class CityDataController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "CityData";
    
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
     *      path="/citydata/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays city data",     
     *      nickname="CityDataRead",
     *      type="CityData",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of city data to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="city data not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/citydata",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch all city data",     
     *      nickname="CityDataReadAll",
     *      type="CityData"
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/citydata/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays city data that meet the property=value search criteria",     
     *      nickname="CityDataReadAllWithFilter",
     *      type="CityData",
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
     *      @SWG\ResponseMessage(code=404, message="city data not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/citydata",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates city data. See CityData model for details.",     
     *      nickname="CityDataCreate",
     *      type="CityData",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/citydata/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates city data. See the CityData model for details.",     
     *      nickname="CityDataUpdate",
     *      type="CityData",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of city data to update",
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
     *      path="/citydata/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes city data record",     
     *      nickname="CityDataDelete",
     *      type="CityData",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of city data to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="city data not found")
     *      )
     *      )
     */
 
}
