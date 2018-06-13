<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class ShelterClientAdditionalStaffSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "ShelterClientAdditionalStaff";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var ShelterClientAdditionalStaff $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var ShelterClientAdditionalStaff $model */
        return [
            'shelter_client_id' => $model->shelter_client_id,
            'user_id' => $model->user_id,
            'updated_by' => $model->updated_by
        ];
    }
}
