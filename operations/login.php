<?php
require_once '../db_config/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$db = new Database();
$userAuth = new UserAuthentication($db);

// Check if the form is submitted
if (isset($_POST['form_submit_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['admin_role'];

    // Your existing login logic goes here...

    if ($role == 'Librarian') {
        $response = $userAuth->loginSuperAdmin($username, $password, $role);
    } elseif ($role == 'Staff') {
        $response = $userAuth->loginAdmin($username, $password, $role);
    } else if ($role == 'Student') {
        $response = $userAuth->login($username,$password);
    }

    else {
        $response = ['status' => 'error', 'message' => 'Invalid role'];
    }

    // Return the JSON response
    echo json_encode($response);
} else {
    // Handle other non-AJAX requests if needed
}

