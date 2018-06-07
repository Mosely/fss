<?php
namespace FSS\Utilities\OAuth2\Entities;

use \League\OAuth2\Server\Entities\AccessTokenEntityInterface;

class AccessTokenEntity implements AccessTokenEntityInterface
{
    use \League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
    use \League\OAuth2\Server\Entities\Traits\EntityTrait;
    use \League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

}