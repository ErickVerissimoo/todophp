<?php
namespace Erick\Todo\service;
require __DIR__ . '/../../vendor/autoload.php';

use Erick\Todo\entities\User;
use Erick\Todo\mapper\UserMapper;
use Exception;
use Firebase\JWT\JWT;
class AuthServiceImpl implements AuthService
{
    private string $jwt;
    private UserMapper $auth;
    public function __construct(UserMapper $mapper) {
        $this->jwt = include 'src/utils/JwtService.php';
        $this->auth = $mapper;        
    }    /**
     * @inheritDoc
     */
    public function login(User $usuario):string {
      $email = $usuario->getEmail();
        $user = $this->auth->get(email:$email, id:$usuario->getId());
        if(!password_verify($usuario->getPassword(), $user->getPassword())) {
            throw new Exception('Email ou senha inválidos');
        }

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
        if($this->auth->exists($user ->getEmail())){
            throw new Exception('entity already exists');
        }
        $this->auth->insert($user);
        return $user;
    }
}