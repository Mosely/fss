<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class TableColumnSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "tablecolumns";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var TableColumn $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var TableColumn $model */
        return [
            'TABLE_COLUMN' => $model->TABLE_COLUMN
        ];
    }
}
