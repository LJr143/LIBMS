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
    public function addStaff($firstName, $lastName, $mi, $staffId, $Pemail,$Oemail, $phoneNumber, $telephoneNumber, $address, $admin_role, $username, $password,$profile): bool
    {
        $sql = "INSERT INTO tbl_admin (fname, lname, initial, admin_id, email,personal_email, phone_number, tele_number, address, admin_role, username, password, img)
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
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':img', $profile, PDO::PARAM_STR);


        // Execute the query
        return $stmt->execute();
    }
    public function updateStaff($userId, $firstName, $lastName, $mi, $Pemail, $Oemail, $phoneNumber, $telephoneNumber, $address, $admin_role, $username, $password, $profile): bool
    {
        // Check if a new profile picture is provided
        if ($profile !== null) {
            // If provided, update the profile picture in the database
            $sql = "UPDATE tbl_admin 
            SET fname = :fname, lname = :lname, initial = :initial, 
                email = :email, personal_email = :personal_email, 
                phone_number = :phone_number, tele_number = :tele_number, 
                address = :address, admin_role = :admin_role, 
                username = :username, password = :password, img = :img 
            WHERE admin_id = :userId";

            $stmt = $this->database->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':fname', $firstName, PDO::PARAM_STR);
            $stmt->bindParam(':lname', $lastName, PDO::PARAM_STR);
            $stmt->bindParam(':initial', $mi, PDO::PARAM_STR);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
            $stmt->bindParam(':email', $Pemail, PDO::PARAM_STR);
            $stmt->bindParam(':personal_email', $Oemail, PDO::PARAM_STR);
            $stmt->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);
            $stmt->bindParam(':tele_number', $telephoneNumber, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':admin_role', $admin_role, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':img', $profile, PDO::PARAM_STR);

            // Execute the query
            return $stmt->execute();
        } else {
            // If not provided, skip the profile picture update
            $sql = "UPDATE tbl_admin 
    SET fname = :fname, lname = :lname, initial = :initial, 
        email = :email, personal_email = :personal_email, 
        phone_number = :phone_number, tele_number = :tele_number, 
        address = :address, admin_role = :admin_role, 
        username = :username, password = :password,
        img = :img
    WHERE admin_id = :userId";


            $stmt = $this->database->prepare($sql);

            // Bind parameters (excluding the profile picture)
            $stmt->bindParam(':fname', $firstName, PDO::PARAM_STR);
            $stmt->bindParam(':lname', $lastName, PDO::PARAM_STR);
            $stmt->bindParam(':initial', $mi, PDO::PARAM_STR);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
            $stmt->bindParam(':email', $Pemail, PDO::PARAM_STR);
            $stmt->bindParam(':personal_email', $Oemail, PDO::PARAM_STR);
            $stmt->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);
            $stmt->bindParam(':tele_number', $telephoneNumber, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':admin_role', $admin_role, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            // If $profile is null, set the default image name 'user.png'
            $defaultImg =  'user.png';
            $stmt->bindParam(':img', $defaultImg, PDO::PARAM_STR);




            // Execute the query
            return $stmt->execute();
        }
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



}




