<?php
require_once '../db_config/config.php';
include '../includes/fetch_student_data.php';
include '../includes/logs_operation.php';


$database = new Database();
$studentData = new StudentData($database);
$log = new Logs($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the admin_id from the POST request
    $userId = $_POST['user_id'];
    $studentName = $_POST['studentName'];

    // Suspend the staff member
    $success = $studentData->activateStudent($userId);
//    $addedStaff = $staffName;
//    $addLog = $log->activateAddLogs($_SESSION['loggedAdminID'], $_SESSION['user'], $addedStaff);

    // Send a JSON response indicating success or failure
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
} else {
    // Handle other request methods or invalid requests
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid request']);
}
?>
