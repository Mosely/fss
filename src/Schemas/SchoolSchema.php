<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class SchoolSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "schools";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var School $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var School $model */
        return [
            'name' => $model->name,
            'city_data_id' => $model->city_data_id,
            'state_data_id' => $model->state_data_id,
            'street' => $model->street,
            'zipcode' => $model->zipcode,
            'zipcode_plus_four' => $model->zipcode_plus_four,
            'updated_by' => $model->updated_by
        ];
    }
}
