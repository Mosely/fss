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

/**
 * The controller for table-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/tables",
 *         description="Table operations",
 *         produces="['application/json']"
 *         )
 */
class TableController extends AbstractController implements ControllerInterface
{
    
    /**
     * var model
     */
    protected $model = "Table";
    
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
     *      path="/tables/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a table",     
     *      nickname="tableRead",
     *      type="table",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of table to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="table not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/tables",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch table",     
     *      nickname="tableReadAll",
     *      type="table"
     *      )
     *      )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
        $tableListing = $this->db::select('SHOW TABLES'); // returns an array of stdObjects
        //$records = $this->db::select('SHOW TABLES'); // returns an array of stdObjects
        $records = [];
        foreach($tableListing as $table) {
            $records[] = $table->Tables_in_fss;
        }
        $theTables = (object)['Tables_in_fss' => $records];
        
        $this->logger->debug("All " . $this->modelName . " query: ",
            $this->db::getQueryLog());
        //$this->logger->debug("The returned tables:", $records);
        //print("<pre>");
        //print_r($records);
        //print("</pre>");
        //return $response;
        $this->logger->debug($this->modelFullName);
        $this->logger->debug($this->modelFullSchemaName);
        //$this->logger->debug("The returned tables:", $theTables);
        $encoder = Encoder::instance([
            $this->modelFullName => $this->modelFullSchemaName,
        ], new EncoderOptions(JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT,
            $request->getUri()->getScheme() . '://' .
            $request->getUri()->getHost()));
        //if ($records->count() == 1) {
        //    $records = $records->first();
        //}
        return $response->withJson(
            json_decode(
                $encoder->encodeData($theTables)));
    }
    
    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/tables/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays table that meet the property=value search criteria",     
     *      nickname="tableReadAllWithFilter",
     *      type="table",
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
     *      @SWG\ResponseMessage(code=404, message="table not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/tables",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a table. See table model for details.",     
     *      nickname="tableCreate",
     *      type="table",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/tables/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a table. See the table model for details.",     
     *      nickname="tableUpdate",
     *      type="table",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of table to update",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::delete() @SWG\Api(
     *      path="/tables/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a table",     
     *      nickname="tableDelete",
     *      type="table",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of table to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="table not found")
     *      )
     *      )
     */

}
