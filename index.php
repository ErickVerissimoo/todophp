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
$auth = new AuthServiceImpl(mapper: new UserMapper($medoo));

$task = new TaskService(repository: new TaskMapper($medoo));

$callable = function () use ($auth) {
    $header = Flight::request()->getHeader('Authorization');
    
if (empty($header)) {
        Flight::jsonHalt(['message' => 'Without authentication'], 401);
    }
if(str_starts_with($header,'Bearer ')) {
$header = str_replace('Bearer ','',$header );
}
    $token = trim($header);
    
    if (!$auth->validateToken($token)) {
        Flight::jsonHalt(['message' => 'Invalid token'], 401);
    }
};



Flight::group('/task', function() use($task) :void{



Flight::route('GET /@id',  fn (int $id) =>
 Flight::json($task->get(id:$id ), 200));

Flight::route('POST /', function () use ($task) {
$body = Flight::request()->data->getData();
$task ->create(new Task($body));
Flight::response()->status(201);
});


Flight::route('GET /', fn()=>
Flight::json(iterator_to_array($task->getAll()))
);



Flight::route('DELETE /@id', function ($id)
 use ($task):void { $task->delete($id);
    Flight::response()->status(204);
});


Flight::route('PUT /', function () use ($task) {
    $body = Flight::request()->data->getData();
    $task->update(new Task($body));
    Flight::response()->status(204);
}); 

},[$callable]);



Flight::route('POST /user/register', function () use ($auth):void {
    $body = Flight::request()->data->getData();
    $auth->register(new User($body));
    Flight::response()->status(202);

});
Flight::route('POST /user/login', function () use ($auth):void {
    $body = Flight::request()->data->getData();
    $token = $auth->login($body); 
    Flight::response()->status(203);
    Flight::response()->header('Authorization', $token);


} );


Flight::start();
