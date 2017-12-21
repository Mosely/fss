<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;
/**
 * The "client_language" model.
 *
 * @author Dewayne
 * 
 * @SWG\Model(
 *     id="client_language",
 *     @SWG\Property(name="id", type="integer", required=true),
 *     @SWG\Property(name="client_id", type="integer", required=true),
 *     @SWG\Property(name="language_id", type="integer", required=true),
 *     @SWG\Property(name="is_primary", type="integer", required=true),
 *     @SWG\Property(name="other_note", type="string", required=false),
 *     @SWG\Property(name="created_at", type="integer" required=true),
 *     @SWG\Property(name="updated_at", type="integer" required=true),
 *     @SWG\Property(name="updated_by", type="integer", required=true)
 * ) 
 */
class ClientLanguage extends AbstractModel
{

    // The table for this model
    protected $table = "client_language";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'client_id',
        'language_id',
        'is_primary',
        'other_note',
        'created_at',
        'updated_at',
        'updated_by'
    );
    
    public function Client()
    {
        return $this->belongsTo('FSS\Models\Client');
    }

    public function Language()
    {
        return $this->belongsTo('FSS\Models\Language');
    }
}
