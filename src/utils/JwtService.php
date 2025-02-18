<?php

namespace Erick\Todo\utils;
require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv as env;

$env = env::createImmutable(__DIR__."/../../" );
$env ->load();

 $chave = $_ENV['JWT_SECRET'];
 
 return $chave;


