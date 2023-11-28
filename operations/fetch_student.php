<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_student_data.php';
$database = new Database();
$user = new StudentData($database);



// Assuming you have a method to fetch staff data based on admin_id
$userId = $_POST['userId'];
$userData = $user->getStudentById($userId);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($userData);
