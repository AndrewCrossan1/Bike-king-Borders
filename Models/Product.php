<?php

class Product
{
    //Variable declaration
    private int $ProductID;
    private string $ProductName;
    private ?string $ProductDesc = null;
    private float $Price;
    private int $CategoryID;

    public function __construct($ProductID, $Name, $Desc, $Price, $CategoryID) {
        $this->ProductID = $ProductID;
        $this->ProductName = $Name;
        $this->ProductDesc = $Desc;
        $this->Price = $Price;
        $this->CategoryID = $CategoryID;
    }

    public function GetProductID():int {
        return $this->ProductID;
    }

    public function getProductName(): string
    {
        return $this->ProductName;
    }

    public function getProductDesc(): ?string
    {
        return $this->ProductDesc;
    }

    public function getPrice(): float {
        return $this->Price;
    }
}