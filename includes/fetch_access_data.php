<?php
require_once '../db_config/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class AccessData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database->getDb();
    }

    public function checkAccessCode($code): ?bool
    {
        $sql = "SELECT access_code FROM tbl_access_code WHERE access_code = :code";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $result = $stmt->fetchColumn();
            return $result !== false;
        } else {
            return null;
        }
    }

    public function getAccessType($code): ?string
    {
        $sql = "SELECT access_type FROM tbl_access_code WHERE access_code = :code";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $result = $stmt->fetchColumn();
            return $result !== false ? $result : null;
        } else {
            return null;
        }
    }
}
