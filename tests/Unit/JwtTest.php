<?php
namespace Tests\Unit;
require_once __DIR__ . "/../../vendor/autoload.php";

use Erick\Todo\entities\User;
use Erick\Todo\mapper\UserMapper;
use Erick\Todo\service\AuthServiceImpl; 

test("register", function (): void {
    $medoo = include 'src/utils/DatabaseConfig.php';
    $auth = new AuthServiceImpl(new UserMapper($medoo));

    $key= ['id', 'email', 'name', 'password'];
    $values= [null, 'erickverissimodasilva144', 'ugue', 'ugue'];
    $combined = array_combine($key, $values);
    $user = new User($combined);

expect($auth->register($user))->toBeObject();
});


test("generate login", function () {
    $medoo = include 'src/utils/DatabaseConfig.php';
    $auth = new AuthServiceImpl(new UserMapper($medoo));
$key= ['id', 'email', 'name', 'password'];
$values= [null, 'verissimoerick@gmail', 'ugue', 'ugue'];
$combined = array_combine($key, $values);
$use= new User($combined);
$auth->register(user: $use);
expect($auth->login($use))->toBeString('erro no token');

});