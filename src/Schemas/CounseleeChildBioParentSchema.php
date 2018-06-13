<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CounseleeChildBioParentSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "counseleechildbioparents";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var CounseleeChildBioParent $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var CounseleeChildBioParent $model */
        return [
            'counselee_child_id' => $model->counselee_child_id,
            'type' => $model->type,
            'name' => $model->name,
            'age' => $model->age,
            'occupation' => $model->occupation,
            'health_problems' => $model->health_problems,
            'is_deceased' => $model->is_deceased,
            'age_at_death' => $model->age_at_death,
            'child_age_when_bio_died' => $model->child_age_when_bio_died,
            'cause_of_death' => $model->cause_of_death,
            'updated_by' => $model->updated_by
        ];
    }
}
