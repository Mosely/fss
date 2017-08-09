<?php
namespace FSS\Models;

//use \Illuminate\Database\Eloquent\Model;

class Gender extends CommonModel
{

    protected $table = 'gender';

    /**
     * Get the person records that have this gender.
     */
    public function person()
    {
        return $this->hasMany('FSS\Models\Person');
    }
    // getters and setters if you want and other logic
}
