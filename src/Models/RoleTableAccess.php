<?php
namespace FSS\Models;


/**
 * The "role_table_access" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="RoleTableAccess",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="role_id", type="integer", required=true),
 *         @SWG\Property(name="table_name", type="integer", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class RoleTableAccess extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "role_table_access";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'role_id',
        'table_name',
        'updated_by'
    );

    public function Role()
    {
        return $this->belongsTo('FSS\Models\Role');
    }
}
