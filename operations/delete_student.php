<?php
session_start();
error_reporting(0);
require_once '../db_config/config.php';
include '../includes/fetch_student_data.php';
include '../includes/logs_operation.php';

$database = new Database();
$log = new Logs($database);

$database = new Database();
$studentData = new StudentData($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the admin_id from the POST request
    $userId = $_POST['user_id'];
    $studentName = $_POST['studentName'];

    // Delete the staff member
    $success = $studentData->deleteStudent($userId);


    // Send a JSON response indicating success or failure
    header('Content-Type: application/json');
    $deleteLog = $log->deleteAddLogs($_SESSION['loggedAdminID'], $_SESSION['user'], $studentName);
    echo json_encode(['success' => $success]);
} else {
    // Handle other request methods or invalid requests
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid request']);
}
?>
