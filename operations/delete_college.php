<?php
error_reporting(0);
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include '../includes/fetch_college_data.php';
include '..\includes\logs_operation.php';

$database = new Database();
$log = new Logs($database);

$database = new Database();
$collegeData = new CollegeData($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the admin_id from the POST request
    $collegeId = $_POST['college_id'];

    // Delete the staff member
    $success = $collegeData->deleteCollege($collegeId);


    // Send a JSON response indicating success or failure
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
} else {
    // Handle other request methods or invalid requests
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid request']);
}
?>
