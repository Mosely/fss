<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class MilitaryDischargeTypeSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "militarydischargetypes";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var MilitaryDischargeType $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var MilitaryDischargeType $model */
        return [
            'name' => $model->name,
            'updated_by' => $model->updated_by
        ];
    }
}
