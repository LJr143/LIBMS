<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include '../includes/fetch_staff_data.php';

$database = new Database();
$staffData = new StaffData($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the admin_id from the POST request
    $adminId = $_POST['admin_id'];

    // Delete the staff member
    $success = $staffData->deleteStaff($adminId);

    // Send a JSON response indicating success or failure
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
} else {
    // Handle other request methods or invalid requests
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid request']);
}
?>
