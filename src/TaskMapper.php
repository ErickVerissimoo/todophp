<?php

namespace Erick\Todo;
require __DIR__.'/../vendor/autoload.php';

use DateTime;
use Medoo\Medoo;
class TaskMapper 
{
    private Medoo $medoo;
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
        if ($id === null and $name === null) {
            throw new \InvalidArgumentException('the name and the id params cannot be null');
        }
        elseif (
            $id === null and $name !==null
        ){
            return new Task($this->medoo->select('tarefa', ['*'], ['name'=> $name]));
        }else{
            return new Task($this->medoo->select('tarefa', ['*'], ['id' => $id]));
        }



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
    public function insert(Task $data): void {
        $this ->medoo->insert('tarefa', ['name'=> $data->getName(),'description'=> $data->getDescription(), 'scheduled' => $data->getScheduled()->format(DateTime::ATOM)]);
    }
    
    /**
     * @inheritDoc
     */
    public function update(mixed $data): void {
    }
}