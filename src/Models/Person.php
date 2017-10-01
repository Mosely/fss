<?php
namespace FSS\Models;

/**
 * The "person" model.
 *
 * @author Dewayne
 *        
 */
class Person extends AbstractModel
{

    // The table for this model
    protected $table = 'person';

    /**
     * Get the user that has this person.
     */
    public function User()
    {
        return $this->hasOne('FSS\Models\User', 'id', 'id');
        // NOTE: indicate both the foreign and
        // local keys for the one-to-one relationships
    }

    /**
     * Get the user that has this person.
     */
    public function Client()
    {
        return $this->hasOne('FSS\Models\Client', 'id', 'id');
        // NOTE: indicate both the foreign and
        // local keys for the one-to-one relationships
    }

    /**
     * Get the gender that has this person.
     */
    public function Gender()
    {
        return $this->belongsTo('FSS\Models\Gender');
    }
    // getters and setters if you want and other logic
}