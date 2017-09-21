<?php
namespace FSS\Models;

/**
 * The "counselee_child_guardian" model.
 *
 * @author Dewayne
 *        
 */
class Counselee_child_guardian extends AbstractModel
{

    // The table for this model
    protected $table = "counselee_child_guardian";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'counselee_child_id',
        'name',
        'age',
        'occupation',
        'is_currently_living_with_child',
        'date_first_lived_with_child',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
