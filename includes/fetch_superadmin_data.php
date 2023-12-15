<?php
require_once '../db_config/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class SuperAdminData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database->getDb();
    }

    public function getAllLibrarian(): array
    {
        $sql = "SELECT * FROM tbl_superadmin WHERE admin_role = 'Librarian'";
        $stmt = $this->database->query($sql);

        if ($stmt) {
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } else {
            return array();
        }
    }

    public function getNumberOfLibrarian(): int
    {
        $sql = "SELECT COUNT(*) as num_user FROM tbl_superadmin WHERE admin_role = 'Librarian'";
        $stmt = $this->database->prepare($sql);

        if ($stmt->execute()) {
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_superadmin'];
        } else {
            return 0;
        }
    }
    public function getSuperadminIdByUsername($username): ?string
    {
        $sql = "SELECT admin_id FROM tbl_superadmin WHERE username = :username";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $adminId = $stmt->fetchColumn();
            return $adminId;
        } else {
            return null;
        }
    }

    public function getSuperadminById($userId): array
    {
        $sql = "SELECT * FROM tbl_superadmin WHERE admin_id = :userId";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    public function confirmPasswordSuperAdmin($userId, $password): bool
    {
        $sql = "SELECT * FROM tbl_superadmin WHERE admin_id = :userId AND password = :password";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if a matching record was found
        return ($result !== false);
    }

}



