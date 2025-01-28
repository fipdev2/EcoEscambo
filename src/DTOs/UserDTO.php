<?php


namespace src\DTOs;

use src\Traits\UserTrait;
use src\Entities\General\Entity;

class UserDTO extends Entity
{
    use UserTrait;

    //Attributes
    private string $name;
    private string $email;
    private string $neighborhood;

    //Methods
    public function __construct(int $id, string $name, string $email, string $neighborhood)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->neighborhood = $neighborhood;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function getNeighborhood(): string
    {
        return $this->neighborhood;
    }
}