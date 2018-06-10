<?php
namespace FSS\Models;


/**
 * The "client_ethnicity" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="ClientEthnicity",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="client_id", type="integer", required=true),
 *         @SWG\Property(name="ethnicity_id", type="integer", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class ClientEthnicity extends AbstractModel
{

    protected $table = "client_ethnicity";

    protected $primaryKey = "id";

    protected $fillable = array(
        'client_id',
        'ethnicity_id',
        'updated_by'
    );

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
