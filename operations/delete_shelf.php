<?php
session_start();
error_reporting(0);
require_once '../db_config/config.php';
include '../includes/fetch_shelf_data.php';
include '../includes/logs_operation.php';

$database = new Database();
$log = new Logs($database);

$database = new Database();
$shelfData = new ShelfData($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the admin_id from the POST request
    $shelfId = $_POST['shelf_id'];
    $shelfName = $_POST['shelfName'];

    // Delete the staff member
    $success = $shelfData->deleteShelf($shelfId);


    // Send a JSON response indicating success or failure
    header('Content-Type: application/json');
    $action = "{$_SESSION['user']} delete shelf category {$shelfName}";
    $addLog = $log->insertAddCollegeLogs($_SESSION['loggedAdminID'], $action);
    echo json_encode(['success' => $success]);
} else {
    // Handle other request methods or invalid requests
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid request']);
}
?>
