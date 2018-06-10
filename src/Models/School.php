<?php
namespace FSS\Models;


/**
 * The "school" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="School",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="name", type="string", required=true),
 *         @SWG\Property(name="city_data_id", type="integer", required=true),
 *         @SWG\Property(name="state_data_id", type="integer", required=true),
 *         @SWG\Property(name="street", type="string", required=true),
 *         @SWG\Property(name="zipcode", type="integer", required=true),
 *         @SWG\Property(name="zipcode_plus_four", type="string", required=false),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class School extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "school";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'city_data_id',
        'state_data_id',
        'street',
        'zipcode',
        'zipcode_plus_four',
        'updated_by'
    );

    public function CityData()
    {
        return $this->belongsTo('FSS\Models\CityData');
    }

    public function StateData()
    {
        return $this->belongsTo('FSS\Models\StateData');
    }

    public function CounseleeChild()
    {
        return $this->hasMany('FSS\Models\CounseleeChild');
    }
}
