<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "gender" model.
 *
 * @author Dewayne
 *        
 * @SWG\Model(
 *     id="Gender",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="name", type="string", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class Gender extends AbstractModel {
    protected $table = "gender";
    
    protected $primaryKey = "id";
    
    protected $fillable = array('name','updated_by');
    
    /**
     * Get the person records that have this gender.
     */
    public function Person()
    {
        return $this->hasMany('FSS\Models\Person');
    }
    
    public function CounseleeChildSibling()
    {
        return $this->hasMany('FSS\Models\CounseleeChildSibling');
    }
    // getters and setters if you want and other logic
}
