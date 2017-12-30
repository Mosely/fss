<?php
namespace FSS\Controllers;

use FSS\Models\ClientLanguage;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use Swagger\Annotations as SWG;
use \Exception;

/**
 * The controller for client_language-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/clientlanguages",
 *     description="Client Language operations",
 *     produces="['application/json']"
 * )
 */
class ClientLanguageController implements ControllerInterface
{

    // The dependencies.
    private $logger;

    private $db;

    private $cache;

    private $debug;

    /**
     * The constructor that sets The dependencies and
     * enable query logging if debug mode is true in settings.php
     *
     * @param Logger $logger
     * @param Manager $db
     * @param Cache $cache
     * @param bool $debug
     */
    public function __construct(Logger $logger, Manager $db, Cache $cache,
        bool $debug)
    {
        $this->logger = $logger;
        $this->db = $db;
        $this->cache = $cache;
        $this->debug = $debug;
        if ($this->debug) {
            $this->logger->debug(
                "Enabling query log for the client_language Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     *
     * @SWG\Api(
     *     path="/clientlanguages/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays a client language record",
     *         type="ClientLanguage",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of client language record to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="client language not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        // $this->logger->info("Reading client_language with id of $id");
        $this->logger->debug("Reading ClientLanguage with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     * @SWG\Api(
     *     path="/clientlanguages",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch client languages",
     *         type="ClientLanguage"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = ClientLanguage::with(
            [
                'Client',
                'Language'
            ]
            )->limit(200)->get();
        $this->logger->debug("All ClientLanguage query: ",
            $this->db::getQueryLog());
        // $records = ClientLanguage::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All ClientLanguages returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     *
     * @SWG\Api(
     *     path="/clientlanguages/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays client languages that meet the property=value search criteria",
     *         type="ClientLanguage",
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
     *         @SWG\ResponseMessage(code=404, message="client language not found")
     *     )
     * )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            ClientLanguage::validateColumn('ClientLanguage', $filter,
                $this->container);
            $records = ClientLanguage::with(
            [
                'Client',
                'Language'
            ]
            )->where($filter, 'like', '%' . $value . '%')->limit(200)->get();
            $this->logger->debug("ClientLanguage filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No ClientLanguage found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered ClientLanguage by $filter",
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
     *     path="/clientlanguages",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates a client language.  See ClientLanguage model for details.",
     *         type="ClientLanguage",
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
                ClientLanguage::validateColumn('ClientLanguage', $key,
                    $this->container);
            }
            $recordId = ClientLanguage::insertGetId($recordData);
            $this->logger->debug("ClientLanguage create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "ClientLanguage $recordId has been created."
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
     *     path="/clientlanguages/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates a client language record.  See the ClientLanguage model for details.",
     *         type="ClientLanguage",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of client language record to update",
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
                ClientLanguage::validateColumn('ClientLanguage', $key,
                    $this->container);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = ClientLanguage::update($updateData);
            $this->logger->debug("ClientLanguage update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated ClientLanguage $recordId"
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
     * @SWG\Api(
     *     path="/clientlanguages/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes a client language record",
     *         type="ClientLanguage",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of client language to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="client language not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = ClientLanguage::findOrFail($id);
            $record->delete();
            $this->logger->debug("ClientLanguage delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted ClientLanguage $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "ClientLanguage not found"
                ], 404);
        }
    }
}
