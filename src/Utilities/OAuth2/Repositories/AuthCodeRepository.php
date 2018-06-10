<?php
namespace FSS\Utilities\OAuth2\Repositories;

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

class AuthCodeRepository implements AuthCodeRepositoryInterface
{
    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity)
    {}

    public function getNewAuthCode() : AuthCodeEntityInterface
    {}

    public function revokeAuthCode($codeId)
    {}

    public function isAuthCodeRevoked($codeId) : bool
    {}

    
}