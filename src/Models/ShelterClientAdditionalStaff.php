<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "shelter_client_additional_staff" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="ShelterClientAdditionalStaff",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="shelter_client_id", type="integer", required=true),
 *         @SWG\Property(name="user_id", type="integer", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class ShelterClientAdditionalStaff extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "shelter_client_additional_staff";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'shelter_client_id',
        'user_id',
        'updated_by'
    );

    public function ShelterClient()
    {
        return $this->belongsTo('FSS\Models\ShelterClient');
    }

    public function User()
    {
        return $this->belongsTo('FSS\Models\User');
    }
}
