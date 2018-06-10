<?php
namespace FSS\Utilities\OAuth2\Entities;

use League\OAuth2\Server\Entities\UserEntityInterface;

class UserEntity implements UserEntityInterface
{
    use \League\OAuth2\Server\Entities\Traits\EntityTrait;

}