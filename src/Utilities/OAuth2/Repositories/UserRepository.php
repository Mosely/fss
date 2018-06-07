<?php
namespace FSS\Utilities\OAuth2\Repositories;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

use FSS\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getUserEntityByUserCredentials(
        $username, 
        $password, 
        $grantType, 
        ClientEntityInterface $clientEntity) : UserEntityInterface
    {
        $userData = [];
        $userData["username"] = $username;
        $userData["password"] = $password;
        
        //$id = User::authenticate($userData, 
        //    $this->logger, 
        //    new Cache($c),
        //    $this->db, 
        //    'user');
        
    }

    
}