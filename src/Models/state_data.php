<?php
namespace FSS\Models;

/**
 * The state_data model.
 * 
 * @author Dewayne
 *
 */
class State_data extends AbstractModel
{
    // The table for this model
    protected $table = 'state_data';

    /**
     * Get the addresses that have this state.
     */
    public function address()
    {
        return $this->hasMany('FSS\Models\Address');
    }
    
    // getters and setters if you want and other logic
}
