<?php
namespace FSS\Models;

/**
 * The "branch_of_service" model.
 *
 * @author Dewayne
 *        
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
