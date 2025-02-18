<?php
namespace Erick\Todo\utils;

use Medoo\Medoo;

require __DIR__ . '/../../vendor/autoload.php';


$data = new Medoo(
    [
        "type" => "mysql",
        "database" => 'todo',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'erick'
    ]
);
// $sql = file_get_contents(__DIR__ . '/script.sql');
// // echo str_replace(search: ["\n", "\r"], ['[\\n]', '[\\r]'], $sql);
// $queries = explode(';', $sql);
// // print_r($queries);
// foreach ($queries as $query) {
//     $query = trim(string: $query);
//     if (!empty($query)) {
//         $data->exec($query);
//     }
// }
return $data;



?>