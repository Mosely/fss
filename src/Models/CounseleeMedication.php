<?php
namespace FSS\Models;

/**
 * The "counselee_medication" model.
 *
 * @author Dewayne
 *        
 */
class CounseleeMedication extends AbstractModel
{

    // The table for this model
    protected $table = "counselee_medication";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'counselee_id',
        'medication_id',
        'reason',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function Counselee()
    {
        return $this->belongsTo('FSS\Models\Counselee');
    }
    
    public function Medication()
    {
        return $this->belongsTo('FSS\Models\Medication');
    }
}
