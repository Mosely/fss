<?php
namespace FSS\Models;

/**
 * The "client_ethnicity" model.
 *
 * @author Dewayne
 *        
 */
class Client_ethnicity extends AbstractModel
{

    // The table for this model
    protected $table = 'client_ethnicity';

    /**
     * Get the client records that have this client_ethnicity.
     */
    public function client()
    {
        return $this->belongsTo('FSS\Models\Client');
    }

    /**
     * Get the ethnicity records that have this client_ethnicity.
     */
    public function ethnicity()
    {
        return $this->belongsTo('FSS\Models\Ethnicity');
    }
    // getters and setters if you want and other logic
}
