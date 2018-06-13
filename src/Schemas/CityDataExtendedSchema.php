<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CityDataExtendedSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "CityDataExtended";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var CityDataExtended $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var CityDataExtended $model */
        return [
            'city' => $model->city,
            'state_code' => $model->state_code,
            'zip' => $model->zip,
            'latitude' => $model->latitude,
            'longitude' => $model->longitude,
            'county' => $model->county,
            'updated_by' => $model->updated_by
        ];
    }
}
