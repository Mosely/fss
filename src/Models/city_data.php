<?php
namespace FSS\Models;

/**
 * The city_data model
 * 
 * @author Dewayne
 *
 */
class City_data extends CommonModel
{
    // The table for this model
    protected $table = 'city_data';

    /**
     * Get the addresses that have this city.
     */
    public function address()
    {
        return $this->hasMany('FSS\Models\Address');
    }
    
    // getters and setters if you want and other logic
}
