<?php
namespace FSS\Models;

/**
 * The "shelter_client_identity_preference" model.
 *
 * @author Dewayne
 *        
 */
class ShelterClientIdentityPreference extends AbstractModel
{

    // The table for this model
    protected $table = "shelter_client_identity_preference";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'shelter_client_id',
        'identity_preference_id',
        'created_at',
        'updated_at',
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
