<?php
namespace FSS\Controllers;

use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;

/**
 * The controller for client_language-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/clientlanguages",
 *         description="Client Language operations",
 *         produces="['application/json']"
 *         )
 */
class ClientLanguageController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "ClientLanguage";
    
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
     *      path="/clientlanguages/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a client language record",
     *      type="ClientLanguage",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of client language record to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="client language not found")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/clientlanguages",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch client languages",
     *      type="ClientLanguage"
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/clientlanguages/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays client languages that meet the property=value search criteria",
     *      type="ClientLanguage",
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
     *      @SWG\ResponseMessage(code=404, message="client language not found")
     *      )
     *      )
     */
 

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/clientlanguages",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a client language. See ClientLanguage model for details.",
     *      type="ClientLanguage",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
 
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/clientlanguages/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a client language record. See the ClientLanguage model for details.",
     *      type="ClientLanguage",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of client language record to update",
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
     *      path="/clientlanguages/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a client language record",
     *      type="ClientLanguage",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of client language to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="client language not found")
     *      )
     *      )
     */
 
}
