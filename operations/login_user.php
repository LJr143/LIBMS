<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\LIBMS\db_config\config.php';



class User
{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    public function login($username, $password)
    {
        if (empty($username) || empty($password)) {
            return array("status" => "error", "login_result" => "empty_fields");
        }

        $query = "SELECT * FROM tbl_user WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $authenticate_user = $user['username'];

        if (!$user) {
            return array("status" => "error", "login_result" => "account_not_found");
        }

        // Compare the provided password with the stored password (in plain text - not recommended)
        if ($password === $user['password']) {
            $_SESSION['authenticate_user'] = $authenticate_user;
            return array("status" => "success", "login_result" => "login_successful");


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


