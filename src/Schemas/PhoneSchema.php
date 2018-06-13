<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class PhoneSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "phones";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Phone $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Phone $model */
        return [
            'area_code' => $model->area_code,
            'phone_number' => $model->phone_number,
            'extension' => $model->extension,
            'phone_type' => $model->phone_type,
            'updated_by' => $model->updated_by
        ];
    }
}
