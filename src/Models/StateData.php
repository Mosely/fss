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
    
    // getters and setters if you want and other logic
}
