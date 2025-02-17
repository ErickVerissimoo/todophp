<?php

namespace Erick\Todo;
require __DIR__.'/../vendor/autoload.php';

use DateTime;
class Task
{
  private string $name;
  private string $description;
  private DateTime $scheduled;
public function __construct(array $arrei) {
    $this->name = $arrei["name"];
    $this->description = $arrei["description"];
    $this->scheduled =  new DateTime($arrei["scheduled"]);
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
}