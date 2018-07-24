<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for
 * counselee_child_sibling-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/counseleechildsiblings",
 *         description="CounseleeChildSibling operations",
 *         produces="['application/json']"
 *         )
 */
class CounseleeChildSiblingController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "CounseleeChildSibling";
    
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
     *      path="/counseleechildsiblings/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a CounseleeChildSibling",     
     *      nickname="CounseleeChildSiblingRead",
     *      type="CounseleeChildSibling",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeChildSibling to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounseleeChildSibling not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/counseleechildsiblings",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch CounseleeChildSibling",     
     *      nickname="CounseleeChildSiblingReadAll",
     *      type="CounseleeChildSibling"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/counseleechildsiblings/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays CounseleeChildSibling that meet the property=value search criteria",     
     *      nickname="CounseleeChildSiblingReadAllWithFilter",
     *      type="CounseleeChildSibling",
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
     *      @SWG\ResponseMessage(code=404, message="CounseleeChildSibling not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/counseleechildsiblings",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a CounseleeChildSibling. See CounseleeChildSibling model for details.",     
     *      nickname="CounseleeChildSiblingCreate",
     *      type="CounseleeChildSibling",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/counseleechildsiblings/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a CounseleeChildSibling. See the CounseleeChildSibling model for details.",     
     *      nickname="CounseleeChildSiblingUpdate",
     *      type="CounseleeChildSibling",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeChildSibling to update",
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
     *      path="/counseleechildsiblings/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a CounseleeChildSibling",     
     *      nickname="CounseleeChildSiblingDelete",
     *      type="CounseleeChildSibling",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeChildSibling to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounseleeChildSibling not found")
     *      )
     *      )
     */
 
}
