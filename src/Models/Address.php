<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "address" model.
 *
 * @author Dewayne
 *
 * @SWG\Model(
 *     id="Address",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="street_number", type="integer", required=false),
 *     @SWG\Property(name="street_name", type="string", required=true),
 *     @SWG\Property(name="street_suffix", type="string", required=false),
 *     @SWG\Property(name="zipcode", type="integer", required=true),
 *     @SWG\Property(name="city_data_id", type="integer", required=true),
 *     @SWG\Property(name="state_data_id", type="integer", required=true),
 *     @SWG\Property(name="county_data_id", type="integer", required=false),
 *     @SWG\Property(name="apartment_number", type="integer", required=false),
 *     @SWG\Property(name="created_at", type="integer" required=true),
 *     @SWG\Property(name="updated_at", type="integer" required=true),
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class Address extends AbstractModel
{

    // The table for this model
    protected $table = 'address';

    /**
     * Get the city_data record associated with the address.
     */
    public function CityData()
    {
        return $this->belongsTo('FSS\Models\CityData');
    }

    /**
     * Get the state_data record associated with the address.
     */
    public function StateData()
    {
        return $this->belongsTo('FSS\Models\StateData');
    }

    /**
     * Get the county_data record associated with the address.
     */
    public function CountyData()
    {
        return $this->belongsTo('FSS\Models\CountyData');
    }
    // getters and setters if you want and other logic
}
