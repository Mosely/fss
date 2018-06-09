<?php
namespace FSS\Utilities\OAuth2\Repositories;

use FSS\Utilities\OAuth2\Entities\ClientEntity;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;

class ClientRepository implements ClientRepositoryInterface
{

    public function getClientEntity($clientIdentifier,
        $grantType = null, $clientSecret = null,
        $mustValidateSecret = true): ClientEntityInterface
    {
        //TODO Remember to update the .env file with below info
        $clientIdFromConf = getenv('CLIENT_IDENTIFIER');
        $clientSecretFromConf = getenv('CLIENT_SECRET');
        $clientNameFromConf = getenv('CLIENT_NAME');
        $clientRedirectUriFromConf = getenv('CLIENT_REDIRECT_URI');
        $clientIsConfidentialFromConf = filter_var(
            getenv('CLIENT_IS_CONFIDENTIAL'), FILTER_VALIDATE_BOOLEAN);
        //$clients = [
            // 'fssfrontend' => [
        //    getenv('CLIENT_IDENTIFIER') => [
                // 'secret' => password_hash('abc123', PASSWORD_BCRYPT),
                // 'name' => 'My Awesome App',
                // 'redirect_uri' => 'http://foo/bar',
                // 'is_confidential' => true,
        //        'secret' => getenv('CLIENT_SECRET'),
        //        'name' => getenv('CLIENT_NAME'),
        //        'redirect_uri' => getenv('CLIENT_REDIRECT_URI'),
        //        'is_confidential' => filter_var(
        //getenv('CLIENT_IS_CONFIDENTIAL'), FILTER_VALIDATE_BOOLEAN)
        //    ]
        //];
        // Check if client is registered
        $clientIdentifier != $clientIdFromConf;
        if ($clientIdentifier != $clientIdFromConf) {
            return null;
        }
        //if ($mustValidateSecret === true &&
        //    $clientIsConfidentialFromConf === true &&
        //    password_verify($clientSecret,
        //        $clientSecretFromConf) === false) {
        //    return null;
        //}
        if ($mustValidateSecret === true &&
            $clientIsConfidentialFromConf === true &&
            $clientSecret != $clientSecretFromConf) {
                return null;
        }
        
        $client = new ClientEntity();
        $client->setIdentifier($clientIdentifier);
        $client->name = $clientNameFromConf;
        $client->redirectUri = $clientRedirectUriFromConf;
        return $client;
    }

    
}