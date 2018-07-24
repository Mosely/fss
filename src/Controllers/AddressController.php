<?php
namespace FSS\Controllers;

use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use League\OAuth2\Server\AuthorizationServer;

/**
 * The controller for address-related actions.
 *
 * Implements the ControllerInterface.
 *
 * @author Dewayne
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/addresses",
 *         description="Address operations",
 *         produces="['application/json']"
 *         )
 */
class AddressController extends AbstractController
{

    /**
     * var model
     */
    protected $model = "Address";
    
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
     * @see \FSS\Controllers\AbstractController::read() @SWG\Api(
     *      path="/addresses/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays an address",
     *      type="Address",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of address to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="address not found")
     *      )
     *      )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
            return parent::read($request, $response, $args);
    }
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\AbstractController::readAll() @SWG\Api(
     *      path="/addresses",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch addresses",
     *      type="Address"
     *      )
     *      )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
            return parent::readAll($request, $response, $args);
    }
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\AbstractController::readAllWithFilter() @SWG\Api(
     *      path="/addresses/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays addresses that meet the property=value search criteria",
     *      type="Address",
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
     *      @SWG\ResponseMessage(code=404, message="address not found")
     *      )
     *      )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
            return parent::readAllWithFilter($request, $response, $args);
    }
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\AbstractController::create() @SWG\Api(
     *      path="/addresses",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates an address. See Address model for details.",
     *      type="Address",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
    public function create(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
            return parent::create($request, $response, $args);
    }
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\AbstractController::update() @SWG\Api(
     *      path="/addresses/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates an address. See the Address model for details.",
     *      type="Address",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of address to update",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
    public function update(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
            return parent::update($request, $response, $args);
    }
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\AbstractController::delete() @SWG\Api(
     *      path="/addresses/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes an address",
     *      type="Address",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of address to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="address not found")
     *      )
     *      )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
            return parent::delete($request, $response, $args);
    }
}
