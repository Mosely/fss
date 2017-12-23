<?php
namespace FSS\Controllers;

use FSS\Models\CounseleeChildBioParent;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use Swagger\Annotations as SWG;
use \Exception;

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
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/counseleechildbioparents",
 *     description="Counselee Child Bio Parent operations",
 *     produces="['application/json']"
 * )
 */
class CounseleeChildBioParentController implements ControllerInterface
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
                "Enabling query log for the CounseleeChildBioParent Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     *
     * @SWG\Api(
     *     path="/counseleechildbioparents/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays a counselee child bio parent record",
     *         type="CounseleeChildBioParent",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of counselee child bio parent record to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="counselee child bio parent not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->logger->debug("Reading CounseleeChildBioParent with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     *
     * @SWG\Api(
     *     path="/counseleechildbioparents",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch counselee child bio parents",
     *         type="CounseleeChildBioParent"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = CounseleeChildBioParent::with(
            [
                'CounseleeChild'
            ]
            )->limit(200)->get();
        $this->logger->debug("All CounseleeChildBioParent query: ",
            $this->db::getQueryLog());
        // $records = Counselee_child_bio_parent::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All CounseleeChildBioParent returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     *
     * @SWG\Api(
     *     path="/counseleechildbioparents/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays counselee child bio parents that meet the property=value search criteria",
     *         type="CounseleeChildBioParent",
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
     *         @SWG\ResponseMessage(code=404, message="counselee child bio parent not found")
     *     )
     * )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            CounseleeChildBioParent::validateColumn('CounseleeChildBioParent',
                $filter, $this->container);
            $records = CounseleeChildBioParent::with(
            [
                'CounseleeChild'
            ]
            )->where($filter, $value)->limit(200)->get();
            $this->logger->debug("CounseleeChildBioParent filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No CounseleeChildBioParent found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered CounseleeChildBioParent by $filter",
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
     *     path="/counseleechildbioparents",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates a counselee child bio parent record.  See CounseleeChildBioParent model for details.",
     *         type="CounseleeChildBioParent",
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
                CounseleeChildBioParent::validateColumn(
                    'CounseleeChildBioParent', $key, $this->logger, $this->cache,
                    $this->db);
            }
            $recordId = CounseleeChildBioParent::insertGetId($recordData);
            $this->logger->debug("CounseleeChildBioParent create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "CounseleeChildBioParent $recordId has been created."
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
     *     path="/counseleechildbioparents/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates a counselee child bio parent record.  See the CounseleeChldBioParent model for details.",
     *         type="CounseleeChildBioParent",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of counselee child bio parent to update",
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
                CounseleeChildBioParent::validateColumn(
                    'CounseleeChildBioParent', $key, $this->logger, $this->cache,
                    $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = CounseleeChildBioParent::update($updateData);
            $this->logger->debug("CounseleeChildBioParent update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated CounseleeChildBioParent $recordId"
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
     *     path="/counseleechildbioparents/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes a counselee child bio parent record",
     *         type="CounseleeChildBioParent",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of counselee child bio parent to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="counselee child bio parent not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = CounseleeChildBioParent::findOrFail($id);
            $record->delete();
            $this->logger->debug("Counselee_child_bio_parent delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted CounseleeChildBioParent $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "CounseleeChildBioParent not found"
                ], 404);
        }
    }
}
