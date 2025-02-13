<?php
interface MapperInterface{
    function save($data): void;
    function delete($id): void;
    function find($id): ?object;
    function findAll(): array;
    function update($entity): void;
}