<?php
namespace FSS\Models;

/**
 * The "shelter_client_funding_source" model.
 *
 * @author Dewayne
 *        
 */
class Shelter_client_funding_source extends AbstractModel
{

    // The table for this model
    protected $table = "shelter_client_funding_source";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'shelter_client_id',
        'funding_source_id',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
