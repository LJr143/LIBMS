<?php
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

    public function insertAddLogs($user, $name): array
    {
        $sql = "INSERT INTO tbl_logs";
        $action = $user . "Added" . $name;
        $stmt = $this->database->prepare($sql);

        if ($stmt->execute()) {
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_user'];
        } else {
            return 0;
        }
    }


}

