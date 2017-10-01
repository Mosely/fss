<?php
namespace FSS\Models;

/**
 * The "client_ethnicity" model.
 *
 * @author Dewayne
 *        
 */
class ClientEthnicity extends AbstractModel
{

    // The table for this model
    protected $table = 'client_ethnicity';

    /**
     * Get the client records that have this client_ethnicity.
     */
    public function Client()
    {
        return $this->belongsTo('FSS\Models\Client');
    }

    /**
     * Get the ethnicity records that have this client_ethnicity.
     */
    public function Ethnicity()
    {
        return $this->belongsTo('FSS\Models\Ethnicity');
    }
    // getters and setters if you want and other logic
}
