<?php

class Offer {
    //The ID of the code
    private int $OfferID;
    //The actual code
    private string $Code;
    //Discount is saved in float (0.1 for 10%) (0.25 for 25%)
    private float $Discount;

    //Used in admin site to return a code by the id (Viewing individual codes)
    public function getCodeByID($id) {

    }
    //Used in basket when user enters a discount coded
    public function Verify($Code) {
        if ($this->Code == $Code) {
            return $this->Discount;
        } else {
            return null;
        }
    }
}