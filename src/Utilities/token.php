<?php
namespace FSS\Utilities;

use \Firebase\JWT\JWT;
use \Exception;
use \DateTime;

/**
 * The Token class provides functionality
 * to generate and verify JWT tokens.
 *
 * @author Dewayne
 *        
 */
class Token
{

    /**
     * Generates a JWT token and returns
     * an array containig the token and
     * expiry data.
     *
     * @param string $userId
     * @return array
     */
    public function generate(string $userId)
    {
        $now = new DateTime();
        $future = new DateTime(getenv('JWT_EXPIRATION'));
        
        $jti = base64_encode(mcrypt_create_iv(32));
        $payload = [
            'iat' => $now->getTimeStamp(),
            'exp' => $future->getTimeStamp(),
            'jti' => $jti,
            'sub' => $userId
        ];
        
        $token = JWT::encode($payload, getenv('JWT_SECRET'),
            getenv('JWT_ALGORITHM'));
        $data = [];
        $data['token'] = $token;
        // $data["expires"] = $future->getTimeStamp();
        $data['expires'] = $payload['exp'];
        return $data;
    }

    /**
     * Verifies the given token to see if
     * it matches the indicated user.
     *
     * @param string $token
     * @param string $userId
     * @throws Exception
     */
    public function verify(string $token, string $userId)
    {
        $payload = self::decode($token);
        if ($payload['sub'] != $userId) {
            throw new Exception("This token does not match the user.");
        }
    }

    /**
     * Decodes the given JWT token.
     *
     * @param string $token
     * @return array
     */
    private function decode(string $token)
    {
        JWT::$leeway = 60; // $leeway in seconds
        $decoded = JWT::decode($token, getenv('JWT_SECRET'),
            array(
                getenv('JWT_ALGORITHM')
            ));
        return (array) $decoded;
    }
}