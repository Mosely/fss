<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class FundingSourceSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "FundingSource";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var FundingSource $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var FundingSource $model */
        return [
            'name' => $model->name,
            'description' => $model->description,
            'updated_by' => $model->updated_by
        ];
    }
}
