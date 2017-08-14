<?php
namespace FSS\Models;

/**
 * The "counseling_topic" model.
 *
 * @author Dewayne
 *        
 */
class Counseling_topic extends AbstractModel
{

    // The table for this model
    protected $table = "counseling_topic";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'id',
        'topic',
        'description',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
