<?php
namespace FSS\Models;


/**
 * The "counselee_child_guardian" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="CounseleeChildGuardian",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="counselee_child_id", type="integer", required=true),
 *         @SWG\Property(name="name", type="string", required=true),
 *         @SWG\Property(name="age", type="integer", required=true),
 *         @SWG\Property(name="occupation", type="string", required=true),
 *         @SWG\Property(name="is_currently_living_with_child", type="boolean", required=true),
 *         @SWG\Property(name="date_first_lived_with_child", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class CounseleeChildGuardian extends AbstractModel
{

    protected $table = "counselee_child_guardian";

    protected $primaryKey = "id";

    protected $fillable = array(
        'id',
        'counselee_child_id',
        'name',
        'age',
        'occupation',
        'is_currently_living_with_child',
        'date_first_lived_with_child',
        'updated_by'
    );

    public function CounseleeChild()
    {
        return $this->belongsTo('FSS\Models\CounseleeChild');
    }
}
