<?php
namespace FSS\Models;

/**
 * The "school" model.
 *
 * @author Dewayne
 *        
 */
class School extends AbstractModel
{

    // The table for this model
    protected $table = "school";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'id',
        'name',
        'city_data_id',
        'state_data_id',
        'street',
        'zipcode',
        'zipcode_plus_four',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
