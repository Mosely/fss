<?php
namespace FSS\Models;

/**
 * The "veteran" model.
 *
 * @author Dewayne
 *        
 */
class Veteran extends AbstractModel
{

    // The table for this model
    protected $table = "veteran";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'id',
        'referred_by',
        'branch_of_service_id',
        'military_discharge_type_id',
        'has_dd214',
        'is_registered_with_va',
        'va_id',
        'job_title',
        'is_on_disability',
        'is_homeless',
        'household_income',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
