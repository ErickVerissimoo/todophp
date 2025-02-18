<?php

namespace Erick\Todo;
require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
class AuthServiceImpl implements AuthService
{
    private  $jwt;

    public function __construct() {
        $this->jwt = include 'JwtService.php';        
    }    /**
     * @inheritDoc
     */
    public function login(User $user):string {
        $payload = [
            
                "sub"=> $user->getEmail(),
                "name"=> $user->getName(),
                "iat"=> time(),
                "exp"=> time() + 60*60*60*60,
        ];
        return JWT::encode($payload, $this->jwt, 'HS256');
    }
    
    /**
     * @inheritDoc
     */
    public function register(User $user) {
    }
}