<?php
namespace FSS\Models;

/**
 * The "county_data" model.
 *
 * @author Dewayne
 *        
 */
class CountyData extends AbstractModel
{

    // The table for this model
    protected $table = 'county_data';

    /**
     * Get the addresses that have this county.
     */
    public function Address()
    {
        return $this->hasMany('FSS\Models\Address');
    }
    
    // getters and setters if you want and other logic
}
