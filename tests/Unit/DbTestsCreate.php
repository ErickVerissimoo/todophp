<?php
require __DIR__ . '/../../vendor/autoload.php';

use Medoo\Medoo;


$database = new Medoo([
	'type' => 'sqlite',
	'database' => ':memory:'
]);
$sql = file_get_contents('tests/Unit/script.sql');
$queries = explode(';', $sql);
foreach ($queries as $query) {
    $query = trim(string: $query);
    if (!empty($query)) {
        $database->exec($query);
    }
}

return $database;