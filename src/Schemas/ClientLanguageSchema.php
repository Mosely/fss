<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class ClientLanguageSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "clientlanguages";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var ClientLanguage $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var ClientLanguage $model */
        return [
            'client_id' => $model->client_id,
            'language_id' => $model->language_id,
            'is_primary' => $model->is_primary,
            'other_note' => $model->other_note,
            'updated_by' => $model->updated_by
        ];
    }
}
