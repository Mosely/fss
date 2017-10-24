<?php
namespace FSS\Models;

use Illuminate\Support\Facades\DB;

class Report extends AbstractModel
{

    protected $table = "report";

    protected $primaryKey = "id";

    protected $fillable = array(
        'name',
        'type',
        'updated_by'
    );
    
    public function reportColumn()
    {
        return $this->hasMany('FSS\Models\ReportColumn')
            ->orderBy('table_name');
    }
    
    /*
     * Sort the ReportColumns array by any properties. 
     * TODO: consider making this function more generalized.
     * This could be useful elsewhere in the System.
     */
    private function sortReportColumns(&$columns, $properties)
    {
        usort($columns, function($a, $b) use ($properties) 
        {
            for($i = 1; $i < count($properties); $i++) 
            {
                if($a->$properties[$i-1] == $b->$properties[$i-1]) 
                {
                    return $a->$properties[$i] < $b->$properties[$i] ? 1 : -1;
                }
            }
            return $a->$properties[0] < $b->$properties[0] ? 1 : -1;
        });
    }
    
    public function run($columns)
    {
        // Sort the array of ReportColumn objects by column_order, 
        Report::sortReportColumns($columns, array("column_order"));
        /*
         * Steps for the report builder:
         * get all the columns,
         * get all the tables, and 
         * get all of the conditions
         */
        $tables = array_column($columns, "table_name");
        
        $query = DB::table($tables[0]);
        if(count($tables) > 1)
        {
            for ($i = 1; $i < count($tables); $i++)
            {
                $query->join($tables[$i], $tables[0] . 'id', '=', $tables[$i] . '.' . $tables[0] . '_id');
            }
        }
        $selectArray = [];
        $criteriaArray = [];
        for($i = 0; $i < count($columns); $i++) 
        {
            array_push($selectArray, $columns[$i]-> table_name . $columns[$i]->column_name);
            if(isset($columns[$i]->report_criteria))
            {
                array_push($criteriaArray, 
                    array($columns[$i]-> table_name . $columns[$i]->column_name, 
                        $columns[$i]->report_criteria->relation, 
                        $columns[$i]->report_criteria->criteria_value));
            }
        }
        $query->select($selectArray);
        $query->where($criteriaArray);
        return $query;
    }
}
