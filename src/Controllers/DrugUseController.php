<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for drug_use-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/druguses",
 *         description="DrugUse operations",
 *         produces="['application/json']"
 *         )
 */
class DrugUseController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "DrugUse";
    
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
     *      path="/druguses/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a DrugUse",     
     *      nickname="DrugUseRead",
     *      type="DrugUse",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of DrugUse to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="DrugUse not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/druguses",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch DrugUse",     
     *      nickname="DrugUseReadAll",
     *      type="DrugUse"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/druguses/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays DrugUse that meet the property=value search criteria",     
     *      nickname="DrugUseReadAllWithFilter",
     *      type="DrugUse",
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
     *      @SWG\ResponseMessage(code=404, message="DrugUse not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/druguses",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a DrugUse. See DrugUse model for details.",     
     *      nickname="DrugUseCreate",
     *      type="DrugUse",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/druguses/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a DrugUse. See the DrugUse model for details.",     
     *      nickname="DrugUseUpdate",
     *      type="DrugUse",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of DrugUse to update",
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
     *      path="/druguses/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a DrugUse",     
     *      nickname="DrugUseDelete",
     *      type="DrugUse",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of DrugUse to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="DrugUse not found")
     *      )
     *      )
     */
 
}
