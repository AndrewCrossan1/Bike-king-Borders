<?php
require_once('Account.php');
class Employee extends Account
{
    private ?int $EmployeeID = null;

    //EmployeeID Get and Set
    public function getEmployeeID(): ?string
    {
        return $this->EmployeeID;
    }

    public function setEmployeeID($EmployeeID): void
    {
        $this->EmployeeID = $EmployeeID;
    }
}