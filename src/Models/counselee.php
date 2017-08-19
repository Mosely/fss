<?php
namespace FSS\Models;

/**
 * The "counselee" model.
 *
 * @author Dewayne
 *        
 */
class Counselee extends AbstractModel
{

    // The table for this model
    protected $table = "counselee";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'id',
        'has_been_abused',
        'abused_by_whom',
        'abused_count',
        'serious_problems_in_family',
        'serious_family_problems_desc',
        'alcohol_problem',
        'had_black_out',
        'black_out_location',
        'black_out_date',
        'family_drug_alcohol_problem',
        'family_drug_problem_other_detail',
        'current_harm_self',
        'past_harm_self',
        'current_harm_others',
        'past_harm_others',
        'current_harm_self_example',
        'past_harm_self_example',
        'current_harm_others_example',
        'past_harm_others_example',
        'had_previous_counseling',
        'previous_counseling_where',
        'previous_counseling_when',
        'currently_in_counseling',
        'current_counselor'
    );
}
