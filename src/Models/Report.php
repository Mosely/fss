<?php
namespace FSS\Models;

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
        return $this->hasMany('FSS\Models\ReportColumn');
    }
    
    public function run(array $columns)
    {
        $reportingTable = new Dynamic([]);
        $reportingTable->setTable($columns['table_name']);
        $query = $reportingTable->query();
        $query->where($columns['column_name']);
    }
}
