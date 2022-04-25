<?php

class Product
{
    //Variable declaration
    private int $ProductID;
    private string $Name;
    private ?string $Description = null;
    private float $Price;
    private ?string $imgslug = null;
    private string $Colour;
    private int $Age;
    private string $Type;

    public function __construct($ProductID, $Name, $Description, $Price, $imgslug, $Colour, $Age, $Type) {
        $this->ProductID = $ProductID;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Price = $Price;
        $this->imgslug = $imgslug;
        $this->Colour = $Colour;
        $this->Age = $Age;
        $this->Type = $Type;
    }

    public function GetProductID():int {
        return $this->ProductID;
    }

    public function getName(): string
    {
        return $this->Name;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function getPrice(): float {
        return $this->Price;
    }

    public function getSlug(): ?string {
        if ($this->imgslug == null) {
            return $this->imgslug;
        } else {
            return $this->ProductID . "/" . $this->imgslug;
        }
    }

    public function getColour(): string {
        return $this->Colour;
    }

    public function getAge(): int
    {
        return $this->Age;
    }

    public function getType(): string {
        return $this->Type;
    }
}