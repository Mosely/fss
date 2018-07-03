<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for medication-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/medications",
 *         description="Medication operations",
 *         produces="['application/json']"
 *         )
 */
class MedicationController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "Medication";
    
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
     *      path="/medications/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a Medication",
     *      type="Medication",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Medication to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="Medication not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/medications",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch Medication",
     *      type="Medication"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/medications/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays Medication that meet the property=value search criteria",
     *      type="Medication",
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
     *      @SWG\ResponseMessage(code=404, message="Medication not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/medications",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a Medication. See Medication model for details.",
     *      type="Medication",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
  
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/medications/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a Medication. See the Medication model for details.",
     *      type="Medication",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Medication to update",
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
     *      path="/medications/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a Medication",
     *      type="Medication",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Medication to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="Medication not found")
     *      )
     *      )
     */
 
}
