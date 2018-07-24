<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for ClientEthnicity-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/clientethnicities",
 *         description="ClientEthnicity operations",
 *         produces="['application/json']"
 *         )
 */
class ClientEthnicityController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "ClientEthnicity";
    
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
     *      path="/clientethnicities/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a client ethnicity",     
     *      nickname="ClientEthnicityRead",
     *      type="ClientEthnicity",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of client ethnicity to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="client ethnicity not found")
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/clientethnicities",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch client ethnicities",     
     *      nickname="ClientEthnicityReadAll",
     *      type="ClientEthnicity"
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/clientethnicities/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays client ethnicity that meet the property=value search criteria",     
     *      nickname="ClientEthnicityReadAllWithFilter",
     *      type="ClientEthnicity",
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
     *      @SWG\ResponseMessage(code=404, message="client ethnicity not found")
     *      )
     *      )
     */
  

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/clientethnicities",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a client ethnicity record. See ClientEthnicity model for details.",     
     *      nickname="ClientEthnicityCreate",
     *      type="ClientEthnicity",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/clientethnicities/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a client ethnicity record. See the ClientEthnicity model for details.",     
     *      nickname="ClientEthnicityUpdate",
     *      type="ClientEthnicity",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of client ethnicity to update",
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
     *      path="/clientethnicities/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a client ethnicity",     
     *      nickname="ClientEthnicityDelete",
     *      type="ClientEthnicity",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of client ethnicity to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="client ethnicity not found")
     *      )
     *      )
     */
 
}
