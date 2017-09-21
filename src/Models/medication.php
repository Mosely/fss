<?php
namespace FSS\Models;

/**
 * The "medication" model.
 *
 * @author Dewayne
 *        
 */
class Medication extends AbstractModel
{

    // The table for this model
    protected $table = "medication";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
