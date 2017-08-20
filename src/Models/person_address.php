<?php
namespace FSS\Models;

/**
 * The "person_address" model.
 *
 * @author Dewayne
 *        
 */
class Person_address extends AbstractModel
{

    // The table for this model
    protected $table = "person_address";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'id',
        'person_id',
        'address_id',
        'is_primary',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
