<?php
namespace FSS\Models;

/**
 * The "counselee_child_sibling" model.
 *
 * @author Dewayne
 *        
 */
class Counselee_child_sibling extends AbstractModel
{

    // The table for this model
    protected $table = "counselee_child_sibling";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'id',
        'counselee_child_id',
        'type',
        'gender_id',
        'age',
        'relationship_desc',
        'is_dead',
        'age_at_death',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
