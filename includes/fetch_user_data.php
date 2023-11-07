<?php
require_once 'C:\wamp64\www\LIBMS\LIBMS\db_config\config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class UserData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database->getDb();
    }

    public function getAllUsers(): array
    {
        $sql = "SELECT * FROM tbl_user";
        $stmt = $this->database->query($sql);

        if ($stmt) {
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } else {
            return array();
        }
    }
    public function getAdminIdByUsername($username): ?string
    {
        $sql = "SELECT admin_id FROM tbl_admin WHERE username = :username";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $adminId = $stmt->fetchColumn();
            return $adminId;
        } else {
            return null;
        }
    }

    public function getAdminById($userId): array
    {
        $sql = "SELECT * FROM tbl_admin WHERE admin_id = :userId";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }
}

