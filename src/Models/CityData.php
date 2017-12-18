<?php
namespace FSS\Models;

/**
 * The "city_data" model
 *
 * @author Dewayne
 *        
 */
class CityData extends AbstractModel
{

    // The table for this model
    protected $table = 'city_data';

    /**
     * Get the addresses that have this city.
     */
    public function Address()
    {
        return $this->hasMany('FSS\Models\Address');
    }
    
    public function CityDataExtended()
    {
        return $this->hasOne('FSS\Models\CityDataExtended');
    }
    // getters and setters if you want and other logic
}
