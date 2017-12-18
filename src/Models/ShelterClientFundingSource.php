<?php
namespace FSS\Models;

/**
 * The "shelter_client_funding_source" model.
 *
 * @author Dewayne
 *        
 */
class ShelterClientFundingSource extends AbstractModel
{

    // The table for this model
    protected $table = "shelter_client_funding_source";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'shelter_client_id',
        'funding_source_id',
        'created_at',
        'updated_at',
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
