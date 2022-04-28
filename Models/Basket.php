<?php

class Basket
{
    protected array $List;
    private static int $Count;

    /**
     * Create a new instance of the Basket class
     */
    public function __construct()
    {
        $this->List = array();
        $Count = count($this->List);
    }

    /**
     * Add a product to the basket
     *
     * @param Product $Product
     */
    public function Add(Product $Product, int $Quantity)
    {
        $List[$Product->GetProductID()]['Quantity'] = $Quantity;
        $List[$Product->GetProductID()]['Product'] = $Product;
        $Count = count($this->List);
    }

    /**
     * Remove a product from the basket
     *
     * @param int Position
     */
    public function Remove(int $Position) {
        array_splice($this->List, $Position);
        $Count = count($this->List);
    }

    /**
      * Return the number of items in the basket
      *
     * @return int
    */
    public function getCount(): int
    {
        return self::$Count;
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
}