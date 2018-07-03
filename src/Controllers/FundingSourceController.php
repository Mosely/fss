<?php
namespace FSS\Controllers;

use FSS\Models\FundingSource;
use FSS\Schemas\FundingSourceSchema;
use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;
use Neomerx\JsonApi\Encoder\Encoder;
use Neomerx\JsonApi\Encoder\EncoderOptions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Exception;

/**
 * The controller for funding_source-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/fundingsources",
 *         description="FundingSource operations",
 *         produces="['application/json']"
 *         )
 */
class FundingSourceController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "FundingSource";
    
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
        $this->modelName = $this->model;
        parent::__construct();
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read() @SWG\Api(
     *      path="/fundingsources/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a FundingSource",
     *      type="FundingSource",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of FundingSource to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="FundingSource not found")
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
        // $this->logger->info("Reading FundingSource with id of $id");
        $this->logger->debug("Reading FundingSource with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/fundingsources",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch FundingSource",
     *      type="FundingSource"
     *      )
     *      )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = FundingSource::limit(200)->get();
        $this->logger->debug("All FundingSource query: ",
            $this->db::getQueryLog());
        // $records = Funding_source::all();
            $encoder = Encoder::instance([
                FundingSource::class => FundingSourceSchema::class,
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
     *      path="/fundingsources/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays FundingSource that meet the property=value search criteria",
     *      type="FundingSource",
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
     *      @SWG\ResponseMessage(code=404, message="FundingSource not found")
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
                FundingSource::validateColumn($filter, $this->logger,
                    $this->cache, $this->db);
            }
            $records = FundingSource::whereRaw(
                'LOWER(`' . $filters[0] . '`) like ?',
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
            
            $this->logger->debug("FundingSource filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No FundingSource found",
                        "data" => $records
                    ], 404);
            }
            $encoder = Encoder::instance([
                FundingSource::class => FundingSourceSchema::class,
            ], new EncoderOptions(JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT,
                $request->getUri()->getScheme() . '://' .
                $request->getUri()->getHost()));
            if ($records->count() == 1) {
                $records = $records->first();
            }
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
     *      path="/fundingsources",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a FundingSource. See FundingSource model for details.",
     *      type="FundingSource",
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
                FundingSource::validateColumn($key, $this->logger, $this->cache,
                    $this->db);
                $this->logger->debug("POST values: ", [
                    $key . " => " . $val
                ]);
            }
            $recordData['updated_by'] = $request->getAttribute('oauth_user_id');
            $recordId = FundingSource::insertGetId($recordData);
            $this->logger->debug("FundingSource create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "FundingSource $recordId has been created.",
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
     *      path="/fundingsources/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a FundingSource. See the FundingSource model for details.",
     *      type="FundingSource",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of FundingSource to update",
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
                FundingSource::validateColumn($key, $this->logger, $this->cache,
                    $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $updateData['updated_by'] = $request->getAttribute('oauth_user_id');
            $recordId = FundingSource::update($updateData);
            $this->logger->debug("FundingSource update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated FundingSource $recordId"
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
     *      path="/fundingsources/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a FundingSource",
     *      type="FundingSource",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of FundingSource to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="FundingSource not found")
     *      )
     *      )
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = FundingSource::findOrFail($id);
            $record->delete();
            $this->logger->debug("FundingSource delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted Funding_source $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "FundingSource not found"
                ], 404);
        }
    }
}
