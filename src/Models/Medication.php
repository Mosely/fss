<?php
namespace FSS\Models;


/**
 * The "medication" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="Medication",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="name", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class Medication extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "medication";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'updated_by'
    );

    public function CounseleeMedication()
    {
        return $this->hasMany('FSS\Models\CounseleeMedication');
    }
}
