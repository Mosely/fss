<?php
namespace FSS\Controllers;

use FSS\Models\CounseleeChild;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use Swagger\Annotations as SWG;
use \Exception;

/**
 * The controller for counselee_child-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/counseleechildren",
 *     description="CounseleeChild operations",
 *     produces="['application/json']"
 * )
 */
class CounseleeChildController implements ControllerInterface
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
                "Enabling query log for the CounseleeChild Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     *
     * @SWG\Api(
     *     path="/counseleechildren/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays a counselee child",
     *         type="CounseleeChild",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of counselee child to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="counselee child not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        // $this->logger->info("Reading CounseleeChild with id of $id");
        $this->logger->debug("Reading CounseleeChild with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     *
     * @SWG\Api(
     *     path="/counseleechildren",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch counselee children",
     *         type="CounseleeChild"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = CounseleeChild::with(
            [
                'Counselee',
                'CounseleeChildBioParent',
                'CounseleeChildGuardian',
                'CounseleeChildSibling',
                'School'
            ]
            )->limit(200)->get();
        $this->logger->debug("All CounseleeChild query: ",
            $this->db::getQueryLog());
        // $records = CounseleeChild::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All CounseleeChild returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     *
     * @SWG\Api(
     *     path="/counseleechildren/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays counselee children that meet the property=value search criteria",
     *         type="CounseleeChild",
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
            CounseleeChild::validateColumn($filter, $this->logger,
                $this->cache, $this->db);
            $records = CounseleeChild::with(
            [
                'Counselee',
                'CounseleeChildBioParent',
                'CounseleeChildGuardian',
                'CounseleeChildSibling',
                'School'
            ]
            )->where($filter, 'like', '%' . $value . '%')->limit(200)->get();
            $this->logger->debug("CounseleeChild filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No CounseleeChild found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered CounseleeChild by $filter",
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
     *     path="/counseleechildren",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates a counselee child.  See CounseleeChild model for details.",
     *         type="CounseleeChild",
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
                CounseleeChild::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
            }
            $recordId = CounseleeChild::insertGetId($recordData);
            $this->logger->debug("Counselee_child create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "CounseleeChild $recordId has been created."
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
     *     path="/counseleechildren/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates a counselee child.  See the CounseleeChild model for details.",
     *         type="CounseleeChild",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of counselee child to update",
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
                CounseleeChild::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = CounseleeChild::update($updateData);
            $this->logger->debug("CounseleeChild update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated CounseleeChild $recordId"
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
     *     path="/counseleechildren/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes a counselee child",
     *         type="CounseleeChild",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of counselee child to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="counselee child not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = CounseleeChild::findOrFail($id);
            $record->delete();
            $this->logger->debug("CounseleeChild delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted CounseleeChild $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "CounseleeChild not found"
                ], 404);
        }
    }
}
