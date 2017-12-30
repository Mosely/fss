<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "counselee_drug_use" model.
 *
 * @author Dewayne
 *  
 * @SWG\Model(
 *     id="CounseleeDrugUse",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="counselee_id", type="integer", required=true),
 *     @SWG\Property(name="drug_use_id", type="integer", required=true),
 *     @SWG\Property(name="age_when_first_used", type="integer", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )   
 */
class CounseleeDrugUse extends AbstractModel
{
    // The primary key
    protected $primaryKey = "id";
    
    // The table for this model
    protected $table = "counselee_drug_use";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'counselee_id',
        'drug_use_id',
        'age_when_first_used',
        'updated_by'
    );
    
    public function Counselee()
    {
        return $this->belongsTo('FSS\Models\Counselee');
    }
    
    public function DrugUse()
    {
        return $this->belongsTo('FSS\Models\DrugUse');
    }
}
