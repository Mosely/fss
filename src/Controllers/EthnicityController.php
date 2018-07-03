<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for ethnicity-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/ethnicities",
 *         description="Ethnicity operations",
 *         produces="['application/json']"
 *         )
 */
class EthnicityController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "Ethnicity";
    
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
     *      path="/ethnicities/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a Ethnicity",
     *      type="Ethnicity",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Ethnicity to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="Ethnicity not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/ethnicities",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch Ethnicity",
     *      type="Ethnicity"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/ethnicities/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays Ethnicity that meet the property=value search criteria",
     *      type="Ethnicity",
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
     *      @SWG\ResponseMessage(code=404, message="Ethnicity not found")
     *      )
     *      )
     */
  
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/ethnicities",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a Ethnicity. See Ethnicity model for details.",
     *      type="Ethnicity",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/ethnicities/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a Ethnicity. See the Ethnicity model for details.",
     *      type="Ethnicity",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Ethnicity to update",
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
     *      path="/ethnicities/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a Ethnicity",
     *      type="Ethnicity",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Ethnicity to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="Ethnicity not found")
     *      )
     *      )
     */
 
}
