<?php
namespace FSS\Models;


/**
 * The "user_role" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="UserRole",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="user_id", type="integer", required=true),
 *         @SWG\Property(name="role_id", type="integer", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class UserRole extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "user_role";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'user_id',
        'role_id',
        'updated_by'
    );

    public function User()
    {
        return $this->belongsTo('FSS\Models\User');
    }

    public function Role()
    {
        return $this->belongsTo('FSS\Models\Role');
    }
}
