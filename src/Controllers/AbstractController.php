<?php
namespace FSS\Controllers;

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
 * The parent class for common code for all controllers.
 *
 * @author Dewayne
 *        
 */
abstract class AbstractController implements ControllerInterface
{

    // The dependencies.
    /**
     *
     * @var Logger
     */
    protected $logger;
    
    /**
     *
     * @var Manager
     */
    protected $db;
    
    /**
     *
     * @var Cache
     */
    protected $cache;
    
    /**
     *
     * @var bool
     */
    protected $debug;
    
    /**
     *
     * @var AuthorizationServer
     */
    protected $authorizer;
    
    /**
     * 
     * @var string
     */
    protected $modelName;
    /**
     *
     * @var string
     */
    protected $modelFullName;
    
    /**
     *
     * @var string
     */
    private $modelFullSchemaName;
    
    /**
     *
     * @var string
     */
    private $modelNamespace;
    
    /**
     *
     * @var string
     */
    private $modelSchemaNamespace;
    
    /**
     * The constructor that sets fully qualified model and 
     * schema names.
     *
     */
    public function __construct()
    {
        $this->modelNamespace = "FSS\\Models";
        $this->modelSchemaNamespace = "FSS\\Schemas";
        $this->modelFullSchemaName = $this->modelSchemaNamespace . "\\" . $this->modelName . "Schema";
        $this->modelFullName = $this->modelNamespace . "\\" . $this->modelName;
        if ($this->debug) {
            $this->logger->debug(
                "Enabling query log for the " . $this->modelName . " Controller.");
            $this->db::enableQueryLog();
        }
    }
    
    /**
     * This method will parse any number of property=value
     * pairs from the URL.
     * $filters and $values are by
     * reference, and will contain the filters and values.
     *
     * @param array $params
     * @param array $filters
     * @param array $values
     * @throws Exception
     */
    protected function getFilters(array $params, array &$filters, array &$values)
    {
        $filters = [];
        $values = [];
        for ($i = 0; $i < count($params); $i ++) {
            if ($i % 2 == 0) {
                array_push($filters, $params[$i]);
            } else {
                array_push($values, $params[$i]);
            }
        }
        if (count($filters) != count($values)) {
            throw new Exception(
                "Number of values must " .
                     "match number of filtering properties.");
        }
    }
    
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
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
            $this->logger->debug("Reading " . $this->modelName . " with id of $id");
            
            return $this->readAllWithFilter($request, $response, $args);
    }
    
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
            $records = $this->modelFullName::with(
                [
//                    'CityData',
//                    'StateData',
//                    'CountyData'
                ])->limit(200)->get();
                $this->logger->debug("All " . $this->modelName . " query: ", 
                    $this->db::getQueryLog());
                // $records = Address::all();
                $encoder = Encoder::instance([
                    $this->modelFullName => $this->modelFullSchemaName,
                ], new EncoderOptions(JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT,
                    $request->getUri()->getScheme() . '://' .
                    $request->getUri()->getHost()));
                if ($records->count() == 1) {
                    $records = $records->first();
                }
                return $response->withJson(
                    json_decode(
                        $encoder->encodeData($records)));
                
    }
    
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
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
                    $this->modelFullName::validateColumn($filter, $this->logger, $this->cache,
                        $this->db);
                }
                $records = $this->modelFullName::with(
                    [
//                        'CityData',
//                        'StateData',
//                        'CountyData'
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
                    
                    $this->logger->debug($this->modelName . " filter query: ",
                        $this->db::getQueryLog());
                    if ($records->isEmpty()) {
                        return $response->withJson(
                            [
                                "success" => true,
                                "message" => "No " . $this->modelName . " found",
                                "data" => $records
                            ], 404);
                    }
                    $encoder = Encoder::instance([
                        $this->modelFullName => $this->modelFullSchemaName,
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
     * @see \FSS\Controllers\ControllerInterface::create()
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
                    $this->modelFullName::validateColumn($key, $this->logger, $this->cache,
                        $this->db);
                    $this->logger->debug("POST values: ", [
                        $key . " => " . $val
                    ]);
                }
                $recordData['updated_by'] = $request->getAttribute('oauth_user_id');
                $recordId = $this->modelFullName::insertGetId($recordData);
                $this->logger->debug($this->modelName . " create query: ",
                    $this->db::getQueryLog());
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => $this->modelName . " $recordId has been created.",
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
     */
    public function update(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
            // $id = $args['id'];
            $recordData = $request->getParsedBody();
            try {
                $updateData = [];
                foreach ($recordData as $key => $val) {
                    $this->modelFullName::validateColumn($key, $this->logger, $this->cache,
                        $this->db);
                    $updateData = array_merge($updateData,
                        [
                            $key => $val
                        ]);
                }
                $updateData['updated_by'] = $request->getAttribute('oauth_user_id');
                $recordId = $this->modelFullName::update($updateData);
                $this->logger->debug($this->modelName . " update query: ",
                    $this->db::getQueryLog());
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "Updated " . $this->modelName . " $recordId"
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
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
            $id = $args['id'];
            try {
                $record = $this->modelFullName::findOrFail($id);
                $record->delete();
                $this->logger->debug($this->modelName . " delete query: ",
                    $this->db::getQueryLog());
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "Deleted " . $this->modelName . " $id"
                    ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            } catch (Exception $e) {
                return $response->withJson(
                    [
                        "success" => false,
                        "message" => $this->modelName . " not found"
                    ], 404);
            }
    }
}
?>