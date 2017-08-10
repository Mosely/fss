<?php
namespace FSS\Models;

/**
 * The address model.
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
    public function city_data()
    {
        return $this->belongsTo('FSS\Models\City_data');
    }

    /**
     * Get the state_data record associated with the address.
     */
    public function state_data()
    {
        return $this->belongsTo('FSS\Models\State_data');
    }

    /**
     * Get the county_data record associated with the address.
     */
    public function county_data()
    {
        return $this->belongsTo('FSS\Models\County_data');
    }
    // getters and setters if you want and other logic
}
