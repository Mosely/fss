<?php
namespace FSS\Models;

/**
 * The "role" model.
 *
 * @author Dewayne
 *        
 */
class Role extends AbstractModel
{

    // The table for this model
    protected $table = "role";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'id',
        'name',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
