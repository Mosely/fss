<?php
namespace FSS\Controllers;

use FSS\Models\Client;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use Swagger\Annotations as SWG;
use \Exception;

/**
 * The controller for client-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/clients",
 *     description="Client operations",
 *     produces="['application/json']"
 * )   
 */
class ClientController implements ControllerInterface
{

    // The dependencies.
    private $logger;

    private $db;

    private $cache;

    private $debug;
    
    private $jwtToken;

    /**
     * The constructor that sets The dependencies and
     * enable query logging if debug mode is true in settings.php
     *
     * @param Logger $logger
     * @param Manager $db
     * @param Cache $cache
     * @param bool $debug
     * @param object $jwtToken
     */
    public function __construct(Logger $logger, Manager $db, Cache $cache,
        bool $debug, $jwtToken)
    {
        $this->logger = $logger;
        $this->db = $db;
        $this->cache = $cache;
        $this->debug = $debug;
        $this->jwtToken = $jwtToken;
        if ($this->debug) {
            $this->logger->debug(
                "Enabling query log for the client Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     * 
     * @SWG\Api(
     *     path="/clients/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays a client",
     *         type="Client",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of client to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="client not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->logger->debug("Reading client with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     * 
     * @SWG\Api(
     *     path="/clients",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch clients",
     *         type="Client"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // $records = Client::all();
        $records = Client::with(
            [
                'Person',
                'ClientEthnicity',
                'ClientLanguage'
            ]
        )->limit(200)->get();
        $this->logger->debug("All clients query: ", $this->db::getQueryLog());
        // $records = Client::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All clients returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     * 
     * @SWG\Api(
     *     path="/clients/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays clients that meet the property=value search criteria",
     *         type="Client",
     *         @SWG\Parameter(
     *             name="filter",
     *             description="property to search for in the related model.",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="string"
     *         ),
     *         @SWG\Parameter(
     *             name="value",
     *             description="value to search for, given the property.",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="object"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="client not found")
     *     )
     * )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            Client::validateColumn($filter, $this->logger,
                $this->cache, $this->db);
            $records = Client::with(
                [
                    'Person',
                    'ClientEthnicity',
                    'ClientLanguage'
                ]
            )->where($filter, 'like', '%' . $value . '%')->limit(200)->get();
            $this->logger->debug("Client filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No Client found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered Clients by $filter",
                    "data" => $records
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Error occured: " . $e->getMessage()
                ], 400);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create()
     * 
     * @SWG\Api(
     *     path="/clients",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates a client.  See Client model for details.",
     *         type="Client",
     *         @SWG\ResponseMessage(code=400, message="Error occurred")
     *     )
     * )
     */
    public function create(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // Make sure the frontend only puts the name attribute
        // on form elements that actually contain data
        // for the record.
        $recordData = $request->getParsedBody();
        try {
            foreach ($recordData as $key => $val) {
                Client::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
            }
            $recordData['updated_by'] = $this->jwtToken->sub;
            $recordId = Client::insertGetId($recordData);
            $this->logger->debug("Client create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Client $recordId has been created.",
                    "id"      => $recordId
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Error occured: " . $e->getMessage()
                ], 400);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update()
     * 
     * @SWG\Api(
     *     path="/clients/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates a client.  See the Client model for details.",
     *         type="Client",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of client to update",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=400, message="Error occurred")
     *     )
     * )
     */
    public function update(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // $id = $args['id'];
        $recordData = $request->getParsedBody();
        try {
            $updateData = [];
            foreach ($recordData as $key => $val) {
                Client::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $updateData['updated_by'] = $this->jwtToken->sub;
            $recordId = Client::update($updateData);
            $this->logger->debug("Client update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated Client $recordId"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Error occured: " . $e->getMessage()
                ], 400);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::delete()
     * 
     * @SWG\Api(
     *     path="/clients/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes a client",
     *         type="Client",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of client to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="client not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = Client::findOrFail($id);
            $record->delete();
            $this->logger->debug("Client delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted Client $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Client not found"
                ], 404);
        }
    }
}
