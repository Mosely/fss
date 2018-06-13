<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class GenderSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "genders";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Gender $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Gender $model */
        return [
            'name' => $model->name,
            'updated_by' => $model->updated_by
        ];
    }
}
