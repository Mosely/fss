<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for person_phone-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/personphones",
 *         description="PersonPhone operations",
 *         produces="['application/json']"
 *         )
 */
class PersonPhoneController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "PersonPhone";
    
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
     *      path="/personphones/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a PersonPhone",     
     *      nickname="PersonPhoneRead",
     *      type="PersonPhone",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of PersonPhone to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="PersonPhone not found")
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/personphones",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch PersonPhone",     
     *      nickname="PersonPhoneReadAll",
     *      type="PersonPhone"
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/personphones/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays PersonPhone that meet the property=value search criteria",     
     *      nickname="PersonPhoneReadAllWithFilter",
     *      type="PersonPhone",
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
     *      @SWG\ResponseMessage(code=404, message="PersonPhone not found")
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/personphones",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a PersonPhone. See PersonPhone model for details.",     
     *      nickname="PersonPhoneCreate",
     *      type="PersonPhone",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/personphones/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a PersonPhone. See the PersonPhone model for details.",     
     *      nickname="PersonPhoneUpdate",
     *      type="PersonPhone",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of PersonPhone to update",
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
     *      path="/personphones/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a PersonPhone",     
     *      nickname="PersonPhoneDelete",
     *      type="PersonPhone",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of PersonPhone to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="PersonPhone not found")
     *      )
     *      )
     */
 
}
