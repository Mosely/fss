<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "person_phone" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="PersonPhone",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="person_id", type="integer", required=true),
 *         @SWG\Property(name="phone_id", type="integer", required=true),
 *         @SWG\Property(name="is_primary", type="boolean", required=true),
 *         @SWG\Property(name="can_call", type="boolean", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class PersonPhone extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "person_phone";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'person_id',
        'phone_id',
        'is_primary',
        'can_call',
        'updated_by'
    );

    public function Person()
    {
        return $this->belongsTo('FSS\Models\Person');
    }

    public function Phone()
    {
        return $this->belongsTo('FSS\Models\Phone');
    }
}
