<?php
namespace Src\Entities\Mapper\Interface;
use Src\Entities\task;
interface MapperInterface{
    function save(task $data): ?object;
    function delete(int $id): void;
    function find(int $id): ?object;
    function findAll(): array;
    function update(task $entity): void;
}