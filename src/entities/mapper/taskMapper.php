<?php
namespace Src\Entities\Mapper;
use PDO;
use Src\Entities\Mapper\Interface\MapperInterface;
use Src\Entities\task;
class TaskMapper implements MapperInterface{
    private PDO $pdo;
    public function __construct($pdo){
        
        self::$pdo = $pdo;
    }
   
    /**
     * @inheritDoc
     */
    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("delete from task where id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute() ;
        $stmt->closeCursor();
    }
    
    /**
     * @inheritDoc
     */
    public function find(int $id): object {
    $stmt = $this->pdo->prepare("select * from task where id=:id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return new task($row["name"], $row["description"], $row["scheduledAt"]);
    }
    
    /**
     * @inheritDoc
     */
    public function findAll(): array {
        $row = self::$pdo->query("select * from task") -> fetch(PDO::FETCH_ASSOC);
   $tasks = [];
   foreach($row as $task){
    
    $tasks= new task( $task["name"],    $task["description"], $task["scheduledAt"]);
   }         
   return $tasks;
}
    
    /**
     * @inheritDoc
     */
    public function save(task $data):task {
        $stmt = $this->pdo->prepare(" insert into task(name, description, scheduledAt) values(:name, :description, :scheduledAt)");
    
        $stmt -> execute([
            ":name"=> $data ->name,
            ":description" => $data->id,
            ":scheduledAt" => $data->scheduledAt
        ]);
return $data;
    }
    
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