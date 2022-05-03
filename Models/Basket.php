<?php
class Basket
{
    private array $List;
    private int $Count = 0;

    /**
     * Create a new instance of the Basket class
     */
    public function __construct()
    {
        $this->List = array();
    }

    /**
     * Add a product to the basket
     *
     * @param Product $Product
     */
    public function Add(Product $Product, int $Quantity)
    {
        array_push($this->List, $Product);
        $this->Count = count($this->List);
    }

    /**
     * Remove a product from the basket
     *
     * @param int Position
     */
    public function Remove(int $Position) {
        array_splice($this->List, $Position);
        $this->Count = count($this->List);
    }

    /**
      * Return the number of items in the basket
      *
     * @return int
    */
    public function getCount(): int
    {
        return $this->Count;
    }

    /**
     * Return the basket
     *
     * @return array
     */
    public function GetList(): array
    {
        return $this->List;
    }

    /**
     * Get a specific product from the basket
     *
     * @param int $ProductID
     * @return int|bool
     */
    public function GetProduct(int $ProductID):array|bool{
        if (isset($this->List[$ProductID]['Product'])) {
            return array("Product" => $this->List[$ProductID]['Product'], "Quantity" => $this->List[$ProductID]['Quantity']);
        } else {
            return false;
        }
    }

    /**
     * Calculate the price of an item
     *
     * @param int $PositionID
     * @return float|bool
     */
    public function GetPrice(int $PositionID):float|bool {
        if (isset($this->List[$PositionID])) {
            return $this->List[$PositionID]['Product']->getPrice() * $this->List[$PositionID]['Quantity'];
        } else {
            return false;
        }
    }

    /**
     * Calculate the total cost of the basket
     *
     * @return float
     */
    public function GetTotal():float {
        $Total = (float)0.00;
        for ($x = 0; $x < $this->getCount(); $x++) {
            $Total += $this->GetPrice($x);
        }
        return $Total;
    }
}