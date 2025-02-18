<?php

namespace Erick\Todo;
require __DIR__ . '/../vendor/autoload.php';

use Exception;
use Medoo\Medoo;
use stdClass;

use function PHPUnit\Framework\isNull;

class UserMapper
{
    private readonly Medoo $medoo;
    
    public function __construct(Medoo $medoo){
        $this->medoo = $medoo;
    }
    public function findById(int $id): User{
        $user = $this->medoo->get(table:'user', where: ['id' => $id]);
        
        return  isset($user) ? $user : throw new Exception('user not founded');
    }
public function register(User $user):void{
$hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);

$this->medoo->insert('user', ['name' => $user->getName(), 
'email'=> $user->getEmail(), 'password' => $hash ]);}


public function update(User $user):void{
    $this->medoo->update('tarefa', ['name' => $user->getName(), 
    'email'=> $user->getEmail()], ['id'=> $user->getId()]);

}
public function delete(int $id):void{

$this ->medoo->delete('user', ['id'=> $id]);


}

public function findAllTasksByUser(?string $email, ?int $id):array{
if($email === null && $id===null){ 
throw new Exception('both email and id cannot be null');
}

return $this->medoo->select(
    'tarefa',
    [
        '[><]user' => ['user_id' => 'id']
    ],
    ['tarefa.*'],
    [
        'OR' => [
            'user.id'    => $id,
            'user.email' => $email
        ]
    ]
);


}

}