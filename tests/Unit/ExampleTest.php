<?php
namespace Tests\Unit;
require __DIR__ ."/../../vendor/autoload.php";
use DateTime;
use \Erick\Todo\Task;
use Erick\Todo\TaskMapper;

$config = require_once __DIR__ ."/../../src/DatabaseConfig.php";
$data =new DateTime();
$task = new Task(['name'=>'erick', 'description'=>'ugue', 'scheduled' => $data -> format(DateTime::ATOM)]);
$taskMapper = new TaskMapper($config);
test('inserção', function () use ($taskMapper, $task) {
    expect($taskMapper->insert($task))->toBeObject();
});
