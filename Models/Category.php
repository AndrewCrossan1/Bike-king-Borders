<?php

class Category
{
    private int $CategoryID;
    private string $CatName;
    private ?string $CatDesc;

    //Constructor
    public function __construct($CatID, $Name, $Desc = null)
    {
        $this->CategoryID = $CatID;
        $this->CatName = $Name;
        $this->CatDesc = $Desc;
    }

    public function getCatName(): string
    {
        return $this->CatName;
    }

    public function getCatID():int {
        return $this->CategoryID;
    }

    public function getCatDesc():string {
        return $this->CatDesc;
    }

}