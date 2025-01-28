<?php

namespace src\Entities;

use src\Traits\UserTrait;
use src\Entities\General\Entity;

class User extends Entity
{
    use UserTrait;

    //Attributes
    private string $name;
    private string $email;
    private string $password;
    private string $salt;
    protected string $table = "users";

    private string $neighborhood;

    //Constructor
    #[\Override]
    public function __construct(string $name, string $email, string $password, string $neighborhood, ?int $id = null)
    {
        $strong = true;
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->password = $password;
        $this->neighborhood = $neighborhood;
    }

    //Methods
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


    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getSalt(): string
    {
        return $this->salt;
    }
}