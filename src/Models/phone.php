<?php
namespace FSS\Models;

/**
 * The "phone" model.
 *
 * @author Dewayne
 *        
 */
class Phone extends AbstractModel
{

    // The table for this model
    protected $table = "phone";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'id',
        'area_code',
        'phone_number',
        'extension',
        'phone_type',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
