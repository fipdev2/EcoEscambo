<?php

namespace src\Entities;
use src\Entities\General\Entity;

class Trade extends Entity
{
    use TradeTrait;

    //Attributes
    private Product $interestedUserProduct;
    private Product $chosenProduct;
    private bool $isConcluded;

    //Methods
    public function getInterestedUserProduct(): Product
    {
        return $this->interestedUserProduct;
    }

    public function setInterestedUserProduct(Product $interestedUserProduct): void
    {
        $this->interestedUserProduct = $interestedUserProduct;
    }

    public function getChosenProduct(): Product
    {
        return $this->chosenProduct;
    }

    public function setChosenProduct(Product $chosenProduct): void
    {
        $this->chosenProduct = $chosenProduct;
    }

    public function isConcluded(): bool
    {
        return $this->isConcluded;
    }

    public function setConcluded(bool $isConcluded): void
    {
        $this->isConcluded = $isConcluded;
    }

}