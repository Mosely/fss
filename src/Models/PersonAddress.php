<?php
namespace FSS\Models;

/**
 * The "person_address" model.
 *
 * @author Dewayne
 *        
 */
class PersonAddress extends AbstractModel
{

    // The table for this model
    protected $table = "person_address";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'person_id',
        'address_id',
        'is_primary',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function Person()
    {
        return $this->belongsTo('FSS\Models\Person');
    }
    
    public function Address()
    {
        return $this->belongsTo('FSS\Models\Address');
    }
}
