<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class EthnicitySchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "ethnicitys";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Ethnicity $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Ethnicity $model */
        return [
            'name' => $model->name,
            'updated_by' => $model->updated_by
        ];
    }
}
