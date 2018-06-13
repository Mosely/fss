<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class UserViewSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "UserView";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var UserView $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var UserView $model */
        return [
            'first_name' => $model->first_name,
            'last_name' => $model->last_name,
            'middle_name' => $model->middle_name,
            'date_of_birth' => $model->date_of_birth,
            'age' => $model->age,
            'gender_id' => $model->gender_id,
            'gender' => $model->gender,
            'username' => $model->username,
            'password' => $model->password,
            'password_created_at' => $model->password_created_at,
            'is_disabled' => $model->is_disabled
        ];
    }
}
