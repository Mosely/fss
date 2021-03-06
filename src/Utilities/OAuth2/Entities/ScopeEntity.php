<?php
namespace FSS\Utilities\OAuth2\Entities;

use League\OAuth2\Server\Entities\ScopeEntityInterface;

class ScopeEntity implements ScopeEntityInterface
{
    use \League\OAuth2\Server\Entities\Traits\EntityTrait;
    
    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->getIdentifier();
    }

}