<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "city_data_extended" model.
 *
 * @author Dewayne
 *
 * @SWG\Model(
 *     id="CityDataExtended",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="city", type="string", required=true),
 *     @SWG\Property(name="state_code", type="string", required=true),
 *     @SWG\Property(name="zip", type="integer", required=true),
 *     @SWG\Property(name="latitude", type="number", required=true),
 *     @SWG\Property(name="longitude", type="number", required=true),
 *     @SWG\Property(name="county", type="string", required=true),
 *     @SWG\Property(name="created_at", type="integer" required=true),
 *     @SWG\Property(name="updated_at", type="integer" required=true),
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class CityDataExtended extends AbstractModel
{

    // The table for this model
    protected $table = "city_data_extended";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'city',
        'state_code',
        'zip',
        'latitude',
        'longitude',
        'county',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function CityData()
    {
        return $this->belongsTo('FSS\Models\CityData');
    }
    
    public function StateData()
    {
        return $this->belongsTo('FSS\Models\StateData', 'state_code', 'state_code');
    }
}
