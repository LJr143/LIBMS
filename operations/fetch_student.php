<?php
require_once '../db_config/config.php';
include '../includes/fetch_student_data.php';
$database = new Database();
$user = new StudentData($database);



// Assuming you have a method to fetch staff data based on admin_id
$userId = $_POST['userId'];
$userData = $user->getStudentById($userId);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($userData);
