<?php
namespace Tests\Unit;
require_once __DIR__ . "/../../vendor/autoload.php";

use Erick\Todo\AuthServiceImpl;
use Erick\Todo\User;


test("generate token", function () {
$auth = new AuthServiceImpl();

expect($auth->login(new User(null, 'erickverissimodasilva144', 'ugue', 'ugue')))->toBeString('erro no token');

});