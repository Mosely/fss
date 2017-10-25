<?php
namespace FSS\Models;

/**
 * The "military_discharge_type" model.
 *
 * @author Dewayne
 *        
 */
class MilitaryDischargeType extends AbstractModel
{

    // The table for this model
    protected $table = "military_discharge_type";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
