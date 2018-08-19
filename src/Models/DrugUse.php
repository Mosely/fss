<?php
namespace FSS\Models;


/**
 * The "drug_use" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="DrugUse",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="dtype", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class DrugUse extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "drug_use";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'dtype',
        'updated_by'
    );

    public function CounseleeDrugUse()
    {
        return $this->hasMany('FSS\Models\CounseleeDrugUse');
    }
}
