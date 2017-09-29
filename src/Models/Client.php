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
    protected $table = 'Client';

    /**
     * Get the person records that have this client.
     */
    public function Person()
    {
        return $this->belongsTo('FSS\Models\Person', 'id', 'id');
    }
    // getters and setters if you want and other logic
}