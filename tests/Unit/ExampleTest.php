<?php
$dsn = "mysql:host=172.17.0.2;dbname=teste";
$pdo = new PDO($dsn,"erick","erick");
$pdo -> exec("
drop table if exists tarefa;
");
$pdo -> exec("
Create table if not exists tarefa(
id int auto_increment primary key,
name varchar(70),
description varchar(300),
scheduledAt varchar(30)
);
");
$stmt = $pdo->prepare(" insert into tarefa(name, description, scheduledAt) values(:name, :description, :scheduledAt)");

$date = new DateTime("now");
test('example', function()  use ($stmt, $date) {
    expect(   $stmt -> execute([
        ":name"=> "erick",
        ":description" => "ugue ",
        ":scheduledAt" => $date->format("Y-m-d H:i:s"),
    ])
 )->toBeTrue();
});
