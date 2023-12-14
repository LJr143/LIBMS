<?php
class Database {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=u657994792_lms_db", "u657994792_usep_tagum_lms", "Usep_tagum_lms123");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getDb() {
        return $this->db;
    }

    public function executeQuery($sql, $params = array()) {
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    $stmt->bindParam($key, $value);
                }
            }

            $stmt->execute();
            return $stmt;  // Return the PDOStatement
        } else {
            die('Failed to prepare the statement: ' . implode(' ', $this->db->errorInfo()));
        }
    }

}

