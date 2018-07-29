<?php
namespace FSS\Controllers;

use FSS\Models\Report;
use FSS\Utilities\Cache;
use Illuminate\Database\Capsule\Manager;
use League\OAuth2\Server\AuthorizationServer;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Exception;

/**
 * The controller for report-related actions.
 *
 * Implements the ControllerInterface.
 *
 * @author Dewayne
 *        
 *         @SWG\Resource(
 *         apiVersion="1.0",
 *         resourcePath="/reports",
 *         description="Report operations",
 *         produces="['application/json']"
 *         )
 */
class ReportController extends AbstractController
{
    
    /**
     * var model
     */
    protected $model = "Report";
    
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

    public function generateReportOutput(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $reportJson = $this->read($request, $response, $args)->getBody();
        $report = json_decode($reportJson, false);
        $report = $report['data']['attributes'];
        $columns = $report->report_column;
        $reportName = $report->name;
        $reportType = $report->rtype;
        
        try {
            // $records = Report::run($columns,
            // $reportName, $reportType, $this->authorizer);
            Report::run($columns, $reportName, $reportType, 
                $request->getAttribute('oauth_user_id'));
            $this->logger->debug("Generated Report query: ",
                $this->db::getQueryLog());
            
            // return $response->withJson(
            // [
            // "success" => true,
            // "message" => "Report Data for report " . $report->data[0]->id,
            // "data" => $records
            // ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            return $response;
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Error occured: " . $e->getMessage()
                ], 400);
        }
    }

//     public function read(ServerRequestInterface $request,
//         ResponseInterface $response, array $args): ResponseInterface
//     {
//         $id = $args['id'];
//         $params = [
//             'id',
//             $id
//         ];
//         $request = $request->withAttribute('params', implode('/', $params));
//         $this->logger->debug("Reading report with id of $id");
        
//         return $this->readAllWithFilter($request, $response, $args);
//     }

//     public function readAllWithFilter(ServerRequestInterface $request,
//         ResponseInterface $response, array $args): ResponseInterface
//     {
//         // $filter = $args['filter'];
//         // $value = $args['value'];
//         $params = explode('/', $request->getAttribute('params'));
//         $filters = [];
//         $values = [];
        
//         try {
//             $this->getFilters($params, $filters, $values);
            
//             foreach ($filters as $filter) {
//                 Report::validateColumn($filter, $this->logger, $this->cache,
//                     $this->db);
//             }
//             $records = Report::with(
//                 [
//                     'reportColumn' => function ($q) {
//                         return $q->with('reportCriteria');
//                         // NOTE: If you need to traverse the depths of more
//                         // than two tables you will need to handle the
//                         // deeper relationships as done here.
//                     }
//                 ])->whereRaw('LOWER(`' . $filters[0] . '`) like ?',
//                 [
//                     '%' . strtolower($values[0]) . '%'
//                 ]);
//             for ($i = 1; $i < count($filters); $i ++) {
//                 $records = $records->whereRaw(
//                     'LOWER(`' . $filters[$i] . '`) like ?',
//                     [
//                         '%' . strtolower($values[$i]) . '%'
//                     ]);
//             }
//             $records = $records->limit(200)->get();
            
//             $this->logger->debug("Report filter query: ",
//                 $this->db::getQueryLog());
//             if ($records->isEmpty()) {
//                 return $response->withJson(
//                     [
//                         "success" => true,
//                         "message" => "No Report found",
//                         "data" => $records
//                     ], 404);
//             }
//             $encoder = Encoder::instance([
//                 Report::class => ReportSchema::class,
//             ], new EncoderOptions(JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT,
//                 $request->getUri()->getScheme() . '://' .
//                 $request->getUri()->getHost()));
//             if ($records->count() == 1) {
//                 $records = $records->first();
//             }
//             return $response->withJson(
//                 json_decode(
//                     $encoder->encodeData($records)));

//         } catch (Exception $e) {
//             return $response->withJson(
//                 [
//                     "success" => false,
//                     "message" => "Error occured: " . $e->getMessage()
//                 ], 400);
//         }
//     }

    public function create(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {}

    public function update(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {}

    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {}

    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {}
}
