<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "report criteria" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="ReportCriteria",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="report_column_id", type="integer", required=true),
 *         @SWG\Property(name="relation", type="string", required=true),
 *         @SWG\Property(name="criteria_value", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
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
