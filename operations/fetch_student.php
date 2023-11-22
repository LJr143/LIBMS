<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_user_data.php';
$database = new Database();
$user = new UserData($database);



// Assuming you have a method to fetch staff data based on admin_id
$adminId = $_POST['adminId'];
$userData = $user->getUserById($adminId);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($userData);
