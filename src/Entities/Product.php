<?php

namespace src\Entities;

use src\DTOs\UserDTO;
use src\Entities\General\Entity;
use src\Traits\ProductTrait;
use \ArrayObject;

class Product extends Entity
{
    use ProductTrait;

    //Attributes
    private string $title;
    private string $description;
    private User|UserDTO $owner;
    private Photo $photo;

    private ArrayObject $interestedUsers;
    #[\Override]
    protected string $table = "products";

    //Constructor
    #[\Override]
    public function __construct(string $title, string $description, User|UserDTO|null $owner, ?Photo $photo, ?int $id = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->owner = $owner;
        $this->photo = $photo;
    }

    //Methods
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title, User|UserDTO $user): void
    {
        if ($this->owner === $user) {
            $this->title = $title;
        }
    }

    public
    function getDescription(): string
    {
        return $this->description;
    }

    public
    function setDescription(string $description, User|UserDTO $user): void
    {
        if ($this->owner === $user) {

            $this->description = $description;
        }
    }

    public function getOwner(): User|UserDTO
    {
        return $this->owner;
    }

    public function setOwner(User|UserDTO $owner): void
    {
        $this->owner = $owner;
    }

    public function getPhoto(): Photo
    {
        return $this->photo;
    }

    public function setPhoto(Photo $photo): void
    {
        $this->photo = $photo;
    }


}
