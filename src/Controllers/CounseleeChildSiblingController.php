<?php
namespace FSS\Controllers;

use FSS\Models\CounseleeChildSibling;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use Swagger\Annotations as SWG;
use \Exception;

/**
 * The controller for
 * counselee_child_sibling-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/counseleechildsibling",
 *     description="CounseleeChildSibling operations",
 *     produces="['application/json']"
 * )
 */
class CounseleeChildSiblingController implements ControllerInterface
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
                "Enabling query log for the CounseleeChildSiblingController.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     * @SWG\Api(
     *     path="/counseleechildsibling/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays a CounseleeChildSibling",
     *         type="CounseleeChildSibling",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of CounseleeChildSibling to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="CounseleeChildSibling not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->logger->debug("Reading CounseleeChildSibling with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     *
     * @SWG\Api(
     *     path="/counseleechildsibling",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch CounseleeChildSibling",
     *         type="CounseleeChildSibling"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = CounseleeChildSibling::with(
            [
                'CounseleeChild',
                'Gender'
            ]
            )->limit(200)->get();
        $this->logger->debug("All CounseleeChildSibling query: ",
            $this->db::getQueryLog());
        // $records = CounseleeChildSibling::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All CounseleeChildSibling returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     *
     * @SWG\Api(
     *     path="/counseleechildsibling/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays CounseleeChildSibling that meet the property=value search criteria",
     *         type="CounseleeChildSibling",
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
     *         @SWG\ResponseMessage(code=404, message="CounseleeChildSibling not found")
     *     )
     * )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            CounseleeChildSibling::validateColumn('CounseleeChildSibling',
                $filter, $this->container);
            $records = CounseleeChildSibling::with(
            [
                'CounseleeChild',
                'Gender'
            ]
            )->where($filter, $value)->limit(200)->get();
            $this->logger->debug("CounseleeChildSibling filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No CounseleeChildSibling found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered CounseleeChildSibling by $filter",
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
     *     path="/counseleechildsibling",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates a CounseleeChildSibling.  See CounseleeChildSibling model for details.",
     *         type="CounseleeChildSibling",
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
                CounseleeChildSibling::validateColumn('CounseleeChildSibling',
                    $key, $this->container);
            }
            $recordId = CounseleeChildSibling::insertGetId($recordData);
            $this->logger->debug("CounseleeChildSibling create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "CounseleeChildSibling $recordId has been created."
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
     *     path="/counseleechildsibling/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates a CounseleeChildSibling.  See the CounseleeChildSibling model for details.",
     *         type="CounseleeChildSibling",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of CounseleeChildSibling to update",
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
                CounseleeChildSibling::validateColumn('CounseleeChildSibling',
                    $key, $this->container);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = CounseleeChildSibling::update($updateData);
            $this->logger->debug("CounseleeChildSibling update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated CounseleeChildSibling $recordId"
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
     *     path="/counseleechildsibling/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes a CounseleeChildSibling",
     *         type="CounseleeChildSibling",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of CounseleeChildSibling to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="CounseleeChildSibling not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = CounseleeChildSibling::findOrFail($id);
            $record->delete();
            $this->logger->debug("CounseleeChildSibling delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted CounseleeChildSibling $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "CounseleeChildSibling not found"
                ], 404);
        }
    }
}
