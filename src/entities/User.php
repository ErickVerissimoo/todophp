<?php

namespace Erick\Todo\entities;

use JsonSerializable;

class User implements JsonSerializable
{
    private ?int $id;
    private string $email;
    private string $name;
    private string $password;

   public function __construct(array $values){
    $this->id = $values['id'];
    $this->email = $values['email'];
    $this->name = $values['name'];
    $this->password = $values['password'];
    }
    



    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    /**
     * @inheritDoc
     */
    public function jsonSerialize():array {

        return get_object_vars(
$this
        );
    }
}