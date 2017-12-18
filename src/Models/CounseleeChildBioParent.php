<?php
namespace FSS\Models;

/**
 * The "counselee_child_bio_parent" model.
 *
 * @author Dewayne
 *        
 */
class CounseleeChildBioParent extends AbstractModel
{

    // The table for this model
    protected $table = "counselee_child_bio_parent";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'counselee_child_id',
        'type',
        'name',
        'age',
        'occupation',
        'health_problems',
        'is_deceased',
        'age_at_death',
        'child_age_when_bio_died',
        'cause_of_death',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function CounseleeChild()
    {
        return $this->belongsTo('FSS\Models\CounseleeChild');
    }
}
