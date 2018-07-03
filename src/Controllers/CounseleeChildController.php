<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for counselee_child-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/counseleechildren",
 *         description="CounseleeChild operations",
 *         produces="['application/json']"
 *         )
 */
class CounseleeChildController extends AbstractController
{

    /**
     * var model
     */
    protected $model = "CounseleeChild";
    
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
     *      path="/counseleechildren/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a counselee child",
     *      type="CounseleeChild",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of counselee child to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="counselee child not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/counseleechildren",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch counselee children",
     *      type="CounseleeChild"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/counseleechildren/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays counselee children that meet the property=value search criteria",
     *      type="CounseleeChild",
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
     *      @SWG\ResponseMessage(code=404, message="veteran not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/counseleechildren",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a counselee child. See CounseleeChild model for details.",
     *      type="CounseleeChild",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/counseleechildren/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a counselee child. See the CounseleeChild model for details.",
     *      type="CounseleeChild",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of counselee child to update",
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
     *      path="/counseleechildren/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a counselee child",
     *      type="CounseleeChild",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of counselee child to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="counselee child not found")
     *      )
     *      )
     */
 
}
