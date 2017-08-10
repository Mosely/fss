<?php
namespace FSS\Models;

/**
 * The gender model.
 * 
 * @author Dewayne
 *
 */
class Gender extends CommonModel
{
    // The table for this model
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
