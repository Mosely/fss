<?php
namespace FSS\Models;

/**
 * The "state_data" model.
 *
 * @author Dewayne
 *        
 */
class StateData extends AbstractModel
{

    // The table for this model
    protected $table = 'state_data';

    /**
     * Get the addresses that have this state.
     */
    public function Address()
    {
        return $this->hasMany('FSS\Models\Address');
    }
    
    public function School()
    {
        return $this->hasMany('FSS\Models\School');
    }
    
    public function CityDataExtended()
    {
        return $this->hasMany('FSS\Models\CityDataExtended', 'state_code', 'state_code');
    }
    // getters and setters if you want and other logic
}
