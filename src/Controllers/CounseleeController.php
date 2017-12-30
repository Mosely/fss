<?php
namespace FSS\Controllers;

use FSS\Models\Counselee;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use Swagger\Annotations as SWG;
use \Exception;

/**
 * The controller for counselee-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/counselees",
 *     description="Counselee operations",
 *     produces="['application/json']"
 * )
 */
class CounseleeController implements ControllerInterface
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
                "Enabling query log for the counselee Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     *
     * @SWG\Api(
     *     path="/counselees/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays a Counselee",
     *         type="Counselee",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of Counselee to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="Counselee not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        // $this->logger->info("Reading counselee with id of $id");
        $this->logger->debug("Reading counselee with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     *
     * @SWG\Api(
     *     path="/counselees",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch Counselee",
     *         type="Counselee"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = Counselee::with(
            [
                'CounseleeCounselingTopic',
                'CounseleeDrugUse',
                'CounseleeMedication',
                'CounseleeChild'
            ]
            )->limit(200)->get();
        $this->logger->debug("All counselee query: ", $this->db::getQueryLog());
        // $records = Counselee::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All counselee returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     *
     * @SWG\Api(
     *     path="/counselees/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays Counselee that meet the property=value search criteria",
     *         type="Counselee",
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
     *         @SWG\ResponseMessage(code=404, message="Counselee not found")
     *     )
     * )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            Counselee::validateColumn($filter, $this->logger,
                $this->cache, $this->db);
            $records = Counselee::with(
            [
                'CounseleeCounselingTopic',
                'CounseleeDrugUse',
                'CounseleeMedication',
                'CounseleeChild'
            ]
            )->where($filter, 'like', '%' . $value . '%')->limit(200)->get();
            $this->logger->debug("Counselee filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No Counselee found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered Counselee by $filter",
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
     *     path="/counselees",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates a Counselee.  See Counselee model for details.",
     *         type="Counselee",
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
                Counselee::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
            }
            $recordData['updated_by'] = $this->jwtToken->sub;
            $recordId = Counselee::insertGetId($recordData);
            $this->logger->debug("Counselee create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Counselee $recordId has been created.",
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
     *     path="/counselees/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates a Counselee.  See the Counselee model for details.",
     *         type="Counselee",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of Counselee to update",
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
                Counselee::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $updateData['updated_by'] = $this->jwtToken->sub;
            $recordId = Counselee::update($updateData);
            $this->logger->debug("Counselee update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated Counselee $recordId"
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
     *     path="/counselees/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes a Counselee",
     *         type="Counselee",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of Counselee to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="Counselee not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = Counselee::findOrFail($id);
            $record->delete();
            $this->logger->debug("Counselee delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted Counselee $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Counselee not found"
                ], 404);
        }
    }
}
