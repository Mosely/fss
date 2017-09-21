<?php
namespace FSS\Models;

/**
 * The "person_phone" model.
 *
 * @author Dewayne
 *        
 */
class Person_phone extends AbstractModel
{

    // The table for this model
    protected $table = "person_phone";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'person_id',
        'phone_id',
        'is_primary',
        'can_call',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
