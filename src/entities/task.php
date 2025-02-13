<?php
class Task{
    private int $id;
    private string $name;
    private string $description;
    private DateTime $scheduledAt;
    public function __construct(int $id, string $name, string $description, DateTime $scheduledAt){
        $this->id = $id;
        $this->name = $name;
            $this->description = $description;
            $this->scheduledAt = $scheduledAt;
    }
    public function __get(string $name):mixed{
        if(property_exists($this, $name)){
            return $this->$name;
        }
        throw new Exception("O atributo {$name} não existe");
    }
    public function __set(string $name,mixed $value):void{
        if(property_exists($this, $name)){
            $this->$name = $value;
        return
    
    throw new Exception("A propriedade {$name} não existe");
        
    }
    }

}