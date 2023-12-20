<?php
date_default_timezone_set('Asia/Manila');
require_once '../db_config/config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

class Logs
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database->getDb();
    }

    public function getAllLogs(): array
    {
        $sql = "SELECT * FROM vw_logs";
        $stmt = $this->database->query($sql);

        if ($stmt) {
            $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $logs;
        } else {
            return array();
        }
    }

    public function getAllStaffLogs(): array
    {
        $sql = "SELECT * FROM vw_logs_staff";
        $stmt = $this->database->query($sql);

        if ($stmt) {
            $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $logs;
        } else {
            return array();
        }
    }

    public function insertAddLogs($userID,$user, $name): bool
    {
        $admin_id = $userID;
        $action = "{$user} added {$name}";
        $timestamp = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tbl_logs (admin_id,action, date) VALUES (:admin_id,:action, :timestamp)";
        $stmt = $this->database->prepare($sql);

        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function editAddLogs($userID,$user, $name): bool
    {
        $admin_id = $userID;
        $action = "{$user} edit {$name}";
        $timestamp = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tbl_logs (admin_id,action, date) VALUES (:admin_id,:action, :timestamp)";
        $stmt = $this->database->prepare($sql);

        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function deleteAddLogs($userID, $user, $name): bool
    {
        $admin_id = $userID;
        $action = "{$user} deleted {$name}";
        $timestamp = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tbl_logs (admin_id, action, date) VALUES (:admin_id, :action, :timestamp)";
        $stmt = $this->database->prepare($sql);

        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function insertAddCollegeLogs($userID, $actions): bool
    {
        $admin_id = $userID;
        $action = $actions;
        $timestamp = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tbl_logs (admin_id,action, date) VALUES (:admin_id,:action, :timestamp)";
        $stmt = $this->database->prepare($sql);

        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function suspendAddLogs($userID, $user, $name): bool
    {
        $admin_id = $userID;
        $action = "{$user} suspend {$name}";
        $timestamp = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tbl_logs (admin_id, action, date) VALUES (:admin_id, :action, :timestamp)";
        $stmt = $this->database->prepare($sql);

        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function activateAddLogs($userID, $user, $name): bool
    {
        $admin_id = $userID;
        $action = "{$user} activate {$name}";
        $timestamp = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tbl_logs (admin_id, action, date) VALUES (:admin_id, :action, :timestamp)";
        $stmt = $this->database->prepare($sql);

        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function insertAddBookLogs($userID,$user, $name): bool
    {
        $admin_id = $userID;
        $action = "{$user} added book {$name}";
        $timestamp = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tbl_logs (admin_id,action, date) VALUES (:admin_id,:action, :timestamp)";
        $stmt = $this->database->prepare($sql);

        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function editAddBookLogs($userID,$user, $name): bool
    {
        $admin_id = $userID;
        $action = "{$user} edit book {$name}";
        $timestamp = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tbl_logs (admin_id,action, date) VALUES (:admin_id,:action, :timestamp)";
        $stmt = $this->database->prepare($sql);

        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function deleteAddBookLogs($userID, $user, $name): bool
    {
        $admin_id = $userID;
        $action = "{$user} deleted book {$name}";
        $timestamp = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tbl_logs (admin_id, action, date) VALUES (:admin_id, :action, :timestamp)";
        $stmt = $this->database->prepare($sql);

        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

        return $stmt->execute();
    }

}

$database = new Database();
$logsData = new Logs($database);

// Call the getAllStaff method to retrieve all staff data
$logsList = $logsData->getAllLogs();


