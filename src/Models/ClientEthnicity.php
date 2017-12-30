<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "client_ethnicity" model.
 *
 * @author Dewayne
 *  
 * @SWG\Model(
 *     id="ClientEthnicity",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="client_id", type="integer", required=true),
 *     @SWG\Property(name="ethnicity_id", type="integer", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=true),
 *     @SWG\Property(name="updated_at", type="integer", required=true),
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * ) 
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
