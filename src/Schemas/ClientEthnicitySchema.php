<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class ClientEthnicitySchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "clientethnicitys";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var ClientEthnicity $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var ClientEthnicity $model */
        return [
            'client_id' => $model->client_id,
            'ethnicity_id' => $model->ethnicity_id,
            'updated_by' => $model->updated_by
        ];
    }
}
