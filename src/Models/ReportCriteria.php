<?php
namespace FSS\Models;

class ReportCriteria extends AbstractModel
{

    protected $table = "report_criteria";

    protected $primaryKey = "id";

    protected $fillable = array(
        'report_column_id',
        'relation',
        'criteria_value',
        'updated_by'
    );

    public function reportColumn()
    {
        return $this->belongsTo('FSS\Models\ReportColumn');
    }
}
