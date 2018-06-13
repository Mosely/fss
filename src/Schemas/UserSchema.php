<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class UserSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "users";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var User $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var User $model */
        return [
            'username' => $model->username,
            'email' => $model->email,
            'password_created_at' => $model->password_created_at,
            'is_disabled' => $model->is_disabled,
            'updated_by' => $model->updated_by
        ];
    }
}
