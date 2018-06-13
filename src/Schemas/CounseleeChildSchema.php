<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CounseleeChildSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "counseleechilds";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var CounseleeChild $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var CounseleeChild $model */
        return [
            'school_id' => $model->school_id,
            'school_problems' => $model->school_problems,
            'long_standing_illnesses' => $model->long_standing_illnesses,
            'who_else_raised_child' => $model->who_else_raised_child,
            'updated_by' => $model->updated_by
        ];
    }
}
