<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class AddressSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "addresses";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Address $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Address $model */
        return [
            'street_number' => $model->street_number,
            'street_name' => $model->street_name,
            'street_suffix' => $model->street_suffix,
            'zipcode' => $model->zipcode,
            'zipcode_plus_four' => $model->zipcode_plus_four,
            'city_data_id' => $model->city_data_id,
            'state_data_id' => $model->state_data_id,
            'county_data_id' => $model->county_data_id,
            'apartment_number' => $model->apartment_number,
            'updated_by' => $model->updated_by
        ];
    }
}
