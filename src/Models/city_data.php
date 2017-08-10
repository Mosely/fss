<?php
namespace FSS\Models;

class City_data extends CommonModel
{

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
