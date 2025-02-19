<?php

namespace Erick\Todo\service;

use Erick\Todo\entities\Task;
use Erick\Todo\mapper\TaskMapper;
use Exception;
use Generator;

require __DIR__ . '/../../vendor/autoload.php';

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

    public function get(?string $name=null, ?int $id=null) : Task {

return  $this->repository->get($name, $id);


    }
    public  function getAll():Generator
    {
    return $this->repository-> getAll();        
    }

}