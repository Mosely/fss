<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class ReportSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "Report";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Report $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Report $model */
        return [
            'name' => $model->name,
            'type' => $model->type,
            'updated_by' => $model->updated_by
        ];
    }
}
