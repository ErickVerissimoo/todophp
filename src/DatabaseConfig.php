<?php
namespace Erick\Todo;
require __DIR__.'/../vendor/autoload.php';
use Medoo\Medoo;

$data = new Medoo(
[
    "type" => "mysql",
    "database" =>'todo',
    'host'=>'localhost',
    'username' => 'root',
    'password' => 'erick'
]

);
$sql = file_get_contents('script.sql');
echo str_replace(["\n", "\r"], ['[\\n]', '[\\r]'], $sql);
$queries = explode(';', $sql);
print_r($queries);
foreach ($queries as $query) {
    $query = trim(string: $query);
    if (!empty($query)) {
        $data->exec($query);
    }
}




?>