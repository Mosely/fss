<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class CounselingTopicSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "counselingtopics";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var CounselingTopic $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var CounselingTopic $model */
        return [
            'topic' => $model->topic,
            'description' => $model->description,
            'updated_by' => $model->updated_by
        ];
    }
}
