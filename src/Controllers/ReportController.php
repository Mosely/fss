<?php
namespace FSS\Controllers;

use FSS\Models\Report;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use \Exception;
use League\OAuth2\Server\AuthorizationServer;

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
class ReportController extends AbstractController implements ControllerInterface
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
     * @var AuthorizationServer
     */
    private $authorizer;

    /**
     *
     * @var bool
     */
    private $debug;

    /**
     * The constructor that sets The dependencies and
     * enable query logging if debug mode is true in settings.php
     *
     * @param Logger $logger
     * @param Manager $db
     * @param Cache $cache
     * @param AuthorizationServer $authorizer
     * @param bool $debug
     */
    public function __construct(Logger $logger, Manager $db, Cache $cache,
        $authorizer, bool $debug)
    {
        $this->logger = $logger;
        $this->db = $db;
        $this->cache = $cache;
        $this->authorizer = $authorizer;
        $this->debug = $debug;
        if ($this->debug) {
            $this->logger->debug(
                "Enabling query log for the Report Controller.");
            $this->db::enableQueryLog();
        }
    }

    public function generateReportOutput(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $reportJson = $this->read($request, $response, $args)->getBody();
        $report = json_decode($reportJson, false);
        $columns = $report->data[0]->report_column;
        $reportName = $report->data[0]->name;
        $reportType = $report->data[0]->type;
        
        try {
            // $records = Report::run($columns,
            // $reportName, $reportType, $this->authorizer);
            Report::run($columns, $reportName, $reportType, $this->authorizer);
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

    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $params = [
            'id',
            $id
        ];
        $request = $request->withAttribute('params', implode('/', $params));
        $this->logger->debug("Reading report with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

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
                Report::validateColumn($filter, $this->logger, $this->cache,
                    $this->db);
            }
            $records = Report::with(
                [
                    'reportColumn' => function ($q) {
                        return $q->with('reportCriteria');
                        // NOTE: If you need to traverse the depths of more
                        // than two tables you will need to handle the
                        // deeper relationships as done here.
                    }
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
            
            $this->logger->debug("Report filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No Report found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered Reports by $filter",
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
