<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "role" model.
 *
 * @author Dewayne
 *        
 * @SWG\Model(
 *     id="role",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="name", type="string", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class Role extends AbstractModel
{

    // The table for this model
    protected $table = "role";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function UserRole()
    {
        return $this->hasMany('FSS\Models\UserRole');
    }
}
