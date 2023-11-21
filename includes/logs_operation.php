<?php
date_default_timezone_set('Asia/Manila');
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
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
        $sql = "SELECT * FROM tbl_logs";
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



}

$database = new Database();
$logsData = new Logs($database);

// Call the getAllStaff method to retrieve all staff data
$logsList = $logsData->getAllLogs();

// Check if there are staff members
if (!empty($logsList)) {
    foreach ($logsList as $logs) {
        // Access staff data fields
        $adminId = $logs['admin_id'];
        $date = $logs['date'];
        $action = $logs['action'];
    }
}

