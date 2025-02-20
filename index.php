<?php

namespace Erick\Todo;

require __DIR__ . '/vendor/autoload.php';

use Erick\Todo\entities\Task;
use Erick\Todo\entities\User;
use Erick\Todo\mapper\TaskMapper;
use Erick\Todo\mapper\UserMapper;
use Erick\Todo\service\AuthServiceImpl;
use Erick\Todo\service\TaskService;
use Flight;

$medoo = include_once 'src/utils/DatabaseConfig.php';
$auth = new AuthServiceImpl(new UserMapper($medoo));
$task = new TaskService(new TaskMapper($medoo));

Flight::before('route', function () use ($auth){
    if(    str_contains(Flight::request()->url, '/user')){
return;
    }
    $token = Flight::request()->getHeader('Authorization');

});

Flight::route('GET /task/@id',  fn (int $id) =>
 Flight::json($task->get(id:$id ), 200));

Flight::post('/task', function () use ($task) {
$body = Flight::request()->data->getData();
$task ->create(new Task($body));
Flight::response()->status(201);
});


Flight::route('GET /task', fn()=>
Flight::json(iterator_to_array($task->getAll()))
);



Flight::delete('/task/@id', function ($id)
 use ($task):void { $task->delete($id);
    Flight::response()->status(204);
});


Flight::put('/task', function () use ($task) {
    $body = Flight::request()->data->getData();
    $task->update(new Task($body));
    Flight::response()->status(204);
});

Flight::post('/user/register', function () use ($auth):void {
    $body = Flight::request()->data->getData();
    $auth->register(new User($body));
    Flight::response()->status(202);

});
Flight::post('/user/login', function () use ($auth):void {
    $body = Flight::request()->data->getData();
    $token = $auth->login($body); 
    Flight::response()->status(203);
    Flight::response()->header('Authorization', $token);


});


Flight::start();
