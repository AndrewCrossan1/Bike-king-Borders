<?php
require_once('Employee.php');
require_once('Account.php');

class Admin extends Employee
{
    //Variable Declaration
    private string $AdminID;
    private string $Forename;
    private string $Surname;
    private string $Email;
    private int $Salary;
    private ?int $DepartmentID;
    private ?int $ManagerID;

    /**
     * Create new instance of the Admin model
     *
     * @param $Forename
     * @param $Surname
     * @param $Email
     * @param $Salary
     * @param $DepartmentID
     * @param $ManagerID
     * @param $EmployeeID
     * @param $AdminID
     */
    public function __construct($Forename, $Surname, $Email, $Salary, $DepartmentID, $ManagerID, $EmployeeID, $AdminID) {
        $this->setEmployeeID($EmployeeID);
        $this->Forename = $Forename;
        $this->Surname = $Surname;
        $this->Email = $Email;
        $this->Salary = $Salary;
        $this->DepartmentID = $DepartmentID;
        $this->ManagerID = $ManagerID;
        $this->AdminID = $AdminID;
    }
}