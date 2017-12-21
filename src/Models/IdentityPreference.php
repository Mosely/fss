<?php
namespace FSS\Models;

use Swagger\Annotation as SWG;
/**
 * The "identity_preference" model.
 *
 * @author Dewayne
 *        
 * @SWG\Model(
 *     id="identity_preference",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="name", type="string", required=true),
 *     @SWG\Property(name="description", type="string", required=false),
 *     @SWG\Property(name="created_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class IdentityPreference extends AbstractModel
{

    // The table for this model
    protected $table = "identity_preference";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'description',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function ShelterClientIdentityPreference()
    {
        return $this->hasMany('FSS\Models\ShelterClientIdentityPreference');
    }
}
