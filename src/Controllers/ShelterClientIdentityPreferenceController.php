<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for
 * shelter_client_identity_preference-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/shelterclientidentitypreferences",
 *         description="ShelterClientIdentityPreference operations",
 *         produces="['application/json']"
 *         )
 */
class ShelterClientIdentityPreferenceController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "ShelterClientIdentityPreference";
    
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
     *      path="/shelterclientidentitypreferences/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a ShelterClientIdentityPreference",     
     *      nickname="ShelterClientIdentityPreferenceRead",
     *      type="ShelterClientIdentityPreference",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientIdentityPreference to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="ShelterClientIdentityPreference not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/shelterclientidentitypreferences",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch ShelterClientIdentityPreference",     
     *      nickname="ShelterClientIdentityPreferenceReadAll",
     *      type="ShelterClientIdentityPreference"
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/shelterclientidentitypreferences/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays ShelterClientIdentityPreference that meet the property=value search criteria",     
     *      nickname="ShelterClientIdentityPreferenceReadAllWithFilter",
     *      type="ShelterClientIdentityPreference",
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
     *      @SWG\ResponseMessage(code=404, message="ShelterClientIdentityPreference not found")
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/shelterclientidentitypreferences",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a ShelterClientIdentityPreference. See ShelterClientIdentityPreference model for details.",     
     *      nickname="ShelterClientIdentityPreferenceCreate",
     *      type="ShelterClientIdentityPreference",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/shelterclientidentitypreferences/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a ShelterClientIdentityPreference. See the ShelterClientIdentityPreference model for details.",     
     *      nickname="ShelterClientIdentityPreferenceUpdate",
     *      type="ShelterClientIdentityPreference",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientIdentityPreference to update",
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
     *      path="/shelterclientidentitypreferences/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a ShelterClientIdentityPreference",     
     *      nickname="ShelterClientIdentityPreferenceDelete",
     *      type="ShelterClientIdentityPreference",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientIdentityPreference to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="ShelterClientIdentityPreference not found")
     *      )
     *      )
     */

}
