<?php
namespace FSS\Controllers;

use FSS\Models\CounseleeCounselingTopic;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use Swagger\Annotations as SWG;
use \Exception;

/**
 * The controller for
 * counselee_counseling_topic-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/counseleecounselingtopics",
 *     description="CounseleeCounselingTopic operations",
 *     produces="['application/json']"
 * )
 */
class CounseleeCounselingTopicController implements ControllerInterface
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
                "Enabling query log for the CounseleeCounselingTopic Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     *
     * @SWG\Api(
     *     path="/counseleecounselingtopics/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays a CounseleeCounselingTopic",
     *         type="CounseleeCounselingTopic",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of CounseleeCounselingTopic to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="CounseleeCounselingTopic not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->logger->debug("Reading CounseleeCounselingTopic with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     *
     * @SWG\Api(
     *     path="/counseleecounselingtopics",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch CounseleeCounselingTopic",
     *         type="CounseleeCounselingTopic"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = CounseleeCounselingTopic::with(
            [
                'Counselee',
                'CounselingTopic'
            ]
            )->limit(200)->get();
        $this->logger->debug("All CounseleeCounselingTopic query: ",
            $this->db::getQueryLog());
        // $records = CounseleeCounselingTopic::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All CounseleeCounselingTopic returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     *
     * @SWG\Api(
     *     path="/counseleecounselingtopics/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays CounseleeCounselingTopic that meet the property=value search criteria",
     *         type="CounseleeCounselingTopic",
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
     *         @SWG\ResponseMessage(code=404, message="CounseleeCounselingTopic not found")
     *     )
     * )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            CounseleeCounselingTopic::validateColumn(
                $filter, $this->container);
            $records = CounseleeCounselingTopic::with(
            [
                'Counselee',
                'CounselingTopic'
            ]
            )->where($filter, 'like', '%' . $value . '%')->limit(200)->get();
            $this->logger->debug("CounseleeCounselingTopic filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No CounseleeCounselingTopic found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered CounseleeCounselingTopic by $filter",
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
     *     path="/counseleecounselingtopics",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates a CounseleeCounselingTopic.  See CounseleeCounselingTopic model for details.",
     *         type="CounseleeCounselingTopic",
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
                CounseleeCounselingTopic::validateColumn(
                    $key, $this->logger, $this->cache,
                    $this->db);
            }
            $recordId = CounseleeCounselingTopic::insertGetId($recordData);
            $this->logger->debug("CounseleeCounselingTopic create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "CounseleeCounselingTopic $recordId has been created."
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
     *     path="/counseleecounselingtopics/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates a CounseleeCounselingTopic.  See the CounseleeCounselingTopic model for details.",
     *         type="CounseleeCounselingTopic",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of CounseleeCounselingTopic to update",
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
                CounseleeCounselingTopic::validateColumn(
                    $key, $this->logger, $this->cache,
                    $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = CounseleeCounselingTopic::update($updateData);
            $this->logger->debug("CounseleeCounselingTopic update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated CounseleeCounselingTopic $recordId"
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
     *     path="/counseleecounselingtopics/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes a CounseleeCounselingTopic",
     *         type="CounseleeCounselingTopic",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of CounseleeCounselingTopic to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="CounseleeCounselingTopic not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = CounseleeCounselingTopic::findOrFail($id);
            $record->delete();
            $this->logger->debug("CounseleeCounselingTopic delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted CounseleeCounselingTopic $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "CounseleeCounselingTopic not found"
                ], 404);
        }
    }
}
