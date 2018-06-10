<?php
namespace FSS\Models;


/**
 * The "shelter_client_identity_preference" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="ShelterClientIdentityPreference",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="shelter_client_id", type="integer", required=true),
 *         @SWG\Property(name="identity_preference_id", type="integer", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class ShelterClientIdentityPreference extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "shelter_client_identity_preference";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'shelter_client_id',
        'identity_preference_id',
        'updated_by'
    );

    public function ShelterClient()
    {
        return $this->belongsTo('FSS\Models\ShelterClient');
    }

    public function IdentityPreference()
    {
        return $this->belongsTo('FSS\Models\IdentityPreference');
    }
}
