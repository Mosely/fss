<?php
namespace FSS\Models;

/**
 * The "counselee_child" model.
 *
 * @author Dewayne
 *        
 */
class Counselee_child extends AbstractModel
{

    // The table for this model
    protected $table = "counselee_child";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'school_id',
        'school_problems',
        'long_standing_illnesses',
        'who_else_raised_child'
    );
}
