<?php
namespace FSS\Models;


/**
 * The "phone" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="Phone",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="area_code", type="integer", required=true),
 *         @SWG\Property(name="phone_number", type="integer", required=true),
 *         @SWG\Property(name="extension", type="integer", required=false),
 *         @SWG\Property(name="phone_type", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class Phone extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "phone";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'area_code',
        'phone_number',
        'extension',
        'phone_type',
        'updated_by'
    );

    public function PersonPhone()
    {
        return $this->hasMany('FSS\Models\PersonPhone');
    }
}
