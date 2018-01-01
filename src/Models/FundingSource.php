<?php
namespace FSS\Models;


/**
 * The "funding_source" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="FundingSource",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="name", type="string", required=true),
 *         @SWG\Property(name="description", type="string", required=false),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class FundingSource extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "funding_source";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'description',
        'updated_by'
    );

    public function ShelterClientFundingSource()
    {
        return $this->hasMany('FSS\Models\ShelterClientFundingSource');
    }
}
