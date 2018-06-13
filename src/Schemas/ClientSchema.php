<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class ClientSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "Client";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Client $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Client $model */
        return [
            'social_security_number' => $model->social_security_number,
            'place_of_employment' => $model->place_of_employment,
            'is_service_member_or_veteran' => $model->is_service_member_or_veteran,
            'has_family_who_is_service_member_or_veteran' => $model->has_family_who_is_service_member_or_veteran,
            'is_referred_by_veteran_resource_center' => $model->is_referred_by_veteran_resource_center,
            'referral' => $model->referral,
            'updated_by' => $model->updated_by
        ];
    }
}
