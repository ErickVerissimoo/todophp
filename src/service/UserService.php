<?php

namespace Erick\Todo\service;
require __DIR__ . '/../../vendor/autoload.php';
use Medoo\Medoo;
class UserService
{
private readonly Medoo $medoo;

public function __construct(Medoo $var) {
    $this->medoo = $var;
}

}