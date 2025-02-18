<?php

namespace Erick\Todo;

use Exception;

require __DIR__ . '/../vendor/autoload.php';

class TaskService
{
    
    
    private readonly TaskMapper $repository;

    public function __construct(TaskMapper $repository){
        $this->repository = $repository;
    }

    public function create(Task $task) : void {
        $this->repository->insert(data: $task);


    }
    public function update(Task $task) : void {
        $this->repository->update($task);
    }
    public function delete(int $id) : void {
        $this->repository->delete( $id); 
    }

    public function get(?string $name, ?int $id) : Task {
$value =   $this->repository->get($name, $id);

return isset($value) ? $value : throw new Exception('entity not founded');


    }

}