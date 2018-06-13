<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CounseleeMedicationSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "counseleemedications";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var CounseleeMedication $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var CounseleeMedication $model */
        return [
            'counselee_id' => $model->counselee_id,
            'medication_id' => $model->medication_id,
            'reason' => $model->reason,
            'updated_by' => $model->updated_by
        ];
    }
}
