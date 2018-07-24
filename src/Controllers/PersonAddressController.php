<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for person_address-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/personaddresses",
 *         description="PersonAddress operations",
 *         produces="['application/json']"
 *         )
 */
class PersonAddressController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "PersonAddress";
    
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
     *      path="/personaddresses/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a PersonAddress",      
     *      nickname="PersonAddressRead",
     *      type="PersonAddress",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of PersonAddress to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="PersonAddress not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/personaddresses",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch PersonAddress",     
     *      nickname="PersonAddressReadAll",
     *      type="PersonAddress"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/personaddresses/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays PersonAddress that meet the property=value search criteria",     
     *      nickname="PersonAddressReadAllWithFilter",
     *      type="PersonAddress",
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
     *      @SWG\ResponseMessage(code=404, message="PersonAddress not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/personaddresses",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a PersonAddress. See PersonAddress model for details.",     
     *      nickname="PersonAddressCreate",
     *      type="PersonAddress",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/personaddresses/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a PersonAddress. See the PersonAddress model for details.",     
     *      nickname="PersonAddressUpdate",
     *      type="PersonAddress",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of PersonAddress to update",
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
     *      path="/personaddresses/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a PersonAddress",     
     *      nickname="PersonAddressDelete",
     *      type="PersonAddress",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of PersonAddress to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="PersonAddress not found")
     *      )
     *      )
     */
 
}
