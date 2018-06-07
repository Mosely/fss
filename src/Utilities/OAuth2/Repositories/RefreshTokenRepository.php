<?php
namespace FSS\Utilities\OAuth2\Repositories;

use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{
    public function isRefreshTokenRevoked($tokenId) : bool
    {}

    public function getNewRefreshToken() : RefreshTokenEntityInterface
    {}

    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {}

    public function revokeRefreshToken($tokenId)
    {}

    
}