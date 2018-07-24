<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for counseling_topic-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/counselingtopics",
 *         description="CounselingTopic operations",
 *         produces="['application/json']"
 *         )
 */
class CounselingTopicController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "CounselingTopic";
    
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
     *      path="/counselingtopics/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a CounselingTopic",     
     *      nickname="CounselingTopicRead",
     *      type="CounselingTopic",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounselingTopic to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounselingTopic not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/counselingtopics",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch CounselingTopic",     
     *      nickname="CounselingTopicReadAll",
     *      type="CounselingTopic"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/counselingtopics/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays CounselingTopic that meet the property=value search criteria",     
     *      nickname="CounselingTopicReadAllWithFilter",
     *      type="CounselingTopic",
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
     *      @SWG\ResponseMessage(code=404, message="CounselingTopic not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/counselingtopics",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a CounselingTopic. See CounselingTopic model for details.",     
     *      nickname="CounselingTopicCreate",
     *      type="CounselingTopic",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/counselingtopics/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a CounselingTopic. See the CounselingTopic model for details.",     
     *      nickname="CounselingTopicUpdate",
     *      type="CounselingTopic",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounselingTopic to update",
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
     *      path="/counselingtopics/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a CounselingTopic",     
     *      nickname="CounselingTopicDelete",
     *      type="CounselingTopic",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounselingTopic to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounselingTopic not found")
     *      )
     *      )
     */
 
}
