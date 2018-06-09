<?php
namespace FSS\Utilities\OAuth2\Repositories;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

use FSS\Models\User;
use FSS\Utilities\OAuth2\Entities\UserEntity;

class UserRepository implements UserRepositoryInterface
{
    public function getUserEntityByUserCredentials(
        $username, 
        $password, 
        $grantType = null, 
        ClientEntityInterface $clientEntity = null) : UserEntityInterface
    {
        $userData = [];
        $userData["username"] = $username;
        $userData["password"] = $password;
        
        $user = null;
        if($grantType == "password" && 
            (is_null($clientEntity) || 
                $clientEntity->getIdentifier() == getenv('CLIENT_IDENTIFIER'))) {
            try {
                $id   = User::authenticate($userData);
                $user = new UserEntity();
                $user->setIdentifier($id);
            } catch (\Exception $e){
                $user = null;
            }
        }
        return $user;
    }
}