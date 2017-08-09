<?php
namespace FSS\Models;

use \Illuminate\Database\Eloquent\Model;

class County_data extends CommonModel
{

    protected $table = 'county_data';

    /**
     * Get the addresses that have this county.
     */
    public function address()
    {
        return $this->hasMany('FSS\Models\Address');
    }
    
    // getters and setters if you want and other logic
}
