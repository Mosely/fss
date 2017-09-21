<?php
namespace FSS\Models;

/**
 * The "ethnicity" model.
 *
 * @author Dewayne
 *        
 */
class Ethnicity extends AbstractModel
{

    // The table for this model
    protected $table = "ethnicity";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
