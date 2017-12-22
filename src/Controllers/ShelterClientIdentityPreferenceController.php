<?php
namespace FSS\Controllers;

use FSS\Models\ShelterClientIdentityPreference;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use \Exception;
use Swagger\Annotations as SWG;

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
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/shelterclientidentitypreference",
 *     description="ShelterClientIdentityPreference operations",
 *     produces="['application/json']"
 * )
 */
class ShelterClientIdentityPreferenceController implements ControllerInterface
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
                "Enabling query log for the ShelterClientIdentityPreference Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     *
     * @SWG\Api(
     *     path="/shelterclientidentitypreference/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays a ShelterClientIdentityPreference",
     *         type="ShelterClientIdentityPreference",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of ShelterClientIdentityPreference to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="ShelterClientIdentityPreference not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->logger->debug(
            "Reading ShelterClientIdentityPreference with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     *
     * @SWG\Api(
     *     path="/shelterclientidentitypreference",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch ShelterClientIdentityPreference",
     *         type="ShelterClientIdentityPreference"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = ShelterClientIdentityPreference::with(
            [
                'ShelterClient',
                'IdentityPreference'
            ]
            )->limit(200)->get();
        $this->logger->debug("All ShelterClientIdentityPreference query: ",
            $this->db::getQueryLog());
        // $records = ShelterClientIdentityPreference::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All ShelterClientIdentityPreference returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     *
     * @SWG\Api(
     *     path="/shelterclientidentitypreference/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays ShelterClientIdentityPreference that meet the property=value search criteria",
     *         type="ShelterClientIdentityPreference",
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
     *         @SWG\ResponseMessage(code=404, message="ShelterClientIdentityPreference not found")
     *     )
     * )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            ShelterClientIdentityPreference::validateColumn(
                'ShelterClientIdentityPreference', $filter, $this->logger,
                $this->cache, $this->db);
            $records = ShelterClientIdentityPreference::with(
            [
                'ShelterClient',
                'IdentityPreference'
            ]
            )->where($filter, $value)->limit(200)->get();
            $this->logger->debug(
                "ShelterClientIdentityPreference filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No ShelterClientIdentityPreference found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered ShelterClientIdentityPreference by $filter",
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
     *     path="/shelterclientidentitypreference",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates a ShelterClientIdentityPreference.  See ShelterClientIdentityPreference model for details.",
     *         type="ShelterClientIdentityPreference",
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
                ShelterClientIdentityPreference::validateColumn(
                    'ShelterClientIdentityPreference', $key, $this->logger,
                    $this->cache, $this->db);
            }
            $recordId = ShelterClientIdentityPreference::insertGetId(
                $recordData);
            $this->logger->debug(
                "ShelterClientIdentityPreference create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "ShelterClientIdentityPreference $recordId has been created."
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
     *     path="/shelterclientidentitypreference/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates a ShelterClientIdentityPreference.  See the ShelterClientIdentityPreference model for details.",
     *         type="ShelterClientIdentityPreference",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of ShelterClientIdentityPreference to update",
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
                ShelterClientIdentityPreference::validateColumn(
                    'ShelterClientIdentityPreference', $key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = ShelterClientIdentityPreference::update($updateData);
            $this->logger->debug(
                "ShelterClientIdentityPreference update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated ShelterClientIdentityPreference $recordId"
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
     *     path="/shelterclientidentitypreference/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes a ShelterClientIdentityPreference",
     *         type="ShelterClientIdentityPreference",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of ShelterClientIdentityPreference to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="ShelterClientIdentityPreference not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = ShelterClientIdentityPreference::findOrFail($id);
            $record->delete();
            $this->logger->debug(
                "ShelterClientIdentityPreference delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted ShelterClientIdentityPreference $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "ShelterClientIdentityPreference not found"
                ], 404);
        }
    }
}
