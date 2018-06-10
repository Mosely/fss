<?php
namespace FSS\Models;


/**
 * The "counselee_child" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="CounseleeChild",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="school_id", type="integer", required=true),
 *         @SWG\Property(name="school_problems", type="string", required=false),
 *         @SWG\Property(name="long_standing_illnesses", type="string", required=false),
 *         @SWG\Property(name="who_else_raised_child", type="string", required=false),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class CounseleeChild extends AbstractModel
{

    protected $table = "counselee_child";

    protected $primaryKey = "id";

    protected $fillable = array(
        'school_id',
        'school_problems',
        'long_standing_illnesses',
        'who_else_raised_child',
        'updated_by'
    );

    public function Counselee()
    {
        return $this->belongsTo('FSS\Models\Counselee');
    }

    public function CounseleeChildBioParent()
    {
        return $this->hasMany('FSS\Models\CounseleeChildBioParent');
    }

    public function CounseleeChildGuardian()
    {
        return $this->hasMany('FSS\Models\CounseleeChildGuardian');
    }

    public function CounseleeChildSibling()
    {
        return $this->hasMany('FSS\Models\CounseleeChildSibling');
    }

    public function School()
    {
        return $this->belongsTo('FSS\Models\School');
    }
}
