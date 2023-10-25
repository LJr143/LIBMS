<?php
class Database {
    private string $dbHost = 'localhost';
    private string $dbUser = 'root';
    private string $dbPass = '';
    private string $dbName = 'lms_db';
    private mysqli $conn;

    public function __construct() {
        $this->conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function executeQuery($sql, $params = array()) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            if (!empty($params)) {
                $types = ''; // String that specifies the types of parameters
                $values = array(); // Array to store the parameter values
                foreach ($params as $param) {
                    $values[] = $param;
                    if (is_int($param)) {
                        $types .= 'i'; // Integer
                    } elseif (is_float($param)) {
                        $types .= 'd'; // Double
                    } else {
                        $types .= 's'; // String
                    }
                }
                array_unshift($values, $types);
                call_user_func_array(array($stmt, 'bind_param'), $this->refValues($values));
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            return $result;
        } else {
            die('Failed to prepare the statement: ' . $this->conn->error);
        }
    }

    public function close() {
        $this->conn->close();
    }

    private function refValues($arr): array
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
}

