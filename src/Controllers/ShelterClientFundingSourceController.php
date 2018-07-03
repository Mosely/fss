<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for
 * shelter_client_funding_source-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/shelterclientfundingsources",
 *         description="ShelterClientFundingSource operations",
 *         produces="['application/json']"
 *         )
 */
class ShelterClientFundingSourceController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "ShelterClientFundingSource";
    
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
     *      path="/shelterclientfundingsources/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a ShelterClientFundingSource",
     *      type="ShelterClientFundingSource",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientFundingSource to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="ShelterClientFundingSource not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/shelterclientfundingsources",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch ShelterClientFundingSource",
     *      type="ShelterClientFundingSource"
     *      )
     *      )
     */


    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/shelterclientfundingsources/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays ShelterClientFundingSource that meet the property=value search criteria",
     *      type="ShelterClientFundingSource",
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
     *      @SWG\ResponseMessage(code=404, message="ShelterClientFundingSource not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/shelterclientfundingsources",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a ShelterClientFundingSource. See ShelterClientFundingSource model for details.",
     *      type="ShelterClientFundingSource",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/shelterclientfundingsources/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a ShelterClientFundingSource. See the ShelterClientFundingSource model for details.",
     *      type="ShelterClientFundingSource",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientFundingSource to update",
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
     *      path="/shelterclientfundingsources/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a ShelterClientFundingSource",
     *      type="ShelterClientFundingSource",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientFundingSource to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="ShelterClientFundingSource not found")
     *      )
     *      )
     */

}