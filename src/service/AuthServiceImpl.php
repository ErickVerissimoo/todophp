<?php
namespace Erick\Todo\service;
require __DIR__ . '/../../vendor/autoload.php';

use Erick\Todo\entities\User;
use Erick\Todo\mapper\UserMapper;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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
    public function login(array $dados):string {
      $email = $dados['email'];
        $user = $this->auth->get(email:$email, id:null);
        if(!password_verify($dados['password'], $user->getPassword())) {
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

    function validateToken(string $token) : bool {
      return  JWT::decode($token,         new Key($token, algorithm: 'HS256'))!==null ;
    }

}