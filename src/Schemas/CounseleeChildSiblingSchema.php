<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CounseleeChildSiblingSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "counseleechildsiblings";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var CounseleeChildSibling $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var CounseleeChildSibling $model */
        return [
            'counselee_child_id' => $model->counselee_child_id,
            'type' => $model->type,
            'gender_id' => $model->gender_id,
            'age' => $model->age,
            'relationship_desc' => $model->relationship_desc,
            'is_dead' => $model->is_dead,
            'age_at_death' => $model->age_at_death,
            'updated_by' => $model->updated_by
        ];
    }
}
