<?php
namespace FSS\Controllers;

use FSS\Models\CounseleeChildGuardian;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use \Exception;

/**
 * The controller for
 * counselee_child_guardian-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/counseleechildguardians",
 *         description="CounseleeChildGuardian operations",
 *         produces="['application/json']"
 *         )
 */
class CounseleeChildGuardianController extends AbstractController
    implements ControllerInterface
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
                "Enabling query log for the CounseleeChildGuardian Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read() 
     * @SWG\Api(
     *      path="/counseleechildguardians/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a CounseleeChildGuardian",
     *      type="CounseleeChildGuardian",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeChildGuardian to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounseleeChildGuardian not found")
     *      )
     *      )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->logger->debug("Reading CounseleeChildGuardian with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() 
     * @SWG\Api(
     *      path="/counseleechildguardians",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch counseleechildguardian",
     *      type="CounseleeChildGuardian"
     *      )
     *      )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = CounseleeChildGuardian::with(
            [
                'CounseleeChild'
            ])->limit(200)->get();
        $this->logger->debug("All CounseleeChildGuardian query: ",
            $this->db::getQueryLog());
        // $records = CounseleeChildGuardian::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All CounseleeChildGuardian returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() 
     * @SWG\Api(
     *      path="/counseleechildguardians/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays counseleechildguardian that meet the property=value search criteria",
     *      type="CounseleeChildGuardian",
     *      @SWG\Parameter(
     *      name="filter",
     *      description="property to search for in the related model.",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="string"
     *      ),
     *      @SWG\Parameter(
     *      name="value",
     *      description="value to search for, given the property.",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="object"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounseleeChildGuardian not found")
     *      )
     *      )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            CounseleeChildGuardian::validateColumn($filter, $this->logger,
                $this->cache, $this->db);
            $records = CounseleeChildGuardian::with(
                [
                    'CounseleeChild'
                ])->where($filter, 'like', '%' . $value . '%')
                ->limit(200)
                ->get();
            $this->logger->debug("CounseleeChildGuardian filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No CounseleeChildGuardian found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered CounseleeChildGuardian by $filter",
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
     * @SWG\Api(
     *      path="/counseleechildguardians",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a CounseleeChildGuardian. See CounseleeChildGuardian model for details.",
     *      type="CounseleeChildGuardian",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
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
                CounseleeChildGuardian::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $this->logger->debug("POST values: ",
                    $key . " => " . $val);
            }
            $recordData['updated_by'] = $this->jwtToken->sub;
            $recordId = CounseleeChildGuardian::insertGetId($recordData);
            $this->logger->debug("CounseleeChildGuardian create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "CounseleeChildGuardian $recordId has been created.",
                    "id" => $recordId
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
     * @SWG\Api(
     *      path="/counseleechildguardians/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a CounseleeChildGuardian. See the CounseleeChildGuardian model for details.",
     *      type="CounseleeChildGuardian",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeChildGuardian to update",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */
    public function update(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // $id = $args['id'];
        $recordData = $request->getParsedBody();
        try {
            $updateData = [];
            foreach ($recordData as $key => $val) {
                CounseleeChildGuardian::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $updateData['updated_by'] = $this->jwtToken->sub;
            $recordId = CounseleeChildGuardian::update($updateData);
            $this->logger->debug("CounseleeChildGuardian update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated CounseleeChildGuardian $recordId"
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
     *      path="/counseleechildguardians/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a CounseleeChildGuardian",
     *      type="CounseleeChildGuardian",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeChildGuardian to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounseleeChildGuardian not found")
     *      )
     *      )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = CounseleeChildGuardian::findOrFail($id);
            $record->delete();
            $this->logger->debug("CounseleeChildGuardian delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted CounseleeChildGuardian $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "CounseleeChildGuardian not found"
                ], 404);
        }
    }
}
