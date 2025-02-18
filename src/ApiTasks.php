<?php
namespace Erick\Todo;

use FastRoute\RouteCollector;

use function FastRoute\simpleDispatcher;

require __DIR__ . '/../vendor/autoload.php';

$router = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/hello', function () {
        echo "ugue";
    });
});


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

 $router->dispatch($httpMethod, $uri);