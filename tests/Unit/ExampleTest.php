<?php
namespace Tests\Unit;
require __DIR__ . "/../../vendor/autoload.php";
use DateTime;
use \Erick\Todo\Task;
use Erick\Todo\TaskMapper;

$config = require_once __DIR__ . "/../../src/DatabaseConfig.php";
$data = new DateTime();
$task = new Task(['name' => 'erick', 'description' => 'ugue foi', 'scheduled' => $data->format(DateTime::ATOM)]);
$taskMapper = new TaskMapper($config);
test('inserção', function () use ($taskMapper, $task) {
    expect($taskMapper->insert($task))->toBeInt() ->toEqual(1);
});


test('get teste', function () use ($taskMapper) {
    expect ($taskMapper->get(name: null, id:1))->toBeInstanceOf(Task::class) ;
});

test('existe', function () use ($taskMapper) {
expect($taskMapper->has(   'erick')) ->toBeTrue('não existe');

});

