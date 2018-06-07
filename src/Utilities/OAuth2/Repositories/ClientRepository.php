<?php
namespace FSS\Utilities\OAuth2\Repositories;

use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;

class ClientRepository implements ClientRepositoryInterface
{
    public function getClientEntity(
        $clientIdentifier, 
        $grantType = null, 
        $clientSecret = null, 
        $mustValidateSecret = true) : ClientEntityInterface
    {
        
    }

    
}