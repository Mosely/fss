<?php
namespace FSS\Models;

/**
 * The "user_view" model.
 *
 * @author Dewayne
 *        
 */
class User_view extends AbstractModel
{

    // The table for this model
    protected $table = "user_view";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'id',
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
