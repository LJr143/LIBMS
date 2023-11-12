<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
error_reporting(0);
class UserAuthentication {
    private $db;

    public function __construct($dbConnection){
        $this->db = $dbConnection->getDb();
    }
    public function login($username, $password) {
        if ($this->validateUser($username, $password)) {
            session_start();
            $_SESSION['user'] = $username;
            return true;
        }
        return false;
    }

    public function loginAdmin($username, $password, $role) {
        if ($this->validateUserAdmin($username, $password, $role)) {
            session_start();
            $_SESSION['user'] = $username;
            $_SESSION['admin_role'] = $role;
            return true;
        }
        return false;
    }

    public function loginSuperAdmin($username, $password, $role) {
        if ($this->validateUserSuperAdmin($username, $password, $role)) {
            session_start();
            $_SESSION['user'] = $username;
            $_SESSION['admin_role'] = $role;
            return true;
        }
        return false;
    }

    public function logout() {
        session_start();
        session_destroy();
        return true;
    }

    public function isAuthenticated() {
        return isset($_SESSION['user']);

    }

    private function validateUser($username, $password) {
        $query = "SELECT username, password FROM tbl_user WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($password == $user['password']) {
                return true;
            }
        }

        return false;
    }

    private function validateUserAdmin($username, $password, $role) {
        $query = "SELECT username, password FROM tbl_admin WHERE username = :username AND admin_role = :role";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($password == $user['password']  ) {
                return true;
            }
        }

        return false;
    }
    private function validateUserSuperAdmin($username, $password, $role) {
        $query = "SELECT username, password FROM tbl_superadmin WHERE username = :username AND admin_role = :role";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($password == $user['password']  ) {
                return true;
            }
        }

        return false;
    }


}
