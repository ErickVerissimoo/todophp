<?php

namespace Erick\Todo;

require __DIR__ . '/vendor/autoload.php';

use Erick\Todo\entities\Task;
use Erick\Todo\mapper\TaskMapper;
use Erick\Todo\mapper\UserMapper;
use Erick\Todo\service\TaskService;
use Erick\Todo\service\UserService;
use Flight;
$medoo = include 'src/utils/DatabaseConfig.php';
$user= new UserService(new UserMapper($medoo));
$task = new TaskService(new TaskMapper($medoo));

Flight::route('GET /task/@id', function (int $id) use ($task) {
 $t = $task->get(id:$id );
 Flight::json($t, 200);
});
Flight::route('POST /task', function () use ($task) {
$body = Flight::request()->data->getData();
$task ->create(new Task($body));
Flight::halt(201);
});
Flight::route('GET /task', function () use ($task) {
    $tasks = [];
foreach( $task->getAll() as $task ) {
    array_push($tasks, $task);
}  
   Flight::json($tasks,200);
});

Flight::route('PUT /task', function () use ($task) {
    $string =['message'=> 'teste'];
    
    Flight::json( $string,200);

});

Flight::start();
