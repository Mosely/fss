<?php
namespace FSS\Models;

/**
 * The "counselee_counseling_topic" model.
 *
 * @author Dewayne
 *        
 */
class Counselee_counseling_topic extends AbstractModel
{

    // The table for this model
    protected $table = "counselee_counseling_topic";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'counselee_id',
        'counseling_topic_id',
        'other_note',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
