<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CounseleeSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "counselees";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Counselee $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Counselee $model */
        return [
            'has_been_abused' => $model->has_been_abused,
            'abused_by_whom' => $model->abused_by_whom,
            'abused_count' => $model->abused_count,
            'serious_problems_in_family' => $model->serious_problems_in_family,
            'serious_family_problems_desc' => $model->serious_family_problems_desc,
            'alcohol_problem' => $model->alcohol_problem,
            'had_black_out' => $model->had_black_out,
            'black_out_location' => $model->black_out_location,
            'black_out_date' => $model->black_out_date,
            'family_drug_alcohol_problem' => $model->family_drug_alcohol_problem,
            'family_drug_problem_other_detail' => $model->family_drug_problem_other_detail,
            'current_harm_self' => $model->current_harm_self,
            'past_harm_self' => $model->past_harm_self,
            'current_harm_others' => $model->current_harm_others,
            'past_harm_others' => $model->past_harm_others,
            'current_harm_self_example' => $model->current_harm_self_example,
            'past_harm_self_example' => $model->past_harm_self_example,
            'current_harm_others_example' => $model->current_harm_others_example,
            'past_harm_others_example' => $model->past_harm_others_example,
            'had_previous_counseling' => $model->had_previous_counseling,
            'previous_counseling_where' => $model->previous_counseling_where,
            'previous_counseling_when' => $model->previous_counseling_when,
            'currently_in_counseling' => $model->currently_in_counseling,
            'current_counselor' => $model->current_counselor,
            'updated_by' => $model->updated_by
        ];
    }
}
