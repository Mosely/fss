<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class ShelterClientFundingSourceSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "shelterclientfundingsources";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var ShelterClientFundingSource $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var ShelterClientFundingSource $model */
        return [
            'shelter_client_id' => $model->shelter_client_id,
            'funding_source_id' => $model->funding_source_id,
            'updated_by' => $model->updated_by
        ];
    }
}
