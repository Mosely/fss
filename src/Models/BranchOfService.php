<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "branch_of_service" model.
 *
 * @author Dewayne
 *        
 * @SWG\Model(
 *     id="BranchOfService",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="name", type="string", required=true),
 *     @SWG\Property(name="created_at", type="integer" required=true),
 *     @SWG\Property(name="updated_at", type="integer" required=true),
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class BranchOfService extends AbstractModel
{

    // The table for this model
    protected $table = 'branch_of_service';
    
    public function Veteran()
    {
        return $this->hasMany('FSS\Models\Veteran');
    }
    // getters and setters if you want and other logic
}
