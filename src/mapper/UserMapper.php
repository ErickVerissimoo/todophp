<?php

namespace Erick\Todo\mapper;
require __DIR__ . '/../../vendor/autoload.php';

use Erick\Todo\entities\User;
use Exception;
use Medoo\Medoo;
use stdClass;


class UserMapper
{
    private readonly Medoo $medoo;
    
    public function __construct(Medoo $medoo){
        $this->medoo = $medoo;
    }

    public function insert(User $user):void{
        $hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        
        $this->medoo->insert('usuario', ['name' => $user->getName(), 
        'email'=> $user->getEmail(), 'password' => $hash ] 
        
        );
        
        }

        public function get(?int $id , ?string $email): User {
            if ($id === null && $email === null) {
                throw new Exception('Both id and email cannot be null');
            }
        
            $filter = $email === null ? ['id' => $id] : ['email' => $email];
        
            $result = $this->medoo->get('usuario', ['id', 'name', 'email', 'password'], $filter);
        
        
         
        
            return new User($result);
        }
        
public function update(User $user):void{
    $this->medoo->update('usuario', ['name' => $user->getName(), 
    'email'=> $user->getEmail()], ['id'=> $user->getId()]);

}
public function delete(int $id):void{

$this ->medoo->delete('usuario', ['id'=> $id]);


}

public function findAllTasksByUser(?string $email, ?int $id):array{
if($email === null && $id===null){ 
throw new Exception('both email and id cannot be null');
}

return $this->medoo->select(
    'tarefa',
    [
        '[><]usuario' => ['user_id' => 'id']
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
public function exists(string $email):bool{
return $this->medoo->count('usuario', ['email'=> $email ]) >0;
}
}