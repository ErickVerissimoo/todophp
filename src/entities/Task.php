<?php

namespace Erick\Todo\entities;
require __DIR__ . '/../../vendor/autoload.php';

use DateTime;
use JsonSerializable;

class Task implements JsonSerializable
{
    private ?int $id;
    private string $name;
    private string $description;
    private DateTime $scheduled;

    private int $userId; 



    public function __construct(array $arrei)
    {
        $this->name = $arrei["name"];
        $this->description = $arrei["description"];
        $this->scheduled = new DateTime($arrei["scheduled"]);
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getScheduled(): DateTime
    {
        return $this->scheduled;
    }

    public function setScheduled(DateTime $scheduled): self
    {
        $this->scheduled = $scheduled;

        return $this;
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

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
    /**
     * @inheritDoc
     */
    public function jsonSerialize():array {
        return get_object_vars($this);
    }
}