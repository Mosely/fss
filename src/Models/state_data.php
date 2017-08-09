<?php
namespace FSS\Models;

//use \Illuminate\Database\Eloquent\Model;

class State_data extends CommonModel
{

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
