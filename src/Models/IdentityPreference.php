<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "identity_preference" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="IdentityPreference",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="name", type="string", required=true),
 *         @SWG\Property(name="description", type="string", required=false),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class IdentityPreference extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "identity_preference";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'description',
        'updated_by'
    );

    public function ShelterClientIdentityPreference()
    {
        return $this->hasMany('FSS\Models\ShelterClientIdentityPreference');
    }
}
