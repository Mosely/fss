<?php
namespace FSS\Controllers;

use FSS\Models\MilitaryDischargeType;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use \Exception;

/**
 * The controller for
 * military_discharge_type-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/militarydischargetypes",
 *         description="MilitaryDischargeType operations",
 *         produces="['application/json']"
 *         )
 */
class MilitaryDischargeTypeController extends AbstractController
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
                "Enabling query log for the MilitaryDischargeType Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read() 
     * @SWG\Api(
     *      path="/militarydischargetypes/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a MilitaryDischargeType",
     *      type="MilitaryDischargeType",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of MilitaryDischargeType to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="MilitaryDischargeType not found")
     *      )
     *      )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $params = ['id', $id];
        $request = $request->withAttribute('params', 
            implode('/', $params));
        $this->logger->debug("Reading MilitaryDischargeType with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() 
     * @SWG\Api(
     *      path="/militarydischargetypes",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch MilitaryDischargeType",
     *      type="MilitaryDischargeType"
     *      )
     *      )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = MilitaryDischargeType::limit(200)->get();
        $this->logger->debug("All MilitaryDischargeType query: ",
            $this->db::getQueryLog());
        // $records = Military_discharge_type::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All MilitaryDischargeType returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() 
     * @SWG\Api(
     *      path="/militarydischargetypes/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays MilitaryDischargeType that meet the property=value search criteria",
     *      type="MilitaryDischargeType",
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
     *      @SWG\ResponseMessage(code=404, message="MilitaryDischargeType not found")
     *      )
     *      )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        //$filter = $args['filter'];
        //$value = $args['value'];
        
        $params = explode('/', $request->getAttribute('params'));
        $filters = [];
        $values  = [];
        
        try {
            $this->getFilters($params, $filters, $values);
            
            foreach($filters as $filter) {
            MilitaryDischargeType::validateColumn($filter, $this->logger,
                $this->cache, $this->db);
            }
            $records = MilitaryDischargeType::whereRaw(
                    'LOWER(`' . $filters[0] . '`) like ?', 
                    ['%' . strtolower($values[0]) . '%']);
            for($i = 1; $i < count($filters); $i++) {
                $records = $records->whereRaw(
                    'LOWER(`' . $filters[$i] . '`) like ?', 
                    ['%' . strtolower($values[$i]) . '%']);
            }
            $records = $records->limit(200)->get();
            
            $this->logger->debug("MilitaryDischargeType filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No MilitaryDischargeType found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered MilitaryDischargeType by $filter",
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
     *      path="/militarydischargetypes",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a MilitaryDischargeType. See MilitaryDischargeType model for details.",
     *      type="MilitaryDischargeType",
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
                MilitaryDischargeType::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $this->logger->debug("POST values: ",
                    [$key . " => " . $val]);
            }
            $recordData['updated_by'] = $this->jwtToken->sub;
            $recordId = MilitaryDischargeType::insertGetId($recordData);
            $this->logger->debug("MilitaryDischargeType create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "MilitaryDischargeType $recordId has been created.",
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
     *      path="/militarydischargetypes/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a MilitaryDischargeType. See the MilitaryDischargeType model for details.",
     *      type="MilitaryDischargeType",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of MilitaryDischargeType to update",
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
                MilitaryDischargeType::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $updateData['updated_by'] = $this->jwtToken->sub;
            $recordId = MilitaryDischargeType::update($updateData);
            $this->logger->debug("MilitaryDischargeType update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated MilitaryDischargeType $recordId"
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
     *      path="/militarydischargetypes/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a MilitaryDischargeType",
     *      type="MilitaryDischargeType",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of MilitaryDischargeType to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="MilitaryDischargeType not found")
     *      )
     *      )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = MilitaryDischargeType::findOrFail($id);
            $record->delete();
            $this->logger->debug("MilitaryDischargeType delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted MilitaryDischargeType $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "MilitaryDischargeType not found"
                ], 404);
        }
    }
}
