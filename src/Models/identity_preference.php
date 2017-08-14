<?php
namespace FSS\Models;

/**
 * The "identity_preference" model.
 *
 * @author Dewayne
 *        
 */
class Identity_preference extends AbstractModel
{

    // The table for this model
    protected $table = "identity_preference";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'id',
        'name',
        'description',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
