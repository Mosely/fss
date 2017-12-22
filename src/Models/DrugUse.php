<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "drug_use" model.
 *
 * @author Dewayne
 *        
 * @SWG\Model(
 *     id="DrugUse",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="type", type="string", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class DrugUse extends AbstractModel
{

    // The table for this model
    protected $table = "drug_use";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'type',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function CounseleeDrugUse()
    {
        return $this->hasMany('FSS\Models\CounseleeDrugUse');
    }
}
