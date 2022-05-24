<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'settings.php');

class functions
{
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

    public static function GetProduct(int $id): ?array
    {
        $Database = new Database();
        $query = $Database->Select("SELECT * FROM products WHERE ProductID = ?", array($id));
        if ($query == null) {
            return null;
        } else {
            return $query->fetch_assoc();
        }
    }
}