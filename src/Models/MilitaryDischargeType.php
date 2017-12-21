<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "military_discharge_type" model.
 *
 * @author Dewayne
 *       
 * @SWG\Model(
 *     id="military_discharge_type",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="name", type="string", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class MilitaryDischargeType extends AbstractModel
{

    // The table for this model
    protected $table = "military_discharge_type";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function Veteran()
    {
        return $this->hasMany('FSS\Models\Veteran');
    }
}
