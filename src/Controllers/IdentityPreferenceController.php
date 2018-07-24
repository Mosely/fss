<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for
 * identity_preference-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/identitypreferences",
 *         description="IdentityPreference operations",
 *         produces="['application/json']"
 *         )
 */
class IdentityPreferenceController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "IdentityPreference";
    
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
     *      path="/identitypreferences/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a IdentityPreference",     
     *      nickname="IdentityPreferenceRead",
     *      type="IdentityPreference",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of IdentityPreference to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="IdentityPreference not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/identitypreferences",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch IdentityPreference",     
     *      nickname="IdentityPreferenceReadAll",
     *      type="IdentityPreference"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/identitypreferences/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays IdentityPreference that meet the property=value search criteria",     
     *      nickname="IdentityPreferenceReadAllWithFilter",
     *      type="IdentityPreference",
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
     *      @SWG\ResponseMessage(code=404, message="IdentityPreference not found")
     *      )
     *      )
     */
  
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/identitypreferences",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a IdentityPreference. See IdentityPreference model for details.",     
     *      nickname="IdentityPreferenceCreate",
     *      type="IdentityPreference",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/identitypreferences/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a IdentityPreference. See the IdentityPreference model for details.",     
     *      nickname="IdentityPreferenceUpdate",
     *      type="IdentityPreference",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of IdentityPreference to update",
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
     *      path="/identitypreferences/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a IdentityPreference",     
     *      nickname="IdentityPreferenceDelete",
     *      type="IdentityPreference",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of IdentityPreference to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="IdentityPreference not found")
     *      )
     *      )
     */
 
}
