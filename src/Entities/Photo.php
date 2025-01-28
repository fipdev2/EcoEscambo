<?php

namespace src\Entities;

use src\Traits\PhotoTrait;
use src\Entities\General\Entity;

class Photo extends Entity
{
    use PhotoTrait;

    private string $path;
    private string $clientPath;
    protected string $table = "photos";

    #[\Override]
    public function __construct(string $path, string $clientPath, ?int $id = null)
    {
        $this->id = $id;
        $this->path = $path;
        $this->clientPath = $clientPath;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getClientPath(): string
    {
        return $this->clientPath;
    }
}