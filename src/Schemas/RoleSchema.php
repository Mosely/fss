<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class RoleSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "Role";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Role $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Role $model */
        return [
            'name' => $model->name,
            'updated_by' => $model->updated_by
        ];
    }
}
