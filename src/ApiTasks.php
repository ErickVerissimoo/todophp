<?php
namespace Erick\Todo;

use Bramus\Router\Router as route;

require __DIR__ . '/../vendor/autoload.php';

$router = new route();

$router->get('/todo', function (){

});   




$router->run()  ;
