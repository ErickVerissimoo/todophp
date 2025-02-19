<?php

namespace Erick\Todo;

require __DIR__ . '/../vendor/autoload.php';

use Flight;

Flight::route("POST /task/@id", function(int $id){
    echo "ID da tarefa: " . htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
});

Flight::start();
