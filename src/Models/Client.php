<?php
namespace FSS\Models;

/**
 * The "client" model.
 *
 * @author Dewayne
 *        
 */
class Client extends AbstractModel
{

    // The table for this model
    protected $table = 'client';

    /**
     * Get the person records that have this client.
     */
    public function Person()
    {
        return $this->belongsTo('FSS\Models\Person', 'id', 'id');
    }
    public function ClientEthnicity()
    {
        return $this->hasMany('FSS\Models\ClientEthnicity');
    }
    public function ClientLanguage()
    {
        return $this->hasMany('FSS\Models\ClientLanguage');
    }
    // getters and setters if you want and other logic
}
