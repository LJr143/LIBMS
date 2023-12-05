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
    public function addStaff($firstName, $lastName, $mi, $staffId, $Pemail, $Oemail, $phoneNumber, $telephoneNumber, $address, $admin_role, $username, $password, $profile): bool
    {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO tbl_admin (fname, lname, initial, admin_id, email, personal_email, phone_number, tele_number, address, admin_role, username, password, img)
            VALUES (:fname, :lname, :initial, :admin_id, :email, :personal_email, :phone_number, :tele_number, :address, :admin_role, :username, :password, :img)";
        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':fname', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lname', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':initial', $mi, PDO::PARAM_STR);
        $stmt->bindParam(':admin_id', $staffId, PDO::PARAM_STR);
        $stmt->bindParam(':email', $Pemail, PDO::PARAM_STR);
        $stmt->bindParam(':personal_email', $Oemail, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':tele_number', $telephoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':admin_role', $admin_role, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR); // Use hashed password
        $stmt->bindParam(':img', $profile, PDO::PARAM_STR);

        // Execute the query
        return $stmt->execute();
    }

    // Inside the StaffData class
    public function updateStaff($userId, $firstName, $lastName, $mi, $Pemail, $Oemail, $phoneNumber, $telephoneNumber, $address, $admin_role, $username, $password, $img) {
        // Hash the password if it is provided
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }

        // SQL query without the img column
        $sql = "UPDATE tbl_admin 
        SET fname = :fname, lname = :lname, initial = :initial, 
            email = :email, personal_email = :personal_email, 
            phone_number = :phone_number, tele_number = :tele_number, 
            address = :address, admin_role = :admin_role, 
            username = :username";

        // Include password update if provided
        if (!empty($password)) {
            $sql .= ", password = :password";
        }

        // Include img update if provided
        if ($img !== null) {
            $sql .= ", img = :img";
        }

        $sql .= " WHERE admin_id = :userId";

        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':fname', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lname', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':initial', $mi, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':tele_number', $telephoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':email', $Pemail, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':personal_email', $Oemail, PDO::PARAM_STR);
        $stmt->bindParam(':admin_role', $admin_role, PDO::PARAM_STR);

        // Bind the password parameter if provided
        if (!empty($password)) {
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        }

        // Bind the img parameter if provided
        if ($img !== null) {
            $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        }

        // Execute the query
        return $stmt->execute();
    }


    public function updateStaffProfile($userId, $firstName, $lastName, $mi, $Oemail, $phoneNumber, $telephoneNumber, $address, $img) {
        // SQL query without the img column
        $sql = "UPDATE tbl_admin 
        SET fname = :fname, lname = :lname, initial = :initial, 
            email = :email, phone_number = :phone_number, tele_number = :tele_number, 
            address = :address
        WHERE admin_id = :userId";

        // If $img is not null, include it in the SQL query and bind the parameter
        if ($img !== null) {
            $sql = "UPDATE tbl_admin 
            SET fname = :fname, lname = :lname, initial = :initial, 
                email = :email,phone_number = :phone_number, tele_number = :tele_number, 
                address = :address,
                img = :img
            WHERE admin_id = :userId";
        }

        $stmt = $this->database->prepare($sql);

        // Bind parameters (excluding the img parameter if $img is null)
        $stmt->bindParam(':fname', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lname', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':initial', $mi, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':tele_number', $telephoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':email', $Oemail, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);


        // Bind the img parameter if $img is not null
        if ($img !== null) {
            $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        }

        // Execute the query
        return $stmt->execute();
    }
    public function updateStaffLoginProfile($userId, $oldPassword, $newPassword, $confirmPassword) {
        // Check if old password matches the user's current password
        if (!$this->isOldPasswordCorrect($userId, $oldPassword)) {
            return false; // Old password doesn't match, return false
        }

        // Check if the new password and confirm password match
        if ($newPassword !== $confirmPassword) {
            return false; // New password and confirm password don't match, return false
        }

        // Update the password
        $sql = "UPDATE tbl_admin 
            SET password = :newPassword
            WHERE admin_id = :userId";

        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);

        // Execute the query
        return $stmt->execute();
    }

// Function to check if the old password matches the user's current password
    private function isOldPasswordCorrect($userId, $oldPassword) {
        $sql = "SELECT password FROM tbl_admin WHERE admin_id = :userId";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the old password matches
        return $oldPassword === $result['password'];
    }




    public function deleteStaff($adminId){
        $sql = "DELETE FROM tbl_admin WHERE admin_id = :admin_ID";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':admin_ID', $adminId, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function suspendStaff($adminId) {
        $status = "Suspended";
        $sql = "UPDATE tbl_admin SET status = :status WHERE admin_id = :admin_id";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':admin_id', $adminId, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Check for success
        if ($stmt->rowCount() > 0) {
            // The update was successful
            return true;
        } else {
            // No records were updated, or an error occurred
            return false;
        }
    }
    public function activateStaff($adminId) {
        $status = "Active";
        $sql = "UPDATE tbl_admin SET status = :status WHERE admin_id = :admin_id";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':admin_id', $adminId, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Check for success
        if ($stmt->rowCount() > 0) {
            // The update was successful
            return true;
        } else {
            // No records were updated, or an error occurred
            return false;
        }
    }

    public function deleteAllStaff($adminId) {
        $status = "Active";
        $sql = "TRUNCATE TABLE tbl_admin";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':admin_id', $adminId, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Check for success
        if ($stmt->rowCount() > 0) {
            // The update was successful
            return true;
        } else {
            // No records were updated, or an error occurred
            return false;
        }
    }
    
    public function getAllUserStarCounts(): array
    {
        $userStarCounts = array();

        // Fetch star counts for all users
        $result = $this->database->query("SELECT user_id, star_count FROM tbl_feedback");

        if ($result) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $user_id = $row['user_id'];
                $starCount = (int) $row['star_count'];
                $userStarCounts[$user_id] = $starCount;
            }
        }

        return $userStarCounts;
    }
}

$database = new Database(); // Assuming you have a Database class
$staffData = new StaffData($database);

// Get star counts for all users
$userStarCounts = $staffData->getAllUserStarCounts();

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
?>