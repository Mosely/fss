<?php
namespace FSS\Models;


/**
 * The "person" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="Person",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="first_name", type="string", required=true),
 *         @SWG\Property(name="last_name", type="string", required=true),
 *         @SWG\Property(name="middle_name", type="string", required=false),
 *         @SWG\Property(name="date_of_birth", type="string", required=true),
 *         @SWG\Property(name="age", type="integer", required=false),
 *         @SWG\Property(name="gender_id", type="integer", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class Person extends AbstractModel
{

    protected $table = "person";

    protected $primaryKey = "id";

    protected $fillable = array(
        'first_name',
        'last_name',
        'middle_name',
        'date_of_birth',
        'age',
        'gender_id',
        'updated_by'
    );

    /**
     * Get the user that has this person.
     */
    public function User()
    {
        return $this->hasOne('FSS\Models\User', 'id', 'id');
        // NOTE: indicate both the foreign and
        // local keys for the one-to-one relationships
    }

    /**
     * Get the user that has this person.
     */
    public function Client()
    {
        return $this->hasOne('FSS\Models\Client', 'id', 'id');
        // NOTE: indicate both the foreign and
        // local keys for the one-to-one relationships
    }

    /**
     * Get the gender that has this person.
     */
    public function Gender()
    {
        return $this->belongsTo('FSS\Models\Gender');
    }

    public function PersonAddress()
    {
        return $this->hasMany('FSS\Models\PersonAddress');
    }

    public function PersonPhone()
    {
        return $this->hasMany('FSS\Models\PersonPhone');
    }
    // getters and setters if you want and other logic
}
