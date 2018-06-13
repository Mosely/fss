<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CounseleeDrugUseSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "counseleedruguses";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var CounseleeDrugUse $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var CounseleeDrugUse $model */
        return [
            'counselee_id' => $model->counselee_id,
            'drug_use_id' => $model->drug_use_id,
            'age_when_first_used' => $model->age_when_first_used,
            'updated_by' => $model->updated_by
        ];
    }
}
