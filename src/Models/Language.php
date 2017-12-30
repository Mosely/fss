<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "language" model.
 *
 * @author Dewayne
 *    
 * @SWG\Model(
 *     id="Language",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="name", type="string", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class Language extends AbstractModel
{
    // The primary key
    protected $primaryKey = "id";
    
    // The table for this model
    protected $table = "language";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'name',
        'updated_by'
    );
    public function ClientLanguage()
    {
        return $this->hasMany('FSS\Models\ClientLanguage');
    }
}
