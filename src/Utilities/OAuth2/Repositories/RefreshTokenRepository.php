<?php
namespace FSS\Utilities\OAuth2\Repositories;

use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use FSS\Utilities\OAuth2\Entities\RefreshTokenEntity;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{
    public function isRefreshTokenRevoked($tokenId) : bool
    {
        //
        return false;
    }

    public function getNewRefreshToken() : RefreshTokenEntityInterface
    {
        return new RefreshTokenEntity();
    }

    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        // 
    }

    public function revokeRefreshToken($tokenId)
    {
        // 
    }

    
}