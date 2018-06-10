<?php
namespace FSS\Models;


/**
 * The "counseling_topic" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="CounselingTopic",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="topic", type="string", required=true),
 *         @SWG\Property(name="description", type="string", required=false),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class CounselingTopic extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "counseling_topic";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'topic',
        'description',
        'updated_by'
    );

    public function CounseleeCounselingTopic()
    {
        return $this->hasMany('FSS\Models\CounseleeCounselingTopic');
    }
}
