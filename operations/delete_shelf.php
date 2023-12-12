<?php
error_reporting(0);
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include '../includes/fetch_shelf_data.php';
include '..\includes\logs_operation.php';

$database = new Database();
$log = new Logs($database);

$database = new Database();
$shelfData = new ShelfData($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the admin_id from the POST request
    $shelfId = $_POST['shelf_id'];

    // Delete the staff member
    $success = $shelfData->deleteShelf($shelfId);


    // Send a JSON response indicating success or failure
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
} else {
    // Handle other request methods or invalid requests
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid request']);
}
?>
