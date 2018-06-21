<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CityDataSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "citydata";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var CityData $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var CityData $model */
        return [
            'name' => $model->name,
            'updated_by' => $model->updated_by
        ];
    }
}
