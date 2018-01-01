<?php
namespace FSS\Models;


/**
 * The "counselee_medication" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="CounseleeMedication",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="counselee_id", type="integer", required=true),
 *         @SWG\Property(name="medication_id", type="integer", required=true),
 *         @SWG\Property(name="reason", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class CounseleeMedication extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "counselee_medication";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'counselee_id',
        'medication_id',
        'reason',
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
