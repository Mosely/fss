<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class PersonAddressSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "PersonAddress";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var PersonAddress $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var PersonAddress $model */
        return [
            'person_id' => $model->person_id,
            'address_id' => $model->address_id,
            'is_primary' => $model->is_primary,
            'updated_by' => $model->updated_by
        ];
    }
}
