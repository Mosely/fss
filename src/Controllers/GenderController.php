<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for gender-related actions
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/genders",
 *         description="Gender operations",
 *         produces="['application/json']"
 *         )
 */
class GenderController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "Gender";
    
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
     *      path="/genders/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a Gender",
     *      type="Gender",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Gender to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="Gender not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/genders",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch Gender",
     *      type="Gender"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/genders/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays Gender that meet the property=value search criteria",
     *      type="Gender",
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
     *      @SWG\ResponseMessage(code=404, message="Gender not found")
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/genders",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a Gender. See Gender model for details.",
     *      type="Gender",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/genders/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a Gender. See the Gender model for details.",
     *      type="Gender",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Gender to update",
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
     *      path="/genders/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a Gender",
     *      type="Gender",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of Gender to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="Gender not found")
     *      )
     *      )
     */
 
}
