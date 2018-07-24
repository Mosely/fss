<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for
 * shelter_client_additional_staff-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/shelterclientadditionalstaff",
 *         description="ShelterClientAdditionalStaff operations",
 *         produces="['application/json']"
 *         )
 */
class ShelterClientAdditionalStaffController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "ShelterClientAdditionalStaff";
    
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
     *      path="/shelterclientadditionalstaff/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a ShelterClientAdditionalStaff",     
     *      nickname="ShelterClientAdditionalStaffRead",
     *      type="ShelterClientAdditionalStaff",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientAdditionalStaff to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="ShelterClientAdditionalStaff not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/shelterclientadditionalstaff",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch ShelterClientAdditionalStaff",
     *      nickname="ShelterClientAdditionalStaffReadAll",
     *      type="ShelterClientAdditionalStaff"
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/shelterclientadditionalstaff/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays ShelterClientAdditionalStaff that meet the property=value search criteria",
     *      nickname="ShelterClientAdditionalStaffReadAllWithFilter",
     *      type="ShelterClientAdditionalStaff",
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
     *      @SWG\ResponseMessage(code=404, message="ShelterClientAdditionalStaff not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/shelterclientadditionalstaff",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a ShelterClientAdditionalStaff. See ShelterClientAdditionalStaff model for details.",
     *      nickname="ShelterClientAdditionalStaffCreate",
     *      type="ShelterClientAdditionalStaff",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/shelterclientadditionalstaff/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a ShelterClientAdditionalStaff. See the ShelterClientAdditionalStaff model for details.",
     *      nickname="ShelterClientAdditionalStaffUpdate",
     *      type="ShelterClientAdditionalStaff",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientAdditionalStaff to update",
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
     *      path="/shelterclientadditionalstaff/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a ShelterClientAdditionalStaff",
     *      nickname="ShelterClientAdditionalStaffDelete",
     *      type="ShelterClientAdditionalStaff",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientAdditionalStaff to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="ShelterClientAdditionalStaff not found")
     *      )
     *      )
     */

}
