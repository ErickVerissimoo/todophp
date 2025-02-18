<?php

namespace Erick\Todo;
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv as env;
use Firebase\JWT\JWT;

$env = env::createImmutable(__DIR__."/../" );
$env ->load();

 $chave = $_ENV['JWT_SECRET'];
 
 return $chave;


