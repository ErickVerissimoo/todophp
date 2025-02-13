<?php
class TaskMapper implements MapperInterface{
    private TaskMapper $instance;
    private function __construct(){}
    public static function getInstance(): TaskMapper{
        if(static::$instance == null){
            static::$instance = new TaskMapper();
    }
    return static::$instance;

}
    /**
     * @inheritDoc
     */
    public function delete($id): void {
    }
    
    /**
     * @inheritDoc
     */
    public function find($id): object|null {
    }
    
    /**
     * @inheritDoc
     */
    public function findAll(): array {
    }
    
    /**
     * @inheritDoc
     */
    public function save($data): void {
    }
    
    /**
     * @inheritDoc
     */
    public function update($entity): void {
    }
}