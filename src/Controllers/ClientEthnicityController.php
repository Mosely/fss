<?php
namespace FSS\Controllers;

use FSS\Models\ClientEthnicity;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use \Exception;
use League\OAuth2\Server\AuthorizationServer;

/**
 * The controller for ClientEthnicity-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/clientethnicities",
 *         description="ClientEthnicity operations",
 *         produces="['application/json']"
 *         )
 */
class ClientEthnicityController extends AbstractController implements 
    ControllerInterface
{

    // The dependencies.
    /**
     *
     * @var Logger
     */
    private $logger;

    /**
     *
     * @var Manager
     */
    private $db;

    /**
     *
     * @var Cache
     */
    private $cache;

    /**
     *
     * @var bool
     */
    private $debug;

    /**
     *
     * @var AuthorizationServer
     */
    private $authorizer;

    /**
     * The constructor that sets The dependencies and
     * enable query logging if debug mode is true in settings.php
     *
     * @param Logger $logger
     * @param Manager $db
     * @param Cache $cache
     * @param bool $debug
     * @param AuthorizationServer $authorizer
     */
    public function __construct(Logger $logger, Manager $db, Cache $cache,
        bool $debug, AuthorizationServer $authorizer)
    {
        $this->logger = $logger;
        $this->db = $db;
        $this->cache = $cache;
        $this->debug = $debug;
        $this->authorizer = $authorizer;
        if ($this->debug) {
            $this->logger->debug(
                "Enabling query log for the ClientEthnicity Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read() @SWG\Api(
     *      path="/clientethnicities/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a client ethnicity",
     *      type="ClientEthnicity",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of client ethnicity to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="client ethnicity not found")
     *      )
     *      )
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $params = [
            'id',
            $id
        ];
        $request = $request->withAttribute('params', implode('/', $params));
        // $this->logger->info("Reading client_ethnicity with id of $id");
        $this->logger->debug("Reading client_ethnicity with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/clientethnicities",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch client ethnicities",
     *      type="ClientEthnicity"
     *      )
     *      )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = ClientEthnicity::with(
            [
                'Person',
                'ClientEthnicity',
                'ClientLanguage'
            ])->limit(200)->get();
        $this->logger->debug("All client_ethnicity query: ",
            $this->db::getQueryLog());
        // $records = Client_ethnicity::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All ClientEthnicities returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/clientethnicities/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays client ethnicity that meet the property=value search criteria",
     *      type="ClientEthnicity",
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
     *      @SWG\ResponseMessage(code=404, message="client ethnicity not found")
     *      )
     *      )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // $filter = $args['filter'];
        // $value = $args['value'];
        $params = explode('/', $request->getAttribute('params'));
        $filters = [];
        $values = [];
        
        try {
            $this->getFilters($params, $filters, $values);
            
            foreach ($filters as $filter) {
                ClientEthnicity::validateColumn($filter, $this->logger,
                    $this->cache, $this->db);
            }
            $records = ClientEthnicity::with(
                [
                    'Person',
                    'ClientEthnicity',
                    'ClientLanguage'
                ])->whereRaw('LOWER(`' . $filters[0] . '`) like ?',
                [
                    '%' . strtolower($values[0]) . '%'
                ]);
            for ($i = 1; $i < count($filters); $i ++) {
                $records = $records->whereRaw(
                    'LOWER(`' . $filters[$i] . '`) like ?',
                    [
                        '%' . strtolower($values[$i]) . '%'
                    ]);
            }
            $records = $records->limit(200)->get();
            
            $this->logger->debug("ClientEthnicity filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No ClientEthnicity found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered ClientEthnicity by $filter",
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
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/clientethnicities",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a client ethnicity record. See ClientEthnicity model for details.",
     *      type="ClientEthnicity",
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
                ClientEthnicity::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $this->logger->debug("POST values: ", [
                    $key . " => " . $val
                ]);
            }
            $recordData['updated_by'] = $request->getAttribute('oauth_user_id');
            $recordId = ClientEthnicity::insertGetId($recordData);
            $this->logger->debug("ClientEthnicity create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "ClientEthnicity $recordId has been created.",
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
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/clientethnicities/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a client ethnicity record. See the ClientEthnicity model for details.",
     *      type="ClientEthnicity",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of client ethnicity to update",
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
                ClientEthnicity::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $updateData['updated_by'] = $request->getAttribute('oauth_user_id');
            $recordId = ClientEthnicity::update($updateData);
            $this->logger->debug("ClientEthnicity update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated ClientEthnicity $recordId"
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
     * @see \FSS\Controllers\ControllerInterface::delete() @SWG\Api(
     *      path="/clientethnicities/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a client ethnicity",
     *      type="ClientEthnicity",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of client ethnicity to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="client ethnicity not found")
     *      )
     *      )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = ClientEthnicity::findOrFail($id);
            $record->delete();
            $this->logger->debug("ClientEthnicity delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted ClientEthnicity $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "ClientEthnicity not found"
                ], 404);
        }
    }
}
