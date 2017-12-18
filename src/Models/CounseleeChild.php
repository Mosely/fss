<?php
namespace FSS\Models;

/**
 * The "counselee_child" model.
 *
 * @author Dewayne
 *        
 */
class CounseleeChild extends AbstractModel
{

    // The table for this model
    protected $table = "counselee_child";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'school_id',
        'school_problems',
        'long_standing_illnesses',
        'who_else_raised_child'
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
