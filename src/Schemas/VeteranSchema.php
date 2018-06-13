<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class VeteranSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "Veteran";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var Veteran $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var Veteran $model */
        return [
            'referred_by' => $model->referred_by,
            'branch_of_service_id' => $model->branch_of_service_id,
            'military_discharge_type_id' => $model->military_discharge_type_id,
            'has_dd214' => $model->has_dd214,
            'is_registered_with_va' => $model->is_registered_with_va,
            'va_id' => $model->va_id,
            'job_title' => $model->job_title,
            'is_on_disability' => $model->is_on_disability,
            'is_homeless' => $model->is_homeless,
            'household_income' => $model->household_income,
            'updated_by' => $model->updated_by
        ];
    }
}
