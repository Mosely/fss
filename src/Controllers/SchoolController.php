<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for school-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/schools",
 *         description="School operations",
 *         produces="['application/json']"
 *         )
 */
class SchoolController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "School";
    
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
     *      path="/schools/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a School",     
     *      nickname="SchoolRead",
     *      type="School",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of School to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="School not found")
     *      )
     *      )
     */


    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/schools",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch School",     
     *      nickname="SchoolReadAll",
     *      type="School"
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/schools/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays School that meet the property=value search criteria",     
     *      nickname="SchoolReadAllWithFilter",
     *      type="School",
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
     *      @SWG\ResponseMessage(code=404, message="School not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/schools",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a School. See School model for details.",     
     *      nickname="SchoolCreate",
     *      type="School",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/schools/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a School. See the School model for details.",     
     *      nickname="SchoolUpdate",
     *      type="School",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of School to update",
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
     *      path="/schools/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a School",     
     *      nickname="SchoolDelete",
     *      type="School",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of School to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="School not found")
     *      )
     *      )
     */

}
