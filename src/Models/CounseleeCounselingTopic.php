<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "counselee_counseling_topic" model.
 *
 * @author Dewayne
 * 
 * @SWG\Model(
 *     id="CounseleeCounselingTopic",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="counselee_id", type="integer", required=true),
 *     @SWG\Property(name="counseling_topic_id", type="integer", required=true),
 *     @SWG\Property(name="other_note", type="string", required=false),
 *     @SWG\Property(name="created_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )   
 */
class CounseleeCounselingTopic extends AbstractModel
{

    // The table for this model
    protected $table = "counselee_counseling_topic";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'counselee_id',
        'counseling_topic_id',
        'other_note',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function Counselee()
    {
        return $this->belongsTo('FSS\Models\Counselee');
    }
    
    public function CounselingTopic()
    {
        return $this->belongsTo('FSS\Models\CounselingTopic');
    }
}
