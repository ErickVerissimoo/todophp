<?php

namespace Erick\Todo;
require __DIR__.'/../vendor/autoload.php';

use DateTime;
use Medoo\Medoo;
class TaskMapper 
{
    private Medoo $medoo;
public function __construct(Medoo $medoo)
{
    $this->medoo = $medoo;
}

    /**
     * @inheritDoc
     */
    public function delete( string $name): void {

        $this->medoo->delete('tarefa', ['name'=> $name]);
    }
    
    /**
     * @inheritDoc
     */
    public function get(?string $name, ?int $id): Task {
        if ($id === null && $name === null) {
            throw new \InvalidArgumentException('Both name and id parameters cannot be null');
        }
        
        $filter = $id !== null ? ['id' => $id] : ['name' => $name];
        return new Task($this->medoo->select('tarefa', ['*'], $filter));


    }
    
    /**
     * @inheritDoc
     */
    public function has(string $name): bool {
        
        return $this-> medoo->count('tarefa', ['name' => $name])>0;


    }
    
    /**
     * @inheritDoc
     */
    public function insert(Task $data): self {
        $this ->medoo->insert('tarefa', ['name'=> $data->getName(),'description'=> $data->getDescription(), 'scheduled' => $data->getScheduled()->format(DateTime::ATOM)]);
    return $this;
    }
    
    /**
     * @inheritDoc
     */
    public function update(Task $data): void {
        $this 
        ->medoo
        ->update('tarefa', ['name' => $data
        ->getName(),
        'description' => $data
        ->getDescription(),
        'scheduled' => $data->getScheduled() ->format(DateTime::ATOM)], ['id'=> $data->getId()]);
    }
}