<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CounseleeCounselingTopicSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "CounseleeCounselingTopic";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var CounseleeCounselingTopic $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var CounseleeCounselingTopic $model */
        return [
            'counselee_id' => $model->counselee_id,
            'counseling_topic_id' => $model->counseling_topic_id,
            'other_note' => $model->other_note,
            'updated_by' => $model->updated_by
        ];
    }
}
