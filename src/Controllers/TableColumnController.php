<?php
namespace FSS\Controllers;

use FSS\Models\TableColumn;
use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Eloquent\Collection;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;
use Neomerx\JsonApi\Encoder\Encoder;
use Neomerx\JsonApi\Encoder\EncoderOptions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * The controller for tablecolumn-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/tablecolumns",
 *         description="tablecolumn operations",
 *         produces="['application/json']"
 *         )
 */
class TableColumnController extends AbstractController implements ControllerInterface
{
    
    /**
     * var model
     */
    protected $model = "TableColumn";
    
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
     *      path="/tablecolumns/{id}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays a tablecolumn",     
     *      nickname="tablecolumnRead",
     *      type="tablecolumn",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of tablecolumn to fetch",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="tablecolumn not found")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll() @SWG\Api(
     *      path="/tablecolumns",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Fetch tablecolumn",     
     *      nickname="tablecolumnReadAll",
     *      type="tablecolumn"
     *      )
     *      )
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
            $tableColumnListing = $this->db::select('SELECT COLUMN_NAME FROM ' . 
                'INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = \'fss\''); 
            // returns an array of stdObjects
            //$records = [];
            //foreach($tableListing as $table) {
            //    $records[] = $table->Tables_in_fss;
            //}
            $columns = [];
            TableColumn::unguard();
            $i = 1;
            foreach($tableColumnListing as $tableColumn) {
                $columns[] = new TableColumn(['id' => $i, 'table_column' => $tableColumn->COLUMN_NAME]);
                $i++;
            }
            TableColumn::reguard();
            $records = new Collection($columns);
            
            $this->logger->debug("All " . $this->modelName . " query: ",
                $this->db::getQueryLog());
            
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
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter() @SWG\Api(
     *      path="/tablecolumns/{filter}/{value}",
     *      @SWG\Operation(
     *      method="GET",
     *      summary="Displays tablecolumn that meet the property=value search criteria",     
     *      nickname="tablecolumnReadAllWithFilter",
     *      type="tablecolumn",
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
     *      @SWG\ResponseMessage(code=404, message="tablecolumn not found")
     *      )
     *      )
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
        {
            $params = explode('/', $request->getAttribute('params'));
            $filters = [];
            $values = [];
            
            $this->getFilters($params, $filters, $values);
                
            $tableColumnListing = $this->db::select('SELECT COLUMN_NAME FROM ' .
                'INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = \'fss\' '.
                'AND TABLE_NAME = ?', $values); // returns an array of stdObjects
            //$records = [];
            //foreach($tableListing as $table) {
            //    $records[] = $table->Tables_in_fss;
            //}
            $columns = [];
            TableColumn::unguard();
            $i = 1;
            foreach($tableColumnListing as $tableColumn) {
                $columns[] = new TableColumn(['id' => $i, 'table_column' => $tableColumn->COLUMN_NAME]);
                $i++;
            }
            TableColumn::reguard();
            $records = new Collection($columns);
            
            $this->logger->debug("All " . $this->modelName . " query: ",
                $this->db::getQueryLog());
            
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
     * @see \FSS\Controllers\ControllerInterface::create() @SWG\Api(
     *      path="/tablecolumns",
     *      @SWG\Operation(
     *      method="POST",
     *      summary="Creates a tablecolumn. See tablecolumn model for details.",     
     *      nickname="tablecolumnCreate",
     *      type="tablecolumn",
     *      @SWG\ResponseMessage(code=400, message="Error occurred")
     *      )
     *      )
     */

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update() @SWG\Api(
     *      path="/tablecolumns/{id}",
     *      @SWG\Operation(
     *      method="PUT",
     *      summary="Updates a tablecolumn. See the tablecolumn model for details.",     
     *      nickname="tablecolumnUpdate",
     *      type="tablecolumn",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of tablecolumn to update",
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
     *      path="/tablecolumns/{id}",
     *      @SWG\Operation(
     *      method="DELETE",
     *      summary="Deletes a tablecolumn",     
     *      nickname="tablecolumnDelete",
     *      type="tablecolumn",
     *      @SWG\Parameter(
     *      name="id",
     *      description="id of tablecolumn to delete",
     *      paramType="path",
     *      required=true,
     *      allowMultiple=false,
     *      type="integer"
     *      ),
     *      @SWG\ResponseMessage(code=404, message="tablecolumn not found")
     *      )
     *      )
     */

}
