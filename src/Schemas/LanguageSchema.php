<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class LanguageSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "languages";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Language $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Language $model */
        return [
            'name' => $model->name,
            'updated_by' => $model->updated_by
        ];
    }
}
