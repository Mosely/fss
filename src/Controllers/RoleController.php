<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for role-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/roles",
 *         description="Role operations",
 *         produces="['application/json']"
 *         )
 */
class RoleController extends AbstractController implements ControllerInterface
{
    
    /**
     * var model
     */
    protected $model = "Role";
    
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
     *      path="/roles/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a Role",
     *      type="Role",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Role to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="Role not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/roles",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch Role",
     *      type="Role"
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/roles/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays Role that meet the property=value search criteria",
     *      type="Role",
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
     *      @SWG\ResponseMessage(code=404, message="Role not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/roles",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a Role. See Role model for details.",
     *      type="Role",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/roles/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a Role. See the Role model for details.",
     *      type="Role",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Role to update",
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
     *      path="/roles/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a Role",
     *      type="Role",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Role to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="Role not found")
     *      )
     *      )
     */

}
