<?php
namespace FSS\Models;

/**
 * The "drug_use" model.
 *
 * @author Dewayne
 *        
 */
class DrugUse extends AbstractModel
{

    // The table for this model
    protected $table = "drug_use";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'type',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
