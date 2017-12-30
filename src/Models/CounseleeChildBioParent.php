<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "counselee_child_bio_parent" model.
 *
 * @author Dewayne
 *        
 * @SWG\Model(
 *     id="CounseleeChildBioParent",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="counselee_child_id", type="integer", required=true),
 *     @SWG\Property(name="type", type="string", required=true),
 *     @SWG\Property(name="name", type="string", required=true),
 *     @SWG\Property(name="age", type="integer", required=true),
 *     @SWG\Property(name="occupation", type="string", required=true),
 *     @SWG\Property(name="health_problems", type="string", required=false),
 *     @SWG\Property(name="is_deceased", type="boolean", required=true),
 *     @SWG\Property(name="age_at_death", type="integer", required=false),
 *     @SWG\Property(name="child_age_when_bio_died", type="integer", required=false),
 *     @SWG\Property(name="cause_of_death", type="string", required=false),
 *     @SWG\Property(name="created_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * ) 
 */
class CounseleeChildBioParent extends AbstractModel {
    protected $table = "counselee_child_bio_parent";
    
    protected $primaryKey = "id";
    
    protected $fillable = array('counselee_child_id','type','name','age','occupation','health_problems','is_deceased','age_at_death','child_age_when_bio_died','cause_of_death','updated_by');
    
    
    public function CounseleeChild()
    {
        return $this->belongsTo('FSS\Models\CounseleeChild');
    }
}
