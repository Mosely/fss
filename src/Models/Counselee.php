<?php
namespace FSS\Models;


/**
 * The "counselee" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="Counselee",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="has_been_abused", type="boolean", required=true),
 *         @SWG\Property(name="abused_by_whom", type="string", required=true),
 *         @SWG\Property(name="abused_count", type="integer", required=true),
 *         @SWG\Property(name="serious_problems_in_family", type="boolean", required=true),
 *         @SWG\Property(name="serious_family_problems_desc", type="string", required=false),
 *         @SWG\Property(name="alcohol_problem", type="boolean", required=true),
 *         @SWG\Property(name="had_black_out", type="boolean", required=true),
 *         @SWG\Property(name="black_out_location", type="string", required=false),
 *         @SWG\Property(name="black_out_date", type="string", required=true),
 *         @SWG\Property(name="family_drug_alcohol_problem", type="string", required=true),
 *         @SWG\Property(name="famil_drug_problem_other_detail", type="string", required=false),
 *         @SWG\Property(name="current_harm_self", type="boolean", required=true),
 *         @SWG\Property(name="past_harm_self", type="boolean", required=true),
 *         @SWG\Property(name="current_harm_others", type="boolean", required=true),
 *         @SWG\Property(name="past_harm_others", type="boolean", required=true),
 *         @SWG\Property(name="current_harm_self_example", type="string", required=true),
 *         @SWG\Property(name="past_harm_self_example", type="string", required=true),
 *         @SWG\Property(name="past_harm_others_example", type="string", required=true),
 *         @SWG\Property(name="had_previous_counseling", type="boolean", required=true),
 *         @SWG\Property(name="previous_counseling_where", type="integer", required=true),
 *         @SWG\Property(name="previous_counseling_when", type="string", required=true),
 *         @SWG\Property(name="currently_in_counseling", type="boolean", required=true),
 *         @SWG\Property(name="current_counselor", type="string", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class Counselee extends AbstractModel
{

    protected $table = "counselee";

    protected $primaryKey = "id";

    protected $fillable = array(
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
        'current_counselor',
        'updated_by'
    );

    public function CounseleeCounselingTopic()
    {
        return $this->hasMany('FSS\Models\CounseleeCounselingTopic');
    }

    public function CounseleeDrugUse()
    {
        return $this->hasMany('FSS\Models\CounseleeDrugUse');
    }

    public function CounseleeMedication()
    {
        return $this->hasMany('FSS\Models\CounseleeMedication');
    }

    public function CounseleeChild()
    {
        return $this->hasOne('FSS\Models\CounseleeChild');
    }
}
