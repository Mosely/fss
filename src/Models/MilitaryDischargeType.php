<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "military_discharge_type" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="MilitaryDischargeType",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="name", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class MilitaryDischargeType extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "military_discharge_type";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'updated_by'
    );

    public function Veteran()
    {
        return $this->hasMany('FSS\Models\Veteran');
    }
}
