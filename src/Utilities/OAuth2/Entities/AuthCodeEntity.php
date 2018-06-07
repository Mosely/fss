<?php
namespace FSS\Utilities\OAuth2\Entities;

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;

class AuthCodeEntity implements AuthCodeEntityInterface
{
    use \League\OAuth2\Server\Entities\Traits\EntityTrait;
    use \League\OAuth2\Server\Entities\Traits\TokenEntityTrait;
    use \League\OAuth2\Server\Entities\Traits\AuthCodeTrait;
    
}