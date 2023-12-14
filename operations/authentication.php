<?php
require_once 'db_config/config.php';
error_reporting(0);

class UserAuthentication
{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection->getDb();
    }

    public function login($username, $password): array
    {
        // Validate the user with the original password
        $response = $this->validateUser($username, $password);

        if ($response['status'] === 'success') {
            session_start();
            $_SESSION['user'] = $username;
            return $response;
        }

        return $response;
    }


    public function loginAdmin($username, $password, $role): array
    {
        $response = $this->validateUserAdmin($username, $password, $role);

        if ($response['status'] === 'admin_success') {
            session_start();
            $_SESSION['user'] = $username;
            $_SESSION['admin_role'] = $role;
            return $response;
        }

        return $response;
    }

    public function loginSuperAdmin($username, $password, $role): array
    {
        $response = $this->validateUserSuperAdmin($username, $password, $role);

        if ($response['status'] === 'superadmin_success') {
            session_start();
            $_SESSION['user'] = $username;
            $_SESSION['admin_role'] = $role;
            return $response;
        }

        return $response;
    }

    public function logout(): array
    {
        session_start();
        session_destroy();
        return ['status' => 'success', 'message' => 'Logout successful'];
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['user']);
    }

    private function validateUser($username, $password): array
    {
        $query = "SELECT username, password, status, user_id FROM tbl_user WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Check if the user is active
            if ($user['status'] == 'Active' && password_verify($password, $user['password'])) {
                return ['status' => 'success', 'message' => 'Login successful'];
            } else {
                return ['status' => 'error', 'message' => 'User is not active or password is incorrect', 'password' => $password];
            }
        }

        return ['status' => 'error', 'message' => 'User not found'];
    }

    private function validateUserAdmin($username, $password, $role): array
    {
        $query = "SELECT username, password, status FROM tbl_admin WHERE username = :username AND admin_role = :role";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Check if the user is active
            if ($user['status'] == 'Active' && $password == $user['password']) {
                return ['status' => 'admin_success', 'message' => 'Login successful'];
            } else {
                return ['status' => 'error', 'message' => 'User is not active or password is incorrect'];
            }
        }

        return ['status' => 'error', 'message' => 'User not found'];
    }

    private function validateUserSuperAdmin($username, $password, $role): array
    {
        $query = "SELECT username, password FROM tbl_superadmin WHERE username = :username AND admin_role = :role";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($password == $user['password']) {
                return ['status' => 'superadmin_success', 'message' => 'Login successful'];
            }
        }

        return ['status' => 'error', 'message' => 'User not found'];
    }
}

