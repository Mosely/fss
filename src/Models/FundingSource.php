<?php
namespace FSS\Models;

/**
 * The "funding_source" model.
 *
 * @author Dewayne
 *        
 */
class FundingSource extends AbstractModel
{

    // The table for this model
    protected $table = "funding_source";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'description',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
