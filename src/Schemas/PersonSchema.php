<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class PersonSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "Person";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Person $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Person $model */
        return [
            'first_name' => $model->first_name,
            'last_name' => $model->last_name,
            'middle_name' => $model->middle_name,
            'date_of_birth' => $model->date_of_birth,
            'age' => $model->age,
            'gender_id' => $model->gender_id,
            'updated_by' => $model->updated_by
        ];
    }
}
