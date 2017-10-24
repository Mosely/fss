<?php
namespace FSS\Controllers;

use FSS\Models\Report;
use FSS\Models\ReportColumn;
use FSS\Models\Dynamic;
use Interop\Container\ContainerInterface;
use \Exception;

/**
 * The controller for report-related actions.
 *
 * Implements the ControllerInterface.
 *
 * @author Dewayne
 *
 */
class ReportController implements ControllerInterface {
    
    // The DI container reference.
    private $container;
    
    /**
     * The constructor that sets the DI Container reference and
     * enable query logging if debug mode is true in settings.php
     *
     * @param ContainerInterface $c
     */
    public function __construct(ContainerInterface $c)
    {
        $this->container = $c;
        if ($this->container['settings']['debug']) {
            $this->container['logger']->debug(
                "Enabling query log for the Report Controller.");
            $this->container['db']::enableQueryLog();
        }
    }
    
    public function generateReportOutput($request, $response, $args)
    {
        $reportJson = $this->read($request, $response, $args)->getBody();
        $report = json_decode($reportJson, false);
        //print "<pre>";
        //print_r($reportJson);
        //print_r($report);
        //print "</pre>";
        $columns = $report->data[0]->report_column;
        $reportName = $report->data[0]->name;
        $reportType = $report->data[0]->type;
        //print "<pre>";
        //print_r($columns);
        //print "</pre>";

        
        try {
            $records = Report::run($columns, $reportName, $reportType, $this->container);
            //$records = $query->get();
            $this->container['logger']->debug("Generated Report query: ",
                $this->container['db']::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Report Data for report " . $report->data[0]->id,
                    "data" => $records
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }
        catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Error occured: " . $e->getMessage()
                ], 400);
        }
    }
    
    public function read($request, $response, $args)
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->container['logger']->debug("Reading report with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    public function readAllWithFilter($request, $response, $args)
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            Report::validateColumn('report', $filter, $this->container);
            $records = Report::with(
                [
                    'reportColumn' => function ($q) {
                        return $q->with('reportCriteria');
                    // NOTE: If you need to traverse the depths of more
                    // than two tables (in this case, the user, person
                    // and gender tables) you will need to handle the
                    // deeper relationships as done here.
                    }
                ])->where($filter, $value)->get();
                $this->container['logger']->debug("Report filter query: ",
                    $this->container['db']::getQueryLog());
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

    public function create($request, $response, $args)
    {
        
    }

    public function update($request, $response, $args)
    {
        
    }

    public function delete($request, $response, $args)
    {
        
    }

    public function readAll($request, $response, $args)
    {
        
    }
}