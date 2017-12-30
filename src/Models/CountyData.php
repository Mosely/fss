<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "county_data" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="CountyData",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="name", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class CountyData extends AbstractModel
{

    protected $table = "county_data";

    protected $primaryKey = "id";

    protected $fillable = array(
        'name',
        'updated_by'
    );

    /**
     * Get the addresses that have this county.
     */
    public function Address()
    {
        return $this->hasMany('FSS\Models\Address');
    }
    
    // getters and setters if you want and other logic
}
