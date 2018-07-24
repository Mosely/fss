<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * This controller handles actions relating to
 * the branch_of_service model.
 *
 * @author Dewayne
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/branchesofservice",
 *         description="Branch Of Service operations",
 *         produces="['application/json']"
 *         )
 */
class BranchOfServiceController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "BranchOfService";
    
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
     *      path="/branchesofservice/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a branch of service.",
     *      nickname="BranchOfServiceRead",
     *      type="BranchOfService",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of branch of service to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="branch of service not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/branchesofservice",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch branches of service",
     *      nickname="BranchOfServiceReadAll",
     *      type="BranchOfService"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/branchesofservice/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays branches of service that meet the property=value search criteria",     
     *      nickname="BranchOfServiceReadAllWithFilter",
     *      type="BranchOfService",
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
     *      @SWG\ResponseMessage(code=404, message="branch of service not found")
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/branchesofservice",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a branch of service. See BranchOfService model for details.",     
     *      nickname="BranchOfServiceCreate",
     *      type="BranchOfService",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/branchesofservice/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a branch of service. See the BranchOfService model for details.",     
     *      nickname="BranchOfServiceUpdate",
     *      type="BranchOfService",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of branch of service to update",
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
     *      path="/branchesofservice/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a branch of service.",     
     *      nickname="BranchOfServiceDelete",
     *      type="BranchOfService",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of branch of service to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="branch of service not found")
     *      )
     *      )
     */
 
}
