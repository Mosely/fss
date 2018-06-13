<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class RoleTableAccessSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "RoleTableAccess";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var RoleTableAccess $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var RoleTableAccess $model */
        return [
            'role_id' => $model->role_id,
            'table_name' => $model->table_name,
            'updated_by' => $model->updated_by
        ];
    }
}
