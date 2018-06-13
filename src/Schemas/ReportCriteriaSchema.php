<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class ReportCriteriaSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "reportcriterias";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var ReportCriteria $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var ReportCriteria $model */
        return [
            'report_column_id' => $model->report_column_id,
            'relation' => $model->relation,
            'criteria_value' => $model->criteria_value,
            'is_hidden' => $model->is_hidden,
            'updated_by' => $model->updated_by
        ];
    }
}
