<?php
namespace FSS\Models;

/**
 * The "address" model.
 *
 * @author Dewayne
 *        
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
