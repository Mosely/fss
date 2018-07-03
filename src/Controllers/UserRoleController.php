<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for user_role-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/userroles",
 *         description="UserRole operations",
 *         produces="['application/json']"
 *         )
 */
class UserRoleController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "UserRole";
    
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
     *      path="/userroles/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a UserRole",
     *      type="UserRole",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of UserRole to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="UserRole not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/userroles",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch UserRole",
     *      type="UserRole"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/userroles/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays UserRole that meet the property=value search criteria",
     *      type="UserRole",
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
     *      @SWG\ResponseMessage(code=404, message="UserRole not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/userroles",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a UserRole. See UserRole model for details.",
     *      type="UserRole",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/userroles/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a UserRole. See the UserRole model for details.",
     *      type="UserRole",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of UserRole to update",
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
     *      path="/userroles/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a UserRole",
     *      type="UserRole",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of UserRole to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="UserRole not found")
     *      )
     *      )
     */

}
