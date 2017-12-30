<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "shelter_client_funding_source" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="ShelterClientFundingSource",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="shelter_client_id", type="integer", required=true),
 *         @SWG\Property(name="funding_source_id", type="integer", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class ShelterClientFundingSource extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "shelter_client_funding_source";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'shelter_client_id',
        'funding_source_id',
        'updated_by'
    );

    public function ShelterClient()
    {
        return $this->belongsTo('FSS\Models\ShelterClient');
    }

    public function FundingSource()
    {
        return $this->belongsTo('FSS\Models\FundingSource');
    }
}
