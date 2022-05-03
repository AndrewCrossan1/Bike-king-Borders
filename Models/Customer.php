<?php

class Customer extends Account
{
    private ?int $CustomerID = null;

    //CustomerID Get and Set
    public function getCustomerID(): ?string
    {
        return $this->CustomerID;
    }

    public function setCustomerID($CustomerID): void
    {
        $this->CustomerID = $CustomerID;
    }
}