<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class UserRoleSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "userroles";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var UserRole $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var UserRole $model */
        return [
            'user_id' => $model->user_id,
            'role_id' => $model->role_id,
            'updated_by' => $model->updated_by
        ];
    }
}
