<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for
 * counselee_counseling_topic-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/counseleecounselingtopics",
 *         description="CounseleeCounselingTopic operations",
 *         produces="['application/json']"
 *         )
 */
class CounseleeCounselingTopicController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "CounseleeCounselingTopic";
    
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
     *      path="/counseleecounselingtopics/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a CounseleeCounselingTopic",
     *      type="CounseleeCounselingTopic",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeCounselingTopic to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounseleeCounselingTopic not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/counseleecounselingtopics",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch CounseleeCounselingTopic",
     *      type="CounseleeCounselingTopic"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/counseleecounselingtopics/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays CounseleeCounselingTopic that meet the property=value search criteria",
     *      type="CounseleeCounselingTopic",
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
     *      @SWG\ResponseMessage(code=404, message="CounseleeCounselingTopic not found")
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/counseleecounselingtopics",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a CounseleeCounselingTopic. See CounseleeCounselingTopic model for details.",
     *      type="CounseleeCounselingTopic",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/counseleecounselingtopics/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a CounseleeCounselingTopic. See the CounseleeCounselingTopic model for details.",
     *      type="CounseleeCounselingTopic",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeCounselingTopic to update",
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
     *      path="/counseleecounselingtopics/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a CounseleeCounselingTopic",
     *      type="CounseleeCounselingTopic",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeCounselingTopic to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounseleeCounselingTopic not found")
     *      )
     *      )
     */
 
}
