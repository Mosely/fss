<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for
 * counselee_child_bio_parent-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/counseleechildbioparents",
 *         description="Counselee Child Bio Parent operations",
 *         produces="['application/json']"
 *         )
 */
class CounseleeChildBioParentController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "CounseleeChildBioParent";
    
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
     *      path="/counseleechildbioparents/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a counselee child bio parent record",
     *      type="CounseleeChildBioParent",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of counselee child bio parent record to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="counselee child bio parent not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/counseleechildbioparents",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch counselee child bio parents",
     *      type="CounseleeChildBioParent"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/counseleechildbioparents/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays counselee child bio parents that meet the property=value search criteria",
     *      type="CounseleeChildBioParent",
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
     *      @SWG\ResponseMessage(code=404, message="counselee child bio parent not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/counseleechildbioparents",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a counselee child bio parent record. See CounseleeChildBioParent model for details.",
     *      type="CounseleeChildBioParent",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
  
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/counseleechildbioparents/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a counselee child bio parent record. See the CounseleeChldBioParent model for details.",
     *      type="CounseleeChildBioParent",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of counselee child bio parent to update",
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
     *      path="/counseleechildbioparents/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a counselee child bio parent record",
     *      type="CounseleeChildBioParent",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of counselee child bio parent to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="counselee child bio parent not found")
     *      )
     *      )
     */
 
}
