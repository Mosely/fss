<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for counselee_drug_use-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/counseleedruguses",
 *         description="CounseleeDrugUse operations",
 *         produces="['application/json']"
 *         )
 */
class CounseleeDrugUseController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "CounseleeDrugUse";
    
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
     *      path="/counseleedruguses/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a CounseleeDrugUse",     
     *      nickname="CounseleeDrugUseRead",
     *      type="CounseleeDrugUse",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeDrugUse to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounseleeDrugUse not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/counseleedruguses",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch CounseleeDrugUse",     
     *      nickname="CounseleeDrugUseReadAll",
     *      type="CounseleeDrugUse"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/counseleedruguses/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays CounseleeDrugUse that meet the property=value search criteria",     
     *      nickname="CounseleeDrugUseReadAllWithFilter",
     *      type="CounseleeDrugUse",
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
     *      @SWG\ResponseMessage(code=404, message="CounseleeDrugUse not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/counseleedruguses",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a CounseleeDrugUse. See CounseleeDrugUse model for details.",     
     *      nickname="CounseleeDrugUseCreate",
     *      type="CounseleeDrugUse",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/counseleedruguses/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a CounseleeDrugUse. See the CounseleeDrugUse model for details.",     
     *      nickname="CounseleeDrugUseUpdate",
     *      type="CounseleeDrugUse",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeDrugUse to update",
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
     *      path="/counseleedruguses/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a CounseleeDrugUse",     
     *      nickname="CounseleeDrugUseDelete",
     *      type="CounseleeDrugUse",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeDrugUse to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounseleeDrugUse not found")
     *      )
     *      )
     */
 
}
