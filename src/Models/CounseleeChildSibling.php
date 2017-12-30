<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "counselee_child_sibling" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="CounseleeChildSibling",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="counselee_child_id", type="integer", required=true),
 *         @SWG\Property(name="type", type="string", required=true),
 *         @SWG\Property(name="gender_id", type="integer", required=true),
 *         @SWG\Property(name="age", type="integer", required=true),
 *         @SWG\Property(name="relationship_desc", type="string", required=true),
 *         @SWG\Property(name="is_dead", type="boolean", required=true),
 *         @SWG\Property(name="age_at_death", type="integer", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class CounseleeChildSibling extends AbstractModel
{

    protected $table = "counselee_child_sibling";

    protected $primaryKey = "id";

    protected $fillable = array(
        'counselee_child_id',
        'type',
        'gender_id',
        'age',
        'relationship_desc',
        'is_dead',
        'age_at_death',
        'updated_by'
    );

    public function CounseleeChild()
    {
        return $this->belongsTo('FSS\Models\CounseleeChild');
    }

    public function Gender()
    {
        return $this->belongsTo('FSS\Models\Gender');
    }
}
