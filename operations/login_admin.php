<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\LIBMS\db_config\config.php';



class Admin
{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    public function login($username, $password, $role)
    {
        if (empty($username) || empty($password)) {
            return array("status" => "error", "login_result" => "empty_fields");
        }

        $query = "SELECT * FROM tbl_admin WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $authenticate_user = $user['username'];

        if (!$user) {
            return array("status" => "error", "login_result" => "account_not_found");
        }

        if ($password === $user['password']) {
            $_SESSION['authenticate_user'] = $authenticate_user;
            if($role === 'Librarian'){
                return array("status" => "success", "login_result" => "login_superadmin");
            }
            else if ($role == 'Staff') {
                return array("status" => "success", "login_result" => "login_admin");
            }
            else {
                return array("status" => "success", "login_result" => "login_successful");
            }



        } else {
            return array("status" => "error", "login_result" => "wrong_password");
        }
    }

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $dbConnection = new PDO("mysql:host=localhost;dbname=lms_db", "root", "");

    $user = new User($dbConnection);
    $loginResult = $user->login($username, $password);

    echo json_encode($loginResult);
}


