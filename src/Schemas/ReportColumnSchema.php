<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class ReportColumnSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "reportcolumns";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var ReportColumn $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var ReportColumn $model */
        return [
            'report_id' => $model->report_id,
            'header' => $model->header,
            'table_name' => $model->table_name,
            'column_name' => $model->column_name,
            'column_order' => $model->column_order,
            'width' => $model->width,
            'updated_by' => $model->updated_by
        ];
    }
}
