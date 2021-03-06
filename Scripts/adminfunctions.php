<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'adminsettings.php');

class AdminFunctions
{
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
                return false;
            } else {
                $User = $User->fetch_assoc();
                //Check if passwords match
                if (password_verify($Password, $User['Password'])) {
                    $_SESSION['Admin'] = true;
                    $_SESSION['Username'] = $User['Username'];
                    return true;
                } else {
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
            $stmt = 'SELECT DISTINCT COUNT(AccountID) AS "NumOfCustomers" FROM accounts;';
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

    public static function GetProduct(int $ID): Product|null {
        try {
            $Database = new Database();
            $Result = $Database->Select("SELECT * FROM products WHERE ProductID = ?;", array($ID));
            if ($Result != null) {
                $row = $Result->fetch_assoc();
                return new Product($row['ProductID'], $row['Name'], $row['Description'], $row['Price'], $row['imgslug'], $row['Colour'], $row['Age'], $row['Type'], $row['date']);
            } else {
                return null;
            }
        } catch (Exception) {
            return null;
        }
    }

    public static function GetTickets() {
        try {
            $Database = new Database();
            $Result = $Database->Select("SELECT * FROM Tickets, products WHERE products.ProductID = Tickets.ProductID;");
            if ($Result != null) {
                $array = array();
                while ($row = $Result->fetch_assoc()) {
                    array_push($array, $row);
                }
                return $array;
            } else {
                return null;
            }
        } catch (Exception) {
            return null;
        }
    }

    public static function FilterTickets($status, $dateposted) {
        //Get products
        $Database = new Database();

        //Get submitted variables
        $Status = $status;
        $DatePosted = $dateposted;

        //Set SQL statement
        $sql = match ($Status) {
            'all' => "SELECT Tickets.TicketID, Tickets.Email, Tickets.Fullname, Tickets.Subject, Tickets.Message, Tickets.DateCreated, Tickets.Active, products.ProductID, products.Name FROM Tickets, products WHERE Tickets.ProductID = products.ProductID",
            'closed' => "SELECT Tickets.TicketID, Tickets.Email, Tickets.Fullname, Tickets.Subject, Tickets.Message, Tickets.DateCreated, Tickets.Active, products.ProductID, products.Name FROM Tickets, products WHERE Tickets.ProductID = products.ProductID AND Active = 0",
            'active' => "SELECT Tickets.TicketID, Tickets.Email, Tickets.Fullname, Tickets.Subject, Tickets.Message, Tickets.DateCreated, Tickets.Active, products.ProductID, products.Name FROM Tickets, products WHERE Tickets.ProductID = products.ProductID AND Active = 1",
        };

        //Append ordering to sql statement
        $sql = match ($DatePosted) {
            'newest' => $sql . ' ORDER BY DateCreated DESC;',
            'oldest' => $sql . ' ORDER BY DateCreated ASC;',
        };
        $array = array();

        $Tickets = $Database->Select($sql);

        if ($Tickets == null) {
            return null;
        } else {
            while ($result = $Tickets->fetch_assoc()) {
                array_push($array, $result);
            }
            return $array;
        }
    }
    public static function GetOffers() {
        try {
            $Database = new Database();
            $Result = $Database->Select("SELECT * FROM Offers;");
            if ($Result != null) {
                $array = array();
                while ($row = $Result->fetch_assoc()) {
                    array_push($array, $row);
                }
                return $array;
            } else {
                return null;
            }
        } catch (Exception) {
            return null;
        }
    }
    public static function FilterOffers($status, $dateposted) {
        //Get products
        $Database = new Database();

        //Get submitted variables
        $Status = $status;
        $DatePosted = $dateposted;

        //Set SQL statement
        $sql = match ($Status) {
            'all' => "SELECT * FROM Offers",
            'closed' => "SELECT * FROM Offers WHERE ValidTo < SYSDATE()",
            'active' => "SELECT * FROM Offers WHERE ValidTo > SYSDATE()"
        };

        //Append ordering to sql statement
        $sql = match ($DatePosted) {
            'newest' => $sql . ' ORDER BY ValidFrom DESC;',
            'oldest' => $sql . ' ORDER BY ValidFrom ASC;',
        };
        $array = array();

        $Tickets = $Database->Select($sql);

        if ($Tickets == null) {
            return null;
        } else {
            while ($result = $Tickets->fetch_assoc()) {
                array_push($array, $result);
            }
            return $array;
        }
    }

    public static function FilterUsers($type, $datecreated) {
        //Create database object
        $Database = new Database();

        $Type = $type;
        $DateCreated = $datecreated;

        //Get submitted variables
        $sql = match ($type) {
            'all' => "SELECT DISTINCT AccountID, Username, Password, DateCreated, accounts.CustomerID, accounts.EmployeeID FROM accounts, customers, employees WHERE accounts.CustomerID = customers.CustomerID OR accounts.EmployeeID = employees.EmployeeID",
            'employee' => "SELECT AccountID, Username, Password, accounts.EmployeeID, employees.Email, accounts.DateCreated FROM accounts, employees WHERE CustomerID IS NULL AND accounts.EmployeeID = employees.EmployeeID",
            'customer' => "SELECT AccountID, Username, Password, accounts.CustomerID, customers.Email, accounts.DateCreated FROM accounts, customers WHERE EmployeeID IS NULL AND accounts.CustomerID = customers.CustomerID"
        };
        //Append ordering to sql statement
        $sql = match ($DateCreated) {
            'newest' => $sql . ' ORDER BY AccountID DESC;',
            'oldest' => $sql . ' ORDER BY AccountID ASC;',
        };
        $array = array();

        $Users = $Database->Select($sql);
        if ($Users == null) {
            return null;
        } else {
            while ($result = $Users->fetch_assoc()) {
                array_push($array, $result);
            }
            return $array;
        }
    }
    public static function GetUsers() {
        try {
            $Database = new Database();
            $Result = $Database->Select("SELECT * FROM accounts;");
            if ($Result != null) {
                $array = array();
                while ($row = $Result->fetch_assoc()) {
                    array_push($array, $row);
                }
                return $array;
            } else {
                return null;
            }
        } catch (Exception) {
            return null;
        }
    }
    public static function GetUser($ID) {
        try {
            $Database = new Database();
            $Result = $Database->Select("SELECT AccountID, Username, Password, Email FROM accounts, customers WHERE accounts.CustomerID = customers.CustomerID AND AccountID = ?;", array($ID));
            if ($Result != null) {
                $array = array();
                while ($row = $Result->fetch_assoc()) {
                    array_push($array, $row);
                }
                return $array;
            } else {
                var_dump($Result);
                return null;
            }
        } catch (Exception) {
            return null;
        }
    }
    public static function CountTickets() {
        try {
            //Create new database object
            $Database = new Database();
            //SQL Query
            $stmt = 'SELECT DISTINCT COUNT(TicketID) AS "NumOfProducts" FROM Tickets;';
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
    public static function WriteTimes($Times) {
        $Times = [
            ['Day of the week', 'Opening Time', 'Closing Time'],
            [$Times[0][0], $Times[0][1], $Times[0][2]],
            [$Times[1][0], $Times[1][1], $Times[1][2]],
            [$Times[2][0], $Times[2][1], $Times[2][2]],
            [$Times[3][0], $Times[3][1], $Times[3][2]],
            [$Times[4][0], $Times[4][1], $Times[4][2]],
            [$Times[5][0], $Times[5][1], $Times[5][2]],
            [$Times[6][0], $Times[6][1], $Times[6][2]],
        ];
        $filename = BASE_DIR . '/Media/data/openingtimes.csv';
        // open csv file for writing
        $f = fopen($filename, 'w');

        if ($f == false) {
            return false;
        }

        // write each row at a time to a file
        foreach ($Times as $row) {
            fputcsv($f, $row);
        }
        fclose($f);
    }
    public static function ReadTimes() {
        $Times = [[]];
        $filename = BASE_DIR . '/Media/data/openingtimes.csv';
        // open csv file for writing
        $f = fopen($filename, 'r');

        if ($f == false) {
            return false;
        }

        // read each line in CSV file at a time
        while (($row = fgetcsv($f)) !== false) {
            $Times[] = $row;
        }
        fclose($f);
        return $Times;
    }
}



?>