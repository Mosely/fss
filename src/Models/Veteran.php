<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "veteran" model.
 *
 * @author Dewayne
 * 
 * @SWG\Model(
 *     id="Veteran",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="referred_by", type="string", required=true),
 *     @SWG\Property(name="branch_of_service_id", type="integer", required=true),
 *     @SWG\Property(name="military_discharge_type_id", type="integer", required=true),
 *     @SWG\Property(name="has_dd214", type="boolean", required=true),
 *     @SWG\Property(name="is_registered_with_va", type="boolean", required=true),
 *     @SWG\Property(name="va_id", type="integer", required=false),
 *     @SWG\Property(name="job_title", type="string", required=false),
 *     @SWG\Property(name="is_on_disability", type="boolean", required=true),
 *     @SWG\Property(name="is_homeless", type="boolean", required=true),
 *     @SWG\Property(name="household_income", type="integer", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=true),
 *     @SWG\Property(name="updated_at", type="integer", required=true),
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class Veteran extends AbstractModel
{

    // The table for this model
    protected $table = "veteran";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'referred_by',
        'branch_of_service_id',
        'military_discharge_type_id',
        'has_dd214',
        'is_registered_with_va',
        'va_id',
        'job_title',
        'is_on_disability',
        'is_homeless',
        'household_income',
        'created_at',
        'updated_at',
        'updated_by'
    );
        
    public function BranchOfService()
    {
        return $this->belongsTo('FSS\Models\BranchOfService');
    }
        
    public function MilitaryDischargeType()
    {
        return $this->belongsTo('FSS\Models\MilitaryDischargeType');
    }
        
    public function Client()
    {
        return $this->belongsTo('FSS\Models\Client');
    }
}
