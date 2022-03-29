<?php
class Database
{
    //Initialise connection variable
    public ?mysqli $conn;

    /**
     * Create a new connection to MYSQLI database
     *
     * @return mysqli|null
     */
    public static function connect(): ?mysqli
    {
        $db = 'BKB';
        $user = 'root';
        $password = 'MYSQL_ROOT_PASSWORD';
        $host = 'db';

        try {
            $conn = new mysqli('p:' . $host, $user, $password, $db);
            if ($conn->connect_error == null) {
                return $conn;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    //Constructor which creates a connection whenever an object is created
    public function __construct() {
        $this->conn = self::connect();
        if ($this->conn == null) {
            $this->__destruct();
        }
    }

    //Destructor which destroys object
    public function __destruct()
    {
        $this->conn = null;
    }

    //Override method declaration
    /**
     *  Select record(s) from the database using an optional set of parameters
     *
     * @param string $stmt Pre-made SQL statement
     * @param array $params Parameters for prepared statement (Null by default)
     * @return array Dataset returned from the query or null if empty or incorrect
     */
    public function Select(string $stmt, $params = []): null|false|mysqli_result {
        //Check if SQL statement is valid
        if ($query = $this->conn->prepare($stmt)) {
            //Check if parameters have been passed
            if (!empty($params)) {
                foreach ($params as $param) {
                    //Check the data type of the parameter
                    if (gettype($param) == "integer") {
                        $query->bind_param('i', $param);
                    }
                    if (gettype($param) == "string") {
                        $query->bind_param('s', $param);
                    }
                }
            }
            //Check if query has executed properly
            if ($query->execute()) {
                //Check there are rows present
                $result = $query->get_result();
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    //Dataset is empty
                    return null;
                }
            } else {
                return null;
            }
        } else {
            //Return null because the SQL is incorrect or connection failed
            return null;
        }
    }

    /**
     * Delete a record using a specified id
     *
     * @param string $stmt
     * @param array $params
     * @return boolean True or False
     */
    public function Delete(string $stmt, array $params = []): bool {
        //Check if SQL statement is valid
        if ($query = $this->conn->prepare($stmt)) {
            //Check if parameters have been passed
            if (!empty($params)) {
                foreach ($params as $param) {
                    //Check the data type of the parameter
                    if (gettype($param) == "integer") {
                        $query->bind_param('i', $param);
                    }
                    if (gettype($param) == "string") {
                        $query->bind_param('s', $param);
                    }
                }
            } else {
                //Cannot insert with no parameters
                return false;
            }
            //Check if query has executed properly
            if ($query->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            //Return null because the SQL is incorrect or connection failed
            return false;
        }
    }
    /**
     *  Update a record in the database using a parameter
     *
     * @param string $stmt Pre-made SQL statement
     * @param array $params Parameters for prepared statement (Null by default)
     * @return boolean True or False
     */
    public function Update(string $stmt, array $params = []): bool {
        //Check if SQL statement is valid
        if ($query = $this->conn->prepare($stmt)) {
            //Check if parameters have been passed
            if (!empty($params)) {
                foreach ($params as $param) {
                    //Check the data type of the parameter
                    if (gettype($param) == "integer") {
                        $query->bind_param('i', $param);
                    }
                    if (gettype($param) == "string") {
                        $query->bind_param('s', $param);
                    }
                }
            } else {
                //Cannot insert with no parameters
                return false;
            }
            //Check if query has executed properly
            if ($query->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            //Return null because the SQL is incorrect or connection failed
            return false;
        }
    }
}