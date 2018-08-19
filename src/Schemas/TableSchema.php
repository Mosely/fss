<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class TableSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "tables";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Table $model */
        return $model->Tables_in_fss;
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Table $model */
        return [
            'Tables_in_fss' => $model->Tables_in_fss
        ];
    }
}