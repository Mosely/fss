<?php
namespace FSS\Models;

/**
 * The "shelter_client_additional_staff" model.
 *
 * @author Dewayne
 *        
 */
class Shelter_client_additional_staff extends AbstractModel
{

    // The table for this model
    protected $table = "shelter_client_additional_staff";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'shelter_client_id',
        'user_id',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
