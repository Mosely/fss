<?php 

namespace FSS\Utilities;

use \Firebase\JWT\JWT;

class Token
{
    public function generate($userId) {
        $now    = new \DateTime();
        $future = new \DateTime(getenv('JWT_EXPIRATION'));

        $jti = base64_encode(mcrypt_create_iv(32));
        $payload = [
            'iat' => $now->getTimeStamp(),
            'exp' => $future->getTimeStamp(),
            'jti' => $jti,
            'sub' => $userId,
        ];

        $token           = JWT::encode($payload, getenv('JWT_SECRET'), getenv('JWT_ALGORITHM'));
        $data['token']   = $token;
        //$data["expires"] = $future->getTimeStamp();
        $data['expires'] = $payload['exp'];
        return $data;
    }
    
    public function verify($token, $userId) {
        $payload = Token::decode($token);
        if($payload['sub'] != $userId) {
            throw new \Exception("This token does not match the user.");
        }
    }
    
    private function decode($token) {
        WT::$leeway = 60; // $leeway in seconds
        $decoded    = JWT::decode($token, getenv('JWT_SECRET'), array(getenv('JWT_ALGORITHM')));
        return (array)$decoded;
    }
    
}