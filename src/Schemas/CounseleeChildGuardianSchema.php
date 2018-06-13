<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CounseleeChildGuardianSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "CounseleeChildGuardian";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var CounseleeChildGuardian $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var CounseleeChildGuardian $model */
        return [
            'counselee_child_id' => $model->counselee_child_id,
            'name' => $model->name,
            'age' => $model->age,
            'occupation' => $model->occupation,
            'is_currently_living_with_child' => $model->is_currently_living_with_child,
            'date_first_lived_with_child' => $model->date_first_lived_with_child,
            'updated_by' => $model->updated_by
        ];
    }
}
