<?php
namespace FSS\Models;

/**
 * The "counselee_drug_use" model.
 *
 * @author Dewayne
 *        
 */
class CounseleeDrugUse extends AbstractModel
{

    // The table for this model
    protected $table = "counselee_drug_use";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'counselee_id',
        'drug_use_id',
        'age_when_first_used',
        'created_at',
        'updated_at',
        'updated_by'
    );
}