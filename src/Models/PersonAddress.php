<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "person_address" model.
 *
 * @author Dewayne
 *        
 * @SWG\Model(
 *     id="PersonAddress",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="person_id", type="integer", required=true),
 *     @SWG\Property(name="address_id", type="integer", required=true),
 *     @SWG\Property(name="is_primary", type="boolean", required=true),
 *     @SWG\Property(name="created_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_at", type="integer", required=false), 
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * )
 */
class PersonAddress extends AbstractModel
{
    // The primary key
    protected $primaryKey = "id";
    
    // The table for this model
    protected $table = "person_address";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'person_id',
        'address_id',
        'is_primary',
        'updated_by'
    );
    
    public function Person()
    {
        return $this->belongsTo('FSS\Models\Person');
    }
    
    public function Address()
    {
        return $this->belongsTo('FSS\Models\Address');
    }
}
