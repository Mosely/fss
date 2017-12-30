<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "report column" model.
 *
 * @author Dewayne
 *        
 * @SWG\Model(
 *     id="ReportColumn",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="report_id", type="integer", required=true),
 *     @SWG\Property(name="header", type="string", required=true),
 *     @SWG\Property(name="table_name", type="string", required=true),
 *     @SWG\Property(name="column_name", type="string", required=true),
 *     @SWG\Property(name="column_order", type="integer", required=true),
 *     @SWG\Property(name="width", type="integer", required=false), 
 *     @SWG\Property(name="created_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class ReportColumn extends AbstractModel
{

    protected $table = "report_column";

    protected $primaryKey = "id";

    protected $fillable = array(
        'report_id',
        'header',
        'table_name',
        'column_name',
        'column_order',
        'width',
        'updated_by'
    );

    public function report()
    {
        return $this->belongsTo('FSS\Models\Report');
    }

    public function reportCriteria()
    {
        return $this->hasOne('FSS\Models\ReportCriteria');
    }
}
