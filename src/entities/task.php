<?php
namespace Src\Entities;
use Datetime;
class Task{
    public int $id;
    public string $name;
    public string $description;
    public DateTime $scheduledAt;
    public function __construct( string $name, string $description, DateTime $scheduledAt){
        $this->name = $name;
            $this->description = $description;
            $this->scheduledAt = $scheduledAt;
    }

    

    }

