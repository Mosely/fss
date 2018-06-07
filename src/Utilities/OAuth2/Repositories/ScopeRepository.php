<?php
namespace FSS\Utilities\OAuth2\Repositories;

use \League\OAuth2\Server\Entities\ClientEntityInterface;
use \League\OAuth2\Server\Entities\ScopeEntityInterface;
use \League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

class ScopeRepository implements ScopeRepositoryInterface
{
    public function finalizeScopes(
        array $scopes, 
        $grantType, 
        ClientEntityInterface $clientEntity, 
        $userIdentifier = null) : array
    {
        
    }

    public function getScopeEntityByIdentifier($identifier) : ScopeEntityInterface
    {
        
    }
}