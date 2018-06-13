<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class IdentityPreferenceSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "IdentityPreference";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var IdentityPreference $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var IdentityPreference $model */
        return [
            'name' => $model->name,
            'description' => $model->description,
            'updated_by' => $model->updated_by
        ];
    }
}
