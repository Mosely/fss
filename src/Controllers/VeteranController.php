<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for Veteran-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/veterans",
 *         description="Veteran operations",
 *         produces="['application/json']"
 *         )
 *        
 */
class VeteranController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "Veteran";
    
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
     *      path="/veterans/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a veteran",     
     *      nickname="VeteranRead",
     *      type="Veteran",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of veteran to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="veteran not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/veterans",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch veterans",     
     *      nickname="VeteranReadAll",
     *      type="Veteran"
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/veterans/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays veterans that meet the property=value search criteria",     
     *      nickname="VeteranReadAllWithFilter",
     *      type="Veteran",
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
     *      path="/veterans",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a veteran. See Veteran model for details.",     
     *      nickname="VeteranCreate",
     *      type="Veteran",
     *      @SWG\ResponseMessage(code=400, message="Error occurred"),
     *      @SWG\ResponseMessage(code=200,
     *      message="Veteran $recordId has been created.")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/veterans/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a veteran. See the Veteran model for details.",     
     *      nickname="VeteranUpdate",
     *      type="Veteran",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of veteran to update",
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
     *      path="/veterans/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a veteran",     
     *      nickname="VeteranDelete",
     *      type="Veteran",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of veteran to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="veteran not found")
     *      )
     *      )
     */
}
