<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "client" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="Client",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="social_security_number", type="integer", required=true),
 *         @SWG\Property(name="place_of_employment", type="string", required=true),
 *         @SWG\Property(name="is_service_member_or_veteran", type="boolean", required=true),
 *         @SWG\Property(name="has_family_who_is_service_member_or_veteran", type="boolean", required=true),
 *         @SWG\Property(name="is_referred_by_veteran_resource_center", type="boolean", required=true),
 *         @SWG\Property(name="referral", type="string", required=false),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class Client extends AbstractModel
{

    protected $table = "client";

    protected $primaryKey = "id";

    protected $fillable = array(
        'social_security_number',
        'place_of_employment',
        'is_service_member_or_veteran',
        'has_family_who_is_service_member_or_veteran',
        'is_referred_by_veteran_resource_center',
        'referral',
        'updated_by'
    );

    /**
     * Get the person records that have this client.
     */
    public function Person()
    {
        return $this->belongsTo('FSS\Models\Person', 'id', 'id');
    }

    public function ClientEthnicity()
    {
        return $this->hasMany('FSS\Models\ClientEthnicity');
    }

    public function ClientLanguage()
    {
        return $this->hasMany('FSS\Models\ClientLanguage');
    }

    public function Veteran()
    {
        return $this->hasOne('FSS\Models\Veteran');
    }
    // getters and setters if you want and other logic
}
