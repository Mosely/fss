<?php
namespace FSS\Models;

/**
 * The "user_role" model.
 *
 * @author Dewayne
 *        
 */
class UserRole extends AbstractModel
{

    // The table for this model
    protected $table = "user_role";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'user_id',
        'role_id',
        'created_at',
        'updated_at',
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
