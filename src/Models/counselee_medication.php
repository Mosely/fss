<?php
namespace FSS\Models;

/**
 * The "counselee_medication" model.
 *
 * @author Dewayne
 *        
 */
class Counselee_medication extends AbstractModel
{

    // The table for this model
    protected $table = "counselee_medication";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'id',
        'counselee_id',
        'medication_id',
        'reason',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
