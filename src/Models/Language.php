<?php
namespace FSS\Models;

/**
 * The "language" model.
 *
 * @author Dewayne
 *        
 */
class Language extends AbstractModel
{

    // The table for this model
    protected $table = "language";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
