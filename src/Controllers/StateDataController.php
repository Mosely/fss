<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for state_data-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/statedata",
 *         description="StateData operations",
 *         produces="['application/json']"
 *         )
 */
class StateDataController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "StateData";
    
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
     *      path="/statedata/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a StateData",     
     *      nickname="StateDataRead",
     *      type="StateData",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of StateData to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="StateData not found")
     *      )
     *      )
     */


    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/statedata",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch StateData",     
     *      nickname="StateDataReadAll",
     *      type="StateData"
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/statedata/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays StateData that meet the property=value search criteria",     
     *      nickname="StateDataReadAllWithFilter",
     *      type="StateData",
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
     *      @SWG\ResponseMessage(code=404, message="StateData not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/statedata",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a StateData. See StateData model for details.",     
     *      nickname="StateDataCreate",
     *      type="StateData",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */


    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/statedata/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a StateData. See the StateData model for details.",     
     *      nickname="StateDataUpdate",
     *      type="StateData",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of StateData to update",
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
     *      path="/statedata/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a StateData",     
     *      nickname="StateDataDelete",
     *      type="StateData",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of StateData to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="StateData not found")
     *      )
     *      )
     */

}
