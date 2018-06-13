<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class ShelterClientSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "ShelterClient";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var ShelterClient $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var ShelterClient $model */
        return [
            'used_form_assistance' => $model->used_form_assistance,
            'assistant_name' => $model->assistant_name,
            'assistant_relationship' => $model->assistant_relationship,
            'is_rural' => $model->is_rural,
            'is_urban' => $model->is_urban,
            'has_tanf_form' => $model->has_tanf_form,
            'advocate_user_id' => $model->advocate_user_id,
            'enter_date' => $model->enter_date,
            'exit_date' => $model->exit_date,
            'notes' => $model->notes,
            'updated_by' => $model->updated_by
        ];
    }
}
