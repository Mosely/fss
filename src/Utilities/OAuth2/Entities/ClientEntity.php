<?php
namespace FSS\Utilities\OAuth2\Entities;

use League\OAuth2\Server\Entities\ClientEntityInterface;

class ClientEntity implements ClientEntityInterface
{
    use \League\OAuth2\Server\Entities\Traits\ClientTrait;
    use \League\OAuth2\Server\Entities\Traits\EntityTrait;
    
    public function setName(string $name)
    {
        $this->name = $name;
    }
    
    public function setRedirectUri(string $redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }
}