<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "shelter_client" model
 *
 * @author Dewayne
 *        
 * @SWG\Model(
 *     id="ShelterClient",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="used_form_assistance", type="boolean", required=true),
 *     @SWG\Property(name="assistant_name", type="string", required=false),
 *     @SWG\Property(name="assistant_relationship", type="string", required=false),
 *     @SWG\Property(name="is_rural", type="boolean", required=false),
 *     @SWG\Property(name="is_urban", type="boolean", required=false),
 *     @SWG\Property(name="has_tanf_form_", type="boolean", required=false), 
 *     @SWG\Property(name="advocate_user_id", type="integer", required=false),
 *     @SWG\Property(name="enter_date", type="string", required=false),
 *     @SWG\Property(name="exit_date", type="string", required=false), 
 *     @SWG\Property(name="notes", type="string", required=false),
 *     @SWG\Property(name="created_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class ShelterClient extends AbstractModel
{
    // The primary key
    protected $primaryKey = "id";
    
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
