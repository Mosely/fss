<?php
namespace FSS\Utilities\OAuth2\Repositories;

use FSS\Utilities\OAuth2\Entities\ClientEntity;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;

class ClientRepository implements ClientRepositoryInterface
{

    public function getClientEntity(string $clientIdentifier,
        string $grantType = null, string $clientSecret = null,
        bool $mustValidateSecret = true): ClientEntityInterface
    {
        //TODO Remember to update the .env file with below info
        $clients = [
            // 'fssfrontend' => [
            getenv('CLIENT_IDENTIFIER') => [
                // 'secret' => password_hash('abc123', PASSWORD_BCRYPT),
                // 'name' => 'My Awesome App',
                // 'redirect_uri' => 'http://foo/bar',
                // 'is_confidential' => true,
                'secret' => getenv('CLIENT_SECRET'),
                'name' => getenv('CLIENT_NAME'),
                'redirect_uri' => getenv('CLIENT_REDIRECT_URI'),
                'is_confidential' => getenv('CLIENT_IS_CONFIDENTIAL')
            ]
        ];
        // Check if client is registered
        if (array_key_exists($clientIdentifier, $clients) === false) {
            return;
        }
        if ($mustValidateSecret === true &&
            $clients[$clientIdentifier]['is_confidential'] === true &&
            password_verify($clientSecret,
            $clients[$clientIdentifier]['secret']) === false) {
            return;
        }
        $client = new ClientEntity();
        $client->setIdentifier($clientIdentifier);
        $client->name = $clients[$clientIdentifier]['name'];
        $client->redirectUri = $clients[$clientIdentifier]['redirect_uri'];
        return $client;
    }

    
}