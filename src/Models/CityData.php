<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "city_data" model
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="CityData",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="name", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 *        
 */
class CityData extends AbstractModel
{

    protected $table = "city_data";

    protected $primaryKey = "id";

    protected $fillable = array(
        'name',
        'updated_by'
    );

    /**
     * Get the addresses that have this city.
     */
    public function Address()
    {
        return $this->hasMany('FSS\Models\Address');
    }

    public function CityDataExtended()
    {
        return $this->hasOne('FSS\Models\CityDataExtended');
    }

    public function School()
    {
        return $this->hasMany('FSS\Models\School');
    }
    // getters and setters if you want and other logic
}
