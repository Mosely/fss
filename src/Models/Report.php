<?php
namespace FSS\Models;

use Illuminate\Database\Capsule\Manager as DB;
use FSS\Utilities\ReportGenerator;

/**
 * The "report" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="Report",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="name", type="string", required=true),
 *         @SWG\Property(name="rtype", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class Report extends AbstractModel
{

    protected $table = "report";

    protected $primaryKey = "id";

    protected $fillable = array(
        'name',
        'rtype',
        'updated_by'
    );

    public function reportColumn()
    {
        return $this->hasMany('FSS\Models\ReportColumn')->orderBy('table_name');
    }

    /*
     * Sort the ReportColumns array by any properties.
     * TODO: consider making this function more generalized.
     * This could be useful elsewhere in the System.
     */
    private function sortReportColumnsDesc(&$columns, $properties)
    {
        usort($columns,
            function ($a, $b) use ($properties) {
                for ($i = 1; $i < count($properties); $i ++) {
                    if ($a->{ $properties[$i - 1] } == $b->{ $properties[$i - 1] }) {
                        return $a->{ $properties[$i] } < $b->{ $properties[$i] } ? 1 : - 1;
                    }
                }
                return $a->{ $properties[0] } < $b->{ $properties[0] } ? 1 : - 1;
            });
    }

    private function sortReportColumnsAsc(&$columns, $properties)
    {
        usort($columns,
            function ($b, $a) use ($properties) {
                for ($i = 1; $i < count($properties); $i ++) {
                    if ($a->{ $properties[$i - 1] } == $b->{ $properties[$i - 1] }) {
                        return $a->{ $properties[$i] } < $b->{ $properties[$i] } ? 1 : - 1;
                    }
                }
                return $a->{ $properties[0] } < $b->{ $properties[0] } ? 1 : - 1;
            });
    }

    public function run(array $columns, string $reportName, string $reportType,
        $userId)
    {
        // Sort the array of ReportColumn objects by column_order,
        Report::sortReportColumnsAsc($columns,
            array(
                "column_order"
            ));
        /*
         * Steps for the report builder:
         * get all the columns,
         * get all the tables, and
         * get all of the conditions
         */
        $tables = array_column($columns, "table_name");
        $tables = array_unique($tables);
        
        $query = DB::table($tables[0]);
        if (count($tables) > 1) {
            for ($i = 1; $i < count($tables); $i ++) {
                $query->join($tables[$i], $tables[0] . '.id', '=',
                    $tables[$i] . '.' . $tables[0] . '_id');
            }
        }
        $headerArray = [];
        $selectArray = [];
        $criteriaArray = [];
        for ($i = 0; $i < count($columns); $i ++) {
            array_push($headerArray, $columns[$i]->header);
            array_push($selectArray,
                $columns[$i]->table_name . '.' . $columns[$i]->column_name);
            if (isset($columns[$i]->report_criteria)) {
                array_push($criteriaArray,
                    array(
                        $columns[$i]->table_name . '.' .
                             $columns[$i]->column_name,
                            $columns[$i]->report_criteria->relation,
                            $columns[$i]->report_criteria->criteria_value
                    ));
            }
        }
        $query->select($selectArray);
        $query->where($criteriaArray);
        
        $records = $query->get();
        
        $reportPath = "php://output";
        $report = new ReportGenerator($userId, $reportPath, $reportName,
            $reportType);
        $report->SetHeader($headerArray);
        foreach ($records as $record) {
            $report->AddRow((array) $record);
        }
        $report->save();
        // return $records;
    }
}
