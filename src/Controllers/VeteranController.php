<?php
namespace FSS\Controllers;

use FSS\Models\Veteran;
use FSS\Utilities\Cache;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use Swagger\Annotations as SWG;
use \Exception;

/**
 * The controller for Veteran-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 * 
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/veterans",
 *     description="Veteran operations",
 *     produces="['application/json']"
 * )       
*/
class VeteranController implements ControllerInterface
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
                "Enabling query log for the Veteran Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     * 
     * @SWG\Api(
     *     path="/veterans/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays a veteran",
     *         type="Veteran",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of veteran to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="veteran not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->logger->debug("Reading Veteran with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     * 
     * @SWG\Api(
     *     path="/veterans",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch veterans",
     *         type="Veteran"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = Veteran::with(
                [
                    'BranchOfService',
                    'MilitaryDischargeType',
                    'Client' => function ($q) {
                    return $q->with(
                        [
                            'Person' => function ($q) {
                                return $q->with(
                                    'Gender'
                                    );
                                }
                            ]
                        );
                    }
                ]
            )->limit(200)->get();
        $this->logger->debug("All Veteran query: ", $this->db::getQueryLog());
        // $records = Veteran::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All Veteran returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     * 
     * @SWG\Api(
     *     path="/veterans/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays veterans that meet the property=value search criteria",
     *         type="Veteran",
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
     *         @SWG\ResponseMessage(code=404, message="veteran not found")
     *     )
     * )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            Veteran::validateColumn($filter, $this->logger,
                $this->cache, $this->db);
            $records = Veteran::with(
                    [
                        'BranchOfService', 
                        'MilitaryDischargeType',
                        'Client' => function ($q) {
                            return $q->with(
                                [
                                'Person' => function ($q) {
                                    return $q->with(
                                        'Gender'
                                        );
                                    }
                                ]
                            );
                        }
                    ]
                )->where($filter, 'like', '%' . $value . '%')->limit(200)->get();
            $this->logger->debug("Veteran filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No Veteran found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered Veteran by $filter",
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
     *     path="/veterans",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates a veteran.  See Veteran model for details.",
     *         type="Veteran",
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
                Veteran::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
            }
            $recordData['updated_by'] = $this->jwtToken->sub;
            $recordId = Veteran::insertGetId($recordData);
            $this->logger->debug("Veteran create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Veteran $recordId has been created.",
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
     *     path="/veterans/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates a veteran.  See the Veteran model for details.",
     *         type="Veteran",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of veteran to update",
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
                Veteran::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $updateData['updated_by'] = $this->jwtToken->sub;
            $recordId = Veteran::update($updateData);
            $this->logger->debug("Veteran update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated Veteran $recordId"
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
     *     path="/veterans/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes a veteran",
     *         type="Veteran",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of veteran to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="veteran not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = Veteran::findOrFail($id);
            $record->delete();
            $this->logger->debug("Veteran delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted Veteran $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Veteran not found"
                ], 404);
        }
    }
}
