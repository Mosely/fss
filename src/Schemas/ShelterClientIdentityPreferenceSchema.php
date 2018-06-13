<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class ShelterClientIdentityPreferenceSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "ShelterClientIdentityPreference";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var ShelterClientIdentityPreference $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var ShelterClientIdentityPreference $model */
        return [
            'shelter_client_id' => $model->shelter_client_id,
            'identity_preference_id' => $model->identity_preference_id,
            'updated_by' => $model->updated_by
        ];
    }
}
