<?php
namespace FSS\Controllers;

use FSS\Models\Language;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use Swagger\Annotations as SWG;
use \Exception;

/**
 * The controller for language-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 * 
 * @SWG\Resource(
 *     apiVersion="1.0",
 *     resourcePath="/language",
 *     description="Language operations",
 *     produces="['application/json']"
 * )
 */
class LanguageController implements ControllerInterface
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
                "Enabling query log for the Language Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     *
     * @SWG\Api(
     *     path="/language/{id}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays a Language",
     *         type="Language",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of Language to fetch",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="Language not found")
     *     )
     * )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        // $this->logger->info("Reading language with id of $id");
        $this->logger->debug("Reading language with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     *
     * @SWG\Api(
     *     path="/language",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Fetch Language",
     *         type="Language"
     *     )
     * )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = Language::with(
            [
                'ClientLanguage'
            ]
            )->limit(200)->get();
        $this->logger->debug("All languages query: ", $this->db::getQueryLog());
        // $records = Language::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All Languages returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     *
     * @SWG\Api(
     *     path="/language/{filter}/{value}",
     *     @SWG\Operation(
     *         method="GET",
     *         summary="Displays Language that meet the property=value search criteria",
     *         type="Language",
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
     *         @SWG\ResponseMessage(code=404, message="Language not found")
     *     )
     * )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            Language::validateColumn('language', $filter, $this->logger,
                $this->cache, $this->db);
            $records = Language::with(
            [
                'ClientLanguage'
            ]
            )->where($filter, $value)->limit(200)->get();
            $this->logger->debug("Language filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No Language found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered Languages by $filter",
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
     *     path="/language",
     *     @SWG\Operation(
     *         method="POST",
     *         summary="Creates a Language.  See Language model for details.",
     *         type="Language",
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
                Language::validateColumn('language', $key, $this->logger,
                    $this->cache, $this->db);
            }
            $recordId = Language::insertGetId($recordData);
            $this->logger->debug("Language create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Language $recordId has been created."
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
     *     path="/language/{id}",
     *     @SWG\Operation(
     *         method="PUT",
     *         summary="Updates a Language.  See the Language model for details.",
     *         type="Language",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of Language to update",
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
                Language::validateColumn('language', $key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = Language::update($updateData);
            $this->logger->debug("Language update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated Language $recordId"
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
     *     path="/language/{id}",
     *     @SWG\Operation(
     *         method="DELETE",
     *         summary="Deletes a Language",
     *         type="Language",
     *         @SWG\Parameter(
     *             name="id",
     *             description="id of Language to delete",
     *             paramType="path",
     *             required=true,
     *             allowMultiple=false,
     *             type="integer"
     *         ),
     *         @SWG\ResponseMessage(code=404, message="Language not found")
     *     )
     * )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = Language::findOrFail($id);
            $record->delete();
            $this->logger->debug("Language delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted Language $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Language not found"
                ], 404);
        }
    }
}
