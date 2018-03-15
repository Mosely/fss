<?php
namespace FSS\Controllers;

use FSS\Models\CounseleeDrugUse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
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
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/counseleedruguses",
 *         description="CounseleeDrugUse operations",
 *         produces="['application/json']"
 *         )
 */
class CounseleeDrugUseController extends AbstractController
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
                "Enabling query log for the CounseleeDrugUse Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read() 
     * @SWG\Api(
     *      path="/counseleedruguses/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a CounseleeDrugUse",
     *      type="CounseleeDrugUse",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeDrugUse to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounseleeDrugUse not found")
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
        // $this->logger->info("Reading counselee_drug_use with id of $id");
        $this->logger->debug("Reading CounseleeDrugUse with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() 
     * @SWG\Api(
     *      path="/counseleedruguses",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch CounseleeDrugUse",
     *      type="CounseleeDrugUse"
     *      )
     *      )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = CounseleeDrugUse::with(
            [
                'Counselee',
                'DrugUse'
            ])->limit(200)->get();
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
     * @SWG\Api(
     *      path="/counseleedruguses/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays CounseleeDrugUse that meet the property=value search criteria",
     *      type="CounseleeDrugUse",
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
     *      @SWG\ResponseMessage(code=404, message="CounseleeDrugUse not found")
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
            CounseleeDrugUse::validateColumn($filter, $this->logger,
                $this->cache, $this->db);
            }
            $records = CounseleeDrugUse::with(
                [
                    'Counselee',
                    'DrugUse'
                ])->whereRaw(
                    'LOWER(`' . $filters[0] . '`) like ?', 
                    ['%' . strtolower($values[0]) . '%']);
            for($i = 1; $i < count($filters); $i++) {
                $records = $records->whereRaw(
                    'LOWER(`' . $filters[$i] . '`) like ?', 
                    ['%' . strtolower($values[$i]) . '%']);
            }
            $records = $records->limit(200)->get();
            
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
     * @SWG\Api(
     *      path="/counseleedruguses",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a CounseleeDrugUse. See CounseleeDrugUse model for details.",
     *      type="CounseleeDrugUse",
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
                CounseleeDrugUse::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $this->logger->debug("POST values: ",
                    [$key . " => " . $val]);
            }
            $recordData['updated_by'] = $this->jwtToken->sub;
            $recordId = CounseleeDrugUse::insertGetId($recordData);
            $this->logger->debug("CounseleeDrugUse create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "CounseleeDrugUse $recordId has been created.",
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
     *      path="/counseleedruguses/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a CounseleeDrugUse. See the CounseleeDrugUse model for details.",
     *      type="CounseleeDrugUse",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeDrugUse to update",
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
                CounseleeDrugUse::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $updateData['updated_by'] = $this->jwtToken->sub;
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
     * @SWG\Api(
     *      path="/counseleedruguses/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a CounseleeDrugUse",
     *      type="CounseleeDrugUse",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of CounseleeDrugUse to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="CounseleeDrugUse not found")
     *      )
     *      )
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
