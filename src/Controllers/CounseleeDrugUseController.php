<?php
namespace FSS\Controllers;

use FSS\Models\CounseleeDrugUse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use Swagger\Annotations as SWG;
use \Exception;

/**
 * The controller for counselee_drug_use-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 * 
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/counseleedruguse",
 *     description="CounseleeDrugUse operations",
 *     produces="['application/json']"
 * )
 */
class CounseleeDrugUseController implements ControllerInterface
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
                "Enabling query log for the CounseleeDrugUse Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     *
     * @SWG\Api(
     *     path="/counseleedruguse/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays a CounseleeDrugUse",
     *         type="CounseleeDrugUse",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of CounseleeDrugUse to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="CounseleeDrugUse not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        // $this->logger->info("Reading counselee_drug_use with id of $id");
        $this->logger->debug("Reading CounseleeDrugUse with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     *
     * @SWG\Api(
     *     path="/counseleedruguse",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch CounseleeDrugUse",
     *         type="CounseleeDrugUse"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = CounseleeDrugUse::with(
            [
                'Counselee',
                'DrugUse'
            ]
            )->limit(200)->get();
        $this->logger->debug("All CounseleeDrugUse query: ",
            $this->db::getQueryLog());
        // $records = CounseleeDrugUse::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All CounseleeDrugUse returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     *
     * @SWG\Api(
     *     path="/counseleedruguse/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays CounseleeDrugUse that meet the property=value search criteria",
     *         type="CounseleeDrugUse",
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
     *         @SWG\ResponseMessage(code=404, message="CounseleeDrugUse not found")
     *     )
     * )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            CounseleeDrugUse::validateColumn('counselee_drug_use', $filter,
                $this->container);
            $records = CounseleeDrugUse::with(
            [
                'Counselee',
                'DrugUse'
            ]
            )->where($filter, $value)->limit(200)->get();
            $this->logger->debug("CounseleeDrugUse filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No CounseleeDrugUse found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered CounseleeDrugUse by $filter",
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
     *     path="/counseleedruguse",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates a CounseleeDrugUse.  See CounseleeDrugUse model for details.",
     *         type="CounseleeDrugUse",
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
                CounseleeDrugUse::validateColumn('counselee_drug_use', $key,
                    $this->container);
            }
            $recordId = CounseleeDrugUse::insertGetId($recordData);
            $this->logger->debug("CounseleeDrugUse create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "CounseleeDrugUse $recordId has been created."
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
     *     path="/counseleedruguse/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates a CounseleeDrugUse.  See the CounseleeDrugUse model for details.",
     *         type="CounseleeDrugUse",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of CounseleeDrugUse to update",
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
                CounseleeDrugUse::validateColumn('counselee_drug_use', $key,
                    $this->container);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = CounseleeDrugUse::update($updateData);
            $this->logger->debug("CounseleeDrugUse update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated CounseleeDrugUse $recordId"
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
     *     path="/counseleedruguse/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes a CounseleeDrugUse",
     *         type="CounseleeDrugUse",
     *         @SFWG\Parameter(
     *             name="id",
     *             description="id of CounseleeDrugUse to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="CounseleeDrugUse not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = CounseleeDrugUse::findOrFail($id);
            $record->delete();
            $this->logger->debug("CounseleeDrugUse delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted CounseleeDrugUse $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "CounseleeDrugUse not found"
                ], 404);
        }
    }
}
