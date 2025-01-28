<?php

namespace src\Entities\General;

class Entity
{
    protected ?int $id;
    protected string $table;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

}