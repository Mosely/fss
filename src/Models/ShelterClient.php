<?php
namespace FSS\Models;

/**
 * The "shelter_client" model.
 *
 * @author Dewayne
 *        
 */
class ShelterClient extends AbstractModel
{

    // The table for this model
    protected $table = "shelter_client";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'used_form_assistance',
        'assistant_name',
        'assistant_relationship',
        'is_rural',
        'is_urban',
        'has_tanf_form',
        'advocate_user_id',
        'enter_date',
        'exit_date',
        'notes',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function Client()
    {
        return $this->belongsTo('FSS\Models\Client');
    }
    
    public function ShelterClientAdditionalStaff()
    {
        return $this->hasMany('FSS\Models\ShelterClientAdditionalStaff');
    }
    
    public function ShelterClientFundingSource()
    {
        return $this->hasMany('FSS\Models\ShelterClientFundingSource');
    }
    
    public function ShelterClientIdentityPreference()
    {
        return $this->hasMany('FSS\Models\ShelterClientIdentityPreference');
    }
    
    public function User()
    {
        return $this->belongsTo('FSS\Models\User', 'advocate_user_id');
    }
}
