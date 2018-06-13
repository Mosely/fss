<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CountyDataSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "countydatas";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var CountyData $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var CountyData $model */
        return [
            'name' => $model->name,
            'updated_by' => $model->updated_by
        ];
    }
}