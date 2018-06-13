<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class StateDataSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "StateData";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var StateData $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var StateData $model */
        return [
            'name' => $model->name,
            'state_code' => $model->state_code,
            'updated_by' => $model->updated_by
        ];
    }
}
