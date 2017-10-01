<?php
namespace FSS\Models;

/**
 * The "user_view" model.
 *
 * @author Dewayne
 *        
 */
class UserView extends AbstractModel
{

    // The table for this model
    protected $table = "user_view";

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
