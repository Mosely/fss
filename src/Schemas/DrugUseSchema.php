<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class DrugUseSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "druguses";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var DrugUse $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var DrugUse $model */
        return [
            'type' => $model->type,
            'updated_by' => $model->updated_by
        ];
    }
}
