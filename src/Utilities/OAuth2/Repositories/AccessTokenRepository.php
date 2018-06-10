<?php
namespace FSS\Utilities\OAuth2\Repositories;

use FSS\Utilities\OAuth2\Entities\AccessTokenEntity;
use \League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use \League\OAuth2\Server\Entities\ClientEntityInterface;
use \League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        // 
    }

    public function revokeAccessToken($tokenId)
    {
        // 
    }

    public function getNewToken(
        ClientEntityInterface $clientEntity, 
        array $scopes, 
        $userIdentifier = null) : AccessTokenEntityInterface
    {
        $accessToken = new AccessTokenEntity();
        $accessToken->setClient($clientEntity);
        foreach ($scopes as $scope) {
            $accessToken->addScope($scope);
        }
        $accessToken->setUserIdentifier($userIdentifier);
        
        return $accessToken;
    }

    public function isAccessTokenRevoked($tokenId) : bool
    {
        // 
        return false;
    }

    
}

