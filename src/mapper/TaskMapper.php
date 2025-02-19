<?php

namespace Erick\Todo\mapper;
require __DIR__ . '/../../vendor/autoload.php';

use DateTime;
use Erick\Todo\entities\Task;
use Generator;
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
    public function delete(string $name): void
    {

        $this->medoo->delete('tarefa', ['name' => $name]);
    }

    /**
     * @inheritDoc
     */
    public function get(?string $name, ?int $id): Task
    {
        if ($id === null && $name === null) {
            throw new \InvalidArgumentException('Ambos os parâmetros name e id não podem ser nulos');
        }
    
        $filter = $id !== null ? ['id' => $id] : ['name' => $name];
    
        $task = $this->medoo->get('tarefa', '*', $filter);

        if ($task === null) {
            http_response_code(404);
            die('entidade não encontrada');
        }
    
        return new Task($task);
    }
    
    /**
     * @inheritDoc
     */
    public function has(string $name): bool
    {

        return $this->medoo->has('tarefa', ['name'=> $name]);


    }

    /**
     * @inheritDoc
     */
    public function insert(Task $data):int
    {
        $this->medoo->insert('tarefa', ['name' => $data->getName(), 'description' => $data->getDescription(), 'scheduled' => $data->getScheduled()->format(DateTime::ATOM)]);
        return (int) $this->medoo->id();
    }

    /**
     * @inheritDoc
     */
    public function update(Task $data): void
    {
        $this
            ->medoo
            ->update('tarefa', [
                'name' => $data
                    ->getName(),
                'description' => $data
                    ->getDescription(),
                'scheduled' => $data->getScheduled()->format(DateTime::ATOM)
            ], ['id' => $data->getId()]);
    }
 public function getAll():Generator {
    $tasks = $this->medoo->query('select * from tarefa'); 

   foreach($tasks as $task){
yield new Task($task);
   }
}
}