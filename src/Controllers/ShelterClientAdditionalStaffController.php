<?php
namespace FSS\Controllers;

use FSS\Models\ShelterClientAdditionalStaff;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Neomerx\JsonApi\Encoder\Encoder;
use Neomerx\JsonApi\Encoder\EncoderOptions;
use Illuminate\Database\Capsule\Manager;
use FSS\Schemas\ShelterClientAdditionalStaffSchema;
use FSS\Utilities\Cache;
use \Exception;
use League\OAuth2\Server\AuthorizationServer;

/**
 * The controller for
 * shelter_client_additional_staff-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/shelterclientadditionalstaff",
 *         description="ShelterClientAdditionalStaff operations",
 *         produces="['application/json']"
 *         )
 */
class ShelterClientAdditionalStaffController extends AbstractController implements 
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
                "Enabling query log for the ShelterClientAdditionalStaff Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read() @SWG\Api(
     *      path="/shelterclientadditionalstaff/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a ShelterClientAdditionalStaff",
     *      type="ShelterClientAdditionalStaff",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientAdditionalStaff to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="ShelterClientAdditionalStaff not found")
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
        $this->logger->debug(
            "Reading ShelterClientAdditionalStaff with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/shelterclientadditionalstaff",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch ShelterClientAdditionalStaff",
     *      type="ShelterClientAdditionalStaff"
     *      )
     *      )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = ShelterClientAdditionalStaff::with(
            [
                'ShelterClient',
                'User'
            ])->limit(200)->get();
        $this->logger->debug("All ShelterClientAdditionalStaff query: ",
            $this->db::getQueryLog());
        // $records = Shelter_client_additional_staff::all();
        //return $response->withJson(
        //    [
        //        "success" => true,
        //        "message" => "All ShelterClientAdditionalStaff returned",
        //        "data" => $records
        //    ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        $encoder = Encoder::instance([
            ShelterClientAdditionalStaff::class =>
            ShelterClientAdditionalStaffSchema::class,
        ], new EncoderOptions(JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT,
            $request->getUri()->getScheme() . '://' .
            $request->getUri()->getHost()));
        
        return $response->withJson(
            json_decode(
                $encoder->encodeData($records)));
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/shelterclientadditionalstaff/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays ShelterClientAdditionalStaff that meet the property=value search criteria",
     *      type="ShelterClientAdditionalStaff",
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
     *      @SWG\ResponseMessage(code=404, message="ShelterClientAdditionalStaff not found")
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
                ShelterClientAdditionalStaff::validateColumn($filter,
                    $this->logger, $this->cache, $this->db);
            }
            $records = ShelterClientAdditionalStaff::with(
                [
                    'ShelterClient',
                    'User'
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
            
            $this->logger->debug("ShelterClientAdditionalStaff filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No ShelterClientAdditionalStaff found",
                        "data" => $records
                    ], 404);
            }
            //return $response->withJson(
            //    [
            //        "success" => true,
            //        "message" => "Filtered ShelterClientAdditionalStaff by $filter",
            //        "data" => $records
            //    ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            $encoder = Encoder::instance([
                ShelterClientAdditionalStaff::class => 
                ShelterClientAdditionalStaffSchema::class,
            ], new EncoderOptions(JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT,
                $request->getUri()->getScheme() . '://' .
                $request->getUri()->getHost()));
            
            return $response->withJson(
                json_decode(
                    $encoder->encodeData($records)));
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
     *      path="/shelterclientadditionalstaff",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a ShelterClientAdditionalStaff. See ShelterClientAdditionalStaff model for details.",
     *      type="ShelterClientAdditionalStaff",
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
                ShelterClientAdditionalStaff::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $this->logger->debug("POST values: ", [
                    $key . " => " . $val
                ]);
            }
            $recordData['updated_by'] = $request->getAttribute('oauth_user_id');
            $recordId = ShelterClientAdditionalStaff::insertGetId($recordData);
            $this->logger->debug("ShelterClientAdditionalStaff create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "ShelterClientAdditionalStaff $recordId has been created.",
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
     *      path="/shelterclientadditionalstaff/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a ShelterClientAdditionalStaff. See the ShelterClientAdditionalStaff model for details.",
     *      type="ShelterClientAdditionalStaff",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientAdditionalStaff to update",
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
                ShelterClientAdditionalStaff::validateColumn($key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $updateData['updated_by'] = $request->getAttribute('oauth_user_id');
            $recordId = ShelterClientAdditionalStaff::update($updateData);
            $this->logger->debug("ShelterClientAdditionalStaff update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated ShelterClientAdditionalStaff $recordId"
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
     *      path="/shelterclientadditionalstaff/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a ShelterClientAdditionalStaff",
     *      type="ShelterClientAdditionalStaff",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of ShelterClientAdditionalStaff to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="ShelterClientAdditionalStaff not found")
     *      )
     *      )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = ShelterClientAdditionalStaff::findOrFail($id);
            $record->delete();
            $this->logger->debug("ShelterClientAdditionalStaff delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted ShelterClientAdditionalStaff $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "ShelterClientAdditionalStaff not found"
                ], 404);
        }
    }
}
