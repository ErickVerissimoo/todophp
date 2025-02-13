<?php
namespace Src\Entities\Mapper;
require_once "src/entities/mapper/interface/MapperInterface.php";

use DateTime;
use PDO;
use Src\Entities\Mapper\Interface\MapperInterface;
use Src\Entities\task;
class TaskMapper implements MapperInterface{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        
        $this->pdo = $pdo;
    }
   
    /**
     * @inheritDoc
     */
    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("delete from tarefa where id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute() ;
        $stmt->closeCursor();
    }
    
    /**
     * @inheritDoc
     */
    public function find(int $id): object {
    $stmt = $this->pdo->prepare("select * from tarefa where id=:id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $data = new DateTime($row["scheduledAt"]);
    return new task($row["name"], $row["description"], $data);
    }
    
    /**
     * @inheritDoc
     */
    public function findAll(): array {
        $row = self::$pdo->query("select * from task") -> fetch(PDO::FETCH_ASSOC);
   $tasks = [];
   foreach($row as $task){
    $date = new DateTime($task["scheduledAt"]);
    $tasks= new task( $task["name"],    $task["description"],$date );
   }         
   return $tasks;
}
    
    /**
     * @inheritDoc
     */
    public function save(task $data):task {
        $stmt = $this->pdo->prepare("INSERT INTO tarefa(name, description, scheduledAt) VALUES(:name, :description, :scheduledAt)");

        $stmt->execute([
            ":name" => $data->name,
            ":description" => $data->description,
            ":scheduledAt" => $data->scheduledAt->format('Y-m-d H:i:s') 
        ]);
        
        return $data;}
    /**
     * @inheritDoc
     */
    public function update(task $entity): void {
        
        $stmt = $this->pdo->prepare("update task set name =: name, description = :description, scheduletAt=:scheduledAt");
        $stmt -> execute([
            ":name" => $entity ->name,
            ":description" => $entity -> description,
            "scheduledAt" => $entity ->scheduledAt
        ]);
    }
}