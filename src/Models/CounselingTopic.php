<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "counseling_topic" model.
 *
 * @author Dewayne
 *     
 * @SWG\Model(
 *     id="counseling_topic",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="topic", type="string", required=true),
 *     @SWG\Property(name="description", type="string", required=false),
 *     @SWG\Property(name="created_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class CounselingTopic extends AbstractModel
{

    // The table for this model
    protected $table = "counseling_topic";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'topic',
        'description',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function CounseleeCounselingTopic()
    {
        return $this->hasMany('FSS\Models\CounseleeCounselingTopic');
    }
}
