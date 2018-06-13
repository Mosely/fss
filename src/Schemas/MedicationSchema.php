<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class MedicationSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "Medication";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Medication $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Medication $model */
        return [
            'name' => $model->name,
            'updated_by' => $model->updated_by
        ];
    }
}
