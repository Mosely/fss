<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "medication" model.
 *
 * @author Dewayne
 *  
 * @SWG\Model(
 *     id="medication",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="name", type="string", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class Medication extends AbstractModel
{

    // The table for this model
    protected $table = "medication";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function CounseleeMedication()
    {
        return $this->hasMany('FSS\Models\CounseleeMedication');
    }
}
