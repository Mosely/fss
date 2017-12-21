<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "county_data" model.
 *
 * @author Dewayne
 *       
 * @SWG\Model(
 *     id="county_data",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="name", type="string", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class CountyData extends AbstractModel
{

    // The table for this model
    protected $table = 'county_data';

    /**
     * Get the addresses that have this county.
     */
    public function Address()
    {
        return $this->hasMany('FSS\Models\Address');
    }
    
    // getters and setters if you want and other logic
}
