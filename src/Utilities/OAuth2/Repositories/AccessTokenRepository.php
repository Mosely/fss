<?php
namespace FSS\Utilities\OAuth2\Repositories;

use \League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use \League\OAuth2\Server\Entities\ClientEntityInterface;
use \League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        
    }

    public function revokeAccessToken($tokenId)
    {
        
    }

    public function getNewToken(
        ClientEntityInterface $clientEntity, 
        array $scopes, 
        $userIdentifier = null) : AccessTokenEntityInterface
    {
        
    }

    public function isAccessTokenRevoked($tokenId) : bool
    {
        
    }

    
}

