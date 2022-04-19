<?php
//Require files based on which files are actually necessary to each page respectively
if (isset($PageName)) {
    switch ($PageName) {
        //Index, Create and Staff only require Functions.php#
        case "Index":
            require_once('Scripts/functions.php');
            break;
        //Product requires the Products model
        case "Products":
            require_once("../Scripts/functions.php");
            require("../Scripts/database.php");
            require("../Models/Product.php");
            break;
        //Login requires the Employee and Customer Model
        case "Accounts":
            require("../Models/Account.php");
            require("../models/Employee.php");
            require("../models/Customer.php");
            require_once("../Scripts/functions.php");
            require("../Scripts/database.php");
            break;
        case "Create":
            require_once('../Scripts/functions.php');
            require('../Scripts/database.php');
            break;
        case "Contact":
            require('Scripts/functions.php');
            require("Scripts/database.php");
            break;
        case "AdminHome":
            require_once('../Scripts/functions.php');
            require_once("../Scripts/database.php");
            break;
        case "AdminUsers":
            require_once('../Scripts/functions.php');
            require("../models/Employee.php");
            require("../models/Customer.php");
            require("../Scripts/database.php");
            break;
        case "AdminOffers":
            require_once('../Scripts/functions.php');
            require("../Models/Product.php");
            require("../Scripts/database.php");
            require("../Models/Offer.php");
            break;
        case "AdminProducts":
            require_once('../Scripts/functions.php');
            require("../Scripts/database.php");
            require("../Models/Product.php");
            require("../Models/Offer.php");
            break;
        case "AdminLogin":
            require_once('../Scripts/functions.php');
            require_once('../Scripts/database.php');
            require('../Models/Admin.php');
            break;
        case "DeleteConfirm":
            require_once('../../Scripts/functions.php');
            require_once('../../Scripts/database.php');
    }
}

class functions
{
    /**
     * Check if a username already exists
     *
     * @param $Username
     * @return bool
     */
    public static function CheckUsers($Username):bool {
        //Check if username is already taken
        $Database = new Database();
        //Create new statement
        $stmt = "SELECT * FROM accounts WHERE Username = ?";
        //Select all users from database with given username (Should only be 1)
        $result = $Database->Select($stmt, array($Username));
        if (empty($result) || $result == null) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Login a user using a username and password
     *
     * @param $Username
     * @param $Password
     * @return object|null
     */
    public static function Login($Username, $Password): ?object {
        try {
            // Create new database object to access functions
            $Database = new Database();
            //Create new statement
            $stmt = "SELECT * FROM accounts WHERE Username = ?";
            //Select all users from database with given username (Should only be 1)
            $User = $Database->Select($stmt, array($Username));
            //If user object is null (An error has occurred or no user exists)
            if ($User == null) {
                self::SendMessage("Username or password is incorrect!");
                return null;
                //If User object is not null (Executes as expected)
            } else {
                $User = $User->fetch_assoc();
                //Check if passwords match
                if (password_verify($Password, $User["Password"])) {
                    if ($User["CustomerID"] == null) {
                        $UserObject = new Employee();
                        $UserObject->setEmployeeID($User["EmployeeID"]);
                        $_SESSION['EmployeeID'] = $User['EmployeeID'];
                    } else {
                        $UserObject = new Customer();
                        $UserObject->setCustomerID($User["CustomerID"]);
                        $_SESSION['CustomerID'] = $User['CustomerID'];
                    }
                    $UserObject->setAccountID($User["AccountID"]);
                    $UserObject->setUsername($User["Username"]);
                    $UserObject->setPassword($User["Password"]);
                    $_SESSION['loggedin'] = true;
                    $_SESSION['Username'] = $User["Username"];
                    $_SESSION['AccountID'] = $User["AccountID"];
                    return $UserObject;
                } else {
                    return null;
                }
            }
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Create a new account
     *
     * @param $Username
     * @param $Password
     * @param $ConfirmPass
     * @param $Forename
     * @param $Surname
     * @param $Email
     * @param $Phone
     * @param $House
     * @param $Address
     *
     * @return bool
     */
    public static function CreateAccount($Username, $Password, $ConfirmPass, $Forename, $Surname, $Email, $Phone, $House, $Address): bool {
        if (!self::CheckUsers($Username)) {
            return false;
        } else {
            if ($Password != $ConfirmPass) {
                return false;
            } else {
                //Clean all data except address (Its allowed spaces)
                $Username = trim($Username);
                $Password = trim($Password);
                //Password hashing
                $Password = password_hash($Password, PASSWORD_DEFAULT);
                $Forename = trim($Forename);
                $Surname = trim($Surname);
                $Email = trim($Email);
                $Phone = trim($Phone);
                $House = trim($House);
                $Address = $House . " " . $Address;
                $db = new Database();
                //Creating a query to insert user into database (database.php insert doesn't like my methods despite the fact i made it :0)
                $stmt = "INSERT INTO customers (Forename, Surname, Address, Email, PhoneNum) VALUES (?, ?, ?, ?, ?);";
                $query = $db->conn->prepare($stmt);
                $query->bind_param("sssss", $Forename, $Surname, $Address, $Email, $Phone);
                if ($query->execute()) {
                    if ($query = $db->Select("SELECT * FROM customers WHERE Email = ?", array($Email))) {
                        while ($row = $query->fetch_row()) {
                            $CustomerID = $row[0];
                        }
                        $stmt = "INSERT INTO accounts (Username, Password, CustomerID)  VALUES (?, ?, ?);";
                        $query = $db->conn->prepare($stmt);
                        $query->bind_param("sss", $Username, $Password, $CustomerID);
                        if ($query->execute()) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    /**
     * Send a message to the user using a parameter based output
     *
     * @param $message
     */
    public static function SendMessage($message) {
        //Send message with parameter based output
        echo "
                <div class='container-md'>
                    <div class='alert alert-info alert-dismissible fade show m-4' role='alert'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        <strong>Notice:</strong> {$message}
                    </div>
                </div>
              ";
    }

    //Product Functions

    /**
     * Filter products
     * @param $stmt string Order: Min Value Max Value Type (If used) Colour (If used)
     * @param $DataTypes string|null bind_param Data types (iis) (ssi)
     */
    public static function Filter(string $stmt, string|null $DataTypes = null, $MinValue = 0, $MaxValue = 1000, $Type = null, $Colour = null): array|null {
        //Create database object
        $Database = new Database();

        //Filter
        if ($query = $Database->conn->prepare($stmt)) {
            //Check that data types are in correct order corresponding to parameters
            //Filter by price range only
            if ($Colour == null && $Type == null) {
                if ($query->bind_param($DataTypes, $MinValue, $MaxValue)) {
                    if ($query->execute()) {
                        $result = $query->get_result();
                        $products = array();
                        while ($row = $result->fetch_assoc()) {
                            array_push($products, new Product($row['ProductID'], $row['Name'], $row['Description'], $row['Price'], $row['imgslug'], $row['Colour'], $row['Age'], $row['Type']));
                        }
                        return $products;
                    } else {
                        return null;
                    }
                } else {
                    return null;
                }
            }
            //Filter by Price and Colour
            if ($Colour != null && $Type == null) {
                if ($query->bind_param($DataTypes, $MinValue, $MaxValue, $Colour)) {
                    if ($query->execute()) {
                        $result = $query->get_result();
                        $products = array();
                        while ($row = $result->fetch_assoc()) {
                            array_push($products, new Product($row['ProductID'], $row['Name'], $row['Description'], $row['Price'], $row['imgslug'], $row['Colour'], $row['Age'], $row['Type']));
                        }
                        return $products;
                    } else {
                        return null;
                    }
                } else {
                    return null;
                }
            }
            //Filter by Price and Type
            if ($Type != null && $Colour == null ) {
                if ($query->bind_param($DataTypes, $MinValue, $MaxValue, $Type)) {
                    if ($query->execute()) {
                        $result = $query->get_result();
                        $products = array();
                        while ($row = $result->fetch_assoc()) {
                            array_push($products, new Product($row['ProductID'], $row['Name'], $row['Description'], $row['Price'], $row['imgslug'], $row['Colour'], $row['Age'], $row['Type']));
                        }
                        return $products;
                    } else {
                        echo $Database->conn->error;
                        return null;
                    }
                } else {
                    echo $Database->conn->error;
                    return null;
                }
            }
            //Filter by Price, Type and Colour
            if ($Type != null && $Colour != null) {
                if ($query->bind_param($DataTypes, $MinValue, $MaxValue, $Type, $Colour)) {
                    if ($query->execute()) {
                        $result = $query->get_result();
                        $products = array();
                        while ($row = $result->fetch_assoc()) {
                            array_push($products, new Product($row['ProductID'], $row['Name'], $row['Description'], $row['Price'], $row['imgslug'], $row['Colour'], $row['Age'], $row['Type']));
                        }
                        return $products;
                    } else {
                        return null;
                    }
                } else {
                    return null;
                }
            }
        }
        return null;
    }

    /**
     * Get all distinct bike types
     */
    public static function GetBikeTypes(): array|null {
        $Database = new Database();
        if ($Database->Select("SELECT DISTINCT Type FROM products")) {
            //Retrieve products from database
            $result = $Database->Select("SELECT DISTINCT Type FROM products");
            //Create new products array
            $Types = array();
            //Create new object and add to array for each row (Product)
            while ($row = $result->fetch_assoc()) {
                array_push($Types, $row['Type']);
            }
            return $Types;
        }
        return null;
    }

    /**
     * Get all distinct bike colours
     *
     *@return array|null
     */
    public static function GetColours(): array|null {
        $Database = new Database();
        if ($Database->Select("SELECT DISTINCT Colour FROM products")) {
            //Retrieve products from database
            $result = $Database->Select("SELECT DISTINCT Colour FROM products");
            //Create new products array
            $Colours = array();
            //Create new object and add to array for each row (Product)
            while ($row = $result->fetch_assoc()) {
                array_push($Colours, $row['Colour']);
            }
            return $Colours;
        }
        return null;
    }
}

class AdminFunctions
{
    /**
     * Return the details of a user (For users.php and returning the details of the logged in user)
     *
     * @param $Username
     * @return object|null
     */
    public static function GetDetails($Username): ?mysqli_result
    {
        try {
            //Create new database object to access functions
            $Database = new Database();
            //Create new statement
            $stmt = "SELECT * FROM employees e, admins a WHERE e.EmployeeID = a.EmployeeID AND a.Username = ?";
            $User = $Database->Select($stmt, array($Username));
            if ($User == null) {
                functions::SendMessage(base64_encode("User does not exist"));
                return null;
            } else {
                return $User;
            }
        } catch (Exception) {
            return null;
        }
    }

    /**
     * Used for logging into the administrator website
     *
     * @param string $Username
     * @param string $Password
     * @return bool
     */
    public static function Login(string $Username, string $Password): bool
    {
        try {
            //Create new database object
            $Database = new Database();
            //Set variable to script
            $stmt = "SELECT Username, Password FROM admins WHERE Username = ?";
            //Select user from database
            $User = $Database->Select($stmt, array($Username));
            if ($User == null) {
                functions::SendMessage(base64_encode("Username incorrect"));
                return false;
            } else {
                $User = $User->fetch_assoc();
                //Check if passwords match
                if (password_verify($Password, $User['Password'])) {
                    $_SESSION['Admin'] = true;
                    $_SESSION['Username'] = $User['Username'];
                    return true;
                } else {
                    functions::SendMessage(base64_encode("Password incorrect"));
                    return false;
                }
            }
        } catch (Exception) {
            return false;
        }
    }

    /**
     * Return the number of products currently available
     *
     * @return int|mixed
     */
    public static function CountProducts(): mixed
    {
        try {
            //Create new database object
            $Database = new Database();
            //SQL Query
            $stmt = 'SELECT DISTINCT COUNT(ProductID) AS "NumOfProducts" FROM products;';
            //Create Query
            $query = $Database->conn->prepare($stmt);
            //Get result from query
            if ($query->execute()) {
                $result = $query->get_result();
                $int = $result->fetch_assoc();
                return $int['NumOfProducts'];
            } else {
                return 0;
            }
        } catch (Exception) {
            return 0;
        }
        return 0;
    }

    /**
     * Return the number of users
     *
     * @return mixed
     */
    public static function CountUsers(): mixed
    {
        try {
            //Create new database object
            $Database = new Database();
            //SQL Query
            $stmt = 'SELECT DISTINCT COUNT(CustomerID) AS "NumOfCustomers" FROM customers;';
            //Create Query
            $query = $Database->conn->prepare($stmt);
            //Get result from query
            if ($query->execute()) {
                $result = $query->get_result();
                $int = $result->fetch_assoc();
                return $int['NumOfCustomers'];
            } else {
                return 0;
            }
        } catch (Exception) {
            return 0;
        }
        return 0;
    }


    /**
     * Return the number of offers
     *
     * @return mixed
     */
    public static function CountOffers(): mixed
    {
        try {
            //Create new database object
            $Database = new Database();
            //SQL Query
            $stmt = 'SELECT DISTINCT COUNT(OfferID) AS "NumOfOffers" FROM Offers;';
            //Create Query
            $query = $Database->conn->prepare($stmt);
            //Get result from query
            if ($query->execute()) {
                $result = $query->get_result();
                $int = $result->fetch_assoc();
                return $int['NumOfOffers'];
            } else {
                return 0;
            }
        } catch (Exception) {
            return 0;
        }
        return 0;
    }

    /**
     * Return 5 most recent users
     *
     * @return bool|mysqli_result|null
     */
    public static function RecentUsers(): bool|mysqli_result|null
    {
        try {
            //Create new database object
            $Database = new Database();
            //SQL Query
            $stmt = 'SELECT a.AccountID, Username, Email FROM customers c, accounts a WHERE c.CustomerID = a.CustomerID ORDER BY AccountID DESC LIMIT 5;';
            //Create Query
            $query = $Database->conn->prepare($stmt);
            //Get result from query
            if ($query->execute()) {
                return $query->get_result();
            } else {
                return null;
            }
        } catch (Exception) {
            return null;
        }
        return null;
    }


    /**
     * Return 5 most recent products
     *
     * @return bool|mysqli_result|null
     */
    public static function RecentProducts(): bool|mysqli_result|null
    {
        try {
            //Create new database object
            $Database = new Database();
            //SQL Query
            $stmt = 'SELECT ProductID AS "ProductID", Name, Price FROM products ORDER BY ProductID DESC LIMIT 5;';
            //Create Query
            $query = $Database->conn->prepare($stmt);
            //Get result from query
            if ($query->execute()) {
                return $query->get_result();
            } else {
                return null;
            }
        } catch (Exception) {
            return null;
        }
        return null;
    }

    /**
     * Retrieve 5 most recent purchases
     *
     * @return null
     */
    public static function RecentPurchases()
    {
        try {
            $Database = new Database();
            $sql = "SELECT SaleID, Username, products.Name, sales.Price, sales.Quantity FROM sales, accounts, customers, products WHERE sales.ProductID = products.ProductID AND sales.CustomerID = customers.CustomerID AND accounts.CustomerID = customers.CustomerID ORDER BY SaleID DESC LIMIT 5;";
            $query = $Database->conn->prepare($sql);
            if ($query->execute()) {
                return $query->get_result();
            } else {
                return null;
            }
        } catch (Exception) {
            return null;
        }
    }

    /**
     * Retrieve sales data for month specified
     *
     * @param int $month
     * @return mixed|null
     */
    public static function GetMonthSale(int $month): mixed
    {
        try {
            $Database = new Database();
            $stmt = 'SELECT COUNT(SaleID) AS "Sales" FROM sales WHERE MONTH(Date) = ?';
            $query = $Database->conn->prepare($stmt);
            $query->bind_param("i", $month);
            if ($query->execute()) {
                $result = $query->get_result();
                $count = $result->fetch_assoc();
                return $count['Sales'];
            }
        } catch (Exception) {
            return null;
        }
        return null;
    }

    /**
     * Get all products
     *
     * @param int $Limit
     * @return mysqli_result|array|null
     */
    public static function GetProducts(int $Limit): mysqli_result|array|null
    {
        try {
            $Database = new Database();
            $Result = $Database->Select("SELECT * FROM products LIMIT ?", array($Limit));
            if ($Result != null) {
                return $Result;
            } else {
                return null;
            }
        } catch (Exception) {
            return null;
        }


    }
}