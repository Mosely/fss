<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "counselee_child_guardian" model.
 *
 * @author Dewayne
 *   
 * @SWG\Model(
 *     id="counselee_child_guardian",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="counselee_child_id", type="integer", required=true),
 *     @SWG\Property(name="name", type="string", required=true),
 *     @SWG\Property(name="age", type="integer", required=true),
 *     @SWG\Property(name="occupation", type="string", required=true),
 *     @SWG\Property(name="is_currently_living_with_child", type="boolean", required=true),
 *     @SWG\Property(name="date_first_lived_with_child", type="date", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_at", type="integer", required=true), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )  
 */
class CounseleeChildGuardian extends AbstractModel
{

    // The table for this model
    protected $table = "counselee_child_guardian";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'counselee_child_id',
        'name',
        'age',
        'occupation',
        'is_currently_living_with_child',
        'date_first_lived_with_child',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function CounseleeChild()
    {
        return $this->belongsTo('FSS\Models\CounseleeChild');
    }
}
