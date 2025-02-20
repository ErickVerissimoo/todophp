<?php
namespace Erick\Todo\service;
require __DIR__ . '/../../vendor/autoload.php';

use Erick\Todo\entities\User;
use Erick\Todo\mapper\UserMapper;
class UserService

{
private UserMapper $mapper;
private AuthService $authService;
public function __construct(Usermapper $var) {
$this ->mapper=$var;
}
public function create(User $data) {
$this ->mapper->insert($data);
    
}
public function delete (User $data) {
    $this ->mapper->delete($data->getId());


}


public function get (User $data):User {
  return  $this ->mapper->get(id:$data->getId(), email: $data->getEmail());


}


}