<?php
require_once '../db_config/config.php';
require_once '../includes/authentication.php';

$db = new Database();
$userAuth = new UserAuthentication($db);

if (isset($_POST['form_submit_btn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['admin_role'];

        if ($role == 'Librarian') {
            $response = $userAuth->loginSuperAdmin($username, $password, $role);
    }
        elseif ($role == 'Staff') {
            $response = $userAuth->loginAdmin($username, $password, $role);
    }
        else if ($role == 'Student') {
            $response = $userAuth->login($username,$password);
    }

    else {
            $response = ['status' => 'error', 'message' => 'Invalid role'];
    }


    echo json_encode($response);
}

