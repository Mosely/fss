<?php
namespace FSS\Models;

/**
 * The "client_language" model.
 *
 * @author Dewayne
 *        
 */
class ClientLanguage extends AbstractModel
{

    // The table for this model
    protected $table = "client_language";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'client_id',
        'language_id',
        'is_primary',
        'other_note',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
