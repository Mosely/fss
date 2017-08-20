<?php
namespace FSS\Models;

/**
 * The "funding_source" model.
 *
 * @author Dewayne
 *        
 */
class Funding_source extends AbstractModel
{

    // The table for this model
    protected $table = "funding_source";

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
