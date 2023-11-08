<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class StaffData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database->getDb();
    }

    public function getAllStaff(): array
    {
        $sql = "SELECT * FROM tbl_admin WHERE admin_role = 'Staff'";
        $stmt = $this->database->query($sql);

        if ($stmt) {
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } else {
            return array();
        }
    }

    public function getNumberOfStaff(): int
    {
        $sql = "SELECT COUNT(*) as num_user FROM tbl_admin WHERE admin_role = 'Staff'";
        $stmt = $this->database->prepare($sql);

        if ($stmt->execute()) {
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_staff'];
        } else {
            return 0;
        }
    }
    public function getStaffIdByUsername($username): ?string
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

    public function getStaffById($userId): array
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
$database = new Database();
$staffData = new StaffData($database);

// Call the getAllStaff method to retrieve all staff data
$staffList = $staffData->getAllStaff();

// Check if there are staff members
if (!empty($staffList)) {
    foreach ($staffList as $staff) {
        // Access staff data fields
        $adminId = $staff['admin_id'];
        $username = $staff['username'];
    }
} else {
    // No staff members found
    echo "No staff members found.";
}


