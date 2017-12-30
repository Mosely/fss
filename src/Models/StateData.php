<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "state_data" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="StateData",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="name", type="string", required=true),
 *         @SWG\Property(name="stage_code", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class StateData extends AbstractModel
{

    protected $table = "state_data";

    protected $primaryKey = "id";

    protected $fillable = array(
        'name',
        'state_code',
        'updated_by'
    );

    /**
     * Get the addresses that have this state.
     */
    public function Address()
    {
        return $this->hasMany('FSS\Models\Address');
    }

    public function School()
    {
        return $this->hasMany('FSS\Models\School');
    }

    public function CityDataExtended()
    {
        return $this->hasMany('FSS\Models\CityDataExtended', 'state_code',
            'state_code');
    }
    // getters and setters if you want and other logic
}
