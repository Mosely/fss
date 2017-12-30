<?php
namespace FSS\Models;

use Swagger\Annotations as SWG;

/**
 * The "user_view" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="UserView",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="first_name", type="string", required=true),
 *         @SWG\Property(name="last_name", type="string", required=true),
 *         @SWG\Property(name="middle_name", type="string", required=false),
 *         @SWG\Property(name="date_of_birth", type="string", required=true),
 *         @SWG\Property(name="age", type="integer", required=false),
 *         @SWG\Property(name="gender_id", type="integer", required=true),
 *         @SWG\Property(name="gender", type="string", required=true),
 *         @SWG\Property(name="middle_name", type="string", required=false),
 *         @SWG\Property(name="username", type="string", required=true),
 *         @SWG\Property(name="password", type="string", required=true),
 *         @SWG\Property(name="password_created_at", type="integer", required=true),
 *         @SWG\Property(name="is_disabled", type="boolean", required=true)
 *         )
 */
class UserView extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "user_view";

    protected $fillable = array(
        'first_name',
        'last_name',
        'middle_name',
        'date_of_birth',
        'age',
        'gender_id',
        'gender',
        'username',
        'password',
        'password_created_at',
        'is_disabled'
    );

    // There's no need to return these five
    // columns with every request. Going to
    // override the $hidden from AbstractModel
    protected $hidden = [
        'created_at',
        'updated_at',
        'updated_by',
        'password',
        'password_created_at'
    ];

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'first_name',
        'last_name',
        'middle_name',
        'date_of_birth',
        'age',
        'gender_id',
        'gender',
        'username',
        'password',
        'password_created_at',
        'is_disabled'
    );
}
