<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


class StudentData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database->getDb();
    }

    public function getAllStudent(): array
    {
        $sql = "SELECT * FROM tbl_user ";
        $stmt = $this->database->query($sql);

        if ($stmt) {
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } else {
            return array();
        }
    }

    public function getNumberOfStudent(): int
    {
        $sql = "SELECT COUNT(*) as num_user FROM tbl_user ";
        $stmt = $this->database->prepare($sql);

        if ($stmt->execute()) {
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['num_Student'];
        } else {
            return 0;
        }
    }
    public function getStudentIdByUsername($username): ?string
    {
        $sql = "SELECT user_id FROM tbl_user WHERE username = :username";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $adminId = $stmt->fetchColumn();
            return $adminId;
        } else {
            return null;
        }
    }

    public function getStudentById($userId): array
    {
        $sql = "SELECT * FROM tbl_user WHERE user_id = :userId";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }
    public function addStudent($firstName, $lastName, $mi, $StudentId, $Pemail, $Uemail, $phoneNumber, $address, $year, $course, $major, $username, $password, $profile): bool
    {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO tbl_user (fname, lname, initial, user_id, email, usep_email, phone_number, address, year, course, major, username, password, img)
            VALUES (:fname, :lname, :initial, :student_id, :email, :usep_email, :phone_number, :address, :year, :course, :major, :username, :password, :img)";
        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':fname', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lname', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':initial', $mi, PDO::PARAM_STR);
        $stmt->bindParam(':student_id', $StudentId, PDO::PARAM_STR);
        $stmt->bindParam(':email', $Pemail, PDO::PARAM_STR);
        $stmt->bindParam(':usep_email', $Uemail, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':year', $year, PDO::PARAM_STR);
        $stmt->bindParam(':course', $course, PDO::PARAM_STR);
        $stmt->bindParam(':major', $major, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR); // Use hashed password
        $stmt->bindParam(':img', $profile, PDO::PARAM_STR);

        // Execute the query
        return $stmt->execute();
    }

    // Inside the StudentData class
    public function updateStudent($firstName, $lastName, $mi, $StudentId, $Pemail,$Uemail, $phoneNumber, $address, $year, $course, $major, $username, $password,$profile) {
        // SQL query without the img column
        $sql = "UPDATE tbl_user 
        SET fname = :fname, lname = :lname, initial = :initial, 
            email = :email, usep_email = :usep_email, 
            phone_number = :phone_number,
            address = :address, year = :year, course = :course, major = :major,
            username = :username, password = :password
        WHERE user_id = :userId";

        // If $img is not null, include it in the SQL query and bind the parameter
        if ($profile !== null) {
            $sql = "UPDATE tbl_user 
            SET fname = :fname, lname = :lname, initial = :initial, 
            email = :email, usep_email = :usep_email, 
            phone_number = :phone_number,
            address = :address, year = :year, course = :course, major = :major,
            username = :username, password = :password,
            img = :img
            WHERE user_id = :userId";
        }

        $stmt = $this->database->prepare($sql);

        // Bind parameters (excluding the img parameter if $img is null)
        $stmt->bindParam(':fname', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lname', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':initial', $mi, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $StudentId, PDO::PARAM_STR);
        $stmt->bindParam(':email', $Pemail, PDO::PARAM_STR);
        $stmt->bindParam(':usep_email', $Uemail, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':year', $year, PDO::PARAM_STR);
        $stmt->bindParam(':course', $course, PDO::PARAM_STR);
        $stmt->bindParam(':major', $major, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        // Bind the img parameter if $img is not null
        if ($profile !== null) {
            $stmt->bindParam(':img', $profile, PDO::PARAM_STR);
        }

        // Execute the query
        return $stmt->execute();
    }


    public function deleteStudent($userId){
        $sql = "DELETE FROM tbl_user WHERE user_id = :user_ID";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':user_ID', $userId, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function suspendStudent($userId) {
        $status = "Suspended";
        $sql = "UPDATE tbl_user SET status = :status WHERE id = :user_id";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

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
    public function activateStudent($userId) {
        $status = "Active";
        $sql = "UPDATE tbl_user SET status = :status WHERE id = :user_id";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

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

    public function deleteAllStudent($adminId) {
        $status = "Active";
        $sql = "TRUNCATE TABLE tbl_user";

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




