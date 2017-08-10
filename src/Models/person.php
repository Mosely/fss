<?php
namespace FSS\Models;

/**
 * The person model.
 * 
 * @author Dewayne
 *
 */
class Person extends CommonModel
{
    // The table for this model
    protected $table = 'person';

    /**
     * Get the user that has this person.
     */
    public function user()
    {
        return $this->hasOne('FSS\Models\User', 'id', 'id');
        // NOTE: indicate both the foreign and local keys for the one-to-one relationships
    }

    /**
     * Get the gender that has this person.
     */
    public function gender()
    {
        return $this->belongsTo('FSS\Models\Gender');
    }
    // getters and setters if you want and other logic
}
