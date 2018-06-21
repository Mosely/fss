<?php
namespace FSS\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class BranchOfServiceSchema extends BaseSchema {
    /**
     * @inheritdoc
     */
    protected $resourceType = "branchesofservice";
  
    /**
     * @inheritdoc
     */
    public function getId($model): ? string
    {
        /** @var BranchOfService $model */
        return $model->getKey();
    }
  
    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fieldKeysFilter = null): ? array
    {
        /** @var BranchOfService $model */
        return [
            'name' => $model->name,
            'updated_by' => $model->updated_by
        ];
    }
}
