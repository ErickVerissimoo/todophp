<?php
namespace Src\Api;

require_once "src/entities/task.php";
require_once "src/entities/mapper/taskMapper.php";

use DateTime;
use Exception;
use PDO;
use Src\Entities\Mapper\TaskMapper;
use Src\Entities\task;

$dados = file_get_contents("php://input");
$dsn = "mysql:host=172.17.0.2;dbname=teste";

$json = json_decode($dados, true);
$method = $_SERVER["REQUEST_METHOD"];
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

try {
    $pdo = new PDO($dsn, 'erick', 'erick', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $mapper = new TaskMapper($pdo);

    if ( $uri == "/todo") {
        switch ($method) {
            case "POST":
                $json["scheduledAt"] = new DateTime($json["scheduledAt"]);

                $task = new task($json["name"], $json["description"], $json["scheduledAt"]);
                $mapper->save($task);

                http_response_code(201);
                break;
            case "GET":
                $id = $_GET["id"];
                $taks = $mapper->find($id);

                $json = json_encode($taks, JSON_PRETTY_PRINT);
                echo $json;
                break;
                case 'DELETE':
                    $id - filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                   $mapper->delete($id);
                    
                    break;
        }
                
}

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
