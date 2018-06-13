<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class PersonPhoneSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "PersonPhone";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var PersonPhone $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var PersonPhone $model */
        return [
            'person_id' => $model->person_id,
            'phone_id' => $model->phone_id,
            'is_primary' => $model->is_primary,
            'can_call' => $model->can_call,
            'updated_by' => $model->updated_by
        ];
    }
}
